<?php 
include_once("conexion.php");
session_start();

$fch = isset($_GET['fch']) ? $_GET['fch'] : '';
$fecha = $fch;
$mes = substr($fecha,5,2);
$afiliado = $_SESSION["codigo"];
$cliente = $afiliado;
$cliente_pref = '';
$tipo = "04";
$precio =isset($_GET['mnt']) ? $_GET['mnt'] : '';
$monto = 0.00;
$puntos = 0;
$documento = $_GET['tk'];
$bancoorigen = 'Pago flash';
$status_comision = "Pendiente";
$orden_id = isset($_GET['ord']) ? $_GET['ord'] : '0';

$query = "select * from ordenes where orden_id=".trim($orden_id);
$result = mysql_query($query,$link);
if ($row = mysql_fetch_array($result)) {
	$precio_orden = $row["monto"];
	$monto = $row["valor_comisionable"];
	$puntos = $row["puntos"];
	$status_orden = "Cancelada por conciliar";
}

if ($precio<$precio_orden) {
	$tipo = "03";
	$monto = 0.00;
	$puntos = 0;
	$status_comision = "No aplica";
	$status_orden = "Parcialmente cancelada";
	$saldo = $precio_orden-$precio;

	$query = "INSERT INTO transacciones (fecha, afiliado, cliente, cliente_pref, tipo, precio, monto, puntos, valor_punto, documento, bancoorigen, status_comision, orden_id) VALUES ('".$fecha."','".$afiliado."','".$cliente."','".$cliente_pref."','".$tipo."',".$precio.",".$monto.",".$puntos.",".$_SESSION["valor_punto"].",'".$documento."','".$bancoorigen."','".$status_comision."',".$orden_id.")";

	if ($result = mysql_query($query,$link)) {
		$quer2 = "select id from transacciones where orden_id=".trim($orden_id)." and fecha='".$fecha."'";

		$resul2 = mysql_query($quer2,$link);
		if ($row = mysql_fetch_array($resul2)) {
			$idtran = $row["id"];
		} else {
			$idtran = 0;
		}

		$query = "UPDATE ordenes SET id_transaccion=".$idtran.",monto=".$saldo.", status_orden='".$status_orden."' WHERE orden_id=".trim($orden_id);
		$result = mysql_query($query,$link);
	}
} else {
	$query = "INSERT INTO transacciones (fecha, afiliado, cliente, cliente_pref, tipo, precio, monto, puntos, valor_punto, documento, bancoorigen, status_comision, orden_id) VALUES ('".$fecha."','".$afiliado."','".$cliente."','".$cliente_pref."','".$tipo."',".$precio.",".$monto.",".$puntos.",".$_SESSION["valor_punto"].",'".$documento."','".$bancoorigen."','".$status_comision."',".$orden_id.")";
	if ($result = mysql_query($query,$link)) {
		$query = "select id from transacciones where orden_id=".trim($orden_id)." and fecha='".$fecha."'";
		$result = mysql_query($query,$link);
		if ($row = mysql_fetch_array($result)) {
			$id_transaccion = $row["id"];
		} else {
			$id_transaccion = 0;
		}

		if ($precio>$precio_orden) {
			$nc = $precio-$precio_orden;
			$query = "INSERT INTO billetera (afiliado, fecmov, mesmov, tipmov, numdoc, tipo_trans, concepto, creditos, debitos) VALUES ('".$afiliado."', '".$fecha."', '".$mes."', 'Crédito', '".$documento."', 'CC', 'Abono a cuenta comprobante No. ".$documento."', ".$nc.", 0.00)";
			$result = mysql_query($query,$link);
		}
		$query = "UPDATE ordenes SET id_transaccion=".$id_transaccion.",monto=0.00, status_orden='".$status_orden."' WHERE orden_id=".trim($orden_id);
		if ($result = mysql_query($query,$link)) {

			$quer0 = "select tit_nombres,tit_apellidos,tipo_afiliado from afiliados where tit_codigo='".$afiliado."'";
			$resul0 = mysql_query($quer0,$link);
			$ro0 = mysql_fetch_array($resul0);
			$afil_nombres = trim($ro0["tit_nombres"])." ".trim($ro0["tit_apellidos"]);
			$tipo_afil = $ro0["tipo_afiliado"];

			$querx = "select * from patrocinio where tit_codigo='".$afiliado."'";
			$resulx = mysql_query($querx,$link);
			$rox = mysql_fetch_array($resulx);
			$fecha_afiliacion = $rox["fecha_afiliacion"];
			$fecha_fin_bono = $rox["fecha_fin_bono"];

			$_SESSION['pm'] += $puntos;

		}
	}
}
header("Location: exito.php");
?>
