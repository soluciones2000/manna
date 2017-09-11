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
	$query = "SELECT afiliados.patroc_codigo,afiliados.tipo_afiliado,organizacion.nivel,organizacion.organizacion,organizacion.afiliado,afiliados.enrol_codigo,afiliados.fecha_afiliacion,afiliados.tit_nombres,afiliados.tit_apellidos from afiliados inner join organizacion on (afiliados.patroc_codigo=organizacion.organizacion and afiliados.tit_codigo=organizacion.afiliado) WHERE nivel>'0' AND nivel<'4' order by patroc_codigo,afiliado,tipo_afiliado,nivel";
	$result = mysql_query($query,$link);
	$patroc_codigo = "";
	$apagar = 0.00;
	$total = 0.00;
	$first = true;
	$color = false;
	$haydatos = false;
	while($row = mysql_fetch_array($result)) {
		$fecha_afiliacion = $row["fecha_afiliacion"];
		$ano_afiliacion = substr($fecha_afiliacion,0,4);
		$mes_afiliacion = substr($fecha_afiliacion,5,2);
		if ($mes==$mes_afiliacion and $ano==$ano_afiliacion) {
			$haydatos = true;
			if ($patroc_codigo <> $row["patroc_codigo"]) {
				if (!$first) {
					if ($color) {
						echo '<div class="grupo1-total" style="text-align:right;">';
					} else {
						echo '<div class="grupo2-total" style="text-align:right;">';
					}
						echo "<b>------------------------------</b><br>";
						echo "<b>A pagar: ".number_format($apagar,2,',','.')."</b><br>";
					echo "</div>";
				}
				if ($color) {
					$color = false;
				} else {
					$color = true;
				}
				//echo "<br>";
				$first = false;
				$patroc_codigo = $row["patroc_codigo"];

				$quer2 = "SELECT tit_nombres,tit_apellidos from afiliados where afiliados.tit_codigo='".trim($patroc_codigo)."'";
				$resul2 = mysql_query($quer2,$link);
				$ro2 = mysql_fetch_array($resul2);
				$nombre = trim(utf8_encode($ro2["tit_nombres"]))." ".trim(utf8_encode($ro2["tit_apellidos"]));
				$apagar = 0.00;
				if ($color) {
					echo '<div class="grupo1" style="padding-left:5%;">';
				} else {
					echo '<div class="grupo2" style="padding-left:5%;">';
				}
					echo "<b><u>Patrocinador ".$patroc_codigo." - ".$nombre.":</u></b>";
				echo "</div>";
			}
			$organizacion = $row["organizacion"];
			$afiliado = $row["afiliado"];
			$nivel = $row["nivel"];
			$tipo_afiliado = $row["tipo_afiliado"];
			$nombre_afiliado = trim($row["tit_nombres"])." ".trim($row["tit_apellidos"]);

			$quer3 = "SELECT * from bono_afiliacion where bono_afiliacion.nivel='".trim($nivel)."'";
			$resul3 = mysql_query($quer3,$link);
			$ro3 = mysql_fetch_array($resul3);
			$level = $ro3["nivel"];
			$porcentaje = 0.00;
			$monto = 0.00;
			switch ($tipo_afiliado) {
				case 'Premium':
					$porcentaje = $ro3["premium"];
					break;
				case 'VIP':
					$porcentaje = $ro3["vip"];
					break;
				case 'Oro':
					$porcentaje = $ro3["oro"];
					break;
			}

			$quer4 = "SELECT * from transacciones where transacciones.afiliado='".trim($afiliado)."' and transacciones.tipo='01'";
			$resul4 = mysql_query($quer4,$link);
			$ro4 = mysql_fetch_array($resul4);
			$monto = $ro4["monto"];
			$documento = $ro4["documento"];
			$bancoorigen = $ro4["bancoorigen"];
			$fechadep = $ro4["fecha"];

			$comision = $monto*($porcentaje/100);
			$apagar += $comision;
			$total += $comision;
			if ($color) {
				echo '<div class="grupo1">';
			} else {
				echo '<div class="grupo2">';
			}
				echo '<div class="sangria"></div>';
				echo '<div class="codigo">'.$afiliado.'</div>';
				echo '<div class="nombre">'.$nombre_afiliado.'</div>';
				echo '<div class="tipo_af">'.trim($tipo_afiliado).'</div>';
				echo '<div class="nivel" style="text-align:center;">Nivel: '.$level.'</div>';
				echo '<div class="nivel" style="text-align:center;">'.number_format($porcentaje,0,',','.').'%</div>';
				echo '<div class="detalle" style="text-align:right;">'.number_format($monto,2,',','.').'</div>';
				echo '<div class="detalle" style="text-align:right;">'.number_format($comision,2,',','.').'</div>';
				echo '<div class="varios">Doc.: '.trim($documento).', fecha: '.$fechadep.', Banco: '.trim($bancoorigen).'</div>';
			echo "</div>";
		}
	}
	if ($haydatos) {
		if ($apagar<>0.00) {
			if ($color) {
				echo '<div class="grupo1-total" style="text-align:right;">';
			} else {
				echo '<div class="grupo2-total" style="text-align:right;">';
			}
				echo "<b>------------------------------</b><br>";
				echo "<b>A pagar: ".number_format($apagar,2,',','.')."</b><br>";
			echo "</div>";
		}
		if ($color) {
			$color = false;
		} else {
			$color = true;
		}
		if ($color) {
			echo '<div class="grupo1-total" style="text-align:right;">';
		} else {
			echo '<div class="grupo2-total" style="text-align:right;">';
		}
			echo "<b>==============================<br>";
			echo "Total general a pagar: ".number_format($total,2,',','.')."<br>";
			echo "<b>==============================</b>";
		echo "</div>";
	} else {
		echo '<br><br><div style="text-align:center">';
			echo '<h4>NO HAY DATOS PARA ESTE PERÍODO</h4>';
		echo '</div>';
	}
}
?>

