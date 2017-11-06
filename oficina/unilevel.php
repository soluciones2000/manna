<?php 
include_once("conexion.php");
$codigo = isset($_GET['c']) ? $_GET['c'] : '';
$quer7 = "SELECT tit_nombres,tit_apellidos from afiliados where tit_codigo='".$codigo."'";
$resul7 = mysql_query($quer7,$link);
if($ro7 = mysql_fetch_array($resul7)) {
	$name_user = utf8_encode(trim($ro7["tit_nombres"])." ".trim($ro7["tit_apellidos"]));
} else {
	$name_user = "";
}
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
.nombre_trans {
    width: 22%;
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
$dsd = $codigo;
$hst = $dsd;

echo '<div id="cuerpo">';
	echo '<div style="text-align:center">';
		echo '<h3>BONOS UNILEVEL POR PAGAR<br>';
		echo '<font color="red">'.trim($name_user).'</font></h3>';
	echo '</div>';

$query = "SELECT * FROM detunilevel WHERE organizacion>='".trim($dsd)."' AND organizacion<='".trim($hst)."' AND status_unilevel='Pendiente' order by organizacion,afiliado,nivel,tipo_trans,fectr";
$result = mysql_query($query,$link);
$first = true;
$tot_tit = 0.00;
$tot_pat = 0.00;
$tot_gen = 0.00;
$grupo = 1;
while($row = mysql_fetch_array($result)) {
	if ($first) {
		$organizacion = $row['organizacion'];
		$afiliado = $row['afiliado'];
		$org_nombres= $row['org_nombres'];
		$afil_nombres = $row['afil_nombres'];
		$first = false;

		echo "<b><u>";
//		echo '<div class="sangria"></div>';
		echo "NIVEL";
		echo '<div class="espacio"></div>';
		echo "AFILIADO";
//		echo '<div class="espacio"></div>';
//		echo '<div class="espacio"></div>';
//		echo '<div class="sangria"></div>';
//		echo "TIPO";

		echo '<div class="varios"></div>';
		echo '<div class="sangria"></div>';
		echo "TRANSACCIÓN";

		echo '<div class="sangria"></div>';
		echo '<div class="sangria"></div>';
		echo '<div class="sangria"></div>';
		echo '<div class="sangria"></div>';
		echo '<div class="caracter"></div>';
//		echo '<div class="caracter"></div>';
		echo "FECHA";
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo '<div class="sangria"></div>';
		echo "MONTO";
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo "PORC.";
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo "COMISIÓN";
		echo "</u></b><br>";

//		$txt = '<div class="grupo1">';
//		$txt .= "<b>Patrocinador: ".$patroc_codigo." - ".$patroc_nombres." - tipo de afiliado: ".$tipo_patroc."</b><br>";
//		$txt = '<div class="caracter"></div><i><u>Patrocinado: '.$tit_codigo." - ".$tit_nombre_completo."</u></i><br>";
//		$tot_tit = 0.00;
//		$tot_pat = 0.00;
		$tot_gen = 0.00;
	}
/*
	if ($patroc_codigo<>$row['patroc_codigo']) {
		$txt .= '<div style="text-align:right;padding-right:7%;">'.str_repeat('-', 20)."</div>";
		$txt .= '<div style="text-align:right;padding-right:7%;"><i>Total Patrocinado '.$tit_codigo." - ".trim($tit_nombre_completo).': '.trim(number_format($tot_tit,2,',','.'))."</i></div>";
		$txt .= '<div style="text-align:right;padding-right:7%;">'.str_repeat('=', 20)."</div>";
		$txt .= '<div style="text-align:right;padding-right:7%;"><b>Total Patrocinador '.$patroc_codigo." - ".trim($patroc_nombres).': '.trim(number_format($tot_pat,2,',','.'))."</b></div>";
		$txt .= "</div>";
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
		$txt .= "<b>Patrocinador: ".$organizacion." - ".$patroc_nombres." - tipo de afiliado: ".$tipo_patroc."</b><br>";
		$txt .= '<div class="caracter"></div><i><u>Patrocinado: '.$tit_codigo." - ".$tit_nombre_completo."</u></i><br>";
		$tot_tit = 0.00;
		$tot_pat = 0.00;
	}

	if ($afiliado<>$row['afiliado']) {
//		$txt .= '<div class="caracter"></div>';
		$txt .= '<div style="text-align:right;padding-right:7.5%;">'.str_repeat('-', 20)."</div>";
		$txt .= '<div style="text-align:right;padding-right:7.5%;"><i>Total Patrocinado '.$tit_codigo." - ".trim($tit_nombre_completo).': '.trim(number_format($tot_tit,2,',','.'))."</i></div>";
		echo $txt;
		$organizacion = $row['organizacion'];
		$tit_codigo = $row['tit_codigo'];
		$patroc_nombres = $row['patroc_nombres'];
		$tit_nombre_completo = $row['tit_nombre_completo'];
		$txt = '<div class="caracter"></div><i><u>Patrocinado: '.$tit_codigo." - ".$tit_nombre_completo."</u></i><br>";
		$tot_tit = 0.00;
	}
*/
	$organizacion = $row['organizacion'];
	$org_nombres = $row['org_nombres'];
	$nivel = $row['nivel'];
	$afiliado = $row['afiliado'];
	$afil_nombres = $row['afil_nombres'];
	$fectr = $row['fectr'];
	$tipo_trans = $row['tipo_trans'];
	$nombre_trans = $row['nombre_trans'];

	$precio = $row['precio'];
	$monto = $row['monto'];
	$porcentaje = $row['porcentaje'];
	$comision = $row['comision'];

	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="caracter"></div>';
//	$txt .= '<div class="sangria"></div>';
	$txt .= $nivel;

	$txt .= '<div class="sangria"></div>';
	$txt .= '<div class="nombre">'.$afiliado." ".$afil_nombres.'</div>';

	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="nombre_trans">'.$nombre_trans.'</div>';

//	$txt .= '<div class="caracter"></div>';
//	$txt .= '<div class="varios">'.$tipo_trans.'</div>';

	$txt .= '<div class="caracter"></div>';
	$txt .= substr($fectr,8,2).'/'.substr($fectr,5,2).'/'.substr($fectr,0,4);

	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($monto,2,',','.')).'</div>';

	$txt .= '<div class="sangria"></div>';
	$txt .= '<div class="sangria" style="text-align:right;">'.number_format($porcentaje,0,',','.')."%".'</div>';

	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($comision,2,',','.')).'</div>'."<br>";
