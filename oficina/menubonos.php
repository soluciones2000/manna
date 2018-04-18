	<!-- CSS Files -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
	
	

	<!-- CSS -->
	<link href="assets/css/allneat.css" rel="stylesheet" />

<?php 
session_start();
include_once("conexion.php");
include_once("funciones.php");
$codigo = isset($_GET['c']) ? $_GET['c'] : '';

echo '<h3><u>Bono de patrocinio</u></h3>';

$p1 = 0;
$p2 = 0;
$p3 = 0;
$query = "select * from bono_afiliacion";
if ($result = mysql_query($query,$link)) {
	while ($row = mysql_fetch_array($result)) {
		$nivel = $row["nivel"];
		switch ($nivel) {
			case '1':
				switch ($_SESSION["tipo_afiliado"]) {
					case 'Premium':
						$p1 = $row["premium"];
						break;
					case 'vip':
						$p1 = $row["vip"];
						break;
					case 'oro':
						$p1 = $row["oro"];
						break;
				}
				break;
			case '2':
				switch ($_SESSION["tipo_afiliado"]) {
					case 'Premium':
						$p2 = $row["premium"];
						break;
					case 'vip':
						$p2 = $row["vip"];
						break;
					case 'oro':
						$p2 = $row["oro"];
						break;
				}
				break;
			case '3':
				switch ($_SESSION["tipo_afiliado"]) {
					case 'Premium':
						$p3 = $row["premium"];
						break;
					case 'vip':
						$p3 = $row["vip"];
						break;
					case 'oro':
						$p3 = $row["oro"];
						break;
				}
				break;
		}
	}
}
echo '<p>Por ser afiliado '.trim($_SESSION["tipo_afiliado"]).', este bono corresponde al '.number_format($p1,0,',','.').'% de las afiliaciones y/o consumos de tus patrocinados directos (nivel 1), más el '.number_format($p2,0,',','.').'% del nivel 2 y el '.number_format($p3,0,',','.').'% del nivel 3 de esa red durante sesenta días a partir de la fecha de afiliación de ese patrocinado directo.</p>';


/*
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

		$ascenso += ($rango == "En ascenso") ? 1 : 0 ;
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
*/
echo '<form method="post" action="afiliacion.php?c='.$_SESSION["codigo"].'">';
	echo '<p align="center"><input type="submit" name="ordenar" class="btn btn-primary btn-block" value="Ver detalles del bono de patrocinio"></p>';
echo '</form>';

//////////////////////////  BONO UNILEVEL ////////////////
echo '<wbr>';
echo '<h3><u>Bono unilevel</u></h3>';

$query = "select * from unilevel where rango='".trim($_SESSION["rango"])."'";
$result = mysql_query($query,$link);
$row = mysql_fetch_array($result);
$n1 = $row["n1"];
$n2 = $row["n2"];
$n3 = $row["n3"];
$n4 = $row["n4"];
$n5 = $row["n5"];
$n6 = $row["n6"];
$n7 = $row["n7"];
$n8 = $row["n8"];
if ($n1==0) {
	$nx = 0;
} else {
	if ($n2==0) {
		$nx = 1;
	} else {
		if ($n3==0) {
			$nx = 2;
		} else {
			if ($n4==0) {
				$nx = 3;
			} else {
				if ($n5==0) {
					$nx = 4;
				} else {
					if ($n6==0) {
						$nx = 5;
					} else {
						if ($n7==0) {
							$nx = 6;
						} else {
							if ($n8==0) {
								$nx = 7;
							} else {
								$nx = 8;
							}
						}
					}
				}
			}
		}
	}
}
echo '<p>Por tener el rango de: '.$_SESSION["rango"];
if ($_SESSION["rango"]=="En Ascenso") {
	echo ', debes calificar primero al nivel de Gerente, te recomendamos desarrollar tu negocio para obtener los beneficios de este bono.</p>';
} else {
	echo ', este bono corresponde al ';
	if ($n1<>0) {
		echo number_format($n1,0,',','.').'% del consumo generado en el nivel 1 de tu organización';
		if ($nx==1) { echo '.'; }
	}
	if ($n2<>0) {
		if ($nx==2) { echo ' y '; } else { echo ', '; }
		echo number_format($n2,0,',','.').'% del nivel 2';
		if ($nx==2) { echo '.'; }
	}
	if ($n3<>0) {
		if ($nx==3) { echo ' y '; } else { echo ', '; }
		echo number_format($n3,0,',','.').'% del nivel 3';
		if ($nx==3) { echo '.'; }
	}
	if ($n4<>0) {
		if ($nx==4) { echo ' y '; } else { echo ', '; }
		echo number_format($n4,0,',','.').'% del nivel 4';
		if ($nx==4) { echo '.'; }
	}
	if ($n5<>0) {
		if ($nx==5) { echo ' y '; } else { echo ', '; }
		echo number_format($n5,0,',','.').'% del nivel 5';
		if ($nx==5) { echo '.'; }
	}
	if ($n6<>0) {
		if ($nx==6) { echo ' y '; } else { echo ', '; }
		echo number_format($n6,0,',','.').'% del nivel 6';
		if ($nx==6) { echo '.'; }
	}
	if ($n7<>0) {
		if ($nx==7) { echo ' y '; } else { echo ', '; }
		echo number_format($n7,0,',','.').'% del nivel 7';
		if ($nx==7) { echo '.'; }
	}
	if ($n8<>0) {
		if ($nx==8) { echo ' y '; }
		echo number_format($n8,0,',','.').'% del nivel 8';
		if ($nx==8) { echo '.'; }
	}
	echo '</p>';
	echo '<form method="post" action="unilevel.php?c='.$_SESSION["codigo"].'">';
		echo '<p align="center"><input type="submit" name="ordenar" class="btn btn-primary btn-block" value="Ver detalles del bono unilevel"></p>';
	echo '</form>';
}
echo '<wbr>';
echo '<h3><u>Bono de reembolso por consumo</u></h3>';

