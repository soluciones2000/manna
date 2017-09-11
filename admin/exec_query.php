<?php 
include_once("conexion.php");
$query = "select * from information_schema.columns where table_schema='manna' and table_name='afiliados'";
$result = mysql_query($query,$link);

$quer2 = "select * from afiliados where tit_codigo='00005'";
$resul2 = mysql_query($quer2,$link);
$ro2 = mysql_fetch_array($resul2);

echo "REGISTRO DE AFILIADO<br>";
echo '<table border="1"><br>';
while($row = mysql_fetch_array($result)) {
	$campo = $row["COLUMN_COMMENT"];
	$indice = $row["COLUMN_NAME"];
	echo '<tr><td>'.$campo.'</td><td>'.$ro2[$indice].'</td></tr>';
}
echo '</table>';
?>
