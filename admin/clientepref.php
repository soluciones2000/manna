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
    width: 1%;
	display: inline-block;	
}
.codigo {
    width: 6%;
	display: inline-block;	
}
.codigo2 {
    width: 3%;
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
.nombre2 {
    width: 32%;
	display: inline-block;	
}
.nombre3 {
    width: 29%;
	display: inline-block;	
}
.telefono {
    width: 10%;
	display: inline-block;	
}
.correo {
    width: 15%;
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
		echo '<h3>CLIENTES PREFERENCIALES<br>';
		echo 'Desde el código: <font color="red">'.trim($dsd).'</font> hasta el código: <font color="red">'.trim($hst).'</font><br></h3>';
	echo '</div>';
	echo '<div style="text-align:center">';
		echo '<form name="orden" method="post" action="clientepref.php">';
		echo 'Orden: ';
			echo '<input type="hidden" name="cod_desde" value="'.$dsd.'">';
			echo '<input type="hidden" name="cod_hasta" value="'.$hst.'">';
			switch ($orden) {
				case 'cod_clte':
					$sorden = 'cod_clte';
					echo '<input type="radio" name="orden" value="cod_clte" checked> Código cliente ';
					echo '<input type="radio" name="orden" value="clte_nombre"> Nombre cliente ';
					echo '<input type="radio" name="orden" value="patroc_codigo"> Código patrocinante ';
					echo '<input type="radio" name="orden" value="patroc_nombre"> Nombre Patrocinante';
					break;
				case 'clte_nombre':
					$sorden = 'clte_nombre';
					echo '<input type="radio" name="orden" value="cod_clte"> Código cliente ';
					echo '<input type="radio" name="orden" value="clte_nombre" checked> Nombre cliente ';
					echo '<input type="radio" name="orden" value="patroc_codigo"> Código patrocinante ';
					echo '<input type="radio" name="orden" value="patroc_nombre"> Nombre Patrocinante';
					break;
				case 'patroc_codigo':
					$sorden = 'patroc_codigo';
					echo '<input type="radio" name="orden" value="cod_clte"> Código cliente ';
					echo '<input type="radio" name="orden" value="clte_nombre"> Nombre cliente ';
					echo '<input type="radio" name="orden" value="patroc_codigo" checked> Código patrocinante ';
					echo '<input type="radio" name="orden" value="patroc_nombre"> Nombre Patrocinante';
					break;
				case 'patroc_nombre':
					$sorden = 'patroc_nombre';
					echo '<input type="radio" name="orden" value="cod_clte"> Código cliente ';
					echo '<input type="radio" name="orden" value="clte_nombre"> Nombre cliente ';
					echo '<input type="radio" name="orden" value="patroc_codigo"> Código patrocinante ';
					echo '<input type="radio" name="orden" value="patroc_nombre" checked> Nombre Patrocinante';
					break;
				default:
					$sorden = 'cod_clte';
					echo '<input type="radio" name="orden" value="cod_clte" checked> Código cliente ';
					echo '<input type="radio" name="orden" value="clte_nombre"> Nombre cliente ';
					echo '<input type="radio" name="orden" value="patroc_codigo"> Código patrocinante ';
					echo '<input type="radio" name="orden" value="patroc_nombre"> Nombre Patrocinante';
					break;
			}
			echo '<input type="submit" value="Cambiar">';
		echo '</form><br>';
	echo '</div>';
	if ($dsd<>'Primero') {

		if ($hst<>'Último') {
			$query = "SELECT cliente_preferencial.*,concat(afiliados.tit_nombres,' ',afiliados.tit_apellidos) as patroc_nombre from cliente_preferencial left outer join afiliados on cliente_preferencial.patroc_codigo=afiliados.tit_codigo WHERE patroc_codigo>='".trim($dsd)."' AND patroc_codigo<='".trim($hst)."' order by ".$sorden;
		} else {
			$query = "SELECT cliente_preferencial.*,concat(afiliados.tit_nombres,' ',afiliados.tit_apellidos) as patroc_nombre from cliente_preferencial left outer join afiliados on cliente_preferencial.patroc_codigo=afiliados.tit_codigo WHERE tit_codigo>='".trim($dsd)."' order by ".$sorden;
		}
	} else {
		if ($hst<>'Último') {
			$query = "SELECT cliente_preferencial.*,concat(afiliados.tit_nombres,' ',afiliados.tit_apellidos) as patroc_nombre from cliente_preferencial left outer join afiliados on cliente_preferencial.patroc_codigo=afiliados.tit_codigo WHERE tit_codigo<='".trim($hst)."' order by ".$sorden;
		} else {
			$query = "SELECT cliente_preferencial.*,concat(afiliados.tit_nombres,' ',afiliados.tit_apellidos) as patroc_nombre from cliente_preferencial left outer join afiliados on cliente_preferencial.patroc_codigo=afiliados.tit_codigo order by ".$sorden;
		}
	}
	$result = mysql_query($query,$link);
	$color = true;
	echo '<div class="espacio"></div>';
	echo '<div class="nombre2"><b><u>Cliente preferencial</u></b></div>';
	echo '<div class="espacio"></div>';
	echo '<div class="cedula" style="text-align:right;"><b><u>Cédula</u></b></div>';
	echo '<div class="espacio"></div>';
	echo '<div class="telefono"><b><u>Teléfono</u></b></div>';
	echo '<div class="espacio"></div>';
	echo '<div class="correo"><b><u>e-mail</u></b></div>';
	echo '<div class="espacio"></div>';
	echo '<div class="nombre3"><b><u>Patrocinante</u></b></div>';
	echo '<br>';
	echo "</div>";
	while($row = mysql_fetch_array($result)) {
		if ($color) {
			echo '<div class="grupo1">';
			$color = false;
		} else {
			echo '<div class="grupo2">';
			$color = true;
		}
	    $cod_clte = $row["cod_clte"];
		$clte_nombre = trim($row["clte_nombre"]);
		$clte_cedula = trim($row["clte_cedula"]);
		$clte_telefono = trim($row["clte_telefono"]);
		$clte_email = trim($row["clte_email"]);
		$patroc_codigo = trim($row["patroc_codigo"]);
		$patroc_nombre = trim($row["patroc_nombre"]);

		echo '<div class="espacio"></div>';
		echo '<div class="codigo" align="center">'.$cod_clte.'</div>';
		echo '<div class="espacio"></div>';
		echo '<div class="nombre">'.utf8_encode($clte_nombre).'</div>';
		echo '<div class="espacio"></div>';
		echo '<div class="cedula" style="text-align:right;">'.trim(number_format($clte_cedula,0,',','.')).'</div>';
		echo '<div class="espacio"></div>';
		echo '<div class="telefono">'.$clte_telefono.'</div>';
		echo '<div class="espacio"></div>';
		echo '<div class="correo">'.$clte_email.'</div>';
		echo '<div class="espacio"></div>';
		echo '<div class="codigo2">'.$patroc_codigo.'</div>';
		echo '<div class="espacio"></div>';
		echo '<div class="nombre">'.$patroc_nombre.'</div>';


		echo '<br>';
		echo "</div>";
	}

include_once("pie.php");
?>
