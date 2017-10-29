<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "reportes";
include_once("menu.php");
$men2 = "";
include_once("reportes.php");
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
echo '<div id="cuerpo">';
	echo '<div style="text-align:center">';
		echo '<h3>RESUMEN DE COMISIONES POR PAGAR<br>';
	echo '</div>';

$query = "SELECT * FROM detbonoafiliacion where status_bono='Pendiente' order by patroc_codigo,tit_codigo,afiliado";
$result = mysql_query($query,$link);
$first = true;
$tot_tit = 0.00;
$tot_pat = 0.00;
$tot_gen = 0.00;
$grupo = 1;
while($row = mysql_fetch_array($result)) {
	if ($first) {
		$patroc_codigo = $row['patroc_codigo'];
		$patroc_nombres = $row['patroc_nombres'];
		$first = false;

		echo "<b><u>";
		echo '<div class="sangria"></div>';
		echo "PATROCINADOR";
		echo '<div class="espacio"></div>';
		echo '<div class="espacio"></div>';
		echo '<div class="espacio"></div>';
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo "COMISIÓN";
		echo "</u></b><br>";

		$tot_pat = 0.00;
		$tot_gen = 0.00;
	}
	if ($patroc_codigo<>$row['patroc_codigo']) {
		if ($grupo==1) {
			$txt = '<div class="grupo1">';
			$grupo = 2;
		} else {
			$txt = '<div class="grupo2">';
			$grupo = 1;
		}

		$txt .= '<div class="sangria"></div>';
		$txt .= '<div class="nombre">'.$patroc_codigo." ".trim($patroc_nombres).'</div>';

		$txt .= '<div class="sangria"></div>';
		$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($tot_pat,2,',','.')).'</div>'."<br>";

		$txt .= "</div>";
		echo $txt;
		$patroc_codigo = $row['patroc_codigo'];
		$patroc_nombres = $row['patroc_nombres'];
		$tot_pat = 0.00;
	}
	$patroc_codigo = $row['patroc_codigo'];
	$comision = $row['comision'];

	$tot_pat += $comision;
	$tot_gen += $comision;
}
/*$txt .= '<div style="text-align:right;padding-right:7%;">'.str_repeat('-', 20)."</div>";
$txt .= '<div style="text-align:right;padding-right:7%;"><i>Total Patrocinado '.$tit_codigo." - ".trim($tit_nombre_completo).': '.trim(number_format($tot_tit,2,',','.'))."</i></div>";
$txt .= '<div style="text-align:right;padding-right:7%;">'.str_repeat('=', 20)."</div>";
*/
if ($grupo==1) {
	$txt = '<div class="grupo1">';
	$grupo = 2;
} else {
	$txt = '<div class="grupo2">';
	$grupo = 1;
}

$txt .= '<div class="sangria"></div>';
$txt .= '<div class="nombre">'.$patroc_codigo." ".trim($patroc_nombres).'</div>';

$txt .= '<div class="sangria"></div>';
$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($tot_pat,2,',','.')).'</div>'."<br>";

$txt .= "</div>";
$txt .= '<div style="text-align:right;padding-right:55%;">'.str_repeat('=', 20)."</div>";
$txt .= '<div style="text-align:right;padding-right:55%;"><b>TOTAL GENERAL: '.trim(number_format($tot_gen,2,',','.'))."</b></div>";
echo $txt;
//}

include_once("pie.php");
?>
