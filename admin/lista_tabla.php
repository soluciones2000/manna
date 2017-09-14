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

$uid = "_".md5(uniqid(time())); 

$cabeceras .= "MIME-version: 1.0\r\n";
$cabeceras .= "Content-type: multipart/mixed;";
$cabeceras .= "boundary=".$uid."\r\n";

// Pimera parte del mensaje: cuerpo del mensaje
$cabeceratexto = "--".$uid."\r\n";
$cabeceratexto .= "Content-type: text/plain;charset=utf-8\r\n";
$cabeceratexto .= "Content-Transfer-Encoding: 8bit\r\n";
$cabeceratexto .= "\r\n";

$mensaje = $cabeceratexto.$tabla;
$mensaje .= "\r\n";

// Segunda parte del mensaje, archivo adjunto
$mensaje .= "--".$uid."\r\n";
$mensaje .= "Content-type: application/octet-stream;";
$mensaje .= "name: ".$archivo."\r\n";
$mensaje .= "Content-Transfer-Encoding: base64"."\r\n";
$mensaje .= "Content-Disposition: attachment; ";
$mensaje .= "filename=".$archivo."\r\n";
$mensaje .= "\r\n";

// Codificar el archivo
$f = fopen($archivo, "rb");
$file = fread($f,filesize($archivo));
fclose($f);
$file = chunk_split(base64_encode($file));
$mensaje .= $file."\r\n";
$mensaje .= "\r\n";
$mensaje .= "--".$uid."--\r\n";

//Envío el correo
mail("soluciones2000@gmail.com", $asunto, $mensaje, $cabeceras);
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

