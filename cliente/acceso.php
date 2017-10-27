<?php 
include_once("conexion.php");

$codigo = isset($_POST['codigo']) ? strtoupper($_POST['codigo']) : '';

if ($codigo<>"") {
	$query = "SELECT * from cliente_preferencial WHERE cod_corto_clte='".trim($codigo)."'";
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		session_start();
		$_SESSION['patroc_codigo'] = trim($row["patroc_codigo"]);
		$_SESSION['user'] = trim($row["clte_nombre"]);
		$_SESSION['cod_clte'] = trim($row["cod_clte"]);
		$_SESSION['cod_corto_clte'] = $codigo;
		$_SESSION['clte_email'] = trim($row["clte_email"]);

		unset($_SESSION["orden"]);
		unset($_SESSION["pvp_clipref"]);
		unset($_SESSION["com_clipref"]);
		unset($_SESSION["pts_clipref"]);

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
