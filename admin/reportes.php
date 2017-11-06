<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "reportes";
include_once("menu.php");
?>
		<div id="menu">
			<table border="0" align="center" width="100%" style="background-color:#F5F6CE">
				<tr>
					<td align="center" width="14.28%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
 							<?php if ($men2=="resumen"): ?>
								Resumen de comisiones
							<?php else: ?>
								<a href="resumenbonos.php">Resumen de comisiones</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="14.28%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
							<?php if ($men2=="detalle"): ?>
								Bonos de patrocinio
							<?php else: ?>
								<a href="periodo2.php">Bonos de patrocinio</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="14.28%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
							<?php if ($men2=="unilevel"): ?>
								Bonos Unilevel
							<?php else: ?>
								<a href="periodo5.php">Bonos Unilevel</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="14.28%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
							<?php if ($men2=="planilla"): ?>
								Impresión de planilla
							<?php else: ?>
								<a href="codigo.php">Impresión de planilla</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="14.28%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
							<?php if ($men2=="datos"): ?>
								Datos básicos
							<?php else: ?>
								<a href="rango.php">Datos básicos</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="14.28%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
							<?php if ($men2=="cliente"): ?>
								Clientes preferenciales
							<?php else: ?>
								<a href="rango2.php">Clientes preferenciales</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="14.28%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
							<?php if ($men2=="fecha"): ?>
								Transacciones por fecha
							<?php else: ?>
								<a href="fecha.php">Transacciones por fecha</a>
							<?php endif; ?>
						</font>
					</td>
				</tr>
			</table>
		</div>
