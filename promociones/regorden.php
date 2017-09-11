<?php 
include_once("conexion.php");
include_once("cabecera.php");
echo '<div id="cuerpo">';
	echo '<div style="text-align:center">';
		echo '<h3>PEDIDOS CON TICKETS DE PROMOCIÓN</h3>';
	echo '</div>';
	echo '<div style="text-align:center">';
		echo '<h4><font color="red">Se ha enviado un email con los detalles del pedido</font></h4>';
	echo '</div>';

$quer1 = "SELECT * FROM tickets where id=".$_POST["id"];
$resul1 = mysql_query($quer1,$link);
$ro1 = mysql_fetch_array($resul1);
$promo_id = $ro1["promo_id"];
$ticket = $ro1["ticket"];
$codigo = $ro1["codigo"];
$cedula = $ro1["cedula"];
$nombre = $ro1["nombre"];
$direccion = $ro1["direccion"];
$telefono = $ro1["telefono"];
$email = $ro1["email"];
$fecha = date("Y-m-d H:i:s");

$quer2 = "SELECT * FROM kits_promocion where promo_id=".$promo_id." order by id";
$resul2 = mysql_query($quer2,$link);
$total = 0.00;
$totmp = 0;
while($ro2 = mysql_fetch_array($resul2)) {
	$promo_kit = $ro2["promo_kit"];
	$promo_precio = $ro2["promo_precio"];
	$promo_puntos = $ro2["promo_puntos"];
	$cantidad = $_POST[trim($promo_kit)];
	$total += $cantidad*$promo_precio;
	$totmp += $cantidad*$promo_puntos;
}

$quer3 = "INSERT INTO ordenes_promocion (promo_id, ticket, codigo, cedula, fecha, monto, promo_puntos) VALUES (".$promo_id.",'".trim($ticket)."','".trim($codigo)."','".trim($cedula)."','".$fecha."',".$total.",".$totmp.")";
$resul3 = mysql_query($quer3,$link);

$quer4 = "SELECT * FROM ordenes_promocion where promo_id=".$promo_id." and ticket='".trim($ticket)."' and codigo='".trim($codigo)."' and cedula='".trim($cedula)."' and fecha='".$fecha."'";
$resul4 = mysql_query($quer4,$link);
$ro4 = mysql_fetch_array($resul4);
$orden_id = $ro4["orden_id"];

$mensaje = "Orden de pedido No. ".$orden_id."<br>";
$mensaje .= "Fecha: ".substr($fecha,8,2)."/".substr($fecha,5,2)."/".substr($fecha,0,4)."<br>";
if ($codigo<>"") {
	$mensaje .= "Participante: ".trim($codigo)." - ".trim($nombre)." C.I. ".trim($cedula)."<br>";
} else {
	$mensaje .= "Participante: ".trim($nombre)." C.I. ".trim($cedula)."<br>";
}
$mensaje .= "Dirección: ".$direccion."<br>";
$mensaje .= "Teléfono: ".$telefono."<br>";
$mensaje .= "--------------------------------------------------<br>";


$quer5 = "SELECT * FROM kits_promocion where promo_id=".$promo_id." order by id";
$resul5 = mysql_query($quer5,$link);

$tota2 = 0.00;
$tomp2 = 0;
while($ro5 = mysql_fetch_array($resul5)) {
	$promo_kit = $ro5["promo_kit"];
	$promo_precio = $ro5["promo_precio"];
	$promo_nombre = $ro5["promo_nombre"];
	$promo_puntos = $ro5["promo_puntos"];
	$cantidad = $_POST[trim($promo_kit)];
	if ($cantidad<>0) {
		$tota2 += $cantidad*$promo_precio;
		$tomp2 += $cantidad*$promo_puntos;

		$quer6 = "INSERT INTO det_orden_promocion (orden_id, promo_kit, cantidad, promo_precio, promo_puntos) VALUES (".$orden_id.",'".$promo_kit."',".$cantidad.",".$promo_precio.",".$promo_puntos.")";
		$resul6 = mysql_query($quer6,$link);
		if ($codigo<>"") {
			$mensaje .= "Kit: ".trim($promo_kit)." - ".trim($promo_nombre).", cantidad: ".$cantidad." x ".number_format($promo_precio,2,',','.')." = Bs. ".number_format($cantidad*$promo_precio,2,',','.')." - MP ".number_format($cantidad*$promo_puntos,0,',','.')."<br>";
		} else {
			$mensaje .= "Kit: ".trim($promo_kit)." - ".trim($promo_nombre).", cantidad: ".$cantidad." x ".number_format($promo_precio,2,',','.')." = Bs. ".number_format($cantidad*$promo_precio,2,',','.')."<br>";			
		}
	}
}
$mensaje .= "==================================================<br>";
$mensaje .= "TOTAL A PAGAR Bs. ".number_format($tota2,2,',','.')."<br>";
if ($codigo<>"") {
	$mensaje .= "TOTAL MP: ".number_format($tomp2,0,',','.')."<br>";
}
$asunto = "Orden de pedido promoción experiencia Manna: ".$orden_id;
$cabeceras = 'Content-type: text/html;';
mail("soluciones2000@gmail.com,baudetguerra@gmail.com",$asunto,$mensaje,$cabeceras);

$mensaje .= "<br>";
$mensaje .= "Para hacer efectivo el pedido debe realizar el depósito o transferencia de este monto y enviarlo por email a depositosbancarios@corporacionmanna.com<br>";

$asunto = "Orden de pedido promoción experiencia Manna: ".$orden_id;
$cabeceras = 'Content-type: text/html;';
mail($email,$asunto,$mensaje,$cabeceras);

echo '<div>';
echo $mensaje;
echo '</div>';
echo '<br>';
echo '<form method="post" action="index.php">';
echo '<INPUT type="submit" value="Volver al inicio">';
echo '</form>';
echo '</div>';
?>
