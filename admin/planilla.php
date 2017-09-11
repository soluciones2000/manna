<?php 
ob_start();
include_once("conexion.php");
include_once("cabecera.php");
$menu = "reportes";
include_once("menu.php");
$men2 = "";
include_once("reportes.php");

$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';

if ($_POST['codigo']<>'') {
	$query = "select * from information_schema.columns where table_schema='manna' and table_name='afiliados'";
	$result = mysql_query($query,$link);

	$quer2 = "select * from afiliados where tit_codigo='".$codigo."'";
	$resul2 = mysql_query($quer2,$link);
	$ro2 = mysql_fetch_array($resul2);

	echo '<div style="text-align:center">';
		echo "<h3>REGISTRO DE AFILIADO</h3>";
	echo '</div>';
//	echo '<div style="text-align:center">';
		echo '<table align="center" border="1" cellpadding="5">';
			while($row = mysql_fetch_array($result)) {
				$campo = $row["COLUMN_COMMENT"];
				$indice = $row["COLUMN_NAME"];
				echo '<tr>';
					echo '<td width="45%"><b>'.utf8_encode($campo).'</b></td>';
					echo '<td width="45%">'.utf8_encode($ro2[$indice]).'</td>';
				echo '</tr>';
			}
		echo '</table>';
//	echo '</div>';
} else {
	$cadena = 'Location: codigo.php?mensaje=1'; 
	header($cadena);
}
ob_end_flush();
?>
