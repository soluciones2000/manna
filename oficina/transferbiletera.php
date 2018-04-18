
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
						<h3 align="center">Transferir saldo a otra billetera</h3>
						<p align="center">El saldo disponible para realizar transferencias es de <b>Bs. <?php echo number_format($saldo,2,',','.'); ?></b>.</p>
						<div align="center">
							<form name="pago" method="post" action="confirmatransf.php">
								<table border=0 width="50%">
									<tr>
										<td>Código del afiliado:</td>
										<td><INPUT type="text" name="target" maxlength="5" class="form-control" size="5" title="Introduzca el código del afiliado al que desea transferir" required><br></td>
									</tr>
									<tr>
										<td>Monto:</td>
										<td><INPUT type="currency" name="monto" maxlength="15" class="form-control" size="15" pattern="\d+(.\d{2})?" title="Introduzca el monto usando el punto (.) como separador decimal" style="text-align:right" required><br></td>
									</tr>
								</table>
								
								<input type="hidden" name="c" value="<?php echo $codigo; ?>">
								<INPUT type="submit" value="Enviar" class="btn btn-primary btn-block">
							</form>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
