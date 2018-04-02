<?php 
echo '<!doctype html>';
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
				$puntos_pro = $row["pts_dist"];
				$aviso = $row["aviso"];
				$fecha_aviso = $row["fecha_aviso"];
				if ($_SESSION["rango"]=="ACI Potencial") {
					if ($_SESSION["iva2"]<>0.00) {
						$precio_pro = $row["pvp_clipref"]/(1+($_SESSION["iva2"]/100));
					} else {
						$precio_pro = $row["pvp_clipref"];
					}
				} else {
					if ($_SESSION["iva2"]<>0.00) {
						$precio_pro = $row["pvp_dist"]/(1+($_SESSION["iva2"]/100));
					} else {
						$precio_pro = $row["pvp_dist"];
					}
				}
				$imagen = $row["imagen"];
				if (file_exists('img/'.trim($imagen).'.jpg')) {
					$imagen = 'img/'.trim($imagen).'.jpg';
				} else {
					$imagen = 'img/sin_imagen.jpg';
				}
				if ($precio_pro>0.00) {
					if ($contador==1) {
						echo '<tr>';
					}
					echo '<td align="center" width="25%" style="padding:2%">';
						echo  '<img SRC="'.trim($imagen).'" width="150px" height="150px" title="'.$desc_pro.'"><br>';
						echo trim($id_pro).'<br>';
						echo trim($desc_corta).'<br>';
						echo 'Precio Bs. '.number_format($precio_pro,2,',','.').'<br>';
						echo 'I.V.A. '.number_format($precio_pro*($_SESSION["iva1"]/100),2,',','.').'<br>';
						echo 'Total Bs. '.number_format($precio_pro*(1+($_SESSION["iva1"]/100)),2,',','.').'<br>';
						echo 'Puntos Manna: '.trim(number_format($puntos_pro,0,',','.')).'<br>';
						if ($aviso and $fecha_aviso>date("Y-m-d")) {
							settype($fecha_aviso,"string");
							settype($id_pro,"string");
							echo '<a id="'.$fecha_aviso.'*-*'.$id_pro.'" href="" onclick="agregar(this.id)">Agregar a la orden</a>';
						} else {
							echo '<a href="agrega.php?prd='.$id_pro.'">Agregar a la orden</a>';
						}
					echo '</td>';
					if ($contador==4) {
						echo '</tr>';
						$contador = 0;
					}
					$contador++;
				}
			}
			echo '</table>';
		echo '</td>';
	echo '</tr>';
echo '</table>';
echo '<script>
function agregar(idpro) {
	if (confirm("Este producto se despachará el día "+idpro.substr(8,2)+"/"+idpro.substr(5,2)+"/"+idpro.substr(0,4)+". ¿Está usted de acuerdo?")) {
		window.open("agrega.php?prd="+idpro.slice(13),"_self");
		alert("Se agregó el producto a la órden");
	}
}
</script>';
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