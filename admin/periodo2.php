<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "reportes";
include_once("menu.php");
$men2 = "detalle";
include_once("reportes.php");
?>
<div id="cuerpo">
	<div style="text-align:center">
		<h3>DETALLE DE COMISIONES</h3>
	</div>
	<div>
		<table border="1" align="center" width="36%">
			<tr>
				<td valign="top">
					<br>
					<div style="vertical-align:top;">
						<div style="margin: 0% 15% 0% 15%">
					        <form name="admin" method="post" action="detallebonoafiliacion.php">
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
					            	<tr>
					            		<td>
					            			Mes y año:
					            		</td>
					            		<td>
       										<select name="mes" value="mes">
												<option value="01">Enero</option>
												<option value="02">Febrero</option>
												<option value="03">Marzo</option>
												<option value="04">Abril</option>
												<option value="05">Mayo</option>
												<option value="06">Junio</option>
												<option value="07">Julio</option>
												<option value="08">Agosto</option>
												<option value="09">Septiembre</option>
												<option value="10">Octubre</option>
												<option value="11">Noviembre</option>
												<option value="12">Diciembre</option>
											</select>
											/
       										<select name="ano" value="ano">
												<option value="2017">2017</option>
												<option value="2018">2018</option>
												<option value="2019">2019</option>
												<option value="2020">2020</option>
												<option value="2021">2021</option>
												<option value="2022">2022</option>
												<option value="2023">2023</option>
												<option value="2024">2024</option>
												<option value="2025">2025</option>
												<option value="2026">2026</option>
											</select>
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
