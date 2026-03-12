<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VEXI</title>
    <link rel="stylesheet" href="./recursos/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./recursos/bootstrap/icons/bootstrap-icons.css">
    <script src="./recursos/bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="./recursos/css/fontStyle.css">
    <link rel="stylesheet" href="./recursos/css/index.css">
</head>

<body>
    <?php
    include_once("./recursos/php/header.php");
    $header = new Header(".");
    echo $header->toHTML();
    ?>

    <main class="container-fluid">
        <div class="row">
            <div class="col-xxl-3 col-xl-3 col-12"></div>
            <div class="col-xxl-6 col-xl-6 col-12">
                <div class="p-3 text-center fs-3 text-justify">VEX is the platform where indie developers can earn
                    rewards from visits to their games.</div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-12"></div>
        </div>
        <div class="row gap-3 justify-content-center m-2">
            <div class="card border-dark border-3 rounded col-xxl-3 col-xl-3 col-12 text-center">
                <div class="card-body">
                    <h5 class="card-title pb-2 fs-3">Indie Community</h5>
                    <p class="card-text fs-5">Connect with other indie developers, receive feedback, and grow alongside
                        the
                        community.</p>
                </div>
            </div>
            <div class="card border-dark border-3 rounded col-xxl-3 col-xl-3 col-12 text-center">
                <div class="card-body">
                    <h5 class="card-title pb-2 fs-3">For beginners</h5>
                    <p class="card-text fs-5">Designed for less experienced developers. Show off your first game and
                        start
                        building your portfolio.</p>
                </div>
            </div>
            <div class="card border-dark border-3 rounded col-xxl-3 col-xl-3 col-12 text-center">
                <div class="card-body">
                    <h5 class="card-title pb-2 fs-3">Earn by visits</h5>
                    <p class="card-text fs-5">Receive financial rewards based on the number of visits your game
                        receives.
                        More visits = more earnings.</p>
                </div>
            </div>
        </div>
    </main>
    <?php
    include_once("./recursos/php/footer.php");
    $footer = new Footer("./");
    echo $footer->toHTML();
    ?>
</body>

</html>