
	<!-- CSS Files -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
	
	

	<!-- CSS -->
	<link href="assets/css/allneat.css" rel="stylesheet" />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

<?php 
include_once("conexion.php");
session_start();
echo '<table border="0" align="center" width="100%" height="10%">';
	echo '<tr>';
		echo '<td width="20%">';
			echo '<font face="arial">';
				echo '<a href="catalogo.php" id="anterior">Volver al catálogo</a>';
			echo '</font>';
		echo '</td>';
		echo '<td align="center" width="60%">';
			echo '<h4>AGREGAR O ELIMINAR PRODUCTOS</h4>';
		echo '</td>';
		echo '<td align="right" valign="middle" width="20%" style="padding-right:2%">';
			echo '<font face="arial">';
				echo 'Items en la orden: '.$_SESSION["cantidad"].'<br>';
			echo '</font>';
		echo '</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td colspan="3">';
			echo '<table border="0" width="90%" align="center">';
				echo '<tr>';
					echo '<th align="center" width="100px">Producto</th>';
					echo '<th align="center" width="380px" style="padding:2%">Descripción</th>';
					echo '<th align="center" width="105px">Precio</th>';
					echo '<th align="center" width="100px">Cantidad</th>';
					echo '<th align="center" width="120px">A pagar</th>';
				echo '</tr>';
				$subtotal = 0.00;
				$totpts = 0.00;
				foreach ($_SESSION["orden"] as $prod => $value) {
					$query = "SELECT * FROM productos where id_pro='".$prod."'";
					$result = mysql_query($query,$link);
					if ($row = mysql_fetch_array($result)) {
						$id_pro = $row["id_pro"];
						$desc_corta = utf8_encode($row["desc_corta"]);
						$puntos_pro = $row["pts_dist"];
						if ($_SESSION["iva2"]<>0.00) {
							$precio_pro = round($row["pvp_dist"]/(1+($_SESSION["iva2"]/100)),2);
						} else {
							$precio_pro = $row["pvp_dist"];
						}
						$imagen = $row["imagen"];
						if (file_exists('img/'.trim($imagen).'.jpg')) {
							$imagen = 'img/'.trim($imagen).'.jpg';
						} else {
							$imagen = 'img/sin_imagen.jpg';
						}
						echo '<tr>';
							echo '<td align="center" width="100px">';
								echo '<a href="borra.php?prd='.$prod.'"><img src="eliminar.jpg" style="vertical-align:middle;"></a>';
								echo  '<img SRC="'.trim($imagen).'" width="50px" height="50px" style="vertical-align:middle;">';
							echo '</td>';
							echo '<td align="left" width="380px" style="padding:2%">'.trim($id_pro).' - '.trim($desc_corta).'</td>';
							echo '<td align="right" width="105px">Bs. '.number_format($precio_pro,2,',','.').'<br>';
							echo '<font size="2">(PM. '.number_format($puntos_pro,0,',','.').')</font></td>';
							echo '<td align="center" width="100px">';
								echo '<div style="display:block;">';
									echo '<a href="resta.php?prd='.$prod.'"><img src="menos.jpg" style="vertical-align:top;"></a>';
									echo '<INPUT type="text" value="'.$_SESSION["orden"][$prod].'" size="1" style="text-align:right; style="vertical-align:middle;" readonly>';
									echo '<a href="suma.php?prd='.$prod.'"><img src="mas.jpg" style="vertical-align:top;"></a>';
								echo '</div>';
							echo '</td>';
							echo '<td align="right" width="120px">';
								echo 'Bs. '.number_format($_SESSION["orden"][$prod]*$precio_pro,2,',','.').'<br>';
							echo '<font size="2">(PM. '.number_format($_SESSION["orden"][$prod]*$puntos_pro,0,',','.').')</font>';
								$subtotal += $_SESSION["orden"][$prod]*$precio_pro;
								$totpts += $_SESSION["orden"][$prod]*$puntos_pro;
							echo '</td>';
						echo '</tr>';
					}
				}
				echo '<tr>';
					echo '<td colspan="4" align="right" style="padding:2%;"><b>SUBTOTAL</b></td>';
					echo '<td align="right"><b>Bs. '.number_format($subtotal,2,',','.').'<br>';
					echo '<font size="2">(PM. '.number_format($totpts,0,',','.').')(**)</font>'.'</b></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td colspan="4" align="right" style="padding:2%;"><b>I.V.A. '.number_format($_SESSION["iva1"],2,',','.').'% (*)</b></td>';
					echo '<td align="right"><b>Bs. '.number_format($subtotal*$_SESSION["iva1"]/100,2,',','.').'</b></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td colspan="4" align="right" style="padding:2%;"><b>TOTAL ORDEN</b></td>';
					echo '<td align="right"><b>Bs. '.number_format($subtotal+($subtotal*$_SESSION["iva1"]/100),2,',','.').'</b></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td colspan="4" style="padding-right:2%;padding-left:2%;">';
						// echo '<p align="justify"><b>(*)</b> Si el pago de esta orden se realiza utilizando un medio electrónico (transferencia bancaria) se calculará el I.V.A. utilizando una tasa del 9% cuando la compra sea inferior a Bs. 2.000.001,00. Si supera los Bs. 2.000.000,00 se utilizará la tasa del 7%.<br>';
						// echo 'En tal sentido, si usted realiza el pago por medio electrónico usted deberá cancelar la cantidad de Bs. ';
						// 	if ($subtotal>2000000) { echo number_format($subtotal+($subtotal*$_SESSION["iva3"]/100),2,',','.'); }
						// 	else { echo number_format($subtotal+($subtotal*$_SESSION["iva2"]/100),2,',','.'); }
						// echo '</p>';
						echo '<p align="justify"><b>(**)</b> Al cancelar esta compra usted acumulará '.number_format($totpts,0,',','.').' PM.</p>';
					echo '</td>';
					echo '<td align="center">';
						echo '<form method="post" action="resumenorden.php">';
							echo '<p><input type="submit" name="ordenar" value="Confirmar orden" class="btn btn-primary btn-block"></p>';
						echo '</form>';
					echo '</td>';
				echo '</tr>';
			echo '</table>';
		echo '</td>';
	echo '</tr>';
echo '</table>';
