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
?>
