<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "opciones";
include_once("menu.php");
?>
		<div id="menu">
			<table border="0" align="center" width="100%" style="background-color:#F5F6CE">
				<tr>
					<td align="center" width="20%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
 							<?php if ($men2=="parametros"): ?>
								Parámetros de la empresa
							<?php else: ?>
								<a href="parametros.php">Parámetros de la empresa</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="20%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
 							<?php if ($men2=="bonosuni"): ?>
								Bonos unilevel
							<?php else: ?>
								<a href="bonosuni.php">Bonos unilevel</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="20%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
 							<?php if ($men2=="eventos"): ?>
								Eventos para el calendario
							<?php else: ?>
								<a href="eventos.php">Eventos para el calendario</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="20%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
 							<?php if ($men2=="materiales"): ?>
								Materiales para descargar
							<?php else: ?>
								<a href="materiales.php">Materiales para descargar</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="20%" style="padding-left:1%;padding-right:1%;">
					</td>
				</tr>
			</table>
		</div>
