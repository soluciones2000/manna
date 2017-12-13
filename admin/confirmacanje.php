<?php 
include_once("conexion.php");
foreach ($_POST as $key => $value) {
	if ($_POST[$key]) {
		
		$query = "select tit_nombres,tit_apellidos from afiliados where tit_codigo='".trim($key)."'";
		$result = mysql_query($query,$link);
		$row = mysql_fetch_array($result);
		$afil_nombres = trim($row["tit_nombres"]).' '.trim($row["tit_apellidos"]);

		$query = "SELECT sum(puntos) as pts from det_180 where afiliado='".trim($key)."'";
		$result = mysql_query($query,$link);
		$row = mysql_fetch_array($result);
		$pts = $row["pts"];

		$query = "INSERT INTO det_180 (afiliado, afil_nombres, fectr, tipo_trans, nombre_trans, puntos, id_trans_origen, id_trans, status_180, vencimiento) VALUES ('".trim($key)."', '".$afil_nombres."', '".date("Y-m-d")."', '71', 'Canje club 180', ".$pts.", 0, 0, 'Pagado', '".date("Y-m-d")."')";
		$result = mysql_query($query,$link);

		$query = "SELECT id FROM det_180 WHERE fectr='".date('Y-m-d')."' and afiliado='".trim($key)."' and tipo_trans='71'";
		$result = mysql_query($query,$link);
		$row = mysql_fetch_array($result);
		$id_trans = $row["id"];

		$query = "UPDATE det_180 SET status_180='Pagado', id_trans=".$id_trans." WHERE afiliado='".trim($key)."' and status_180='Pendiente' and tipo_trans<>'71'";
		$result = mysql_query($query,$link);

		$query = "SELECT valor_punto FROM empresa";
		$result = mysql_query($query,$link);
		$row = mysql_fetch_array($result);
		$valor_punto = $row["valor_punto"];
		$monto = $valor_punto*$pts;

		$query = "INSERT INTO billetera (afiliado, fecmov, mesmov, tipmov, numdoc, tipo_trans, concepto, creditos, debitos) VALUES ('".$key."', '".date("Y-m-d")."', '".date("m")."', 'Crédito', '".$id_trans."', 'CD', 'Canje puntos club 180 No. ".$id_trans."', ".$monto.", 0.00)";
		$result = mysql_query($query,$link);
	}
}
$cadena = 'Location: inicio.php?user='.$_SESSION['user']; 
header($cadena);
?>
