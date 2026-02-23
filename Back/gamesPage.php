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

<body class="nunitoFontFamily">

    <?php
    include_once("../recursos/php/header.php");
    $header = new Header("..");
    echo $header->toHTML();
    ?>

    <main class="container-fluid mb-5">
        <div class="row">
            <section class="col-12 col-sm-4 col-md-3 col-xl-2 bg-primary">
                <article class="d-flex justify-content-center mt-4">
                    <label for="num_pages" class="text-white">Show:</label>
                    <select name="num_pages" id="num_pages" class="text-center rounded-pill w-25">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </select>
                    <label for="num_pages" class="ms-2 text-white">games</label>
                </article>
            </section>

            <section class="col-12 col-sm-8 col-md-9 col-xl-10">
                <?php
                try {
                    $stmt = $conexion->prepare("SELECT * FROM game");
                    $stmt->execute();
                    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    echo '<article class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4" id="content">';
                    foreach ($games as $game) {
                        $stmtIMG = $conexion->prepare("SELECT id_image, image_path from game_images WHERE :id_game = game_images.id_game LIMIT 1");
                        $stmtIMG->bindParam(":id_game", $game['id_game']);
                        $stmtIMG->execute();
                        $img = $stmtIMG->fetchAll(PDO::FETCH_OBJ);

                        $title = htmlspecialchars($game['title']);
                        $desc = htmlspecialchars($game['description']);
                        echo "<div class=\"col-12\">";
                        echo "<div class=\"card h-100 rounded-4\">";
                        echo "<img src=\"../recursos/{$img[0]->image_path}\" class=\"card-img-top rounded-top-4 p-1\" alt=\"IMG\">";
                        echo "<div class=\"card-body\">";
                        echo "<h5 class=\"card-title\">{$title}</h5>";
                        echo "<p class=\"card-text\">{$desc}</p>";
                        echo "</div>";
                        echo "<div class=\"card-footer bg-transparent border-0\">";
                        echo "<small class=\"text-muted\">{$game['price']}</small>";
                        echo "<a href=\"#\" class=\"btn btn-primary float-end\">See More</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    echo '</article>';
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