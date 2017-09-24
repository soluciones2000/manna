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
    width: 2%;
	display: inline-block;	
}
.codigo {
    width: 5%;
	display: inline-block;	
}
.detalle {
    width: 9%;
	display: inline-block;	
}
.monto {
    width: 9%;
	display: inline-block;	
	padding-right: 1%;
}
.tipo_af {
    width: 5%;
	display: inline-block;	
}
.varios {
    width: 20%;
	display: inline-block;	
	padding-left: 2%;
}
.nombre {
    width: 35%;
	display: inline-block;	
}
.nivel {
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
switch (substr($_POST['fecha'],3,3)) {
	case 'Ene':
		$mes = '01';
		break;
	case 'Feb':
		$mes = '02';
		break;
	case 'Mar':
		$mes = '03';
		break;
	case 'Abr':
		$mes = '04';
		break;
	case 'May':
		$mes = '05';
		break;
	case 'Jun':
		$mes = '06';
		break;
	case 'Jul':
		$mes = '07';
		break;
	case 'Ago':
		$mes = '08';
		break;
	case 'Sep':
		$mes = '09';
		break;
	case 'Oct':
		$mes = '10';
		break;
	case 'Nov':
		$mes = '11';
		break;
	case 'Dic':
		$mes = '12';
		break;
}
$fecha = isset($_POST['fecha']) ? substr($_POST['fecha'],7,4).'-'.$mes.'-'.substr($_POST['fecha'],0,2) : date("Y")."-".date("m")."-".sprintf("%'02d",(date("d")-1));
$diatr = substr($_POST['fecha'],0,2).'-'.$mes.'-'.substr($_POST['fecha'],7,4);

$query = "SELECT transacciones.fecha,transacciones.afiliado,afiliados.tit_nombres,afiliados.tit_apellidos,transacciones.tipo,transacciones.precio,transacciones.documento,transacciones.bancoorigen FROM transacciones inner join afiliados on transacciones.afiliado=afiliados.tit_codigo where transacciones.fecha='".$fecha."'";
$result = mysql_query($query,$link);
echo '<div id="cuerpo">';
	echo '<div style="text-align:center">';
		echo '<h3>TRANSACCIONES DEL DÍA: '.$diatr.'</h3>';
	echo '</div>';
	echo '<div class="sangria"></div>';
	echo '<div class="detalle" style="text-align:center;"><u>FECHA</u></div>';
	echo '<div class="nombre" style="text-align:center;"><u>AFILIADO</u></div>';
	echo '<div class="detalle" style="text-align:center;"><u>TIPO</u></div>';
	echo '<div class="monto" style="text-align:right;"><u>MONTO</u></div>';
	echo '<div class="detalle" style="text-align:center;"><u>DOCUMENTO</u></div>';
	echo '<div class="varios" style="text-align:center;"><u>BANCO ORIGEN</u></div>';

	$color = true;
	while($row = mysql_fetch_array($result)) {
		if ($color) {
			echo '<div class="grupo1">';
			$color = false;
		} else {
			echo '<div class="grupo2">';
			$color = true;
		}
	    $fechapago = $row["fecha"];
	    $afiliado = $row["afiliado"];
	    $nombre_completo = trim($row["tit_nombres"])." ".trim($row["tit_apellidos"]);
	    $monto = $row["precio"];
	    $documento = $row["documento"];
	    $bancoorigen = trim($row["bancoorigen"]);
	    switch ($row["tipo"]) {
	    	case '01':
				$tipo = 'Afiliación';
	    		break;
	    	case '02':
				$tipo = 'Upgrade';
	    		break;
	    	case '03':
				$tipo = 'Nota de crédito';
	    		break;
	    	default:
				$tipo = 'No identificada';
	    		break;
	    }
			echo '<div class="sangria"></div>';
			echo '<div class="detalle" style="text-align:center;">'.$fechapago.'</div>';
			echo '<div class="nombre">'.$afiliado.' '.$nombre_completo.'</div>';
			echo '<div class="detalle" style="text-align:center;">'.trim($tipo).'</div>';
			echo '<div class="detalle" style="text-align:right;">'.number_format($monto,2,',','.').'</div>';
			echo '<div class="detalle" style="text-align:center;">'.trim($documento).'</div>';
			echo '<div class="varios" style="text-align:center;">'.trim($bancoorigen).'</div>';
		echo "</div>";
	}
include_once("pie.php");
?>
