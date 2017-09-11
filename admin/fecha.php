<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "";
include_once("menu.php");
?>
<div id="cuerpo">
	<div style="text-align:center">
		<h3>TRANSACCIONES DEL DIA</h3>
	</div>
	<div>
		<table border="1" align="center" width="25%">
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
											<input type="date" name="fecha" id="datepicker" readonly="readonly" size="10" />
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
