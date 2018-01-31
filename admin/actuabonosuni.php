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
		$query = "update unilevel set rango='".$_POST["rango_#_".$cod]."', pm=".$_POST["pm_#_".$cod].", pmo=".$_POST["pmo_#_".$cod].", piernas=".$_POST["piernas_#_".$cod].", calif_piernas='".$_POST["calif_piernas_#_".$cod]."', n1=".$_POST["n1_#_".$cod].", n2=".$_POST["n2_#_".$cod].", n3=".$_POST["n3_#_".$cod].", n4=".$_POST["n4_#_".$cod].", n5=".$_POST["n5_#_".$cod].", n6=".$_POST["n6_#_".$cod].", n7=".$_POST["n7_#_".$cod].", n8=".$_POST["n8_#_".$cod]." where id=".trim($cod);
		echo $cod.' - '.$query.'<br>';
		$result = mysql_query($query,$link);
		// foreach ($campos as $clave => $valor) {
		// 	echo $cod.' - '.$clave.' - '.$valor.'<br>';
		// }
		// echo '<br><br>';
		$cod = substr($key,strpos($key,'_#_')+3);
	}
}

$cadena = 'Location: inicio.php?user='.$_SESSION['user']; 
header($cadena);

?>
