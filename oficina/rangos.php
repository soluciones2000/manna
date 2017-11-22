<?php 
include_once("conexion.php");
include_once("funciones.php");
$codigo = isset($_GET['c']) ? $_GET['c'] : '';
$quer7 = "SELECT tit_nombres,tit_apellidos from afiliados where afiliados.tit_codigo='".$codigo."'";
$resul7 = mysql_query($quer7,$link);
if($ro7 = mysql_fetch_array($resul7)) {
	$name_user = utf8_encode(trim($ro7["tit_nombres"])." ".trim($ro7["tit_apellidos"]));
} else {
	$name_user = "";
}

$quer0 = "DELETE FROM reprangos WHERE 1";
$resul0 = mysql_query($quer0,$link);

if ($_SESSION['ccalif_piernas']<>'') {
	$querq = "SELECT rango_ant from unilevel where rango='".$_SESSION['ccalif_piernas']."'";
	$resulq = mysql_query($querq,$link);
	$roq = mysql_fetch_array($resulq);
	$calif_ant = $roq['rango_ant'];
} else {
	$calif_ant = '';
}

$query = "SELECT organizacion.organizacion,organizacion.afiliado,afiliados.tit_nombres,afiliados.tit_apellidos,afiliados.rango from organizacion left outer join afiliados on organizacion.afiliado=afiliados.tit_codigo where organizacion='".$codigo."' and organizacion.nivel<>0 order by rango,afiliado";
$result = mysql_query($query,$link);
while($row = mysql_fetch_array($result)) {
	if ($first) {
		$rango = $row['rango'];

		$quer2 = "SELECT * from unilevel WHERE rango_ant='".trim($rango)."'";
		$resul2 = mysql_query($quer2,$link);
		$ro2 = mysql_fetch_array($resul2);
		$cpm = $ro2["pm"];
		$cpmo = $ro2["pmo"];
		$cpiernas = $ro2["piernas"];
		$ccalif_piernas = $ro2["calif_piernas"];
		$optando = $ro2["rango"];
/*
		if ($cpiernas<>0) {
			$querq = "SELECT rango_ant from unilevel where rango='".$ccalif_piernas."'";
			$resulq = mysql_query($querq,$link);
			$roq = mysql_fetch_array($resulq);
			$calif_ant = $roq['rango_ant'];
		} else {
			$calif_ant = '';
		}
*/
		$first = false;
	}
	if ($rango<>$row['rango']) {
		$rango = $row['rango'];

		$quer2 = "SELECT * from unilevel WHERE rango_ant='".trim($rango)."'";
		$resul2 = mysql_query($quer2,$link);
		$ro2 = mysql_fetch_array($resul2);
		$cpm = $ro2["pm"];
		$cpmo = $ro2["pmo"];
		$cpiernas = $ro2["piernas"];
		$ccalif_piernas = $ro2["calif_piernas"];
		$optando = $ro2["rango"];
/*		if ($cpiernas<>0) {
			$querq = "SELECT rango_ant from unilevel where rango='".$ccalif_piernas."'";
			$resulq = mysql_query($querq,$link);
			$roq = mysql_fetch_array($resulq);
			$calif_ant = $roq['rango_ant'];
		} else {
			$calif_ant = '';
		}
*/	}
	$afiliado = $row['afiliado'];
	$afil_nombres = $row['tit_nombres'].' '.$row['tit_apellidos'];

	$pm = 0;
	$quer2 = "SELECT afiliado,sum(puntos) as puntos FROM transacciones where afiliado='".trim($afiliado)."' and status_comision='Pendiente' and status_comision<>'No aplica'";
	$resul2 = mysql_query($quer2,$link);
	$ro2 = mysql_fetch_array($resul2);
	if ($ro2["puntos"]>0) {
		$pm = $ro2["puntos"];
	}

	$quer3 = "SELECT afiliado FROM organizacion where organizacion='".trim($afiliado)."'";
	$resul3 = mysql_query($quer3,$link);
	$pmo = 0;
	while($ro3 = mysql_fetch_array($resul3)) {
		$quer4 = "SELECT sum(puntos) as pmo FROM transacciones where afiliado='".trim($ro3["afiliado"])."' and status_comision='Pendiente' and status_comision<>'No aplica'";
		$resul4 = mysql_query($quer4,$link);
		$ro4 = mysql_fetch_array($resul4);
		$pmo += $ro4["pmo"];
	}
	$pmo -= $pm;

	$piernas = piernas($afiliado,$ccalif_piernas,$link);

	$ppm = $pm/$cpm*100;

	$ppmo = $pmo/$cpmo*100;

	$suma = 0;
	if ($cpiernas<>0) {
		$ppiernas = $piernas/$cpiernas*100;
		if ($piernas/$cpiernas>=1) {
			$suma++;
		}
		$cuenta = 3;
	} else {
		$ppiernas = 0;
		$cuenta = 2;
	}
	if ($pm/$cpm>=1) {
		$suma++;
	}
	if ($pmo/$cpmo>=1) {
		$suma++;
	}
	
	$preq = $suma/$cuenta*100;

	if ($ccalif_piernas==$_SESSION['ccalif_piernas']) {
		$prioridad = 1;
	} elseif ($rango==$calif_ant) {
		$prioridad = 2;
	} else {
		$prioridad = 3;
	}

	$quer2 = "INSERT INTO reprangos (rango, optando, afiliado, afil_nombres, pm, cpm, ppm, pmo, cpmo, ppmo, piernas, cpiernas, ppiernas, calif_piernas, suma, cuenta, preq, prioridad) VALUES ('".$rango."', '".$optando."', '".$afiliado."', '".$afil_nombres."', ".$pm.", ".$cpm.", ".$ppm.", ".$pmo.", ".$cpmo.", ".$ppmo.", ".$piernas.", ".$cpiernas.", ".$ppiernas.", '".$ccalif_piernas."', ".$suma.", ".$cuenta.", ".$preq.", ".$prioridad.")";
	$resul2 = mysql_query($quer2,$link);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>
<style>
.sangria {
    width: 3%;
	display: inline-block;	
}
.caracter {
    width: 1%;
	display: inline-block;	
}
.espacio {
    width: 8%;
	display: inline-block;	
}
.nombre {
    width: 38%;
	display: inline-block;	
}
.nombre_trans {
    width: 22%;
	display: inline-block;	
}
.tipo_af {
    width: 5%;
	display: inline-block;	
}
.detalle {
    width: 12%;
	display: inline-block;	
}
.varios {
    width: 15%;
	display: inline-block;	
}

.codigo {
    width: 5%;
	display: inline-block;	
}
.grupo1 {
	background-color: powderblue;
}
.grupo2 {
	background-color: none;
}
.grupo1-total {
	background-color: powderblue;
	padding-left: 30%;
	padding-right: 37%;
}
.grupo2-total {
	background-color: none;
	padding-left: 30%;
	padding-right: 37%;
}
</style>
<?php
$dsd = $codigo;
$hst = $dsd;

echo '<div id="cuerpo">';
	echo '<div style="text-align:center">';
		echo '<h3>Calificaciones de la organización de: ';
		echo '<font color="red">'.trim($name_user).'</font></h3>';
	echo '</div>';

$query = "select * from reprangos order by prioridad,rango,preq desc,ppiernas desc,ppmo desc,ppm desc";
$result = mysql_query($query,$link);
$first = true;
$grupo = 1;
while($row = mysql_fetch_array($result)) {
	if ($first) {
		$rango = $row['rango'];
		$optando = $row['optando'];

		$first = false;

		echo "<b><u>";
		echo '<div class="sangria"></div>';
		echo "AFILIADO";

		echo '<div class="varios"></div>';
		echo '<div class="varios"></div>';
		echo '<div class="sangria"></div>';
		echo '<div class="sangria"></div>';
		echo "PM";

		echo '<div class="sangria"></div>';
		echo '<div class="sangria"></div>';
		echo '<div class="sangria"></div>';
		echo '<div class="caracter"></div>';
		echo "PMO";

		echo '<div class="sangria"></div>';
		echo '<div class="caracter"></div>';
		echo "PIERNAS CALIFICADAS";

		echo '<div class="sangria"></div>';
		echo '<div class="sangria"></div>';
		echo "REQUISITOS";

		echo "</u></b><br>";

		echo '<u>Rango: '.$rango.' optando a '.$optando.'</u><br>';
	}
	if ($rango<>$row['rango']) {
		echo $txt;
		$rango = $row['rango'];
		$optando = $row['optando'];
		$txt = '<u>Rango: '.$rango.' optando a '.$optando.'</u><br>';
	}
	$afiliado = $row['afiliado'];
	$afil_nombres = $row['afil_nombres'];
	$pm = $row["pm"];
	$cpm = $row["cpm"];
	$ppm = $row["ppm"];

	$pmo = $row["pmo"];
	$cpmo = $row["cpmo"];
	$ppmo = $row["ppmo"];

	$piernas = $row["piernas"];
	$cpiernas = $row["cpiernas"];
	$ppiernas = $row["ppiernas"];

	$calif_piernas = $row["calif_piernas"];
	$suma = $row["suma"];
	$cuenta = $row["cuenta"];
	$preq = $row["preq"];

//	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="nombre">'.$afiliado." - ".$afil_nombres.'</div>';
	if ($ppm<100) {
		$txt .= '<div class="detalle" style="text-align:right;">'.number_format($pm,2,',','.').'<font color="red"> ('.number_format($ppm,2,',','.').'%)</font></div>';
	} else {
		if ($ppm>100) {
			$txt .= '<div class="detalle" style="text-align:right;">'.number_format($pm,2,',','.').'<font color="blue"> ('.number_format($ppm,2,',','.').'%)</font></div>';
		} else {
			$txt .= '<div class="detalle" style="text-align:right;">'.number_format($pm,2,',','.').' ('.number_format($ppm,2,',','.').'%)</div>';
		}
	}

	$txt .= '<div class="caracter"></div>';
	if ($ppmo<100) {
		$txt .= '<div class="detalle" style="text-align:right;">'.number_format($pmo,2,',','.').'<font color="red"> ('.number_format($ppmo,2,',','.').'%)</font></div>';
	} else {
		if ($ppmo>100) {
			$txt .= '<div class="detalle" style="text-align:right;">'.number_format($pmo,2,',','.').'<font color="blue"> ('.number_format($ppmo,2,',','.').'%)</font></div>';
		} else {
			$txt .= '<div class="detalle" style="text-align:right;">'.number_format($pm,2,',','.').' ('.number_format($ppmo,2,',','.').'%)</div>';
		}
	}

	$txt .= '<div class="caracter"></div>';
	if ($cpiernas<>0) {
		$txt .= '<div class="nombre_trans" style="text-align:center;">'.number_format($piernas,0,',','.').' de '.number_format($cpiernas,0,',','.').' '.trim($calif_piernas).' requeridas ';
		if ($ppiernas<100) {
			$txt .= '<font color="red">('.number_format($ppiernas,2,',','.').'%)</font></div>';
		} else {
			if ($ppmo>100) {
				$txt .= '<font color="blue">('.number_format($ppiernas,2,',','.').'%)</font></div>';
			} else {
				$txt .= '('.number_format($ppiernas,2,',','.').'%)</div>';
			}
		}
	} else {
		$txt .= '<div class="nombre_trans" style="text-align:center;">NO APLICA</div>';
	}

	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="detalle" style="text-align:right;">'.number_format($suma,0,',','.').'/'.number_format($cuenta,0,',','.').' ';
	if ($preq<100) {
		$txt .= '<font color="red">('.number_format($preq,2,',','.').'%)</font></div>';
	} else {
		if ($preq>100) {
			$txt .= '<font color="blue">('.number_format($preq,2,',','.').'%)</font></div>';
		} else {
			$txt .= '('.number_format($preq,2,',','.').'%)</div>';
		}
	}

	$txt .= '<br>';
}
echo $txt;
/*
while($row = mysql_fetch_array($result)) {
	if ($first) {
		$rango = $row['rango'];

		$quer2 = "SELECT * from unilevel WHERE rango_ant='".trim($rango)."'";
		$resul2 = mysql_query($quer2,$link);
		$ro2 = mysql_fetch_array($resul2);
		$cpm = $ro2["pm"];
		$cpmo = $ro2["pmo"];
		$cpiernas = $ro2["piernas"];
		$ccalif_piernas = $ro2["calif_piernas"];

		$first = false;

		echo "<b><u>";
		echo '<div class="sangria"></div>';
		echo "AFILIADO";

		echo '<div class="varios"></div>';
		echo '<div class="varios"></div>';
		echo '<div class="sangria"></div>';
		echo '<div class="sangria"></div>';
		echo '<div class="caracter"></div>';
		echo "PM";

		echo '<div class="sangria"></div>';
		echo '<div class="sangria"></div>';
		echo '<div class="caracter"></div>';
		echo "PMO";

		echo '<div class="sangria"></div>';
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo "PIERNAS CALIF.";

		echo '<div class="sangria"></div>';
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo "REQUISITOS";

		echo "</u></b><br>";

		echo '<u>Rango: '.$rango."</u><br>";
	}
	if ($rango<>$row['rango']) {
		echo $txt;
		$rango = $row['rango'];

		$quer2 = "SELECT * from unilevel WHERE rango_ant='".trim($rango)."'";
		$resul2 = mysql_query($quer2,$link);
		$ro2 = mysql_fetch_array($resul2);
		$cpm = $ro2["pm"];
		$cpmo = $ro2["pmo"];
		$cpiernas = $ro2["piernas"];
		$ccalif_piernas = $ro2["calif_piernas"];

		$txt = '<u>Rango: '.$rango."</u><br>";
	}
	$afiliado = $row['afiliado'];
	$afil_nombres = $row['tit_nombres'].' '.$row['tit_apellidos'];

	$pm = 0;
	$quer2 = "SELECT afiliado,sum(puntos) as puntos FROM transacciones where afiliado='".trim($afiliado)."' and status_comision='Pendiente' and status_comision<>'No aplica'";
	$resul2 = mysql_query($quer2,$link);
	$ro2 = mysql_fetch_array($resul2);
	if ($ro2["puntos"]>0) {
		$pm = $ro2["puntos"];
	}

	$quer3 = "SELECT afiliado FROM organizacion where organizacion='".trim($afiliado)."'";
	$resul3 = mysql_query($quer3,$link);
	$pmo = 0;
	while($ro3 = mysql_fetch_array($resul3)) {
		$quer4 = "SELECT sum(puntos) as pmo FROM transacciones where afiliado='".trim($ro3["afiliado"])."' and status_comision='Pendiente' and status_comision<>'No aplica'";
		$resul4 = mysql_query($quer4,$link);
		$ro4 = mysql_fetch_array($resul4);
		$pmo += $ro4["pmo"];
	}
	$pmo -= $pm;

	$piernas = piernas($afiliado,$ccalif_piernas,$link);

	$txt .= '<div class="sangria"></div>';
	$txt .= '<div class="nombre">'.$afiliado." - ".$afil_nombres.'</div>';

	$txt .= '<div class="detalle" style="text-align:right;">'.number_format($pm/$cpm*100,2,',','.').'%</div>';

	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="detalle" style="text-align:right;">'.number_format($pmo/$cpmo*100,2,',','.').'%</div>';

	$txt .= '<div class="caracter"></div>';

	$suma = 0;
	if ($cpiernas<>0) {
		$txt .= '<div class="nombre_trans" style="text-align:center;">'.number_format($piernas,0,',','.').' de '.number_format($cpiernas,0,',','.').' '.trim($ccalif_piernas).' requeridas ('.number_format($piernas/$cpiernas*100,2,',','.').'%)</div>';
		if ($piernas/$cpiernas>=1) {
			$suma++;
		}
		$cuenta = 3;
	} else {
		$txt .= '<div class="nombre_trans" style="text-align:center;">NO APLICA</div>';
		$cuenta = 2;
	}
	if ($pm/$cpm>=1) {
		$suma++;
	}
	if ($pmo/$cpmo>=1) {
		$suma++;
	}
	
	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="detalle" style="text-align:right;">'.number_format($suma,0,',','.').'/'.number_format($cuenta,0,',','.').' ('.number_format($suma/$cuenta*100,2,',','.').'%)</div>';

	$txt .= '<br>';
}
*/
?>
