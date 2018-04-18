<?php 

function piernas($codigo,$calif_pierna,$link){
	$query = "SELECT afiliado from organizacion WHERE organizacion='".$codigo."' and nivel>0";
	if ($result = mysql_query($query,$link)){
		$piernas = 0;
		while($row = mysql_fetch_array($result)) {
			$afil = $row["afiliado"];
			$quer2 = "SELECT rango from afiliados WHERE tit_codigo='".$afil."'";;
			if ($resul2 = mysql_query($quer2,$link)){
				$ro2 = mysql_fetch_array($resul2);
				if ($ro2["rango"]==$calif_pierna) { $piernas++; }
			}
		}
		return $piernas;
	} else {
		return 0;
	}
}

function premium($codigo){
	$fecha = date('Y-m-d');
	$mes = substr($fecha,5,2);
	$query = "SELECT sum(tit_codigo) as premium from afiliados WHERE enrol_codigo='".$codigo."' and tipo_afiliado='Premium' and mes_afiliacion='".trim($mes)."'";
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		$premium = $row["afiliado"];
	} else {
		$premium = 0;
	}
	return $premium;
}


function calificacion($codigo,$pm,$pmo,$link){
	$query = "SELECT rango from afiliados WHERE tit_codigo='".$codigo."'";
	$result = mysql_query($query,$link);
	$row = mysql_fetch_array($result);
	$rango_ant = $row["rango"];

	$query = "SELECT * from unilevel WHERE rango_ant='".$rango_ant."'";
	$result = mysql_query($query,$link);
	$row = mysql_fetch_array($result);
	$rango = $row["rango"];
	$cpm = $row["pm"];
	$cpmo = $row["pmo"];
	$cpiernas = $row["piernas"];
	$calif_piernas = $row["calif_piernas"];

	$piernas = 0;
	if ($cpiernas>0) {
		$query = "SELECT afiliado from organizacion WHERE organizacion='".$codigo."' and nivel>0";
		if ($result = mysql_query($query,$link)){
			while($row = mysql_fetch_array($result)) {
				$afil = $row["afiliado"];
				$quer2 = "SELECT rango from afiliados WHERE tit_codigo='".$afil."'";;
				if ($resul2 = mysql_query($quer2,$link)){
					$ro2 = mysql_fetch_array($resul2);
					if ($ro2["rango"]==$calif_piernas) { $piernas++; }
				}
			}
		} else {
			$piernas = 0;
		}
	}
	if ($pm>=$cpm and $pmo>=$cpmo and $piernas>=$cpiernas) {
		$flag = true;
		$query = "UPDATE afiliados SET rango='".$rango."',flag='".$flag."' WHERE tit_codigo='".trim($codigo)."'";
		$result = mysql_query($query,$link);
		$_SESSION['rango'] = $rango;
		$_SESSION['flag'] = $flag;
	}
}

function nombres($tit_codigo,$link) {
	$query = "SELECT tit_nombres,tit_apellidos from afiliados WHERE tit_codigo='".$tit_codigo."'";
	$result = mysql_query($query,$link);
	$row = mysql_fetch_array($result);
	return trim($row["tit_nombres"]).' '.trim($row["tit_apellidos"]);
}

function codigoynombres($tit_codigo,$link) {
	$query = "SELECT tit_nombres,tit_apellidos from afiliados WHERE tit_codigo='".$tit_codigo."'";
	$result = mysql_query($query,$link);
	$row = mysql_fetch_array($result);
	return $tit_codigo.' '.trim($row["tit_nombres"]).' '.trim($row["tit_apellidos"]);
}

