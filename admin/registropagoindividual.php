<?php 
include_once("conexion.php");
$query = "SELECT * FROM repbonoafilindiv";
$result = mysql_query($query,$link);
while($row = mysql_fetch_array($result)) {
	$id_trans_bono = $row['id_trans_bono'];
	$afiliado = $row['patroc_codigo'];
	$comision = $row['comision'];

	$quer2 = "INSERT INTO transacciones (fecha, afiliado, tipo, precio, monto, puntos, status_comision) VALUES ('".date('Y-m-d')."','".trim($afiliado)."','51',".$comision.",".$comision.",0,'Pagada')";
	$resul2 = mysql_query($quer2,$link);

	$quer2 = "SELECT id FROM transacciones WHERE fecha='".date('Y-m-d')."' and afiliado='".trim($afiliado)."' and tipo='51' and monto=".$comision;
	$resul2 = mysql_query($quer2,$link);
	$ro2 = mysql_fetch_array($resul2);
	$id_trans = $ro2["id"];

	$quer3 = "UPDATE detbonoafiliacion SET id_trans=".trim($id_trans).", status_bono='Pagado' WHERE status_bono='Pendiente' and id=".trim($id_trans_bono);
	$resul3 = mysql_query($quer3,$link);
}

$query = "SELECT patroc_codigo,sum(comision) as monto FROM repbonoafilindiv group by patroc_codigo order by patroc_codigo";
$result = mysql_query($query,$link);
while($row = mysql_fetch_array($result)) {
	$afiliado = $row['patroc_codigo'];
	$comision = $row['monto'];

	$query = "INSERT INTO billetera (afiliado, fecmov, mesmov, tipmov, numdoc, tipo_trans, concepto, creditos, debitos) VALUES ('".$afiliado."', '".date("Y-m-d")."', '".date("m")."', 'Crédito', '".date("Ymd").trim($afiliado)."', 'CA', 'Comisiones en cuenta No. ".date("Ymd").trim($afiliado)."', ".$comision.", 0.00)";
	$result = mysql_query($query,$link);
}

$cadena = 'Location: inicio.php?user='.$_SESSION['user']; 
header($cadena);
?>
