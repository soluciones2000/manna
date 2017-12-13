<?php 
include_once("conexion.php");
include_once("funciones.php");
$fch = isset($_POST['fecha']) ? $_POST['fecha'] : '';
$codigo = isset($_POST['c']) ? $_POST['c'] : '';
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

//$fecha = substr($fch,7,4)."-".$mes."-".substr($fch,0,2);
$fecha = $fch;
$mes = substr($fecha,5,2);
$afiliado = $codigo;
$cliente = $afiliado;
$cliente_pref = '';
$tipo = "31";
$precio =isset($_POST['monto']) ? $_POST['monto'] : '';
$monto = 0.00;
$puntos = 0;
$documento = isset($_POST['documento']) ? $_POST['documento'] : '';
$bancoorigen = isset($_POST['bancoorigen']) ? $_POST['bancoorigen'] : '';
$status_comision = "No aplica";

$query = "INSERT INTO billetera (afiliado, fecmov, mesmov, tipmov, numdoc, tipo_trans, concepto, creditos, debitos) VALUES ('".$codigo."', '".$fecha."', '".$mes."', 'Crédito', '".$documento."', 'CB', 'Abono a cuenta comprobante No. ".$documento."', ".$precio.", 0.00)";
echo $query.'<br>';
if ($result = mysql_query($query,$link)) {
	$query = "select id from billetera where numdoc='".trim($documento)."' and fecmov='".$fecha."'";
	echo $query.'<br>';
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		$trans_billetera = $row["id"];
	} else {
		$trans_billetera = 0;
	}
}

$query = "INSERT INTO transacciones (fecha, afiliado, cliente, cliente_pref, tipo, precio, monto, puntos, valor_punto, documento, bancoorigen, status_comision, orden_id) VALUES ('".$fecha."','".$codigo."','".$codigo."','','".$tipo."',".$precio.",".$monto.",".$puntos.",".$_SESSION["valor_punto"].",'".$documento."','Billetera','".$status_comision."',".$trans_billetera.")";
echo $query.'<br>';
$result = mysql_query($query,$link);

$cadena = 'Location: exito.php';
//header($cadena);
?>
