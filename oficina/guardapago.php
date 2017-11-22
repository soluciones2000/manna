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
$afiliado = $_SESSION["codigo"];
$cliente = $afiliado;
$cliente_pref = '';
$tipo = "04";
$precio =isset($_POST['monto']) ? $_POST['monto'] : '';
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

$query = "INSERT INTO transacciones (fecha, afiliado, cliente, cliente_pref, tipo, precio, monto, puntos, valor_punto, documento, bancoorigen, status_comision, orden_id) VALUES ('".$fecha."','".$afiliado."','".$cliente."','".$cliente_pref."','".$tipo."',".$precio.",".$monto.",".$puntos.",".$_SESSION["valor_punto"].",'".$documento."','".$bancoorigen."','".$status_comision."',".$orden_id.")";
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

		if (date('Y-m-d')<=$fecha_fin_bono) {
			$query = "SELECT * from redpatrocinios where afiliado='".$afiliado."' and nivel>'0' AND nivel<='3' order by nivel";
			$result = mysql_query($query,$link);
			while($row = mysql_fetch_array($result)) {
				$patroc_codigo = $row["patroc_codigo"];
			}

			$querz = "select tit_nombres,tit_apellidos,tipo_afiliado from afiliados where tit_codigo='".$patroc_codigo."'";
			$resulz = mysql_query($querz,$link);
			$roz = mysql_fetch_array($resulz);
			$patroc_nombres = trim($roz["tit_nombres"])." ".trim($roz["tit_apellidos"]);

			$query = "SELECT * from redpatrocinios where afiliado='".$afiliado."' and nivel>'0' AND nivel<='3' order by nivel";
			$result = mysql_query($query,$link);
			while($row = mysql_fetch_array($result)) {
				$patroc_codigo = $row["patroc_codigo"];
				$nivel = $row["nivel"];

				$quera = "select tit_nombres,tit_apellidos,tipo_afiliado from afiliados where tit_codigo='".$patroc_codigo."'";
				$resula = mysql_query($quera,$link);
				$roa = mysql_fetch_array($resula);
				$tit_nombre_completo = trim($roa["tit_nombres"])." ".trim($roa["tit_apellidos"]);
				$tipo_patroc = $roa["tipo_afiliado"];

				$quer5 = "SELECT * from bono_afiliacion where bono_afiliacion.nivel='".trim($nivel)."'";
				$resul5 = mysql_query($quer5,$link);
				$ro5 = mysql_fetch_array($resul5);
				$porcentaje = 0.00;
				switch ($tipo_patroc) {
					case 'Premium':
						$porcentaje = $ro5["premium"];
						break;
					case 'VIP':
						$porcentaje = $ro5["vip"];
						break;
					case 'Oro':
						$porcentaje = $ro5["oro"];
						break;
				}
				$comision = $monto*($porcentaje/100);

				$quer6 = "INSERT INTO detbonoafiliacion (patroc_codigo, tit_codigo, fecha_afiliacion, fecha_fin_bono, nivel, afiliado, tipo_patroc, tipo_afil, tipo_trans, fectr, monto, porcentaje, comision, patroc_nombres, tit_nombre_completo, afil_nombres, id_trans_origen, id_trans, status_bono) VALUES ('".$patroc_codigo."','".$patroc_codigo."','".$fecha_afiliacion."','".$fecha_fin_bono."',".$nivel.",'".$afiliado."','".$tipo_patroc."','".$tipo_afil."','Consumo aliados','".$fecha."',".$monto.",".$porcentaje.",".$comision.",'".$patroc_nombres."','".$tit_nombre_completo."','".$afil_nombres."',".$id_transaccion.",0,'Pendiente');";
				$resul6 = mysql_query($quer6,$link);
			}
		} else {

			$query = "SELECT organizacion.organizacion,afiliados.rango,organizacion.afiliado,organizacion.nivel FROM organizacion left outer join afiliados on organizacion.organizacion=afiliados.tit_codigo WHERE afiliado='".$afiliado."'";
			$result = mysql_query($query,$link);
			while($row = mysql_fetch_array($result)) {
				$organizacion = $row["organizacion"];
				$rango = $row["rango"];
				$nivel = $row["nivel"];

				$quer0 = "select tit_nombres,tit_apellidos from afiliados where tit_codigo='".$organizacion."'";
				$resul0 = mysql_query($quer0,$link);
				$ro0 = mysql_fetch_array($resul0);
				$org_nombres = trim($ro0["tit_nombres"])." ".trim($ro0["tit_apellidos"]);

				if ($nivel>0 and $nivel<=8) {
					$quer2 = "SELECT n".trim(strval($nivel))." as porcentaje FROM unilevel WHERE rango='".$rango."'";
					if ($resul2 = mysql_query($quer2,$link)) {
						$ro2 = mysql_fetch_array($resul2);
						$porcentaje = $ro2["porcentaje"];
						$comision = $monto*$porcentaje/100;
						$quer3 = "INSERT INTO detunilevel (organizacion, org_nombres, rango, nivel, afiliado, afil_nombres, fectr, tipo_trans, nombre_trans, precio, monto, porcentaje, comision, id_trans_origen, id_trans, status_unilevel) VALUES ('".$organizacion."', '".$org_nombres."', '".$rango."', '".$nivel."', '".$afiliado."', '".$afil_nombres."', '".$fecha."', '04', 'Consumo aliados',".$precio_orden.", ".$monto.", ".$porcentaje.", ".$comision.", ".$id_transaccion.", 0, 'Pendiente')";
						$resul3 = mysql_query($quer3,$link);
					}
				}
			}
		}

		// CLUB 180
