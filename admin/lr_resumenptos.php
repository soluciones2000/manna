<?php 
include_once("conexion.php");

$query = "SELECT * from afiliados order by tit_codigo";
$result = mysql_query($query,$link);
echo 'Codigo     PM          PMO<br>';
echo '==========================<br>';
while ($row = mysql_fetch_array($result)) {
	$codigo = $row["tit_codigo"];
	$pm = $row["pm"];
	$pmo = $row["pmo"];
	$quer2 = "SELECT afiliado,sum(puntos) as puntos FROM transacciones where afiliado='".trim($codigo)."' and status_comision='Pendiente' and status_comision<>'No aplica'";
	$resul2 = mysql_query($quer2,$link);
	$ro2 = mysql_fetch_array($resul2);
	if ($ro2["puntos"]>0) {
		$pm += $ro2["puntos"];
	}

	$quer3 = "SELECT afiliado FROM organizacion where organizacion='".trim($codigo)."'";
	$resul3 = mysql_query($quer3,$link);
	$pmo = 0;
	while($ro3 = mysql_fetch_array($resul3)) {
		$quer4 = "SELECT sum(puntos) as pmo FROM transacciones where afiliado='".trim($ro3["afiliado"])."' and status_comision='Pendiente' and status_comision<>'No aplica'";
		$resul4 = mysql_query($quer4,$link);
		$ro4 = mysql_fetch_array($resul4);
		$pmo += $ro4["pmo"];
		//echo $ro3["afiliado"].'-'.$ro4["pmo"].'<br>';
	}
	$pmo -= $pm;
	if ($pm+$pmo>0) {
		echo 'Total '.$codigo.'-*-'.$pm.'-*-'.$pmo.'<br>';
		//echo '<br>';
	}
}
?>
