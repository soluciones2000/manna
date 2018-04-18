<?php 
session_start();
header('Content-Type: application/json');
include_once("conexion.php");

$orden_id = isset($_GET['orden_id']) ? $_GET['orden_id'] : 0;

$quer0 = "select * from ordenes where orden_id=".$orden_id;
$resul0 = mysql_query($quer0,$link);
if ($ro0 = mysql_fetch_array($resul0)) {
	switch ($ro0["tipo_orden"]) {
		case 'Afiliado':
			$quer1 = "select tit_nombres,tit_apellidos from afiliados where tit_codigo='".trim($ro0["codigo"])."'";
			$resul1 = mysql_query($quer1,$link);
			if ($ro1 = mysql_fetch_array($resul1)) {
				$patroc = utf8_encode(trim($ro1["tit_nombres"]).' '.trim($ro1["tit_apellidos"]));
				$nombre = utf8_encode(trim($ro1["tit_nombres"]).' '.trim($ro1["tit_apellidos"]));
			} else {
				$patroc = 'Patrocinador no registrado';
				$nombre = 'Afiliado no registrado';
			}
			break;
		case 'Cliente':
			$quer1 = "select tit_nombres,tit_apellidos from afiliados where tit_codigo='".trim($ro0["patroc_codigo"])."'";
			$resul1 = mysql_query($quer1,$link);
			if ($ro1 = mysql_fetch_array($resul1)) {
				$patroc = utf8_encode(trim($ro1["tit_nombres"]).' '.trim($ro1["tit_apellidos"]));
			} else {
				$patroc = 'Patrocinador no registrado';
			}
			$quer1 = "select nombre from clientes where cod_corto_clte='".trim($ro0["codigo"])."' and patroc_codigo='".trim($ro0["patroc_codigo"])."'";
			$resul1 = mysql_query($quer1,$link);
			if ($ro1 = mysql_fetch_array($resul1)) {
				$nombre = utf8_encode(trim($ro1["nombre"]));
			} else {
				$nombre = 'Cliente no registrado';
			}
			break;
		case 'Cliente Preferencial':
			$quer1 = "select tit_nombres,tit_apellidos from afiliados where tit_codigo='".trim($ro0["patroc_codigo"])."'";
			$resul1 = mysql_query($quer1,$link);
			if ($ro1 = mysql_fetch_array($resul1)) {
				$patroc = utf8_encode(trim($ro1["tit_nombres"]).' '.trim($ro1["tit_apellidos"]));
			} else {
				$patroc = 'Patrocinador no registrado';
			}
			$quer1 = "select clte_nombre from cliente_preferencial where cod_corto_clte='".trim($ro0["codigo"])."' and patroc_codigo='".trim($ro0["patroc_codigo"])."'";
			$resul1 = mysql_query($quer1,$link);
			if ($ro1 = mysql_fetch_array($resul1)) {
				$nombre = utf8_encode(trim($ro1["clte_nombre"]));
			} else {
				$nombre = 'Cliente preferencial no registrado';
			}
			break;
	
		default:
			$patroc = 'Patrocinador no registrado';
			$nombre = 'Comprador no registrado';
			break;
	}
}

$query = "select * from ordenes where ordenes.orden_id=".$orden_id;
$result = mysql_query($query,$link);
if ($row = mysql_fetch_array($result)) {
	$respuesta = '{"codigo":"'.trim($row["codigo"]).'","patroc":"'.trim($row["patroc_codigo"]).'","nombre":"'.$nombre.'","patroc_nombre":"'.$patroc.'","fecha":"'.trim($row["fecha"]).'","montodoc":'.trim($row["montodoc"]).',"monto":'.trim($row["monto"]).',"puntos":'.trim($row["puntos"]).',"direccion_envio":"'.utf8_encode(trim($row["direccion_envio"])).'","status_orden":"'.trim($row["status_orden"]).'","tipo_orden":"'.trim($row["tipo_orden"]).'"';

	$quer2 = "select det_orden.*,productos.desc_corta from det_orden left outer join productos on det_orden.id_pro=productos.id_pro where det_orden.orden_id=".$orden_id;
	$resul2 = mysql_query($quer2,$link);
	$cierto = true;
	$coma = '';
	$cierre = false;
	while ($ro2 = mysql_fetch_array($resul2)) {
		if ($cierto) {
			$respuesta .= ',"detalles":';
			$cierto = false;
			$cierre = true;
			$coma = '[';
		} else {
			$coma = ',';
		}
		$respuesta .= $coma.'{"codigo":"'.trim($ro2["id_pro"]).'","desc_corta":"'.utf8_encode(trim($ro2["desc_corta"])).'","cantidad":'.trim($ro2["cantidad"]).',"precio":'.trim($ro2["precio"]).',"valor_comisionable":'.trim($ro2["valor_comisionable"]).',"puntos":'.trim($ro2["puntos"]).'}';
	}
	$respuesta .= ($cierre) ? ']' : '' ;

	$quer3 = "select transacciones.*,tipo_transaccion.nombre_transaccion,tipo_transaccion.signo_transaccion from transacciones left outer join tipo_transaccion on transacciones.tipo=tipo_transaccion.tipo where transacciones.orden_id=".$orden_id;
	$resul3 = mysql_query($quer3,$link);
	$cierto = true;
	$coma = '';
	$cierre = false;
	while ($ro3 = mysql_fetch_array($resul3)) {
		if ($cierto) {
			$respuesta .= ',"transacciones":';
			$cierto = false;
			$cierre = true;
			$coma = '[';
		} else {
			$coma = ',';
		}
		$respuesta .= $coma.'{"fecha":"'.trim($ro3["fecha"]).'","afiliado":"'.trim($ro3["afiliado"]).'","cliente":"'.trim($ro3["cliente"]).'","cliente_pref":"'.trim($ro3["cliente_pref"]).'","tipo":"'.trim($ro3["tipo"]).'","precio":'.trim($ro3["precio"]).',"monto":'.trim($ro3["monto"]).',"puntos":'.trim($ro3["puntos"]).',"documento":"'.trim($ro3["documento"]).'","bancoorigen":"'.trim($ro3["bancoorigen"]).'","status_comision":"'.trim($ro3["status_comision"]).'","nombre_transaccion":"'.utf8_encode(trim($ro3["nombre_transaccion"])).'","signo_transaccion":"'.trim($ro3["signo_transaccion"]).'"}';
	}
	$respuesta .= ($cierre) ? ']' : '' ;

	$respuesta .= '}';
} else {
	$respuesta = 'No encontrada';
}
//echo '<!doctype html>';
echo $respuesta;
?>
