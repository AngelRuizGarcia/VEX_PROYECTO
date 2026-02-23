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