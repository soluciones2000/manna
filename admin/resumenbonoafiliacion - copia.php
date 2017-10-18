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
    width: 5%;
	display: inline-block;	
}
.espacio {
    width: 2%;
	display: inline-block;	
}
.codigo {
    width: 5%;
	display: inline-block;	
}
.detalle {
    width: 9%;
	display: inline-block;	
}
.cuenta {
    width: 15%;
	display: inline-block;	
}
.banco {
    width: 10%;
	display: inline-block;	
}
.tipo_af {
    width: 5%;
	display: inline-block;	
}
.varios {
    width: 30%;
	display: inline-block;	
	padding-left: 1%;
}
.nombre {
    width: 25%;
	display: inline-block;	
}
.nivel {
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
	padding-left: 10%;
	padding-right: 58.5%;
}
.grupo2-total {
	background-color: none;
	padding-left: 10%;
	padding-right: 58.5%;
}
</style>
<?php
$mes = isset($_POST['mes']) ? $_POST['mes'] : null;
$ano = isset($_POST['ano']) ? $_POST['ano'] : null;
echo '<div id="cuerpo">';
	echo '<div style="text-align:center">';
		echo '<h3>RESUMEN DE COMISIONES A PAGAR MES: '.$mes.'/'.$ano.'</h3>';
	echo '</div>';

