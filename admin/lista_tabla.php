<?php 
include_once("conexion.php");
$query = "select * from information_schema.columns where table_schema='".$database."' and table_name='afiliados'";
$result = mysql_query($query,$link);

$quer2 = "select * from afiliados order by id";
$resul2 = mysql_query($quer2,$link);

//$tabla = "";
//$file = fopen(date('Ymd').".txt", "w");

$campos = array();
while($row = mysql_fetch_array($result)) {
	$indice = $row["COLUMN_NAME"];
	$tabla .= $indice;
	$campos[] = $indice;
}

$tabla = "{";
while($ro2 = mysql_fetch_array($resul2)) {
	$first = true;
	foreach ($campos as $key => $value) {
		if ($first) {
			$tabla .= '{';
			$first = false;
		} else {
			$tabla .= ',';		
		}
		$tabla .= '"'.$campos[$key].'":"'.$ro2[$campos[$key]].'"';
	}
	$tabla .= '}';
}
$tabla .= "}";

$file = fopen(date('Ymd').".json", "w");
fwrite($file,$tabla);
fclose($file);
$archivo = dirname($_SERVER["SCRIPT_FILENAME"]).'/'.date('Ymd').".json";
echo $archivo;
echo '<br>';
echo $tabla;
var_dump($file);

$asunto = "Tabla de afiliados al : ".date('d-m-Y');
$mensaje = $tabla;

//$attachment = chunk_split(base64_encode($archivo));

$cabeceras .= "X-attachments: ".$archivo;

//Envío el correo
mail("soluciones2000@gmail.com", $asunto, $mensaje, $cabeceras);
?>
