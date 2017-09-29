<?php 
include_once("conexion.php");

$codigo = isset($_POST['codigo']) ? strtoupper($_POST['codigo']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if ($codigo<>'') {
	if ($password<>'') {
		$query = "SELECT * from usuarios WHERE codigo='".trim($codigo)."' and user_pass='".trim($password)."'";
		$result = mysql_query($query,$link);
		if ($row = mysql_fetch_array($result)) {
			$_SESSION['codigo'] = $codigo;
			$_SESSION['user'] = $row["name_user"];
			$_SESSION['email'] = $row["user_email"];
			$cadena = 'Location: oficina.php'; 
		} else {
			session_destroy();
			$cadena = 'Location: index.php?error=ci'; 
		}
	} else {
		session_destroy();
		$cadena = 'Location: index.php?error=cb'; 
	}
} else {
	session_destroy();
	$cadena = 'Location: index.php?error=cb'; 
}
header($cadena);
?>
