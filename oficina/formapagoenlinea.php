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
$monto = $_SESSION["monto"];
$valor_comisionable = $_SESSION["comisionable"];
$puntos = $_SESSION["puntos"];

$error = false;
$query = "INSERT INTO ordenes (codigo, tipo_orden, patroc_codigo, fecha, monto, valor_comisionable, puntos, direccion_envio,id_transaccion,status_orden) VALUES ('".$codigo."','".$tipo_orden."','".$patroc_codigo."','".$fecha."',".$monto.",".$valor_comisionable.",".$puntos.",'".$direccion_envio."',0,'Pendiente')";
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
			$precio = $_SESSION["precio_pro"][$prod];
			$valor_comisionable = $_SESSION["valor_comisionable_pro"][$prod];
			$puntos = $_SESSION["puntos_pro"][$prod];
			$query = "INSERT INTO det_orden (orden_id, id_pro, cantidad, precio, valor_comisionable, puntos) VALUES (".$orden_id.",'".$id_pro."',".$cantidad.",".$precio.",".$valor_comisionable.",".$puntos.")";
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
	$monto = round($monto + ($monto*$_SESSION["iva1"]/100),2);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	include_once('../apis/pagoflash.api.client.php');

	$urlCallbacks = "https://pruebas.sgc-consultores.com.ve/oficina";
	$key_public = "GLVCQ44WPZMRT46FPI6O";
	$key_secret = "WG6YAFNH5AVN7AZKGAOTUGLV8DQ78A";
	$api = new apiPagoflash($key_public,$key_secret, $urlCallbacks,true);

	$cabeceraDeCompra = array(
		    "pc_order_number"   => trim(strval($orden_id)),
		    "pc_amount"         => trim(strval($monto)) 
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
	$pagoFlashRequestData = array(
	    'cabecera_de_compra'    => $cabeceraDeCompra, 
	    'productos_items'       => $ProductItems,
	    "additional_parameters" => array(
	            "url_ok_redirect" =>'https://pruebas.sgc-consultores.com.ve/oficina/exito.php?orden='.trim($orden_id), // en esta url le muestas a tu cliente que el pago fue exitoso
	            "url_ok_request" => "https://pruebas.sgc-consultores.com.ve/oficina/procesarpagoenlinea.php" // en esta url debes verificar la transaccion
	        )
	);

	//Se realiza el proceso de pago, devuelve JSON con la respuesta del servidor
	$response = $api->procesarPago($pagoFlashRequestData, $_SERVER['HTTP_USER_AGENT']);
	$pfResponse = json_decode($response);

	//Si es exitoso, genera y guarda un link de pago en (url_to_buy) el cual se usará para redirigir al formulario de pago
	if($pfResponse->success){
	    ?>
	    <!-- <a href="<?php echo $pfResponse->url_to_buy ?>">Pagar</a> -->
	    <?php
	    header("Location: ".$pfResponse->url_to_buy);
	}else{
	    //manejo del error.
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
	echo '
		<!doctype html>
		<html>
		  <head>
		    <meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="chrome=1">
		    <title>Pago en línea</title>
		    <link rel="stylesheet" href="../skeuocard/styles/skeuocard.reset.css" />
		    <link rel="stylesheet" href="../skeuocard/styles/skeuocard.css" />
		    <link rel="stylesheet" href="../skeuocard/styles/demo.css">
		    <script src="../skeuocard/javascripts/vendor/cssua.min.js"></script>
		    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		    <!--[if lt IE 9]>
		    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		    <![endif]-->
		  </head>
		  <body>
		      <header>
		        <h1>Pago en línea</h1>
		        <p>Usted está pagando la <b>orden No. '.$orden_id.'</b></p>
		        <p>El monto a cancelar es de <b>Bs. '.number_format($monto,2,',','.').'</b></p>
		        <p>Complete los datos de la tarjeta de crédito que se muestra a la derecha y pulse el botón enviar para procesar el pago.</p>
		      </header>
		      <section>
		        <!-- START FORM -->
		          <form method="post" action="procesapagoenlinea.php">
		            <div class="credit-card-input no-js" id="skeuocard">
		              <p class="no-support-warning">
		                Either you have Javascript disabled, or you are using an unsupported browser, amigo! That is why you are seeing this old-school credit card input form instead of a fancy new Skeuocard. On the other hand, at least you know it gracefully degrades...
		              </p>
		                <label for="cc_type">Tipo de tarjeta</label>
		                <select name="cc_type">
		                  <option value="">...</option>
		                  <option value="visa">Visa</option>
		                  <!-- <option value="discover">Discover</option> -->
		                  <option value="mastercard">MasterCard</option>
		                  <option value="maestro">Maestro</option>
		                  <!-- <option value="jcb">JCB</option> -->
		                  <!-- <option value="unionpay">China UnionPay</option> -->
		                  <option value="amex">American Express</option>
		                  <option value="dinersclubintl">Diners Club</option>
		                </select>
		                <label for="cc_number">Número de tarjeta</label>
		                <input type="text" name="cc_number" id="cc_number" placeholder="XXXX XXXX XXXX XXXX" maxlength="19" size="19">
		                <label for="cc_exp_month">Mes de expiración</label>
		                <input type="text" name="cc_exp_month" id="cc_exp_month" placeholder="00">
		                <label for="cc_exp_year">Año de expiración (2 dig.)</label>
		                <input type="text" name="cc_exp_year" id="cc_exp_year" placeholder="00">
		                <label for="cc_name">Nombre del tarjetahabiente</label>
		                <input type="text" name="cc_name" id="cc_name" placeholder="Su nombre">
		                <label for="cc_cvc">Codigo de verificación</label>
		                <input type="text" name="cc_cvc" id="cc_cvc" placeholder="123" maxlength="3" size="3">
		            </div>
		            <div style="padding-left:130px;">
		              <br>
		              <input type="hidden" name="orden" value="'.$orden_id.'">
		              <input type="hidden" name="monto" value="'.$monto.'">
		              <input type="submit" name="boton" value="Procesar pago">
		            </div>
		          </form>

		        <!-- END FORM -->
		      </section>
		<!-- 
		<pre>
		Visa: 4111111111111111
		Discover: 6011111111111117
		MasterCard: 5111111111111118
		Maestro: 5018111111111112
		JCB: 3511111111111119
		Union Pay: 6211111111111111
		American Express: 371111111111114
		Diners Club: 38111111111119
		</pre>
		 -->
		    <script src="../skeuocard/javascripts/vendor/demo.fix.js"></script>
		    <script src="../skeuocard/javascripts/vendor/jquery-2.0.3.min.js"></script>
		    <script src="../skeuocard/javascripts/skeuocard.js"></script>
		    <script>

		      $(document).ready(function(){
		        var isBrowserCompatible = 
		          $("html").hasClass("ua-ie-10") ||
		          $("html").hasClass("ua-webkit") ||
		          $("html").hasClass("ua-firefox") ||
		          $("html").hasClass("ua-opera") ||
		          $("html").hasClass("ua-chrome");

		        if(isBrowserCompatible){
		          window.card = new Skeuocard($("#skeuocard"), {
		            debug: false
		          });
		        }
		      });

		    </script>
		  </body>
		</html>';
*/
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
?>