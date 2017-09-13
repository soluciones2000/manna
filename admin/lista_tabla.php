<?php 
include_once("conexion.php");
$query = "select * from information_schema.columns where table_schema='".$database."' and table_name='afiliados'";
$result = mysql_query($query,$link);

$quer2 = "select * from afiliados order by id";
$resul2 = mysql_query($quer2,$link);

//$tabla = "";
//$file = fopen(date('Ymd').".txt", "w");

$campos = array();
$tipos = array();
while($row = mysql_fetch_array($result)) {
	$indice = $row["COLUMN_NAME"];
	$tabla .= $indice;
	$campos[] = $indice;
	$x = $row["DATA_TYPE"];
	$tipos[] = $x;
}

$tabla = "{";
while($ro2 = mysql_fetch_array($resul2)) {
	$first = true;
	foreach ($campos as $key => $value) {
		if ($first) {
			$tabla .= '[{';
			$first = false;
		} else {
			$tabla .= ',';		
		}
		if ($tipos[$key]<>"varchar" and $tipos[$key]<>"char" and $tipos[$key]<>"date") {
			if ($tipos[$key]=="tinyint") {
				$valor = ($ro2[$campos[$key]]) ? "true" : "false" ;
				$tabla .= '"'.$campos[$key].'":'.$valor;
			} else {
				$tabla .= '"'.$campos[$key].'":'.$ro2[$campos[$key]];
			}
		} else {
			$tabla .= '"'.$campos[$key].'":"'.$ro2[$campos[$key]].'"';
		}
	}
	$tabla .= '}';
}
$tabla .= "]}";

$file = fopen(date('Ymd').".json", "w");
fwrite($file,$tabla);
fclose($file);
//$archivo = dirname($_SERVER["SCRIPT_FILENAME"]).'/'.date('Ymd').".json";
$archivo = date('Ymd').".json";

$asunto = "Tabla de afiliados al : ".date('d-m-Y');

$cabeceras .= "MIME-version: 1.0\n";
$cabeceras .= "Content-type: multipart/mixed;";
$cabeceras .= "boundary=\"--_Separador-de-mensajes_--\"\n";

$cabeceratexto = "----_Separador-de-mensajes_--\n";
$cabeceratexto .= "Content-type: text/plain;charset=iso-8859-1\n";
$cabeceratexto .= "Content-transfer-encoding: 7BIT\n";
 
$mensaje = $cabeceratexto.$tabla;

$adjunto = "\n\n----_Separador-de-mensajes_--\n";
$adjunto .= "Content-type: ".filetype($archivo).";name=\"".$archivo."\"\n";;
$adjunto .= "Content-Transfer-Encoding: BASE64\n";
$adjunto .= "Content-disposition: attachment;filename=\"".$archivo."\"\n\n";
 
$f = fopen($archivo, 'r');
$c = fread($f, filesize($archivo));
$adjunto .= chunk_split(base64_encode($c));
fclose($f);

echo "<pre>";
var_dump($_FILES);

$mensaje .= $adjunto."\n\n----_Separador-de-mensajes_----\n";

//Envío el correo
//mail("soluciones2000@gmail.com", $asunto, $mensaje, $cabeceras);
echo 'asunto: '.$asunto;
echo '<br>';
echo '<br>';
echo "mensaje: ".$mensaje;
echo '<br>';
echo '<br>';
echo "cabeceras: ".$cabeceras;
echo '<br>';
echo '<br>';
//var_dump($file);
?>

