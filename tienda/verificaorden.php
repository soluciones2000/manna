			<tr>
				<td colspan="3">
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
							foreach ($_SESSION["orden"] as $prod => $value) {
								$query = "SELECT * FROM productos where id_pro='".$prod."'";
								$result = mysql_query($query,$link);
								if ($row = mysql_fetch_array($result)) {
									$id_pro = $row["id_pro"];
									$desc_corta = $row["desc_corta"];
									$precio_pro = $row["precio_pro"];
									$imagen = $row["imagen"];
									echo '<tr>';
										echo '<td align="center" width="100px">';
											echo '<a href="borra.php?prd='.$prod.'"><img src="eliminar.jpg" style="vertical-align:middle;"></a>';
											echo  '<img SRC="img/'.trim($imagen).'.jpg" width="50px" height="50px" style="vertical-align:middle;">';
										echo '</td>';
										echo '<td align="left" width="380px" style="padding:2%">';
											echo trim($id_pro).' - '.utf8_encode(trim($desc_corta));
										echo '</td>';
										echo '<td align="right" width="105px">';
											echo 'Bs. '.number_format($precio_pro,2,',','.');
										echo '</td>';
										echo '<td align="center" width="100px">';
											echo '<div style="display:block;">';
	//											echo '<INPUT type="submit" value="-" onclick="menos('.$prod.')">';
												echo '<a href="resta.php?prd='.$prod.'"><img src="menos.jpg" style="vertical-align:top;"></a>';
												echo '<INPUT type="text" value="'.$_SESSION["orden"][$prod].'" size="1" style="text-align:right; style="vertical-align:middle;" readonly>';
												echo '<a href="suma.php?prd='.$prod.'"><img src="mas.jpg" style="vertical-align:top;"></a>';
	//											echo '<INPUT type="submit" value="+" onclick="mas('.$prod.')">';
											echo '</div>';
										echo '</td>';
										echo '<td align="right" width="120px">';
											echo 'Bs. '.number_format($_SESSION["orden"][$prod]*$precio_pro,2,',','.');
											$subtotal += $_SESSION["orden"][$prod]*$precio_pro;
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
						 <tr>
						 	<td colspan="4" style="padding-right:2%;padding-left:2%;">
						 		<p align="justify"><b>(*)</b> Si el pago de esta orden se realiza utilizando un medio electrónico (transferencia bancaria) se calculará el I.V.A. utilizando una tasa del 9% cuando la compra sea inferior a Bs. 2.000.001,00. Si supera los Bs. 2.000.000,00 se utilizará la tasa del 7%.</p>
						 		<p align="justify">En tal sentido, si usted realiza el pago por medio electrónico usted deberá cancelar la cantidad de Bs. <?php 
						 			if ($subtotal>2000000) {
										echo number_format($subtotal+($subtotal*$_SESSION["iva3"]/100),2,',','.');
									} else {
										echo number_format($subtotal+($subtotal*$_SESSION["iva2"]/100),2,',','.');
									}
								?></p>
						 	</td>
						 	<td align="center">
						 		<form method="post" action="logincliente.php?ruta=orden">
							 		<input type="submit" name="ordenar" value="Completar orden">
						 		</form>
						 	</td>
						 </tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
<!--
							while($row = mysql_fetch_array($result)) {
								$id_pro = $row["id_pro"];
								$desc_corta = $row["desc_corta"];
								$precio_pro = $row["precio_pro"];
								$imagen = $row["imagen"];
								echo '<tr>';
									echo '<td align="center" width="70px">';
										echo  '<img SRC="img/'.trim($imagen).'.jpg" width="50px" height="50px">';
									echo '</td>';
									echo '<td align="left" width="380px" style="padding:2%">';
										echo trim($id_pro).' - '.trim($desc_corta);
									echo '</td>';
									echo '<td align="right" width="105px">';
										echo 'Bs. '.number_format($precio_pro,2,',','.');
									echo '</td>';
									echo '<td align="center" width="90px">';
//										echo '<INPUT type="number" min="0" max="99" maxlength="2" size="2" style="text-align:right;" ng-model="cant">';
										echo '<button ng-click="cant=cant-1" ng-init="cant=1"><font size="3">-</font></button>';
										echo '  {{cant}}  ';
										echo '<button ng-click="cant=cant+1" ng-init="cant=1"><font size="3">+</font></button>';
									echo '</td>';
									echo '<td align="right" width="120px">';
										echo '{{cant*'.$precio_pro.'|currency:\'Bs.\':2}}';
									echo '</td>';
								echo '</tr>';
							}
-->