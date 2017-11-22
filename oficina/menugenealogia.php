<?php 
session_start();
include_once("conexion.php");
$codigo = isset($_GET['c']) ? $_GET['c'] : '';
echo '<h3><u>Organización</u></h3>';
echo '<p>Tu organización está compuesta por ';

$todos = 0;
$premium = 0;
$vip = 0;
$oro = 0;
$ascenso = 0;
$gerente = 0;
$senior = 0;
$roro = 0;
$platino = 0;
$rubi = 0;
$diamante = 0;
$embajador = 0;
$presidencial = 0;
$internacional = 0;

$query = "select organizacion.*,afiliados.tipo_afiliado,afiliados.rango from organizacion left outer join afiliados on organizacion.afiliado=afiliados.tit_codigo where organizacion.organizacion='".$codigo."' and organizacion.organizacion<>organizacion.afiliado";
if ($result = mysql_query($query,$link)) {
	while ($row = mysql_fetch_array($result)) {
		$todos++;
		$tipoaf = $row["tipo_afiliado"];
		$rango = $row["rango"];	
		$premium += ($tipoaf == "Premium") ? 1 : 0 ;
		$vip += ($tipoaf == "VIP") ? 1 : 0 ;
		$oro += ($tipoaf == "Oro") ? 1 : 0 ;

		$ascenso += ($rango == "En Ascenso") ? 1 : 0 ;
		$gerente += ($rango == "Gerente") ? 1 : 0 ;
		$senior += ($rango == "Gerente Senior") ? 1 : 0 ;
		$roro += ($rango == "Oro") ? 1 : 0 ;
		$platino += ($rango == "Platino") ? 1 : 0 ;
		$rubi += ($rango == "Rubí") ? 1 : 0 ;
		$diamante += ($rango == "Diamante") ? 1 : 0 ;
		$embajador += ($rango == "Embajador") ? 1 : 0 ;
		$ejecutivo += ($rango == "Embajador Ejecutivo") ? 1 : 0 ;
		$presidencial += ($rango == "Embajador Presidencial") ? 1 : 0 ;
		$internacional += ($rango == "Embajador Internacional") ? 1 : 0 ;
	}
}
echo number_format($todos,0,',','.').' miembros, de los cuales '.number_format($premium,0,',','.').' son Premium, '.number_format($vip,0,',','.').' son VIP y '.number_format($oro,0,',','.').' Gold. La calificación de tus miembros es la siguiente:</p>';
echo '<ul>';
if ($ascenso<>0) { echo '<li>En Ascenso: '.number_format($ascenso,0,',','.').'</li>'; }
if ($gerente<>0) { echo '<li>Gerente: '.number_format($gerente,0,',','.').'</li>'; }
if ($senior<>0) { echo '<li>Gerente Senior: '.number_format($senior,0,',','.').'</li>'; }
if ($roro<>0) { echo '<li>Oro: '.number_format($roro,0,',','.').'</li>'; }
if ($platino<>0) { echo '<li>Platino: '.number_format($platino,0,',','.').'</li>'; }
if ($rubi<>0) { echo '<li>Rubí: '.number_format($rubi,0,',','.').'</li>'; }
if ($diamante<>0) { echo '<li>Diamante: '.number_format($diamante,0,',','.').'</li>'; }
if ($embajador<>0) { echo '<li>Embajador: '.number_format($embajador,0,',','.').'</li>'; }
if ($ejecutvo<>0) { echo '<li>Embajador Ejecutivo: '.number_format($ejecutivo,0,',','.').'</li>'; }
if ($presidencia<>0) { echo '<li>Embajador Presidencial: '.number_format($presidencial,0,',','.').'</li>'; }
if ($internacional<>0) { echo '<li>Embajador Internacional: '.number_format($internacional,0,',','.').'</li>'; }
echo '</ul>';

echo '<p>En el siguiente diagrama puedes ver el detalle de tu organización y podrás identificar los distintos tipos de afiliado con sus PMO.</p>';
echo '<form method="post" action="genealogia.php?c='.$_SESSION["codigo"].'">';
	echo '<p align="center"><input type="submit" name="ordenar" value="Ver diagrama de organización"></p>';
echo '</form>';
echo '<wbr>';
echo '<h3><u>Red de patrocinios</u></h3>';


echo '<p>Tu red de patrocinados directos está compuesta por  ';
$calif = 0;
$nocal = 0;
$patro = 0;
$query = "select * from patrocinio where patroc_codigo>='".$codigo."' and tit_codigo<>'".$codigo."'";
if ($result = mysql_query($query,$link)) {
	while ($row = mysql_fetch_array($result)) {
		$patro++;
		$fecha_fin_bono = $row["fecha_fin_bono"];
		if ($fecha_fin_bono<date('Y-m-d')) { $calif++; } else { $nocal++; }
	}
}

echo number_format($patro,0,',','.').' miembros de los cuales '.number_format($calif,0,',','.').' califican para el bono de patrocinio y '.number_format($nocal,0,',','.').' para los bonos unilevel, en el siguiente diagrama puedes ver como está compuesta tu red de patrocinados <i>(Sólo se muestran los que califican para el bono de patrocinio).</i></p>';
echo '<form method="post" action="patrocinio.php?c='.$_SESSION["codigo"].'">';
	echo '<p align="center"><input type="submit" name="ordenar" value="Ver red de patrocinados"></p>';
echo '</form>';
?>
