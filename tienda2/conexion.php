<?php 
header('Content-Type: text/html; charset=UTF-8');
session_start();
if (strpos($_SERVER["SERVER_NAME"],'localhost')!==FALSE) {
	// local
	$servidor = "localhost";
	$cuenta = "root";
	$password = "myapm";
	$database = "manna";
} elseif (strpos($_SERVER["SERVER_NAME"],'pruebas')!==FALSE) {
	// pruebas
	$servidor = "localhost:3306";
	$cuenta = "sgcco_root";
	$password = "sgcpasarela12345**";
	$database = "sgcconsu_manna";
} else {
	// Produccion
	$servidor = "localhost:3306";
	$cuenta = "corporac_root";
	$password = "plataforma12345##";
	$database = "corporac_manna";
}

$link = @mysql_connect($servidor, $cuenta, $password) or die ("Error al conectar al servidor.");
@mysql_select_db($database, $link) or die ("Error al conectar a la base de datos.");
date_default_timezone_set('America/Caracas');

$query = "SELECT * FROM empresa";
$result = mysql_query($query,$link);
$row = mysql_fetch_array($result);
$_SESSION["iva1"] = $row["iva1"];
$_SESSION["iva2"] = $row["iva2"];
$_SESSION["iva3"] = $row["iva3"];
$_SESSION["valor_punto"] = $row["valor_punto"];
?>