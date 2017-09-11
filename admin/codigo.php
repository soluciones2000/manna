<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "reportes";
include_once("menu.php");
$men2 = "planilla";
include_once("reportes.php");
$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : 0;
?>
<div id="cuerpo">
	<div style="text-align:center">
		<h3>IMPRIMIR PLANILLA DE AFILIADO</h3>
	</div>
	<?php if ($mensaje): { ?>
		<div style="text-align:center">
			<p><b><font color="red">Debe introducir un código existente</font></b></p>
		</div>
	<?php } endif; ?>
	<div>
		<table border="1" align="center" width="22%">
			<tr>
				<td valign="top">
					<br>
					<div style="vertical-align:top;">
						<div style="margin: 0% 15% 0% 15%">
					        <form name="admin" method="post" action="planilla.php">
					            <table border=0>
					            	<tr>
					            		<td>
					            			Código del afiliado:
					            		</td>
					            		<td>
											<input type="text" style="text-transform:uppercase;text-align:center;" size="5" name="codigo" minlength="5" maxlength="5" pattern="[0-9|A-Z|a-z]{5}" title="Este campo sólo puede tener números o letras">            			
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
