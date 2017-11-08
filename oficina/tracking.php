<?php 
include_once("conexion.php");
$codigo = isset($_GET['c']) ? $_GET['c'] : '';
?>
			<tr>
				<td valign="top" align="center" colspan="3">
					<div style="vertical-align:top;">
						<h3 align="center">Seguimiento de órdenes activas</h3>
						<?php
							$query = "select * from ordenes where codigo='".$_SESSION['codigo']."' and status_orden<>'' and status_orden<>'Despachada'";
							$result = mysql_query($query,$link);
							if (mysql_num_rows($result) > 0){
								echo '<div>';
									echo '<table border=1 align="center">';
										echo '<tr>';
											echo '<th>Orden</th>';
											echo '<th>Fecha</th>';
											echo '<th>Status</th>';
										echo '</tr>';
										while ($row = mysql_fetch_array($result)) {
											echo '<tr>';
												echo '<td align="center">'.$row['orden_id'].'</td>';
												echo '<td>'.substr($row['fecha'],8,2).'/'.substr($row['fecha'],5,2).'/'.substr($row['fecha'],0,4).'</td>';
												echo '<td>'.$row['status_orden'].'</td>';
											echo '</tr>';
										}
									echo '</table>';
								echo '</div>';
							} else {
								echo '<br>';
								echo '<h4 align="center">NO HAY ORDENES ACTIVAS</h4>';
							}
						?>
						<br>
						<div align="center">
							<form method="post" action="inicio.php?c=<?php echo $_SESSION["codigo"]; ?>">
								<INPUT type="submit" value="Volver al inicio">
							</form>
						</div>
						<br>
					</div>
				</td>
			</tr>
		</table>
	</div>
