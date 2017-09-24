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
</head>
<body>
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
					<?php if ($codigo<>''): ?>
						<img SRC=<?php echo "photos/".trim($codigo).".jpg" ?> width="30%" height="30%">
					<?php endif; ?>
				</td>
			</tr>
		</table>
