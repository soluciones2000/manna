<?php 
include_once("conexion.php");

$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$password1 = isset($_POST['password1']) ? $_POST['password1'] : '';
$pregunta = isset($_POST['pregunta']) ? $_POST['pregunta'] : '';
$respuesta = isset($_POST['respuesta']) ? $_POST['respuesta'] : '';
$valido = 0;
$error = '';

// echo '<pre>';
// var_dump($_POST);

if ($codigo<>'') {
	$query = "SELECT * from afiliados WHERE tit_codigo='".trim($codigo)."'";
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		$nombre = trim($row["tit_nombres"]).' '.trim($row["tit_apellidos"]);
		$email = trim($row["email"]);
		$valido++;
	} else {
		$error = $error<>'' ? $error : 'cin';
	}
} else {
	$error = $error<>'' ? $error : 'cvc';
}
// echo $nombre.'<br/>';

if ($password<>'') {
	if ($password1<>'') {
		if ($password==$password1) {
			$valido++;
		} else {
			$error = $error<>'' ? $error : 'pnc';
		}
	} else {
		$error = $error<>'' ? $error : 'cvc';
	}
} else {
	$error = $error<>'' ? $error : 'cvc';
}
	
if ($pregunta<>'') {
	$valido++;
} else {
	$error = $error<>'' ? $error : 'cvc';
}

	
if ($respuesta<>'') {
	$valido++;
} else {
	$error = $error<>'' ? $error : 'cvc';
}
// echo $valido.'<br/>';

if ($valido>3) {
	$query = "SELECT * from usuarios WHERE codigo='".trim($codigo)."'";
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		// echo 'existe'.'<br/>';
		$query = "UPDATE usuarios SET user_pass='".trim($password)."',pista='".trim($pregunta)."',respuesta='".trim($respuesta)."' WHERE codigo='".trim($codigo)."'";
		if ($result = mysql_query($query,$link)) {
			$cadena = 'Location: index.php?error=ok'; 
		} else {
			$cadena = 'Location: registro.php?error=upb'; 
		}
	} else {
		// echo 'no existe'.'<br/>';
		$campos = array($nombre,$email,$password,$pregunta,$respuesta,$codigo);
		$hallado = validacaracteres($campos,"'");
		// echo $retVal = ($hallado) ? "hallado" : "no hallado" ;
		// echo '<br>';
		if ($hallado) {
//			$query = 'INSERT INTO usuarios (name_user, user_email, user_pass, pista, respuesta, codigo) VALUES ("'.trim($nombre).'","'.trim($email).'","'.trim($password).'","'.trim($pregunta).'","'.trim($respuesta).'","'.trim($codigo).'")';
			$query = "INSERT INTO usuarios (name_user, user_email, user_pass, pista, respuesta, codigo) VALUES ('".trim(addslashes($nombre))."','".trim(addslashes($email))."','".trim(addslashes($password))."','".trim(addslashes($pregunta))."','".trim(addslashes($respuesta))."','".trim(addslashes($codigo))."')";
		} else {
			$query = "INSERT INTO usuarios (name_user, user_email, user_pass, pista, respuesta, codigo) VALUES ('".trim($nombre)."','".trim($email)."','".trim($password)."','".trim($pregunta)."','".trim($respuesta)."','".trim($codigo)."')";
		}
		// echo $query.'<br/>';
		if ($result = mysql_query($query,$link)) {
			$cadena = 'Location: index.php?error=ok'; 
		} else {
			// var_dump($result);
			$cadena = 'Location: registro.php?error=irb'; 
		}
	}
} else {
	$cadena = 'Location: registro.php?error='.$error; 
}
// echo $cadena;
// echo '</pre>';
header($cadena);

function validacaracteres($campos,$caracter) {
	foreach ($campos as $key => $value) {
		$pos = strpos($value, $caracter);
		if ($pos !== false) { return true; }
	}
}
?>
