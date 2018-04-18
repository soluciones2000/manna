
	<!-- CSS Files -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
	
	

	<!-- CSS -->
	<link href="assets/css/allneat.css" rel="stylesheet" />


<?php 
session_start();
include_once("conexion.php");
$codigo = isset($_GET['c']) ? $_GET['c'] : '';
$saldo = 0.00;
$creditos = 0.00;
$debitos = 0.00;
$ca = 0.00;
$cb = 0.00;
$cc = 0.00;
$cd = 0.00;
$ce = 0.00;
$da = 0.00;
$db = 0.00;
$dc = 0.00;

$query = "SELECT * from billetera WHERE afiliado='".$codigo."' order by afiliado,mesmov,fecmov,tipmov,tipo_trans,numdoc";
if ($result = mysql_query($query,$link)) {
	while ($row = mysql_fetch_array($result)) {
		$mesmov = $row["mesmov"];
		$tipmov = $row["tipmov"];
		$tipo_trans = $row["tipo_trans"];
		$crd = $row["creditos"];
		$dbt = $row["debitos"];
		$saldo += $crd-$dbt;
		if ($mesmov==substr(date('Y-m-d'),5,2)) {
			$creditos += $crd;
			$debitos += $dbt;
			switch ($tipo_trans) {
				case 'CA':
					$ca += $crd;
					break;
				case 'CB':
					$cb += $crd;
					break;
				case 'CC':
					$cc += $crd;
					break;
				case 'CD':
					$cd += $crd;
					break;
				case 'CE':
					$ce += $crd;
					break;
				case 'DA':
					$da += $dbt;
					break;
				case 'DB':
					$db += $dbt;
					break;
				case 'DC':
					$dc += $dbt;
					break;
			}
		}
	}
}

echo '<p align="center">El saldo actual de tu billetera es de <b>Bs. '.number_format($saldo,2,',','.').'</b></p>';
echo '<p align="center">Créditos del mes <b>Bs. '.number_format($creditos,2,',','.').'</b> - ';
echo 'Débitos del mes <b>Bs. '.number_format($debitos,2,',','.').'</b></p>';

echo '<h3 align="center">Resumen por tipo de movimiento</h3>';
echo '<table align="center" border="0">';
	echo '<tr>';
		echo '<th width="45%">Créditos</th>';
		echo '<th width="45%">Débitos</th>';	
	echo '</tr>';
	echo '<tr>';
		echo '<td align="right" valign="top">';
			if ($ca<>0.00) {
				echo 'Comisiones en cuenta: <b>Bs. <a href="consulta.php?c='.$codigo.'&tipo=CA">'.number_format($ca,2,',','.').'</a></b><br>';
			} else {
				echo 'Comisiones en cuenta: <b>Bs. '.number_format($ca,2,',','.').'</b><br>';
			}
			if ($cb<>0.00) {
				echo 'Abonos a cuenta: <b>Bs. <a href="consulta.php?c='.$codigo.'&tipo=CB">'.number_format($cb,2,',','.').'</a></b><br>';
			} else {
				echo 'Abonos a cuenta: <b>Bs. '.number_format($cb,2,',','.').'</b><br>';
			}
			if ($cc<>0.00) {
				echo 'Abonos a cuenta (pagado de más): <b>Bs. <a href="consulta.php?c='.$codigo.'&tipo=CC">'.number_format($cc,2,',','.').'</a></b><br>';
			} else {
				echo 'Abonos a cuenta (pagado de más): <b>Bs. '.number_format($cc,2,',','.').'</b><br>';
			}
			if ($cd<>0.00) {
				echo 'Canje puntos club 180: <b>Bs. <a href="consulta.php?c='.$codigo.'&tipo=CD">'.number_format($cd,2,',','.').'</a></b><br>';
			} else {
				echo 'Canje puntos club 180: <b>Bs. '.number_format($cd,2,',','.').'</b><br>';
			}
			if ($ce<>0.00) {
				echo 'Otros créditos: <b>Bs. <a href="consulta.php?c='.$codigo.'&tipo=CE">'.number_format($ce,2,',','.').'</a></b>';
			} else {
				echo 'Otros créditos: <b>Bs. '.number_format($ce,2,',','.').'</b>';
			}
		echo '</td>';
		echo '<td align="right" valign="top">';
			if ($da<>0.00) {
				echo 'Comisiones retiradas: <b>Bs. <a href="consulta.php?c='.$codigo.'&tipo=DA">'.number_format($da,2,',','.').'</a></b><br>';
			} else {
				echo 'Comisiones retiradas: <b>Bs. '.number_format($da,2,',','.').'</b><br>';
			}
			if ($db<>0.00) {
				echo 'Pago de ordenes (usando la billetera): <b>Bs. <a href="consulta.php?c='.$codigo.'&tipo=DB">'.number_format($db,2,',','.').'</a></b><br>';
			} else {
				echo 'Pago de ordenes (usando la billetera): <b>Bs. '.number_format($db,2,',','.').'</b><br>';
			}
			if ($dc<>0.00) {
				echo 'Otros débitos: <b>Bs. <a href="consulta.php?c='.$codigo.'&tipo=DC">'.number_format($dc,2,',','.').'</a></b>';
			} else {
				echo 'Otros débitos: <b>Bs. '.number_format($dc,2,',','.').'</b>';
			}
		echo '</td>';
	echo '</tr>';
echo '</table>';

//echo '<p align="center">';
echo '<br>';
echo '<table align="center"><tr><td>';
	echo '<form method="post" action="detbilletera.php?c='.$_SESSION["codigo"].'" style="display:inline;">';
		echo '<input type="submit" name="detalle" class="btn btn-primary" value="Ver detalle del mes">';
	echo '</form>';
	echo '<form method="post" action="periodo.php?c='.$_SESSION["codigo"].'" style="display:inline;">';
		echo '<input type="submit" name="historico" class="btn btn-primary" value="Ver meses anteriores">';
	echo '</form>';
	echo '<form method="post" action="pagobilletera.php?c='.$_SESSION["codigo"].'" style="display:inline;">';
		echo '<input type="submit" name="pagar" class="btn btn-primary" value="Pagar órdenes con la biletera">';
	echo '</form>';
	echo '<form method="post" action="abonobilletera.php?c='.$_SESSION["codigo"].'" style="display:inline;">';
		echo '<input type="submit" name="abono" class="btn btn-primary" value="Abono a cuenta">';
	echo '</form>';
	echo '<form method="post" action="transferbiletera.php?c='.$_SESSION["codigo"].'" style="display:inline;">';
		echo '<input type="submit" name="transferencia" class="btn btn-primary" value="Transferir a otro aliado">';
	echo '</form>';
	echo '<form method="post" action="retiro.php?c='.$_SESSION["codigo"].'" style="display:inline;">';
		echo '<input type="submit" name="retiro" class="btn btn-primary" value="Retirar comisiones">';
	echo '</form>';
	echo '<form method="post" action="inicio.php?c='.$_SESSION["codigo"].'" style="display:inline;">';
		echo '<input type="submit" name="volver" class="btn btn-primary" value="Volver al inicio">';
	echo '</form>';
echo '</td></tr></table>';
////echo '</p>';
?>
