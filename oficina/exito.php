<?php 
session_start();
$orden = isset($_GET['orden']) ? $_GET['orden'] : '';
echo '<script type="text/javascript">
	parent.document.getElementById("pm").innerHTML = "PM del mes: '.number_format($_SESSION["pm"],0,',','.').'"; 
	parent.document.getElementById("rango").innerHTML = "Rango: '.$_SESSION["rango"].'"; 
	</script>';

if ($_SESSION["flag"]) {
	echo '<h2 align="center">¡¡¡Felicitaciones!!!</h2>';
	echo '<p align="center"><img SRC="logro2.jpg" height="auto" width="30%"></p>';
	echo '<p align="center"><font size="4">Has alcanzado el rango de <b>'.strtoupper($_SESSION["rango"]).'.</b></font></p>';
	echo '<p align="center"><font size="4">A partir de ahora podrás disfrutar de los beneficios de este nuevo nivel, continúa realizando ese excelente trabajo.</font></p>';
	$_SESSION["flag"] = false;
} else {
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
}

echo '<form method="post" action="inicio.php?c='.$_SESSION["codigo"].'">';
	echo '<p align="center"><input type="submit" name="ordenar" value="Volver al inicio"></p>';
echo '</form>';
?>
