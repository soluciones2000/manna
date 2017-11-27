<?php 
$orden = isset($_GET['orden']) ? $_GET['orden'] : '';
include_once("conexion.php");
include_once("cabecera.php");
$ant = "";
$bnr = false;
$des = "";
include_once("menu.php");
if ($orden<>'') {
	echo '<br>';
	echo '<br>';
	echo '<h2 align="center">Operación realizada exitosamente.</h2><br>';
	echo '<p align="center">Se generó la orden No. '.trim(number_format($orden,0,',','.')).', revise su email para ver los detalles.</p>';
	echo '<br>';
} else {
	echo '<br>';
	echo '<br>';
	echo '<h2 align="center">Operación realizada exitosamente.</h2>';
	echo '<br>';
}
echo '<form method="post" action="inicio.php">';
	echo '<p align="center"><input type="submit" name="ordenar" value="Volver al inicio"></p>';
echo '</form>';
include_once("pie.php");
?>
