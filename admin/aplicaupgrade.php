<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu="";
include_once("menu.php");
//$registro = unserialize($_POST["registro"]);
$upgrades = unserialize($_POST["upgrades"]);
$notas_cr = unserialize($_POST["notas_cr"]);

foreach ($_POST as $variables => $value) {
	if ($variables<>"registro" and $variables<>"upgrades" and $variables<>"notas_cr") {
		if (isset($upgrades[$value])) {
			$query = "INSERT INTO transacciones (fecha, afiliado, tipo, precio, monto, puntos, documento, bancoorigen, status_comision) VALUES ('".trim($upgrades[$value]["fecha"])."','".trim($upgrades[$value]["afiliado"])."','".trim($upgrades[$value]["tipo"])."',".$upgrades[$value]["precio"].",".$upgrades[$value]["monto"].",".$upgrades[$value]["puntos"].",'".trim($upgrades[$value]["documento"])."','".trim($upgrades[$value]["bancoorigen"])."','".trim($upgrades[$value]["status_comision"])."')";
			if($result = mysql_query($query,$link)) {
				$query = "UPDATE afiliados SET tipo_afiliado='".trim($upgrades[$value]["tipo_afiliado"])."' WHERE tit_codigo='".trim($upgrades[$value]["afiliado"])."'";
				$result = mysql_query($query,$link);
			}
		}
		if (isset($notas_cr[$value])) {
			$query = "INSERT INTO transacciones (fecha, afiliado, tipo, precio, monto, puntos, documento, bancoorigen, status_comision) VALUES ('".trim($notas_cr[$value]["fecha"])."','".trim($notas_cr[$value]["afiliado"])."','".trim($notas_cr[$value]["tipo"])."',".$notas_cr[$value]["precio"].",".$notas_cr[$value]["monto"].",".$notas_cr[$value]["puntos"].",'".trim($notas_cr[$value]["documento"])."','".trim($notas_cr[$value]["bancoorigen"])."','".trim($notas_cr[$value]["status_comision"])."')";
			$result = mysql_query($query,$link);
		}
		$query = "UPDATE upgrade SET status_upgrade='Ejecutado' WHERE id=".$value;
		$result = mysql_query($query,$link);
	}
}
?>

<div id="cuerpo" align="center">
	<br>
	<br>
	<h1>PROCESO EJECUTADO</h3>
</div> 
<?php
include_once("pie.php");
?>