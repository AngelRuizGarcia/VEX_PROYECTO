<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("../recursos/php/head.php");
    $header = new Head("VEX - User Login", "..");
    echo $header->toHTML();
    ?>
</head>

<body>
    <div class="container align-items-center d-flex justify-content-center" style="height: 100vh;">
        <form class="form-horizontal row gap-3 text-end border border-dark border-5 rounded-5 p-2" action="./userLoginData.php" method="POST" enctype="multipart/form-data">
            <h2 class="text-center">login form</h2>

            <div class="form-group col-12 row">
                <label class="control-label col-4" for="username">Username:</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="username" required>
                </div>
            </div>

            <div class="form-group col-12 row">
                <label class="control-label col-4" for="password">Password:</label>
                <div class="col-8">
                    <input type="password" class="form-control" name="password">
                </div>
            </div>

            <div class="d-flex justify-content-center align-items-center mt-3">
                <p class="mb-0 me-3">Don't remember your password?</p>
                    <input type="submit" class="btn btn-dark" value="send email" name="volver">
            </div>



            <div class="d-flex justify-content-center">
                <button class="btn btn-dark mt-2" type="submit">LOGIN</button>
            </div>
        </form>
    </div>

</body>

</html>