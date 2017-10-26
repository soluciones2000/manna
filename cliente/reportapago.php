			<tr>
				<td valign="top" align="center" colspan="3">
					<div style="vertical-align:top;">
						<h4 align="center">Reportar pago</h4>
						<?php
							$query = "select * from clientes where email='".$_SESSION["email"]."'";
							$result = mysql_query($query,$link);
							if ($row = mysql_fetch_array($result)) {
								$nombre = $row["nombre"];
								$codclte = $row["cod_corto_clte"];
							}
						?>
						<div style="margin: 0% 15%">
					        <form name="pago" method="post" action="guardapago.php">
					            <table border=0>
					            	<tr>
					            		<td>Nombre depositante:</td>
					            		<td><INPUT type="text" name="nombre" value="<?php echo $nombre; ?>" maxlength="150" size="50" readonly><br></td>
					            	</tr>
					            	<tr>
					            		<td>Fecha del pago:</td>
<!--
					            		<td><INPUT type="text" name="nombre" maxlength="150" size="50" alt="Introduzca su nombre" required><br></td>
-->
										<td><input type="date" name="fecha" id="datepicker" readonly="readonly" size="10" required title="Introduzca la fecha del pago" /></td>
					            	</tr>
					            	<tr>
					            		<td>Número del comprobante:</td>
					            		<td><INPUT type="text" name="documento" maxlength="20" size="20" pattern="[0-9]{0,20}" title="Introduzca el número de comprobante (sólo números)" required><br></td>
					            	</tr>
					            	<tr>
					            		<td>Banco de origen:</td>
					            		<td><INPUT type="text" name="bancoorigen" maxlength="150" size="50" title="Introduzca el nombre del banco de origen"><br></td>
					            	</tr>
					            	<tr>
					            		<td>Monto del pago:</td>
					            		<td><INPUT type="currency" name="monto" maxlength="20" size="20" pattern="\d+(.\d{2})?" title="Introduzca el monto usando el punto (.) como separador decimal" style="text-align:right" required><br></td>
					            	</tr>
					            	<tr>
					            		<td>Número de orden:</td>
					            		<td><INPUT type="text" name="orden_id" maxlength="20" size="20"  pattern="[0-9]{0,20}" title="Introduzca el número de la orden que está cancelando (sólo números)" style="text-align:right"><br></td>
					            	</tr>
					            </table>
					            <br>
					            <input type="hidden" name="codclte" value="<?php echo $codclte; ?>">
					            <INPUT type="submit" value="Enviar">
	        				</form>
							<br>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
