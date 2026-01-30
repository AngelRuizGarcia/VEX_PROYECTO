<!DOCTYPE html>
<html lang="en">

<head>
<?php
require_once("../recursos/php/head.php");
$header = new Head("VEX - User Login", "..");
echo $header->toHTML();
?>
</head>

<body>
    <form action="loginDatos.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" placeholder="Username">
        <label for="password">Password:</label>
        <input type="password" name="password" placeholder="Password">
        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="Email">
        <button type="submit">LOGIN</button>
    </form>
</body>
</html>