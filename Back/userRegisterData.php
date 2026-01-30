<?php
require_once("./conexionClaves.php");
if($_SERVER["REQUEST_METHOD"] === "POST"){

    if(!isset($_POST['username'], $_POST['email'], $_POST['name'], $_POST['firstSurname'], $_POST['secondSurname'], $_POST['password'], $_POST['confirmPassword'])){
        die("Faltan datos del formulario");
    }else{
        // Sanitize and assign form data
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $name = htmlspecialchars($_POST['name']);
        $firstSurname = htmlspecialchars($_POST['firstSurname']);
        $secondSurname = htmlspecialchars($_POST['secondSurname']);
        $finalName = $name . ' ' . $firstSurname . ' ' . $secondSurname;

        // Handle profile picture upload
        $profilePicture = $_FILES['profilePicture'] ?? null;
        $profilePicturePath = null;
        if (isset($_FILES['profilePicture']) && isset($_FILES['profilePicture']['name']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
            $originalName = "img_" . str_replace(" ", "", $username) . "." . pathinfo($_FILES['profilePicture']['name'], PATHINFO_EXTENSION);
            $path = "/../uploads/images/";
            $uploadsDir = __DIR__ . $path;
            
            if (!is_dir($uploadsDir)) {
                mkdir($uploadsDir, 0755, true);
            }
            $targetPath = $uploadsDir . $originalName;
            if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $targetPath)) {
                $profilePicturePath = $path . $originalName;
            } else {
                $profilePicturePath = null;
            }
        }

        // Validate passwords
        if($_POST['password'] !== $_POST['confirmPassword']){
            die("Las contraseñas no coinciden");
        }else {
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        }
    }
    try{
        // Database connection
        $conexion = new PDO($dsn, $usuario, $contraseña);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert user data
        $stmt = $conexion->prepare("INSERT INTO users (username, email, name, password_hash, profile_picture_url) VALUES (:username, :email, :name, :password, :profile_picture_url)");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':name', $finalName , PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':profile_picture_url', $profilePicturePath, PDO::PARAM_STR);

        $stmt->execute();

        $conexion = null;

    }catch (PDOException $e){
        die("Error en la conexión: " . $e->getMessage());
    }

    echo "Registro completado con éxito.";
} else {
    header("Location: ./formUserRegister.php");
    exit();
}
?>