<?php 
include_once("conexion.php");
include_once("cabecera.php");
$_SESSION["ruta"] = (isset($_GET["ruta"])) ? $_GET["ruta"] : '' ;
$ant = "catalogo";
$bnr = false;
$des = "checkout";
include_once("menu.php");
include_once("cliente.php");
include_once("pie.php");
?>
