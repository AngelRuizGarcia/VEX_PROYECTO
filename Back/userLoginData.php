<?php
require_once("./conexionClaves.php");
if($_SERVER["REQUEST_METHOD"] === "POST"){

    if(!isset($_POST['username'], $_POST['password'])){
        die("Faltan datos del formulario");
    }else{
        $username = htmlspecialchars($_POST['username']);
        $password = $_POST['password'];
    }

    try{
        $conexion = new PDO($dsn, $usuario, $contraseña);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conexion->prepare("SELECT password_hash FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result && password_verify($password, $result['password_hash'])){
            echo "Inicio de sesión exitoso";
        }else{
            echo "Nombre de usuario o contraseña incorrectos";
        }

        $conexion = null;
    }catch(PDOException $e){
        die("Error en la conexión: " . $e->getMessage());
    }
} else {
    die("Método de solicitud no válido");
}
















