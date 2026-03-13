<?php

require_once '../core/sesiones.php';
require_once '../core/conexionClaves.php';


if (!isUserLoggedIn()) {
    header('Location: ../auth/formUserLogin.php');
    exit;
}

$user = getUserSession();
$userId = $user['id_user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $conexion = new PDO($dsn, $usuario, $contraseña);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Datos del formulario
        $title = trim($_POST['title'] ?? '');
        $pricing = $_POST['pricing'] ?? '';
        $description = trim($_POST['description'] ?? '');
        $genres = $_POST['genre'] ?? [];
        $tags = $_POST['tags'] ?? [];

        // Validaciones básicas
        if (empty($title) || empty($pricing)) {
            throw new Exception('Campos obligatorios faltantes.');
        }

        $price = 0.0;
        $donationAmount = null;
        if ($pricing === 'Paid') {
            $price = floatval($_POST['price'] ?? 0);
            if ($price <= 0) {
                throw new Exception('Precio inválido para Paid.');
            }
        } elseif ($pricing === 'Free') {
            $price = 0.0;
        }

        // Manejo de archivos (se guardan rutas relativas a la raíz del proyecto)
        $uploadRoot = realpath(__DIR__ . '/../../'); // carpeta raíz del proyecto

        $gameFilePath = null;
        if (isset($_FILES['gameFile']) && $_FILES['gameFile']['error'] === UPLOAD_ERR_OK) {
            $gameFileName = basename($_FILES['gameFile']['name']);
            $relativeGameFile = "Uploads/juegos/{$gameFileName}";
            $targetGameFile = $uploadRoot . DIRECTORY_SEPARATOR . $relativeGameFile;
            if (!is_dir(dirname($targetGameFile))) {
                mkdir(dirname($targetGameFile), 0755, true);
            }
            if (!move_uploaded_file($_FILES['gameFile']['tmp_name'], $targetGameFile)) {
                throw new Exception('Error al subir el archivo del juego.');
            }
            $gameFilePath = $relativeGameFile;
        }

        $coverImagePath = null;
        if (isset($_FILES['coverImage']) && $_FILES['coverImage']['error'] === UPLOAD_ERR_OK) {
            $coverImageName = basename($_FILES['coverImage']['name']);
            $relativeCoverImage = "Uploads/img/{$coverImageName}";
            $targetCoverImage = $uploadRoot . DIRECTORY_SEPARATOR . $relativeCoverImage;
            if (!is_dir(dirname($targetCoverImage))) {
                mkdir(dirname($targetCoverImage), 0755, true);
            }
            if (!move_uploaded_file($_FILES['coverImage']['tmp_name'], $targetCoverImage)) {
                throw new Exception('Error al subir la imagen de portada.');
            }
            $coverImagePath = $relativeCoverImage;
        }

        $screenshotsPaths = [];
        if (isset($_FILES['screenshots'])) {
            foreach ($_FILES['screenshots']['tmp_name'] as $key => $tmpName) {
                if ($_FILES['screenshots']['error'][$key] === UPLOAD_ERR_OK) {
                    $screenshotName = basename($_FILES['screenshots']['name'][$key]);
                    $relativeScreenshot = "Uploads/img/{$screenshotName}";
                    $targetScreenshot = $uploadRoot . DIRECTORY_SEPARATOR . $relativeScreenshot;
                    if (!is_dir(dirname($targetScreenshot))) {
                        mkdir(dirname($targetScreenshot), 0755, true);
                    }
                    if (move_uploaded_file($tmpName, $targetScreenshot)) {
                        $screenshotsPaths[] = $relativeScreenshot;
                    }
                }
            }
        }

        // Insertar en game (sin file_path, lo guardamos en game_files)
        $stmt = $conexion->prepare("INSERT INTO game (id_user, title, description, price) VALUES (:id_user, :title, :description, :price)");
        $stmt->execute([
            ':id_user' => $userId,
            ':title' => $title,
            ':description' => $description,
            ':price' => $price
        ]);

        $gameId = $conexion->lastInsertId();

        // Insertar archivo del juego en game_files (plataforma + versión mínimas)
        if ($gameFilePath) {
            $platform = 'windows';
            $version = '1.0';
            $lowerName = strtolower($gameFileName);
            if (str_ends_with($lowerName, '.dmg')) {
                $platform = 'macos';
            } elseif (str_ends_with($lowerName, '.tar.gz') || str_ends_with($lowerName, '.tgz')) {
                $platform = 'linux';
            } elseif (str_ends_with($lowerName, '.zip') || str_ends_with($lowerName, '.exe')) {
                $platform = 'windows';
            }
            // Try to infer version from filename like v1.2
            if (preg_match('/v(\d+\.\d+)/i', $gameFileName, $m)) {
                $version = $m[1];
            }

            $stmt = $conexion->prepare("INSERT INTO game_files (id_game, platform, file_path, version) VALUES (:id_game, :platform, :file_path, :version)");
            $stmt->execute([
                ':id_game' => $gameId,
                ':platform' => $platform,
                ':file_path' => $gameFilePath,
                ':version' => $version
            ]);
        }

        // Insertar cover image (primera imagen)
        if ($coverImagePath) {
            $stmt = $conexion->prepare("INSERT INTO game_images (id_game, image_path) VALUES (:id_game, :image_path)");
            $stmt->execute([':id_game' => $gameId, ':image_path' => $coverImagePath]);
        }

        // Insertar screenshots (imagenes adicionales)
        foreach ($screenshotsPaths as $path) {
            $stmt = $conexion->prepare("INSERT INTO game_images (id_game, image_path) VALUES (:id_game, :image_path)");
            $stmt->execute([':id_game' => $gameId, ':image_path' => $path]);
        }

        // Insertar genres
        foreach ($genres as $genreName) {
            $stmt = $conexion->prepare("SELECT id_genre FROM genre WHERE name = :name");
            $stmt->execute([':name' => $genreName]);
            $genreId = $stmt->fetchColumn();
            if ($genreId) {
                $stmt = $conexion->prepare("INSERT INTO game_genre (id_game, id_genre) VALUES (:id_game, :id_genre)");
                $stmt->execute([':id_game' => $gameId, ':id_genre' => $genreId]);
            }
        }

        // Insertar tags
        foreach ($tags as $tagName) {
            $stmt = $conexion->prepare("SELECT id_tag FROM tag WHERE name = :name");
            $stmt->execute([':name' => $tagName]);
            $tagId = $stmt->fetchColumn();
            if ($tagId) {
                $stmt = $conexion->prepare("INSERT INTO game_tag (id_game, id_tag) VALUES (:id_game, :id_tag)");
                $stmt->execute([':id_game' => $gameId, ':id_tag' => $tagId]);
            }
        }

        setFlashMessage('success', 'Juego subido exitosamente.');
        header('Location: gamesPage.php');
        exit;

    } catch (Exception $e) {
        setFlashMessage('error', 'Error: ' . $e->getMessage());
        header('Location: formGameRegister.php');
        exit;
    }
} else {
    header('Location: formGameRegister.php');
    exit;
}
