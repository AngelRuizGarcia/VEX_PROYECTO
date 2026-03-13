<?php
require_once("../core/sesiones.php");
require_once("../core/conexionClaves.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST['volver'])) {
        header("Location: ./recovery.php");
        exit();
    }

    if (!isset($_POST['username'], $_POST['password'])) {
        die("Faltan datos del formulario");
    } else {
        $username = htmlspecialchars($_POST['username']);
        $password = $_POST['password'];
    }

    try {
        $conexion = new PDO($dsn, $usuario, $contraseña);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conexion->prepare("SELECT id_user, username, email, name, profile_picture_url, password_hash FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            // Crear sesión
            setUserSession($user);
            setFlashMessage('success', 'Inicio de sesión exitoso. Bienvenido, ' . $user['username'] . '!');
            header("Location: ../index.php");
            exit();
        } else {
            setFlashMessage('error', 'Nombre de usuario o contraseña incorrectos.');
            header("Location: ../../auth/formUserLogin.php");
            exit();
        }

        $conexion = null;
    } catch (PDOException $e) {
        die("Error en la conexión: " . $e->getMessage());
    }
} else {
    die("Método de solicitud no válido");
}

















