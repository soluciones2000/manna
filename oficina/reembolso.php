
	<!-- CSS Files -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
	
	

	<!-- CSS -->
	<link href="assets/css/allneat.css" rel="stylesheet" />

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
		echo '<h3>BONOS DE REEMBOLSO POR CONSUMO<br>';
		echo '<font color="red">'.trim($name_user).'</font></h3>';
	echo '</div>';

$query = "SELECT reembolso.*,transacciones.tipo,transacciones.monto as monto_original FROM reembolso left outer join transacciones on reembolso.trans_id=transacciones.id WHERE reembolso.afiliado>='".trim($dsd)."' AND reembolso.afiliado<='".trim($hst)."' AND reembolso.status_comision='Pendiente' order by reembolso.afiliado,reembolso.fecha,transacciones.tipo";
$result = mysql_query($query,$link);
$first = true;
$tot_gen = 0.00;
$grupo = 1;
echo "<b><u>";
echo '<div class="sangria"></div>';
echo '<div class="caracter"></div>';
echo "FECHA";

echo '<div class="sangria"></div>';
echo "# TRANSACCIÓN";

echo '<div class="sangria"></div>';
echo "TIPO DE OPERACIÓN";

echo '<div class="sangria"></div>';
echo '<div class="sangria"></div>';
echo '<div class="sangria"></div>';
echo '<div class="caracter"></div>';
echo "MONTO";

echo '<div class="sangria"></div>';
echo '<div class="caracter"></div>';
echo "COMISION";
echo "</u></b><br>";

while($row = mysql_fetch_array($result)) {
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
	$tot_gen += $monto;
}
echo '<div style="text-align:right;padding-right:28%;">'.str_repeat('=', 20)."</div>";
echo '<div style="text-align:right;padding-right:28%;"><b>TOTAL GENERAL: '.number_format($tot_gen,2,',','.')."</b></div>";
echo '<br>';
?>
<p align="center"><button class="btn btn-primary btn-block" style="font-family: Helvetica;" onclick="volver('menubonos.php?c=<?php echo $_SESSION["codigo"]; ?>')">Volver</button></p>

<script type="text/javascript">
	function volver(ruta) {
      window.location.replace(ruta);
	}
</script>

