<?php 
include_once("conexion.php");
$query = "SELECT * FROM repunilevelindiv";
$result = mysql_query($query,$link);
while($row = mysql_fetch_array($result)) {
	$id_trans_unilevel = $row['id_trans_unilevel'];
	$afiliado = $row['organizacion'];
	$comision = $row['comision'];

	$quer2 = "INSERT INTO transacciones (fecha, afiliado, tipo, precio, monto, puntos, status_comision) VALUES ('".date('Y-m-d')."','".trim($afiliado)."','52',".$comision.",".$comision.",0,'Pagada')";
	$resul2 = mysql_query($quer2,$link);

	$quer2 = "SELECT id FROM transacciones WHERE fecha='".date('Y-m-d')."' and afiliado='".trim($afiliado)."' and tipo='52' and monto=".$comision;
	$resul2 = mysql_query($quer2,$link);
	$ro2 = mysql_fetch_array($resul2);
	$id_trans = $ro2["id"];

	$quer3 = "UPDATE detunilevel SET id_trans=".trim($id_trans).", status_unilevel='Pagado' WHERE status_unilevel='Pendiente' and id=".trim($id_trans_unilevel);
	$resul3 = mysql_query($quer3,$link);
}

$cadena = 'Location: inicio.php?user='.$_SESSION['user']; 
header($cadena);
?>
