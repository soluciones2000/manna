<?php 
$nombre = isset($_SESSION['user']) ? utf8_encode($_SESSION['user']) : '';
$codigo = isset($_SESSION['codigo']) ? $_SESSION['codigo'] : '';
$usuario = $nombre ? true : false;
?>
<!DOCTYPE html>

<html>
<head>
	<title>Corporación MANNA C.A. - Tienda virtual</title>
<!--	<link rel="icon" type="image/png" href="psicoexpresate_ico.png" /> -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>

</head>

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

<body  ng-app="">
	<div id="container">
		<table border="0" align="center" width="100%" height="10%" style="background-color:#0404B4;">
			<tr>
				<td width="20%" align="left" style="padding:0.5%">
					<img SRC="../recursos/img/Manna_peq.png" width="252.5px" height="62.5px">
				</td>
<!--
				<td width="20%" align="left" style="padding:0.5%">
					<font face="tahoma" size="4" color="#FFFFFF">
						CORPORATIVO 5<br>
						Luis Antonio Rodríguez Estrada
					</font>
				</td>
-->
				<td align="center">
					<font face="arial" size="6" color="#FFFFFF">TIENDA VIRTUAL</font>
					<br>
					<font face="arial" size="3" color="#FFFFFF"><?php echo $nombre; ?></font>
				</td>
				<td width="20%" align="right" style="padding:0.5%">
					<?php 
						if ($codigo<>'') {
							if (file_exists("photos/".trim($codigo).".jpg")) {
								echo '<img SRC="photos/'.trim($codigo).'.jpg" width="30%" height="30%">';
							}
						}
					?>
<!--
					<?php if ($codigo<>''): ?>
						<?php if (file_exists("photos/".trim($codigo).".jpg")): ?>
							existe
						<?php else: ?>
							no existe
						<?php endif; ?>
						<img SRC=<?php echo "photos/".trim($codigo).".jpg" ?> width="30%" height="30%">
					<?php endif; ?>
-->
				</td>
			</tr>
		</table>
