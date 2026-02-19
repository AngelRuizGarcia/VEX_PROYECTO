<?php
require_once("./conexionClaves.php");
$conexion = new PDO($dsn, $usuario, $contraseña);
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$limit = isset($_POST['num_pages']);

$stmtLimit = "LIMIT $limit";


$stmt = "SELECT * FROM game $stmtLimit";
?>