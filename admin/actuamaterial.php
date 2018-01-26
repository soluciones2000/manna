<?php 
include_once("conexion.php");

$first = true;
$cod = '';
$campos = array();
foreach ($_POST as $key => $value) {
	if ($first) {
		$cod = substr($key,strpos($key,'_#_')+3);
		$first = false;
	}
	if($cod<>substr($key,strpos($key,'_#_')+3)) {

		if (isset($_POST["borrar_#_".$cod])) {
			$query = "delete from material where id=".trim($cod);	
		} else {
			$activo = (isset($_POST["activo_#_".$cod])) ? 1 : 0 ;
			$query = "update material set nombre='".$_POST["nombre_#_".$cod]."', archivo='".$_POST["archivo_#_".$cod]."', descripcion='".$_POST["descripcion_#_".$cod]."', activo=".$activo.' where id='.trim($cod);
		}
		echo $cod.' - '.$query.'<br>';
		$result = mysql_query($query,$link);
		// foreach ($campos as $clave => $valor) {
		// 	echo $cod.' - '.$clave.' - '.$valor.'<br>';
		// }
		// echo '<br><br>';
		$cod = substr($key,strpos($key,'_#_')+3);
	}
}
if ($_POST["archivo_#_new"]<>'') {
	$query = "insert into material values (nombre,archivo,descripcion,fecha,activo) values ('".$_POST["nombre_#_new"]."','".$_POST["archivo_#_new"]."','".$_POST["descripcion_#_new"]."','".date("Y-m-d")."',1)";
	echo 'new - '.$query.'<br>';
}


$cadena = 'Location: inicio.php?user='.$_SESSION['user']; 
header($cadena);
?>
