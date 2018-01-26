<?php 
ob_start();
include_once("conexion.php");
include_once("cabecera.php");
$menu = "opciones";
include_once("menu.php");
$men2 = "materiales";
include_once("opciones.php");
$tabla = 'material';
$titulo = 'MATERIALES PARA DESCARGAR';
$actualiza = 'actuamaterial.php';
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
	echo '<form name="material" method="post" action="'.$actualiza.'">';
		echo '<table align="center" border="1" cellpadding="6" width="85%">';
			echo '<tr>';
				echo '<th width="15%">';
					echo 'Nombre material';
				echo '</th>';
				echo '<th width="15%">';
					echo 'Nombre archivo<br>(con extensión)';
				echo '</th>';
				echo '<th width="40%">';
					echo 'Descripción del contenido';
				echo '</th>';
				echo '<th width="10%">';
					echo 'Fecha de subida';
				echo '</th>';
				echo '<th width="15%">';
					echo 'Status';
				echo '</th>';
				echo '<th width="5%">';
					echo 'Quitar';
				echo '</th>';
			echo '</tr>';

			while($row = mysql_fetch_array($resul2)) {
				echo '<tr>';
					echo '<td width="20%"><input type="text" name="nombre_#_'.trim($row["id"]).'" value="'.$row["nombre"].'" size="30" maxlength="100" /></td>';
					echo '<td width="20%"><input type="text" name="archivo_#_'.trim($row["id"]).'" value="'.$row["archivo"].'" size="30" maxlength="100" readonly /></td>';
					echo '<td width="40%"><textarea  rows="2" cols="50" name="descripcion_#_'.trim($row["id"]).'" size="100%" />'.$row["descripcion"].'</textarea></td>';
					echo '<td width="10%"><input type="date" name="fecha_#_'.trim($row["id"]).'" value="'.$row["fecha"].'" size="100%" maxlength="10" /></td>';
					$activo = ($row["activo"]) ? "checked" : "" ;
					$actval = ($row["activo"]) ? "si" : "no" ;
					echo '<td width="10%" align="center"><input type="checkbox" name="activo_#_'.trim($row["id"]).'" value="'.$actval.'" '.$activo.' />Activo</td>';
					echo '<td width="10%" align="center"><input type="checkbox" name="borrar_#_'.trim($row["id"]).'" value="'.trim($row["id"]).'" /></td>';
				echo '</tr>';
			}
		echo '</table>';
		echo '<div style="text-align:center">';
			echo "<h3>Agregar un nuevo material</h3>";
		echo '</div>';
		echo '<table align="center" border="1" cellpadding="5" width="85%">';
			echo '<tr>';
				echo '<td width="40%" colspan="2">Nombre del material<br><input type="text" name="nombre_#_new" value="" size="60" maxlength="100" /></td>';
				echo '<td width="60%" colspan="3">Descripción del material<br><textarea  rows="2" cols="80" name="descripcion_#_new" size="100%" /></textarea></td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td width="100%" colspan="5"><input type="file" name="archivo_#_new" value="Archivo" /></td>';

			echo '</tr>';
		echo '</table>';
		echo '<br>';
		echo '<div align="center">';
			echo '<INPUT type="submit" value="Enviar">';
		echo '</div>';
	echo '</form>';
ob_end_flush();
?>
