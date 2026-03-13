<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("../../recursos/php/head.php");
    $header = new Head("VEX - User Login", "../..");
    echo $header->toHTML();
    ?>
</head>

<body class="nunitoFontFamily">
    <?php
    include_once("../../recursos/php/header.php");
    $header = new Header("../..");
    echo $header->toHTML();
    ?>

    <main class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-5">
                <div class="card shadow-sm rounded-4">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Login</h2>

                        <?php
                        require_once("../core/sesiones.php");
                        $success = getFlashMessage('success');
                        $error = getFlashMessage('error');
                        if ($success) {
                            echo "<div class='alert alert-success text-center'>$success</div>";
                        }
                        if ($error) {
                            echo "<div class='alert alert-danger text-center'>$error</div>";
                        }
                        ?>

                        <form action="./userLoginData.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label" for="username">Username</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <a href="./recovery.php" class="small">¿Olvidaste tu contraseña?</a>
                                <button class="btn btn-primary" type="submit">Login</button>
                            </div>

                            <div class="text-center">
                                <span class="text-muted">¿No tienes cuenta? <a href="./formUserRegister.php">Regístrate</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php
    include_once("../../recursos/php/footer.php");
    $footer = new Footer("../..");
    echo $footer->toHTML();
    ?>
</body>

</html>