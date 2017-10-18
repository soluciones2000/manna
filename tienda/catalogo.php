			<tr>
				<td colspan="3">
					<table border="1" width="100%">
						<?php 
							$query = "SELECT * FROM productos order by id_pro";
							$result = mysql_query($query,$link);
							$contador = 1;
							while($row = mysql_fetch_array($result)) {
								$id_pro = $row["id_pro"];
								$desc_corta = utf8_encode($row["desc_corta"]);
								$precio_pro = $row["precio_pro"];
								$imagen = $row["imagen"];
								if ($contador==1) {
									echo '<tr>';
								}
								echo '<td align="center" width="25%" style="padding:2%">';
									echo  '<img SRC="img/'.trim($imagen).'.jpg" width="150px" height="150px"><br>';
									echo trim($id_pro).'<br>';
									echo trim($desc_corta).'<br>';
									echo 'Precio Bs. '.number_format($precio_pro,2,',','.').'<br>';
									echo '<a href="agrega.php?prd='.$id_pro.'">Agregar a la orden</a>';
								echo '</td>';
								if ($contador==4) {
									echo '</tr>';
									$contador = 0;
								}
								$contador++;
							}
						 ?>
					</table>					
				</td>
			</tr>
		</table>
	</div>

<!--
	<div id="paginas">
		<table border="0" align="center" width="100%">
			<tr>
				<td style="padding-left:2%">
					<font face="arial">
						<a href="#"><<</a>
						<a href="#"> 1</a>
						<a href="#"> >></a>
					</font>
				</td>
			</tr>
		</table>
	</div>
-->