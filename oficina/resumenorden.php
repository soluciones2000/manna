<?php 
include_once("conexion.php");
session_start();
echo '<table border="0" align="center" width="100%" height="10%">';
	echo '<tr>';
		echo '<td width="20%">';
			echo '<font face="arial">';
				echo '<a href="verificaorden.php" id="anterior">Aregar o eliminar productos</a>';
			echo '</font>';
		echo '</td>';
		echo '<td align="center" width="60%">';
			echo '<h3>RESUMEN DE LA ORDEN</h3>';
		echo '</td>';
		echo '<td align="right" valign="middle" width="20%" style="padding-right:2%">';
			echo '<font face="arial">';
				echo 'Items en la orden: '.$_SESSION["cantidad"].'<br>';
			echo '</font>';
		echo '</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td valign="top" align="center" colspan="3">';
			echo '<table border="1" width="auto" align="center">';
				echo '<tr>';
					echo '<th align="center" width="100px">Producto</th>';
					echo '<th align="center" width="380px" style="padding:2%">Descripción</th>';
					echo '<th align="center" width="105px">Precio</th>';
					echo '<th align="center" width="100px">Cantidad</th>';
					echo '<th align="center" width="120px">A pagar</th>';
				echo '</tr>';
				$subtotal = 0.00;
				$valorcom = 0.00;
				$ptsorden = 0;
				foreach ($_SESSION["orden"] as $prod => $value) {
					$query = "SELECT * FROM productos where id_pro='".$prod."'";
					$result = mysql_query($query,$link);
					if ($row = mysql_fetch_array($result)) {
						$id_pro = $row["id_pro"];
						$desc_corta = utf8_encode($row["desc_corta"]);
						$precio_pro = $row["pvp_dist"];
						$valor_comisionable_pro = $row["com_dist"];
						$puntos_pro = $row["pts_dist"];
						if ($_SESSION["iva2"]<>0.00) {
							$precio_pro = round($row["pvp_dist"]/(1+($_SESSION["iva2"]/100)),2);
						} else {
							$precio_pro = $row["pvp_dist"];
						}						
						$_SESSION["precio_pro"][$prod] = $precio_pro;
						$_SESSION["valor_comisionable_pro"][$prod] = $valor_comisionable_pro;
						$_SESSION["puntos_pro"][$prod] = $puntos_pro;
						$imagen = $row["imagen"];
						if (file_exists('img/'.trim($imagen).'.jpg')) {
							$imagen = 'img/'.trim($imagen).'.jpg';
						} else {
							$imagen = 'img/sin_imagen.jpg';
						}						
						echo '<tr>';
							echo '<td align="center" width="100px">';
								echo  '<img SRC="'.trim($imagen).'" width="50px" height="50px" style="vertical-align:middle;">';
							echo '</td>';
							echo '<td align="left" width="380px" style="padding:2%">'.trim($id_pro).' - '.trim($desc_corta).'</td>';
							echo '<td align="right" width="105px">Bs. '.number_format($precio_pro,2,',','.').'<br>';
							echo '<font size="2">(PM. '.number_format($puntos_pro,0,',','.').')</font></td>';
							echo '<td align="center" width="100px">'.number_format($_SESSION["orden"][$prod],0,',','.').'</td>';
							echo '<td align="right" width="120px">Bs. '.number_format($_SESSION["orden"][$prod]*$precio_pro,2,',','.').'<br>';
							echo '<font size="2">(PM. '.number_format($_SESSION["orden"][$prod]*$puntos_pro,0,',','.').')</font>';
							$subtotal += $_SESSION["orden"][$prod]*$precio_pro;
							$valorcom += $_SESSION["orden"][$prod]*$valor_comisionable_pro;
							$ptsorden += $_SESSION["orden"][$prod]*$puntos_pro;
							echo '</td>';
						echo '</tr>';
					}
				}
				echo '<tr>';
					echo '<td colspan="4" align="right" style="padding:2%;"><b>SUBTOTAL</b></td>';
					echo '<td align="right"><b>Bs. '.number_format($subtotal,2,',','.').'<br>';
					echo '<font size="2">(PM. '.number_format($ptsorden,0,',','.').')(**)</font>'.'</b></td>';
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
							$_SESSION["monto"] = $subtotal;
							$_SESSION["comisionable"] = $valorcom;
							$_SESSION["puntos"] = $ptsorden;
			 		// 		if ($subtotal>2000000) { echo number_format($subtotal+($subtotal*$_SESSION["iva3"]/100),2,',','.'); }
						// 	else { echo number_format($subtotal+($subtotal*$_SESSION["iva2"]/100),2,',','.'); }
						// echo '</p>';
						echo '<p align="justify"><b>(**)</b> Al cancelar esta compra usted acumulará '.number_format($ptsorden,0,',','.').' PM.</p>';
					echo '</td>';
					echo '<td align="center">';
						// echo '<form method="post" action="pagoenlinea.html">';
						echo '<form method="post" action="formapagoenlinea.php">';
//							echo '<input type="hidden" name="orden" value="" />';
							echo '<p><input type="submit" name="ordenar" value="Pagar en línea" disabled></p>';
						echo '</form>';
						echo '<form method="post" action="confirmaorden.php">';
							echo '<p><input type="submit" name="ordenar" value="pagar después"></p>';
						echo '</form>';
					echo '</td>';
				echo '</tr>';
			echo '</table>';
		echo '</td>';
	echo '</tr>';
echo '</table>';
