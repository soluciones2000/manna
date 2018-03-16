<?php 
include_once("conexion.php");
echo '<pre>';
var_dump($_POST);
echo '<br>';
var_dump($_GET);
echo '<br>';
var_dump($_REQUEST);
echo '</pre>';
/*
include_once('../apis/pagoflash.api.client.php');

$urlCallbacks = "https://pruebas.sgc-consultores.com.ve/oficina";
$key_public = "GLVCQ44WPZMRT46FPI6O";
$key_secret = "WG6YAFNH5AVN7AZKGAOTUGLV8DQ78A";
$api = new apiPagoflash($key_public,$key_secret, $urlCallbacks,true);

$cabeceraDeCompra = array(
	    "pc_order_number"   => trim(strval($_POST["orden_id"])),
	    "pc_amount"         => trim(strval($_POST["monto"])) 
	);

	$ProductItems = array();
/*
	foreach ($_SESSION["orden"] as $prod => $value) {
		$id_pro = $prod;
		$cantidad = $_SESSION["orden"][$prod];
		$precio = $_SESSION["precio_pro"][$prod];
		$valor_comisionable = $_SESSION["valor_comisionable_pro"][$prod];
		$puntos = $_SESSION["puntos_pro"][$prod];

		$product_1 = array(
		    'pr_id'    => $id_pro,
		    'pr_name'    => 'Producto '.strval($id_pro), 
		    'pr_desc'    => '', 
		    'pr_price'   => strval($precio),
		    'pr_qty'     => strval($cantidad), 
		    'pr_img'     => '' 
		);

		array_push($ProductItems, $product_1);
	}
*/
	//La información conjunta para ser procesada
/*	$pagoFlashRequestData = array(
	    'cabecera_de_compra'    => $cabeceraDeCompra, 
	    'productos_items'       => $ProductItems,
	    "additional_parameters" => array(
	            "url_ok_redirect" =>'https://pruebas.sgc-consultores.com.ve/oficina/exito.php?orden='.trim($_POST["orden_id"]), // en esta url le muestas a tu cliente que el pago fue exitoso
	            "url_ok_request" => "https://pruebas.sgc-consultores.com.ve/oficina/procesarpagoenlinea.php" // en esta url debes verificar la transaccion
	        )
	);

	//Se realiza el proceso de pago, devuelve JSON con la respuesta del servidor
	$response = $api->procesarPago($pagoFlashRequestData, $_SERVER['HTTP_USER_AGENT']);
	$pfResponse = json_decode($response);


	//Si es exitoso, genera y guarda un link de pago en (url_to_buy) el cual se usará para redirigir al formulario de pago
	if($pfResponse->success){
	    ?>
	    <a href="<?php echo $pfResponse->url_to_buy ?>">Pagar</a>
	    <?php
	    //header("Location: ".$pfResponse->url_to_buy);
	}else{
	    //manejo del error.
	}
*/
?>
