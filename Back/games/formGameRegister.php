<?php
require_once("../core/sesiones.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
require_once("../../recursos/php/head.php");
$header = new Head("VEX - Upload Game", "../..");
echo $header->toHTML();
?>
</head>

<body class="nunitoFontFamily">
    <?php
    include_once("../../recursos/php/header.php");
    $header = new Header("../..");
    echo $header->toHTML();

    require_once("../core/conexionClaves.php");

    $conexion = new PDO($dsn, $usuario, $contraseña);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mostrar flash messages
    $success = getFlashMessage('success');
    $error = getFlashMessage('error');
    ?>

    <main class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card shadow-sm rounded-4">
                    <div class="card-body">
                        <h1 class="h3 mb-4 text-center">Upload your game</h1>

                        <?php
                        if ($success) {
                            echo "<div class='alert alert-success'>$success</div>";
                        }
                        if ($error) {
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                        ?>

                        <form action="gameRegisterData.php" method="post" enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Game title" required>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label">Pricing</label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="pricing" id="paid" value="Paid" required onchange="togglePricing()">
                                            <label class="form-check-label" for="paid">Paid</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="pricing" id="free" value="Free" required onchange="togglePricing()">
                                            <label class="form-check-label" for="free">Free</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" name="price" id="price" class="form-control" step="0.01" value="0.00" readonly>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="gameFile" class="form-label">Game file</label>
                                    <input type="file" name="gameFile" id="gameFile" class="form-control" required>
                                    <small class="form-text text-muted">Max 10GB</small>
                                </div>

                                <div class="col-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="genre" class="form-label">Genre</label>
                                    <select name="genre[]" id="genre" class="form-select" multiple>
                                        <?php
                                        $sql = "SELECT * FROM `genre`;";
                                        $sentenciaGenero = $conexion->prepare($sql);
                                        $sentenciaGenero->execute();
                                        while ($fila = $sentenciaGenero->fetch()) {
                                            $categoria = $fila["name"];
                                            echo "<option value='$categoria'>$categoria</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="tags" class="form-label">Tags</label>
                                    <select name="tags[]" id="tags" class="form-select" multiple>
                                        <?php
                                        $sql = "SELECT * FROM `tag`;";
                                        $sentenciaTags = $conexion->prepare($sql);
                                        $sentenciaTags->execute();
                                        while ($fila = $sentenciaTags->fetch()) {
                                            $tags = $fila["name"];
                                            echo "<option value='$tags'>$tags</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="coverImage" class="form-label">Cover image</label>
                                    <input type="file" name="coverImage" id="coverImage" class="form-control">
                                    <small class="form-text text-muted">Optional</small>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="screenshots" class="form-label">Screenshots</label>
                                    <input type="file" name="screenshots[]" id="screenshots" class="form-control" multiple>
                                    <small class="form-text text-muted">Optional (min 3 recommended)</small>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Upload Game</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php
    include_once("../../recursos/php/footer.php");
    $footer = new Footer("../..");
    echo $footer->toHTML();
    ?>

    <script>
    function togglePricing() {
        const paid = document.getElementById('paid').checked;
        const free = document.getElementById('free').checked;
        const priceInput = document.getElementById('price');
        if (free) {
            priceInput.value = '0.00';
            priceInput.readOnly = true;
        } else if (paid) {
            priceInput.value = '';
            priceInput.readOnly = false;
        }
    }
    </script>
</body>

</html>