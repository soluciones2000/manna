<?php 
include_once("conexion.php");

$query = "select * from information_schema.columns where table_schema='manna' and table_name='empresa'";	
$result = mysql_query($query,$link);

$quer2 = "select * from empresa";
$resul2 = mysql_query($quer2,$link);
$ro2 = mysql_fetch_array($resul2);

$quer3 = 'UPDATE empresa SET ';
$inicio = 0;
while($row = mysql_fetch_array($result)) {
	if ($row["COLUMN_COMMENT"]<>"") {
		if ($inicio++<>0) {
			$quer3 .= ', ';
		}
		$indice = $row["COLUMN_NAME"];
		$type = $row["DATA_TYPE"];
		if ($type == 'varchar' || $type == 'char' || $type == 'date') {
			$quer3 .= trim($indice)."='".trim($_POST[$indice])."'";
		} else {
			$quer3 .= trim($indice).'='.trim($_POST[$indice]);
		}
	}
}

echo $quer3;
$resul3 = mysql_query($quer3,$link);

$cadena = 'Location: inicio.php?user='.$_SESSION['user']; 
header($cadena);
?>
