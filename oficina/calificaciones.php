<?php 
include_once("conexion.php");
include_once("funciones.php");
?>
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<html>
<head> 
</head>
<body>
	<h3>Calificación de <b><?php echo $_SESSION["user"]; ?></b>,</h3>
	<p>Actualmente tu rango es <b><?php echo $_SESSION["rango"]; ?></b>
	<?php 
		$query = "SELECT * from unilevel WHERE rango_ant='".trim($_SESSION["rango"])."'";
		$result = mysql_query($query,$link);
		if ($row = mysql_fetch_array($result)) {
			$_SESSION['calif'] = $row["rango"];
			$_SESSION['cpm'] = $row["pm"];
			$_SESSION['cpmo'] = $row["pmo"];
			$_SESSION['cpiernas'] = $row["piernas"];
			$_SESSION['ccalif_piernas'] = $row["calif_piernas"];
			echo " y estás optando para calificar a <b>".trim($_SESSION['calif'])."</b>.</p>";
			echo '<p align="justify">Para alcanzar este rango necesitas mantener un consumo mensual de <b>'.number_format($_SESSION['cpm'],0,',','.')." PM</b>";
			if ($_SESSION['cpiernas']<>0) {
				echo ', tu negocio debe generar al menos <b>'.number_format($_SESSION['cpmo'],0,',','.').' PMO';
				if ($_SESSION["calif"]=='Gerente' or $_SESSION["calif"]=='Gerente Senior' or $_SESSION["calif"]=='Oro') {
					echo ' en total';
				} else {
					echo ' por mes';
				}
				echo '</b> y debes tener en tu organización <b>al menos '.number_format($_SESSION['cpiernas'],0,',','.').' piernas calificadas con el rango de '.trim($_SESSION['ccalif_piernas']).'</b></p>';
				$cant = 3;
			} else {
				echo ' y tu negocio debe generar al menos <b>'.number_format($_SESSION['cpmo'],0,',','.').' PMO.</b></p>';
				$cant = 2;
			}
			echo '<p><u>Tus estadísticas para calificar:</u></p>';
			echo '<ul>';

			$suma1 = $_SESSION["pm"];
			$suma2 = $_SESSION["cpm"];
			$logro = 0;
			echo '<li>Puntos Manna del mes (PM): '.number_format($_SESSION["pm"],0,',','.').', requeridos: '.number_format($_SESSION['cpm'],0,',','.');
			if ($_SESSION["pm"]>$_SESSION["cpm"]) {
				echo ' - Logrado el <font color="blue"><b>'.number_format($_SESSION["pm"]/$_SESSION["cpm"]*100,2,',','.').'%</b></font> ';
				echo '<font size="2"><i>(Sólo se toman '.number_format($_SESSION["cpm"],0,',','.').' para la calificación de rangos, los '.number_format($_SESSION["pm"]-$_SESSION["cpm"],0,',','.').' excedentes califican para el bono club manna 180)</i></font>';
				$suma1 = $suma2;
				$logro++;
			} else {
				if ($_SESSION["pm"]==$_SESSION["cpm"]) {
					echo ' - Logrado el  <font color="green"><b>'.number_format($_SESSION["pm"]/$_SESSION["cpm"]*100,2,',','.').'%</b></font>';
					$logro++;
				} else {
					echo ' - Logrado el  <font color="red"><b>'.number_format($_SESSION["pm"]/$_SESSION["cpm"]*100,2,',','.').'%</b></font>';
				}
			}
			echo '.</li>';

			$suma1 += $_SESSION["pmo"];
			$suma2 += $_SESSION["cpmo"];
			echo '<li> Puntos Manna de Volumen ';
			if ($_SESSION["calif"]=='Gerente' or $_SESSION["calif"]=='Gerente Senior' or $_SESSION["calif"]=='Oro') {
				echo 'acumulados';
			} else {
				echo 'del mes';
			}
			echo ' (PMO): '.number_format($_SESSION["pmo"],0,',','.').', requeridos: '.number_format($_SESSION['cpmo'],0,',','.');
			if ($_SESSION["pmo"]>$_SESSION["cpmo"]) {
				echo ' - Logrado el <font color="blue"><b>'.number_format($_SESSION["pmo"]/$_SESSION["cpmo"]*100,2,',','.').'%</b></font>';
				$suma1 -= $_SESSION["pmo"];
				$suma1 += $_SESSION["cpmo"];
				$logro++;
			} else {
				if ($_SESSION["pm"]==$_SESSION["cpm"]) {
					echo ' - Logrado el  <font color="green"><b>'.number_format($_SESSION["pmo"]/$_SESSION["cpmo"]*100,2,',','.').'%</b></font>';
					$logro++;
				} else {
					echo ' - Logrado el  <font color="red"><b>'.number_format($_SESSION["pmo"]/$_SESSION["cpmo"]*100,2,',','.').'%</b></font>';
				}
			}
			echo '.</li>';
			echo '<li><b>PORCENTAJE PROMEDIO DE PUNTOS PARA TU CALIFICACIÓN: '.number_format($suma1/$suma2*100,2,',','.').'%</b></li>';

			if ($cant>2) {
				echo '<br>';

				$piernas = piernas($_SESSION['codigo'],$_SESSION['ccalif_piernas'],$link);
				echo '<li> Piernas calificadas a '.trim($_SESSION['ccalif_piernas']).': '.number_format($piernas,0,',','.').', requeridos: '.number_format($_SESSION['cpiernas'],0,',','.');
				if ($piernas>$_SESSION["cpiernas"]) {
					echo ' - Logrado el <font color="blue"><b>'.number_format($piernas/$_SESSION["cpiernas"]*100,2,',','.').'%</b></font>';
					$logro++;
				} else {
					if ($piernas==$_SESSION["cpiernas"]) {
						echo ' - Logrado el  <font color="green"><b>'.number_format($piernas/$_SESSION["cpiernas"]*100,2,',','.').'%</b></font>';
						$logro++;
					} else {
						echo ' - Logrado el  <font color="red"><b>'.number_format($piernas/$_SESSION["cpiernas"]*100,2,',','.').'%</b></font>';
					}
				}
				echo '.</li>';
			}
			echo '<br>';
			echo '<li><b>PORCENTAJE DE LOGRO DE REQUISITOS PARA TU CALIFICACIÓN: '.number_format($logro/$cant*100,2,',','.').'%</b></li>';
			
			echo '</ul>';
		} else {
			echo ".</p>";
		}
	?>
</body>
</html>