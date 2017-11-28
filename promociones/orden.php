<?php 
include_once("conexion.php");
include_once("cabecera.php");
$id = isset($_POST['id']) ? $_POST['id'] : 0;

?>
<div id="cuerpo">
	<div style="text-align:center">
		<!-- <h3>PEDIDOS CON TICKETS DE PROMOCIÓN</h3> -->
		<h3>PEDIDOS DE PROMOCIÓN</h3>
	</div>
	<?php
	$quer1 = "SELECT * FROM tickets where id=".$id;
	$resul1 = mysql_query($quer1,$link);
	$ro1 = mysql_fetch_array($resul1);
	$promo_id = $ro1["promo_id"];
	$cedula = $ro1['cedula'];
	$codigo = $ro1['codigo'];
	$nombre = $ro1['nombre'];
	$direccion = $ro1['direccion'];
	$telefono = $ro1['telefono'];
	$email = $ro1['email'];

	echo '<div style="text-align:center">';
		if ($codigo<>'') {
				echo '<p><font color="red">Participante: '.trim($codigo).' - '.trim($nombre).' - Cédula de identidad: '.number_format(trim($cedula),0,',','.').'<br>';
		} else {
				echo '<p><font color="red">Participante: '.trim($nombre).' - Cédula de identidad: '.number_format(trim($cedula),0,',','.').'<br>';
		}
		echo 'Dirección: '.trim($direccion).'<br>';
		echo 'Teléfono: '.trim($telefono).' - email: '.trim($email).'</font></p>';
	echo '</div>';
	?>

	<div>
        <form name="orden" method="post" action="regorden.php">
		<table border="1" align="center" width="75%">
			<tr>
				<th colspan="4">PRODUCTOS</th>
				<th>CANTIDAD</th>
				<th>MONTO</th>
			</tr>
				<?php
				$quer1 = "SELECT * FROM tickets where id=".$id;
				$resul1 = mysql_query($quer1,$link);
				$ro1 = mysql_fetch_array($resul1);
				$promo_id = $ro1["promo_id"];

				$quer2 = "SELECT * FROM kits_promocion where promo_id='".$promo_id."' order by id";
				$resul2 = mysql_query($quer2,$link);
				$total = 0.00;
				echo '<input type="hidden" name="id" value="'.$id.'">';
				while($ro2 = mysql_fetch_array($resul2)) {
					$promo_kit = $ro2["promo_kit"];
					$promo_nombre = $ro2["promo_nombre"];
					$promo_precio = $ro2["promo_precio"];
					$promo_puntos = $ro2["promo_puntos"];
					$cantidad = $_POST[trim($promo_kit)];
					if ($cantidad>0) {
						echo '<input type="hidden" name="'.trim($promo_kit).'" value="'.$_POST[trim($promo_kit)].'">';
						$total += $cantidad*$promo_precio;
						echo '<tr>';
							echo '<td align="center">'.trim($promo_kit).'</td>';
							echo '<td> '.trim($promo_nombre).'</td>';
							echo '<td align="right">Bs. '.number_format($promo_precio,2,',','.').'</td>';
							echo '<td align="right">'.number_format($promo_puntos,2,',','.').' PM</td>';
							echo '<td align="right">'.$cantidad.'</td>';
							echo '<td align="right">Bs. '.number_format($cantidad*$promo_precio,2,',','.').'</td>';
						echo '</tr>';
					}
				}
				?>
				<th colspan="5" align="right">TOTAL ORDEN</th>
				<?php
					echo '<th align="right">Bs. '.number_format($total,2,',','.').'</th>';
				?>
		</table>
		<br>
		<table border="0" align="center" width="75%">
			<tr>
				<td align="center">
					<INPUT type="submit" value="Confirmar orden">
				</td>
			</tr>
		</table>
		</form>
	</div>
</div> 
<?php
include_once("pie.php");
?>
