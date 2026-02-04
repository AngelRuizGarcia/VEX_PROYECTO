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
        <h2 class="text-center">Administrador - Listar Usuarios</h2>
        
        <?php
            require_once("./conexionClaves.php");
            
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
                    echo '<th class="text-center">Nombre</th>';
                    echo '<th class="text-center">Email</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    foreach ($usuarios as $usuario) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($usuario['id_user']) . '</td>';
                        echo '<td class="text-center">' . htmlspecialchars($usuario['name']) . '</td>';
                        echo '<td class="text-center">' . htmlspecialchars($usuario['email']) . '</td>';
                        echo '<td>';
                        echo '<form method="POST" action="./adminEditUsers.php" style="display:inline;">';
                        echo '<input type="hidden" name="editar" value="' . htmlspecialchars($usuario['id_user']) . '">';
                        echo '<button type="submit" class="btn btn-primary btn-sm me-3 ms-3">Editar</button>';
                        echo '</form>';
                        echo '<form method="POST" action="./adminDeleteUsers.php" style="display:inline;" onsubmit="return confirm(\'¿Estás seguro de que deseas eliminar este usuario?\');">';
                        echo '<input type="hidden" name="borrar" value="' . htmlspecialchars($usuario['id_user']) . '">';
                        echo '<button type="submit" class="btn btn-danger btn-sm">Borrar</button>';
                        echo '</form>';                        
                        echo '</td>';
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

