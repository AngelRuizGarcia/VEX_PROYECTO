<!DOCTYPE html>
<html lang="en">
<?php
include_once("../recursos/php/head.php");
$head = new Head("VEX - Games Page", "..");
echo $head->toHTML();

require_once("./conexionClaves.php");
$conexion = new PDO($dsn, $usuario, $contraseña);
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

<body>

    <?php
    include_once("../recursos/php/header.php");
    $header = new Header("..");
    echo $header->toHTML();
    ?>

    <main class="container-fluid mb-5">
        <div class="row">
            <section class="col-2 bg-primary">
            </section>

            <section class="col-10">
                <?php
                try {
                    $stmt = $conexion->prepare("SELECT * FROM game");
                    $stmt->execute();
                    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    echo '<article class="row row-cols-2 row-cols-md-2 g-4">'; // open cards row
                    // Use Bootstrap cards for each game
                    foreach ($games as $game) {
                        $title = htmlspecialchars($game['title']);
                        $desc = htmlspecialchars($game['description']);
                        echo "<div class=\"col\">";
                        echo "<div class=\"card h-100 shadow-sm\">";
                        echo "<div class=\"card-body\">";
                        echo "<h5 class=\"card-title\">{$title}</h5>";
                        echo "<p class=\"card-text text-muted\">{$desc}</p>";
                        echo "</div>"; // card-body
                        echo "<div class=\"card-footer bg-transparent border-0\">";
                        echo "<small class=\"text-muted\">{$game['price']}</small>";
                        echo "<a href=\"#\" class=\"btn btn-primary float-end\">See More</a>";
                        echo "</div>"; // card-footer
                        echo "</div>"; // card
                        echo "</div>"; // col
                    }
                    echo '</article>'; // close cards row
                } catch (PDOException $e) {
                    die("Error en la conexión: " . $e->getMessage());
                }
                ?>
            </section>
        </div>
    </main>

    <?php
    include_once("../recursos/php/footer.php");
    $footer = new Footer("..");
    echo $footer->toHTML();
    ?>
</body>

</html>