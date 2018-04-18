<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
jQuery(function($){
	$.datepicker.regional['es'] = {
		closeText: 'Cerrar',
		prevText: '&#x3c;Ant',
		nextText: 'Sig&#x3e;',
		currentText: 'Hoy',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
		'Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
		dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
		weekHeader: 'Sm',
		dateFormat: 'yy-mm-dd',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['es']);
	$.datepicker.setDefaults({
	  showOn: "both"
	});
});
//		dateFormat: 'dd-M-yy',

$(document).ready(function() {
   $("#datepicker").datepicker();
});
</script>

	<!-- CSS Files -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
	

	<!-- CSS -->
	<link href="assets/css/allneat.css" rel="stylesheet" />

<?php 
include_once("conexion.php");

$navegador = getBrowser($_SERVER['HTTP_USER_AGENT']);
// Mozilla Firefox
// Internet explorer

$codigo = isset($_GET['c']) ? $_GET['c'] : '';
$monto = isset($_GET['mto']) ? $_GET['mto'] : 0.00;

echo '<table border="0" align="center" width="100%" height="10%">';
	echo '<tr>';
		echo '<td valign="top" align="center" colspan="3">';
			echo '<div style="vertical-align:top;">';
				echo '<h3 align="center">Reportar pago</h3>';
				$query = "select * from afiliados where tit_codigo='".$_SESSION["codigo"]."'";
				$result = mysql_query($query,$link);
				if ($row = mysql_fetch_array($result)) {
					$nombre = trim($row["tit_nombres"]).' '.trim($row["tit_apellidos"]);
				}
				echo '<div style="margin: 0% 15%">';
					echo '<form name="pago" method="post" action="guardapago.php">';
//					echo '<form name="pago" method="post">';
						echo '<table border=0>';
							echo '<tr>';
								echo '<td>Número de orden:</td>';
								echo '<td><INPUT type="text" name="orden_id" value="'.$_GET["ord"].'"maxlength="20" size="20" style="text-align:right"><br></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td>Nombre depositante:</td>';
								echo '<td><INPUT type="text" name="nombre" value="'.$nombre.'" maxlength="150" size="50" readonly><br></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td>Fecha del pago:</td>';
								if ($navegador=='Internet explorer') {
									echo '<td><input id="fecha" type="date" name="fecha" id="datepicker" size="10" required title="Introduzca la fecha del pago" value="'.date('Y-m-d').'" /></td>';
								} else {
									echo '<td><input id="fecha" type="date" name="fecha" size="10" required title="Introduzca la fecha del pago" value="'.date('Y-m-d').'" /></td>';
								}
							echo '</tr>';
							echo '<tr>';
								echo '<td>Monto del pago:</td>';
								echo '<td><INPUT id="monto" type="currency" name="monto" value="'.$monto.'"maxlength="20" size="20" pattern="\d+(.\d{2})?" title="Introduzca el monto usando el punto (.) como separador decimal" style="text-align:right" required /><br></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td>Forma de pago:</td>';
								echo '<td>';
									echo '<INPUT id="opcion1" type="radio" name="forma" value="rp" onclick="formapago(this.value);" checked />Depósito o transferencia<br>';
									if ($_SESSION["codigo"]=="00005") {
										echo '<INPUT id="opcion2" type="radio" name="forma" value="tc" onclick="formapago(this.value);" />Pago en línea<br>';
									} else {
										echo '<INPUT id="opcion2" type="radio" name="forma" value="tc" onclick="formapago(this.value);" disabled/>Pago en línea<br>';
								}
									
								echo '<td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td>Número del comprobante:</td>';
								echo '<td><INPUT id="comprobante" type="text" name="documento" maxlength="20" size="20" pattern="[0-9]{0,20}" title="Introduzca el número de comprobante (sólo números)" required /><br></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td>Banco de origen:</td>';
								echo '<td><INPUT id="banco" type="text" name="bancoorigen" maxlength="150" size="50" title="Introduzca el nombre del banco de origen" /><br></td>';
							echo '</tr>';
						echo '</table>';
						echo '<br>';
//						echo '<INPUT id="boton" type="submit" value="Enviar" onclick="abrir_ventana('.$_GET["ord"].')" />';
						echo '<INPUT id="boton" class="btn btn-primary btn-block" type="submit" value="Enviar" />';
					echo '</form>';
				echo '</div>';
				echo '<br>';
			echo '</div>';
		echo '</td>';
	echo '</tr>';
echo '</table>';
echo '
<script>
function formapago(valor) {
	if (valor=="tc") {
		document.getElementById("comprobante").disabled = true;
		document.getElementById("banco").disabled = true;
		document.forms.pago.method = "get";
		var monto;
		monto = document.getElementById("monto").value;
	    var d = new Date();
	    var y = d.getFullYear();
	    var m = d.getMonth()+1;
	    if (m<10) {
	    	m = "0"+m;
	    }    
	    var d = d.getDate();
	    var fch = y+"-"+m+"-"+d;
		document.forms.pago.action = "pagoenlinea2.php?monto="+monto+"&orden_id="+'.$_GET["ord"].'+"&fecha="+fch;
	} else {
		document.getElementById("comprobante").disabled = false;
		document.getElementById("banco").disabled = false;
		document.forms.pago.method = "post";
		document.forms.pago.action = "guardapago.php";
	}
}

function abrir_ventana(orden) {
	if (document.getElementById("opcion2").checked) {
		var monto;
		monto = document.getElementById("monto").value;
	    var d = new Date();
	    var y = d.getFullYear();
	    var m = d.getMonth()+1;
	    if (m<10) {
	    	m = "0"+m;
	    }    
	    var d = d.getDate();
	    var fch = y+"-"+m+"-"+d;
		propiedades="top=50, left=200, width=800, height=600";
		window.open("pagoenlinea2.php?monto="+monto+"&orden_id="+orden+"&fecha="+fch,"_blank",propiedades);
	}
}

</script>
';