<?php 
session_start();
echo '<br>';
echo '<br>';
echo '<h2 align="center">Muy pronto podrás administrar tu cuenta Manna en esta página.</h2>';
echo '<br>';
echo '<form method="post" action="inicio.php?c='.$_SESSION["codigo"].'">';
	echo '<p align="center"><input type="submit" name="ordenar" value="Volver al inicio"></p>';
echo '</form>';
?>
