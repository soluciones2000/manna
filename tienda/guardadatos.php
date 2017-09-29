<?php 
include_once("conexion.php");

function asignacodigo() {
// Comentario
	$query = "SELECT max(cod_corto_clte) as ultcodigo from clientes";
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		$ultcodigo = $row["ultcodigo"];
	} else {
		$ultcodigo = '00000';
	}
	$valores = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$codigo = '';
	$arriba = 1;
	$newcodigo = '';
	$numero = $ultcodigo;
	for ($i=strlen($numero)-1 ; $i>=0 ; $i--) { 
		$pos = strpos($valores, substr($numero,$i,1));
		$a = strlen($valores)-1;
		if ($arriba==1) {
			if ($pos==strlen($valores)-1) {
				$codigo = substr($valores,0,1);
			} else {
				$codigo = substr($valores,$pos+1,1);
				$arriba = 0;
			}
		} else {
			$codigo = substr($numero,$i,1);
		}
		$newcodigo = $codigo.$newcodigo;
	}		
	return $newcodigo;
}

$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
$direccion_envio = isset($_POST['direccion']) ? $_POST['direccion_envio'] : '';
$patroc_codigo = $_SESSION["codigo"];
$cod_corto_clte = asignacodigo();
$cod_clte = $_SESSION["codigo"]."@".$cod_corto_clte;

$query = "INSERT INTO clientes (email, nombre, cedula, telefono, direccion, direccion_envio, patroc_codigo, cod_clte, cod_corto_clte, status_cliente) VALUES ('".trim($email)."','".trim($nombre)."','".trim($cedula)."','".trim($telefono)."','".trim($direccion)."','".trim($direccion_envio)."','".trim($patroc_codigo)."','".trim($cod_clte)."','".trim($cod_corto_clte)."','Activo')";
if ($result = mysql_query($query,$link)) {
	if ($_SESSION["ruta"]=="orden") {
		$cadena = 'Location: resumen.php'; 
	} else {
		$cadena = 'Location: pago.php'; 
	}
} else {
	$cadena = 'Location: error.php'; 
}
header($cadena);
?>
