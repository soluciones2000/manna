<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "c180";
include_once("menu.php");
echo '<h3 align="center">Canje de puntos del club 180</h3>';
echo '<form name="c180" method="post" action="confirmacanje.php">';
	echo '<p align="center">';
		echo '<table align="center" border="1">';
			echo '<tr>';
				echo '<th>Código</th>';
				echo '<th>Nombre</th>';
				echo '<th>Puntos</th>';
				echo '<th>Canjear</th>';
			echo '</tr>';
			$query = "SELECT afiliado,afil_nombres,sum(puntos) as pts from det_180 group by afiliado order by afiliado";
			$result = mysql_query($query,$link);
			while ($row = mysql_fetch_array($result)) {
				echo '<tr>';
					echo '<td align="center">'.$row["afiliado"].'</td>';
					echo '<td>'.$row["afil_nombres"].'</td>';
					echo '<td align="right">'.number_format($row["pts"],2,',','.').'</td>';
					echo '<td align="center"><input type="checkbox" name="'.$row["afiliado"].'"/></td>';
				echo '</tr>';
			}
		echo '</table>';
	echo '</p>';
	echo '<p align="center">';
		echo '<input type="submit" value="Canjear">';
	echo '</p>';
echo '</form>';
?>

