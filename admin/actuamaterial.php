<?php 
include_once("conexion.php");

$dir_subida = '../oficina/material/';
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
			if(unlink($dir_subida.$_POST["archivo_#_".$cod])) {
				echo 'Borró<br>';
			} else {
				echo 'No Borró<br>';
			}
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
echo '<pre>';
var_dump($_POST);
echo '</pre>';
echo '<br>';
echo '<pre>';
var_dump($_FILES);
echo '</pre>';

if ($_FILES["archivo_#_new"]["name"]<>'') {
	$fichero_subido = $dir_subida . basename($_FILES['archivo_#_new']['name']);

	echo '<pre>';
	var_dump($_FILES);
	echo $dir_subida.'<br>';
	echo $fichero_subido;

	if (move_uploaded_file($_FILES['archivo_#_new']['tmp_name'], $fichero_subido)) {
	    echo "El fichero es válido y se subió con éxito.\n";
	} else {
	    echo "¡Posible ataque de subida de ficheros!\n";
	}

	echo 'Más información de depuración:';
	print_r($_FILES);

	print "</pre>";
	$query = "insert into material (nombre,archivo,descripcion,fecha,activo) values ('".$_POST["nombre_#_new"]."','".$_FILES["archivo_#_new"]["name"]."','".$_POST["descripcion_#_new"]."','".date("Y-m-d")."',1)";
	$result = mysql_query($query,$link);
	echo 'new - '.$query.'<br>';
} else {
    echo "No hay fichero.\n";
}

$cadena = 'Location: inicio.php?user='.$_SESSION['user']; 
header($cadena);

?>
