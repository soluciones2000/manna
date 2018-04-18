
	<!-- CSS Files -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
	
	

	<!-- CSS -->
	<link href="assets/css/allneat.css" rel="stylesheet" />

<?php 
include_once("conexion.php");
$codigo = isset($_GET['c']) ? $_GET['c'] : '';

$saldo = 0.00;
$query = "SELECT sum(creditos) as crd, sum(debitos) as dbt from billetera WHERE afiliado='".$codigo."' AND tipo_trans='CA'";
if ($result = mysql_query($query,$link)) {
	$row = mysql_fetch_array($result);
	$crd = $row["crd"];
	$dbt = $row["dbt"];
	$saldo = $crd-$dbt;
}

?>
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<html>
<head> 
</head>
<body>
	<h3><?php echo $_SESSION["user"]; ?>:</h3>
	<p align="center">Actualmente tienes en cuenta por concepto de comisiones la cantidad de <b>Bs. <?php echo number_format($saldo,2,',','.'); ?></b>, este monto será transferido a la cuenta bancaria que está registrada en tu ficha de afiliado.</p>
	<?php if ($saldo<>0.00): ?>
		<form method="post" action="confirmaretiro.php">
			<INPUT type="hidden" name="c" value="<?php echo $codigo; ?>">
			<INPUT type="hidden" name="comision" value="<?php echo $saldo; ?>">
			<br>
			<p align="center">
				<INPUT type="submit" value="De acuerdo, solicitar retiro" class="btn btn-primary btn-block">
			</p>
		</form>
	<?php else: ?>
		<p align="center">No tienes saldo suficiente para realizar retiros.</b></p>
		<p align="center">
			<form method="post" action="billetera.php?c=<?php echo $codigo ?>">
				<input type="submit" name="volver" value="Regresar" class="btn btn-primary btn-block">
			</form>
		</p>
	<?php endif ?>
</body>
</html>