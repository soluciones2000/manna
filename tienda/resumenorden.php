			<tr>
				<td valign="top" align="center" colspan="3">
					<?php
						$query = "SELECT * from clientes WHERE email='".trim($_SESSION["email"])."'";
						$result = mysql_query($query,$link);
						if ($row = mysql_fetch_array($result)) {
							$cliente = $row["nombre"];
							$cedula = $row["cedula"];
							$telefono = $row["telefono"];
							$direccion = $row["direccion"];
							$direccion_envio = $row["direccion_envio"];
							$_SESSION["direccion_envio"] = $direccion_envio;
							echo 'Cliente: '.trim($cliente).' C.I. '.number_format($cedula,0,',','.').'<br>';
							echo 'Teléfono: '.trim($telefono).'<br>';
							echo 'Dirección: '.utf8_decode(trim($direccion)).'<br>';
							echo 'Enviar a: '.utf8_decode(trim($direccion_envio)).'<br>';
						}
					?>
					<table border="1" width="auto" align="center">
						<?php 
							echo '<tr>';
								echo '<th align="center" width="100px">';
									echo 'Producto';
								echo '</th>';
								echo '<th align="center" width="380px" style="padding:2%">';
									echo 'Descripción';
								echo '</th>';
								echo '<th align="center" width="105px">';
									echo 'Precio';
								echo '</th>';
								echo '<th align="center" width="100px">';
									echo 'Cantidad';
								echo '</th>';
								echo '<th align="center" width="120px">';
									echo 'A pagar';
								echo '</th>';
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
									if ($_SESSION["iva2"]<>0.00) {
										$precio_pro = $row["precio_pro"]/(1+($_SESSION["iva2"]/100));
									} else {
										$precio_pro = $row["precio_pro"];
									}
									$valor_comisionable_pro = $row["valor_comisionable_pro"];
									$puntos_pro = $row["puntos_pro"];
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
//											echo '<a href="borra.php?prd='.$prod.'"><img src="eliminar.jpg" style="vertical-align:middle;"></a>';
											echo  '<img SRC="'.trim($imagen).'" width="50px" height="50px" style="vertical-align:middle;">';
										echo '</td>';
										echo '<td align="left" width="380px" style="padding:2%">';
											echo trim($id_pro).' - '.trim($desc_corta);
										echo '</td>';
										echo '<td align="right" width="105px">';
											echo 'Bs. '.number_format($precio_pro,2,',','.');
										echo '</td>';
										echo '<td align="center" width="100px">';
											echo number_format($_SESSION["orden"][$prod],0,',','.');
										echo '</td>';
										echo '<td align="right" width="120px">';
											echo 'Bs. '.number_format($_SESSION["orden"][$prod]*$precio_pro,2,',','.');
											$subtotal += $_SESSION["orden"][$prod]*$precio_pro;
											$valorcom += $_SESSION["orden"][$prod]*$valor_comisionable_pro;
											$ptsorden += $_SESSION["orden"][$prod]*$puntos_pro;
										echo '</td>';
									echo '</tr>';
								}
							}
						 ?>
						 <tr>
						 	<td colspan="4" align="right" style="padding:2%;"><b>SUBTOTAL</b></td>
						 	<td align="right"><b><?php echo 'Bs. '.number_format($subtotal,2,',','.'); ?></b></td>
						 </tr>
						 <tr>
						 	<td colspan="4" align="right" style="padding:2%;"><b>I.V.A. <?php echo number_format($_SESSION["iva1"],2,',','.'); ?>% (*)</b></td>
						 	<td align="right"><b><?php echo 'Bs. '.number_format($subtotal*$_SESSION["iva1"]/100,2,',','.'); ?></b></td>
						 </tr>
						 <tr>
						 	<td colspan="4" align="right" style="padding:2%;"><b>TOTAL ORDEN</b></td>
						 	<td align="right"><b><?php echo 'Bs. '.number_format($subtotal+($subtotal*$_SESSION["iva1"]/100),2,',','.'); ?></b></td>
						 </tr>
					</table>
					<table border="0" width="auto" align="center">
						 <tr>
						 	<!-- <td colspan="4" style="padding-right:2%;padding-left:2%;"> -->
						 		<!-- <p align="justify"><b>(*)</b> Si el pago de esta orden se realiza utilizando un medio electrónico (transferencia bancaria) se calculará el I.V.A. utilizando una tasa del 9% cuando la compra sea inferior a Bs. 2.000.001,00. Si supera los Bs. 2.000.000,00 se utilizará la tasa del 7%.</p> -->
						 		<!-- <p align="justify">En tal sentido, si usted realiza el pago por medio electrónico usted deberá cancelar la cantidad de Bs. <?php  
									$_SESSION["monto"] = $subtotal;
									$_SESSION["comisionable"] = $valorcom;
									$_SESSION["puntos"] = $ptsorden;
						 			if ($subtotal>2000000) {
										echo number_format($subtotal+($subtotal*$_SESSION["iva3"]/100),2,',','.');
									} else {
										echo number_format($subtotal+($subtotal*$_SESSION["iva2"]/100),2,',','.');
									}
								?></p> -->
						 	<!-- </td> -->
						 	<td align="center">
						 		<form method="post" action="confirmaorden.php">
							 		<p><input type="submit" name="ordenar" value="Confirmar orden"></p>
						 		</form>
						 	</td>
						 </tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
