<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("../recursos/php/head.php");
    $header = new Head("VEX - recover account", "..");
    echo $header->toHTML();
    ?>
</head>

<body>
    <div class="container align-items-center d-flex justify-content-center" style="height: 100vh;">
        <form class="form-horizontal row gap-3 text-end border border-dark border-5 rounded-5 p-2" action="recoveryData.php" method="POST" enctype="multipart/form-data">
            <h2 class="text-center">recovery form</h2>

            <div class="form-group col-12 row">
                <label class="control-label col-4" for="email">Email:</label>
                <div class="col-8">
                    <input type="email" class="form-control" name="email" required>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <button class="btn btn-dark mt-2" type="submit" name="email">SEND EMAIL</button>
            </div>
        </form>
    </div>

</body>

</html>