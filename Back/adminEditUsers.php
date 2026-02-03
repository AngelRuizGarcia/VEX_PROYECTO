<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("../recursos/php/head.php");
    $header = new Head("Admin - Edit Users", "..");
    echo $header->toHTML();
    ?>
</head>

<body>
    <div class="container mt-5">
        <h2>Administrador - Eliminar Usuarios</h2>


        <form method="post" action="$_SERVER['PHP_SELF']">
            <label for="campo">Elige el campo a cambiar:</label>
            <select name="campo" id="campo">
                <option value="username">UserName</option>
                <option value="email">Email</option>
                <option value="name">Name</option>
            </select>
            <label for="cambio">Nuevo dato:</label>
            <input type="text" value="cambio" id="cambio">
            <input type="submit">
            <?php
            require_once("./conexionClaves.php");

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['campo'])) {
                try {
                    $conexion = new PDO($dsn, $usuario, $contraseña);
                    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $conexion->prepare("UPDATE  users set :id_user = :cambio");
                    $stmt->bindParam(':id_user', $_POST['campo'], PDO::PARAM_INT);
                    $stmt->bindParam(':cambio', $_POST['cambio'], PDO::PARAM_STR);
                    $stmt->execute();

                    echo '<div class="alert alert-success" role="alert">Usuario modificado con éxito.</div>';

                    $conexion = null;
                } catch (PDOException $e) {
                    die("Error en la conexión: " . $e->getMessage());
                }
            }

            ?>
    </div>

</body>

</html>