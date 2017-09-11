<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "bonos";
include_once("menu.php");
?>
<style>
.sangria {
    width: 5%;
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

$mes = isset($_POST['mes']) ? $_POST['mes'] : null;
$ano = isset($_POST['ano']) ? $_POST['ano'] : null;
echo '<div id="cuerpo">';
	echo '<div style="text-align:center">';
		echo '<h3>REPORTE DE COMISIONES A PAGAR MES: '.$mes.'/'.$ano.'</h3>';
	echo '</div>';

if (isset($mes) and isset($ano)) {
	$query = "SELECT * FROM patrocinio order by patroc_codigo,tit_codigo";
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
				echo "<b>Subtotal patrocinador: ".$patroc_codigo." ".$namept." - ".trim(number_format($tp,2,',','.'))."</b><br><br>";
				$tp = 0.00;
			}
			echo "</div>";
		    $patroc_codigo = $row["patroc_codigo"];
			if ($color) {
				echo '<div class="grupo1" style="padding-left:1%;">';
			} else {
				echo '<div class="grupo2" style="padding-left:1%;">';
			}
			$quer6 = "SELECT tit_nombres,tit_apellidos from afiliados where tit_codigo='".$patroc_codigo."'";
			$resul6 = mysql_query($quer6,$link);
			if($ro6 = mysql_fetch_array($resul6)) {
				$nom = $ro6["tit_nombres"];
				$ape = $ro6["tit_apellidos"];
				$namept = trim($nom)." ".trim($ape);
			} else {
				$namept = "";
			}
		    echo "<b><u>Patrocinador: ".$patroc_codigo." ".$namept."</u></b><br>";
			echo "</div>";
		}
	    $tit_codigo = $row["tit_codigo"];
	    $fecha_afiliacion = $row["fecha_afiliacion"]; // del afiliado no del patrocinador
	    $fecha_fin_bono =  $row["fecha_fin_bono"];
	    $tx1 = "";
	    $tx2 = "";
		$quer6 = "SELECT tit_nombres,tit_apellidos from afiliados where tit_codigo='".$tit_codigo."'";
		$resul6 = mysql_query($quer6,$link);
		if($ro6 = mysql_fetch_array($resul6)) {
			$nom = $ro6["tit_nombres"];
			$ape = $ro6["tit_apellidos"];
			$namep2 = trim($nom)." ".trim($ape);
		} else {
			$namep2 = "";
		}
		$tx2 = "Patrocinado: ".$tit_codigo." ".$namep2." - ".$fecha_afiliacion." - ".$fecha_fin_bono."<br>";

		$quer2 = "SELECT * from organizacion where organizacion.organizacion='".$tit_codigo."' and nivel>='0' AND nivel<'3' order by nivel,afiliado";
		$resul2 = mysql_query($quer2,$link);
		$m = 0;
		$d2 = false;
		$ha1 = true;
		$st = 0.00;
		while($ro2 = mysql_fetch_array($resul2)) {
			if ($ha1) {
				$txt .= $tx1;
				$ha1 = false;
			}
			$d2 = true;
			$nivel = $ro2["nivel"]+1;
			$afiliado = $ro2["afiliado"];
		    $tx1 = "";

			$quer3 = "SELECT * from afiliados where tit_codigo='".$afiliado."'";
			$resul3 = mysql_query($quer3,$link);
			if($ro3 = mysql_fetch_array($resul3)) {
				$nom = $ro3["tit_nombres"];
				$ape = $ro3["tit_apellidos"];
				$nameaf = trim($nom)." ".trim($ape);
				$tx1 = "Nivel: ".$nivel." Afiliado: ".$afiliado." ".$nameaf." ";
				$d2 = true;
				$tipo_afiliado = $ro3["tipo_afiliado"];
				$tx1 .= "- Tipo: ".$tipo_afiliado." ";

				$quer4 = " SELECT * from transacciones where afiliado='".$afiliado."' and tipo='01' and fecha>='".$fecha_afiliacion."' and fecha<='".$fecha_fin_bono."' and status_comision='Pendiente'";
				$resul4 = mysql_query($quer4,$link);
				if($ro4 = mysql_fetch_array($resul4)) {
					$d2 = true;
					$monto = $ro4["monto"];
					$fectr = $ro4["fecha"];
					$tx1 .= "- Fecha: ".$fectr." ";

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
					$tx1 .= " Monto: ".trim(number_format($monto,2,',','.'))." - ".number_format($porcentaje,0,',','.')."% - Comisión: ".trim(number_format($comision,2,',','.'))."<br>";
					if ($monto<>0.00) {
						$st += $comision;
						$tp += $comision;
						$tg += $comision;
						if ($color) {
							echo '<div class="grupo1" style="padding-left:3%;">';
						} else {
							echo '<div class="grupo2" style="padding-left:3%;">';
						}
						echo $tx2;
						echo "</div>";
						$tx2 = "";
						$txt .= $tx1;
						$tx1 = "";
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
		if ($d2) {
			if ($color) {
				echo '<div class="grupo1" style="padding-left:5%;">';
			} else {
				echo '<div class="grupo2" style="padding-left:5%;">';
			}
			echo $txt;
			echo "</div>";
			$txt = "";
		}
		if ($st<>0.00) {
			if ($color) {
				echo '<div class="grupo1" style="padding-left:3%;">';
			} else {
				echo '<div class="grupo2" style="padding-left:3%;">';
			}
			echo "Subtotal patrocinado: ".$tit_codigo." - ".trim(number_format($st,2,',','.'))."<br><br>";
			echo "</div>";
			$st = 0.00;
		}
	}
	if ($tp<>0.00) {
		if ($color) {
			echo '<div class="grupo1" style="padding-left:1%;">';
		} else {
			echo '<div class="grupo2" style="padding-left:1%;">';
		}
		echo "<b>Subtotal patrocinador: ".$patroc_codigo." ".$namept." - ".trim(number_format($tp,2,',','.'))."</b><br><br>";
		echo "</div>";
	}
	if ($tg<>0.00) {
		if ($color) {
			echo '<div class="grupo2">';
		} else {
			echo '<div class="grupo1">';
		}
		echo "<br><b>TOTAL GENERAL A PAGAR: ".trim(number_format($tg,2,',','.'))."</b><br><br>";
	}
}

include_once("pie.php");
?>
