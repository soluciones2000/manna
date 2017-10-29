<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "pagos";
include_once("menu.php");
?>
		<div id="menu">
			<table border="0" align="center" width="100%" style="background-color:#F5F6CE">
				<tr>
					<td align="center" width="15%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
 							<?php if ($men2=="resumen"): ?>
								Pagos totales del período
							<?php else: ?>
								<a href="pagogeneral.php">Pagos totales</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="15%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
							<?php if ($men2=="detalle"): ?>
								Pagos individuales
							<?php else: ?>
								<a href="periodo4.php">Pagos individuales</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="70%" style="padding-left:1%;padding-right:1%;">
					</td>
				</tr>
			</table>
		</div>
