<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "";
include_once("menu.php");
$men2 = "";
include_once("precios.php");
$query = "SELECT * FROM productos order by familia,id_pro";
$result = mysql_query($query,$link);
$familia = '';
echo '<table border="1" align="center" width="100%">';
	echo '<form name="admin" method="post" action="actuapreciopro.php">';
	while ($row = mysql_fetch_array($result)) {
		if ($familia <> $row["familia"]) {
			$familia = $row["familia"];
			echo '<td colspan=4"><br><b><u>Familia: '.$familia.'</u></b></td>';
			echo '</tr>';
			echo '<tr>';
				echo '<th width="40%">';
					echo 'Producto';
				echo '</th>';
				echo '<th width="20%">';
					echo 'Aliado comercial';
				echo '</th>';
				echo '<th width="20%">';
					echo 'Cliente Preferencial';
				echo '</th>';
				echo '<th width="20%">';
					echo 'Público';
				echo '</th>';
			echo '</tr>';
			echo '<tr>';
		}
		$id_pro = $row["id_pro"];
		$prod["id_pro"];
		echo '<tr>';
			echo '<td>';
				echo $row["id_pro"].' - '.$row["desc_corta"];
			echo '</td>';
			echo '<td align="right">';
				echo 'Precio: '.'<input type="currency" name="'.trim($id_pro).'#-#pvp_dist" value="'.$row["pvp_dist"].'" size="10" style="text-align:right;" />'.'<br>';
				echo 'Valor comisionable: '.'<input type="currency" name="'.trim($id_pro).'#-#com_dist" value="'.$row["com_dist"].'" size="10" style="text-align:right;" />'.'<br>';
				echo 'Puntos : '.'<input type="currency" name="'.trim($id_pro).'#-#pts_dist" value="'.$row["pts_dist"].'" size="10" style="text-align:right;" />'.'<br>';
			echo '</td>';
			echo '<td align="right">';
				echo 'Precio: '.'<input type="currency" name="'.trim($id_pro).'#-#pvp_clipref" value="'.$row["pvp_clipref"].'" size="10" style="text-align:right;" />'.'<br>';
				echo 'Valor comisionable: '.'<input type="currency" name="'.trim($id_pro).'#-#com_clipref" value="'.$row["com_clipref"].'" size="10" style="text-align:right;" />'.'<br>';
				echo 'Puntos : '.'<input type="currency" name="'.trim($id_pro).'#-#pts_clipref" value="'.$row["pts_clipref"].'" size="10" style="text-align:right;" />'.'<br>';
			echo '</td>';
			echo '<td align="right">';
				echo 'Precio: '.'<input type="currency" name="'.trim($id_pro).'#-#precio_pro" value="'.$row["precio_pro"].'" size="10" style="text-align:right;" />'.'<br>';
				echo 'Valor comisionable: '.'<input type="currency" name="'.trim($id_pro).'#-#valor_comisionable_pro" value="'.$row["valor_comisionable_pro"].'" size="10" style="text-align:right;" />'.'<br>';
				echo 'Puntos : '.'<input type="currency" name="'.trim($id_pro).'#-#puntos_pro" value="'.$row["puntos_pro"].'" size="10" style="text-align:right;" />'.'<br>';
			echo '</td>';
		echo '</tr>';
	}
