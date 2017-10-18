		<div id="promocion1">
			<table border="0" align="center">
				<tr>
					<td width="80%" align="center">
						<?php
							$query = "SELECT * FROM banners where activa='1'";
							$result = mysql_query($query,$link);
							while ($row = mysql_fetch_array($result)) {
								if ($row["orden"]) {
									echo '<a href="agrega.php?prd='.$row["id_pro"].'">';
										echo '<img SRC="banners/'.trim($row["banner"]).'" width="40%" height="30%" alt="Agregar a la orden" title="Agregar a la orden">';
									echo '</a>';
								} else {
									echo '<img SRC="banners/'.trim($row["banner"]).'" width="40%" height="30%">';
								}
							}
						?>
					</td>
				</tr>
			</table>
		</div>
