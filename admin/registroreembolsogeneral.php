<?php 
include_once("conexion.php");
foreach ($_POST as $key => $value) {
	$query = "INSERT INTO transacciones (fecha, afiliado, tipo, precio, monto, puntos, status_comision) VALUES ('".date('Y-m-d')."','".trim($key)."','53',0.00,".$value.",0,'Pagada')";
	echo $query.'<br>';
	$result = mysql_query($query,$link);

	$query = "SELECT id FROM transacciones WHERE fecha='".date('Y-m-d')."' and afiliado='".trim($key)."' and tipo='53'";
	echo $query.'<br>';
	$result = mysql_query($query,$link);
	$row = mysql_fetch_array($result);
	$id_trans = $row["id"];

	$query = "UPDATE reembolso SET trans_id=".trim($id_trans).", status_comision='Pagado' WHERE status_comision='Pendiente' and afiliado='".trim($key)."'";
	echo $query.'<br><br>';
	$result = mysql_query($query,$link);

	$query = "INSERT INTO billetera (afiliado, fecmov, mesmov, tipmov, numdoc, tipo_trans, concepto, creditos, debitos) VALUES ('".$key."', '".date("Y-m-d")."', '".date("m")."', 'Crédito', '".$id_trans."', 'CA', 'Comisiones en cuenta No. ".$id_trans."', ".$value.", 0.00)";
	$result = mysql_query($query,$link);
}
$cadena = 'Location: inicio.php?user='.$_SESSION['user']; 
header($cadena);
?>