function transaccion($link,$precio,$precio_orden,$fecha,$afiliado,$cliente,$monto,$puntos,$documento,$bancoorigen,$orden_id) {
	/* 
	Si el monto pagado ($precio) es menor que el monto de la orden ($precio_orden) => código 03 (nota de crédito), 
	Si es igual al monto de la orden => cancela la orden (código 04)
	*/
	$cliente_pref = '';
	$valor_punto = $_SESSION["valor_punto"];
	if ($precio<$precio_orden) {
		$tipo = "03";
		$monto = 0.00;
		$puntos = 0;
		$status_comision = "No aplica";
		$cant_trans = 1;
	} elseif ($precio==$precio_orden) {
		$tipo = "04";
		$status_comision = "Pendiente";
		$cant_trans = 1;
	} else {
		$tipo = "04";
		$status_comision = "Pendiente";
		$tipo2 = "33";
		$cant_trans = 2;
	}
	/*
	Si pagan más del monto de la orden se deben registrar dos transacciones, una para cancelar la orden y una NC por el resto.
	*/
	if ($cant_trans<2) {

		$query = "INSERT INTO transacciones (fecha, afiliado, cliente, cliente_pref, tipo, precio, monto, puntos, valor_punto, documento, bancoorigen, status_comision, orden_id) VALUES ('".$fecha."','".$afiliado."','".$cliente."','".$cliente_pref."','".$tipo."',".$precio.",".$monto.",".$puntos.",".$valor_punto.",'".$documento."','".$bancoorigen."','".$status_comision."',".$orden_id.")";
		if ($result = mysql_query($query,$link)) {
			$quer2 = "select id from transacciones where orden_id=".trim($orden_id)." and fecha='".$fecha."'";
			$resul2 = mysql_query($quer2,$link);
			if ($row = mysql_fetch_array($resul2)) {
				$idtran = $row["id"];
			} else {
				$idtran = 0;
			}
		} else {
			$idtran = 0;
		}
	} else {
		/*
		La primera transacción cancelando la orden, este número de transacción será el que devolverá
		*/
		$query = "INSERT INTO transacciones (fecha, afiliado, cliente, cliente_pref, tipo, precio, monto, puntos, valor_punto, documento, bancoorigen, status_comision, orden_id) VALUES ('".$fecha."','".$afiliado."','".$cliente."','".$cliente_pref."','".$tipo."',".$precio_orden.",".$monto.",".$puntos.",".$valor_punto.",'".$documento."','".$bancoorigen."','".$status_comision."',".$orden_id.")";
		if ($result = mysql_query($query,$link)) {
			$quer2 = "select id from transacciones where orden_id=".trim($orden_id)." and fecha='".$fecha."'";
			$resul2 = mysql_query($quer2,$link);
			if ($row = mysql_fetch_array($resul2)) {
				$idtran = $row["id"];
			} else {
				$idtran = 0;
			}
		} else {
			$idtran = 0;
		}
		/*
		La segunda transacción es la nota de crédito por pago de más (tipo 33)
		*/
		$montonc = $precio-$precio_orden;
		$monto = 0.00;
		$puntos = 0;
		$status_comision = "No aplica";
		$query = "INSERT INTO transacciones (fecha, afiliado, cliente, cliente_pref, tipo, precio, monto, puntos, valor_punto, documento, bancoorigen, status_comision, orden_id) VALUES ('".$fecha."','".$afiliado."','".$cliente."','".$cliente_pref."','".$tipo2."',".$montonc.",".$monto.",".$puntos.",".$valor_punto.",'".$documento."','".$bancoorigen."','".$status_comision."',".$orden_id.")";
		$result = mysql_query($query,$link);
	}	
	return $idtran;
}

function actualiza_saldo_orden($link,$idtran,$precio,$precio_orden,$orden_id) {
	$saldo = ($precio_orden-$precio<0) ? 0.00 : $precio_orden-$precio ;
	$status_orden = ($precio<$precio_orden) ? "Parcialmente cancelada" : "Cancelada por conciliar" ;
	$query = "UPDATE ordenes SET id_transaccion=".$idtran.",monto=".$saldo.", status_orden='".$status_orden."' WHERE orden_id=".trim($orden_id);
	if ($result = mysql_query($query,$link)) {
		$saldo = $precio_orden-$precio;
	} else {
		$saldo = $precio_orden;
	}
	return $saldo;

}

function billetera($link,$afiliado,$fecha,$mes,$tipmov,$documento,$tipo_trans,$concepto,$creditos,$debitos) {
	$query = "INSERT INTO billetera (afiliado, fecmov, mesmov, tipmov, numdoc, tipo_trans, concepto, creditos, debitos) VALUES ('".$afiliado."', '".$fecha."', '".$mes."', '".utf8_encode($tipmov)."', '".$documento."', '".$tipo_trans."', '".$concepto."', ".$creditos.", ".$debitos.")";
	$result = mysql_query($query,$link);
	return true;
}

