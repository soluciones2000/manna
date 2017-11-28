<?php 
include_once("conexion.php");
include_once("cabecera.php");
$promo_id = isset($_POST['promo_id']) ? $_POST['promo_id'] : '';
$ticket = isset($_POST['ticket']) ? $_POST['ticket'] : '00000';
$cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '00000000';
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';

$quer0 = "select max(ticket) as maxtkt from tickets WHERE promo_id=".$promo_id;
echo $quer0.'<br>';
if ($resul0 = mysql_query($quer0,$link)) {
	$ro0 = mysql_fetch_array($resul0);
	$tkt = $ro0["maxtkt"];
} else {
	$tkt = $ticket;
}
$tkt = $tkt + 1;
$newtkt = str_pad($tkt,5,'0',STR_PAD_LEFT);
echo $newtkt.'<br>';


// $quer1 = "UPDATE tickets SET codigo='".trim($codigo)."', cedula='".trim($cedula)."', nombre='".trim($nombre)."', direccion='".trim($direccion)."', telefono='".trim($telefono)."', email='".trim($email)."' WHERE promo_id=".$promo_id." and ticket='".$ticket."'";
$quer1 = "INSERT INTO tickets (promo_id, ticket, codigo, cedula, nombre, direccion, telefono, email) VALUES (".$promo_id.", '".$newtkt."', '".$codigo."', '".$cedula."', '".$nombre."', '".$direccion."', '".$telefono."', '".$email."')";
echo $quer1.'<br>';
$resul1 = mysql_query($quer1,$link);


// $quer2 = "SELECT * FROM tickets where promo_id=".$promo_id." and ticket='".$ticket."' and cedula='".$cedula."'";
$quer2 = "SELECT * FROM tickets where promo_id=".$promo_id." and ticket='".$newtkt."' and cedula='".$cedula."'";
echo $quer2.'<br>';
$resul2 = mysql_query($quer2,$link);
if ($ro2 = mysql_fetch_array($resul2)) {
	$id = $ro2["id"];
	$cadena = "Location: pedidopromo.php?id=".trim($id); 
	header($cadena);
} else {
	$st = 'rnsa';
	$cadena = "Location: index.php?st=".trim($st); 
	header($cadena);
}
?>
