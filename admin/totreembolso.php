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
echo '<div id="cuerpo">';
	echo '<div style="padding-left:15%">';
		echo '<h3>CONFIRMAR BONOS DE REEMBOLSO A PAGAR<br>';
	echo '</div>';

$tot_general = 0.00;
echo '<form name="gestion" method="post" action="registroreembolsogeneral.php">';
foreach ($_POST as $key => $value) {

	$query = "SELECT afiliado, sum(monto) as reembolso FROM reembolso where afiliado='".trim($key)."' and status_comision='Pendiente' group by afiliado order by afiliado";

	$result = mysql_query($query,$link);

	$row = mysql_fetch_array($result);
	$afiliado = $row['afiliado'];
	$afil_nombres = nombres($row['afiliado'],$link);
	$reembolso = $row['reembolso'];

	echo '<input type="hidden" name="'.trim($key).'" value="'.trim($reembolso).'">';
	$tot_general += $reembolso;

	echo '<div class="sangria"></div>';
	echo '<div class="nombre">'.codigoynombres($afiliado,$link).'</div>';

	echo '<div class="sangria"></div>';
	echo '<div class="detalle" style="text-align:right;">'.trim(number_format($reembolso,2,',','.')).'</div><br>';

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
