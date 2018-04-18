<?php 
include_once("conexion.php");
include_once("funciones.php");
set_time_limit(1800);

$quer9 = "SELECT * from empresa";
$resul9 = mysql_query($quer9,$link);
if ($ro9 = mysql_fetch_array($resul9)) {
   $empresa = utf8_encode($ro9["emp_nombre"]);
   $_SESSION["iva1"] = $ro9["iva1"];
   $_SESSION["iva2"] = $ro9["iva2"];
   $_SESSION["iva3"] = $ro9["iva3"];
   $_SESSION["valor_punto"] = $ro9["valor_punto"];
} else {
   $empresa = "Error al conectar a la base de datos.";
   $_SESSION["iva1"] = 0.00;
   $_SESSION["iva2"] = 0.00;
   $_SESSION["iva3"] = 0.00;
   $_SESSION["valor_punto"] = 0.00;
}

// Borrar tablas
$query = "DELETE FROM genealogia WHERE 1";
$result = mysql_query($query,$link);
$query = "ALTER TABLE genealogia auto_increment = 1";
$result = mysql_query($query,$link);

$query = "DELETE FROM organizacion WHERE 1";
$result = mysql_query($query,$link);
$query = "ALTER TABLE organizacion auto_increment = 1";
$result = mysql_query($query,$link);

$query = "DELETE FROM patrocinio WHERE 1";
$result = mysql_query($query,$link);
$query = "ALTER TABLE patrocinio auto_increment = 1";
$result = mysql_query($query,$link);

$query = "DELETE FROM redpatrocinios WHERE 1";
$result = mysql_query($query,$link);
$query = "ALTER TABLE redpatrocinios auto_increment = 1";
$result = mysql_query($query,$link);

$query = "DELETE FROM detbonoafiliacion WHERE 1";
$result = mysql_query($query,$link);
$query = "ALTER TABLE detbonoafiliacion auto_increment = 1";
$result = mysql_query($query,$link);

$query = "DELETE FROM detunilevel WHERE 1";
$result = mysql_query($query,$link);
$query = "ALTER TABLE detunilevel auto_increment = 1";
$result = mysql_query($query,$link);

$query = "DELETE FROM det_180 WHERE 1";
$result = mysql_query($query,$link);
$query = "ALTER TABLE det_180 auto_increment = 1";
$result = mysql_query($query,$link);

$query = "DELETE FROM reembolso WHERE 1";
$result = mysql_query($query,$link);
$query = "ALTER TABLE reembolso auto_increment = 1";
$result = mysql_query($query,$link);

$query = "DELETE FROM bono_aci_potencial WHERE 1";
$result = mysql_query($query,$link);
$query = "ALTER TABLE bono_aci_potencial auto_increment = 1";
$result = mysql_query($query,$link);

// Actualizaciones
$query = "SELECT * FROM afiliados order by tit_codigo";
$result = mysql_query($query,$link);
echo date('H:m:s');
echo '<br>';

while($row = mysql_fetch_array($result)) {
	$tit_codigo = $row["tit_codigo"];
	$patroc_codigo = $row["patroc_codigo"];
	$enrol_codigo = $row["enrol_codigo"];
	$nombres = trim($row["tit_nombres"]).' '.trim($row["tit_apellidos"]);
	$tipo_afiliado = $row["tipo_afiliado"];

	$fecha_afiliacion = $row["fecha_afiliacion"];
	$fecha_fin_bono = strtotime('+60 day', strtotime ($fecha_afiliacion));
//	$fecha_fin_bono = strtotime('+60 day', strtotime ('2017-11-01'));
	$fecha_fin_bono = date ( 'Y-m-d' , $fecha_fin_bono );
	echo $tit_codigo.'<br>';

	// Genealogía
	if ($enrol_codigo<>$tit_codigo) {
		$quer1 = "INSERT INTO genealogia (padre, hijo) VALUES ('".$enrol_codigo."', '".$tit_codigo."')";
		$resul1 = mysql_query($quer1,$link);
		echo 'Genealogia'.'<br>';
	}

	// Organizacion
	if ($enrol_codigo<>$tit_codigo) {
		$hijo = $tit_codigo;
		$padre = $tit_codigo;
		$nivel = 0;
		echo 'Organizacion'.'<br>';
		$quer2 = "INSERT INTO organizacion (organizacion, nivel, afiliado, lado) VALUES ('".$padre."', ".$nivel.", '".$hijo."', 0)";
		$resul2 = mysql_query($quer2,$link);
		$hijo = $padre;
		$loop = true;
		while ($loop) {
			$querx = "SELECT * from genealogia where hijo='".$hijo."'";
			$resulx = mysql_query($querx,$link);
			if ($rox = mysql_fetch_array($resulx)) {
				$padre = $rox["padre"];
				$hijo = $tit_codigo;
				$nivel++;

				$quer2 = "INSERT INTO organizacion (organizacion, nivel, afiliado, lado) VALUES ('".$padre."', ".$nivel.", '".$hijo."', 0)";
				$resul2 = mysql_query($quer2,$link);
				$hijo = $padre;
			} else {
				$loop = false;
			}
		}
	}

	// Patrocinio
	if ($patroc_codigo<>$tit_codigo) {
		$quer3 = "INSERT INTO patrocinio (patroc_codigo, tit_codigo, fecha_afiliacion, fecha_fin_bono) VALUES ('".$patroc_codigo."', '".$tit_codigo."', '".$fecha_afiliacion."', '".$fecha_fin_bono."')";
		$resul3 = mysql_query($quer3,$link);
		echo 'Patrocinio'.'<br>';
	}

	// Redpatrocinios
	if ($patroc_codigo<>$tit_codigo) {
		$afiliado = $tit_codigo;
		$patcod = $tit_codigo;
		$nivel = 0;
		echo 'Redpatrocinios'.'<br>';
		$quer4 = "INSERT INTO redpatrocinios (patroc_codigo, nivel, afiliado) VALUES ('".$patcod."', ".$nivel.", '".$afiliado."')";
		$resul4 = mysql_query($quer4,$link);
		$afiliado = $patcod;
		$loop = true;
		while ($loop) {
			$querx = "SELECT * from patrocinio where tit_codigo='".$afiliado."'";
			$resulx = mysql_query($querx,$link);
			if ($rox = mysql_fetch_array($resulx)) {
				$patcod = $rox["patroc_codigo"];
				$afiliado = $tit_codigo;
				$nivel++;

				$quer4 = "INSERT INTO redpatrocinios (patroc_codigo, nivel, afiliado) VALUES ('".$patcod."', ".$nivel.", '".$afiliado."')";
				$resul4 = mysql_query($quer4,$link);
				$afiliado = $patcod;
			} else {
				$loop = false;
			}
		}
	}
	// salto de linea siguiente registro
	echo date('H:m:s').'<br>';
	echo '<br>';
}


