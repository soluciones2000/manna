<?php 
include_once("conexion.php");
$query = "SELECT afiliados.patroc_codigo,afiliados.tit_codigo,afiliados.fecha_afiliacion from afiliados order by patroc_codigo,tit_codigo";
echo $query.'<br>';
$result = mysql_query($query,$link);

while($row = mysql_fetch_array($result)) {
	$patroc_codigo = $row["patroc_codigo"];
	$tit_codigo = $row["tit_codigo"];
	$fecha_afiliacion = $row["fecha_afiliacion"];
	$fecha_fin_bono = strtotime('+60 day', strtotime ($fecha_afiliacion));
	$fecha_fin_bono = date ( 'Y-m-d' , $fecha_fin_bono );
	$quer2 = "INSERT INTO patrocinio(patroc_codigo,tit_codigo,fecha_afiliacion,fecha_fin_bono) VALUES ('".$patroc_codigo."','".$tit_codigo."','".$fecha_afiliacion."','".$fecha_fin_bono."')";
	echo "->".$quer2.'<br>';
	//$resul2 = mysql_query($quer2,$link);
}
echo '<br>';
?>
