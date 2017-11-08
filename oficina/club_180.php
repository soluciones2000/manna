<?php 
include_once("conexion.php");
$codigo = isset($_GET['c']) ? $_GET['c'] : '';
?>
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<html>
<head> 
</head>
<body>
	<h3><?php echo $_SESSION["user"]; ?>:</h3>
	<p>Actualmente tienes acumulados para el club 180 la cantidad de: <b>
	<?php 
		$query = "SELECT sum(puntos) as pts_acum from det_180 WHERE afiliado='".$codigo."' and status_180='Pendiente'";
		$result = mysql_query($query,$link);
		$row = mysql_fetch_array($result);
		$puntos = $row["pts_acum"];
		echo number_format($puntos,2,',','.');
	?>
	 Puntos.</b></p>
	<p>Puede Solicitar el canje y se generará una nota de crédito para consumos en su billetera.</p>
	<form method="post" action="canje.php">
		<INPUT type="hidden" name="codigo" value="<?php echo $_SESSION["codigo"]; ?>">
		<INPUT type="hidden" name="puntos" value="<?php echo $puntos; ?>">
		<INPUT type="submit" value="Solicitud de canje">
		<!-- <button>Canjearlos</button>		 -->
	</form>
	<h4>Detalle:</h4>
	<table>
		<tr>
			<th width="80px">Número</th>
			<th width="150px">Detalle</th>
			<th width="50px">Fecha</th>
			<th width="60px" align="right">Puntos</th>
		</tr>
		<?php 
			$query = "SELECT * from det_180 WHERE afiliado='".$codigo."' and status_180='Pendiente' order by fectr,id_trans_origen";
			if ($result = mysql_query($query,$link)) {
				while ($row = mysql_fetch_array($result)) {
					$afiliado = $row["afiliado"];
					$afil_nombres = $row["afil_nombres"];
					$fectr = substr($row["fectr"],8,2).'/'.substr($row["fectr"],5,2).'/'.substr($row["fectr"],0,4);
					$tipo_trans = $row["tipo_trans"];
					$nombre_trans = $row["nombre_trans"];
					$id_trans_origen = $row["id_trans_origen"];
					$puntos = $row["puntos"];
					echo '<tr>';
						echo '<td align="center">'.$id_trans_origen.'</td>';
						echo '<td>'.$nombre_trans.'</td>';
						echo '<td>'.$fectr.'</td>';
						echo '<td align="right">'.number_format($puntos,2,',','.').'</td>';
					echo '</tr>';
				}
			} else {
				echo '<tr>';
					echo '<td colspan="4">No hay detalles para mostrar</td>';
				echo '</tr>';
			}
		?>
	</table>
</body>
</html>