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
	if ($dsd<>'Primero') {
		if ($hst<>'Último') {
			$query = "SELECT * FROM v_patrocinio WHERE patroc_codigo>='".trim($dsd)."' AND patroc_codigo<='".trim($hst)."' order by patroc_codigo,tit_codigo";
		} else {
			$query = "SELECT * FROM v_patrocinio WHERE patroc_codigo>='".trim($dsd)."' order by patroc_codigo,tit_codigo";
		}
	} else {
		if ($hst<>'Último') {
			$query = "SELECT * FROM v_patrocinio WHERE patroc_codigo<='".trim($hst)."' order by patroc_codigo,tit_codigo";
		} else {
			$query = "SELECT * FROM v_patrocinio order by patroc_codigo,tit_codigo";
		}
	}
	$result = mysql_query($query,$link);
	$patroc_codigo = "";
    $tit_codigo = "";
	$tgn = 0.00;
	$tp2 = 0.00;
	$tpt = 0.00;
	$color = false;
	$txt = "";
	$first = true;
	while($row = mysql_fetch_array($result)) {
		if ($first and $row["patroc_codigo"]<>$row["tit_codigo"]) {
		    $patroc_codigo = $row["patroc_codigo"];
			$namept = utf8_encode(trim($row["nombres_patroc"])." ".trim($row["apellidos_patroc"]));
			$taf = $row["tipo_afiliado"];
		    $tit_codigo = $row["tit_codigo"];
			$namep2 = utf8_encode(trim($row["nombres"])." ".trim($row["apellidos"]));
	    	$fecha_afiliacion = $row["fecha_afiliacion"]; // del afiliado no del patrocinador
	    	$fecha_fin_bono =  $row["fecha_fin_bono"];
	    	echo $patroc_codigo." ".$tit_codigo." first <br>";

			$quer5 = "SELECT * from bono_afiliacion order by nivel";
			$resul5 = mysql_query($quer5,$link);
			$i=1;
			while($ro5 = mysql_fetch_array($resul5)) {
				switch ($taf) {
					case 'Premium':
						$porcentaje[$i++] = $ro5["premium"];
						break;
					case 'VIP':
						$porcentaje[$i++] = $ro5["vip"];
						break;
					case 'Oro':
						$porcentaje[$i++] = $ro5["oro"];
						break;
				}
			}
		    $tx1 = "0<b><u>1Patrocinador: ".$patroc_codigo." ".$namept."</u></b><br>";
			$tx2 = "0Patrocinado: ".$tit_codigo." ".$namep2." - Afiliado el ".substr($fecha_afiliacion,8,2)."/".substr($fecha_afiliacion,5,2)."/".substr($fecha_afiliacion,0,4).", fecha fin bono: ".substr($fecha_fin_bono,8,2)."/".substr($fecha_fin_bono,5,2)."/".substr($fecha_fin_bono,0,4)."<br>";
			$first = false;
		}
		if ($patroc_codigo<>$row["patroc_codigo"] and $row["patroc_codigo"]<>$row["tit_codigo"]) {
			if ($tp2<>0.00) {
				$tx4 = "1<b>Subtotal patrocinado: ".$tit_codigo." ".$namep2." - ".trim(number_format($tp2,2,',','.'))."</b><br><br>";
				$tp2 = 0.00;
			}
			if ($tpt<>0.00) {
				$tx5 = "1<b>Subtotal patrocinador: ".$patroc_codigo." ".$namept." - ".trim(number_format($tpt,2,',','.'))."</b><br><br>";
				echo "entró<br>".$tx1.$tx2.$tx3.$tx4.$tx5;
				$tx3 = "";
				$tpt = 0.00;
				$txt = "";
			}

		    $patroc_codigo = $row["patroc_codigo"];
			$namept = utf8_encode(trim($row["nombres_patroc"])." ".trim($row["apellidos_patroc"]));
			$taf = $row["tipo_afiliado"];
		    $tit_codigo = $row["tit_codigo"];
			$namep2 = utf8_encode(trim($row["nombres"])." ".trim($row["apellidos"]));
	    	$fecha_afiliacion = $row["fecha_afiliacion"]; // del afiliado no del patrocinador
	    	$fecha_fin_bono =  $row["fecha_fin_bono"];
	    	echo $patroc_codigo." ".$tit_codigo." patroc <br>";

			$quer5 = "SELECT * from bono_afiliacion order by nivel";
			$resul5 = mysql_query($quer5,$link);
			$i=1;
			while($ro5 = mysql_fetch_array($resul5)) {
				switch ($taf) {
					case 'Premium':
						$porcentaje[$i++] = $ro5["premium"];
						break;
					case 'VIP':
						$porcentaje[$i++] = $ro5["vip"];
						break;
					case 'Oro':
						$porcentaje[$i++] = $ro5["oro"];
						break;
				}
			}
		    $tx1 = "1<b><u>1Patrocinador: ".$patroc_codigo." ".$namept."</u></b><br>";
			$tx2 = "1Patrocinado: ".$tit_codigo." ".$namep2." - Afiliado el ".substr($fecha_afiliacion,8,2)."/".substr($fecha_afiliacion,5,2)."/".substr($fecha_afiliacion,0,4).", fecha fin bono: ".substr($fecha_fin_bono,8,2)."/".substr($fecha_fin_bono,5,2)."/".substr($fecha_fin_bono,0,4)."<br>";
		}
		if ($tit_codigo<>$row["tit_codigo"] and $row["patroc_codigo"]<>$row["tit_codigo"]) {
			if ($tp2<>0.00) {
				$tx4 = "2<b>Subtotal patrocinado: ".$tit_codigo." ".$namep2." - ".trim(number_format($tp2,2,',','.'))."</b><br><br>";
				echo $tx2.$tx3.$tx4;
				$tx3 = "";
				$tp2 = 0.00;
				$txt = "";
			}
	    	echo $patroc_codigo." ".$tit_codigo." tit <br>";

		    $tit_codigo = $row["tit_codigo"];
			$namep2 = utf8_encode(trim($row["nombres"])." ".trim($row["apellidos"]));
	    	$fecha_afiliacion = $row["fecha_afiliacion"]; // del afiliado no del patrocinador
	    	$fecha_fin_bono =  $row["fecha_fin_bono"];

			$tx2 = "2Patrocinado: ".$tit_codigo." ".$namep2." - Afiliado el ".substr($fecha_afiliacion,8,2)."/".substr($fecha_afiliacion,5,2)."/".substr($fecha_afiliacion,0,4).", fecha fin bono: ".substr($fecha_fin_bono,8,2)."/".substr($fecha_fin_bono,5,2)."/".substr($fecha_fin_bono,0,4)."<br>";
		}
		if ($row["patroc_codigo"]<>$row["tit_codigo"]) {
			$quer2 = "SELECT * from v_afiliacion where organizacion='".$tit_codigo."' and tipo='01' and fecha>='".$fecha_afiliacion."' and fecha<='".$fecha_fin_bono."' and status_comision='Pendiente' and nivel<>0";
			$resul2 = mysql_query($quer2,$link);
			if ($ro2 = mysql_fetch_array($resul2)) {
				$nivel = $ro2["nivel"];
			    $afiliado = $ro2["afiliado"];
				$nameaf = utf8_encode(trim($ro2["nom"])." ".trim($ro2["ape"]));
				$fectr = $ro2["fecha"];
				$monto = $ro2["monto"];
				$comision = $monto*($porcentaje[$nivel]/100);
	    	echo $patroc_codigo." ".$tit_codigo." nivel <br>";
				//if ($comision<>0.00) {
					$tp2 += $comision;
					$tpt += $comision;
					$tgn += $comision;
					$tx3 .= "3".$patroc_codigo." ".$tit_codigo." Nivel: ".$nivel." Afiliado: ".$afiliado." ".$nameaf." - Fecha: ".$fectr." Monto: ".trim(number_format($monto,2,',','.'))." - ".number_format($porcentaje[$nivel],0,',','.')."% - Comisión: ".trim(number_format($comision,2,',','.'))."<br>";
				//}
			}
		}
	}
}
include_once("pie.php");
?>
