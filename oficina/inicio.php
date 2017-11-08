<?php 
include_once("conexion.php");
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
		echo "<ul>";
/*		echo "Acumulado para el bono de Patrocinio: ".trim(number_format($bonopatroc,2,',','.'))."<br>";
		echo "Acumulado para el bono unilevel: ".trim(number_format($bonounilevel,2,',','.'))."<br>";
		echo "<br>";
		echo "<b><i>Total acumulado para bonos: ".trim(number_format($bonopatroc+$bonounilevel,2,',','.'))."</i></b>";
*/		echo "<li>Acumulado para el Bono de Patrocinio: ".trim(number_format($bonopatroc,2,',','.'))."</li>";
		echo "<li>Acumulado para el Bono Unilevel: ".trim(number_format($bonounilevel,2,',','.'))."</li>";
		echo "<br>";
		echo '<li><b><i><font size="4"> Total acumulado para Bonos: '.trim(number_format($bonopatroc+$bonounilevel,2,',','.')).'</font></i></b></li>';
		echo "</ul>";
	?>
</body>
</html>