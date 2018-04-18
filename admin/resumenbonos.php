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
		echo '<h3>RESUMEN DE BONOS Y COMISIONES POR PAGAR<br>';
	echo '</div>';

$query = "SELECT tit_codigo as codigo, sum(detbonoafiliacion.comision) as patrocinio,0 as unilevel, 0 as reembolso FROM detbonoafiliacion WHERE status_bono='Pendiente' and nivel>0 group by tit_codigo union SELECT organizacion as codigo, 0 as patrocinio,sum(detunilevel.comision) as unilevel, 0 as reembolso FROM detunilevel where status_unilevel='Pendiente' group by organizacion union SELECT afiliado as codigo, 0 as patrocinio,0 as unilevel, sum(reembolso.monto) as reembolso FROM reembolso where status_comision='Pendiente' group by afiliado order by codigo";
$result = mysql_query($query,$link);
$first = true;
$tot_uni = 0.00;
$tot_pat = 0.00;
$tot_ree = 0.00;
$tot_ge1 = 0.00;
$tot_ge2 = 0.00;
$tot_ge3 = 0.00;
$grupo = 1;
while($row = mysql_fetch_array($result)) {
	if ($first) {
		$codigo = $row['codigo'];
		$quer2 = "SELECT tit_nombres,tit_apellidos FROM afiliados where tit_codigo='".$codigo."'";
		$resul2 = mysql_query($quer2,$link);
		$ro2 = mysql_fetch_array($resul2);
		$nombres = trim($ro2['tit_nombres']).' '.trim($ro2['tit_apellidos']);
		$first = false;

		echo "<b><u>";
		echo '<div class="sangria"></div>';
		echo "AFILIADO";
		echo '<div class="espacio"></div>';
		echo '<div class="espacio"></div>';
		echo '<div class="espacio"></div>';
		echo '<div class="sangria"></div>';
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo "PATROCINIO";
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo "UNILEVEL";
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo "REEMBOLSO";
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo "TOTAL";
		echo "</u></b><br>";

		$tot_pat = 0.00;
		$tot_gen = 0.00;
	}
	if ($codigo<>$row['codigo']) {
		if ($grupo==1) {
			$txt = '<div class="grupo1">';
			$grupo = 2;
		} else {
			$txt = '<div class="grupo2">';
			$grupo = 1;
		}

		$txt .= '<div class="sangria"></div>';
		$txt .= '<div class="nombre">'.$codigo." ".trim($nombres).'</div>';

		$txt .= '<div class="sangria"></div>';
		$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($tot_pat,2,',','.')).'</div>';
		$txt .= '<div class="sangria"></div>';
		$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($tot_uni,2,',','.')).'</div>';
		$txt .= '<div class="sangria"></div>';
		$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($tot_ree,2,',','.')).'</div>';
		$txt .= '<div class="sangria"></div>';
		$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($tot_pat+$tot_uni+$tot_ree,2,',','.')).'</div>'."<br>";

		$txt .= "</div>";
		echo $txt;
		$codigo = $row['codigo'];
		$quer2 = "SELECT tit_nombres,tit_apellidos FROM afiliados where tit_codigo='".$codigo."'";
		$resul2 = mysql_query($quer2,$link);
		$ro2 = mysql_fetch_array($resul2);
		$nombres = trim($ro2['tit_nombres']).' '.trim($ro2['tit_apellidos']);
		$tot_pat = 0.00;
		$tot_uni = 0.00;
		$tot_ree = 0.00;
	}
	$codigo = $row['codigo'];
	$patrocinio = $row['patrocinio'];
	$unilevel = $row['unilevel'];
	$reembolso = $row['reembolso'];

	$tot_pat += $patrocinio;
	$tot_uni += $unilevel;
	$tot_ree += $reembolso;
	$tot_ge1 += $patrocinio;
	$tot_ge2 += $unilevel;
	$tot_ge3 += $reembolso;
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
$txt .= '<div class="nombre">'.$codigo." ".trim($nombres).'</div>';

$txt .= '<div class="sangria"></div>';
$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($tot_pat,2,',','.')).'</div>';
$txt .= '<div class="sangria"></div>';
$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($tot_uni,2,',','.')).'</div>';
$txt .= '<div class="sangria"></div>';
$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($tot_ree,2,',','.')).'</div>';
$txt .= '<div class="sangria"></div>';
$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($tot_pat+$tot_uni+$tot_ree,2,',','.')).'</div>'."<br>";

$txt .= "</div>";
$txt .= '<div class="sangria"></div>';
$txt .= '<div class="nombre"></div>';
$txt .= '<div class="sangria"></div>';
$txt .= '<div class="detalle" style="text-align:right;">'.str_repeat('=', 12)."</div>";
$txt .= '<div class="sangria"></div>';
$txt .= '<div class="detalle" style="text-align:right;">'.str_repeat('=', 12)."</div>";
$txt .= '<div class="sangria"></div>';
$txt .= '<div class="detalle" style="text-align:right;">'.str_repeat('=', 12)."</div>";
$txt .= '<div class="sangria"></div>';
$txt .= '<div class="detalle" style="text-align:right;">'.str_repeat('=', 12)."</div><br>";

$txt .= '<div class="sangria"></div>';
$txt .= '<div class="nombre"><b>TOTAL GENERAL: </div>';
$txt .= '<div class="sangria"></div>';
$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($tot_ge1,2,',','.'))."</div>";
$txt .= '<div class="sangria"></div>';
$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($tot_ge2,2,',','.')).'</div>';
$txt .= '<div class="sangria"></div>';
$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($tot_ge3,2,',','.')).'</div>';
$txt .= '<div class="sangria"></div>';
$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($tot_ge1+$tot_ge2+$tot_ge3,2,',','.')).'</div></b>'."<br>";
echo $txt;
//}

include_once("pie.php");
?>
