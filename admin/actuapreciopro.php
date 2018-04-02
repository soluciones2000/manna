<?php 
include_once("conexion.php");
//$fecha = date("Y")."-".date("m")."-".sprintf("%'02d",(date("d")-1));

$query = "SELECT familia,id_pro FROM productos order by familia,id_pro";
$result = mysql_query($query,$link);
while ($row = mysql_fetch_array($result)) {
	$id_pro = $row["id_pro"];
	$aviso = (isset($_POST["aviso_#_".$id_pro])) ? 1 : 0 ;
	$quer2 = "UPDATE productos set precio_pro=".$_POST["precio_pro_#_".$id_pro].", valor_comisionable_pro=".$_POST["valor_comisionable_pro_#_".$id_pro].", puntos_pro=".$_POST["puntos_pro_#_".$id_pro].", pvp_dist=".$_POST["pvp_dist_#_".$id_pro].", com_dist=".$_POST["com_dist_#_".$id_pro].", pts_dist=".$_POST["pts_dist_#_".$id_pro].", pvp_clipref=".$_POST["pvp_clipref_#_".$id_pro].", com_clipref=".$_POST["com_clipref_#_".$id_pro].", pts_clipref=".$_POST["pts_clipref_#_".$id_pro].", aviso=".$aviso.", fecha_aviso='".$_POST["fecha_aviso_#_".$id_pro]."' where id_pro='".trim($id_pro)."'";
	$resul2 = mysql_query($quer2,$link);
}

$cadena = 'Location: preciospro.php'; 
header($cadena);
?>
