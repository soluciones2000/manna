
<?php 
include_once("conexion.php");
include_once("funciones.php");
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

//$fecha = substr($fch,7,4)."-".$mes."-".substr($fch,0,2);
$fecha = $fch;
$mes = substr($fecha,5,2);
$afiliado = $_SESSION["codigo"];
$cliente = $afiliado;
$cliente_pref = '';
$precio =isset($_POST['monto']) ? $_POST['monto'] : '';
$documento = isset($_POST['documento']) ? $_POST['documento'] : '';
$bancoorigen = isset($_POST['bancoorigen']) ? $_POST['bancoorigen'] : '';
$orden_id = isset($_POST['orden_id']) ? $_POST['orden_id'] : '0';

$query = "select * from ordenes where orden_id=".trim($orden_id);
$result = mysql_query($query,$link);
if ($row = mysql_fetch_array($result)) {
	$precio_orden = $row["monto"];
	$monto = $row["valor_comisionable"];
	$puntos = $row["puntos"];
} else {
	$precio_orden = 0.00;
	$monto = 0.00;
	$puntos = 0.00;
}

/* 
Si el monto pagado ($precio) es menor que el monto de la orden ($precio_orden) => código 03 (nota de crédito), 
Si es igual al monto de la orden => cancela la orden (código 04)
Si es mayor se cancela la orden (código 04) y se genera una nota de crédito a la billetera por concepto de pago de más 'CC'
Si $precio_orden es 0.00 no hace nada
*/
if ($precio_orden<>0.00) {
	$idtran = transaccion($link,$precio,$precio_orden,$fecha,$afiliado,$cliente,$monto,$puntos,$documento,$bancoorigen,$orden_id);

	/*
	Se actualiza el saldo de la orden dependiendo del monto pagado
	*/
	$saldo = actualiza_saldo_orden($link,$idtran,$precio,$precio_orden,$orden_id);
}

if ($precio>=$precio_orden) {
	/*
	Si pagó un monto igual a la orden o por encima se actualiza toda la red
	*/
	// Si queda un saldo luego de cancelar la órden se registra una nota de crédito en la billetera
	if ($saldo<0.00) {
		$tipmov = 'Crédito';
		$tipo_trans = 'CC';
		$concepto = 'Abono a cuenta comprobante No. '.trim($documento);
		$creditos = $saldo*(-1);
		$debitos = 0.00;
		billetera($link,$afiliado,$fecha,$mes,$tipmov,$documento,$tipo_trans,$concepto,$creditos,$debitos);
	}
	// Buscar en la red de patrocinados la fecha de caducidad del bono de patrocinio
	$querx = "select * from patrocinio where tit_codigo='".$afiliado."'";
	$resulx = mysql_query($querx,$link);
	$rox = mysql_fetch_array($resulx);
	$fecha_afiliacion = $rox["fecha_afiliacion"];
	$fecha_fin_bono = $rox["fecha_fin_bono"];

	// Verifica si el bono está vigente
	if (date('Y-m-d')<=$fecha_fin_bono) {
		bono_patrocinio($link,$afiliado,$precio,$fecha_afiliacion,$fecha_fin_bono,$fecha,$idtran);
	} else {
		bono_unilevel($link,$afiliado,$fecha,$precio_orden,$precio,$idtran);
	}

	calificacion($afiliado,$_SESSION['pm'],$_SESSION['pmo'],$link);

	bono_de_reembolso($link,$afiliado,$fecha,$precio_orden,$precio,$puntos,$idtran);

	bono_aci_potencial($link,$afiliado,$_SESSION['pm'],$puntos,$orden_id,$fecha,$idtran);

	$_SESSION['pm'] += $puntos;
}

$cadena = 'Location: exito.php';
header($cadena);
?>
