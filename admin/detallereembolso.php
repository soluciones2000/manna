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
		echo '<h3>BONOS DE REEMBOLSO POR CONSUMO<br>';
		echo 'Desde el código: <font color="red">'.trim($dsd).'</font> hasta el código: <font color="red">'.trim($hst).'</font></h3>';
	echo '</div>';

if ($dsd<>'Primero') {
	if ($hst<>'Último') {
		$query = "SELECT reembolso.*,transacciones.tipo,transacciones.monto as monto_original FROM reembolso left outer join transacciones on reembolso.trans_id=transacciones.id WHERE reembolso.afiliado>='".trim($dsd)."' AND reembolso.afiliado<='".trim($hst)."' AND reembolso.status_comision='Pendiente' order by reembolso.afiliado,reembolso.fecha,transacciones.tipo";
	} else {
		$query = "SELECT reembolso.*,transacciones.tipo,transacciones.monto as monto_original FROM reembolso left outer join transacciones on reembolso.trans_id=transacciones.id WHERE reembolso.afiliado>='".trim($dsd)."' AND reembolso.status_comision='Pendiente' order by reembolso.afiliado,reembolso.fecha,transacciones.tipo";
	}
} else {
	if ($hst<>'Último') {
		$query = "SELECT reembolso.*,transacciones.tipo,transacciones.monto as monto_original FROM reembolso left outer join transacciones on reembolso.trans_id=transacciones.id WHERE reembolso.afiliado<='".trim($hst)."' AND reembolso.status_comision='Pendiente' order by reembolso.afiliado,reembolso.fecha,transacciones.tipo";
	} else {
		$query = "SELECT reembolso.*,transacciones.tipo,transacciones.monto as monto_original FROM reembolso left outer join transacciones on reembolso.trans_id=transacciones.id WHERE reembolso.status_comision='Pendiente' order by reembolso.afiliado,reembolso.fecha,transacciones.tipo";
	}
}

$result = mysql_query($query,$link);
$grupo = 1;
echo "<b><u>";
echo '<div class="sangria"></div>';
echo '<div class="caracter"></div>';
echo "FECHA";

echo '<div class="sangria"></div>';
echo '<div class="sangria"></div>';
echo "# TRANSACCIÓN";

echo '<div class="sangria"></div>';
echo "TIPO DE OPERACIÓN";

echo '<div class="sangria"></div>';
echo '<div class="sangria"></div>';
echo '<div class="sangria"></div>';
echo '<div class="sangria"></div>';
echo '<div class="caracter"></div>';
echo '<div class="caracter"></div>';
echo "MONTO";

echo '<div class="caracter"></div>';
echo '<div class="caracter"></div>';
echo '<div class="caracter"></div>';
echo '<div class="caracter"></div>';
echo '<div class="caracter"></div>';
echo "COMISION";
echo "</u></b><br>";

$first = true;
$tot_gen = 0.00;
$tot_afi = 0.00;
while($row = mysql_fetch_array($result)) {
	if ($first) {
		$afiliado = $row['afiliado'];
		$quer2 = "SELECT tit_nombres,tit_apellidos FROM afiliados WHERE tit_codigo='".$afiliado."'";
		$resul2 = mysql_query($quer2,$link);
		$ro2 = mysql_fetch_array($resul2);
		$nombre = trim($ro2['tit_nombres']).' '.trim($ro2['tit_apellidos']);
		echo '<u>Afiliado: '.$afiliado.' - '.$nombre.'</u><br>';
		$first = false;
	}
	if ($afiliado<>$row['afiliado']) {
		echo '<div style="text-align:right;padding-right:28%;">'.str_repeat('-', 20)."</div>";
		echo '<div style="text-align:right;padding-right:28%;"><b>Total Afiliado '.$afiliado.' - '.$nombre.': '.number_format($tot_afi,2,',','.')."</b></div>";
		echo '<br>';
		$tot_afi = 0.00;
		$afiliado = $row['afiliado'];
		$quer2 = "SELECT tit_nombres,tit_apellidos FROM afiliados WHERE tit_codigo='".$afiliado."'";
		$resul2 = mysql_query($quer2,$link);
		$ro2 = mysql_fetch_array($resul2);
		$nombre = trim($ro2['tit_nombres']).' '.trim($ro2['tit_apellidos']);
		echo '<u>Afiliado: '.$afiliado.' - '.$nombre.'</u><br>';
	}
	$fecha = $row['fecha'];
	$monto = $row['monto'];
	$monto_original = $row['monto_original'];
	$trans_id= $row['trans_id'];
	$tipo = $row['tipo'];

	echo '<div class="sangria"></div>';
	echo '<div class="espacio">'.substr($fecha,8,2).'/'.substr($fecha,5,2).'/'.substr($fecha,0,4).'</div>';

	echo '<div class="sangria"></div>';
	echo '<div class="espacio" style="text-align:right;">'.number_format($trans_id,0,',','.').'</div>';

	echo '<div class="sangria"></div>';
	echo '<div class="sangria"></div>';
	switch ($tipo) {
		case '04':
			$nombre_trans = 'Consumo aliados';
			break;
		case '14':
			$nombre_trans = 'Consumo cliente';
			break;
		case '24':
			$nombre_trans = 'Consumo cliente preferencial';
			break;
		default:
			$nombre_trans = 'No identificada';
			break;
	}
	echo '<div class="nombre_trans">'.$nombre_trans.'</div>';

	echo '<div class="caracter"></div>';
	echo '<div class="detalle" style="text-align:right;">'.number_format($monto_original,2,',','.').'</div>';

	echo '<div class="sangria"></div>';
	echo '<div class="detalle" style="text-align:right;">'.number_format($monto,2,',','.').'</div>'."<br>";
	$tot_afi += $monto;
	$tot_gen += $monto;
}
echo '<div style="text-align:right;padding-right:28%;">'.str_repeat('-', 20)."</div>";
echo '<div style="text-align:right;padding-right:28%;"><b>Total Afiliado '.$afiliado.' - '.$nombre.': '.': '.number_format($tot_afi,2,',','.')."</b></div>";
echo '<br>';
echo '<div style="text-align:right;padding-right:28%;">'.str_repeat('=', 20)."</div>";
echo '<div style="text-align:right;padding-right:28%;"><b>TOTAL GENERAL: '.number_format($tot_gen,2,',','.')."</b></div>";
echo '<br>';
?>
