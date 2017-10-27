<?php 
include_once("conexion.php");
$email = isset($_SESSION['clte_email']) ? $_SESSION['clte_email'] : '';
$_SESSION["ruta"] = isset($_GET['ruta']) ? $_GET['ruta'] : '';
if ($email<>"") {
	$query = "SELECT * from cliente_preferencial WHERE clte_email='".trim($email)."'";
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		$_SESSION["email"] = $row["clte_email"];
		if ($_SESSION["ruta"]=="orden") {
			$cadena = 'Location: resumen.php'; 
		} elseif ($_SESSION["ruta"]=="tracking") {
			$cadena = 'Location: tracking.php'; 
		} else {
			$cadena = 'Location: pago.php'; 
		}
/*	} else {
		$_SESSION["email"] = $email;
		$cadena = 'Location: datoscliente.php'; */
	}
/*} else {
	$cadena = 'Location: logincliente.php?error=cb'; */
}
header($cadena);
?>
