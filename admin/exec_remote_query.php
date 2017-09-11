<?php 

	// Pruebas
	$servidor = "https://pruebas.sgc-consultores.com.ve/localhost:3306";
	$cuenta = "sgcco_root";
	$password = "sgcpasarela12345**";
	$database = "sgcconsu_manna";

/*
	// Produccion
	$servidor = "host";
	$cuenta = "corpmann_root";
	$password = "manna12345##";
	$database = "corpmann_manna";
*/

$link = @mysql_connect($servidor, $cuenta, $password) or die ("Error al conectar al servidor.");
@mysql_select_db($database, $link) or die ("Error al conectar a la base de datos.");
date_default_timezone_set('America/Caracas');

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
