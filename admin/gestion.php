<?php 
include_once("conexion.php");
foreach ($_POST as $key => $value) {
	$query = "select status_orden from ordenes where orden_id=".trim($key);
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		switch ($row["status_orden"]) {
			case 'Cancelada por conciliar':
				$query = "UPDATE ordenes SET status_orden='Conciliada por despachar' WHERE orden_id=".trim($key);
				break;
			case 'Conciliada por despachar':
				$query = "UPDATE ordenes SET status_orden='Despachada' WHERE orden_id=".trim($key);
				break;
		}
	}
	$result = mysql_query($query,$link);
}
$cadena = 'Location: ordenes.php'; 
header($cadena);
?>