$query = "select reembolso from empresa";
$result = mysql_query($query,$link);
$row = mysql_fetch_array($result);
$reembolso = $row["reembolso"];

echo '<p>Este bono corresponde al '.number_format($reembolso,0,',','.').'% de todo lo consumido personalmente en el mes actual.</p>';
echo '<form method="post" action="reembolso.php?c='.$_SESSION["codigo"].'">';
	echo '<p align="center"><input type="submit" name="ordenar" class="btn btn-primary btn-block" value="Ver detalles del bono de reembolso por consumo"></p>';
echo '</form>';

$query = "select fecha_afiliacion from afiliados where tit_codigo='".trim($_SESSION["codigo"])."'";
$result = mysql_query($query,$link);
$row = mysql_fetch_array($result);
$fecha_afiliacion = $row["fecha_afiliacion"];
$fecha_fin_bono = strtotime('+60 day', strtotime ($fecha_afiliacion));
$fecha_fin_bono = date ( 'Y-m-d' , $fecha_fin_bono );

if ($fecha_fin_bono>date('Y-m-d')) {
	echo '<wbr>';
	echo '<h3><u>Bono Tablet o Android</u></h3>';

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

	echo '<p align="justify">Si en un período de 60 días desde tu afiliación logras el rango de '.$rango_tablet.' (es decir, mantienes un consumo personal mínimo de '.number_format($cpm,0,',','.').' PM, tu organización produce '.number_format($cpmo,0,',','.').' PMO o más y logras que al menos '.number_format($cpiernas,0,',','.').' de tus afiliados califiquen al rango de '.$ccalif_piernas.' -esto se conoce como piernas calificadas-) obtendrás como bono una TABLET o DISPOSITIVO ANDROID de parte de Corporación Manna de Venezuela.</p>';

	echo '<p align="justify">Actualmente tienes acumulados '.number_format($_SESSION["pm"],0,',','.').' PM, tu organización ha producido '.number_format($_SESSION["pmo"],0,',','.').' PMO y ';

	$piernas = piernas($_SESSION['codigo'],$ccalif_piernas,$link);

	if ($piernas>0) {
		echo 'tienes '.number_format($piernas,0,',','.');
		if ($piernas==1) {
			echo ' pierna calificada';
		} else {
			echo ' piernas calificadas';
		}
		echo ' a '.$ccalif_piernas.'.</p>';
	} else {
		echo 'no tienes piernas calificadas a '.$ccalif_piernas.'.</p>';
	}
	if ($_SESSION["pm"]>=$cpm and $_SESSION["pmo"]>=$cpmo and $piernas>=$cpiernas) {
		echo '<p><b>¡¡¡Felicidades!!! Haz completado los requisitos para optar a este bono.</b></p>';
	} else {
		echo '<p>Para optar a este bono te hacen falta: ';
		if ($_SESSION["pm"]<$cpm) {
			echo number_format($cpm-$_SESSION["pm"],0,',','.').' PM';
			if ($_SESSION["pmo"]<$cpmo and $piernas<$cpiernas) {
				echo ', ';
			} elseif ($_SESSION["pmo"]<$cpmo or $piernas<$cpiernas) {
				echo ' y ';
			} else {
				echo '.</p>';				
			}
		}
		if ($_SESSION["pmo"]<$cpmo) {
			echo number_format($cpmo-$_SESSION["pmo"],0,',','.').' PMO';
			if ($piernas<$cpiernas) {
				echo ' y ';
			} else {
				echo '.</p>';				
			}
		}
		if ($piernas<$cpiernas) {
			echo number_format($cpiernas-$piernas,0,',','.');
			if ($cpiernas-$piernas==1) {
				echo ' pierna calificada.</p>';
			} else {
				echo ' piernas calificadas.</p>';
			}
		}
		$date1 = new DateTime(date('Y-m-d'));
		$date2 = new DateTime($fecha_fin_bono);
		$diff = $date1->diff($date2);
		echo '<p align="justify">Te afiliaste el '.substr($fecha_afiliacion,8,2).'/'.substr($fecha_afiliacion,5,2).'/'.substr($fecha_afiliacion,0,4).' y el plazo se acaba el '.substr($fecha_fin_bono,8,2).'/'.substr($fecha_fin_bono,5,2).'/'.substr($fecha_fin_bono,0,4).', te restan '.number_format($diff->days,0,',','.').' días para alcanzar ganar este bono, aún estás a tiempo, sigue realizando ese excelente trabajo.</p>';
	}
}

?>