//		$porc_180 = ($tipo_afil=='Premium') ? 0.2 : 0.1 ;
		$porc_180 = 0.03 ;
//		if ($_SESSION['pm']+$puntos>50 and $_SESSION['pm']+$puntos<300) {
		if ($_SESSION['pm']>100 or $_SESSION['pm']+$puntos>100) {
			if ($_SESSION['pm']<200) {
				if ($_SESSION['pm']<=100) {
					$base = $_SESSION['pm'] + $puntos - 100;
				} else {
					$base = ($_SESSION['pm']+$puntos>=200) ? $_SESSION['pm'] + $puntos - 200 : $puntos ;
				}
				
				$quer0 = "select tit_nombres,tit_apellidos,tipo_afiliado,fecha_afiliacion from afiliados where tit_codigo='".$afiliado."'";
				$resul0 = mysql_query($quer0,$link);
				$ro0 = mysql_fetch_array($resul0);
				$afil_nombres = trim($ro0["tit_nombres"])." ".trim($ro0["tit_apellidos"]);
				$fecha_afiliacion = $ro0["fecha_afiliacion"];
				$vencimiento = strtotime('+1 year', strtotime ($fecha_afiliacion));
				$vencimiento = date ( 'Y-m-d' , $vencimiento );

				$puntos_180 = $base * $porc_180;
				$query = "INSERT INTO det_180 (afiliado, afil_nombres, fectr, tipo_trans, nombre_trans, puntos, id_trans_origen, id_trans, status_180, vencimiento) VALUES ('".$afiliado."', '".$afil_nombres."', '".$fecha."', '04', 'Consumo aliados',".$puntos_180.", ".$id_transaccion.", 0, 'Pendiente','".$vencimiento."')";
				$result = mysql_query($query,$link);
			}
		}
		$_SESSION['pm'] += $puntos;

		calificacion($afiliado,$_SESSION['pm'],$_SESSION['pmo'],$link);

		// Bono de reembolso
		$querq = "select reembolso from empresa";
		$resulq = mysql_query($querq,$link);
		$roq = mysql_fetch_array($resulq);
		$reembolso = $roq["reembolso"];

		$query = "INSERT INTO reembolso (afiliado, fecha, precio, monto, puntos, trans_id, status_comision) VALUES ('".$afiliado."', '".$fecha."', 0, ".$monto*($reembolso/100).", 0, ".$id_transaccion.", 'Pendiente')";
		$result = mysql_query($query,$link);

		$cadena = 'Location: exito.php';
	}
} else {
	$cadena = 'Location: error.php'; 
}
header($cadena);
?>
