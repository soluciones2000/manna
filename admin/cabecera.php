<?php 
$nombre = isset($_SESSION['user']) ? utf8_encode($_SESSION['user']) : '';
$usuario = $nombre ? true : false;
?>

<!DOCTYPE html>

<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	<title>Corporación MANNA C.A. - Admnistración</title>
<!--	<link rel="icon" type="image/png" href="psicoexpresate_ico.png" /> -->
</head>
<!--<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>


-->
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
<body>
	<div id="container">
		<div id="cabecera">
			<table border="0" align="center" width="100%" height="10%" style="background-color:#D8D8D8">
				<tr>
					<td width="20%" align="left">
						<img SRC="../recursos/img/Manna_peq.png" width="252.5px" height="62.5px">
					</td>
					<td  width="60%" align="center">
						<font face="arial" size="6">
							MÓDULO ADMINISTRATIVO
						</font>
					</td>
					<td width="20%" align="right" style="padding:1%">
						<?php
							if ($usuario) {
								echo '<label id="user">Buen día: '.trim($nombre).'</label>';
							}
						 ?>
					</td>
				</tr>
			</table>
		</div>
