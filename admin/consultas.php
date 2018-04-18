<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "consultas";
include_once("menu.php");
?>
		<div id="menu">
			<table border="0" align="center" width="100%" style="background-color:#F5F6CE">
				<tr>
					<td align="center" width="20%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
 							<?php if ($men2=="ordxafi"): ?>
								Órdenes por afiliado
							<?php else: ?>
								<a href="ordenesporafiliado.php">Órdenes por afiliado</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="20%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
 							<?php if ($men2=="ordenes"): ?>
								Detalle de órdenes
							<?php else: ?>
								<a href="consultaordenes.php">Detalle de órdenes</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="20%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
 							<?php if ($men2=="transacciones"): ?>
								Transacciones por afiliado
							<?php else: ?>
								<a href="consultatransacciones.php">Transacciones por afiliado</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="40%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
							<?php if ($men2==""): ?>
								
							<?php else: ?>
								<a href=""></a>
							<?php endif; ?>
						</font>
					</td>
				</tr>
			</table>
		</div>
