<?php 
session_start();
echo '<br>';
echo '<br>';
echo '<h2 align="center">Ha ocurrido un error, por favor comuniquese con soporte técnico.</h2>';
echo '<h3 align="center">'.$_GET["error"].'</h3>';
echo '<br>';
echo '<form method="post" action="inicio.php?c='.$_SESSION["codigo"].'">';
	echo '<p align="center"><input type="submit" name="ordenar" value="Volver al inicio"></p>';
echo '</form>';
?>
