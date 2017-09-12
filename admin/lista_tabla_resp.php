<?php 
include_once("conexion.php");
$query = "select * from information_schema.columns where table_schema='".$database."' and table_name='afiliados'";
$result = mysql_query($query,$link);

$quer2 = "select * from afiliados order by id";
$resul2 = mysql_query($quer2,$link);

$tabla = "";
$file = fopen(date('Ymd').".txt", "w");

$first = true;
$campos = array();
while($row = mysql_fetch_array($result)) {
	if ($first) {
		$tabla .= '';
		$first = false;
	} else {
		$tabla .= ',';		
		fwrite($file, ",");
	}
	$indice = $row["COLUMN_NAME"];
	$tabla .= $indice;
	fwrite($file, $indice);
	$campos[] = $indice;
}
$tabla .= '<br>';
fwrite($file,PHP_EOL);

while($ro2 = mysql_fetch_array($resul2)) {
	$first = true;
	foreach ($campos as $key => $value) {
		if ($first) {
			$tabla .= '';
			$first = false;
		} else {
			$tabla .= ',';		
		fwrite($file, ",");
		}
		$tabla .= $ro2[$campos[$key]];
		fwrite($file, $ro2[$campos[$key]]);
	}
	$tabla .= '<br>';
	fwrite($file,PHP_EOL);
}
fclose($file);
echo $tabla;
echo '<br>';
echo dirname($_SERVER["SCRIPT_FILENAME"]).'/'.date('Ymd').".txt";

$asunto = "Tabla de afiliados al : ".date('d/m/Y');
$mensaje = $tabla.PHP_EOL;
$cabeceras = 'Content-type: text/html;'.PHP_EOL;

$archivo = file_get_contents(dirname($_SERVER["SCRIPT_FILENAME"]).'/'.date('Ymd').".txt");

$attachment = chunk_split(base64_encode($archivo));

//$cabeceras .= "Content-Type: application/octet-stream; name=\"".$archivo."\"".PHP_EOL;
//$cabeceras .= "Content-Transfer-Encoding: base64".PHP_EOL;
$cabeceras .= "Content-Disposition: attachment".PHP_EOL.PHP_EOL;
//$mensaje .= $attachment.PHP_EOL;

mail("soluciones2000@gmail.com",$asunto,$mensaje,$cabeceras);
?>
