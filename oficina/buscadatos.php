<?php 
session_start();
header('Content-Type: application/json');
include_once("conexion.php");

$cod = isset($_GET['cod']) ? strtoupper($_GET['cod']) : '';

$query = "select * from afiliados where tit_codigo='".trim($cod)."'";
$result = mysql_query($query,$link);
if ($row = mysql_fetch_array($result)) {
	$respuesta = '{"codigo":"'.trim($row["tit_codigo"]).'","nombre":"'.utf8_encode(trim($row["tit_nombres"]).' '.trim($row["tit_apellidos"])).'","tipo_persona":"'.trim($row["tipo_persona"]).'","ciudad":"'.trim($row["ciudad"]).', Edo. '.trim($row["estado"]).'","telefonos":"'.trim($row["tel_celular"]).' / '.trim($row["tel_local"]).'","email":"'.trim($row["email"]).'","enrolador":"'.trim($row["enrol_codigo"]).' - '.utf8_encode(trim($row["enrol_nombre_completo"])).'","patrocinador":"'.trim($row["patroc_codigo"]).' - '.utf8_encode(trim($row["patroc_nombre_completo"])).'","rango":"'.trim($row["rango"]).'","status":"'.trim($row["status_afiliado"]).'"}';
} else {
	$respuesta = '';
}
//echo '<!doctype html>';
echo $respuesta;
?>
