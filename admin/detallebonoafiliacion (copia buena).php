<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "reportes";
include_once("menu.php");
$men2 = "";
include_once("reportes.php");
?>
<style>
.sangria {
    width: 3%;
	display: inline-block;	
}
.caracter {
    width: 1%;
	display: inline-block;	
}
.espacio {
    width: 8%;
	display: inline-block;	
}
.nombre {
    width: 30%;
	display: inline-block;	
}
.tipo_af {
    width: 5%;
	display: inline-block;	
}
.detalle {
    width: 9%;
	display: inline-block;	
}
.varios {
    width: 15%;
	display: inline-block;	
}

.codigo {
    width: 5%;
	display: inline-block;	
}
.grupo1 {
	background-color: powderblue;
}
.grupo2 {
	background-color: none;
}
.grupo1-total {
	background-color: powderblue;
	padding-left: 30%;
	padding-right: 37%;
}
.grupo2-total {
	background-color: none;
	padding-left: 30%;
	padding-right: 37%;
}
</style>
<?php
if ($_POST['cod_desde']<>'') {
	$dsd = $_POST['cod_desde'];
} else {
	$dsd = 'Primero';
}
if ($_POST['cod_hasta']<>'') {
	$hst = $_POST['cod_hasta'];
} else {
	$hst = 'Último';
}

//$dsd = isset($_POST['cod_desde']) ? $_POST['cod_desde'] : 'Primero';
//$hst = isset($_POST['cod_hasta']) ? $_POST['cod_hasta'] : 'Último';
$mes = isset($_POST['mes']) ? $_POST['mes'] : null;
$ano = isset($_POST['ano']) ? $_POST['ano'] : null;
echo '<div id="cuerpo">';
	echo '<div style="text-align:center">';
		echo '<h3>DETALLE DE COMISIONES A PAGAR MES: '.$mes.'/'.$ano.'<br>';
		echo 'Desde el código: <font color="red">'.trim($dsd).'</font> hasta el código: <font color="red">'.trim($hst).'</font></h3>';
	echo '</div>';

if (isset($mes) and isset($ano)) {
	$quer0 = "DELETE FROM repbonoafiliacion WHERE 1";
	$resul0 = mysql_query($quer0,$link);

	$query = "SELECT * FROM empresa";
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		$valor_punto = $row["valor_punto"];
	} else {
		$valor_punto = 0.00;
	}

	if ($dsd<>'Primero') {
		if ($hst<>'Último') {
			$query = "SELECT * FROM patrocinio WHERE patroc_codigo>='".trim($dsd)."' AND patroc_codigo<='".trim($hst)."' order by patroc_codigo,tit_codigo";
		} else {
			$query = "SELECT * FROM patrocinio WHERE patroc_codigo>='".trim($dsd)."' order by patroc_codigo,tit_codigo";
		}
	} else {
		if ($hst<>'Último') {
			$query = "SELECT * FROM patrocinio WHERE patroc_codigo<='".trim($hst)."' order by patroc_codigo,tit_codigo";
		} else {
			$query = "SELECT * FROM patrocinio order by patroc_codigo,tit_codigo";
		}
	}

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
					$quer6 = "INSERT INTO repbonoafiliacion VALUES ('".$patroc_codigo."','".$tit_codigo."','".$fecha_afiliacion."','".$fecha_fin_bono."',".$nivel.",'".$afiliado."','".$tipo_patroc."','".$tipo_afil."','".$tipo_trans."','".$fectr."',".$monto.",".$porcentaje.",".$comision.",'".$patroc_nombres."','".$tit_nombre_completo."','".$afil_nombres."',".$id_trans.");";
					$resul6 = mysql_query($quer6,$link);
				}
			}
		}
	}
}

