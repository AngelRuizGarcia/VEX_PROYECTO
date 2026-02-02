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
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_user'])) {
                try {
                    $conexion = new PDO($dsn, $usuario, $contraseña);
                    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $conexion->prepare("DELETE FROM users WHERE id_user = :id_user");
                    $stmt->bindParam(':id_user', $_POST['id_user'], PDO::PARAM_STR);
                    $stmt->execute();

                    echo '<div class="alert alert-success" role="alert">Usuario eliminado con éxito.</div>';

                    $conexion = null;
                } catch (PDOException $e) {
                    die("Error en la conexión: " . $e->getMessage());
                }
            }

            // Mostrar todos los usuarios
            try {
                $conexion = new PDO($dsn, $usuario, $contraseña);
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conexion->prepare("SELECT id_user, name, email FROM users");
                $stmt->execute();
                $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($usuarios) > 0) {
                    echo '<table class="table table-striped">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Nombre</th>';
                    echo '<th>Email</th>';
                    echo '<th>Acción</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    foreach ($usuarios as $usuario) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($usuario['id_user']) . '</td>';
                        echo '<td>' . htmlspecialchars($usuario['name']) . '</td>';
                        echo '<td>' . htmlspecialchars($usuario['email']) . '</td>';
                        echo '<td>';
                        echo '<form method="POST" style="display:inline;" onsubmit="return confirm(\'¿Estás seguro de que deseas eliminar este usuario?\');">';
                        echo '<input type="hidden" name="id_user" value="' . htmlspecialchars($usuario['id_user']) . '">';
                        echo '<button type="submit" class="btn btn-danger btn-sm">Borrar</button>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>No hay usuarios registrados.</p>';
                }

                $conexion = null;
            } catch (PDOException $e) {
                die("Error en la conexión: " . $e->getMessage());
            }
        ?>
    </div>

</body>
</html>

