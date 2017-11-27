<?php 
//session_start();
if (strpos($_SERVER["SERVER_NAME"],'localhost')!==FALSE) {
	// local
	$src_servidor = "localhost";
	$src_cuenta = "root";
//	$src_password = "myapm";
	$src_password = "rootmyapm";
	$src_database = "manna";
} elseif (strpos($_SERVER["SERVER_NAME"],'pruebas')!==FALSE) {
	// pruebas
	$src_servidor = "localhost:3306";
	$src_cuenta = "sgcco_root";
	$src_password = "sgcpasarela12345**";
	$src_database = "sgcconsu_manna";
} else {
	// Produccion
	$src_servidor = "host";
	$src_cuenta = "corpmann_root";
	$src_password = "manna12345##";
	$src_database = "corpmann_manna";
}

//$destino = 'local';
$destino = 'pruebas';
//$destino = 'produccion';
switch ($destino) {
	case 'local':
		$trg_servidor = "localhost";
		$trg_cuenta = "root";
//		$trg_password = "myapm";
		$trg_password = "rootmyapm";
		$trg_database = "manna2";
		break;
	case 'pruebas':
		$trg_servidor = "localhost:3306";
		$trg_cuenta = "sgcco_root";
		$trg_password = "sgcpasarela12345**";
		$trg_database = "sgcconsu_manna";
		break;
	case 'produccion':
		$trg_servidor = "host";
		$trg_cuenta = "corpmann_root";
		$trg_password = "manna12345##";
		$trg_database = "corpmann_manna";
		break;
}

$source = @mysql_connect($src_servidor, $src_cuenta, $src_password) or die ("Error al conectar al servidor origen.");
@mysql_select_db($src_database, $source) or die ("Error al conectar a la base de datos origen.");

echo 'conectó'.'<br>';

$target = @mysql_connect($trg_servidor, $trg_cuenta, $trg_password) or die ("Error al conectar al servidor destino.");
@mysql_select_db($trg_database, $target) or die ("Error al conectar a la base de datos destino.");

echo 'conectó'.'<br>';

date_default_timezone_set('America/Caracas');

//include_once("funciones.php");
set_time_limit(900);

$query = "select * from information_schema.tables where table_schema='".$src_database."'";
echo $query.'<br>';
$result = mysql_query($query,$source);
while($row = mysql_fetch_array($result)) {
	$tabla = $row["TABLE_NAME"];
//	if ($tabla=="afiliados" or $tabla=="transacciones") {
//	if ($tabla=="ordenes") {
		
		$quer2 = "select * from ".$src_database.".".$tabla;
		echo $quer2;
		echo '<br>';
		$resul2 = mysql_query($quer2,$source);
		while($ro2 = mysql_fetch_array($resul2)) {
			$quer3 = "select * from information_schema.columns where table_schema='".$src_database."' and table_name='".$tabla."'";
			$resul3 = mysql_query($quer3,$source);
			echo $quer3;
			$quer4 = "insert into ".$tabla." ";
			$medio = ") values ";
			$first = true;
			while ($ro3 = mysql_fetch_array($resul3)) {
				if ($first) {
					$inicio = '(';
					$first = false;
				} else {
					$inicio = ', ';
				}
				$tabla2 = $ro3["TABLE_NAME"];
				$columna = $ro3["COLUMN_NAME"];
				$tipo = $ro3["DATA_TYPE"];
				$cmaxlen = $ro3["CHARACTER_MAXIMUM_LENGTH"];
				$nlongitud = $ro3["NUMERIC_PRECISION"];
				$ndecimales = $ro3["NUMERIC_SCALE"];
				$cotejamiento = $ro3["COLLATION_NAME"];
				$tipocolumna = $ro3["COLUMN_TYPE"];
				$clave = $ro3["COLUMN_KEY"];
				$autoincrement = $ro3["EXTRA"];

				$valor = $ro2[$columna];
				if ($clave=="PRI") {
					$abuscar = $columna;
					$buscado = $valor;
					$abtipo = $tipo;
				}
				
				$quer4 .= $inicio.$columna;
				if ($tipo=="char" or $tipo=="varchar" or $tipo=="date" or $tipo=="datetime") {
					$medio .= $inicio."'".$valor."'";
				} else {
					$medio .= $inicio.$valor;
				}
			}
			$quer4 .= $medio.")";
			echo $quer4.'<br>';

			if ($abtipo=="char" or $abtipo=="varchar" or $abtipo=="date" or $abtipo=="datetime") {
				$quer5 = "select * from ".$trg_database.'.'.$tabla2." where ".$abuscar."='".$buscado."'";
			} else {
				$quer5 = "select * from ".$trg_database.'.'.$tabla2." where ".$abuscar."=".$buscado;
			}
			echo $quer5.'<br>';

			$resul5 = mysql_query($quer5,$target);

			if ($rox = mysql_fetch_array($resul5)) {
				echo 'ya existe';
			} else {
				$resul6 = mysql_query($quer4,$target);
				echo 'agregado';
			}
			echo '<br>';
		}
		echo '<br>';
//	}
}
echo '<br>';

$query = "select * from information_schema.tables where table_schema='".$trg_database."'";
$result = mysql_query($query,$target);
echo 'target'.'<br>';
while($row = mysql_fetch_array($result)) {
	$tabla = $row["TABLE_NAME"];
	echo $tabla.'<br>';
}
?>
