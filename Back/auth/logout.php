<?php
require_once '../core/sesiones.php';

logoutUser();
setFlashMessage('success', 'Sesión cerrada exitosamente.');
header('Location: ../../index.php');
exit();
