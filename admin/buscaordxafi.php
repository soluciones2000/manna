<?php 
session_start();
header('Content-Type: application/json');
include_once("conexion.php");

$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : '';

$quer0 = "select tit_nombres,tit_apellidos from afiliados where tit_codigo='".$codigo."'";
$resul0 = mysql_query($quer0,$link);
$ro0 = mysql_fetch_array($resul0);
$nombre = utf8_encode(trim($ro0["tit_nombres"]).' '.trim($ro0["tit_apellidos"]));

$query = "select * from ordenes where codigo='".$codigo."' and tipo_orden='Afiliado' order by orden_id";
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
	$respuesta .= $coma.'{"afiliado":"'.trim($row["codigo"]).' - '.$nombre.'","orden_id":'.trim($row["orden_id"]).',"fecha":"'.trim($row["fecha"]).'","montodoc":'.trim($row["montodoc"]).',"monto":'.trim($row["monto"]).',"puntos":'.trim($row["puntos"]).',"status_orden":"'.trim($row["status_orden"]).'"}';
}
$respuesta .= ($cierre) ? ']' : '' ;

if ($respuesta=='') { $respuesta = 'No encontrada'; }
echo $respuesta;
?>
