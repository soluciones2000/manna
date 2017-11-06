<?php 
include_once("conexion.php");
foreach ($_POST as $key => $value) {
	$query = "INSERT INTO transacciones (fecha, afiliado, tipo, precio, monto, puntos, status_comision) VALUES ('".date('Y-m-d')."','".trim($key)."','52',".$value.",".$value.",0,'Pagada')";
	echo $query.'<br>';
	$result = mysql_query($query,$link);

	$query = "SELECT id FROM transacciones WHERE fecha='".date('Y-m-d')."' and afiliado='".trim($key)."' and tipo='52'";
	echo $query.'<br>';
	$result = mysql_query($query,$link);
	$row = mysql_fetch_array($result);
	$id_trans = $row["id"];

	$query = "UPDATE detunilevel SET id_trans=".trim($id_trans).", status_unilevel='Pagado' WHERE status_unilevel='Pendiente' and organizacion='".trim($key)."'";
	echo $query.'<br><br>';
	$result = mysql_query($query,$link);

}
$cadena = 'Location: inicio.php?user='.$_SESSION['user']; 
header($cadena);
?>
