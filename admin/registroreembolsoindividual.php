<?php 
include_once("conexion.php");
$query = "SELECT * FROM repreembolsoindiv";
$result = mysql_query($query,$link);
while($row = mysql_fetch_array($result)) {
	$id_trans_reembolso = $row['id_trans_reembolso'];
	$afiliado = $row['afiliado'];
	$comision = $row['comision'];

	$quer2 = "INSERT INTO transacciones (fecha, afiliado, tipo, precio, monto, puntos, status_comision) VALUES ('".date('Y-m-d')."','".trim($afiliado)."','53',0.00,".$comision.",0,'Pagada')";
	$resul2 = mysql_query($quer2,$link);

	$quer2 = "SELECT id FROM transacciones WHERE fecha='".date('Y-m-d')."' and afiliado='".trim($afiliado)."' and tipo='53' and monto=".$comision;
	$resul2 = mysql_query($quer2,$link);
	$ro2 = mysql_fetch_array($resul2);
	$id_trans = $ro2["id"];

	$quer3 = "UPDATE reembolso SET trans_id=".trim($id_trans).", status_comision='Pagado' WHERE status_comision='Pendiente' and id=".trim($id_trans_reembolso);
	$resul3 = mysql_query($quer3,$link);
}

$cadena = 'Location: inicio.php?user='.$_SESSION['user']; 
header($cadena);
?>
