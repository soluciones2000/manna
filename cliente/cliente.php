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
					        <form name="pago" method="post" action="validacliente.php">
					            <table border=0>
					            	<tr>
					            		<td>
					            			Dirección de email:
					            		</td>
					            		<td>
								            <INPUT type="email" name="email" maxlength="150" size="50" alt="Introduzca un email valido" required><br>
					            		</td>
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
