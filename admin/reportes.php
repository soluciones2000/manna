<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "reportes";
include_once("menu.php");
?>
		<div id="menu">
			<table border="0" align="center" width="100%" style="background-color:#F5F6CE">
				<tr>
					<td align="center" width="25%" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
 							<?php if ($men2=="resumen"): ?>
								Resumen de comisiones
							<?php else: ?>
								<a href="periodo1.php">Resumen de comisiones</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="25%" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
							<?php if ($men2=="detalle"): ?>
								Detalle de comisiones
							<?php else: ?>
								<a href="periodo2.php">Detalle de comisiones</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="25%" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
							<?php if ($men2=="planilla"): ?>
								Impresión de planilla
							<?php else: ?>
<!--								<a href="planilla.php">Impresión de planilla</a>-->
								<a href="codigo.php">Impresión de planilla</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="25%" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
							<?php if ($men2=="datos"): ?>
								Listado de datos básicos
							<?php else: ?>
<!--								<a href="datos.php">Listado de datos básicos</a>-->
								<a href="rango.php">Listado de datos básicos</a>
							<?php endif; ?>
						</font>
					</td>
				</tr>
			</table>
		</div>
