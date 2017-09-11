<?php 
include_once("conexion.php");
include_once("cabecera.php");
$id = isset($_GET['id']) ? $_GET['id'] : 0;

?>
<div id="cuerpo">
	<div style="text-align:center">
		<h3>PEDIDOS CON TICKETS DE PROMOCIÓN</h3>
	</div>
	<?php
	$quer1 = "SELECT * FROM tickets where id=".$id;
	$resul1 = mysql_query($quer1,$link);
	$ro1 = mysql_fetch_array($resul1);
	$promo_id = $ro1["promo_id"];
	?>

	<div>
        <form name="orden" method="post" action="orden.php">
        <?php
			echo '<input type="hidden" name="id" value="'.trim($id).'">';
		?>
		<table border="1" align="center" width="40%">
			<tr>
				<th colspan="3">
					PRODUCTOS
				</th>
				<th>
					CANTIDAD
				</th>
			</tr>
				<?php
				$quer2 = "SELECT * FROM kits_promocion where promo_id='".$promo_id."' order by id";
				$resul2 = mysql_query($quer2,$link);
				while($ro2 = mysql_fetch_array($resul2)) {
					$promo_kit = $ro2["promo_kit"];
					$promo_nombre = $ro2["promo_nombre"];
					$promo_precio = $ro2["promo_precio"];
					echo '<tr>';
						echo '<td align="center">'.trim($promo_kit).'</td>';
						echo '<td> '.trim($promo_nombre).'</td>';
						echo '<td align="right">'.number_format($promo_precio,2,',','.').'</td>';
						echo '<td align="center"><INPUT type="number" name="'.trim($promo_kit).'" maxlength="5" size="5" min="0" max="99999" pattern="[0-9]{0-5}" title="Este campo sólo puede tener números" align="right">';
						echo '</td>';
					echo '</tr>';
				}
				?>

		</table>
		<br>
		<table border="0" align="center" width="40%">
			<tr>
				<td>
					<INPUT type="submit" value="Enviar orden">
				</td>
			</tr>
		</table>
		</form>
	</div>
</div> 
<?php
include_once("pie.php");
?>
