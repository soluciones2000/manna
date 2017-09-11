<?php 
include_once("conexion.php");


$quer0 = "DELETE FROM repbonoafiliacion WHERE 1";
$resul0 = mysql_query($quer0,$link);

$query = "SELECT * FROM patrocinio order by patroc_codigo,tit_codigo";
$result = mysql_query($query,$link);
$txt = "";
while($row = mysql_fetch_array($result)) {
   	$patroc_codigo = $row["patroc_codigo"];
    $tit_codigo = $row["tit_codigo"];
    $fecha_afiliacion = $row["fecha_afiliacion"]; // del afiliado no del patrocinador
    $fecha_fin_bono =  $row["fecha_fin_bono"];

	$quer2 = "SELECT * from organizacion where organizacion.organizacion='".$tit_codigo."' and nivel>='0' AND nivel<'3' order by nivel,afiliado";
	$resul2 = mysql_query($quer2,$link);
	$m = 0;
	$d2 = false;
	$ha1 = true;
	$st = 0.00;
	while($ro2 = mysql_fetch_array($resul2)) {
		$nivel = $ro2["nivel"]+1;
		$afiliado = $ro2["afiliado"];

		$quer3 = "SELECT * from afiliados where tit_codigo='".$afiliado."'";
		$resul3 = mysql_query($quer3,$link);
		if($ro3 = mysql_fetch_array($resul3)) {
			$tipo_afiliado = $ro3["tipo_afiliado"];

			$quer4 = " SELECT * from transacciones where afiliado='".$afiliado."' and tipo='01' and fecha>='".$fecha_afiliacion."' and fecha<='".$fecha_fin_bono."' and status_comision='Pendiente'";
			$resul4 = mysql_query($quer4,$link);
			if($ro4 = mysql_fetch_array($resul4)) {
				$monto = $ro4["monto"];
				$fectr = $ro4["fecha"];

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
					$quer6 = "INSERT INTO repbonoafiliacion VALUES ('".$patroc_codigo."','".$tit_codigo."','".$fecha_afiliacion."','".$fecha_fin_bono."',".$nivel.",'".$afiliado."','".$tipo_afiliado."','".$fectr."',".$monto.",".$porcentaje.",".$comision.");";
					$resul6 = mysql_query($quer6,$link);
				}
			}
		}
	}
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="tree/css/easyTree.min.css">
    <script src="tree/js/jquery-1.10.2.min.js"></script>
    <script src="tree/js/bootstrap.min.js"></script>
    <script src="tree/js/easyTree.min.js"></script>
</head>
    <style>
        body {
            background: #eee;
        }
    </style>
</head>
<body>
<div>
    <div class="easy-tree">

<?php
$query = "SELECT * FROM repbonoafiliacion order by patroc_codigo,tit_codigo,nivel,afiliado";
if ($result = mysql_query($query,$link)) {
	$patroc_codigo = '';
	$tit_codigo = '';
	$first = true;
	$second = true;
	while($row = mysql_fetch_array($result)) {
		if ($first) {
			$patroc_codigo = $row["patroc_codigo"];
			$tit_codigo = $row["tit_codigo"];
			echo '<ul><li>patroc_codigo '.$patroc_codigo.'</li>';
			echo '<ul><li>tit_codigo '.$tit_codigo.'</li>';
			echo '<ul>';
			$first = false;
		}
		if ($patroc_codigo<>$row["patroc_codigo"]) {
			echo '</ul></ul></ul>';
			$patroc_codigo = $row["patroc_codigo"];
			$tit_codigo = $row["tit_codigo"];
			echo '<ul><li>patroc_codigo '.$patroc_codigo.'</li>';
			echo '<ul><li>tit_codigo '.$tit_codigo.'</li>';
			echo '<ul>';
		}
		if ($tit_codigo<>$row["tit_codigo"]) {
			echo '</ul></ul>';
			$tit_codigo = $row["tit_codigo"];
			echo '<ul><li>tit_codigo '.$tit_codigo.'</li>';
			echo '<ul>';
		}
		$fecha_afiliacion = $row["fecha_afiliacion"];
		$fecha_fin_bono = $row["fecha_fin_bono"];
		$nivel = $row["nivel"];
		$afiliado = $row["afiliado"];
		$tipo_afiliado = $row["tipo_afiliado"];
		$fectr = $row["fectr"];
		$monto = $row["monto"];
		$porcentaje = $row["porcentaje"];
		$comision = $row["comision"];
		echo '<li>'.'Nivel: '.$nivel." Afiliado: ".$afiliado.' Tipo: '.$tipo_afiliado.' Fecha transacción: '.$fectr. " Monto: ".trim(number_format($monto,2,',','.'))." - ".number_format($porcentaje,0,',','.')."% - Comisión: ".trim(number_format($comision,2,',','.')).'</li>';
	}
echo '</ul></ul></ul>';
}
//echo "Fin.";
?>
    </div>
</div>
<script>
    (function ($) {
        function init() {
            $('.easy-tree').EasyTree({
                addable: true,
                editable: true,
                deletable: true
            });
        }

        window.onload = init();
    })(jQuery)
</script>
</body>
</html>