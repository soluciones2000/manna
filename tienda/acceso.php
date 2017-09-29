<?php 
include_once("conexion.php");

$codigo = isset($_POST['codigo']) ? strtoupper($_POST['codigo']) : '';

if ($codigo<>"") {
	$query = "SELECT * from afiliados WHERE tit_codigo='".trim($codigo)."'";
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		session_start();
		$_SESSION['user'] = trim($row["tit_nombres"])." ".trim($row["tit_apellidos"]);
		$_SESSION['codigo'] = $codigo;
		unset($_SESSION["orden"]);
		unset($_SESSION["precio_pro"]);
		unset($_SESSION["valor_comisionable_pro"]);
		unset($_SESSION["puntos_pro"]);
		$_SESSION['cantidad'] = 0;
		$cadena = 'Location: inicio.php'; 
	} else {
		session_destroy();
		$cadena = 'Location: index.php?error=ci'; 
	}
} else {
	session_destroy();
	$cadena = 'Location: index.php?error=cb'; 
}
header($cadena);
?>
