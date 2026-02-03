<!DOCTYPE html>
<html lang="en">
<head>
<?php
require_once("../recursos/php/head.php");
$header = new Head("Admin - Delete Users", "..");
echo $header->toHTML();
?>
</head>
<body>
    <div class="container mt-5">
        <h2>Administrador - Eliminar Usuarios</h2>
        
        <?php
            require_once("./conexionClaves.php");
            
            // Procesar eliminacion si se envio el formulario
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['borrar'])) {
                try {
                    $conexion = new PDO($dsn, $usuario, $contraseña);
                    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $conexion->prepare("DELETE FROM users WHERE id_user = :id_user");
                    $stmt->bindParam(':id_user', $_POST['borrar'], PDO::PARAM_INT);
                    $stmt->execute();

                    echo '<div class="alert alert-success" role="alert">Usuario eliminado con éxito.</div>';

                    $conexion = null;
                } catch (PDOException $e) {
                    die("Error en la conexión: " . $e->getMessage());
                }
            }
        ?>
    </div>

</body>
</html>

