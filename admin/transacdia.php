<?php 
include_once("conexion.php");
$fecha = date("Y")."-".date("m")."-".sprintf("%'02d",(date("d")-1));

$query = "SELECT transacciones.fecha,transacciones.afiliado,afiliados.tit_nombres,afiliados.tit_apellidos,transacciones.tipo,transacciones.monto,transacciones.documento,transacciones.bancoorigen FROM transacciones inner join afiliados on transacciones.afiliado=afiliados.tit_codigo where transacciones.fecha='".$fecha."'";
$result = mysql_query($query,$link);
$texto = 'Fecha: '.$fecha.'<br>';
$texto .= 'Fecha - Afiliado (Código y nombre) - Tipo - Monto - Documento - Banco origen<br>';
while($row = mysql_fetch_array($result)) {
    $fechapago = $row["fecha"];
    $afiliado = $row["afiliado"];
    $nombre_completo = trim($row["tit_nombres"])." ".trim($row["tit_apellidos"]);
    $monto = $row["monto"];
    $documento = $row["documento"];
    $bancoorigen = trim($row["bancoorigen"]);
	if ($row["tipo"]=='01') {
		$tipo = 'Afiliación';
	} else {
		$tipo = 'Consumo';
	}
	$texto .= $fechapago." - ".$afiliado." ".$nombre_completo." - ".$tipo." - ".number_format($monto,2,',','.')." - ".$documento." - ".$bancoorigen."<br>";
}
$asunto = "Transacciones del día: ".$fecha;
$mensaje = $texto;
$cabeceras = 'Content-type: text/html;';
mail("soluciones2000@gmail.com,ordenesmanna@gmail.com",$asunto,$mensaje,$cabeceras);
$cadena = 'Location: index.php'; 
header($cadena);

?>
