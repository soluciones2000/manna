
	<!-- CSS Files -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
	
	

	<!-- CSS -->
	<link href="assets/css/allneat.css" rel="stylesheet" />

<?php 
include_once("conexion.php");
$codigo = isset($_GET['c']) ? $_GET['c'] : '';
?>
<div id="cuerpo">
	<div style="text-align:center">
		<h3>CONSULTA DE MOVIMIENTOS HISTÓRICOS</h3>
	</div>
	<div>
		<table border="0" align="center" width="100%">
			<tr>
				<td valign="top" align="center">
					<br>
					<div style="vertical-align:top;">
						<div>
					        <form name="admin" method="post" action="historico.php">
					            <table border=0 width="50%">
					            	<tr>
					            		<td>
					            			Mes y año:
					            		</td>
					            		<td>
       										<select name="mes" value="mes" class="form-control">
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
											</td>
										<td>
					            			&nbsp;/&nbsp;
					            		</td>
					            		<td>
       										<select name="ano" value="ano" class="form-control">
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
					            <input type="hidden" name="c" value="<?php echo $codigo; ?>">
					            <INPUT type="submit" value="Enviar" class="btn btn-primary btn-block">
	        				</form>
							<br>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div> 
