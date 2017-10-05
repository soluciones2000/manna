<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "ordenes";
include_once("menu.php");
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
$filtro = isset($_POST['filtro']) ? $_POST['filtro'] : 'Todas';
echo '<div id="cuerpo">';
	echo '<div style="text-align:center">';
		echo '<h3>GESTIONAR ORDENES<br>';
	echo '</div>';
	echo '<div style="text-align:center">';
		echo '<form name="orden" method="post" action="ordenes.php">';
			echo 'Filtro: ';
			echo '<select name="filtro" value="'.$filtro.'">';
				switch ($filtro) {
					case 'Todas':
						echo '<option value="Todas" selected>Todas</option>';
						echo '<option value="Pendiente">Pendientes</option>';
						echo '<option value="Parcialmente cancelada">Parcialmente canceladas</option>';
						echo '<option value="Cancelada por conciliar">Canceladas por conciliar</option>';
						echo '<option value="Conciliada por despachar">Conciliadas por despachar</option>';
						echo '<option value="Despachada">Desapachadas</option>';
						break;
					case 'Pendiente':
						echo '<option value="Todas">Todas</option>';
						echo '<option value="Pendiente" selected>Pendientes</option>';
						echo '<option value="Parcialmente cancelada">Parcialmente canceladas</option>';
						echo '<option value="Cancelada por conciliar">Canceladas por conciliar</option>';
						echo '<option value="Conciliada por despachar">Conciliadas por despachar</option>';
						echo '<option value="Despachada">Desapachadas</option>';
						break;
					case 'Parcialmente cancelada':
						echo '<option value="Todas">Todas</option>';
						echo '<option value="Pendiente">Pendientes</option>';
						echo '<option value="Parcialmente cancelada" selected>Parcialmente canceladas</option>';
						echo '<option value="Cancelada por conciliar">Canceladas por conciliar</option>';
						echo '<option value="Conciliada por despachar">Conciliadas por despachar</option>';
						echo '<option value="Despachada">Desapachadas</option>';
						break;
					case 'Cancelada por conciliar':
						echo '<option value="Todas">Todas</option>';
						echo '<option value="Pendiente">Pendientes</option>';
						echo '<option value="Parcialmente cancelada">Parcialmente canceladas</option>';
						echo '<option value="Cancelada por conciliar" selected>Canceladas por conciliar</option>';
						echo '<option value="Conciliada por despachar">Conciliadas por despachar</option>';
						echo '<option value="Despachada">Desapachadas</option>';
						break;
					case 'Conciliada por despachar':
						echo '<option value="Todas">Todas</option>';
						echo '<option value="Pendiente">Pendientes</option>';
						echo '<option value="Parcialmente cancelada">Parcialmente canceladas</option>';
						echo '<option value="Cancelada por conciliar">Canceladas por conciliar</option>';
						echo '<option value="Conciliada por despachar" selected>Conciliadas por despachar</option>';
						echo '<option value="Despachada">Desapachadas</option>';
						break;
					case 'Despachada':
						echo '<option value="Todas">Todas</option>';
						echo '<option value="Pendiente">Pendientes</option>';
						echo '<option value="Parcialmente cancelada">Parcialmente canceladas</option>';
						echo '<option value="Cancelada por conciliar">Canceladas por conciliar</option>';
						echo '<option value="Conciliada por despachar">Conciliadas por despachar</option>';
						echo '<option value="Despachada" selected>Desapachadas</option>';
						break;
				}
			echo '</select>';
			echo '<input type="submit" value="Cambiar">';
		echo '</form><br>';
	echo '</div>';
	if ($filtro=="Todas") {
		$query = "SELECT * from ordenes order by status_orden,orden_id";
	} else {
		$query = "SELECT * from ordenes WHERE status_orden='".trim($filtro)."' order by orden_id";
	}
	$result = mysql_query($query,$link);
	$color = true;
	echo '<div class="espacio"></div>';
	echo '<div class="codigo"><b><u># Orden</u></b></div>';

	echo '<div class="espacio"></div>';
	echo '<div class="cedula" style="text-align:center;"><b><u>Fecha</u></b></div>';

	echo '<div class="espacio"></div>';
	echo '<div class="cuenta" style="text-align:right;"><b><u>Monto con IVA</u></b></div>';

	echo '<div class="sangria"></div>';
	echo '<div class="sangria"></div>';
	echo '<div class="cuenta"><b><u>Status</u></b></div>';

	echo '<div class="sangria"></div>';
	echo '<div class="cuenta"><b><u>Acción</u></b></div>';

	echo '<br>';
	echo '<form name="gestion" method="post" action="gestion.php">';
		while($row = mysql_fetch_array($result)) {
			if ($color) {
				echo '<div class="grupo1">';
				$color = false;
			} else {
				echo '<div class="grupo2">';
				$color = true;
			}
			    $orden_id = $row["orden_id"];
				$fecha = substr(trim($row["fecha"]),8,2).'/'.substr(trim($row["fecha"]),5,2).'/'.substr(trim($row["fecha"]),0,4);
				$monto = trim($row["monto"]);
				$status_orden = trim($row["status_orden"]);
				echo '<div class="espacio"></div>';
				echo '<div class="codigo" align="center">'.$orden_id.'</div>';

				echo '<div class="espacio"></div>';
				echo '<div class="cedula">'.$fecha.'</div>';

				echo '<div class="espacio"></div>';
				echo '<div class="cuenta" style="text-align:right;">'.trim(number_format($monto,2,',','.')).'</div>';

				echo '<div class="sangria"></div>';
				echo '<div class="cuenta">'.$status_orden.'</div>';

				echo '<div class="sangria"></div>';
				echo '<div class="espacio"></div>';
				echo '<div class="espacio"></div>';
				echo '<div class="espacio"></div>';
				switch ($status_orden) {
					case 'Pendiente':
						echo '<div class="cuenta">Ninguna</div>';
						break;
					case 'Parcialmente cancelada':
						echo '<div class="cuenta">Ninguna</div>';
						break;
					case 'Cancelada por conciliar':
						echo '<div class="cuenta"><input type="checkbox" name="'.$orden_id.'"/>Conciliar</div>';
						break;
					case 'Conciliada por despachar':
						echo '<div class="cuenta"><input type="checkbox" name="'.$orden_id.'"/>Despachar</div>';
						break;
					case 'Despachada':
						echo '<div class="cuenta">Ninguna</div>';
						break;
					default:
						echo '<div class="cuenta">Ninguna</div>';
						break;
				}
				echo '<br>';
			echo "</div>";
		}
		if ($filtro=="Todas" or $filtro=="Cancelada por conciliar" or $filtro=="Conciliada por despachar") {
			echo '<br>';
			echo '<div align="center">';
			echo '<input type="submit" value="Aplicar">';
			echo '</div>';
		}
	echo '</form><br>';
			
include_once("pie.php");
?>