$query = "SELECT * FROM ordenes where status_orden<>'Anulada' and status_orden<>'Pendiente' order by orden_id";
$result = mysql_query($query,$link);
while($row = mysql_fetch_array($result)) {
	$tit_codigo = $row["codigo"];
	$orden_id = $row["orden_id"];
	$puntos = $row["puntos"];
	$fecha = substr($row["fecha"],0,10);
	$idtran = $row["id_transaccion"];

	$querc = "SELECT afiliado,sum(puntos) as puntos FROM transacciones where afiliado='".trim($tit_codigo)."' and status_comision='Pendiente' and status_comision<>'No aplica'";
	$resulc = mysql_query($querc,$link);
	$roc = mysql_fetch_array($resulc);
	if ($roc["puntos"]>0) {
		$pm = $roc["puntos"];
	}

//	echo 'Bono ACI Potencial'.'<br>';
	bono_aci_potencial($link,$tit_codigo,$pm,$puntos,$orden_id,$fecha,$idtran);
}

$query = "SELECT * FROM transacciones where status_comision<>'Cancelada' order by afiliado";
$result = mysql_query($query,$link);
while($row = mysql_fetch_array($result)) {
	$tit_codigo = $row["afiliado"];
	$precio_orden = $row["precio"];
	$precio = $row["precio"];
	$monto = $row["monto"];
	$puntos = $row["puntos"];
	$fecha = $row["fecha"];
	$idtran = $row["id"];

	$querz = "select * from afiliados where tit_codigo='".$tit_codigo."'";
	$resulz = mysql_query($querz,$link);
	$roz = mysql_fetch_array($resulz);
	$pm = $roz["pm"];
	$pmo = $roz["pmo"];
	$querc = "SELECT afiliado,sum(puntos) as puntos FROM transacciones where afiliado='".trim($tit_codigo)."' and status_comision='Pendiente' and status_comision<>'No aplica'";
	$resulc = mysql_query($querc,$link);
	$roc = mysql_fetch_array($resulc);
	if ($roc["puntos"]>0) {
		$pm += $roc["puntos"];
	}

	$querb = "SELECT afiliado FROM organizacion where organizacion='".trim($tit_codigo)."'";
	$resulb = mysql_query($querb,$link);
	$pmo = 0;
	while($rob = mysql_fetch_array($resulb)) {
		$querd = "SELECT sum(puntos) as pmo FROM transacciones where afiliado='".trim($rob["afiliado"])."' and status_comision='Pendiente' and status_comision<>'No aplica'";
		$resuld = mysql_query($querd,$link);
		$rod = mysql_fetch_array($resuld);
		$pmo += $rod["pmo"];
	}
	$pmo -= $pm;

	// echo 'Calificacion'.'<br>';
	calificacion($tit_codigo,$pm,$pmo,$link);

	$querx = "select * from patrocinio where tit_codigo='".$tit_codigo."'";
	$resulx = mysql_query($querx,$link);
	$rox = mysql_fetch_array($resulx);
	$fecha_afiliacion = $rox["fecha_afiliacion"];
	$fecha_fin_bono = $rox["fecha_fin_bono"];

	// Verifica si el bono está vigente
	if (date('Y-m-d')<=$fecha_fin_bono) {
		echo 'Bono patrocinio'.'<br>';
		echo $tit_codigo.' - '.$monto.' - '.$fecha_afiliacion.' - '.$fecha_fin_bono.' - '.$fecha.' - '.$idtran.'<br><br>';
		bono_patrocinio($link,$tit_codigo,$monto,$fecha_afiliacion,$fecha_fin_bono,$fecha,$idtran);
	} else {
		// echo 'Bono unilevel'.'<br>';
		bono_unilevel($link,$tit_codigo,$fecha,$precio_orden,$monto,$idtran);
	}
	// echo 'Bono reembolso'.'<br>';
	bono_de_reembolso($link,$tit_codigo,$fecha,$precio_orden,$monto,$puntos,$idtran);
}
echo "fin";
?>
