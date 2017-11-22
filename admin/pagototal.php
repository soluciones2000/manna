<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "pagos";
include_once("menu.php");
$men2 = "resumen";
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
echo '<div id="cuerpo">';
	echo '<div style="padding-left:15%">';
		echo '<h3>CONFIRMAR BONOS TOTALES A PAGAR<br>';
	echo '</div>';

$tot_general = 0.00;
echo '<form name="gestion" method="post" action="registropagototal.php">';
foreach ($_POST as $key => $value) {

	$quer2 = "SELECT tit_nombres,tit_apellidos FROM afiliados where tit_codigo='".trim($key)."'";
	$resul2 = mysql_query($quer2,$link);
	$ro2 = mysql_fetch_array($resul2);
	$nombres = trim($ro2['tit_nombres']).' '.trim($ro2['tit_apellidos']);

	$query = "SELECT patroc_codigo, sum(comision) as patrocinio FROM detbonoafiliacion WHERE patroc_codigo='".trim($key)."' and status_bono='Pendiente' and nivel>0 group by patroc_codigo";
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		$patrocinio = $row['patrocinio'];
	} else {
		$patrocinio = 0.00;
	}
	
	$query = "SELECT organizacion, sum(comision) as unilevel FROM detunilevel where organizacion='".trim($key)."' and status_unilevel='Pendiente'  group by organizacion";
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		$unilevel = $row['unilevel'];
	} else {
		$unilevel = 0.00;
	}
	
	$query = "SELECT afiliado, sum(monto) as reembolso FROM reembolso where afiliado='".trim($key)."' and status_comision='Pendiente'  group by afiliado";
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		$reembolso = $row['reembolso'];
	} else {
		$reembolso = 0.00;
	}

	$tot_comision = $patrocinio+$unilevel+$reembolso;

	echo '<input type="hidden" name="'.trim($key).'" value="'.trim($tot_comision).'">';
	$tot_general += $tot_comision;

	echo '<div class="sangria"></div>';
	echo '<div class="nombre">'.trim($key)." ".trim($nombres).'</div>';

	echo '<div class="sangria"></div>';
	echo '<div class="detalle" style="text-align:right;">'.trim(number_format($tot_comision,2,',','.')).'</div><br>';

}
echo '<div style="text-align:right;padding-right:55%;">'.str_repeat('=', 20)."</div>";
echo '<div style="text-align:right;padding-right:55%;"><b>TOTAL GENERAL: '.trim(number_format($tot_general,2,',','.'))."</b></div>";

echo '<br>';

echo '<div style="padding-left:25%">';
	echo '<input type="submit" value="Confirmar">';
echo '</div>';

/*
$cadena = 'Location: ordenes.php'; 
header($cadena);
*/
?>
