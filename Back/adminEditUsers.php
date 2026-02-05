<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("./conexionClaves.php");
    require_once("../recursos/php/head.php");
    $header = new Head("Admin - Edit Users", "..");
    echo $header->toHTML();
    ?>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Administrador - Editar Usuarios</h2>

        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
            <label for="campo" class="mt-5">Elige el campo a cambiar:</label>
            <select name="campo" id="campo">
                <?php
                try {
                    $conexion = new PDO($dsn, $usuario, $contraseña);
                    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $camposBBDD = [];
                    $stmt = $conexion->prepare("DESCRIBE users");
                    $stmt->execute();
                    $columnas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($columnas as $row) {
                        echo '<option value=' . $row["Field"] . '>' . $row["Field"] . '</option>';
                    }

                    $conexion = null;
                } catch (PDOException $e) {
                    die("Error en la conexión: " . $e->getMessage());
                }
                ?>
            </select>
            <label for="cambio">Nuevo dato:</label>
            <input type="text" id="cambio" name="cambio">
            <input type="hidden" name="editar" value="<?= $_POST['editar'] ?? ''; ?>">
            <input type="submit">
            <?php

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['campo'])) {
                try {
                    $conexion = new PDO($dsn, $usuario, $contraseña);
                    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $campo = $_POST['campo'];
                    $stmt = $conexion->prepare("UPDATE users set $campo = :cambio WHERE id_user = :id_user");
                    $stmt->bindParam(':cambio', $_POST['cambio'], PDO::PARAM_STR);
                    $id_user = $_POST['editar'];
                    $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
                    $stmt->execute();

                    echo '<div class="alert alert-success" role="alert">Usuario modificado con éxito.</div>';

                    $conexion = null;
                } catch (PDOException $e) {
                    die("Error en la conexión: " . $e->getMessage());
                }
            }

            ?>
            <br>

            <button type="button" onclick="window.location.href='./adminListUsers.php';">Volver</button>


</body>

</html>