</div> 
<?php
include_once("pie.php");
?>
<!--
	$query = "SELECT * FROM afiliados ORDER BY tit_codigo";
	$result = mysql_query($query,$link);
	echo "tit_codigo - patroc_codigo - enrol_codigo<br>";
	while($row = mysql_fetch_array($result)) {
		$tit_codigo = $row["tit_codigo"];
		$enrol_codigo = $row["enrol_codigo"];
		$patroc_codigo = $row["patroc_codigo"];
		echo $tit_codigo." - ".$patroc_codigo." - ".$enrol_codigo."<br>";
		$quer2 = "SELECT * FROM organizacion WHERE afiliado='".trim($tit_codigo)."' AND organizacion='".trim($patroc_codigo)."' AND nivel>'0' AND nivel<'4'";
		$resul2 = mysql_query($quer2,$link);
		echo "----------organizacion - afiliado - nivel<br>";
		while($ro2 = mysql_fetch_array($resul2)) {
			$organizacion = $ro2["organizacion"];
			$afiliado = $ro2["afiliado"];
			$nivel = $ro2["nivel"];
			echo "----------".$organizacion." - ".$afiliado." - ".$nivel."<br>";
		}
	}
**************************************************************************************************************************************************
"SELECT organizacion.organizacion,organizacion.afiliado,organizacion.nivel,afiliados.enrol_codigo,afiliados.patroc_codigo,afiliados.tipo_afiliado,afiliados.fecha_afiliacion from organizacion,afiliados WHERE organizacion.afiliado=afiliados.tit_codigo and nivel>'0' AND nivel<'4'";
**************************************************************************************************************************************************
"SELECT organizacion.patrocinio,afiliados.tipo_afiliado,organizacion.nivel,organizacion.organizacion,organizacion.afiliado,afiliados.enrol_codigo,afiliados.fecha_afiliacion from organizacion,afiliados WHERE organizacion.afiliado=afiliados.tit_codigo and nivel>'0' AND nivel<'4' order by patrocinio,tipo_afiliado,nivel";

-->