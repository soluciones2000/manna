		<div id="menu">
			<table border="0" align="left" width="14%" style="background-color:#A9F5A9">
				<tr>
					<td align="center" width="12.5%" height="30px" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
							<?php if ($menu=="reportes"): ?>
								Reportes
								<div id="menu">
									<table border="0" align="left" width="100%" style="background-color:#F5F6CE">
										<tr>
											<td align="center" width="20%" height="30px" style="padding-left:1%;padding-right:1%;">
												<font face="arial">
						 							<?php if ($men2=="resumen"): ?>
														Resumen de comisiones
													<?php else: ?>
														<a href="periodo1.php">Resumen de comisiones</a>
													<?php endif; ?>
												</font>
											</td>
										</tr>
										<tr>
											<td align="center" width="20%" height="30px" style="padding-left:1%;padding-right:1%;">
												<font face="arial">
													<?php if ($men2=="detalle"): ?>
														Detalle de comisiones
													<?php else: ?>
														<a href="periodo2.php">Detalle de comisiones</a>
													<?php endif; ?>
												</font>
											</td>
										</tr>
										<tr>
											<td align="center" width="20%" height="30px" style="padding-left:1%;padding-right:1%;">
												<font face="arial">
													<?php if ($men2=="planilla"): ?>
														Impresión de planilla
													<?php else: ?>
														<a href="codigo.php">Impresión de planilla</a>
													<?php endif; ?>
												</font>
											</td>
										</tr>
										<tr>
											<td align="center" width="20%" height="30px" style="padding-left:1%;padding-right:1%;">
												<font face="arial">
													<?php if ($men2=="datos"): ?>
														Listado de datos básicos
													<?php else: ?>
														<a href="rango.php">Listado de datos básicos</a>
													<?php endif; ?>
												</font>
											</td>
										</tr>
										<tr>
											<td align="center" width="20%" height="30px" style="padding-left:1%;padding-right:1%;">
												<font face="arial">
													<?php if ($men2=="cliente"): ?>
														Listado de clientes preferenciales
													<?php else: ?>
														<a href="rango2.php">Listado de clientes preferenciales</a>
													<?php endif; ?>
												</font>
											</td>
										</tr>
										<tr>
											<td align="center" width="20%" height="30px" style="padding-left:1%;padding-right:1%;">
												<font face="arial">
													<?php if ($men2=="fecha"): ?>
														Lista de transacciones<br>por fecha
													<?php else: ?>
														<a href="fecha.php">Lista de transacciones<br>por fecha</a>
													<?php endif; ?>
												</font>
											</td>
										</tr>
									</table>
								</div>
							<?php else: ?>
								<a href="reportes.php">Reportes</a>
							<?php endif; ?>
						</font>
					</td>
				</tr>
				<tr>
					<td align="center" width="12.5%" height="30px" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
							<?php if ($menu=="precios"): ?>
								Actualizar precios
							<?php else: ?>
								<a href="precios.php">Actualizar precios</a>
							<?php endif; ?>
						</font>
					</td>
				</tr>
				<tr>
					<td align="center" width="12.5%" height="30px" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
							<?php if ($menu=="upgrade"): ?>
								Aprobar upgrades
							<?php else: ?>
								<a href="upgrades.php">Aprobar upgrades</a>
							<?php endif; ?>
						</font>
					</td>
				</tr>
				<tr>
					<td align="center" width="12.5%" height="30px" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
							<?php if ($menu=="certif"): ?>
								Reimprimir certificados
							<?php else: ?>
								<a href="certif.php">Reimprimir certificados</a>
							<?php endif; ?>
						</font>
					</td>
				</tr>
				<tr>
					<td align="center" width="12.5%" height="30px" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
 							<?php if ($menu=="inactivar"): ?>
								Activar/Inactivar códigos
							<?php else: ?>
								<a href="inactivarcodigo.php">Activar/Inactivar códigos</a>
							<?php endif; ?>
						</font>
					</td>
				</tr>
				<tr>
					<td align="center" width="12.5%" height="30px" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
 							<?php if ($menu=="ordenes"): ?>
								Gestionar órdenes
							<?php else: ?>
								<a href="ordenes.php">Gestionar órdenes</a>
							<?php endif; ?>
						</font>
					</td>
				</tr>
				<tr>
					<td align="center" width="12.5%" height="30px" style="padding-left:1%;padding-right:1%;">
						<font face="arial">
							<?php if ($menu=="transac"): ?>
								Cierre mensual
							<?php else: ?>
								<a href="#">Cierre mensual</a>
							<?php endif; ?>
						</font>
					</td>
				</tr>
				<tr>
					<td align="center" width="12.5%" height="30px" style="padding-left:1%;padding-right:1%;">
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
