<?php 
include_once("conexion.php");
session_start();
$codigo = isset($_POST['c']) ? $_POST['c'] : '';
$monto = isset($_POST['comision']) ? $_POST['comision'] : 0.00;

$query = "SELECT tit_nombres,tit_apellidos from afiliados WHERE tit_codigo='".$codigo."'";
$result = mysql_query($query,$link);
$row = mysql_fetch_array($result);
$nombre = trim($row["tit_nombres"]).' '.trim($row["tit_apellidos"]);
$cedula = trim($row["tit_cedula"]);
$rif = trim($row["tit_rif"]);
$tipo_persona = trim($row["tipo_persona"]);
$cuenta = trim($row["banco_numero_cta"]);
$banco = trim($row["banco_nombre_bco"]);
$nomcta = trim($row["banco_nombre_cta"]);
$email = trim($row["email"]);

$mensaj1 = '<p>Buen día administrador, '.$nombre.', código de afiliado '.$codigo.' ha solicitado el retiro de Bs. '.number_format($monto,2,',','.').' de sus comisiones, por favor ejecuta la transferencia a la siguiente cuenta:</p>';

$mensaj2 = '<p>Buen día '.$nombre.', se ha enviado una solcitud de retiro por Bs. '.number_format($monto,2,',','.').' de tus comisiones, se realizará una transferencia lo antes posible a la siguiente cuenta:</p>';

$mensaje .= 'Banco: '.$banco.'<br>';
$mensaje .= 'Cuenta: '.$cuenta.'<br>';
$mensaje .= 'A nombre de: '.$nomcta.'<br>';
if ($tipo_persona=="Natural" or $tipo_persona=="Especialista") {
	$mensaje .= 'Cédula: '.$cedula.'<br>';
} else {
	$mensaje .= 'R.I.F.: '.$rif.'<br>';
}
$mensaje .= 'email: '.$email.'<br>';

$asunto = "Solicitud de canje de puntos del club 180";
$cabeceras = 'Content-type: text/html;';
if (strpos($_SERVER["HTTP_HOST"],'localhost')===FALSE) {
	$texto = $mensaj1.$mensaje;	           	
	mail("soluciones2000@gmail.com,ordenesmanna@gmail.com",$asunto,$texto,$cabeceras);
	$texto = $mensaj2.$mensaje;	           	
	mail($email,$asunto,$texto,$cabeceras);
}

echo '<br>';
echo '<br>';
echo '<h2 align="center">Solicitud de retiro enviada exitosamente</h2>';
echo '<p align="center">Se realizará una transferencia lo antes posible.</p>';
echo '<br>';
echo '<form method="post" action="inicio.php?c='.$_SESSION["codigo"].'">';
	echo '<p align="center"><input type="submit" name="ordenar" value="Volver al inicio"></p>';
echo '</form>';

/*
$fecha = date("Y-m-d");
$docum = date("Ymd").trim($codigo);
$mes = date("m");

$query = "INSERT INTO billetera (afiliado, fecmov, mesmov, tipmov, numdoc, tipo_trans, concepto, creditos, debitos) VALUES ('".$codigo."', '".$fecha."', '".$mes."', 'Débito', '".$docum."', 'DA', 'Retiro de comisiones No. ".$docum."', 0.00, ".$monto.")";
echo $query.'<br>';
if ($result = mysql_query($query,$link)) {
	$cadena = 'Location: exito.php';
}
header($cadena);
*/
?>