echo '</table>';
echo '<p align="center"><INPUT type="submit" value="Enviar"></p>';
echo '</form>';
?>
<!--
<div id="cuerpo">
	<div style="text-align:center">
		<h3>ACTUALIZACIÓN PRECIO DE LOS KITS DE AFILIACIÓN</h3>
	</div>
	<div>
		<table border="1" align="center" width="50%">
			<tr>
				<td valign="top">
					<br>
					<div style="vertical-align:top;">
						<div style="margin: 0% 15% 0% 15%">
					        <form name="admin" method="post" action="actuaprecio.php">
					            <table border="0">
					            	<tr>
					            		<th width="auto" height="40px" valign="bottom" align="center" colspan="4">
					            			KITS DE AFILIACIÓN
					            		</th>
					            	</tr>
					            	<tr>
					            		<td width="25%" height="70px" valign="bottom" align="center">
					            			Premium
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>PVP </label>
											<input type="currency" name="pvp_premium_todas" value="<?php echo $pvp_premium_todas ?>" size="10" style="text-align:right;" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Valor comisionable </label>
											<input type="currency" name="premium_todas" value="<?php echo $premium_todas ?>" size="10" style="text-align:right;" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Puntos </label>
											<input type="currency" name="mp_premium_todas" value="<?php echo $mp_premium_todas ?>" size="10" style="text-align:right;" />
					            		</td>
					            	</tr>
					            	<tr>
					            		<td width="25%" height="70px" valign="bottom" align="center">
					            			VIP
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>PVP </label>
											<input type="currency" name="pvp_vip_todas" value="<?php echo $pvp_vip_todas ?>" size="10" style="text-align:right;" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Valor comisionable </label>
											<input type="currency" name="vip_todas" value="<?php echo $vip_todas ?>" size="10" style="text-align:right;" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Puntos </label>
											<input type="currency" name="mp_vip_todas" value="<?php echo $mp_vip_todas ?>" size="10" style="text-align:right;" />
					            		</td>
					            	</tr>
					            	<tr>
					            		<td width="25%" height="70px" valign="bottom" align="center">
					            			Oro
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>PVP </label>
											<input type="currency" name="pvp_oro_todas" value="<?php echo $pvp_oro_todas ?>" size="10" style="text-align:right;" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Valor comisionable </label>
											<input type="currency" name="oro_todas" value="<?php echo $oro_todas ?>" size="10" style="text-align:right;" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Puntos </label>
											<input type="currency" name="mp_oro_todas" value="<?php echo $mp_oro_todas ?>" size="10" style="text-align:right;" />
					            		</td>
					            	</tr>

					            	<tr>
					            		<th width="auto" height="40px" valign="bottom" align="center" colspan="4">
					            			LINEA LQ
					            		</th>
					            	</tr>
					            	<tr>
					            		<td width="25%" height="70px" valign="bottom" align="center">
					            			Premium LQ
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>PVP </label>
											<input type="currency" name="pvp_premium_lq" value="<?php echo $pvp_premium_lq ?>" size="10" style="text-align:right;" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Valor comisionable </label>
											<input type="currency" name="premium_lq" value="<?php echo $premium_lq ?>" size="10" style="text-align:right;" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Puntos </label>
											<input type="currency" name="mp_premium_lq" value="<?php echo $mp_premium_lq ?>" size="10" style="text-align:right;" />
					            		</td>
					            	</tr>
					            	<tr>
					            		<td width="25%" height="70px" valign="bottom" align="center">
					            			VIP LQ
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>PVP </label>
											<input type="currency" name="pvp_vip_lq" value="<?php echo $pvp_vip_lq ?>" size="10" style="text-align:right;" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Valor comisionable </label>
											<input type="currency" name="vip_lq" value="<?php echo $vip_lq ?>" size="10" style="text-align:right;" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Puntos </label>
											<input type="currency" name="mp_vip_lq" value="<?php echo $mp_vip_lq ?>" size="10" style="text-align:right;" />
					            		</td>
					            	</tr>
					            	<tr>
					            		<td width="25%" height="70px" valign="bottom" align="center">
					            			Oro LQ
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>PVP </label>
											<input type="currency" name="pvp_oro_lq" value="<?php echo $pvp_oro_lq ?>" size="10" style="text-align:right;" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Valor comisionable </label>
											<input type="currency" name="oro_lq" value="<?php echo $oro_lq ?>" size="10" style="text-align:right;" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Puntos </label>
											<input type="currency" name="mp_oro_lq" value="<?php echo $mp_oro_lq ?>" size="10" style="text-align:right;" />
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
-->
<?php
include_once("pie.php");
?>