$query = "SELECT * FROM repbonoafiliacion order by patroc_codigo,tit_codigo,nivel,afiliado";
$result = mysql_query($query,$link);
$first = true;
$tot_tit = 0.00;
$tot_pat = 0.00;
$tot_gen = 0.00;
$grupo = 1;
while($row = mysql_fetch_array($result)) {
	if ($first) {
		$patroc_codigo = $row['patroc_codigo'];
		$tit_codigo = $row['tit_codigo'];
		$patroc_nombres = $row['patroc_nombres'];
		$tit_nombre_completo = $row['tit_nombre_completo'];
		$tipo_patroc = $row['tipo_patroc'];
		$first = false;

		echo "<b><u>";
		echo '<div class="sangria"></div>';
		echo "NIVEL";
		echo '<div class="espacio"></div>';
		echo "AFILIADO";
		echo '<div class="espacio"></div>';
		echo '<div class="espacio"></div>';
		echo '<div class="sangria"></div>';
		echo "TIPO";

		echo '<div class="sangria"></div>';
		echo "TRANSACCIÓN";

		echo '<div class="sangria"></div>';
		echo '<div class="sangria"></div>';
		echo '<div class="caracter"></div>';
		echo "FECHA";
		echo '<div class="sangria"></div>';
		echo '<div class="sangria"></div>';
		echo "MONTO";
		echo '<div class="caracter"></div>';
		echo "PORCENTAJE";
		echo '<div class="caracter"></div>';
		echo "COMISIÓN";
		echo "</u></b><br>";

		$txt = '<div class="grupo1">';
		$txt .= "<b>Patrocinador: ".$patroc_codigo." - ".$patroc_nombres." - tipo de afiliado: ".$tipo_patroc."</b><br>";
		$txt .= '<div class="caracter"></div><i><u>Patrocinado: '.$tit_codigo." - ".$tit_nombre_completo."</u></i><br>";
		$tot_tit = 0.00;
		$tot_pat = 0.00;
		$tot_gen = 0.00;
	}
	if ($patroc_codigo<>$row['patroc_codigo']) {
		$txt .= '<div style="text-align:right;padding-right:7%;">'.str_repeat('-', 20)."</div>";
		$txt .= '<div style="text-align:right;padding-right:7%;"><i>Total Patrocinado '.$tit_codigo." - ".trim($tit_nombre_completo).': '.trim(number_format($tot_tit,2,',','.'))."</i></div>";
		$txt .= '<div style="text-align:right;padding-right:7%;">'.str_repeat('=', 20)."</div>";
		$txt .= '<div style="text-align:right;padding-right:7%;"><b>Total Patrocinador '.$patroc_codigo." - ".trim($patroc_nombres).': '.trim(number_format($tot_pat,2,',','.'))."</b></div>";
		$txt .= "</div>";
		echo $txt;
		$patroc_codigo = $row['patroc_codigo'];
		$tit_codigo = $row['tit_codigo'];
		$patroc_nombres = $row['patroc_nombres'];
		$tit_nombre_completo = $row['tit_nombre_completo'];
		$tipo_patroc = $row['tipo_patroc'];
		if ($grupo==1) {
			$txt = '<div class="grupo2">';
			$grupo = 2;
		} else {
			$txt = '<div class="grupo1">';
			$grupo = 1;
		}
		$txt .= "<b>Patrocinador: ".$patroc_codigo." - ".$patroc_nombres." - tipo de afiliado: ".$tipo_patroc."</b><br>";
		$txt .= '<div class="caracter"></div><i><u>Patrocinado: '.$tit_codigo." - ".$tit_nombre_completo."</u></i><br>";
		$tot_tit = 0.00;
		$tot_pat = 0.00;
	}
	if ($tit_codigo<>$row['tit_codigo']) {
//		$txt .= '<div class="caracter"></div>';
		$txt .= '<div style="text-align:right;padding-right:7%;">'.str_repeat('-', 20)."</div>";
		$txt .= '<div style="text-align:right;padding-right:7%;"><i>Total Patrocinado '.$tit_codigo." - ".trim($tit_nombre_completo).': '.trim(number_format($tot_tit,2,',','.'))."</i></div>";
		echo $txt;
		$patroc_codigo = $row['patroc_codigo'];
		$tit_codigo = $row['tit_codigo'];
		$patroc_nombres = $row['patroc_nombres'];
		$tit_nombre_completo = $row['tit_nombre_completo'];
		$txt = '<div class="caracter"></div><i><u>Patrocinado: '.$tit_codigo." - ".$tit_nombre_completo."</u></i><br>";
		$tot_tit = 0.00;
	}
	$patroc_codigo = $row['patroc_codigo'];
	$tit_codigo = $row['tit_codigo'];
	$fecha_afiliacion = $row['fecha_afiliacion'];
	$fecha_fin_bono = $row['fecha_fin_bono'];
	$nivel = $row['nivel'];
	$afiliado = $row['afiliado'];
	$tipo_patroc = $row['tipo_patroc'];
	$tipo_afil = $row['tipo_afil'];
	$tipo_trans = $row['tipo_trans'];
	$fectr = $row['fectr'];
	$monto = $row['monto'];
	$porcentaje = $row['porcentaje'];
	$comision = $row['comision'];
	$patroc_nombres = $row['patroc_nombres'];
	$tit_nombre_completo = $row['tit_nombre_completo'];
	$afil_nombres = $row['afil_nombres'];
	$id_trans = $row['id_trans'];

	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="sangria"></div>';
	$txt .= $nivel;

	$txt .= '<div class="sangria"></div>';
	$txt .= '<div class="nombre">'.$afiliado." ".$afil_nombres.'</div>';

	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="tipo_af">'.$tipo_afil.'</div>';

	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="varios">'.$tipo_trans.'</div>';

	$txt .= '<div class="caracter"></div>';
	$txt .= substr($fectr,8,2).'/'.substr($fectr,5,2).'/'.substr($fectr,0,4);

	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($monto,2,',','.')).'</div>';

	$txt .= '<div class="sangria"></div>';
	$txt .= '<div class="sangria" style="text-align:right;">'.number_format($porcentaje,0,',','.')."%".'</div>';

	$txt .= '<div class="caracter"></div>';
	$txt .= '<div class="detalle" style="text-align:right;">'.trim(number_format($comision,2,',','.')).'</div>'."<br>";
	$tot_tit += $comision;
	$tot_pat += $comision;
	$tot_gen += $comision;
//	echo $txt;
}
//if ($patroc_codigo<>$row['patroc_codigo']) {
	$txt .= '<div style="text-align:right;padding-right:7%;">'.str_repeat('-', 20)."</div>";
	$txt .= '<div style="text-align:right;padding-right:7%;"><i>Total Patrocinado '.$tit_codigo." - ".trim($tit_nombre_completo).': '.trim(number_format($tot_tit,2,',','.'))."</i></div>";
	$txt .= '<div style="text-align:right;padding-right:7%;">'.str_repeat('=', 20)."</div>";
	$txt .= '<div style="text-align:right;padding-right:7%;"><b>Total Patrocinador '.$patroc_codigo." - ".trim($patroc_nombres).': '.trim(number_format($tot_pat,2,',','.'))."</b></div>";
	$txt .= '</div>';
	$txt .= '<div style="text-align:right;padding-right:7%;">'.str_repeat('=', 20)."</div>";
	$txt .= '<div style="text-align:right;padding-right:7%;"><b>TOTAL GENERAL: '.trim(number_format($tot_gen,2,',','.'))."</b></div>";
	echo $txt;
//}

include_once("pie.php");
?>
