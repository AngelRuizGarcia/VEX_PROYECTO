<?php
require_once("./conexionClaves.php");
$conexion = new PDO($dsn, $usuario, $contraseña);
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$games_per_page = isset($_GET['num_pages']) ? (int)$_GET['num_pages'] : 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1) $page = 1;

$offset = ($page - 1) * $games_per_page;

// Obtener filtros
$selectedGenre = isset($_GET['genre']) ? $_GET['genre'] : null;
$selectedTag = isset($_GET['tag']) ? $_GET['tag'] : null;

// Construir la consulta con filtros
$where = "WHERE 1=1";
$params = [];

if ($selectedGenre) {
    $where .= " AND g.id_game IN (SELECT id_game FROM game_genre WHERE id_genre = (SELECT id_genre FROM genre WHERE name = :genre))";
    $params[':genre'] = $selectedGenre;
}

if ($selectedTag) {
    $where .= " AND g.id_game IN (SELECT id_game FROM game_tag WHERE id_tag = (SELECT id_tag FROM tag WHERE name = :tag))";
    $params[':tag'] = $selectedTag;
}

// Contar total de juegos con filtros
$countQuery = "SELECT COUNT(*) FROM game g " . $where;
$countStmt = $conexion->prepare($countQuery);
foreach ($params as $key => $value) {
    $countStmt->bindValue($key, $value);
}
$countStmt->execute();
$total_games = $countStmt->fetchColumn();
$total_pages = ceil($total_games / $games_per_page);

// Obtener los juegos con filtros
$query = "SELECT g.id_game, g.id_user, g.title, g.description, g.price, gi.image_path FROM game g LEFT JOIN game_images gi ON g.id_game = gi.id_game AND gi.id_image = (SELECT MIN(id_image) FROM game_images WHERE id_game = g.id_game) " . $where . " ORDER BY g.id_game LIMIT :limit OFFSET :offset";
$stmt = $conexion->prepare($query);
foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}
$stmt->bindParam(':limit', $games_per_page, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode([
    'data' => $games,
    'total_pages' => $total_pages,
    'actual_page' => $page
]);

?>