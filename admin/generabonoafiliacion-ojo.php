<?php 
include_once("conexion.php");

$query = "SELECT * FROM empresa";
$result = mysql_query($query,$link);
if ($row = mysql_fetch_array($result)) {
	$valor_punto = $row["valor_punto"];
} else {
	$valor_punto = 0.00;
}

$query = "SELECT * FROM patrocinio order by patroc_codigo,tit_codigo";
$result = mysql_query($query,$link);
while($row = mysql_fetch_array($result)) {
	$patroc_codigo = $row["patroc_codigo"];
	$tit_codigo = $row["tit_codigo"];
	$fecha_afiliacion = $row["fecha_afiliacion"]; // del afiliado no del patrocinador
	$fecha_fin_bono =  $row["fecha_fin_bono"];

	$quer6 = "SELECT * from afiliados where tit_codigo='".$patroc_codigo."'";
	$resul6 = mysql_query($quer6,$link);
	if($ro6 = mysql_fetch_array($resul6)) {
		$tipo_patroc = $ro6["tipo_afiliado"];
		$patroc_nombres = trim($ro6["tit_nombres"])." ".trim($ro6["tit_apellidos"]);
	} else {
		$tipo_patroc = '';
		$patroc_nombres = '';
	}

	$quer6 = "SELECT * from afiliados where tit_codigo='".$tit_codigo."'";
	$resul6 = mysql_query($quer6,$link);
	if($ro6 = mysql_fetch_array($resul6)) {
		$tit_nombre_completo = trim($ro6["tit_nombres"])." ".trim($ro6["tit_apellidos"]);
	} else {
		$tit_nombre_completo = '';
	}

	$quer2 = "SELECT * from organizacion where organizacion.organizacion='".$tit_codigo."' and nivel>='0' AND nivel<'3' order by nivel,afiliado";
	$resul2 = mysql_query($quer2,$link);
	while($ro2 = mysql_fetch_array($resul2)) {
		$nivel = $ro2["nivel"]+1;
		$afiliado = $ro2["afiliado"];

		$quer6 = "SELECT * from afiliados where tit_codigo='".$afiliado."'";
		$resul6 = mysql_query($quer6,$link);
		if($ro6 = mysql_fetch_array($resul6)) {
			$tipo_afil = $ro6["tipo_afiliado"];
			$afil_nombres = trim($ro6["tit_nombres"])." ".trim($ro6["tit_apellidos"]);
		} else {
			$tipo_afil = $ro6["tipo_afiliado"];
			$afil_nombres = '';
		}

		$quer4 = "SELECT * from transacciones where afiliado='".$afiliado."' and tipo<'50' and fecha>='".$fecha_afiliacion."' and fecha<='".$fecha_fin_bono."' and status_comision='Pendiente'";
		$resul4 = mysql_query($quer4,$link);
		if($ro4 = mysql_fetch_array($resul4)) {
			$monto = $ro4["monto"];
			$puntos = $ro4['puntos'];
			$fectr = $ro4["fecha"];
			$id_trans = $ro4["id"];
			switch ($ro4["tipo"]) {
				case '01':
					$tipo_trans = 'Afiliación';
					break;
				case '02':
					$tipo_trans = 'Upgrade';
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

			if ($monto<>0.00) {
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

				$quer6 = "INSERT INTO detbonoafiliacion (patroc_codigo, tit_codigo, fecha_afiliacion, fecha_fin_bono, nivel, afiliado, tipo_patroc, tipo_afil, tipo_trans, fectr, monto, porcentaje, comision, patroc_nombres, tit_nombre_completo, afil_nombres, id_trans_origen, id_trans, status_bono) VALUES ('".$patroc_codigo."','".$tit_codigo."','".$fecha_afiliacion."','".$fecha_fin_bono."',".$nivel.",'".$afiliado."','".$tipo_patroc."','".$tipo_afil."','".$tipo_trans."','".$fectr."',".$monto.",".$porcentaje.",".$comision.",'".$patroc_nombres."','".$tit_nombre_completo."','".$afil_nombres."',".$id_trans.",0,'Pendiente');";
				echo $quer6.'<br>';
				if ($resul6 = mysql_query($quer6,$link)) {
					echo "SI".'<br><br>';
				} else {
					echo "NO".'<br><br>';
				}
				
			}
		}
	}
}

?>
