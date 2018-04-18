
	<!-- CSS Files -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
	
	

	<!-- CSS -->
	<link href="assets/css/allneat.css" rel="stylesheet" />

<?php 
include_once("conexion.php");
$codigo = isset($_GET['c']) ? $_GET['c'] : '';

$saldo = 0.00;
$query = "SELECT sum(creditos) as crd, sum(debitos) as dbt from billetera WHERE afiliado='".$codigo."'";
if ($result = mysql_query($query,$link)) {
	$row = mysql_fetch_array($result);
	$crd = $row["crd"];
	$dbt = $row["dbt"];
	$saldo = $crd-$dbt;
}
?>
			<tr>
				<td valign="top" align="center" colspan="3">
					<div style="vertical-align:top;">
						<h3 align="center">Pago de órdenes con la billetera</h3>
						<?php
							$query = "select * from ordenes where codigo='".$_SESSION['codigo']."' and status_orden<>'' and status_orden='Pendiente'";
							 //and monto<=".$saldo
							$result = mysql_query($query,$link);
							if (mysql_num_rows($result) > 0){
								echo '<p align="center">El saldo disponible para realizar pagos es de <b>Bs. '.number_format($saldo,2,',','.').'</b> y las órdenes pendientes que pueden ser pagadas con esta opción son las siguientes:</p>';
								echo '<div>';
									echo '<table border=0 align="center" width="50%">';
										echo '<tr>';
											echo '<th>Orden</th>';
											echo '<th>Fecha</th>';
											echo '<th>Monto</th>';
										echo '</tr>';
										$linea = 0;
										while ($row = mysql_fetch_array($result)) {
											if ($row["monto"]<=$saldo) {
												echo '<tr>';
													echo '<td align="center"><a href="pagaorden.php?c='.$codigo.'&ord='.$row['orden_id'].'">'.$row['orden_id'].'</a></td>';
													echo '<td>'.substr($row['fecha'],8,2).'/'.substr($row['fecha'],5,2).'/'.substr($row['fecha'],0,4).'</td>';
													echo '<td>'.number_format($row['monto'],2,',','.').'</td>';
												echo '</tr>';
												$linea++;
											}
										}
									echo '</table>';
									if ($linea==0) {
										echo '<p align="center">Tu saldo es insuficiente, para usar esta opción debes abonar dinero a la billetera.</p>';

										echo '<p align="center">Estas son las órdenes que tienes pendientes:</p>';

										$query = "select * from ordenes where codigo='".$_SESSION['codigo']."' and status_orden<>'' and status_orden='Pendiente'";
										$result = mysql_query($query,$link);
										if (mysql_num_rows($result) > 0){
											echo '<table border=0 align="center" width="50%">';
												echo '<tr>';
													echo '<th>Orden</th>';
													echo '<th>Fecha</th>';
													echo '<th>Monto</th>';
												echo '</tr>';
												while ($row = mysql_fetch_array($result)) {
													echo '<tr>';
														echo '<td align="center">'.$row['orden_id'].'</td>';
														echo '<td>'.substr($row['fecha'],8,2).'/'.substr($row['fecha'],5,2).'/'.substr($row['fecha'],0,4).'</td>';
														echo '<td>'.number_format($row['monto'],2,',','.').'</td>';
													echo '</tr>';
												}
											echo '</table>';
										}
									}
								echo '</div>';
							} else {
								echo '<br>';
								echo '<h4 align="center">NO HAY ORDENES PENDIENTES</h4>';
							}
						?>
						<br>
						<div align="center">
							<form method="post" action="billetera.php?c=<?php echo $codigo ?>">
								<input type="submit" name="volver" value="Regresar" class="btn btn-primary btn-block">
							</form>
						</div>
						<br>
					</div>
				</td>
			</tr>
		</table>
	</div>
