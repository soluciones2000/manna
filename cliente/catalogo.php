			<tr>
				<td colspan="3">
					<table border="1" width="100%">
						<?php 
							$query = "SELECT * FROM productos where publico='General' order by familia,id_pro";
							$result = mysql_query($query,$link);
							$contador = 1;
							while($row = mysql_fetch_array($result)) {
								$id_pro = $row["id_pro"];
								$desc_corta = utf8_encode($row["desc_corta"]);
								$desc_pro = trim(utf8_encode($row["desc_pro"]));
								$precio_pro = $row["pvp_clipref"];
								$imagen = $row["imagen"];
								if (file_exists('img/'.trim($imagen).'.jpg')) {
									$imagen = 'img/'.trim($imagen).'.jpg';
								} else {
									$imagen = 'img/sin_imagen.jpg';
								}
								
								if ($contador==1) {
									echo '<tr>';
								}
								echo '<td align="center" width="25%" style="padding:2%">';
									echo  '<img SRC="'.trim($imagen).'" width="150px" height="150px" title="'.$desc_pro.'"><br>';
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