<?php 
ob_start();
include_once("conexion.php");
include_once("cabecera.php");
$menu = "opciones";
include_once("menu.php");
$men2 = "eventos";
include_once("opciones.php");
$tabla = 'eventos';
$titulo = 'EVENTOS PARA EL CALENDARIO';
$actualiza = 'actuaeventos.php';
//	$query = "select * from information_schema.columns where table_schema='corpmann_manna' and table_name='afiliados'";
	// $query = "select * from information_schema.columns where table_schema='manna' and table_name='".$tabla."'";	
	// $result = mysql_query($query,$link);


	$quer2 = "select * from ".$tabla;
	$resul2 = mysql_query($quer2,$link);
//	$ro2 = mysql_fetch_array($resul2);

	echo '<div style="text-align:center">';
		echo "<h3>".$titulo."</h3>";
	echo '</div>';
//	echo '<div style="text-align:center">';
	echo '<form name="eventos" method="post" action="'.$actualiza.'">';
		echo '<table align="center" border="1" cellpadding="4" width="85%">';
			echo '<tr>';
				echo '<th width="25%">';
					echo 'Nombre del evento';
				echo '</th>';
				echo '<th width="50%">';
					echo 'Descripción del evento';
				echo '</th>';
				echo '<th width="15%">';
					echo 'Fecha y hora del evento';
				echo '</th>';
				echo '<th width="10%">';
					echo 'Quitar';
				echo '</th>';
			echo '</tr>';

			while($row = mysql_fetch_array($resul2)) {
				echo '<tr>';
					echo '<td width="25%" align="center"><input type="text" name="evento_#_'.trim($row["id"]).'" value="'.$row["evento"].'" size="40" maxlength="255" /></td>';
					echo '<td width="50%" align="center"><textarea  rows="2" cols="60" name="descripcion_#_'.trim($row["id"]).'" size="100%" />'.$row["descripcion"].'</textarea></td>';
					echo '<td width="15%" align="center"><input type="datetime" name="inicio_#_'.trim($row["id"]).'" value="'.$row["inicio"].'" size="17" maxlength="19" /></td>';
					echo '<td width="10%" align="center"><input type="checkbox" name="borrar_#_'.trim($row["id"]).'" value="'.trim($row["id"]).'" /></td>';
				echo '</tr>';
			}
		echo '</table>';
		echo '<div style="text-align:center">';
			echo "<h3>Agregar un nuevo evento</h3>";
		echo '</div>';
		echo '<table align="center" border="1" cellpadding="3" width="85%">';
			echo '<tr>';
				echo '<th width="25%">';
					echo 'Nombre del evento';
				echo '</th>';
				echo '<th width="50%">';
					echo 'Descripción del evento';
				echo '</th>';
				echo '<th width="15%">';
					echo 'Fecha y hora del evento';
				echo '</th>';
			echo '</tr>';
			echo '<tr>';
				echo '<td width="25%" align="center"><input type="text" name="evento_#_new" value="" size="40" maxlength="255" /></td>';
				echo '<td width="50%" align="center"><textarea  rows="2" cols="60" name="descripcion_#_new" size="100%" /></textarea></td>';

				echo '<td width="15%" align="center"><input type="datetime" name="inicio_#_new" value="'.date("Y-m-d H:i:s").'" size="17" maxlength="19" /></td>';
			echo '</tr>';
		echo '</table>';
		echo '<br>';
		echo '<div align="center">';
			echo '<INPUT type="submit" value="Enviar">';
		echo '</div>';
	echo '</form>';
ob_end_flush();
?>
