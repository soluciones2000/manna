<?php 

//$scope = "local";
$scope = "produccion";
/*
if (strpos(base_url(),'localhost')!==FALSE) {
	$scope = "local";
} else {
	$scope = "produccion";
}
*/
if ($scope=="local") {
	// local
	$servidor = "localhost";
	$cuenta = "root";
	$password = "myapm";
	$database = "manna";
}

if ($scope=="pruebas") {
	// pruebas
	$servidor = "localhost:3306";
	$cuenta = "sgcco_root";
	$password = "sgcpasarela12345**";
	$database = "sgcconsu_manna";
}

if ($scope=="produccion") {
	// Produccion
	$servidor = "localhost:3306";
	$cuenta = "corporac_root";
	$password = "plataforma12345##";
	$database = "corporac_manna";
}

$link = @mysql_connect($servidor, $cuenta, $password) or die ("Error al conectar al servidor.");
@mysql_select_db($database, $link) or die ("Error al conectar a la base de datos.");
date_default_timezone_set('America/Caracas');
?>