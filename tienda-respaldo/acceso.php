<?php 
include_once("conexion.php");

$password = isset($_POST['password']) ? $_POST['password'] : '';

if ($password<>'') {
	$query = "SELECT * from usuarios WHERE user_pass='".trim($password)."'";
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		$codigo = $row["codigo"];
		if ($codigo=='00000' or $codigo=='00005') {
			session_start();
			$_SESSION['user'] = $row["name_user"];
			$cadena = 'Location: inicio.php?user='.$row["name_user"]; 
		} else {
			session_destroy();
			$cadena = 'Location: index.php?error=nu'; 
		}
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
