		<div id="menu">
			<table border="0" align="center" width="100%" style="background-color:#A9F5A9">
				<tr>
					<td align="center" width="12.5%" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
							<?php if ($menu=="reportes"): ?>
								Reportes
							<?php else: ?>
								<a href="reportes.php">Reportes</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="12.5%" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
							<?php if ($menu=="precios"): ?>
								Actualizar precios
							<?php else: ?>
								<a href="precios.php">Actualizar precios</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="12.5%" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
							<?php if ($menu=="upgrade"): ?>
								Aprobar upgrades
							<?php else: ?>
								<a href="upgrades.php">Aprobar upgrades</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="12.5%" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
							<?php if ($menu=="certif"): ?>
								Reimprimir certificados
							<?php else: ?>
								<a href="certif.php">Reimprimir certificados</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="12.5%" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
 							<?php if ($menu=="inactivar"): ?>
								Activar/Inactivar códigos
							<?php else: ?>
								<a href="inactivarcodigo.php">Activar/Inactivar códigos</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="12.5%" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
 							<?php if ($menu=="ordenes"): ?>
								Gestionar órdenes
							<?php else: ?>
								<a href="ordenes.php">Gestionar órdenes</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="12.5%" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
							<?php if ($menu=="transac"): ?>
								Cierre mensual
							<?php else: ?>
								<a href="#">Cierre mensual</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="12.5%" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
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
