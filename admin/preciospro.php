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
				echo '<th width="40%" colspan="2">';
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
			echo '<td align="center">';
				$imagen = $row["imagen"];
				if (file_exists('../tienda/img/'.trim($imagen).'.jpg')) {
					$nomima = trim($imagen);
					$imagen = '../tienda/img/'.trim($imagen).'.jpg';
				} else {
					$nomima = 'sin_imagen';
					$imagen = '../tienda/img/sin_imagen.jpg';
				}
				echo ' <a id="'.trim($row["id_pro"]).'" href="" onclick="Abrir_ventana(this.id)"><img src="'.trim($imagen).'" title="Haga click para cambiar esta imagen" alt="'.utf8_encode($row["desc_corta"]).'" height="100" width="100"></a> ';
//				echo ' <a id="'.trim($nomima).'" href="" onclick="Abrir_ventana(this.id,'.$row["id_pro"].')"><img src="'.trim($imagen).'" alt="'.utf8_encode($row["desc_corta"]).'" height="100" width="100"></a> ';
//				echo ' <a id="'.trim($nomima).'" href="" onclick="Abrir_ventana(this.id)"><img src="'.trim($imagen).'" alt="'.utf8_encode($row["desc_corta"]).'" height="100" width="100"></a> ';
//				echo ' <a id="'.trim($nomima).'" href="cambiaimagen.php?nomima='.trim($nomima).'" target="_blank"><img src="'.trim($imagen).'" alt="'.utf8_encode($row["desc_corta"]).'" height="100" width="100"></a> ';
			echo '</td>';
			echo '<td style="padding-left:1%;">';
				echo 'Código: '.$row["id_pro"].'<br>';
				echo 'Descripcion: '.'<input type="text" name="desc_corta_#_'.trim($id_pro).'" value="'.$row["desc_corta"].'" size="40" maxlength="50" />'.'<br>';
				if ($row["aviso"]) {
					echo 'Aviso de despacho en otra fecha: '.'<input type="checkbox" name="aviso_#_'.trim($id_pro).'" value="'.$row["aviso"].'" checked /> SI'.'<br>';
				} else {
					echo 'Aviso de despacho en otra fecha: '.'<input type="checkbox" name="aviso_#_'.trim($id_pro).'" value="'.$row["aviso"].'" /> SI'.'<br>';
				}
				echo 'Fecha de despacho: '.'<input type="date" name="fecha_aviso_#_'.trim($id_pro).'" value="'.$row["fecha_aviso"].'" size="10" />';
			echo '</td>';
			echo '<td align="right" style="padding-right:1%;">';
				echo 'Precio: '.'<input type="currency" name="pvp_dist_#_'.trim($id_pro).'" value="'.$row["pvp_dist"].'" size="10" style="text-align:right;" />'.'<br>';
				echo 'Valor comisionable: '.'<input type="currency" name="com_dist_#_'.trim($id_pro).'" value="'.$row["com_dist"].'" size="10" style="text-align:right;" />'.'<br>';
				echo 'Puntos : '.'<input type="currency" name="pts_dist_#_'.trim($id_pro).'" value="'.$row["pts_dist"].'" size="10" style="text-align:right;" />'.'<br>';
			echo '</td>';
			echo '<td align="right" style="padding-right:1%;">';
				echo 'Precio: '.'<input type="currency" name="pvp_clipref_#_'.trim($id_pro).'" value="'.$row["pvp_clipref"].'" size="10" style="text-align:right;" />'.'<br>';
				echo 'Valor comisionable: '.'<input type="currency" name="com_clipref_#_'.trim($id_pro).'" value="'.$row["com_clipref"].'" size="10" style="text-align:right;" />'.'<br>';
				echo 'Puntos : '.'<input type="currency" name="pts_clipref_#_'.trim($id_pro).'" value="'.$row["pts_clipref"].'" size="10" style="text-align:right;" />'.'<br>';
			echo '</td>';
			echo '<td align="right" style="padding-right:1%;">';
				echo 'Precio: '.'<input type="currency" name="precio_pro_#_'.trim($id_pro).'" value="'.$row["precio_pro"].'" size="10" style="text-align:right;" />'.'<br>';
				echo 'Valor comisionable: '.'<input type="currency" name="valor_comisionable_pro_#_'.trim($id_pro).'" value="'.$row["valor_comisionable_pro"].'" size="10" style="text-align:right;" />'.'<br>';
				echo 'Puntos : '.'<input type="currency" name="puntos_pro_#_'.trim($id_pro).'" value="'.$row["puntos_pro"].'" size="10" style="text-align:right;" />'.'<br>';
			echo '</td>';
		echo '</tr>';
	}
echo '</table>';
echo '
<script>
function Abrir_ventana(cod){
	propiedades="top=50, left=300, width=600, height=580";
	window.open("cambiaimagen.php?nomima="+cod,"_blank",propiedades);
} 
</script>
';

/*
echo '<div style="text-align:center">';
	echo "<h3>Agregar un nuevo producto</h3>";
echo '</div>';

echo '<table border="1" align="center" width="100%">';
	echo '<tr>';
		echo '<th width="40%" colspan="2">';
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
		echo '<td align="center" valign="center" width="9%">';
			echo 'x';
		echo '</td>';
		echo '<td align="right" valign="center" style="padding-right:1%;">';
			echo '<label>Código: </label><input type="text" name="id_pro_#_new" value="" size="45" maxlength="20" />'.'<br>';
			echo '<label>Descripción: </label><input type="text" name="desc_pro_#_new" value="" size="45" maxlength="200" /><br>';
			echo '<label>Descr. corta: </label><input type="text" name="desc_corta_#_new" value="" size="45" maxlength="50" />'.'<br>';
			echo '<label>Familia: </label><input type="text" name="familia_#_new" value="" size="45" maxlength="27" />'.'<br>';
		echo '</td>';
		echo '<td align="right" valign="center" style="padding-right:1%;">';
			echo 'Precio: '.'<input type="currency" name="pvp_dist_#_new" value="" size="10" style="text-align:right;" />'.'<br>';
			echo 'Valor comisionable: '.'<input type="currency" name="com_dist_#_new" value="" size="10" style="text-align:right;" />'.'<br>';
			echo 'Puntos : '.'<input type="currency" name="pts_dist_#_new" value="" size="10" style="text-align:right;" />'.'<br>';
		echo '</td>';
		echo '<td align="right" valign="center" style="padding-right:1%;">';
			echo 'Precio: '.'<input type="currency" name="pvp_clipref_#_new" value="" size="10" style="text-align:right;" />'.'<br>';
			echo 'Valor comisionable: '.'<input type="currency" name="com_clipref_#_new" value="" size="10" style="text-align:right;" /><br>';
			echo 'Puntos : '.'<input type="currency" name="pts_clipref_#_new" value="" size="10" style="text-align:right;" />'.'<br>';
		echo '</td>';
		echo '<td align="right" valign="center" style="padding-right:1%;">';
			echo 'Precio: '.'<input type="currency" name="precio_pro_#_new" value="" size="10" style="text-align:right;" />'.'<br>';
			echo 'Valor comisionable: '.'<input type="currency" name="valor_comisionable_pro_#_new" value="" size="10" style="text-align:right;" />'.'<br>';
			echo 'Puntos : '.'<input type="currency" name="puntos_pro_#_new" value="" size="10" style="text-align:right;" />'.'<br>';
		echo '</td>';
	echo '</tr>';
echo '</table>';
*/
echo '<br>';
echo '<div align="center">';
	echo '<INPUT type="submit" value="Enviar">';
echo '</div>';
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
