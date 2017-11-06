<?php 
session_start();
echo '<script type="text/javascript">
	parent.document.getElementById("pm").innerHTML = "PM del mes: '.number_format($_SESSION["pm"],0,',','.').'"; 
	</script>';
echo '<br>';
echo '<br>';
echo '<h2 align="center">Operación realizada exitosamente.</h2>';
echo '<br>';
echo '<form method="post" action="inicio.php">';
	echo '<p align="center"><input type="submit" name="ordenar" value="Volver al inicio"</p>';
echo '</form>';
?>
