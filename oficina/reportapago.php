
	<!-- CSS Files -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
	
	

	<!-- CSS -->
	<link href="assets/css/allneat.css" rel="stylesheet" />



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
		dateFormat: 'dd-M-yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['es']);
	$.datepicker.setDefaults({
	  showOn: "both"
	});
});

$(document).ready(function() {
   $("#datepicker").datepicker();
});
</script>

<?php 
include_once("conexion.php");

$navegador = getBrowser($_SERVER['HTTP_USER_AGENT']);

$codigo = isset($_GET['c']) ? $_GET['c'] : '';

echo '<table border="0" align="center" width="100%" height="10%">';
	echo '<tr>';
		echo '<td valign="top" align="center" colspan="3">';
			echo '<div style="vertical-align:top;">';
				echo '<h3 align="center">Reportar Pago</h3>';
				$query = "select * from afiliados where tit_codigo='".$_SESSION["codigo"]."'";
				$result = mysql_query($query,$link);
				if ($row = mysql_fetch_array($result)) {
					$nombre = trim($row["tit_nombres"]).' '.trim($row["tit_apellidos"]);
				}
				echo '<div>';
					echo '<form name="pago" method="post" action="guardapago.php">';
						echo '<table border=0 width="50%" height="10%">';
							echo '<tr>';
								echo '<td>Nombre depositante:</td>';
								echo '<td><INPUT type="text" name="nombre" value="'.$nombre.'" maxlength="150" size="50" class="form-control" placeholder="Nombre Depositante..." readonly></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td>Fecha del pago:</td>';
								// if ($navegador=='Mozilla Firefox') {
									// echo '<td><INPUT type="text" name="fecha" value="'.date('Y-m-d').'" readonly><br></td>';
								// } else {
									echo '<td><input type="date" name="fecha" id="datepicker" size="10" required title="Introduzca la fecha del pago" value="'.date('Y-m-d').'" /></td>';
								// }
							echo '</tr>';
							echo '<tr>';
								echo '<td>Número del comprobante:</td>';
								echo '<td><INPUT type="text" name="documento" maxlength="20" size="20" pattern="[0-9]{0,20}" title="Introduzca el número de comprobante (sólo números)" class="form-control" placeholder="Numero del Comprobante..." required></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td>Banco de origen:</td>';
								echo '<td><INPUT type="text" name="bancoorigen" maxlength="150" size="50" class="form-control" placeholder="Banco de Origen..." title="Introduzca el nombre del banco de origen"></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td>Monto del pago:</td>';
								echo '<td><INPUT type="currency" name="monto" maxlength="20" size="20" pattern="\d+(.\d{2})?" title="Introduzca el monto usando el punto (.) como separador decimal" style="text-align:right" class="form-control" placeholder="Monto del Pago..." required></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td>Número de orden:</td>';
								echo '<td><INPUT type="text" name="orden_id" maxlength="20" size="20"  pattern="[0-9]{0,20}" title="Introduzca el número de la orden que está cancelando (sólo números)" style="text-align:right" class="form-control" placeholder="Numero de Orden..."></td>';
							echo '</tr>';
						echo '</table>';
						echo '<br>';
						echo '<INPUT type="submit" value="Enviar" class="btn btn-primary btn-block">';
					echo '</form>';
				echo '</div>';
				echo '<br>';
			echo '</div>';
		echo '</td>';
	echo '</tr>';
echo '</table>';
