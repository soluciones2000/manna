
	<!-- CSS Files -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
	
	

	<!-- CSS -->
	<link href="assets/css/allneat.css" rel="stylesheet" />

<?php 
session_start();
include_once("conexion.php");
$codigo = isset($_GET['c']) ? $_GET['c'] : '';
$inicial = 0.00;
$creditos = 0.00;
$debitos = 0.00;
$final = 0.00;

$query = "SELECT * from billetera WHERE afiliado='".$codigo."' order by afiliado,mesmov,fecmov,tipmov,id";
if ($result = mysql_query($query,$link)) {
	while ($row = mysql_fetch_array($result)) {
		$fecmov = $row["fecmov"];
		$mesmov = $row["mesmov"];
		$tipmov = $row["tipmov"];
		$tipo_trans = $row["tipo_trans"];
		$crd = $row["creditos"];
		$dbt = $row["debitos"];
		$saldo += $crd-$dbt;
		if ($fecmov<substr(date('Y-m-d'),0,8)."01") {
			$inicial += $crd-$dbt;
		} else if ($mesmov==substr(date('Y-m-d'),5,2)) {
			$creditos += $crd;
			$debitos += $dbt;
		}
	}
	$final = $inicial+$creditos-$debitos;
}
$mes = substr(date('Y-m-d'),5,2);
$ano = substr(date('Y-m-d'),0,4);
switch ($mes) {
	case '01':
		$lmes = 'enero';
		break;
	case '02':
		$lmes = 'febrero';
		break;
	case '03':
		$lmes = 'marzo';
		break;
	case '04':
		$lmes = 'abril';
		break;
	case '05':
		$lmes = 'mayo';
		break;
	case '06':
		$lmes = 'junio';
		break;
	case '07':
		$lmes = 'julio';
		break;
	case '08':
		$lmes = 'agosto';
		break;
	case '09':
		$lmes = 'septiembre';
		break;
	case '10':
		$lmes = 'octubre';
		break;
	case '11':
		$lmes = 'noviembre';
		break;
	case '12':
		$lmes = 'diciembre';
		break;
}
$linea = 1;
?>
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<html>
<head> 
</head>
<body>
	<h3><?php echo $_SESSION["user"]; ?>:</h3>
	<p>Detalle de movimientos de la billetera correspondiente al mes de <?php echo $lmes; ?> de <?php echo $ano; ?>: </p>
	<table align="center">
		<tr>
			<th width="10%">Fecha</th>
			<th width="15%">Documento</th>
			<th width="45%">Concepto</th>
			<th width="15%">Créditos</th>
			<th width="15%">Débitos</th>
		</tr>
		<tr bgcolor="">
			<td align="center">01/<?php echo $mes; ?>/<?php echo $ano; ?></td>
			<td> </td>
			<td>Saldo Inicial</td>
			<td align="right"><?php echo $x = ($inicial>=0) ? number_format($inicial,2,',','.') : '' ; ?></td>
			<td align="right"><?php echo $x = ($inicial<0) ? number_format($inicial*-1,2,',','.') : '' ; ?></td>
		</tr>
		<?php 
			$linea++;
			$query = "SELECT * from billetera WHERE afiliado='".$codigo."' and mesmov='".substr(date('Y-m-d'),5,2)."' order by afiliado,mesmov,fecmov,tipmov,id";
			if ($result = mysql_query($query,$link)) {
				while ($row = mysql_fetch_array($result)) {
					$fecmov = $row["fecmov"];
					$dfecha = substr($fecmov,8,2).'/'.substr($fecmov,5,2).'/'.substr($fecmov,0,4);
					$mesmov = $row["mesmov"];
					$tipmov = $row["tipmov"];
					$numdoc = $row["numdoc"];
					$tipo_trans = $row["tipo_trans"];
					$concepto = $row["concepto"];
					$crd = $row["creditos"];
					$dbt = $row["debitos"];
					if ($linea%2<>0) {
						echo '<tr bgcolor="powderblue">';
					} else {
						echo '<tr>';
					}
						echo '<td align="center">'.$dfecha.'</td>';
						echo '<td align="center">'.$numdoc.'</td>';
						echo '<td>'.$concepto.'</td>';
						if ($crd<>0.00) {
							echo '<td align="right">'.number_format($crd,2,',','.').'</td>';
						} else {
							echo '<td align="right"> </td>';
						}
						if ($dbt<>0.00) {
							echo '<td align="right">'.number_format($dbt,2,',','.').'</td>';
						} else {
							echo '<td align="right"> </td>';
						}
						
					echo '</tr>';
					$linea++;
				}
			}
		?>
		<tr bgcolor="">
			<td align="center"><?php echo substr(date("Y-m-d"),8,2).'/'.substr(date("Y-m-d"),5,2).'/'.substr(date("Y-m-d"),0,4); ?></td>
			<td> </td>
			<td>Saldo Final</td>
			<td align="right"><?php echo $x = ($final>=0) ? number_format($final,2,',','.') : '' ; ?></td>
			<td align="right"><?php echo $x = ($final<0) ? number_format($final*-1,2,',','.') : '' ; ?></td>
		</tr>
	</table>
	<form method="post" action="billetera.php?c=<?php echo $codigo ?>">
		<p align="center">
			<input type="submit" name="volver" value="Regresar" class="btn btn-primary btn-block">
		</p>
	</form>
</body>
</html>