<?php 
include_once("conexion.php");
include_once("funciones.php");
set_time_limit(300);

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

	// bono afiliacion y unilevel
	$querz = "SELECT * from EMPRESA";
	$resulz = mysql_query($querz,$link);
	$roz = mysql_fetch_array($resulz);
	$valor_punto = $roz["valor_punto"];
	$porc_180 = $roz["porc_180"];
	$pm_minimo = $roz["pm_minimo"];
	$pm_maximo = $roz["pm_maximo"];
	$reembolso = $roz["reembolso"];

	$quer1 = "SELECT * FROM transacciones where afiliado='".$tit_codigo."' and tipo<'50' order by afiliado";
	$resul1 = mysql_query($quer1,$link);
	while($ro1 = mysql_fetch_array($resul1)) {
		$precio = $ro1["precio"];
		$montotrans = $ro1["monto"];
		$puntos = $ro1['puntos'];
		$fectr = $ro1["fecha"];
		$id_trans = $ro1["id"];
		$tipo = $ro1["tipo"];
		$status_comision = $ro1["status_comision"];
		switch ($tipo) {
			case '01':
				$tipo_trans = 'Afiliación';
				$monto = $montotrans;
				break;
			case '02':
				$tipo_trans = 'Upgrade';
				$monto = $montotrans;
				break;
			case '03':
				$tipo_trans = 'Nota de crédito';
				$monto = 0;
				break;
			case '04':
				$tipo_trans = 'Consumo aliados';
				$monto = $puntos * $valor_punto;
				break;
			case '14':
				$tipo_trans = 'Consumo cliente';
				$monto = $puntos * $valor_punto;
				break;
			case '24':
				$tipo_trans = 'Consumo cliente preferencial';
				$monto = $puntos * $valor_punto;
				break;
		}
		if ($monto<>0.00 and $status_comision<>'No aplica') {
			if ($fectr<=$fecha_fin_bono) {
				// Bono afiliacion
				echo 'Bono afiliación'.'<br>';
				$quer2 = "SELECT * FROM redpatrocinios where afiliado='".$tit_codigo."' and nivel>0 and nivel<4 order by nivel";
				if ($resul2 = mysql_query($quer2,$link)) {
					while($ro2 = mysql_fetch_array($resul2)) {
						$patcod = $ro2["patroc_codigo"];
					}
					$quer3 = "SELECT tipo_afiliado,tit_nombres,tit_apellidos FROM afiliados where tit_codigo='".$patcod."'";
					$resul3 = mysql_query($quer3,$link);
					$ro3 = mysql_fetch_array($resul3);
					$tipo_patroc = $ro3["tipo_afiliado"];
					$patroc_nombres = trim($ro3["tit_nombres"])." ".trim($ro3["tit_apellidos"]);

					$quer4 = "SELECT * FROM redpatrocinios where afiliado='".$tit_codigo."' and nivel>0 and nivel<4 order by nivel";
					$resul4 = mysql_query($quer4,$link);
					while($ro4 = mysql_fetch_array($resul4)) {
						$aficod = $ro4["patroc_codigo"];
						$quer3 = "SELECT tipo_afiliado,tit_nombres,tit_apellidos FROM afiliados where tit_codigo='".$aficod."'";
						$resul3 = mysql_query($quer3,$link);
						$ro3 = mysql_fetch_array($resul3);
						$patroc_nombres = trim($ro3["tit_nombres"])." ".trim($ro3["tit_apellidos"]);
						$nivel = $ro4["nivel"];

						$querz = "SELECT tit_nombres,tit_apellidos FROM afiliados where tit_codigo='".$aficod."'";
						$resulz = mysql_query($querz,$link);
						$roz = mysql_fetch_array($resulz);
						$afil_nombres = trim($roz["tit_nombres"])." ".trim($roz["tit_apellidos"]);

						$quer5 = "SELECT * from bono_afiliacion where bono_afiliacion.nivel='".trim($nivel)."'";
						$resul5 = mysql_query($quer5,$link);
						$ro5 = mysql_fetch_array($resul5);
						$porcentaje = 0.00;
						switch ($tipo_patroc) {
							case 'Premium':
								$porcentaje = $ro5["premium"];
								break;
							case 'VIP':
								$porcentaje = $ro5["vip"];
								break;
							case 'Oro':
								$porcentaje = $ro5["oro"];
								break;
						}
						$comision = $monto*($porcentaje/100);
						$quer6 = "INSERT INTO detbonoafiliacion (patroc_codigo, tit_codigo, fecha_afiliacion, fecha_fin_bono, nivel, afiliado, tipo_patroc, tipo_afil, tipo_trans, fectr, monto, porcentaje, comision, patroc_nombres, tit_nombre_completo, afil_nombres, id_trans_origen, id_trans, status_bono) VALUES ('".$aficod."', '".$aficod."', '".$fecha_afiliacion."', '".$fecha_fin_bono."', ".$nivel.", '".$tit_codigo."', '".$tipo_patroc."', '".$tipo_afiliado."', '".$tipo_trans."', '".$fectr."', ".$monto.", ".$porcentaje.", ".$comision.", '".$patroc_nombres."', '".$afil_nombres."', '".$nombres."', ".$id_trans.", 0,'Pendiente')";
						$resul6 = mysql_query($quer6,$link);
					}
				}
				if ($tipo=='04' or $tipo=='14' or $tipo=='24') {
					// CLUB 180
					echo 'Club 180'.'<br>';
					$quera = "SELECT afiliado,sum(puntos) as puntos FROM transacciones where afiliado='".trim($tit_codigo)."' and status_comision='Pendiente' and status_comision<>'No aplica'";
					$resula = mysql_query($quera,$link);
					$roa = mysql_fetch_array($resula);
					$pm = ($roa["puntos"]>0) ? $roa["puntos"] : 0 ;
					if ($pm>$pm_minimo or $pm+$puntos>$pm_minimo) {
						if ($pm<=$pm_maximo) {
							if ($pm<=$pm_minimo) {
								$base = $pm + $puntos - $pm_minimo;
							} else {
								$base = ($pm+$puntos>$pm_maximo) ? $pm + $puntos - $pm_maximo : $puntos ;
							}
							
							$vencimiento = strtotime('+1 year', strtotime ($fecha_afiliacion));
							$vencimiento = date ( 'Y-m-d' , $vencimiento );

							$puntos_180 = $base * $porc_180/100;
							$quer8 = "INSERT INTO det_180 (afiliado, afil_nombres, fectr, tipo_trans, nombre_trans, puntos, id_trans_origen, id_trans, status_180, vencimiento) VALUES ('".$tit_codigo."', '".nombres($tit_codigo,$link)."', '".$fectr."', '".$tipo."', '".$tipo_trans."',".$puntos_180.", ".$id_trans.", 0, 'Pendiente','".$vencimiento."')";
							$resul8 = mysql_query($query,$link);
						}
					}

					// Reembolso
					$montoreembolso = $montotrans*$reembolso/100;
					echo 'Reembolso'.'<br>';
					$quer7 = "INSERT INTO reembolso (afiliado, fecha, precio, monto, puntos, trans_id, status_comision) VALUES ('".$tit_codigo."', '".$fectr."', 0, ".$montoreembolso.", 0, ".$id_trans.", 'Pendiente')";
					$resul7 = mysql_query($quer7,$link);
				}
			} else {
				// Bono afiliacion
				if ($tipo=='04' or $tipo=='14' or $tipo=='24') {
					echo 'Bono unilevel'.'<br>';
///////////////////////////////////////////////////////////////////////////////////////////////
					$querb = "SELECT organizacion.organizacion,afiliados.rango,organizacion.afiliado,organizacion.nivel FROM organizacion left outer join afiliados on organizacion.organizacion=afiliados.tit_codigo WHERE afiliado='".$tit_codigo."'";
					$resulb = mysql_query($querb,$link);
					while($rob = mysql_fetch_array($resulb)) {
						$organizacion = $rob["organizacion"];
						$rango = $rob["rango"];
						$nivel = $rob["nivel"];

						$org_nombres = nombres($organizacion,$link);

						if ($nivel>0 and $nivel<=8) {
							$querc = "SELECT n".trim(strval($nivel))." as porcentaje FROM unilevel WHERE rango='".$rango."'";
							if ($resulc = mysql_query($querc,$link)) {
								$roc = mysql_fetch_array($resulc);
								$porcentaje = $roc["porcentaje"];
								$comision = $montotrans*$porcentaje/100;
								$querd = "INSERT INTO detunilevel (organizacion, org_nombres, rango, nivel, afiliado, afil_nombres, fectr, tipo_trans, nombre_trans, precio, monto, porcentaje, comision, id_trans_origen, id_trans, status_unilevel) VALUES ('".$organizacion."', '".nombres($organizacion,$link)."', '".$rango."', '".$nivel."', '".$tit_codigo."', '".nombres($tit_codigo,$link)."', '".$fectr."', '".$tipo."', '".$tipo_trans."',".$precio.", ".$montotrans.", ".$porcentaje.", ".$comision.", ".$id_trans.", 0, 'Pendiente')";
								$resuld = mysql_query($querd,$link);
							}
						}
					}
///////////////////////////////////////////////////////////////////////////////////////////////
				}				
			}
		}
	}

	// salto de linea siguiente registro
	echo date('H:m:s').'<br>';
	echo '<br>';
}

?>