function bono_patrocinio($link,$afiliado,$monto,$fecha_afiliacion,$fecha_fin_bono,$fecha,$id_transaccion) {
	// Buscar el tipo de afiliado
	$quer0 = "select tit_nombres,tit_apellidos,tipo_afiliado from afiliados where tit_codigo='".$afiliado."'";
	$resul0 = mysql_query($quer0,$link);
	$ro0 = mysql_fetch_array($resul0);
	$afil_nombres = trim($ro0["tit_nombres"])." ".trim($ro0["tit_apellidos"]);
	$tipo_afil = $ro0["tipo_afiliado"];

	// Busca el afiliado en la red de patrocinios para ubicar su upline en esa red
	$query = "SELECT * from redpatrocinios where afiliado='".$afiliado."' and nivel>'0' AND nivel<='3' order by nivel";
	$result = mysql_query($query,$link);

	// Busca el código del patrocinante
	while($row = mysql_fetch_array($result)) {
		$patroc_codigo = $row["patroc_codigo"];
	}

	// Ubica el nombre del patrocinante
	$querz = "select tit_nombres,tit_apellidos,tipo_afiliado from afiliados where tit_codigo='".$patroc_codigo."'";
	$resulz = mysql_query($querz,$link);
	$roz = mysql_fetch_array($resulz);
	$patroc_nombres = trim($roz["tit_nombres"])." ".trim($roz["tit_apellidos"]);

	// Va a realizar un recorrido para actualizar la red de patrocinios hasta el tercer nivel
	$query = "SELECT * from redpatrocinios where afiliado='".$afiliado."' and nivel>'0' AND nivel<='3' order by nivel";
	$result = mysql_query($query,$link);
	while($row = mysql_fetch_array($result)) {
		$tit_codigo = $row["patroc_codigo"];
		$nivel = $row["nivel"];

		// Ubica los datos del patrocinado (ubica tambien el tipo de afiliado, pero todos son premium)
		$quera = "select tit_nombres,tit_apellidos,tipo_afiliado from afiliados where tit_codigo='".$tit_codigo."'";
		$resula = mysql_query($quera,$link);
		$roa = mysql_fetch_array($resula);
		$tit_nombre_completo = trim($roa["tit_nombres"])." ".trim($roa["tit_apellidos"]);
		$tipo_patroc = $roa["tipo_afiliado"]; // Esto está en estos momentos inutilizado

		// Busca en la tabla del bon el porcentaje que corresponde, pero ahorita todos son premium
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

		$tipo_trans = 'Consumo aliados';
		$id_trans = 0;
		$status_bono = 'Pendiente';
		$quer6 = "INSERT INTO detbonoafiliacion (patroc_codigo, tit_codigo, fecha_afiliacion, fecha_fin_bono, nivel, afiliado, tipo_patroc, tipo_afil, tipo_trans, fectr, monto, porcentaje, comision, patroc_nombres, tit_nombre_completo, afil_nombres, id_trans_origen, id_trans, status_bono) VALUES ('".$patroc_codigo."','".$tit_codigo."','".$fecha_afiliacion."','".$fecha_fin_bono."',".$nivel.",'".$afiliado."','".$tipo_patroc."','".$tipo_afil."','".$tipo_trans."','".$fecha."',".$monto.",".$porcentaje.",".$comision.",'".$patroc_nombres."','".$tit_nombre_completo."','".$afil_nombres."',".$id_transaccion.",".$id_trans.",'".$status_bono."')";
		echo $quer6;
		$resul6 = mysql_query($quer6,$link);
		if ($resul6) {
			echo " SI<br><br><br>";
		} else {
			echo " NO<br><br><br>";
		}
		
	}
	return true;
}

function bono_unilevel($link,$afiliado,$fecha,$precio_orden,$monto,$id_transaccion) {
	$quer0 = "select tit_nombres,tit_apellidos,tipo_afiliado from afiliados where tit_codigo='".$afiliado."'";
	$resul0 = mysql_query($quer0,$link);
	$ro0 = mysql_fetch_array($resul0);
	$afil_nombres = trim($ro0["tit_nombres"])." ".trim($ro0["tit_apellidos"]);

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

		if ($nivel>0 and $nivel<=9) {
			$quer2 = "SELECT n".trim(strval($nivel))." as porcentaje FROM unilevel WHERE rango='".$rango."'";
			if ($resul2 = mysql_query($quer2,$link)) {
				$ro2 = mysql_fetch_array($resul2);
				$porcentaje = $ro2["porcentaje"];
				$comision = $monto*$porcentaje/100;
				$tipo_trans = '04';
				$nombre_trans = 'Consumo aliados';
				$id_trans = 0;
				$status_unilevel = 'Pendiente';
				$quer3 = "INSERT INTO detunilevel (organizacion, org_nombres, rango, nivel, afiliado, afil_nombres, fectr, tipo_trans, nombre_trans, precio, monto, porcentaje, comision, id_trans_origen, id_trans, status_unilevel) VALUES ('".$organizacion."', '".$org_nombres."', '".$rango."', '".$nivel."', '".$afiliado."', '".$afil_nombres."', '".$fecha."', '".$tipo_trans."', '".$nombre_trans."',".$precio_orden.", ".$monto.", ".$porcentaje.", ".$comision.", ".$id_transaccion.", ".$id_trans.", '".$status_unilevel."')";
				$resul3 = mysql_query($quer3,$link);
			}
		}
	}
	return true;
}
/*
function club_180($link,$afiliado) {
	$porc_180 = 0.03 ;
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
			$query = "INSERT INTO det_180 (afiliado, afil_nombres, fectr, tipo_trans, nombre_trans, puntos, id_trans_origen, d_trans, status_180, vencimiento) VALUES ('".$afiliado."', '".$afil_nombres."', '".$fecha."', '04', 'Consumo aliados',".$puntos_180.", ".$id_transaccion.", 0, 'Pendiente','".$vencimiento."')";
			$result = mysql_query($query,$link);
		}
	}
	return true;
}
*/
function bono_de_reembolso($link,$afiliado,$fecha,$precio,$monto,$puntos,$id_transaccion) {
	$querq = "select reembolso from empresa";
	$resulq = mysql_query($querq,$link);
	$roq = mysql_fetch_array($resulq);
	$reembolso = $roq["reembolso"];
	$status_comision = 'Pendiente';

	$query = "INSERT INTO reembolso (afiliado, fecha, precio, monto, puntos, trans_id, status_comision) VALUES ('".$afiliado."', '".$fecha."', ".$precio.", ".$monto*($reembolso/100).", ".$puntos.", ".$id_transaccion.", '".$status_comision."')";
	$result = mysql_query($query,$link);
	return true;
}

