<?php 

function piernas($codigo,$calif_pierna,$link){
	$query = "SELECT afiliado from organizacion WHERE organizacion='".$codigo."' and nivel>0";
	if ($result = mysql_query($query,$link)){
		$piernas = 0;
		while($row = mysql_fetch_array($result)) {
			$afil = $row["afiliado"];
			$quer2 = "SELECT rango from afiliados WHERE tit_codigo='".$afil."'";;
			if ($resul2 = mysql_query($quer2,$link)){
				$ro2 = mysql_fetch_array($resul2);
				if ($ro2["rango"]==$calif_pierna) { $piernas++; }
			}
		}
		return $piernas;
	} else {
		return 0;
	}
}

function premium($codigo){
	$fecha = date('Y-m-d');
	$mes = substr($fecha,5,2);
	$query = "SELECT sum(tit_codigo) as premium from afiliados WHERE enrol_codigo='".$codigo."' and tipo_afiliado='Premium' and mes_afiliacion='".trim($mes)."'";
	$result = mysql_query($query,$link);
	if ($row = mysql_fetch_array($result)) {
		$premium = $row["afiliado"];
	} else {
		$premium = 0;
	}
	return $premium;
}


function calificacion($codigo,$pm,$pmo,$link){
	$query = "SELECT rango from afiliados WHERE tit_codigo='".$codigo."'";
	$result = mysql_query($query,$link);
	$row = mysql_fetch_array($result);
	$rango_ant = $row["rango"];

	$query = "SELECT * from unilevel WHERE rango_ant='".$rango_ant."'";
	$result = mysql_query($query,$link);
	$row = mysql_fetch_array($result);
	$rango = $row["rango"];
	$cpm = $row["pm"];
	$cpmo = $row["pmo"];
	$cpiernas = $row["piernas"];
	$calif_piernas = $row["calif_piernas"];

	$piernas = 0;
	if ($cpiernas>0) {
		$query = "SELECT afiliado from organizacion WHERE organizacion='".$codigo."' and nivel>0";
		if ($result = mysql_query($query,$link)){
			while($row = mysql_fetch_array($result)) {
				$afil = $row["afiliado"];
				$quer2 = "SELECT rango from afiliados WHERE tit_codigo='".$afil."'";;
				if ($resul2 = mysql_query($quer2,$link)){
					$ro2 = mysql_fetch_array($resul2);
					if ($ro2["rango"]==$calif_piernas) { $piernas++; }
				}
			}
		} else {
			$piernas = 0;
		}
	}
	if ($pm>=$cpm and $pmo>=$cpmo and $piernas>=$cpiernas) {
		$flag = true;
		$query = "UPDATE afiliados SET rango='".$rango."',flag='".$flag."' WHERE tit_codigo='".trim($codigo)."'";
		$result = mysql_query($query,$link);
	}
}

?>
