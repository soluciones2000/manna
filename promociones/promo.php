<?php 
include_once("conexion.php");
include_once("cabecera.php");
// $ticket = isset($_POST['ticket']) ? $_POST['ticket'] : '00000';
$ticket = '00000';
$cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '00000000';

$quer1 = "SELECT * FROM promociones where status='Activa' and fecha_limite>='".date('Y-m-d')."'";
$resul1 = mysql_query($quer1,$link);
if ($ro1 = mysql_fetch_array($resul1)) {
	$promo_id = $ro1["promo_id"];
	$fecha_limite = $ro1["fecha_limite"];
	// $ticket1 = $ro1["ticket1"];
	// $ticket2 = $ro1["ticket2"];
	// if ($ticket>=$ticket1 and $ticket<=$ticket2) {
	// 	$quer2 = "SELECT * FROM tickets where promo_id=".$promo_id." and ticket='".$ticket."' and cedula='".$cedula."'";
	// 	$resul2 = mysql_query($quer2,$link);
	// 	if ($ro2 = mysql_fetch_array($resul2)) {
	// 		$id = $ro2["id"];
	// 		$cadena = "Location: pedidopromo.php?id=".trim($id); 
	// 		header($cadena);
	// 	} else {
			$cadena = "Location: datospromo.php?id=".trim($promo_id)."&ticket=".trim($ticket)."&cedula=".trim($cedula); 
			header($cadena);
		// }
	// } else {
	// 	$st = 'tfdr';
	// 	$cadena = "Location: index.php?st=".trim($st); 
	// 	header($cadena);
	// }
} else {
	$st = 'na';
	$cadena = "Location: index.php?st=".trim($st); 
	header($cadena);
}
?>
