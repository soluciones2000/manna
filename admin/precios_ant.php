<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "";
include_once("menu.php");
$query = "SELECT * FROM empresa";
$result = mysql_query($query,$link);
$row = mysql_fetch_array($result);
$pvp_premium_hogar = $row["pvp_premium_hogar"];
$premium_hogar = $row["premium_hogar"];
$mp_premium_hogar = $row["mp_premium_hogar"];
$pvp_premium_lq = $row["pvp_premium_lq"];
$premium_lq = $row["premium_lq"];
$mp_premium_lq = $row["mp_premium_lq"];
$pvp_premium_teatro = $row["pvp_premium_teatro"];
$premium_teatro = $row["premium_teatro"];
$mp_premium_teatro = $row["mp_premium_teatro"];
$pvp_premium_todas = $row["pvp_premium_todas"];
$premium_todas = $row["premium_todas"];
$mp_premium_todas = $row["mp_premium_todas"];

$pvp_vip_hogar = $row["pvp_vip_hogar"];
$vip_hogar = $row["vip_hogar"];
$mp_vip_hogar = $row["mp_vip_hogar"];
$pvp_vip_lq = $row["pvp_vip_lq"];
$vip_lq = $row["vip_lq"];
$mp_vip_lq = $row["mp_vip_lq"];
$pvp_vip_teatro = $row["pvp_vip_teatro"];
$vip_teatro = $row["vip_teatro"];
$mp_vip_teatro = $row["mp_vip_teatro"];
$pvp_vip_todas = $row["pvp_vip_todas"];
$vip_todas = $row["vip_todas"];
$mp_vip_todas = $row["mp_vip_todas"];

