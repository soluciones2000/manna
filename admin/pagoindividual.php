<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "pagos";
include_once("menu.php");
$men2 = "detpat";
include_once("pagos.php");
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
    width: 30%;
	display: inline-block;	
}
.tipo_af {
    width: 5%;
	display: inline-block;	
}
.detalle {
    width: 9%;
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
if ($_POST['cod_desde']<>'') {
	$dsd = $_POST['cod_desde'];
} else {
	$dsd = 'Primero';
}
if ($_POST['cod_hasta']<>'') {
	$hst = $_POST['cod_hasta'];
} else {
	$hst = 'Último';
}

echo '<div id="cuerpo">';
	echo '<div style="text-align:center">';
		echo '<h3>BONOS DE PATROCINIO INDIVIDUALES POR PAGAR<br>';
		echo 'Desde el código: <font color="red">'.trim($dsd).'</font> hasta el código: <font color="red">'.trim($hst).'</font></h3>';
	echo '</div>';

if ($dsd<>'Primero') {
	if ($hst<>'Último') {
		$query = "SELECT * FROM detbonoafiliacion WHERE patroc_codigo>='".trim($dsd)."' AND patroc_codigo<='".trim($hst)."' AND status_bono='Pendiente' order by patroc_codigo,tit_codigo,nivel,afiliado";
	} else {
		$query = "SELECT * FROM detbonoafiliacion WHERE patroc_codigo>='".trim($dsd)."'  AND status_bono='Pendiente' order by patroc_codigo,tit_codigo,nivel,afiliado";
	}
} else {
	if ($hst<>'Último') {
		$query = "SELECT * FROM detbonoafiliacion WHERE patroc_codigo<='".trim($hst)."'  AND status_bono='Pendiente' order by patroc_codigo,tit_codigo,nivel,afiliado";
	} else {
		$query = "SELECT * FROM detbonoafiliacion WHERE status_bono='Pendiente' order by patroc_codigo,tit_codigo,nivel,afiliado";
	}
}

$result = mysql_query($query,$link);
$first = true;
$tot_tit = 0.00;
$tot_pat = 0.00;
$tot_gen = 0.00;
$grupo = 1;
echo '<form name="gestion" method="post" action="totpagoindividual.php">';
while($row = mysql_fetch_array($result)) {
	if ($first) {
		$patroc_codigo = $row['patroc_codigo'];
		$tit_codigo = $row['tit_codigo'];
		$patroc_nombres = $row['patroc_nombres'];
		$tit_nombre_completo = $row['tit_nombre_completo'];
		$tipo_patroc = $row['tipo_patroc'];
		$first = false;

		echo "<b><u>";
//		echo '<div class="caracter"></div>';
		echo "NIVEL";
		echo '<div class="espacio"></div>';
		echo "AFILIADO";
		echo '<div class="espacio"></div>';
		echo '<div class="espacio"></div>';
		echo '<div class="sangria"></div>';
		echo "TIPO";

		echo '<div class="sangria"></div>';
		echo "TRANSACCIÓN";

		echo '<div class="sangria"></div>';
		echo '<div class="sangria"></div>';
		echo '<div class="caracter"></div>';
		echo "FECHA";
		echo '<div class="sangria"></div>';
		echo '<div class="sangria"></div>';
		echo "MONTO";
		echo '<div class="caracter"></div>';
		echo "PORCENT.";
		echo '<div class="caracter"></div>';
		echo "COMISIÓN";
		echo "</u></b><br>";

		$txt = '<div class="grupo1">';
		$txt .= "<b>Patrocinador: ".$patroc_codigo." - ".$patroc_nombres." - tipo de afiliado: ".$tipo_patroc."</b><br>";
		$txt .= '<div class="caracter"></div><i><u>Patrocinado: '.$tit_codigo." - ".$tit_nombre_completo."</u></i><br>";
		$tot_tit = 0.00;
		$tot_pat = 0.00;
		$tot_gen = 0.00;
	}
	if ($patroc_codigo<>$row['patroc_codigo']) {
//		$txt .= '<div style="text-align:right;padding-right:7%;">'.str_repeat('-', 20)."</div>";
//		$txt .= '<div style="text-align:right;padding-right:7%;"><i>Total Patrocinado '.$tit_codigo." - ".trim($tit_nombre_completo).': '.trim(number_format($tot_tit,2,',','.'))."</i></div>";
//		$txt .= '<div style="text-align:right;padding-right:7%;">'.str_repeat('=', 20)."</div>";
//		$txt .= '<div style="text-align:right;padding-right:7%;"><b>Total Patrocinador '.$patroc_codigo." - ".trim($patroc_nombres).': '.trim(number_format($tot_pat,2,',','.'))."</b></div>";
		$txt .= "<br><br></div>";
		echo $txt;
		$patroc_codigo = $row['patroc_codigo'];
		$tit_codigo = $row['tit_codigo'];
		$patroc_nombres = $row['patroc_nombres'];
		$tit_nombre_completo = $row['tit_nombre_completo'];
		$tipo_patroc = $row['tipo_patroc'];
		if ($grupo==1) {
			$txt = '<div class="grupo2">';
			$grupo = 2;
		} else {
			$txt = '<div class="grupo1">';
			$grupo = 1;
		}
		$txt .= "<b>Patrocinador: ".$patroc_codigo." - ".$patroc_nombres." - tipo de afiliado: ".$tipo_patroc."</b><br>";
		$txt .= '<div class="caracter"></div><i><u>Patrocinado: '.$tit_codigo." - ".$tit_nombre_completo."</u></i><br>";
		$tot_tit = 0.00;
		$tot_pat = 0.00;
	}
	if ($tit_codigo<>$row['tit_codigo']) {
//		$txt .= '<div class="caracter"></div>';
//		$txt .= '<div style="text-align:right;padding-right:7%;">'.str_repeat('-', 20)."</div>";
//		$txt .= '<div style="text-align:right;padding-right:7%;"><i>Total Patrocinado '.$tit_codigo." - ".trim($tit_nombre_completo).': '.trim(number_format($tot_tit,2,',','.'))."</i></div>";
		$txt .= "<br>";
		echo $txt;
		$patroc_codigo = $row['patroc_codigo'];
		$tit_codigo = $row['tit_codigo'];
		$patroc_nombres = $row['patroc_nombres'];
		$tit_nombre_completo = $row['tit_nombre_completo'];
		$txt = '<div class="caracter"></div><i><u>Patrocinado: '.$tit_codigo." - ".$tit_nombre_completo."</u></i><br>";
		$tot_tit = 0.00;
	}
	$patroc_codigo = $row['patroc_codigo'];
	$tit_codigo = $row['tit_codigo'];
	$fecha_afiliacion = $row['fecha_afiliacion'];
	$fecha_fin_bono = $row['fecha_fin_bono'];
	$nivel = $row['nivel'];
	$afiliado = $row['afiliado'];
	$tipo_patroc = $row['tipo_patroc'];
	$tipo_afil = $row['tipo_afil'];
	$tipo_trans = $row['tipo_trans'];
	$fectr = $row['fectr'];
	$monto = $row['monto'];
	$porcentaje = $row['porcentaje'];
	$comision = $row['comision'];
	$patroc_nombres = $row['patroc_nombres'];
	$tit_nombre_completo = $row['tit_nombre_completo'];
	$afil_nombres = $row['afil_nombres'];
	$id = $row['id'];

	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="caracter"></div>';
//	$txt .= '<div class="sangria"></div>';
	$txt .= $nivel;

	$txt .= '<div class="sangria"></div>';
	$txt .= '<div class="nombre">'.$afiliado." ".$afil_nombres.'</div>';

	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="tipo_af">'.$tipo_afil.'</div>';

	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="varios">'.$tipo_trans.'</div>';

	$txt .= '<div class="caracter"></div>';
	$txt .= substr($fectr,8,2).'/'.substr($fectr,5,2).'/'.substr($fectr,0,4);

	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($monto,2,',','.')).'</div>';

	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="sangria" style="text-align:right;">'.number_format($porcentaje,0,',','.')."%".'</div>';

	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($comision,2,',','.')).'</div>';

	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="detalle" style="text-align:right;">'.'<input type="checkbox" name="'.trim($id).'"/> Pagar</div>'."<br>";

	$tot_tit += $comision;
	$tot_pat += $comision;
	$tot_gen += $comision;
