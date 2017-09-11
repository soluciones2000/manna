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
    width: 25%;
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
.telefono {
    width: 30%;
	display: inline-block;	
}
.telefono2 {
    width: 28%;
	display: inline-block;	
}
.correo {
    width: 20%;
	display: inline-block;	
}
.cedula {
    width: 6%;
	display: inline-block;	
}
.tipoafiliado {
    width: 6%;
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
	padding-right: 46.5%;
}
.grupo2-total {
	background-color: none;
	padding-left: 10%;
	padding-right: 46.5%;
}
</style>
<?php
$orden = isset($_POST['orden']) ? $_POST['orden'] : 'codigo';

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
echo '<div id="cuerpo">';
	echo '<div style="text-align:center">';
		echo '<h3>DATOS BÁSICOS DE LOS AFILIADOS<br>';
		echo 'Desde el código: <font color="red">'.trim($dsd).'</font> hasta el código: <font color="red">'.trim($hst).'</font><br></h3>';
	echo '</div>';
	echo '<div style="text-align:center">';
		echo '<form name="orden" method="post" action="datosbasicos.php">';
		echo 'Orden: ';
			echo '<input type="hidden" name="cod_desde" value="'.$dsd.'">';
			echo '<input type="hidden" name="cod_hasta" value="'.$hst.'">';
			switch ($orden) {
				case 'codigo':
					$sorden = 'tit_codigo';
					echo '<input type="radio" name="orden" value="codigo" checked> Código ';
					echo '<input type="radio" name="orden" value="nombre"> Nombre ';
					echo '<input type="radio" name="orden" value="tipo"> Tipo de afiliado ';
					break;
				case 'nombre':
					$sorden = 'tit_nombres';
					echo '<input type="radio" name="orden" value="codigo"> Código ';
					echo '<input type="radio" name="orden" value="nombre" checked> Nombre ';
					echo '<input type="radio" name="orden" value="tipo"> Tipo de afiliado ';
					break;
				case 'tipo':
					$sorden = 'tipo_afiliado';
					echo '<input type="radio" name="orden" value="codigo"> Código ';
					echo '<input type="radio" name="orden" value="nombre"> Nombre ';
					echo '<input type="radio" name="orden" value="tipo" checked> Tipo de afiliado ';
					break;
				default:
					$sorden = 'tit_codigo';
					echo '<input type="radio" name="orden" value="codigo" checked> Código ';
					echo '<input type="radio" name="orden" value="nombre"> Nombre ';
					echo '<input type="radio" name="orden" value="tipo"> Tipo de afiliado ';
					break;
			}
			echo '<input type="submit" value="Cambiar">';
		echo '</form><br>';
	echo '</div>';
	if ($dsd<>'Primero') {
		if ($hst<>'Último') {
			$query = "SELECT * FROM afiliados WHERE tit_codigo>='".trim($dsd)."' AND tit_codigo<='".trim($hst)."' order by ".$sorden;
		} else {
			$query = "SELECT * FROM afiliados WHERE tit_codigo>='".trim($dsd)."' order by ".$sorden;
		}
	} else {
		if ($hst<>'Último') {
			$query = "SELECT * FROM afiliados WHERE tit_codigo<='".trim($hst)."' order by ".$sorden;
		} else {
			$query = "SELECT * FROM afiliados order by ".$sorden;
		}
	}
	$result = mysql_query($query,$link);
	$color = true;
	echo '<div class="espacio"></div>';
	echo '<div class="codigo"><b><u>Código</u></b></div>';
	echo '<div class="nombre" style="text-align:center;"><b><u>Nombre</u></b></div>';
	echo '<div class="cedula" style="text-align:right;"><b><u>Cédula</u></b></div>';
	echo '<div class="espacio"></div>';
	echo '<div class="espacio"></div>';
	echo '<div class="telefono2"><b><u>Teléfono</u></b></div>';
//	echo '<div class="espacio"></div>';
	echo '<div class="correo"><b><u>e-mail</u></b></div>';
	echo '<div class="espacio"></div>';
	echo '<div class="tipoafiliado"><b><u>Tipo</u></b></div>';
	echo '<br>';
	echo "</div>";
	while($row = mysql_fetch_array($result)) {
		if ($color) {
			echo '<div class="grupo1" style="padding-left:1%;">';
			$color = false;
		} else {
			echo '<div class="grupo2" style="padding-left:1%;">';
			$color = true;
		}
	    $tit_codigo = $row["tit_codigo"];
		$name = trim($row["tit_nombres"])." ".trim($row["tit_apellidos"]);
		$cid = trim($row["tit_cedula"]);
		$correo = trim($row["email"]);
		$tlf = trim($row["tel_local"]).' / '.trim($row["tel_celular"]);
		$tipo_afiliado = trim($row["tipo_afiliado"]);
		echo '<div class="espacio"></div>';
		echo '<div class="codigo">'.$tit_codigo.'</div>';
		echo '<div class="nombre">'.utf8_encode($name).'</div>';
		echo '<div class="cedula" style="text-align:right;">'.trim(number_format($cid,0,',','.')).'</div>';
		echo '<div class="espacio"></div>';
		echo '<div class="telefono">'.$tlf.'</div>';
//		echo '<div class="espacio"></div>';
		echo '<div class="correo">'.$correo.'</div>';
		echo '<div class="espacio"></div>';
		echo '<div class="tipoafiliado">'.$tipo_afiliado.'</div>';
		echo '<br>';
		echo "</div>";
	}

include_once("pie.php");
?>
