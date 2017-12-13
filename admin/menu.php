		<div id="menu">
			<table border="0" align="center" width="100%" style="background-color:#A9F5A9">
				<tr>
					<td align="center" width="10%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
							<?php if ($menu=="reportes"): ?>
								Reportes
							<?php else: ?>
								<a href="reportes.php">Reportes</a>
							<?php endif; ?>
						</font>
					</td>

					<td align="center" width="10%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
							<?php if ($menu=="pagos"): ?>
								Pago de comisiones
							<?php else: ?>
								<a href="pagos.php">Pago de comisiones</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="10%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
							<?php if ($menu=="parametros"): ?>
								Parámetros del sistema
							<?php else: ?>
								<a href="parametros.php">Parámetros del sistema</a>
							<?php endif; ?>
						</font>
					</td>

					<td align="center" width="10%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
							<?php if ($menu=="precios"): ?>
								Actualizar precios
							<?php else: ?>
								<a href="precios.php">Actualizar precios</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="10%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
							<?php if ($menu=="upgrade"): ?>
								Aprobar upgrades
							<?php else: ?>
								<a href="upgrades.php">Aprobar upgrades</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="10%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
							<?php if ($menu=="certif"): ?>
								Reimprimir certificados
							<?php else: ?>
								<a href="certif.php">Reimprimir certificados</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="10%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
 							<?php if ($menu=="inactivar"): ?>
								Activar/Inactivar códigos
							<?php else: ?>
								<a href="inactivarcodigo.php">Activar/Inactivar códigos</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="10%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
 							<?php if ($menu=="ordenes"): ?>
								Gestionar órdenes
							<?php else: ?>
								<a href="ordenes.php">Gestionar órdenes</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="10%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
							<?php if ($menu=="c180"): ?>
								Canje club 180
							<?php else: ?>
								<a href="club180.php">Canje club 180</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="10%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
 							<?php if ($menu=="login"): ?>
								Sallir del sistema
							<?php else: ?>
								<a href="logout.php">Salir del sistema</a>
							<?php endif; ?>
						</font>
					</td>
				</tr>
			</table>
		</div>
