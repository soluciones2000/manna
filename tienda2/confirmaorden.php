<?php 
include_once("conexion.php");

$query = "Select * from clientes where email='".trim($_SESSION["email"])."'";
$result = mysql_query($query,$link);
if ($row = mysql_fetch_array($result)) {
	$codigo = $row["cod_corto_clte"];
} 
$tipo_orden = 'Cliente';
$patroc_codigo = $_SESSION["codigo"];
$fecha = date('Y-m-d H:i:s');
$monto = $_SESSION["monto"]*(1+($_SESSION["iva2"]/100));
$valor_comisionable = $_SESSION["comisionable"];
$puntos = $_SESSION["puntos"];
$direccion_envio = $_SESSION["direccion_envio"];

$error = false;
$query = "INSERT INTO ordenes (codigo, tipo_orden, patroc_codigo, fecha, monto, valor_comisionable, puntos, direccion_envio,id_transaccion,status_orden) VALUES ('".$codigo."','".$tipo_orden."','".$patroc_codigo."','".$fecha."',".$monto.",".$valor_comisionable.",".$puntos.",'".$direccion_envio."',0,'Pendiente')";
//echo $query.'<br>';
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
			$precio = $_SESSION["precio_pro"][$prod]*(1+($_SESSION["iva2"]/100));
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
} else {
	$query = "SELECT * from clientes WHERE email='".trim($_SESSION["email"])."'";
	$result = mysql_query($query,$link);
	$row = mysql_fetch_array($result);
	$cliente = $row["nombre"];
	$cedula = $row["cedula"];
	$telefono = $row["telefono"];
	$direccion = $row["direccion"];
	$direccion_envio = $row["direccion_envio"];
	$_SESSION["direccion_envio"] = $direccion_envio;
	$mensaje = '';
	$mensaje .= '<b>'.utf8_decode('Número de Orden: ').trim($orden_id).'</b><br>';
	$mensaje .= '<b>Cliente: '.utf8_decode(trim($cliente)).'</b>, C.I. '.number_format($cedula,0,',','.').'<br>';
	$mensaje .= '<b>'.utf8_decode('Teléfono: ').'</b>'.trim($telefono).'<br>';
	$mensaje .= '<b>'.utf8_decode('Dirección: ').'</b>'.utf8_decode(trim($direccion)).'<br><br>';
	$mensaje .= '<b>Referido por: '.trim($patroc_codigo).' - '.trim($_SESSION['referido']).'</b><br><br>';
	$mensaje .= '<b>Enviar a: </b>'.utf8_decode(trim($direccion_envio)).'<br><br>';
	$mensaje .= '<table border="1" width="auto">';
		$mensaje .= '<tr>';
			$mensaje .= '<th align="center" width="380px">'.utf8_decode('Descripción').'</th>';
			$mensaje .= '<th align="center" width="100px">Cantidad</th>';
			$mensaje .= '<th align="center" width="105px">Precio</th>';
			$mensaje .= '<th align="center" width="120px">A pagar</th>';
		$mensaje .= '</tr>';
		$subtotal = 0.00;
		foreach ($_SESSION["orden"] as $prod => $value) {
			$query = "SELECT * FROM productos where id_pro='".$prod."'";
			$result = mysql_query($query,$link);
			if ($row = mysql_fetch_array($result)) {
				$id_pro = $row["id_pro"];
				$desc_corta = utf8_encode($row["desc_corta"]);
				$precio_pro = $row["precio_pro"]/round(1+($_SESSION["iva1"]/100),2);
				$valor_comisionable_pro = $row["valor_comisionable_pro"];
				$puntos_pro = $row["puntos_pro"];
				$_SESSION["precio_pro"][$prod] = $precio_pro;
				$mensaje .= '<tr>';
					$mensaje .= '<td align="left" width="380px">'.trim($id_pro).' - '.trim($desc_corta).'</td>';
					$mensaje .= '<td align="center" width="100px">'.number_format($_SESSION["orden"][$prod],0,',','.').'</td>';
					$mensaje .= '<td align="right" width="105px">Bs. '.number_format($precio_pro,2,',','.').'</td>';
					$mensaje .= '<td align="right" width="120px">Bs. '.number_format($_SESSION["orden"][$prod]*$precio_pro,2,',','.').'</td>';
					$subtotal += $_SESSION["orden"][$prod]*$precio_pro;
				$mensaje .= '</tr>';
			}
		}
		$mensaje .= '<tr>';
			$mensaje .= '<td> </td>';
			$mensaje .= '<td> </td>';
			$mensaje .= '<td align="right"><b>SUBTOTAL</b></td>';
//			$mensaje .= '<td colspan="3" align="right"><b>SUBTOTAL</b></td>';
			$mensaje .= '<td align="right"><b>Bs. '.number_format($subtotal,2,',','.').'</b></td>';
		$mensaje .= '</tr>';
		$mensaje .= '<tr>';
			$mensaje .= '<td> </td>';
			$mensaje .= '<td> </td>';
			$mensaje .= '<td align="right"><b>I.V.A. '.number_format($_SESSION["iva1"],2,',','.').'% (*)</b></td>';
//			$mensaje .= '<td colspan="3" align="right"><b>I.V.A. '.number_format($_SESSION["iva1"],2,',','.').'% (*)</b></td>';
			$mensaje .= '<td align="right"><b>Bs. '.number_format($subtotal*$_SESSION["iva1"]/100,2,',','.').'</b></td>';
		$mensaje .= '</tr>';
		$mensaje .= '<tr>';
			$mensaje .= '<td> </td>';
			$mensaje .= '<td> </td>';
			$mensaje .= '<td align="right"><b>TOTAL ORDEN</b></td>';
//			$mensaje .= '<td colspan="3" align="right"><b>TOTAL ORDEN</b></td>';
			$mensaje .= '<td align="right"><b>Bs. '.number_format($subtotal+($subtotal*$_SESSION["iva1"]/100),2,',','.').'</b></td>';
		$mensaje .= '</tr>';
//		$mensaje .= '<tr>';
//			$mensaje .= '<td colspan="4" style="padding-right:2%;padding-left:2%;">';
//				$mensaje .= '<p align="justify"><b>(*)</b> Si el pago de esta orden se realiza utilizando un medio electrónico (transferencia bancaria) se calculará el I.V.A. utilizando una tasa del 9% cuando la compra sea inferior a Bs. 2.000.001,00. Si supera los Bs. 2.000.000,00 se utilizará la tasa del 7%.</p>';
//				$mensaje .= '<p align="justify">En tal sentido, si usted realiza el pago por medio electrónico usted deberá cancelar la cantidad de Bs.';
//					if ($subtotal>2000000) { $mensaje .= number_format($subtotal+($subtotal*$_SESSION["iva3"]/100),2,',','.'); }
//					else { $mensaje .= number_format($subtotal+($subtotal*$_SESSION["iva2"]/100),2,',','.'); }
//				$mensaje .= '.</p>';
//			$mensaje .= '</td>';
//		$mensaje .= '</tr>';
	$mensaje .= '</table>';
	$asunto = "Orden de pedido No.: ".trim($orden_id);
	$cabeceras = 'Content-type: text/html;';
	if (strpos($_SERVER["HTTP_HOST"],'localhost')===FALSE) {	           	
		mail("ordenesmanna@gmail.com",$asunto,$mensaje,$cabeceras);
		mail("soluciones2000@gmail.com",$asunto,$mensaje,$cabeceras);
		mail($_SESSION["email"],$asunto,$mensaje,$cabeceras);
	}
	unset($_SESSION["orden"]);
	unset($_SESSION["precio_pro"]);
	unset($_SESSION["valor_comisionable_pro"]);
	unset($_SESSION["puntos_pro"]);
	unset($_SESSION["email"]);

	$_SESSION['cantidad'] = 0;
	$_SESSION["monto"] = 0.00;
	$_SESSION["comisionable"] = 0.00;
	$_SESSION["puntos"] = 0;
//	$cadena = 'Location: exito.php';
	$cadena = 'Location: exito.php?orden='.trim($orden_id); 
}
/*
echo 'mensaje3 '.$mensaje3.'<br>';
echo 'mensaje2 '.$mensaje2.'<br>';
echo 'mensaje1 '.$mensaje1.'<br>';
echo 'mensaje '.$mensaje.'<br>';
*/
header($cadena);
?>
