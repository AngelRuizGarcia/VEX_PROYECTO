<?php
require_once("./conexionClaves.php");
$conexion = new PDO($dsn, $usuario, $contraseña);
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$games_per_page = 10;


$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1) $page = 1;

$offset = ($page - 1) * $games_per_page;

$stmt = $conexion->query("SELECT COUNT(*) FROM game");
$total_games = $stmt->fetchColumn();
$total_pages = ceil($total_games / $games_per_page);

$stmt = $conexion->prepare("SELECT id_game, id_user, title, description, price FROM game ORDER BY id_game LIMIT :limit OFFSET :offset");
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