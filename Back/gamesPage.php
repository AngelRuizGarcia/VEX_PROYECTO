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

            <section class="col-12 col-sm-8 col-md-9 col-xl-9">
                <article class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4" id="content">
                    <!-- Games will be loaded here via AJAX -->
                </article>
                <div id="pagination-container" class="d-flex justify-content-center mt-4"></div>
            </section>
        </div>
    </main>

    <?php
    include_once("../recursos/php/footer.php");
    $footer = new Footer("..");
    echo $footer->toHTML();
    ?>

    <script>
        let currentPage = 1;
        let gamesPerPage = 10;

        function loadPage(page, numPages = gamesPerPage) {
            fetch(`getGames.php?page=${page}&num_pages=${numPages}`).then(response => {
                if (!response.ok) throw new Error('Error en la red');
                return response.json();
            }).then(data => {
                reloadContent(data.data);
                reloadPagination(data.actual_page, data.total_pages);
                currentPage = data.actual_page;
            }).catch(error => {
                console.error('Error: ', error);
                document.getElementById('content').innerHTML = '<p>Error al cargar los datos</p>';
            });
        }

        function reloadContent(games) {
            let html = '';
            if (games.length === 0) {
                html = '<div class="col-12"><p>No hay juegos disponibles</p></div>';
            } else {
                games.forEach(game => {
                    const title = game.title ? game.title.replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';
                    const desc = game.description ? game.description.replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';
                    const price = game.price || 'N/A';
                    const imgPath = game.image_path ? `../recursos/${game.image_path}` : '../recursos/img/placeholder.jpg'; // Assuming a placeholder
                    html += `
                        <div class="col-12">
                            <div class="card h-100 rounded-4">
                                <img src="${imgPath}" class="card-img-top rounded-top-4 p-0" alt="IMG">
                                <div class="card-body">
                                    <h5 class="card-title">${title}</h5>
                                    <p class="card-text">${desc}</p>
                                </div>
                                <div class="card-footer bg-transparent border-0">
                                    <small class="text-muted">${price}</small>
                                    <a href="#" class="btn btn-primary float-end">See More</a>
                                </div>
                            </div>
                        </div>
                    `;
                });
            }
            document.getElementById('content').innerHTML = html;
        }

        function reloadPagination(actual_page, total_pages) {
            let html = '';
            if (total_pages > 1) {
                html += `<button onclick="loadPage(${actual_page - 1})" ${actual_page === 1 ? 'disabled' : ''} class="btn btn-secondary me-2">Anterior</button>`;

                const startPage = Math.max(1, actual_page - 2);
                const endPage = Math.min(total_pages, actual_page + 2);

                if (startPage > 1) {
                    html += `<button onclick="loadPage(1)" class="btn btn-outline-primary me-1">1</button>`;
                    if (startPage > 2) html += '<span class="me-1">...</span>';
                }

                for (let i = startPage; i <= endPage; i++) {
                    html += `<button onclick="loadPage(${i})" class="btn ${i === actual_page ? 'btn-primary' : 'btn-outline-primary'} me-1">${i}</button>`;
                }

                if (endPage < total_pages) {
                    if (endPage < total_pages - 1) html += '<span class="me-1">...</span>';
                    html += `<button onclick="loadPage(${total_pages})" class="btn btn-outline-primary me-1">${total_pages}</button>`;
                }

                html += `<button onclick="loadPage(${actual_page + 1})" ${actual_page === total_pages ? 'disabled' : ''} class="btn btn-secondary ms-2">Siguiente</button>`;
            }
            document.getElementById('pagination-container').innerHTML = html;
        }

        document.getElementById('num_pages').addEventListener('change', function() {
            gamesPerPage = parseInt(this.value);
            loadPage(1, gamesPerPage);
        });

        window.onload = function() {
            loadPage(1);
        };
    </script>
</body>

</html>