$pvp_oro_hogar = $row["pvp_oro_hogar"];
$oro_hogar = $row["oro_hogar"];
$mp_oro_hogar = $row["mp_oro_hogar"];
$pvp_oro_lq = $row["pvp_oro_lq"];
$oro_lq = $row["oro_lq"];
$mp_oro_lq = $row["mp_oro_lq"];
$pvp_oro_teatro = $row["pvp_oro_teatro"];
$oro_teatro = $row["oro_teatro"];
$mp_oro_teatro = $row["mp_oro_teatro"];
$pvp_oro_todas = $row["pvp_oro_todas"];
$oro_todas = $row["oro_todas"];
$mp_oro_todas = $row["mp_oro_todas"];
?>
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
					            		<th width="auto" height="25px" valign="center" align="center" colspan="4">
					            			LÍNEA HOGAR
					            		</th>
					            	</tr>
					            	<tr>
					            		<td width="25%" height="70px" valign="bottom" align="center">
					            			Premium
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>PVP </label>
											<input type="currency" name="pvp_premium_hogar" value="<?php echo $pvp_premium_hogar ?>" size="10" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Valor comisionable </label>
											<input type="currency" name="premium_hogar" value="<?php echo $premium_hogar ?>" size="10" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Puntos </label>
											<input type="currency" name="mp_premium_hogar" value="<?php echo $mp_premium_hogar ?>" size="10" />
					            		</td>
					            	</tr>
					            	<tr>
					            		<td width="25%" height="70px" valign="bottom" align="center">
					            			VIP
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>PVP </label>
											<input type="currency" name="pvp_vip_hogar" value="<?php echo $pvp_vip_hogar ?>" size="10" align="right" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Valor comisionable </label>
											<input type="currency" name="vip_hogar" value="<?php echo $vip_hogar ?>" size="10" align="right" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Puntos </label>
											<input type="currency" name="mp_vip_hogar" value="<?php echo $mp_vip_hogar ?>" size="10" align="right" />
					            		</td>
					            	</tr>
					            	<tr>
					            		<td width="25%" height="70px" valign="bottom" align="center">
					            			Oro
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>PVP </label>
											<input type="currency" name="pvp_oro_hogar" value="<?php echo $pvp_oro_hogar ?>" size="10" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Valor comisionable </label>
											<input type="currency" name="oro_hogar" value="<?php echo $oro_hogar ?>" size="10" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Puntos </label>
											<input type="currency" name="mp_oro_hogar" value="<?php echo $mp_oro_hogar ?>" size="10" />
					            		</td>
					            	</tr>
					            	<tr>
					            		<th width="auto" height="40px" valign="bottom" align="center" colspan="4">
					            			LÍNEA LQ
					            		</th>
					            	</tr>
					            	<tr>
					            		<td width="25%" height="70px" valign="bottom" align="center">
					            			Premium
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>PVP </label>
											<input type="currency" name="pvp_premium_lq" value="<?php echo $pvp_premium_lq ?>" size="10" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Valor comisionable </label>
											<input type="currency" name="premium_lq" value="<?php echo $premium_lq ?>" size="10" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Puntos </label>
											<input type="currency" name="mp_premium_lq" value="<?php echo $mp_premium_lq ?>" size="10" />
					            		</td>
					            	</tr>
					            	<tr>
					            		<td width="25%" height="70px" valign="bottom" align="center">
					            			VIP
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>PVP </label>
											<input type="currency" name="pvp_vip_lq" value="<?php echo $pvp_vip_lq ?>" size="10" align="right" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Valor comisionable </label>
											<input type="currency" name="vip_lq" value="<?php echo $vip_lq ?>" size="10" align="right" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Puntos </label>
											<input type="currency" name="mp_vip_lq" value="<?php echo $mp_vip_lq ?>" size="10" align="right" />
					            		</td>
					            	</tr>
					            	<tr>
					            		<td width="25%" height="70px" valign="bottom" align="center">
					            			Oro
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>PVP </label>
											<input type="currency" name="pvp_oro_lq" value="<?php echo $pvp_oro_lq ?>" size="10" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Valor comisionable </label>
											<input type="currency" name="oro_lq" value="<?php echo $oro_lq ?>" size="10" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Puntos </label>
											<input type="currency" name="mp_oro_lq" value="<?php echo $mp_oro_lq ?>" size="10" />
					            		</td>
					            	</tr>

					            	<tr>
					            		<th width="auto" height="40px" valign="bottom" align="center" colspan="4">
					            			LÍNEA TEATRO
					            		</th>
					            	</tr>
					            	<tr>
					            		<td width="25%" height="70px" valign="bottom" align="center">
					            			Premium
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>PVP </label>
											<input type="currency" name="pvp_premium_teatro" value="<?php echo $pvp_premium_teatro ?>" size="10" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Valor comisionable </label>
											<input type="currency" name="premium_teatro" value="<?php echo $premium_teatro ?>" size="10" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Puntos </label>
											<input type="currency" name="mp_premium_teatro" value="<?php echo $mp_premium_teatro ?>" size="10" />
					            		</td>
					            	</tr>
					            	<tr>
					            		<td width="25%" height="70px" valign="bottom" align="center">
					            			VIP
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>PVP </label>
											<input type="currency" name="pvp_vip_teatro" value="<?php echo $pvp_vip_teatro ?>" size="10" align="right" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Valor comisionable </label>
											<input type="currency" name="vip_teatro" value="<?php echo $vip_teatro ?>" size="10" align="right" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Puntos </label>
											<input type="currency" name="mp_vip_teatro" value="<?php echo $mp_vip_teatro ?>" size="10" align="right" />
					            		</td>
					            	</tr>
					            	<tr>
					            		<td width="25%" height="70px" valign="bottom" align="center">
					            			Oro
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>PVP </label>
											<input type="currency" name="pvp_oro_teatro" value="<?php echo $pvp_oro_teatro ?>" size="10" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Valor comisionable </label>
											<input type="currency" name="oro_teatro" value="<?php echo $oro_teatro ?>" size="10" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Puntos </label>
											<input type="currency" name="mp_oro_teatro" value="<?php echo $mp_oro_teatro ?>" size="10" />
					            		</td>
					            	</tr>
					            	<tr>
					            		<th width="auto" height="40px" valign="bottom" align="center" colspan="4">
					            			TODAS LAS LINEAS
					            		</th>
					            	</tr>
					            	<tr>
					            		<td width="25%" height="70px" valign="bottom" align="center">
					            			Premium
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>PVP </label>
											<input type="currency" name="pvp_premium_todas" value="<?php echo $pvp_premium_todas ?>" size="10" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Valor comisionable </label>
											<input type="currency" name="premium_todas" value="<?php echo $premium_todas ?>" size="10" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Puntos </label>
											<input type="currency" name="mp_premium_todas" value="<?php echo $mp_premium_todas ?>" size="10" />
					            		</td>
					            	</tr>
					            	<tr>
					            		<td width="25%" height="70px" valign="bottom" align="center">
					            			VIP
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>PVP </label>
											<input type="currency" name="pvp_vip_todas" value="<?php echo $pvp_vip_todas ?>" size="10" align="right" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Valor comisionable </label>
											<input type="currency" name="vip_todas" value="<?php echo $vip_todas ?>" size="10" align="right" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Puntos </label>
											<input type="currency" name="mp_vip_todas" value="<?php echo $mp_vip_todas ?>" size="10" align="right" />
					            		</td>
					            	</tr>
					            	<tr>
					            		<td width="25%" height="70px" valign="bottom" align="center">
					            			Oro
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>PVP </label>
											<input type="currency" name="pvp_oro_todas" value="<?php echo $pvp_oro_todas ?>" size="10" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Valor comisionable </label>
											<input type="currency" name="oro_todas" value="<?php echo $oro_todas ?>" size="10" />
					            		</td>
					            		<td width="25%" height="70px" valign="bottom" align="center">
											<label>Puntos </label>
											<input type="currency" name="mp_oro_todas" value="<?php echo $mp_oro_todas ?>" size="10" />
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
