		<div id="menu">
			<table border="0" align="center" width="100%" style="background-color:#A9F5A9">
				<tr>
					<td align="center" width="20%" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
 							<?php if ($menu=="login"): ?>
								Acceder al sistema
							<?php else: ?>
								<a href="index.php">Acceder al sistema</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="20%" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
							<?php if ($menu=="transac"): ?>
								Transacciones del día
							<?php else: ?>
								<a href="fecha.php">Transacciones del día</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="20%" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
							<?php if ($menu=="bonos"): ?>
								Calcular Bonos
							<?php else: ?>
								<a href="periodo.php">Calcular Bonos</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="20%" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
							<?php if ($menu=="precios"): ?>
								Actualizar precios
							<?php else: ?>
								<a href="precios.php">Actualizar precios</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="20%" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
							<?php if ($menu=="certif"): ?>
								Reimprimir certificados
							<?php else: ?>
								<a href="certif.php">Reimprimir certificados</a>
							<?php endif; ?>
						</font>
					</td>
				</tr>
			</table>
		</div>
