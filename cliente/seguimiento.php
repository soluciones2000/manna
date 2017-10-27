			<tr>
				<td valign="top" align="center" colspan="3">
					<div style="vertical-align:top;">
						<h3 align="center">Seguimiento de órdenes activas</h3>
						<?php
							$query = "select * from cliente_preferencial where clte_email='".$_SESSION["email"]."'";
							$result = mysql_query($query,$link);
							if ($row = mysql_fetch_array($result)) {
								$nombre = $row["clte_nombre"];
								$codclte = $row["cod_corto_clte"];
							}
							echo '<h4 align="center">'.$nombre.'</h4>';
							$query = "select * from ordenes where codigo='".$codclte."' and tipo_orden='Cliente Preferencial'";
							if ($result = mysql_query($query,$link)){
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
			            <form action="inicio.php"><INPUT type="submit" value="Volver al catálogo"></form>
						<br>
					</div>
				</td>
			</tr>
		</table>
	</div>
