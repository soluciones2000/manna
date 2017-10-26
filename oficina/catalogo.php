<?php 
include_once("conexion.php");
$codigo = isset($_GET['c']) ? $_GET['c'] : '';

echo '<table border="0" align="center" width="100%" height="10%">';
	echo '<tr>';
		echo '<td width="20%">';
		echo '</td>';
		echo '<td align="center" width="60%">';
			echo '<h3>CATÁLOGO</h3>';
		echo '</td>';
		echo '<td align="right" valign="middle" width="20%" style="padding-right:2%">';
			echo '<font face="arial">';
				echo 'Items en la orden: '.$_SESSION["cantidad"].'<br>';
				if ($_SESSION["cantidad"]<>0) { echo '<a href="verificaorden.php" id="siguiente">Ver orden</a>'; }
			echo '</font>';
		echo '</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td colspan="3">';
			echo '<table border="1" width="100%">';
			$query = "SELECT tipo_persona FROM afiliados where tit_codigo='".$codigo."'";
			$result = mysql_query($query,$link);
			if($row = mysql_fetch_array($result)) {
				$tipo_persona = $row["tipo_persona"];
			} else {
				$tipo_persona = '';
			}

			if ($tipo_persona=='Especialista') {
				$query = "SELECT * FROM productos order by familia,id_pro";
			} else {
				$query = "SELECT * FROM productos where publico<>'Especialista' order by familia,id_pro";
			}
			
			$result = mysql_query($query,$link);
			$contador = 1;
			while($row = mysql_fetch_array($result)) {
				$id_pro = $row["id_pro"];
				$desc_corta = utf8_encode($row["desc_corta"]);
				$desc_pro = trim(utf8_encode($row["desc_pro"]));
				$precio_pro = $row["pvp_dist"];
				$imagen = $row["imagen"];
				if (file_exists('img/'.trim($imagen).'.jpg')) {
					$imagen = 'img/'.trim($imagen).'.jpg';
				} else {
					$imagen = 'img/sin_imagen.jpg';
				}


				if ($contador==1) {
					echo '<tr>';
				}
				echo '<td align="center" width="25%" style="padding:2%">';
					echo  '<img SRC="'.trim($imagen).'" width="150px" height="150px" title="'.$desc_pro.'"><br>';
					echo trim($id_pro).'<br>';
					echo trim($desc_corta).'<br>';
					echo 'Precio Bs. '.number_format($precio_pro,2,',','.').'<br>';
					echo '<a href="agrega.php?prd='.$id_pro.'">Agregar a la orden</a>';
				echo '</td>';
				if ($contador==4) {
					echo '</tr>';
					$contador = 0;
				}
				$contador++;
			}
			echo '</table>';
		echo '</td>';
	echo '</tr>';
echo '</table>';
?>
<!--
	<div id="paginas">
		<table border="0" align="center" width="100%">
			<tr>
				<td style="padding-left:2%">
					<font face="arial">
						<a href="#"><<</a>
						<a href="#"> 1</a>
						<a href="#"> >></a>
					</font>
				</td>
			</tr>
		</table>
	</div>
-->