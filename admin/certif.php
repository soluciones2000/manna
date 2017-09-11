<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "certif";
include_once("menu.php");
?>
<div id="cuerpo">
	<div style="text-align:center">
		<h3>REPORTE DE COMISIONES</h3>
	</div>
	<div>
		<table border="1" align="center" width="27%">
			<tr>
				<td valign="top">
					<br>
					<div style="vertical-align:top;">
						<div style="margin: 0% 15% 0% 15%">
					        <form name="admin" method="post" action="printcertif.php">
					            <table border=0>
					            	<tr>
					            		<td>
					            			Código afiliado:
					            		</td>
					            		<td>
											<input type="text" style="text-transform:uppercase;text-align:center;" size="5" name="tit_codigo" minlength="5" maxlength="5" pattern="[0-9|A-Z|a-z]{5}" title="Este campo sólo puede tener números o letras">            			
					            		</td>
					            	</tr>
					            	<tr>
					            		<td>
					            			¿Enviar por email?
					            		</td>
					            		<td>
											<input type="checkbox" name="email" value="1"> SI 
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
