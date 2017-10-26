<?php 
include_once("conexion.php");
echo '<pre>';
var_dump($_POST);
echo '</pre>';
foreach ($_POST as $key => $value) {
	$query = "INSERT INTO transacciones (fecha, afiliado, tipo, precio, monto, puntos, status_comision) VALUES ('".date('Y-m-d')."','".trim($key)."','51',".$value.",".$value.",0,'Pagada')";
	$result = mysql_query($query,$link);

	$query = "UPDATE transacciones SET status_comision='Pagada' WHERE tipo<'50' status_comision='Pendiente' and afiliado='".trim($key)."'";
	$result = mysql_query($query,$link);

}
$cadena = 'Location: inicio.php?user='.$_SESSION['user']; 
header($cadena);
?>
