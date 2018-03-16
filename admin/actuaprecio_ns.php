<?php
include_once("conexion.php");
include_once("funciones.php");

$cJson = (isset($_POST['cJson'])) ? $_POST['cJson'] : '' ;

$aRegistros = json_decode($cJson,true);

//var_dump($aRegistros);
echo json_last_error_msg();

//echo '<pre>';
foreach ($aRegistros as $key => $value) {
	$query = "select * from productos where id_pro='".trim($value["id_pro"])."'";
//	echo $query.'<br>';
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		$quer2 = "update productos set desc_pro='".trim($value["desc_pro"])."', precio_pro=".$value["precio_pro"].", valor_comisionable_pro=".$value["valor_comisionable_pro"].", puntos_pro=".$value["puntos_pro"].", pvp_dist=".$value["pvp_dist"].", com_dist=".$value["com_dist"].", pts_dist=".$value["pts_dist"].", pvp_clipref=".$value["pvp_clipref"].", com_clipref=".$value["com_clipref"].", pts_clipref=".$value["pts_clipref"].", desc_corta='".trim($value["desc_corta"])."', imagen='".trim($value["imagen"])."', familia='".trim($value["familia"])."', publico='".trim($value["publico"])."' where id_pro='".trim($value["id_pro"])."'";
	} else {
		$quer2 = "insert into productos (id_pro, desc_pro, precio_pro, valor_comisionable_pro, puntos_pro, pvp_dist, com_dist, pts_dist, pvp_clipref, com_clipref, pts_clipref, desc_corta, imagen, familia, publico) values ('".trim($value["id_pro"])."', '".trim($value["desc_pro"])."', ".$value["precio_pro"].", ".$value["valor_comisionable_pro"].", ".$value["puntos_pro"].", ".$value["pvp_dist"].", ".$value["com_dist"].", ".$value["pts_dist"].", ".$value["pvp_clipref"].", ".$value["com_clipref"].", ".$value["pts_clipref"].", '".trim($value["desc_corta"])."', '".trim($value["imagen"])."', '".trim($value["familia"])."', '".trim($value["publico"])."')";
	}
//	echo $quer2.'<br>';
	$resul2 = mysql_query($quer2,$link);
	echo $retVal = ($resul2) ? ' - '.trim($value["id_pro"]).' se actualizó OK ' : ' - '.trim($value["id_pro"]).' tiene errores ' ;
//	echo $retval.'<br><br>';
}
//echo '</pre>';
return true;
?>