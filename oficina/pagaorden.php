<?php 
include_once("conexion.php");
$codigo = isset($_GET['c']) ? $_GET['c'] : '';
$orden = isset($_GET['ord']) ? $_GET['ord'] : 0;

$saldo = 0.00;
$query = "SELECT sum(creditos) as crd, sum(debitos) as dbt from billetera WHERE afiliado='".$codigo."'";
if ($result = mysql_query($query,$link)) {
	$row = mysql_fetch_array($result);
	$crd = $row["crd"];
	$dbt = $row["dbt"];
	$saldo = $crd-$dbt;
}

$query = "SELECT * from ordenes WHERE orden_id=".$orden;
if ($result = mysql_query($query,$link)) {
	$row = mysql_fetch_array($result);
	$fecha = $row["fecha"];
	$monto = $row["monto"];
}
?>
			<tr>
				<td valign="top" align="center" colspan="3">
					<div style="vertical-align:top;">
						<h3 align="center">Pago de órdenes con la billetera</h3>
						<p align="center">El saldo de tu billetera es de <b>Bs. <?php echo number_format($saldo,2,',','.'); ?>.</b></p>

						<p align="center">Estás a punto de usar dinero de tu billetera para cancelar la <b>órden No. <?php echo number_format($orden,0,',','.'); ?></b> de fecha <b><?php echo substr($fecha,8,2).'/'.substr($fecha,5,2).'/'.substr($fecha,0,4); ?></b> por un monto de <b>Bs. <?php echo number_format($monto,2,',','.'); ?>.</b></p>

						<p align="center">Luego de esta operación, tu nuevo saldo será de <b>Bs. <?php echo number_format($saldo-$monto,2,',','.'); ?>.</b></p>

						<div align="center">
							<form method="post" action="confirmapagobilletera.php">
					            <input type="hidden" name="c" value="<?php echo $codigo; ?>">
					            <input type="hidden" name="ord" value="<?php echo $orden; ?>">
								<input type="submit" name="pagar" value="De acuerdo, pagar">
							</form>
						</div>
						<br>
					</div>
				</td>
			</tr>
		</table>
	</div>
