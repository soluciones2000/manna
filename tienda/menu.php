<!--
<script type="text/javascript">
	function cambiaorden(codigo,cantidad){
		alert(codigo);
		var x = '<?php echo $_SESSION["orden"]; ?>';
//		cantidad++;
//		document.getElementById("verorden").innerHTML = "valor"+"("+cantidad+")";
		alert(x+"-"+cantidad);
	} 
</script>
-->
		<table border="0" align="center" width="100%" height="10%">
			<tr>
				<td width="20%">
					<font face="arial">
						<?php if ($ant=="pago"): ?>
							<a href="logincliente.php?ruta=pago" id="anterior">Reportar pago</a>
							<br>
							<a href="logincliente.php?ruta=tracking" id="tracking">Seguimiento de órdenes</a>
						<?php endif ?>
						<?php if ($ant=="catalogo"): ?>
							<a href="inicio.php" id="anterior">Volver al Catálogo</a>
						<?php endif ?>
						<?php if ($ant=="orden"): ?>
							<a href="#" id="anterior">Ver orden</a>
						<?php endif ?>
					</font>
				</td>
				<td align="center" width="60%">
					<?php
						if ($bnr) {
							$query = "SELECT * FROM banners where activa='1'";
							$result = mysql_query($query,$link);
							while ($row = mysql_fetch_array($result)) {
								if ($row["orden"]) {
									echo '<a href="agrega.php?prd='.$row["id_pro"].'">';
										echo '<img SRC="banners/'.trim($row["banner"]).'" width="60%" height="5%" alt="Agregar a la orden" title="Agregar a la orden">';
									echo '</a>';
								} else {
									echo '<img SRC="banners/'.trim($row["banner"]).'" width="60%" height="5%">';
								}
							}
						} else {
							if ($titulo<>'') {
								echo '<h3>'.trim($titulo).'</h3>';
							}
						}
					?>
				</td>
				<td align="right" valign="middle" width="20%" style="padding-right:2%">
					<font face="arial">
<!--						Items en la orden: {{cantidad}}<br>-->
						<?php if ($des=="orden"): ?>
							Items en la orden: <?php echo $_SESSION["cantidad"]; ?><br>
							<?php if ($_SESSION["cantidad"]<>0): ?>
								<a href="orden.php" id="siguiente">Ver orden</a>
							<?php endif ?>
						<?php endif ?>
						<?php if ($des=="checkout"): ?>
							Items en la orden: <?php echo $_SESSION["cantidad"]; ?><br>
						<?php endif ?>
					</font>
				</td>
			</tr>
