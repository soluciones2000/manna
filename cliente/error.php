<?php 
include_once("conexion.php");
include_once("cabecera.php");
$ant = "";
$bnr = false;
$des = "";
include_once("menu.php");
session_destroy();
echo '<br>';
echo '<br>';
echo '<h2 align="center">Ha ocurrido un error, por favor comuniquese con soporte técnico.</h2>';
echo '<br>';
echo '<form method="post" action="index.php">';
	echo '<p align="center"><input type="submit" name="ordenar" value="Volver al inicio"></p>';
echo '</form>';
include_once("pie.php");
?>
