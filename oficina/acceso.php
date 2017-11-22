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
			$_SESSION['rango'] = '';
			$_SESSION['pm'] = 0;
			$_SESSION['pmo'] = 0;

			$query = "SELECT * from afiliados WHERE tit_codigo='".trim($codigo)."'";
			$result = mysql_query($query,$link);
			if ($row = mysql_fetch_array($result)) {
				$_SESSION['rango'] = $row["rango"];
				$_SESSION['tipo_afiliado'] = $row["tipo_afiliado"];
				$_SESSION['flag'] = $row["flag"];

				$quer2 = "SELECT afiliado,sum(puntos) as puntos FROM transacciones where afiliado='".trim($codigo)."' and status_comision='Pendiente' and status_comision<>'No aplica'";
				$resul2 = mysql_query($quer2,$link);
				$ro2 = mysql_fetch_array($resul2);
				if ($ro2["puntos"]>0) {
					$_SESSION['pm'] = $ro2["puntos"];
				}

				$quer3 = "SELECT afiliado FROM organizacion where organizacion='".trim($codigo)."'";
				$resul3 = mysql_query($quer3,$link);
				$pmo = 0;
				while($ro3 = mysql_fetch_array($resul3)) {
					$quer4 = "SELECT sum(puntos) as pmo FROM transacciones where afiliado='".trim($ro3["afiliado"])."' and status_comision='Pendiente' and status_comision<>'No aplica'";
					$resul4 = mysql_query($quer4,$link);
					$ro4 = mysql_fetch_array($resul4);
					$_SESSION['pmo'] += $ro4["pmo"];
				}
				$_SESSION['pmo'] -= $_SESSION['pm'];
			} else {
				$_SESSION['rango'] = '';
				$_SESSION['tipo_afiliado'] = '';
				$_SESSION['pm'] = 0;
				$_SESSION['pmo'] = 0;
			}
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
