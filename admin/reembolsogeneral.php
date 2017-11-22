<?php 
include_once("conexion.php");
include_once("funciones.php");
include_once("cabecera.php");
$menu = "pagos";
include_once("menu.php");
$men2 = "totuni";
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
//$mes = isset($_POST['mes']) ? $_POST['mes'] : null;
//$ano = isset($_POST['ano']) ? $_POST['ano'] : null;
echo '<div id="cuerpo">';
	echo '<div style="text-align:center">';
		echo '<h3>BONOS DE REEMBOLSO POR CONSUMO TOTALES POR PAGAR<br>';
	echo '</div>';

$query = "SELECT afiliado, sum(monto) as reembolso FROM reembolso where status_comision='Pendiente' group by afiliado order by afiliado";
$result = mysql_query($query,$link);
$first = true;
$tot_ree = 0.00;
$tot_gen = 0.00;
$grupo = 1;
echo '<form name="gestion" method="post" action="totreembolso.php">';
while($row = mysql_fetch_array($result)) {
	if ($first) {
		$afiliado = $row['afiliado'];
		$afil_nombres = nombres($row["afiliado"],$link);
		$first = false;

		echo "<b><u>";
		echo '<div class="sangria"></div>';
		echo "AFILIADO";
		echo '<div class="espacio"></div>';
		echo '<div class="espacio"></div>';
		echo '<div class="espacio"></div>';
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo "COMISIÓN";
		echo "</u></b><br>";

		$tot_ree = 0.00;
		$tot_gen = 0.00;
	}
	if ($afiliado<>$row['afiliado']) {
		if ($grupo==1) {
			$txt = '<div class="grupo1">';
			$grupo = 2;
		} else {
			$txt = '<div class="grupo2">';
			$grupo = 1;
		}

		$txt .= '<div class="sangria"></div>';
		$txt .= '<div class="nombre">'.$afiliado." ".$afil_nombres.'</div>';

		$txt .= '<div class="sangria"></div>';
		$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($tot_ree,2,',','.')).'</div>';

		$txt .= '<div class="sangria"></div>';
		$txt .= '<div class="detalle" style="text-align:right;">'.'<input type="checkbox" name="'.$afiliado.'"/> Pagar</div>'."<br>";

		$txt .= "</div>";
		echo $txt;
		$afiliado = $row['afiliado'];
		$afil_nombres = nombres($row["afiliado"],$link);
		$tot_ree = 0.00;
	}
	$comision = $row['reembolso'];

	$tot_ree += $comision;
	$tot_gen += $comision;
}

if ($grupo==1) {
	$txt = '<div class="grupo1">';
	$grupo = 2;
} else {
	$txt = '<div class="grupo2">';
	$grupo = 1;
}

$txt .= '<div class="sangria"></div>';
$txt .= '<div class="nombre">'.$afiliado." ".$afil_nombres.'</div>';

$txt .= '<div class="sangria"></div>';
$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($tot_ree,2,',','.')).'</div>';

$txt .= '<div class="sangria"></div>';
$txt .= '<div class="detalle" style="text-align:right;">'.'<input type="checkbox" name="'.$afiliado.'"/> Pagar</div>'."<br>";
$txt .= "</div><br>";

//$txt .= '<div style="text-align:right;padding-right:55%;">'.str_repeat('=', 20)."</div>";
//$txt .= '<div style="text-align:right;padding-right:55%;"><b>TOTAL GENERAL: '.trim(number_format($tot_gen,2,',','.'))."</b></div>";
echo $txt;

echo '<div align="center">';
	echo '<input type="submit" value="Totalizar">';
echo '</div>';
 
include_once("pie.php");
?>
