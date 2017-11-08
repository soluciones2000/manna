<?php 
include_once("conexion.php");
session_start();
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';
$puntos = isset($_POST['puntos']) ? $_POST['puntos'] : '';

$query = "SELECT tit_nombres,tit_apellidos from afiliados WHERE tit_codigo='".$codigo."'";
$result = mysql_query($query,$link);
$row = mysql_fetch_array($result);
$nombre = trim($row["tit_nombres"]).' '.trim($row["tit_apellidos"]);

$mensaje = 'Buen día administrador, '.$nombre.', código de afiliado '.$codigo.' ha solicitado el canje de '.number_format($puntos,2,',','.').' del club 180, por favor evalúa el caso y ejecuta el canje si procede.';
$asunto = "Solicitud de canje de puntos del club 180";
$cabeceras = 'Content-type: text/html;';
if (strpos($_SERVER["HTTP_HOST"],'localhost')===FALSE) {	           	
	mail("soluciones2000@gmail.com,ordenesmanna@gmail.com",$asunto,$mensaje,$cabeceras);
}

echo '<br>';
echo '<br>';
echo '<h2 align="center">Solicitud de canje enviada exitosamente</h2>';
echo '<p align="center">Se evaluará el caso y se generará la nota de crédito si procede.</p>';
echo '<br>';
echo '<form method="post" action="inicio.php?c='.$_SESSION["codigo"].'">';
	echo '<p align="center"><input type="submit" name="ordenar" value="Volver al inicio"></p>';
echo '</form>';
?>
