<?php 

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
	$servidor = "host";
	$cuenta = "corpmann_root";
	$password = "manna12345##";
	$database = "corpmann_manna";
}

$link = @mysql_connect($servidor, $cuenta, $password) or die ("Error al conectar al servidor.");
@mysql_select_db($database, $link) or die ("Error al conectar a la base de datos.");
date_default_timezone_set('America/Caracas');
?>