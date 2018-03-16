<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "reportes";
include_once("menu.php");
$men2 = "fecha";
include_once("reportes.php");
?>
<div id="cuerpo">
	<div style="text-align:center">
		<h3>TRANSACCIONES DEL DIA</h3>
	</div>
	<div>
		<table border="1" align="center" width="20%">
			<tr>
				<td valign="top">
					<br>
					<div style="vertical-align:top;">
						<div style="margin: 0% 15% 0% 15%">
					        <form name="admin" method="post" action="transacfecha.php">
					            <table border=0>
					            	<tr>
					            		<td>
					            			Fecha:
					            		</td>
					            		<td>
											<input type="date" name="fecha" id="datepicker" size="10" />
					            		</td>
					            	</tr>
					            </table>
					            <br>
					            <div align="center">
						            <INPUT type="submit" value="Enviar">
					            </div>
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
