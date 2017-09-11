<?php 

$scope = "local";
//$scope = "pruebas";
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
	$servidor = "host";
	$cuenta = "corpmann_root";
	$password = "manna12345##";
	$database = "corpmann_manna";
}

$link = @mysql_connect($servidor, $cuenta, $password) or die ("Error al conectar al servidor.");
@mysql_select_db($database, $link) or die ("Error al conectar a la base de datos.");
date_default_timezone_set('America/Caracas');
/*
$query = "SELECT * FROM eventos where fecha >= '".date("Y-m-d")."' order by fecha";
$result = mysql_query($query,$link);
$row = mysql_fetch_array($result);


$nombre = utf8_encode($row["nombre"]);
$fecha = $row["fecha"];
$detalles = utf8_encode($row["detalles"]);
$facilitador = utf8_encode($row["facilitador"]);
$perfil = $row["perfil"];
$detperfil = utf8_encode($row["detperfil"]);
$imagen = $row["imagen"];
$nombreimg = $row["nombreimg"];
$query = "SELECT * FROM eventospasados";
$result = mysql_query($query,$link);
$row = mysql_fetch_array($result);
$pid = $row["idevento"];
$pnombre = utf8_encode($row["nombre"]);
$pfecha = $row["fecha"];
$pfoto1 = $row["foto1"];
$pfoto2 = $row["foto2"];
$pfoto3 = $row["foto3"];
$pfoto4 = $row["foto4"];
$pfoto5 = $row["foto5"];
$pfoto6 = $row["foto6"];
$pfoto7 = $row["foto7"];
$pfoto8 = $row["foto8"];
$pfoto9 = $row["foto9"];
*/
?>