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
 							<?php if ($men2=="totpat"): ?>
								Patrocinios Totales
							<?php else: ?>
								<a href="pagogeneral.php">Patrocinios Totales</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="15%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
							<?php if ($men2=="detpat"): ?>
								Patrocinios Detallados
							<?php else: ?>
								<a href="periodo4.php">Patrocinios Detallados</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="15%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
 							<?php if ($men2=="totuni"): ?>
								Unilevel Totales
							<?php else: ?>
								<a href="unilevelgeneral.php">Unilevel Totales</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="15%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
							<?php if ($men2=="detuni"): ?>
								Unilevel Detallado
							<?php else: ?>
								<a href="periodo6.php">Unilevel Detallado</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="15%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
							<?php if ($men2=="todos"): ?>
								Bonos Totales
							<?php else: ?>
								<a href="pagotodos.php">Bonos Totales</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="25%" style="padding-left:1%;padding-right:1%;">
					</td>
				</tr>
			</table>
		</div>
