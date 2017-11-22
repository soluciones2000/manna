<?php 
include_once("conexion.php");
include_once("funciones.php");
//$codigo = isset($_GET['c']) ? $_GET['c'] : $_SESSION["codigo"];
$codigo = isset($_GET['c']) ? $_GET['c'] : '';
?>
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<html>
<head> 
</head>
<body>
	<h3>Bienvenido <b><?php echo $_SESSION["user"]; ?></b>,</h3>
	<p>Actualmente tu rango es: <b><?php echo $_SESSION["rango"] ?>.</b></p>
	<p align="justify">Tienes acumulados en este mes <b><?php echo number_format($_SESSION["pm"],0,',','.') ?>
	<?php 
		$puntos = ($_SESSION["pm"]==1) ? 'punto' : 'puntos' ;
		echo " ".$puntos." Manna</b>";
		if ($_SESSION["pm"]<50) {
			$faltan = (50-$_SESSION["pm"]==1) ? 'falta' : 'faltan' ;
			echo ", aún te ".$faltan." ".number_format(50-$_SESSION["pm"],0,',','.')." para poder disfrutar de los beneficios de tu red. Recuerda que el consumo mínimo para estar activo es de 50 puntos Manna mensuales.</p>";
			echo '<p align="justify">Puedes acumular puntos Manna consumiendo productos del catálogo o con el programa de cliente preferencial, si no conoces como funciona consulta con tu línea de auspicio.</p>';
			if ($_SESSION["pm"]<25) {
				echo "<p><b><i>Sigue invirtiendo en tu negocio, el trabajo fuerte y enfocado pronto te rendirá frutos.</i></b></p>";
			} else {
				echo "<p><b><i>Ya te falta poco, el trabajo fuerte y enfocado pronto te rendirá frutos.</i></b></p>";
			}
		} else {
			echo "<p><b><i>¡¡¡Felicitaciones!!! Con este nivel de consumo te mantienes activo y puedes disfrutar de los beneficios de tu red.</i></b></p>";
			echo "<p><b><i>Sigue construyendo tu negocio, busca calificar al siguiente nivel.</i></b></p>";
		}
	?>
	<h4><u>Resumen de bonos y comisiones</u></h4>
	<?php 
		$query = "select sum(comision) as bono from detbonoafiliacion where patroc_codigo='".trim($codigo)."' and status_bono='Pendiente'";
		$result = mysql_query($query,$link);
		if($row = mysql_fetch_array($result)) {
			$bonopatroc = $row["bono"];
		}
		$query = "select sum(comision) as bono from detunilevel where organizacion='".trim($codigo)."' and status_unilevel='Pendiente'";
		$result = mysql_query($query,$link);
		if($row = mysql_fetch_array($result)) {
			$bonounilevel = $row["bono"];
		}
		$query = "select sum(monto) as bono from reembolso where afiliado='".trim($codigo)."' and status_comision='Pendiente'";
		$result = mysql_query($query,$link);
		if($row = mysql_fetch_array($result)) {
			$reembolso = $row["bono"];
		}
		echo "<ul>";
/*		echo "Acumulado para el bono de Patrocinio: ".trim(number_format($bonopatroc,2,',','.'))."<br>";
		echo "Acumulado para el bono unilevel: ".trim(number_format($bonounilevel,2,',','.'))."<br>";
		echo "<br>";
		echo "<b><i>Total acumulado para bonos: ".trim(number_format($bonopatroc+$bonounilevel,2,',','.'))."</i></b>";
*/		echo "<li>Acumulado para el Bono de Patrocinio: ".trim(number_format($bonopatroc,2,',','.'))."</li>";
		echo "<li>Acumulado para el Bono Unilevel: ".trim(number_format($bonounilevel,2,',','.'))."</li>";
		echo "<li>Acumulado para el Bono de Reembolso de Consumo: ".trim(number_format($reembolso,2,',','.'))."</li>";
		echo "</ul>";
//		echo "<br>";
		echo '<b><i><font size="4"> Total acumulado para Bonos: '.trim(number_format($bonopatroc+$bonounilevel+$reembolso,2,',','.')).'</font></i></b>';

	$query = "select fecha_afiliacion from afiliados where tit_codigo='".trim($codigo)."'";
	$result = mysql_query($query,$link);
	$row = mysql_fetch_array($result);
	$fecha_afiliacion = $row["fecha_afiliacion"];
	$fecha_fin_bono = strtotime('+60 day', strtotime ($fecha_afiliacion));
	$fecha_fin_bono = date ( 'Y-m-d' , $fecha_fin_bono );

	if ($fecha_fin_bono>date('Y-m-d')) {
		$query = "select rango_tablet from empresa";
		$result = mysql_query($query,$link);
		$row = mysql_fetch_array($result);
		$rango_tablet = $row["rango_tablet"];

		$query = "SELECT * from unilevel WHERE rango='".trim($rango_tablet)."'";
		$result = mysql_query($query,$link);
		if ($row = mysql_fetch_array($result)) {
			$cpm = $row["pm"];
			$cpmo = $row["pmo"];
			$cpiernas = $row["piernas"];
			$ccalif_piernas = $row["calif_piernas"];
		}

		$piernas = piernas($codigo,$ccalif_piernas,$link);

		$date1 = new DateTime(date('Y-m-d'));
		$date2 = new DateTime($fecha_fin_bono);
		$diff = $date1->diff($date2);

		if ($_SESSION["pm"]>=$cpm and $_SESSION["pmo"]>=$cpmo and $piernas>=$cpiernas) {
			echo '<p><b>¡¡¡Felicidades!!! Haz completado los requisitos para optar al bono Tablet o Android.</b></p>';
		} else {
			echo '<p align="justify"><font color="red"><b>Estás calificando para el Bono Tablet o Android, el plazo se vence dentro de '.number_format($diff->days,0,',','.').' días, ';
			echo 'sólo te hacen falta: ';
			if ($_SESSION["pm"]<$cpm) {
				echo number_format($cpm-$_SESSION["pm"],0,',','.').' PM';
				if ($_SESSION["pmo"]<$cpmo and $piernas<$cpiernas) {
					echo '; ';
				} elseif ($_SESSION["pmo"]<$cpmo or $piernas<$cpiernas) {
					echo ' y ';
				} else {
					echo '; ';				
				}
			}
			if ($_SESSION["pmo"]<$cpmo) {
				echo number_format($cpmo-$_SESSION["pmo"],0,',','.').' PMO';
				if ($piernas<$cpiernas) {
					echo ' y ';
				} else {
					echo '; ';				
				}
			}
			if ($piernas<$cpiernas) {
				echo number_format($cpiernas-$piernas,0,',','.');
				if ($cpiernas-$piernas==1) {
					echo ' pierna calificada; ';
				} else {
					echo ' piernas calificadas; ';
				}
			}
			echo 'aún estás a tiempo, sigue realizando ese excelente trabajo.</b></font></p>';
		}
	}
	?>
</body>
</html>