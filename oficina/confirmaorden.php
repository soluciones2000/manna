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
} else {
	$query = "SELECT * from afiliados WHERE tit_codigo='".trim($_SESSION["codigo"])."'";
	$result = mysql_query($query,$link);
	$row = mysql_fetch_array($result);
	$cliente = trim($row["tit_nombres"]).' '.trim($row["tit_apellidos"]);
	$cedula = $row["tit_cedula"];
	$telefono = trim($row["tel_local"]).' / '.trim($row["tel_celular"]);
	$direccion = 'Calle '.trim($row["calle"]).',cruce '.trim($row["cruce"]).', casa No. '.trim($row["casa"]).', piso '.trim($row["piso"]).', apto. '.trim($row["apto"]).', sector '.trim($row["sector"]).', referencia '.trim($row["referencia"]).', parroquia '.trim($row["parroquia"]).', ciudad '.trim($row["ciudad"]).', municipio '.trim($row["municipio"]).', estado '.trim($row["estado"]).', Código postal '.trim($row["cod_postal"]).', país '.trim($row["pais"]);
	$direccion_envio = $direccion_envio;
	$_SESSION["direccion_envio"] = $direccion_envio;
	$mensaje = '';
	$mensaje .= 'Número de Orden: <b>'.trim($orden_id).'</b><br>';
	$mensaje .= 'Cliente: '.trim($cliente).' C.I. '.number_format($cedula,0,',','.').'<br>';
	$mensaje .= 'Teléfono: '.trim($telefono).'<br>';
	$mensaje .= 'Dirección: '.trim($direccion).'<br>';
	$mensaje .= 'Enviar a: '.trim($direccion_envio).'<br>';
	$mensaje .= '<table border="1" width="auto">';
		$mensaje .= '<tr>';
			$mensaje .= '<th align="center" width="380px" style="padding:2%">Descripción</th>';
			$mensaje .= '<th align="center" width="105px">Precio</th>';
			$mensaje .= '<th align="center" width="100px">Cantidad</th>';
			$mensaje .= '<th align="center" width="120px">A pagar</th>';
		$mensaje .= '</tr>';
		$subtotal = 0.00;
		foreach ($_SESSION["orden"] as $prod => $value) {
			$query = "SELECT * FROM productos where id_pro='".$prod."'";
			$result = mysql_query($query,$link);
			if ($row = mysql_fetch_array($result)) {
				$id_pro = $row["id_pro"];
				$desc_corta = $row["desc_corta"];
				$precio_pro = $row["precio_pro"];
				$valor_comisionable_pro = $row["valor_comisionable_pro"];
				$puntos_pro = $row["puntos_pro"];
				$_SESSION["precio_pro"][$prod] = $precio_pro;
				$mensaje .= '<tr>';
					$mensaje .= '<td align="left" width="380px" style="padding:2%">'.trim($id_pro).' - '.trim($desc_corta).'</td>';
					$mensaje .= '<td align="right" width="105px">Bs. '.number_format($precio_pro,2,',','.').'</td>';
					$mensaje .= '<td align="center" width="100px">'.number_format($_SESSION["orden"][$prod],0,',','.').'</td>';
					$mensaje .= '<td align="right" width="120px">Bs. '.number_format($_SESSION["orden"][$prod]*$precio_pro,2,',','.').'</td>';
					$subtotal += $_SESSION["orden"][$prod]*$precio_pro;
				$mensaje .= '</tr>';
			}
		}
		$mensaje .= '<tr>';
			$mensaje .= '<td colspan="3" align="right" style="padding:2%;"><b>SUBTOTAL</b></td>';
			$mensaje .= '<td align="right"><b>Bs. '.number_format($subtotal,2,',','.').'</b></td>';
		$mensaje .= '</tr>';
		$mensaje .= '<tr>';
			$mensaje .= '<td colspan="3" align="right" style="padding:2%;"><b>I.V.A. '.number_format($_SESSION["iva1"],2,',','.').'% (*)</b></td>';
			$mensaje .= '<td align="right"><b>Bs. '.number_format($subtotal*$_SESSION["iva1"]/100,2,',','.').'</b></td>';
		$mensaje .= '</tr>';
		$mensaje .= '<tr>';
			$mensaje .= '<td colspan="3" align="right" style="padding:2%;"><b>TOTAL ORDEN</b></td>';
			$mensaje .= '<td align="right"><b>Bs. '.number_format($subtotal+($subtotal*$_SESSION["iva1"]/100),2,',','.').'</b></td>';
		$mensaje .= '</tr>';
		$mensaje .= '<tr>';
			$mensaje .= '<td colspan="4" style="padding-right:2%;padding-left:2%;">';
				$mensaje .= '<p align="justify"><b>(*)</b> Si el pago de esta orden se realiza utilizando un medio electrónico (transferencia bancaria) se calculará el I.V.A. utilizando una tasa del 9% cuando la compra sea inferior a Bs. 2.000.001,00. Si supera los Bs. 2.000.000,00 se utilizará la tasa del 7%.</p>';
				$mensaje .= '<p align="justify">En tal sentido, si usted realiza el pago por medio electrónico usted deberá cancelar la cantidad de Bs.';
					if ($subtotal>2000000) { $mensaje .= number_format($subtotal+($subtotal*$_SESSION["iva3"]/100),2,',','.'); }
					else { $mensaje .= number_format($subtotal+($subtotal*$_SESSION["iva2"]/100),2,',','.'); }
				$mensaje .= '.</p>';
			$mensaje .= '</td>';
		$mensaje .= '</tr>';
	$mensaje .= '</table>';
	$asunto = "Orden de pedido No.: ".trim($orden_id);
	$mensaje = $texto;
	$cabeceras = 'Content-type: text/html;';
	if (strpos($_SERVER["HTTP_HOST"],'localhost')===FALSE) {	           	
//		mail("soluciones2000@gmail.com,ordenesmanna@gmail.com",$asunto,$mensaje,$cabeceras);
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
	$cadena = 'Location: exito.php'; 
}
header($cadena);
?>