<?php 
include_once("conexion.php");
$email = isset($_POST['email']) ? $_POST['email'] : '';
if ($email<>"") {
	$query = "SELECT * from clientes WHERE email='".trim($email)."'";
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		$_SESSION["email"] = $row["email"];
		if ($_SESSION["ruta"]=="orden") {
			$cadena = 'Location: resumen.php'; 
		} else {
			$cadena = 'Location: pago.php'; 
		}
	} else {
		$_SESSION["email"] = $email;
		$cadena = 'Location: datoscliente.php'; 
	}
} else {
	$cadena = 'Location: logincliente.php?error=cb'; 
}
header($cadena);
?>
