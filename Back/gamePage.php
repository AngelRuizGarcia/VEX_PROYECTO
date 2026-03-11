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

            <section class="col-12 col-sm-8 col-md-9 col-xl-10" id="game-Container">

            </section>

            <section class="col-12 col-sm-8 col-md-9 col-xl-10" id="pagination-container">

            </section>
        </div>
    </main>

    <?php
    include_once("../recursos/php/footer.php");
    $footer = new Footer("..");
    echo $footer->toHTML();
    ?>

    <script>
        function loadPage(page) {
            fetch(`getGames.php?page=${page}`).then(response => {
                if (!response.ok) throw new Error('Error en la red')
                return response.json();
            }).then(data => {
                reloadTable(data.data);
                reloadPagination(data.actual_page, data.total_pages);
            }).catch(error => {
                console.error('Error: ', error);
                document.getElementById('game-Container').innerHTML = '<p>Error al cargar los datos</p>'
            });
        }

        function reloadTable(game) {
            let html = '<article class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">';
            if (game.length === 0) {
                html += '(CAMBIAR) No hay registros';
            } else {
                game.forEach(g => {
                    html += `<?php
                    $stmtIMG = $conexion->prepare("SELECT id_image, image_path from game_images WHERE :id_game = game_images.id_game LIMIT 1");
                    $stmtIMG->bindParam(":id_game", $a);
                    $stmtIMG->execute();
                    $img = $stmtIMG->fetchAll(PDO::FETCH_OBJ);

                    echo "<div class=\"col-12\">";
                    echo "<div class=\"card h-100 rounded-4\">";
                    echo "<img src=\"../recursos/{$img[0]->image_path}\" class=\"card-img-top rounded-top-4 p-1\" alt=\"IMG\">";
                    echo "<div class=\"card-body\">";
                    echo "<h5 class=\"card-title\"></h5>";
                    echo "<p class=\"card-text\"></p>";
                    echo "</div>";
                    echo "<div class=\"card-footer bg-transparent border-0\">";
                    echo "<small class=\"text-muted\">2</small>";
                    echo "<a href=\"#\" class=\"btn btn-primary float-end\">See More</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    ?>`;
                });
            }

            html += '</article>';
            document.getElementById('game-Container').innerHTML = html;
        }

        function reloadPagination(actual_page, total_pages) {
            let html = '';

            html += `<button onClick="loadPage(${actual_page - 1})" ${actual_page === 1 ? 'disabled' : ''}>Anterior</button>`;

            for (let i = 1; i <= total_pages; i++) {
                html += `<button onClick="loadPage(${i})" class"${i === actual_page ? 'active' : ''}">${i}</button>`;
            }

            html += `<button onClick="loadPage(${actual_page + 1})" ${actual_page === total_pages ? 'disabled' : ''}>Siguiente</button>`;

            document.getElementById('pagination-container').innerHTML = html;
        }

        window.onload = function() {
            loadPage(1);
        };
    </script>
</body>

</html>