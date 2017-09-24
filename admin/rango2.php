
<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "reportes";
include_once("menu.php");
$men2 = "cliente";
include_once("reportes.php");
?>
<div id="cuerpo">
	<div style="text-align:center">
		<h3>CLIENTES PREFERENCIALES</h3>
	</div>
	<div>
		<table border="1" align="center" width="36%">
			<tr>
				<td valign="top">
					<br>
					<div style="vertical-align:top;">
						<div style="margin: 0% 15% 0% 15%">
					        <form name="admin" method="post" action="clientepref.php">
					            <table border=0>
					            	<tr>
					            		<td>
					            			Desde el afiliado:
					            		</td>
					            		<td>
											<input type="text" style="text-transform:uppercase;text-align:center;" size="5" name="cod_desde" minlength="5" maxlength="5" pattern="[0-9|A-Z|a-z]{5}" title="Este campo sólo puede tener números o letras">
					            		</td>
					            	</tr>
					            	<tr>
					            		<td>
					            			Hasta el afiliado:
					            		</td>
					            		<td>
											<input type="text" style="text-transform:uppercase;text-align:center;" size="5" name="cod_hasta" minlength="5" maxlength="5" pattern="[0-9|A-Z|a-z]{5}" title="Este campo sólo puede tener números o letras">			
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