//	$tot_tit += $comision;
//	$tot_pat += $comision;
	$tot_gen += $comision;
//	echo $txt;
}
//if ($patroc_codigo<>$row['patroc_codigo']) {
//	$txt .= '<div style="text-align:right;padding-right:7.5%;">'.str_repeat('-', 20)."</div>";
//	$txt .= '<div style="text-align:right;padding-right:7.5%;"><i>Total Patrocinado '.$tit_codigo." - ".trim($tit_nombre_completo).': '.trim(number_format($tot_tit,2,',','.'))."</i></div>";
	$txt .= '<div style="text-align:right;padding-right:7%;">'.str_repeat('=', 20)."</div>";
	$txt .= '<div style="text-align:right;padding-right:7%;"><b>Total Unilevel para '.$organizacion." - ".trim($patroc_nombres).': '.trim(number_format($tot_gen,2,',','.'))."</b></div>";
	$txt .= '<br>';
//	$txt .= '</div>';
//	$txt .= '<div style="text-align:right;padding-right:7%;">'.str_repeat('=', 20)."</div>";
//	$txt .= '<div style="text-align:right;padding-right:7%;"><b>TOTAL GENERAL: '.trim(number_format($tot_gen,2,',','.'))."</b></div>";
	echo $txt;
//}
?>
