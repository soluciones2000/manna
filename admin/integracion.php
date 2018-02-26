<?php
include_once("conexion.php");
include_once("funciones.php");

$query = "SELECT * from empresa";
$result = mysql_query($query,$link);
if ($row = mysql_fetch_array($result)) {
   $empresa = utf8_encode($row["emp_nombre"]);
   $_SESSION["iva1"] = $row["iva1"];
   $_SESSION["iva2"] = $row["iva2"];
   $_SESSION["iva3"] = $row["iva3"];
   $_SESSION["valor_punto"] = $row["valor_punto"];
} else {
   $empresa = "Error al conectar a la base de datos.";
   $_SESSION["iva1"] = 0.00;
   $_SESSION["iva2"] = 0.00;
   $_SESSION["iva3"] = 0.00;
   $_SESSION["valor_punto"] = 0.00;
}

$cJson = (isset($_POST['cJson'])) ? $_POST['cJson'] : '' ;

$aRegistros = json_decode($cJson,true);

echo json_last_error_msg();

$cliente_pref = '';
$status_comision = 'Pendiente';
foreach ($aRegistros as $key => $value) {
	$fecha = $value['fecha'];
	$afiliado = $value['afiliado'];
	$cliente = $value['cliente'];
	$tipo = $value['tipo'];
	$precio = $value['precio'];
	$monto = $value['monto'];
	$puntos = $value['puntos'];
	$documento = $value['documento']; 
	$bancoorigen = $value['bancoorigen']; 
	$status_comision = "Pendiente";
	$orden_id = $value['orden_id']; 
	$query = "INSERT INTO transacciones (fecha, afiliado, cliente, cliente_pref, tipo, precio, monto, puntos, valor_punto, documento, bancoorigen, status_comision, orden_id) VALUES ('".$fecha."','".$afiliado."','".$cliente."','','".$tipo."',".$precio.",".$monto.",".$puntos.",".$_SESSION["valor_punto"].",'".$documento."','".$bancoorigen."','Pendiente',".$orden_id.")";
	$result = mysql_query($query,$link);
/******************************************************************************************
******************************************************************************************/
	$fecha = $fch;
	$mes = substr($fecha,5,2);
	$cliente_pref = '';
	$precio_orden = $precio;
	$status_orden = "Cancelada por conciliar";

	$query = "select id from transacciones where orden_id=".trim($orden_id)." and fecha='".$fecha."'";
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		$id_transaccion = $row["id"];
	} else {
		$id_transaccion = 0;
	}

	/*   OJO falta el registro de la orden, puede ser que no sea necesario   */
		
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
	$porc_180 = 0.03 ;

	$quer81 = "SELECT afiliado,sum(puntos) as puntos FROM transacciones where afiliado='".trim($codigo)."' and status_comision='Pendiente' and status_comision<>'No aplica'";
	$resul81 = mysql_query($quer81,$link);
	$ro81 = mysql_fetch_array($resul81);
	$pm = 0.00;
	if ($ro81["puntos"]>0) {
		$pm = $ro81["puntos"];
	}

	$quer82 = "SELECT afiliado FROM organizacion where organizacion='".trim($codigo)."'";
	$resul82 = mysql_query($quer82,$link);
	$pmo = 0;
	while($ro82 = mysql_fetch_array($resul82)) {
		$quer83 = "SELECT sum(puntos) as pmo FROM transacciones where afiliado='".trim($ro82["afiliado"])."' and status_comision='Pendiente' and status_comision<>'No aplica'";
		$resul83 = mysql_query($quer83,$link);
		$ro83 = mysql_fetch_array($resul83);
		$pmo += $ro83["pmo"];
	}
	$pmo -= $pm;

	if ($pm>100 or $pm+$puntos>100) {
		if ($pm<200) {
			if ($pm<=100) {
				$base = $pm + $puntos - 100;
			} else {
				$base = ($pm+$puntos>=200) ? $pm + $puntos - 200 : $puntos ;
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

	calificacion($afiliado,$pm,$pmo,$link);

		// Bono de reembolso
	$querq = "select reembolso from empresa";
	$resulq = mysql_query($querq,$link);
	$roq = mysql_fetch_array($resulq);
	$reembolso = $roq["reembolso"];

	$query = "INSERT INTO reembolso (afiliado, fecha, precio, monto, puntos, trans_id, status_comision) VALUES ('".$afiliado."', '".$fecha."', 0, ".$monto*($reembolso/100).", 0, ".$id_transaccion.", 'Pendiente')";
	$result = mysql_query($query,$link);

/******************************************************************************************
******************************************************************************************/
}

return true;
?>