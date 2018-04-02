<?php 
session_start();
include_once("conexion.php");
include_once("funciones.php");

$prod = isset($_GET['prd']) ? strtoupper($_GET['prd']) : '';

$_SESSION["orden"][$prod] += 1;
$_SESSION["cantidad"] += 1;
$cadena = 'Location: catalogo.php';
header($cadena);
?>
