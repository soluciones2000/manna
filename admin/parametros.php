<?php 
ob_start();
include_once("conexion.php");
include_once("cabecera.php");
$menu = "opciones";
include_once("menu.php");
$men2 = "parametros";
include_once("opciones.php");
//	$query = "select * from information_schema.columns where table_schema='corpmann_manna' and table_name='afiliados'";
	$query = "select * from information_schema.columns where table_schema='sgcconsu_manna' and table_name='empresa'";	
//	$query = "select * from information_schema.columns where table_schema='manna' and table_name='empresa'";	
	$result = mysql_query($query,$link);


	$quer2 = "select * from empresa";
	$resul2 = mysql_query($quer2,$link);
	$ro2 = mysql_fetch_array($resul2);

	echo '<div style="text-align:center">';
		echo "<h3>PARÁMETROS DE LA EMPRESA</h3>";
	echo '</div>';
//	echo '<div style="text-align:center">';
	echo '<form name="param" method="post" action="actuaparam.php">';
		echo '<table align="center" border="1" cellpadding="5" width="60%">';
			while($row = mysql_fetch_array($result)) {
				$campo = $row["COLUMN_COMMENT"];
				$indice = $row["COLUMN_NAME"];
				$type = $row["DATA_TYPE"];
				if ($type == 'varchar' || $type == 'char') {
					$tam = $row["CHARACTER_MAXIMUM_LENGTH"];
				} else {
					if ($type == 'date') {
						$tam = 10;
					} else {
						$tam = $row["NUMERIC_PRECISION"];
					}
				}
				if ($campo<>"") {
					echo '<tr>';
						echo '<td width="25%"><b>'.utf8_encode($campo).'</b></td>';
//						echo '<td width="65%">'.utf8_encode($ro2[$indice]).'</td>';
						echo '<td width="65%"><input type="text" name="'.trim($indice).'" value="'.$ro2[$indice].'" size="100%" maxlength="'.$tam.'" /></td>';
					echo '</tr>';
				}
			}
		echo '</table>';
		echo '<br>';
		echo '<div align="center">';
			echo '<INPUT type="submit" value="Enviar">';
		echo '</div>';
	echo '</form>';
ob_end_flush();
?>
