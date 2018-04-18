
	<!-- CSS Files -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
	
	

	<!-- CSS -->
	<link href="assets/css/allneat.css" rel="stylesheet" />
<?php 
include_once("conexion.php");
$codigo = isset($_POST['c']) ? $_POST['c'] : '';
$target = isset($_POST['target']) ? $_POST['target'] : '';
$monto = isset($_POST['monto']) ? $_POST['monto'] : 0.00;

$saldo = 0.00;
$query = "SELECT sum(creditos) as crd, sum(debitos) as dbt from billetera WHERE afiliado='".$codigo."'";
if ($result = mysql_query($query,$link)) {
	$row = mysql_fetch_array($result);
	$crd = $row["crd"];
	$dbt = $row["dbt"];
	$saldo = $crd-$dbt;
}

$query = "SELECT tit_nombres,tit_apellidos from afiliados WHERE tit_codigo='".$target."'";
if ($result = mysql_query($query,$link)) {
	$row = mysql_fetch_array($result);
	$nombreafil = trim($row["tit_nombres"]).' '.trim($row["tit_apellidos"]);
}
?>
			<tr>
				<td valign="top" align="center" colspan="3">
					<div style="vertical-align:top;">
						<h3 align="center">Confirmar transferencia</h3>

						<p align="center">El saldo de tu billetera es de <b>Bs. <?php echo number_format($saldo,2,',','.'); ?>.</b></p>

						<p align="center">Estás a punto de transferir <b>Bs. <?php echo number_format($monto,2,',','.'); ?></b> al afiliado <b><?php echo $nombreafil; ?>.</b></p>

						<p align="center">Luego de esta operación, tu nuevo saldo será de <b>Bs. <?php echo number_format($saldo-$monto,2,',','.'); ?>.</b></p>

						<div align="center">
							<form method="post" action="guardatransf.php">
					            <input type="hidden" name="c" value="<?php echo $codigo; ?>">
					            <input type="hidden" name="target" value="<?php echo $target; ?>">
					            <input type="hidden" name="monto" value="<?php echo $monto; ?>">
								<input type="submit" name="transf" value="De acuerdo, transferir" class="btn btn-primary btn-block">
							</form>
						</div>
					</div>
				</td>
			</tr>
