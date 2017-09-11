<?php 
include_once("conexion.php");
include_once("cabecera.php");
$promo_id = isset($_GET['id']) ? $_GET['id'] : '';
$ticket = isset($_GET['ticket']) ? $_GET['ticket'] : '';
$cedula = isset($_GET['cedula']) ? $_GET['cedula'] : '';
?>
<div id="cuerpo">
	<div style="text-align:center">
		<h3>PEDIDOS CON TICKETS DE PROMOCIÓN</h3>
	</div>
	<div style="text-align:center">
		<h4><font color="red">DATOS DEL PARTICIPANTE</font></h4>
	</div>';
	<div>
		<table border="1" align="center" width="58%">
			<tr>
				<td valign="top">
					<br>
					<div style="vertical-align:top;">
						<div style="margin: 0% 15% 0% 15%">
					        <form name="promo" method="post" action="regdatos.php">
					        	<?php
								echo '<input type="hidden" name="promo_id" value="'.trim($promo_id).'">';
								echo '<input type="hidden" name="ticket" value="'.trim($ticket).'">';
								echo '<input type="hidden" name="cedula" value="'.trim($cedula).'">';
					        	?>
					            <table border=0>
					            	<tr>
					            		<td>
					            			Código del afiliado (si aplica):
					            		</td>
					            		<td>
								            <INPUT type="text" name="codigo" maxlength="5" size="5" pattern="[0-9]{5}" title="Este campo sólo puede tener números">            			
					            		</td>
					            	</tr>
					            	<tr>
					            		<td>
					            			Nombre del participante:
					            		</td>
					            		<td>
								            <INPUT type="text" name="nombre" maxlength="150" size="50" title="Campo obligatorio" required>
					            		</td>
					            	</tr>
					            	<tr>
					            		<td>
					            			Dirección:
					            		</td>
					            		<td>
								            <INPUT type="text" name="direccion" maxlength="150" size="50" title="Campo obligatorio" required>
					            		</td>
					            	</tr>
					            	<tr>
					            		<td>
					            			Teléfono:
					            		</td>
					            		<td>
								            <INPUT type="text" name="telefono" maxlength="150" size="50" title="Campo obligatorio" required>
					            		</td>
					            	</tr>
					            	<tr>
					            		<td>
					            			Correo electrónico:
					            		</td>
					            		<td>
								            <INPUT type="email" name="email" maxlength="150" size="50" title="Campo obligatorio" required>
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
</div> 
<?php
include_once("pie.php");
?>
