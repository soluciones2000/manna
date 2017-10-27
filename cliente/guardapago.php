<?php 
include_once("conexion.php");

$fch = isset($_POST['fecha']) ? $_POST['fecha'] : '';
$mes = substr($fch,3,3);
switch ($mes) {
	case 'Ene':
		$mes = "01";
		break;
	case 'Feb':
		$mes = "02";
		break;
	case 'Mar':
		$mes = "03";
		break;
	case 'Abr':
		$mes = "04";
		break;
	case 'May':
		$mes = "05";
		break;
	case 'Jun':
		$mes = "06";
		break;
	case 'jul':
		$mes = "07";
		break;
	case 'Ago':
		$mes = "08";
		break;
	case 'Sep':
		$mes = "09";
		break;
	case 'Oct':
		$mes = "10";
		break;
	case 'Nov':
		$mes = "11";
		break;
	case 'Dic':
		$mes = "12";
		break;
}

$fecha = substr($fch,-4,4)."-".$mes."-".substr($fch,0,2);
$afiliado = $_SESSION["patroc_codigo"];
$cliente = '';
$cliente_pref = isset($_POST['codclte']) ? $_POST['codclte'] : '';
$tipo = "24";
$precio = isset($_POST['monto']) ? $_POST['monto'] : '';
$monto = 0.00;
$puntos = 0;
$documento = isset($_POST['documento']) ? $_POST['documento'] : '';
$bancoorigen = isset($_POST['bancoorigen']) ? $_POST['bancoorigen'] : '';
$status_comision = "Pendiente";
$orden_id = isset($_POST['orden_id']) ? $_POST['orden_id'] : '0';

$query = "select * from ordenes where orden_id=".trim($orden_id);
$result = mysql_query($query,$link);
if ($row = mysql_fetch_array($result)) {
	$precio_orden = $row["monto"];
	$monto = $row["valor_comisionable"];
	$puntos = $row["puntos"];
	$status_orden = "Cancelada por conciliar";
}

if ($precio<$precio_orden) {
	$monto = 0.00;
	$puntos = 0;
	$status_comision = "No aplica";
	$status_orden = "Parcialmente cancelada";
}

$query = "INSERT INTO transacciones (fecha, afiliado, cliente, cliente_pref, tipo, precio, monto, puntos, documento, bancoorigen, status_comision, orden_id) VALUES ('".$fecha."','".$afiliado."','".$cliente."','".$cliente_pref."','".$tipo."',".$precio.",".$monto.",".$puntos.",'".$documento."','".$bancoorigen."','".$status_comision."',".$orden_id.")";
if ($result = mysql_query($query,$link)) {
	$query = "select id from transacciones where orden_id=".trim($orden_id)." and fecha='".$fecha."'";
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		$id_transaccion = $row["id"];
	} else {
		$id_transaccion = 0;
	}
	$query = "UPDATE ordenes SET id_transaccion=".$id_transaccion.",status_orden='".$status_orden."' WHERE orden_id=".trim($orden_id);
	if ($result = mysql_query($query,$link)) {
		$cadena = 'Location: exito.php'; 
	}
} else {
	$cadena = 'Location: error.php'; 
}
header($cadena);
?>
