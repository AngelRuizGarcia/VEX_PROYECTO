<!DOCTYPE html>
<html lang="en">

<head>
<?php
require_once("../recursos/php/head.php");
$header = new Head("VEX - User Register", "..");
echo $header->toHTML();
?>
</head>

<body>
    <div class="container">
        <form class="form-horizontal row gap-3 text-end border border-dark border-5 rounded-5 p-2" action="./userRegisterData.php" method="POST" enctype="multipart/form-data">
            <h2 class="text-center">Register form</h2>

            <div class="form-group col-12 row">
                <label class="control-label col-4" for="username">Username:</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="username" required>
                </div>
            </div>

            <div class="form-group col-12 row">
                <label class="control-label col-4" for="email">Email:</label>
                <div class="col-8">
                    <input type="email" class="form-control" name="email" required>
                </div>
            </div>


            <div class="form-group col-12 row">
                <label class="control-label col-4" for="name">Name:</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="name" required>
                </div>
            </div>

            <div class="form-group col-12 row">
                <label class="control-label col-4" for="firstSurname">First Surname:</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="firstSurname" required>
                </div>
            </div>

            <div class="form-group col-12 row">
                <label class="control-label col-4" for="secondSurname">Second Surname:</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="secondSurname" required>
                </div>
            </div>
            
            <div class="form-group col-12 row">
                <label class="control-label col-4" for="password">Pay Method:</label>
                <div class="col-8">
                    <select name="payMethod" class="form-select" required>
                        <option selected value="paypal">Paypal</option>
                        <option value="credit_card">Credit Card</option>
                        <option value="bank_trasnfer">Debit Card</option>
                    </select>
                </div>
            </div>

            <div class="form-group col-12 row">
                <label class="formFile col-4" for="password">Profile picture:</label>
                <div class="col-8">
                    <input type="file" class="form-control" name="profilePicture" accept="image/*">
                </div>

            </div>

            <div class="form-group col-12 row">
                <label class="control-label col-4" for="password">Password:</label>
                <div class="col-8">
                    <input type="password" class="form-control" name="password" required>
                </div>
            </div>

            <div class="form-group col-12 row">
                <label class="control-label col-4" for="confirmPassword">Confirm Password:</label>
                <div class="col-8">
                    <input type="password" class="form-control" name="confirmPassword" required>
                </div>
            </div>

            <div class="form-group col-12 row">
                <label class="control-label col-10" for="interested">I am interested in distributing content on VEX</label>
                <input type="checkbox" name="interested" class="col-2">
            </div>

            <div class="form-group col-12 row">
                <label class="control-label col-10" for="terms">I agree to the terms and conditions</label>
                <input type="checkbox" name="terms" required class="col-2">
            </div>

            <div class="g-recaptcha" data-sitekey="6LfzikksAAAAANlB-hHh0Lw3ozKIOMAspxtvpA7A"></div>
            <div class="d-flex justify-content-center">
                <button class="btn btn-dark mt-4" type="submit">REGISTER</button>
            </div>
        </form>
    </div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>