//	echo $txt;
}
//if ($patroc_codigo<>$row['patroc_codigo']) {
/*
	$txt .= '<div style="text-align:right;padding-right:7%;">'.str_repeat('-', 20)."</div>";
	$txt .= '<div style="text-align:right;padding-right:7%;"><i>Total Patrocinado '.$tit_codigo." - ".trim($tit_nombre_completo).': '.trim(number_format($tot_tit,2,',','.'))."</i></div>";
	$txt .= '<div style="text-align:right;padding-right:7%;">'.str_repeat('=', 20)."</div>";
	$txt .= '<div style="text-align:right;padding-right:7%;"><b>Total Patrocinador '.$patroc_codigo." - ".trim($patroc_nombres).': '.trim(number_format($tot_pat,2,',','.'))."</b></div>";
	$txt .= '</div>';
	$txt .= '<div style="text-align:right;padding-right:7%;">'.str_repeat('=', 20)."</div>";
	$txt .= '<div style="text-align:right;padding-right:7%;"><b>TOTAL GENERAL: '.trim(number_format($tot_gen,2,',','.'))."</b></div>";
	echo $txt;
*/
//}
echo '<div style="text-align:right;padding-right:1.5%;">';
	echo '<br>';
	echo '<input type="submit" value="Totalizar">';
echo '</div>';
 

include_once("pie.php");
?>
