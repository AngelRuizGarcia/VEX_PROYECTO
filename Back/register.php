<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
    <link rel="stylesheet" href="../recursos/bootstrap/css/bootstrap.css">
    <script src="../recursos/bootstrap/js/bootstrap.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">


    <style>
        .luckiest-guy-regular {
            font-family: "Luckiest Guy" !important;
            font-weight: 400 !important;
            font-style: normal !important;
        }

        * {
            text-transform: uppercase;
            font-family: "Luckiest Guy";
            letter-spacing: 3px;
            paint-order: stroke fill;
            -webkit-text-fill-color: white;
            -webkit-text-stroke-width: 5px;
            -webkit-text-stroke-color: black;
            font-size: 1.2rem;

        }

        input {
            font-size: 0.8rem;
        }
        h2{
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Register form</h2>
        <form class="form-horizontal" action="registerDatos.php" method="POST">

            <div class="form-group d-flex">
                <label class="control-label col-sm-2" for="username">Username:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="username" required>
                </div>
            </div>

            <div class="form-group d-flex mt-5">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" required>
                </div>
            </div>


            <div class="form-group d-flex mt-5">
                <label class="control-label col-sm-2" for="name">Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" required>
                </div>
            </div>

            <div class="form-group d-flex mt-5">
                <label class="control-label col-sm-2" for="firstSurname">First Surname:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="firstSurname" required>
                </div>
            </div>

            <div class="form-group d-flex mt-5">
                <label class="control-label col-sm-2" for="secondSurname">Second Surname:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="secondSurname" required>
                </div>
            </div>

            <div class="form-group d-flex mt-5">
                <label class="control-label col-sm-2" for="password">Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" required>
                </div>
            </div>

            <div class="form-group d-flex mt-5">
                <label class="control-label col-sm-2" for="confirmPassword">Confirm Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="confirmPassword" required>
                </div>
            </div>

            <div class="form-group d-flex mt-5">
                <label class="control-label col-sm-2" for="dni">DNI:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="dni" required>
                </div>
            </div>

            <label class="control-label mb-4 mt-5" for="interested">I am interested in distributing content on VEX</label>
            <input type="checkbox" name="interested">
            <br>
            <label class="control-label" for="terms">I agree to the terms and conditions</label>
            <input type="checkbox" name="terms" required>
            <br>
            <br>
            <div class="g-recaptcha" data-sitekey="6LfzikksAAAAANlB-hHh0Lw3ozKIOMAspxtvpA7A"></div>
            <div class="d-flex justify-content-center">
            <button class="btn btn-dark mt-4" type="submit">REGISTER</button>
            </div>
        </form>
    </div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>