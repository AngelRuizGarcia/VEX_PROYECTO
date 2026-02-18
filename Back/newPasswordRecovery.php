<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("../recursos/php/head.php");
    require_once("./conexionClaves.php");
    $header = new Head("VEX - recover account", "..");
    echo $header->toHTML();
    ?>
</head>

<body>
    <?php
    try {
        $conexion = new PDO($dsn, $usuario, $contraseña);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Fallo en la conexión con la base de datos: " . $e->getMessage());
    }

    $token = $_REQUEST['token'] ?? '';
    if (!$token) {
        echo '
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="alert alert-danger text-center" role="alert">
        invalid token.
        </div>
    </div>
';
        exit;
    }
    $stmt = $conexion->prepare("
                             SELECT * FROM password_resets
                             WHERE token = ?");
    $stmt->execute([$token]);
    $reset = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$reset) {
        echo '
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="alert alert-danger text-center" role="alert">
        invalid token.
        </div>
    </div>
    ';
        exit;
    }

    if (strtotime($reset['expires_at']) < time()) {
        echo '
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="alert alert-danger text-center" role="alert">
        The link has expired.
        </div>
        </div>
        ';
        exit;
    }
    ?>
    <div class="container align-items-center d-flex justify-content-center" style="height: 80vh;">
        <form class="form-horizontal row gap-3 text-end border border-dark border-5 rounded-5 p-2" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h2 class="text-center">recovery password form</h2>

            <div class="form-group col-12 row">
                <label class="control-label col-4" for="password">Password:</label>
                <div class="col-8">
                    <input type="password" class="form-control" name="password" required>
                </div>
            </div>

            <div class="form-group col-12 row">
                <label class="control-label col-4" for="confirm_password">Confirm Password:</label>
                <div class="col-8">
                    <input type="password" class="form-control" name="confirm_password" required>
                </div>
            </div>

            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

            <div class="d-flex justify-content-center">
                <button class="btn btn-dark mt-2" type="submit" name="enviar">CHANGE PASSWORD</button>
            </div>
        </form>
    </div>
    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $password = $_POST['password'] ?? '';
        $confirm  = $_POST['confirm_password'] ?? '';

        if ($password !== $confirm) {
            echo '<div class="alert alert-danger text-center" role="alert">The passwords do not match.</div>';
            exit;
        }

        $stmt = $conexion->prepare("
        SELECT * FROM password_resets
        WHERE token = ?
    ");
        $stmt->execute([$token]);
        $reset = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$reset) {
            echo '<div class="alert alert-danger text-center" role="alert">invalid token.</div>';
            exit;
        }

        if (strtotime($reset['expires_at']) < time()) {
            echo '<div class="alert alert-danger text-center" role="alert">The link has expired.</div>';
            exit;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);


        $stmt = $conexion->prepare("
        UPDATE users
        SET password_hash = ?
        WHERE id_user = ?
    ");
        $stmt->execute([$hash, $reset['id_user']]);

        $stmt = $conexion->prepare("
        DELETE FROM password_resets
        WHERE id = ?
    ");
        $stmt->execute([$reset['id']]);

        $conexion = null;
        echo '<div class="alert alert-success m-0 text-center" role="alert">Password successfully changed.</div>';
        exit;
    }
    ?>
</body>

</html>