<?php
include_once("conexion.php");
include_once("funciones.php");

$query = "SELECT * from empresa";
$result = mysql_query($query,$link);
if ($row = mysql_fetch_array($result)) {
   $empresa = utf8_encode($row["emp_nombre"]);
   $_SESSION["iva1"] = $row["iva1"];
   $_SESSION["iva2"] = $row["iva2"];
   $_SESSION["iva3"] = $row["iva3"];
   $_SESSION["valor_punto"] = $row["valor_punto"];
} else {
   $empresa = "Error al conectar a la base de datos.";
   $_SESSION["iva1"] = 0.00;
   $_SESSION["iva2"] = 0.00;
   $_SESSION["iva3"] = 0.00;
   $_SESSION["valor_punto"] = 0.00;
}

$cJson = (isset($_POST['cJson'])) ? $_POST['cJson'] : '' ;

$aRegistros = json_decode($cJson,true);

echo json_last_error_msg();

$cliente_pref = '';
$status_comision = 'Pendiente';
foreach ($aRegistros as $key => $value) {
	$fecha = $value['fecha'];
	$afiliado = $value['afiliado'];
	$cliente = $value['cliente'];
	$tipo = $value['tipo'];
	$precio = $value['precio'];
	$monto = $value['monto'];
	$puntos = $value['puntos'];
	$documento = $value['documento']; 
	$bancoorigen = $value['bancoorigen']; 
	$orden_id = $value['orden_id']; 
	$query = "INSERT INTO transacciones (fecha, afiliado, cliente, cliente_pref, tipo, precio, monto, puntos, valor_punto, documento, bancoorigen, status_comision, orden_id) VALUES ('".$fecha."','".$afiliado."','".$cliente."','','".$tipo."',".$precio.",".$monto.",".$puntos.",".$_SESSION["valor_punto"].",'".$documento."','".$bancoorigen."','Pendiente',".$orden_id.")";
	$result = mysql_query($query,$link);
}

return true;
?>