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
		echo '<h3>BONOS UNILEVEL POR PAGAR<br>';
		echo 'Desde el código: <font color="red">'.trim($dsd).'</font> hasta el código: <font color="red">'.trim($hst).'</font></h3>';
	echo '</div>';

if ($dsd<>'Primero') {
	if ($hst<>'Último') {
		$query = "SELECT * FROM detunilevel WHERE organizacion>='".trim($dsd)."' AND organizacion<='".trim($hst)."' AND status_unilevel='Pendiente' order by organizacion,afiliado,nivel,tipo_trans,fectr";
	} else {
		$query = "SELECT * FROM detunilevel WHERE organizacion>='".trim($dsd)."' AND status_unilevel='Pendiente' order by organizacion,afiliado,nivel,tipo_trans,fectr";
	}
} else {
	if ($hst<>'Último') {
		$query = "SELECT * FROM detunilevel WHERE organizacion<='".trim($hst)."' AND status_unilevel='Pendiente' order by organizacion,afiliado,nivel,tipo_trans,fectr";
	} else {
		$query = "SELECT * FROM detunilevel WHERE status_unilevel='Pendiente' order by organizacion,afiliado,nivel,tipo_trans,fectr";
	}
}
$result = mysql_query($query,$link);
$first = true;
$tot_tit = 0.00;
$tot_pat = 0.00;
$tot_gen = 0.00;
$grupo = 1;
while($row = mysql_fetch_array($result)) {
	if ($first) {
		$organizacion = $row['organizacion'];
		$org_nombres= $row['org_nombres'];
		$first = false;

		echo "<b><u>";
		echo "NIVEL";
		echo '<div class="espacio"></div>';
		echo "AFILIADO";

		echo '<div class="varios"></div>';
		echo '<div class="sangria"></div>';
		echo '<div class="sangria"></div>';
		echo "TRANSACCIÓN";

		echo '<div class="sangria"></div>';
		echo '<div class="sangria"></div>';
		echo '<div class="sangria"></div>';
		echo '<div class="sangria"></div>';
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo "FECHA";
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo '<div class="sangria"></div>';
		echo "MONTO";
		echo '<div class="caracter"></div>';
		echo '<div class="sangria"></div>';
		echo "PORC.";
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo "COMISIÓN";
		echo "</u></b><br>";

		$txt = '<div class="grupo1">';
		$txt .= "<b>Organización de: ".$organizacion." - ".$org_nombres."</b><br>";
		$tot_pat = 0.00;
		$tot_gen = 0.00;
	}
	if ($organizacion<>$row['organizacion']) {
		$txt .= '<div style="text-align:right;padding-right:8%;">'.str_repeat('=', 20)."</div>";
		$txt .= '<div style="text-align:right;padding-right:8%;"><b>Total organización de '.$organizacion." - ".trim($org_nombres).': '.trim(number_format($tot_pat,2,',','.'))."</b></div>";
		$txt .= "</div>";
		echo $txt;
		$organizacion = $row['organizacion'];
		$org_nombres = $row['org_nombres'];
		if ($grupo==1) {
			$txt = '<div class="grupo2">';
			$grupo = 2;
		} else {
			$txt = '<div class="grupo1">';
			$grupo = 1;
		}
		$txt .= "<b>Organización de : ".$organizacion." - ".$org_nombres."</b><br>";
		$tot_pat = 0.00;
	}
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
	$txt .= $nivel;

	$txt .= '<div class="sangria"></div>';
	$txt .= '<div class="nombre">'.$afiliado." ".$afil_nombres.'</div>';

	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="nombre_trans">'.$nombre_trans.'</div>';

	$txt .= '<div class="caracter"></div>';
	$txt .= substr($fectr,8,2).'/'.substr($fectr,5,2).'/'.substr($fectr,0,4);

	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($monto,2,',','.')).'</div>';

	$txt .= '<div class="sangria"></div>';
	$txt .= '<div class="sangria" style="text-align:right;">'.number_format($porcentaje,0,',','.')."%".'</div>';

	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($comision,2,',','.')).'</div>'."<br>";
	$tot_pat += $comision;
	$tot_gen += $comision;
}
$txt .= '<div style="text-align:right;padding-right:8%;">'.str_repeat('=', 20)."</div>";
$txt .= '<div style="text-align:right;padding-right:8%;"><b>Total oganización de '.$organizacion." - ".trim($org_nombres).': '.trim(number_format($tot_pat,2,',','.'))."</b></div>";
$txt .= '</div>';
$txt .= '<div style="text-align:right;padding-right:8%;">'.str_repeat('=', 20)."</div>";
$txt .= '<div style="text-align:right;padding-right:8%;"><b>TOTAL GENERAL: '.trim(number_format($tot_gen,2,',','.'))."</b></div>";
echo $txt;

include_once("pie.php");
?>