function bono_aci_potencial($link,$afiliado,$pmacum,$puntos,$orden_id,$fecha,$idtran) {
	$quer0 = "select patroc_codigo,rango from afiliados where tit_codigo='".$afiliado."'";
	$resul0 = mysql_query($quer0,$link);
	$ro0 = mysql_fetch_array($resul0);
	$patroc_codigo = $ro0["patroc_codigo"];
	$rangoafiliado = $ro0["rango"];

	$quer1 = "select pm from unilevel where rango_ant='".$rangoafiliado."'";
	$resul1 = mysql_query($quer1,$link);
	$ro1 = mysql_fetch_array($resul1);
	$pm_req = $ro1["pm"];

	if ($pm_req>$pmacum) {
		$quer2 = "select montodoc,montoreal from ordenes where orden_id=".$orden_id;
		$resul2 = mysql_query($quer2,$link);
		$ro2 = mysql_fetch_array($resul2);
		$montodoc = $ro2["montodoc"];
		$montoreal = $ro2["montoreal"];
		$diference = $montodoc-$montoreal;

		$totalpts = $pmacum + $puntos;

		$trans_id = 0;
		$status_comision = 'Pendiente';

		if ($totalpts<$pm_req) {
			if ($diference>0.00) {
				$quer3 = "INSERT INTO bono_aci_potencial (patroc_codigo, afiliado, orden_id, montodoc, montoreal, bono, pmacum, pmorden, fecha, trans_origen, trans_id, status_comision) VALUES ('".$patroc_codigo."','".$afiliado."', ".$orden_id.", ".$montodoc.", ".$montoreal.", ".$diference.", ".$pmacum.", ".$puntos.", '".$fecha."', ".$idtran.", ".$trans_id.", '".$status_comision."')";
				$resul3 = mysql_query($quer3,$link);
			}
		} else {
			$valorpto = $diference / $puntos;
			$sobrante = $totalpts-$pm_req;
			$pm_compl = $pm_req-$pmacum;

			if ($sobrante>0) {
				$mtosobra = $valorpto * $sobrante;
				$quer4 = "INSERT INTO bono_aci_potencial (patroc_codigo, afiliado, orden_id, montodoc, montoreal, bono, pmacum, pmorden, fecha, trans_origen, trans_id, status_comision) VALUES ('".$afiliado."','".$afiliado."', ".$orden_id.", ".$montodoc.", ".$montoreal.", ".$mtosobra.", ".$pmacum.", ".$sobrante.", '".$fecha."', ".$idtran.", ".$trans_id.", '".$status_comision."')";
				$resul4 = mysql_query($quer4,$link);
			}

			$mtocompl = $valorpto * $pm_compl;
			$quer5 = "INSERT INTO bono_aci_potencial (patroc_codigo, afiliado, orden_id, montodoc, montoreal, bono, pmacum, pmorden, fecha, trans_origen, trans_id, status_comision) VALUES ('".$patroc_codigo."','".$afiliado."', ".$orden_id.", ".$montodoc.", ".$montoreal.", ".$mtocompl.", ".$pmacum.", ".$pm_compl.", '".$fecha."', ".$idtran.", ".$trans_id.", '".$status_comision."')";
			$resul5 = mysql_query($quer5,$link);
		}
	}
	return true;
}

?>
