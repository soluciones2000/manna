<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "pagos";
include_once("menu.php");
$men2 = "todos";
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
		echo '<h3>TOTAL GENERAL DE BONOS POR PAGAR<br>';
	echo '</div>';

$query = "SELECT patroc_codigo as codigo, sum(detbonoafiliacion.comision) as patrocinio,0 as unilevel FROM detbonoafiliacion where status_bono='Pendiente' group by patroc_codigo union SELECT organizacion as codigo, 0 as patrocinio,sum(detunilevel.comision) as unilevel FROM detunilevel where status_unilevel='Pendiente' group by organizacion order by codigo";
$result = mysql_query($query,$link);
$first = true;
$tot_uni = 0.00;
$tot_pat = 0.00;
echo '<form name="gestion" method="post" action="pagototal.php">';
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
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
		echo '<div class="caracter"></div>';
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
		$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($tot_pat+$tot_uni,2,',','.')).'</div>';
		$txt .= '<div class="sangria"></div>';
		$txt .= '<div class="detalle" style="text-align:right;">'.'<input type="checkbox" name="'.$codigo.'"/> Pagar</div>'."<br>";

		$txt .= "</div>";
		echo $txt;
		$codigo = $row['codigo'];
		$quer2 = "SELECT tit_nombres,tit_apellidos FROM afiliados where tit_codigo='".$codigo."'";
		$resul2 = mysql_query($quer2,$link);
		$ro2 = mysql_fetch_array($resul2);
		$nombres = trim($ro2['tit_nombres']).' '.trim($ro2['tit_apellidos']);
		$tot_pat = 0.00;
		$tot_uni = 0.00;
	}
	$codigo = $row['codigo'];
	$patrocinio = $row['patrocinio'];
	$unilevel = $row['unilevel'];

	$tot_pat += $patrocinio;
	$tot_uni += $unilevel;
}

$txt .= '<div class="sangria"></div>';
$txt .= '<div class="nombre">'.$codigo." ".trim($nombres).'</div>';

$txt .= '<div class="sangria"></div>';
$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($tot_pat,2,',','.')).'</div>';
$txt .= '<div class="sangria"></div>';
$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($tot_uni,2,',','.')).'</div>';
$txt .= '<div class="sangria"></div>';
$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($tot_pat+$tot_uni,2,',','.')).'</div>';

$txt .= '<div class="sangria"></div>';
$txt .= '<div class="detalle" style="text-align:right;">'.'<input type="checkbox" name="'.$patroc_codigo.'"/> Pagar</div>'."<br>";
$txt .= "</div><br>";

echo $txt;

echo '<div align="center">';
	echo '<input type="submit" value="Totalizar">';
echo '</div>';
echo '</form>';
 
include_once("pie.php");
?>
