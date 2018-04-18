<?php 
include_once("conexion.php");
$_SESSION['user'] = '';
$_SESSION['codigo'] = '';
include_once("cabecera.php");
$mensaje = isset($_GET['error']) ? $_GET['error'] : '';
?>

