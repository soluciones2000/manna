<?php 
include_once("conexion.php");
$codigo = isset($_POST['c']) ? $_POST['c'] : '';
$target = isset($_POST['target']) ? $_POST['target'] : '';
$monto = isset($_POST['monto']) ? $_POST['monto'] : 0.00;
$fecha = date("Y-m-d");
$mes = date("m");

$query = "INSERT INTO billetera (afiliado, fecmov, mesmov, tipmov, numdoc, tipo_trans, concepto, creditos, debitos) VALUES ('".$codigo."', '".$fecha."', '".$mes."', 'Débito', '".$target."', 'DC', 'Transferencia al afiliado ".$target."', 0.00, ".$monto.")";
echo $query.'<br>';
if ($result = mysql_query($query,$link)) {
	$query = "INSERT INTO billetera (afiliado, fecmov, mesmov, tipmov, numdoc, tipo_trans, concepto, creditos, debitos) VALUES ('".$target."', '".$fecha."', '".$mes."', 'Crédito', '".$codigo."', 'CE', 'Transferencia del afiliado ".$codigo."', ".$monto.", 0.00)";
	echo $query.'<br>';
	$result = mysql_query($query,$link);
	$cadena = 'Location: exito.php';
}
header($cadena);
?>
