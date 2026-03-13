<!DOCTYPE html>
<html lang="en">

<head>
<?php
require_once("../../recursos/php/head.php");
$header = new Head("VEX - User Register", "../..");
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
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card shadow-sm rounded-4">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Register</h2>

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

                        <form action="./userRegisterData.php" method="POST" enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="firstSurname">First Surname</label>
                                    <input type="text" class="form-control" name="firstSurname" required>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="secondSurname">Second Surname</label>
                                    <input type="text" class="form-control" name="secondSurname" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="payMethod">Pay method</label>
                                    <select name="payMethod" class="form-select" required>
                                        <option selected value="paypal">Paypal</option>
                                        <option value="credit_card">Credit Card</option>
                                        <option value="bank_transfer">Debit Card</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="profilePicture">Profile picture</label>
                                    <input type="file" class="form-control" name="profilePicture" accept="image/*">
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="confirmPassword">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirmPassword" required>
                                </div>

                                <div class="col-12 col-md-6 d-flex align-items-center">
                                    <input type="checkbox" name="interested" id="interested" class="form-check-input me-2">
                                    <label class="form-check-label" for="interested">Interested in distributing content</label>
                                </div>

                                <div class="col-12 col-md-6 d-flex align-items-center">
                                    <input type="checkbox" name="terms" id="terms" required class="form-check-input me-2">
                                    <label class="form-check-label" for="terms">Agree to terms</label>
                                </div>

                                <div class="col-12">
                                    <div class="g-recaptcha" data-sitekey="6LfzikksAAAAANlB-hHh0Lw3ozKIOMAspxtvpA7A"></div>
                                </div>

                                <div class="col-12 text-center">
                                    <button class="btn btn-primary" type="submit">Register</button>
                                </div>

                                <div class="col-12 text-center">
                                    <span class="text-muted">¿Ya tienes cuenta? <a href="./formUserLogin.php">Login</a></span>
                                </div>
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>