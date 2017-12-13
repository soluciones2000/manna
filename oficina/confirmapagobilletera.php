<?php 
include_once("conexion.php");
include_once("funciones.php");
$codigo = isset($_POST['c']) ? $_POST['c'] : '';
$orden = isset($_POST['ord']) ? $_POST['ord'] : 0;

$fecha = date("Y-m-d");
$mes = date("m");
$tipo = '05';
$status_comision = 'Pendiente';
$query = "SELECT * from ordenes WHERE orden_id=".$orden;
if ($result = mysql_query($query,$link)) {
	$row = mysql_fetch_array($result);
	$precio_orden = $row["monto"];
	$monto = $row["valor_comisionable"];
	$puntos = $row["puntos"];
	$status_orden = "Conciliada por despachar";
}

$query = "INSERT INTO billetera (afiliado, fecmov, mesmov, tipmov, numdoc, tipo_trans, concepto, creditos, debitos) VALUES ('".$codigo."', '".$fecha."', '".$mes."', 'Débito', '".$orden."', 'DB', 'Pago orden No. ".number_format($orden,0,',','.')." usando la billetera', 0.00, ".$precio_orden.")";
echo $query.'<br>';
if ($result = mysql_query($query,$link)) {
	$query = "select id from billetera where numdoc='".trim($orden)."' and fecmov='".$fecha."'";
	echo $query.'<br>';
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		$trans_billetera = $row["id"];
	} else {
		$trans_billetera = 0;
	}
}

$query = "INSERT INTO transacciones (fecha, afiliado, cliente, cliente_pref, tipo, precio, monto, puntos, valor_punto, documento, bancoorigen, status_comision, orden_id) VALUES ('".$fecha."','".$codigo."','".$codigo."','','".$tipo."',".$precio_orden.",".$monto.",".$puntos.",".$_SESSION["valor_punto"].",'".$trans_billetera."','Billetera','".$status_comision."',".$orden.")";
echo $query.'<br>';

if ($result = mysql_query($query,$link)) {
	$query = "select id from transacciones where orden_id=".trim($orden)." and fecha='".$fecha."'";
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		$id_transaccion = $row["id"];
	} else {
		$id_transaccion = 0;
	}

	$query = "UPDATE ordenes SET id_transaccion=".$id_transaccion.",status_orden='".$status_orden."' WHERE orden_id=".trim($orden);
	if ($result = mysql_query($query,$link)) {

		$quer0 = "select tit_nombres,tit_apellidos,tipo_afiliado from afiliados where tit_codigo='".$codigo."'";
		$resul0 = mysql_query($quer0,$link);
		$ro0 = mysql_fetch_array($resul0);
		$afil_nombres = trim($ro0["tit_nombres"])." ".trim($ro0["tit_apellidos"]);
		$tipo_afil = $ro0["tipo_afiliado"];

		$querx = "select * from patrocinio where tit_codigo='".$codigo."'";
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

			$query = "SELECT * from redpatrocinios where afiliado='".$codigo."' and nivel>'0' AND nivel<='3' order by nivel";
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
