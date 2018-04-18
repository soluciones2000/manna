<?php 
session_start();
header('Content-Type: application/json');
include_once("conexion.php");

$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : '';

$quer0 = "select tit_nombres,tit_apellidos from afiliados where tit_codigo='".$codigo."'";
$resul0 = mysql_query($quer0,$link);
$ro0 = mysql_fetch_array($resul0);
$nombre = utf8_encode(trim($ro0["tit_nombres"]).' '.trim($ro0["tit_apellidos"]));

$query = "select transacciones.*,tipo_transaccion.nombre_transaccion,tipo_transaccion.signo_transaccion from transacciones left outer join tipo_transaccion on transacciones.tipo=tipo_transaccion.tipo where transacciones.afiliado='".$codigo."' order by transacciones.fecha,transacciones.orden_id,transacciones.tipo";
$result = mysql_query($query,$link);
$cierto = true;
$coma = '';
$cierre = false;
$respuesta = '';
while ($row = mysql_fetch_array($result)) {
	if ($cierto) {
		$cierto = false;
		$cierre = true;
		$respuesta = '[';
		$coma = '';
	} else {
		$coma = ',';
	}
	$respuesta .= $coma.'{"afiliado":"'.trim($row["afiliado"]).' - '.$nombre.'","fecha":"'.trim($row["fecha"]).'","orden_id":'.trim($row["orden_id"]).',"cliente":"'.trim($row["cliente"]).'","cliente_pref":"'.trim($row["cliente_pref"]).'","tipo":"'.trim($row["tipo"]).'","precio":'.trim($row["precio"]).',"monto":'.trim($row["monto"]).',"puntos":'.trim($row["puntos"]).',"documento":"'.trim($row["documento"]).'","bancoorigen":"'.trim($row["bancoorigen"]).'","status_comision":"'.trim($row["status_comision"]).'","nombre_transaccion":"'.utf8_encode(trim($row["nombre_transaccion"])).'","signo_transaccion":"'.trim($row["signo_transaccion"]).'"}';
}
$respuesta .= ($cierre) ? ']' : '' ;

if ($respuesta=='') { $respuesta = 'No encontrada'; }
echo $respuesta;
?>
