<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "precios";
include_once("menu.php");
?>
		<div id="menu">
			<table border="0" align="center" width="100%" style="background-color:#F5F6CE">
				<tr>
					<td align="center" width="15%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
 							<?php if ($men2=="kits"): ?>
								Precios KIT
							<?php else: ?>
								<a href="precioskit.php">Precios KIT</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="15%" style="padding-left:1%;padding-right:1%;">
						<font face="arial" size="2">
							<?php if ($men2=="productos"): ?>
								Precios Productos
							<?php else: ?>
								<a href="preciospro.php">Precios Productos</a>
							<?php endif; ?>
						</font>
					</td>
					<td align="center" width="70%" style="padding-left:1%;padding-right:1%;">
					</td>
				</tr>
			</table>
		</div>
