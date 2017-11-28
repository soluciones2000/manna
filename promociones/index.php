<?php 
include_once("conexion.php");
include_once("cabecera.php");
$st = isset($_GET['st']) ? $_GET['st'] : '';
?>
<div id="cuerpo">
	<div style="text-align:center">
		<h3>PEDIDOS CON TICKETS DE PROMOCIÓN</h3>
	</div>
	<?php
	switch ($st) {
		case 'rnsa':
			$mensaje = 'EL REGISTRO DEL PARTICIPANTE NO SE ACTUALIZÓ.';
			break;
		case 'tfdr':
			$mensaje = 'EL NÚMERO DE TICKET INTRDUCIDO NO PERTENECE A ESTA PROMOCIÓN.';
			break;
		case 'na':
			$mensaje = 'ESTA PROMOCIÓN NO ESTÁ ACTIVA.';
			break;
		default:
			$mensaje = '';
			break;
	}
	echo '<div style="text-align:center">';
		echo '<h4><font color="red">'.trim($mensaje).'</font></h4>';
	echo '</div>';
	?>
	<div>
		<table border="1" align="center" width="25%">
			<tr>
				<td valign="top">
					<br>
					<div style="vertical-align:top;">
						<div style="margin: 0% 15% 0% 15%">
					        <form name="promo" method="post" action="promo.php">
					            <table border=0>
<!-- 					            	<tr>
					            		<td>
					            			Número de ticket:
					            		</td>
					            		<td>
								            <INPUT type="text" name="ticket" maxlength="5" size="5" pattern="[0-9]{5}" title="Este campo sólo puede tener números" required>            			
					            		</td>
					            	</tr>
 -->					            	<tr>
					            		<td>
					            			Cédula de identidad:
					            		</td>
					            		<td>
								            <INPUT type="text" name="cedula" maxlength="8" size="8" pattern="[0-9]{7-8}" title="Este campo sólo puede tener números" required>            			
					            		</td>
					            	</tr>
					            </table>
					            <p align="center"><INPUT type="submit" value="Enviar"></p>
	        				</form>
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
