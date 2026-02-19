<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("../../../recursos/php/head.php");
    $header = new Head("VEX - Contact Us", "../../../");
    echo $header->toHTML();
    ?>
</head>

<body>
    <div class="container align-items-center d-flex justify-content-center" style="height: 100vh;">
        <form class="form-horizontal row gap-3 text-end border border-dark border-5 rounded-5 p-2" action="./userLoginData.php" method="POST" enctype="multipart/form-data">
            <h2 class="text-center">Contact Us</h2>

            <div class="form-group col-12 row">
                <label class="control-label col-4" for="name">Name:</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="name">
                </div>
            </div>

            <div class="form-group col-12 row">
                <label class="control-label col-4" for="email">Email:</label>
                <div class="col-8">
                    <input type="email" class="form-control" name="email">
                </div>
            </div>

            <div class="form-group col-12 row">
                <label class="control-label col-4" for="message">Message:</label>
                <div class="col-8">
                    <input type="text" id="message" class="form-control" name="message" placeholder="write your message here">
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn btn-dark mt-2" type="submit">SEND EMAIL</button>
            </div>
        </form>
    </div>

</body>

</html>