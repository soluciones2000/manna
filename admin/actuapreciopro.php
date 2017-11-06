<?php 
include_once("conexion.php");
//$fecha = date("Y")."-".date("m")."-".sprintf("%'02d",(date("d")-1));
$query = "SELECT familia,id_pro FROM productos order by familia,id_pro";
$result = mysql_query($query,$link);
while ($row = mysql_fetch_array($result)) {
	$id_pro = $row["id_pro"];
	$quer2 = "UPDATE productos set precio_pro=".$_POST[$id_pro."#-#precio_pro"].", valor_comisionable_pro=".$_POST[$id_pro."#-#valor_comisionable_pro"].", puntos_pro=".$_POST[$id_pro."#-#puntos_pro"].", pvp_dist=".$_POST[$id_pro."#-#pvp_dist"].", com_dist=".$_POST[$id_pro."#-#com_dist"].", pts_dist=".$_POST[$id_pro."#-#pts_dist"].", pvp_clipref=".$_POST[$id_pro."#-#pvp_clipref"].", com_clipref=".$_POST[$id_pro."#-#com_clipref"].", pts_clipref=".$_POST[$id_pro."#-#pts_clipref"]." where id_pro='".trim($id_pro)."'";
	$resul2 = mysql_query($quer2,$link);
}
$cadena = 'Location: preciospro.php'; 
header($cadena);
?>
