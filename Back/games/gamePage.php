<!DOCTYPE html>
<html lang="en">
<?php
include_once("../../recursos/php/head.php");
require_once("../core/conexionClaves.php");

$head = new Head("VEX - Game", "../..");
echo $head->toHTML();

$gameId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$game = null;
$error = null;

if ($gameId > 0) {
    $conexion = new PDO($dsn, $usuario, $contraseña);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conexion->prepare(
        "SELECT g.id_game, g.title, g.description, g.price, gi.image_path AS cover_image
         FROM game g
         LEFT JOIN game_images gi ON g.id_game = gi.id_game AND gi.id_image = (
            SELECT MIN(id_image) FROM game_images WHERE id_game = g.id_game
         )
         WHERE g.id_game = :id LIMIT 1"
    );
    $stmt->execute([':id' => $gameId]);
    $game = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$game) {
        $error = 'Juego no encontrado.';
    } else {
        // Obtener archivos disponibles (platform/version)
        $stmt = $conexion->prepare("SELECT platform, file_path, version FROM game_files WHERE id_game = :id");
        $stmt->execute([':id' => $gameId]);
        $game['files'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} else {
    $error = 'ID de juego inválido.';
}
?>

<body class="nunitoFontFamily">
    <?php
    include_once("../../recursos/php/header.php");
    $header = new Header("../..");
    echo $header->toHTML();
    ?>

    <main class="container my-5">
        <?php if ($error): ?>
            <div class="alert alert-warning" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php else: ?>
            <?php
            $title = htmlspecialchars($game['title'] ?? '');
            $description = nl2br(htmlspecialchars($game['description'] ?? ''));
            $price = isset($game['price']) ? number_format($game['price'], 2) : 'N/A';
            $cover = '';
            if (!empty($game['cover_image'])) {
                $img = $game['cover_image'];
                if (str_starts_with($img, 'Uploads') || str_starts_with($img, '/Uploads')) {
                    $cover = "../../" . ltrim($img, "/");
                } else {
                    $cover = "../../recursos/" . ltrim($img, "/");
                }
            } else {
                $cover = "../../recursos/img/placeholder.jpg";
            }
            $downloadFiles = $game['files'] ?? [];
            ?>

            <div class="row">
                <div class="col-12 col-md-5 mb-4">
                    <img src="<?php echo htmlspecialchars($cover); ?>" class="img-fluid rounded" alt="<?php echo $title; ?>">
                </div>
                <div class="col-12 col-md-7">
                    <h1 class="h2"><?php echo $title; ?></h1>
                    <p class="text-muted">Precio: <strong><?php echo $price; ?></strong></p>
                    <div class="mb-4">
                        <?php echo $description; ?>
                    </div>

                    <?php if (!empty($downloadFiles)): ?>
                        <div class="mb-3">
                            <h5>Descargas disponibles</h5>
                            <?php foreach ($downloadFiles as $file):
                                $filePath = $file['file_path'];
                                $href = str_starts_with($filePath, '/') ? $filePath : "../../" . ltrim($filePath, "/");
                                $label = htmlspecialchars(strtoupper($file['platform']) . ' v' . $file['version']);
                            ?>
                                <a href="<?php echo htmlspecialchars($href); ?>" class="btn btn-primary me-2 mb-2" download>
                                    <?php echo $label; ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <a href="gamesPage.php" class="btn btn-secondary ms-2">
                        Volver a juegos
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <?php
    include_once("../../recursos/php/footer.php");
    $footer = new Footer("../../");
    echo $footer->toHTML();
    ?>
</body>

</html>