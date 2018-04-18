<?php 
include_once("conexion.php");
foreach ($_POST as $key => $value) {
	$oid = (substr($key,0,7)=="anular_") ? trim(substr($key,7)) : trim($key) ;
	$query = "select status_orden from ordenes where orden_id=".$oid;
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		if ($row["status_orden"]<>'Anulada') {
			if (substr($key,0,7)=="anular_") {
				if ($key) { $query = "UPDATE ordenes SET status_orden='Anulada' WHERE orden_id=".$oid; }
			} else {
				switch ($row["status_orden"]) {
					case 'Cancelada por conciliar':
						$query = "UPDATE ordenes SET status_orden='Conciliada por despachar' WHERE orden_id=".$oid;
						break;
					case 'Conciliada por despachar':
						$query = "UPDATE ordenes SET status_orden='Despachada' WHERE orden_id=".$oid;
						break;
				}
			}
		}
	}
	$result = mysql_query($query,$link);
}
$cadena = 'Location: ordenes.php'; 
header($cadena);
?>
