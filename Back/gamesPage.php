<!DOCTYPE html>
<html lang="en">
<?php
include_once("../recursos/php/head.php");
$head = new Head("VEX - Games Page", "..");
echo $head->toHTML();
?>
<body>

<?php 
include_once("../recursos/php/header.php");
$header = new Header("..");
echo $header->toHTML();
?>

<main class="container">
    <div class="row">
        <section class="col-4 bg-primary">A</section>
        <section class="col-8 bg-success">B</section>
    </div>
</main>

<?php 
include_once("../recursos/php/footer.php");
$footer = new Footer("..");
echo $footer->toHTML();
?>
</body>

</html>