			<tr>
				<td valign="top" align="center" colspan="3">
					<div style="vertical-align:top;">
						<h4 align="center">Datos del cliente</h4>
						<?php
							switch ($mensaje) {
								case 'cb':
									echo '<div style="text-align:center">';
										echo '<p><b><font color="red">NO PUEDE DEJAR EL EMAIL EN BLANCO.</font></b></p>';
									echo '</div>';
									break;
							}
						?>
						<div style="margin: 0% 15%">
					        <form name="pago" method="post" action="guardadatos.php">
					            <table border=0>
					            	<tr>
					            		<td>Dirección de email:</td>
					            		<td><INPUT type="email" name="email" value="<?php echo $_SESSION["email"]; ?>" maxlength="150" size="50" readonly><br></td>
					            	</tr>
					            	<tr>
					            		<td>Nombre completo:</td>
					            		<td><INPUT type="text" name="nombre" maxlength="150" size="50" alt="Introduzca su nombre" required><br></td>
					            	</tr>
					            	<tr>
					            		<td>Cédula de Identidad:</td>
					            		<td><INPUT type="text" name="cedula" maxlength="10" size="10" alt="Introduzca su cédula" required><br></td>
					            	</tr>
					            	<tr>
					            		<td>Teléfonos:</td>
					            		<td><INPUT type="text" name="telefono" maxlength="50" size="50" alt="Introduzca sus números de teléfono" required><br></td>
					            	</tr>
					            	<tr>
					            		<td>Dirección fiscal:</td>
										<td><textarea type="text" name="direccion" maxlength="500" rows="2" cols="50" alt="Introduzca su dirección fiscal" required></textarea><br></td>
					            	</tr>
					            	<tr>
					            		<td>Dirección de envío:</td>
										<td><textarea type="text" name="direccion_envio" maxlength="500" rows="2" cols="50" alt="Introduzca su dirección de envío"></textarea><br></td>
					            	</tr>
					            </table>
					            <br>
					            <INPUT type="submit" value="Enviar">
	        				</form>
							<br>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
