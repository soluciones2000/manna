<?php 
include_once("conexion.php");
session_start();

$query = "Select * from afiliados where tit_codigo='".trim($_SESSION["codigo"])."'";
$result = mysql_query($query,$link);
if ($row = mysql_fetch_array($result)) {
	if ($envio) {
		$direccion_envio = $row["direccion_envio"];
	} else {
		$direccion_envio = 'Calle '.trim($row["calle"]).',cruce '.trim($row["cruce"]).', casa No. '.trim($row["casa"]).', piso '.trim($row["piso"]).', apto. '.trim($row["apto"]).', sector '.trim($row["sector"]).', referencia '.trim($row["referencia"]).', parroquia '.trim($row["parroquia"]).', ciudad '.trim($row["ciudad"]).', municipio '.trim($row["municipio"]).', estado '.trim($row["estado"]).', Código postal '.trim($row["cod_postal"]).', país '.trim($row["pais"]);
	}	
} 
$codigo = $_SESSION["codigo"];
$tipo_orden = 'Afiliado';
$patroc_codigo = $_SESSION["codigo"];
$fecha = date('Y-m-d H:i:s');
$treal = $_SESSION["treal"]*(1+($_SESSION["iva2"]/100));
$monto = $_SESSION["monto"]*(1+($_SESSION["iva2"]/100));
$valor_comisionable = $_SESSION["comisionable"];
$puntos = $_SESSION["puntos"];

$error = false;
$query = "INSERT INTO ordenes (codigo, tipo_orden, patroc_codigo, fecha, montodoc, monto, valor_comisionable, puntos, montoreal, direccion_envio, id_transaccion, status_orden) VALUES ('".$codigo."','".$tipo_orden."','".$patroc_codigo."','".$fecha."',".$monto.",".$monto.",".$valor_comisionable.",".$puntos.",".$treal.",'".$direccion_envio."',0,'Pendiente')";
if ($result = mysql_query($query,$link)) {
	$mensaje3 = "no falló";
	$query = "select orden_id from ordenes where codigo='".$codigo."' and fecha='".$fecha."'";
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		$mensaje2 = "no falló";
		$orden_id = $row["orden_id"];
		foreach ($_SESSION["orden"] as $prod => $value) {
			$id_pro = $prod;
			$cantidad = $_SESSION["orden"][$prod];
			$prreal = $_SESSION["precioreal"][$prod]*(1+($_SESSION["iva2"]/100));
			$precio = $_SESSION["precio_pro"][$prod]*(1+($_SESSION["iva2"]/100));
			$valor_comisionable = $_SESSION["valor_comisionable_pro"][$prod];
			$puntos = $_SESSION["puntos_pro"][$prod];
			$query = "INSERT INTO det_orden (orden_id, id_pro, cantidad, precio, valor_comisionable, puntos, precioreal) VALUES (".$orden_id.",'".$id_pro."',".$cantidad.",".$precio.",".$valor_comisionable.",".$puntos.",".$prreal.")";
			if ($result = mysql_query($query,$link)) {
				$mensaje1 = "no falló";
				$error = false;
			} else {
				$error = true;
				$mensaje1 = "falló";
				break;
			}
		}
	} else {
		$mensaje2 = "falló";
		$error = true;
	}
} else {
	$mensaje3 = "falló";
	$error = true;
}
if ($error) {
	$cadena = 'Location: error.php'; 
	header($cadena);
} else {
	// $monto = round($monto + ($monto*$_SESSION["iva1"]/100),2);
	include_once('../apis/pagoflash.api.client.php');

	$urlCallbacks = "https://www.corporacionmanna.com/plataforma/oficina";
	// Llaves de SGC ------------------ O J O
	// $key_public = "XKA20Z8USB8BES5TYUQ1";
	// $key_secret = "W1RNW52YCU715US6BHNIVVZB21BKT6";
	// Llaves de Manna ------------------ O J O
	$key_public = "6JV0CJRKD0Z6KDHA2TCB";
	$key_secret = "YKR7I8L63Y85D6GE7BKIP3F3WUPKP7";
	// ------------------ O J O
	$api = new apiPagoflash($key_public,$key_secret, $urlCallbacks, false);
	$cabeceraDeCompra = array(
		    "pc_order_number"   => trim(strval($orden_id)),
		    "pc_amount"         => trim(strval($monto)) 
		);

	$ProductItems = array();
	//La información conjunta para ser procesada
	$pagoFlashRequestData = array(
	    'cabecera_de_compra'    => $cabeceraDeCompra, 
	    'productos_items'       => $ProductItems,
	    "additional_parameters" => array(
	            "url_ok_redirect" =>'https://www.corporacionmanna.com/plataforma/oficina/exitotc.php?orden='.trim($orden_id), // en esta url le muestas a tu cliente que el pago fue exitoso
	            "url_ok_request" => "https://www.corporacionmanna.com/plataforma/oficina/procesarpagoenlinea.php" // en esta url debes verificar la transaccion
	        )
	);
	//Se realiza el proceso de pago, devuelve JSON con la respuesta del servidor
	$response = $api->procesarPago($pagoFlashRequestData, $_SERVER['HTTP_USER_AGENT']);
	$pfResponse = json_decode($response);

	//Si es exitoso, genera y guarda un link de pago en (url_to_buy) el cual se usará para redirigir al formulario de pago
	if($pfResponse->success){
	    header("Location: ".$pfResponse->url_to_buy);
	}else{
	    //manejo del error.
	}
}
?>