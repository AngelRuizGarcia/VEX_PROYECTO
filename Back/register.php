<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
    <link rel="stylesheet" href="../recursos/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../recursos/bootstrap/icons/bootstrap-icons.css">
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
            font-size: 1.3rem;

        }
    </style>
</head>

<body>
    <div class="container">
        <form class="form-horizontal row gap-3 text-end border border-dark border-5 rounded-5 p-2 m-1" action="registerDatos.php" method="POST">
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