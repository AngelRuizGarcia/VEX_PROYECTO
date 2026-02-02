<!DOCTYPE html>
<html lang="en">
<head>
<?php
require_once("../recursos/php/head.php");
$header = new Head("Admin - List Users", "..");
echo $header->toHTML();
?>
</head>
<body>
    <div class="container mt-5">
        <h2>Administrador - Listar Usuarios</h2>
        
        <?php
            require_once("./conexionClaves.php");
            
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
                        echo '</tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>No hay usuarios registrados para listar.</p>';
                }

                $conexion = null;
            } catch (PDOException $e) {
                die("Error en la conexión: " . $e->getMessage());
            }
        ?>
    </div>

</body>
</html>

