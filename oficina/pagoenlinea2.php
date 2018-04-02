<?php 
include_once("conexion.php");
session_start();

$monto = $_GET["monto"];
$orden_id = $_GET["orden_id"];

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
            "url_ok_redirect" =>'https://www.corporacionmanna.com/plataforma/oficina/guardapago2.php?ord='.trim($_GET["orden_id"]).'&fch='.trim($_GET["fecha"]).'&mnt='.$monto, // en esta url le muestas a tu cliente que el pago fue exitoso
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
?>