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
			$query = "delete from eventos where id=".trim($cod);
		} else {
			$activo = (isset($_POST["activo_#_".$cod])) ? 1 : 0 ;
			$query = "update eventos set evento='".$_POST["evento_#_".$cod]."', descripcion='".$_POST["descripcion_#_".$cod]."', inicio=".$_POST["inicio_#_".$cod].' where id='.trim($cod);
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
echo '<pre>';
var_dump($_POST);
echo '</pre>';
echo '<br>';
echo '<pre>';
var_dump($_FILES);
echo '</pre>';

if ($_POST["evento_#_new"]<>'') {
	print "</pre>";
	$query = "insert into eventos (evento,descripcion,inicio) values ('".$_POST["evento_#_new"]."','".$_POST["descripcion_#_new"]."','".$_POST["inicio_#_new"]."')";
	$result = mysql_query($query,$link);
	echo 'new - '.$query.'<br>';
} else {
    echo "No hay fichero.\n";
}

$cadena = 'Location: inicio.php?user='.$_SESSION['user']; 
header($cadena);

?>