if (isset($mes) and isset($ano)) {
	$query = "SELECT patrocinio.*,afiliados.tit_nombres,afiliados.tit_apellidos,afiliados.tit_cedula,afiliados.banco_numero_cta,afiliados.banco_nombre_bco,afiliados.email FROM patrocinio inner join afiliados on patrocinio.patroc_codigo=afiliados.tit_codigo order by patrocinio.patroc_codigo,patrocinio.tit_codigo";
	$result = mysql_query($query,$link);
	$txt = "";
	$tx1 = "";
	$tx2 = "";
	$texto = "";
	$namept = "";
	$patroc_codigo = "";
	$tp = 0.00;
	$tg = 0.00;
	$color = false;
	echo '<div class="espacio"></div>';
	echo '<div class="codigo" style="text-align:center;"><b><u>Código</u></b></div>';
	echo '<div class="nombre" style="text-align:center;"><b><u>Nombre</u></b></div>';
	echo '<div class="detalle" style="text-align:right;"><b><u>Monto</u></b></div>';
	echo '<div class="detalle" style="text-align:right;"><b><u>Cédula</u></b></div>';
	echo '<div class="espacio"></div>';
	echo '<div class="cuenta" style="text-align:center;"><b><u>No. de cuenta</u></b></div>';
	echo '<div class="banco"><b><u>Banco</u></b></div>';
	echo '<div class="espacio"></div>';
	echo '<div class="detalle"><b><u>e-mail</u></b></div>';
	echo '<br>';
	while($row = mysql_fetch_array($result)) {
		if ($patroc_codigo<>$row["patroc_codigo"]) {
			if ($color) {
				echo '<div class="grupo1" style="padding-left:1%;">';
				$color = false;
			} else {
				echo '<div class="grupo2" style="padding-left:1%;">';
				$color = true;
			}
			if ($tp<>0.00) {
				echo '<div class="espacio"></div>';
				echo '<div class="codigo">'.$patroc_codigo.'</div>';
				echo '<div class="nombre">'.$namept.'</div>';
				echo '<div class="detalle" style="text-align:right;">'.number_format($tp,2,',','.').'</div>';
				echo '<div class="detalle" style="text-align:right;">'.number_format(strval($cid),0,',','.').'</div>';
				echo '<div class="espacio"></div>';
				echo '<div class="cuenta">'.$cta.'</div>';
				echo '<div class="banco">'.$bco.'</div>';
				echo '<div class="espacio"></div>';
				echo '<div class="detalle">'.$correo.'</div>';
				echo '<br>';
				$tp = 0.00;
			}
			echo "</div>";
		    $patroc_codigo = $row["patroc_codigo"];
//			$nom = $row["tit_nombres"];
//			$ape = $row["tit_apellidos"];
			$cid = trim($row["tit_cedula"]);
			$correo = trim($row["email"]);
			$cta = trim($row["banco_numero_cta"]);
			$cta = substr($cta,strlen($cta)-20,4).'-'.substr($cta,strlen($cta)-16,4).'-'.substr($cta,strlen($cta)-12,2).'-'.substr($cta,strlen($cta)-10,10);
			$bco = trim($row["banco_nombre_bco"]);
			$namept = utf8_encode(trim($row["tit_nombres"])." ".trim($row["tit_apellidos"]));
		}
	    $tit_codigo = $row["tit_codigo"];
	    $fecha_afiliacion = $row["fecha_afiliacion"]; // del afiliado no del patrocinador
	    $fecha_fin_bono =  $row["fecha_fin_bono"];

		$quer2 = "SELECT * from organizacion where organizacion.organizacion='".$tit_codigo."' and nivel>='0' AND nivel<'3' order by nivel,afiliado";
		$resul2 = mysql_query($quer2,$link);
		$m = 0;
		$d2 = false;
		$st = 0.00;
		while($ro2 = mysql_fetch_array($resul2)) {
			$d2 = true;
			$nivel = $ro2["nivel"]+1;
			$afiliado = $ro2["afiliado"];

			$quer3 = "SELECT tipo_afiliado from afiliados where tit_codigo='".$afiliado."'";
			$resul3 = mysql_query($quer3,$link);
			if($ro3 = mysql_fetch_array($resul3)) {
				$d2 = true;
				$tipo_afiliado = $ro3["tipo_afiliado"];

				$quer4 = " SELECT * from transacciones where afiliado='".$afiliado."' and tipo='01' and fecha>='".$fecha_afiliacion."' and fecha<='".$fecha_fin_bono."' and status_comision='Pendiente'";
				$resul4 = mysql_query($quer4,$link);
				if($ro4 = mysql_fetch_array($resul4)) {
					$d2 = true;
					$monto = $ro4["monto"];

					$quer5 = "SELECT * from bono_afiliacion where bono_afiliacion.nivel='".trim($nivel)."'";
					$resul5 = mysql_query($quer5,$link);
					$ro5 = mysql_fetch_array($resul5);
					$porcentaje = 0.00;
					switch ($tipo_afiliado) {
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
					if ($monto<>0.00) {
						$tp += $comision;
						$tg += $comision;
					} else {
						$d2 = false;
					}
				} else {
					$d2 = false;
				}
			} else {
				$d2 = false;
			}
		}
	}
	if ($tp<>0.00) {
		if ($color) {
			echo '<div class="grupo1" style="padding-left:1%;">';
		} else {
			echo '<div class="grupo2" style="padding-left:1%;">';
		}
		echo '<div class="espacio"></div>';
		echo '<div class="codigo">'.$patroc_codigo.'</div>';
		echo '<div class="nombre">'.$namept.'</div>';
		echo '<div class="detalle" style="text-align:right;">'.number_format(strval($cid),0,',','.').'</div>';
		echo '<div class="detalle" style="text-align:right;">'.number_format($tp,2,',','.').'</div>';
		echo '<div class="espacio"></div>';
		echo '<div class="cuenta">'.$cta.'</div>';
		echo '<div class="banco">'.$bco.'</div>';
		echo '<div class="espacio"></div>';
		echo '<div class="detalle">'.$correo.'</div>';
		echo "</div>";
	}
	if ($tg<>0.00) {
		if ($color) {
			echo '<div class="grupo2-total" style="text-align:right;">';
		} else {
			echo '<div class="grupo1-total" style="text-align:right;">';
		}
		/*
		if ($color) {
			echo '<div class="grupo2">';
		} else {
			echo '<div class="grupo1">';
		}
		*/
		echo "<br><b>TOTAL GENERAL A PAGAR Bs. ".trim(number_format($tg,2,',','.'))."</b><br><br>";
		echo "</div>";
	}
}

include_once("pie.php");
?>
