<?php 
	include_once("conexion.php");
	include_once("cabecera.php");
	$menu = "consultas";
	include_once("menu.php");
	$men2 = "transacciones";
	include_once("consultas.php");
?>
<!-- 
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Consulta de órdenes</title>
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
 -->
 	<br>
 	<div class="main-container">
		<div>
			<label for="orden"><b>Código de afiliado: </b></label>
			<input class="box-btn" type="text" id="codigo" name="codigo" maxlength="5" size="5" onkeyup="this.value = this.value.toUpperCase();" onchange="busca_transacciones()">
			<input type="button" onclick="busca_transacciones()" value="Buscar" />
			<input type="button" onclick="limpiar()" value="Limpiar" />
		</div>
		<div id="transacciones" class="container-box2">
		</div>
		
	</div>


<script type="text/javascript">
	var formatNumber = {
		separador: ".", // separador para los miles
		sepDecimal: ',', // separador para los decimales

		formatear:function (num){
			num +='';
			var splitStr = num.split('.');
			var splitLeft = splitStr[0];
			var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : this.sepDecimal + '00';
			var regx = /(\d+)(\d{3})/;
			while (regx.test(splitLeft)) {
				splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
			}
			return this.simbol + splitLeft +splitRight;
		},
		new:function(num, simbol){
			this.simbol = simbol ||'';
			return this.formatear(num);
		}
	}

	function busca_transacciones(){
		document.getElementById("transacciones").innerHTML = '<p>Buscando registros...</p>'; 
		var codigo = document.getElementById("codigo").value;
		var datos = '';
		var mensaje = '';
		var transacciones = '';
 		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				console.log(typeof this.responseText);
				console.log(this.responseText);

				if (this.responseText!='No encontrada') {
					console.log(JSON.parse(this.responseText));
					datos = JSON.parse(this.responseText);
					console.log(datos);

					transacciones = '<h3 class="titulo">Transacciones asociadas al afiliado: '+datos[0].afiliado+'</h3>';
					console.log(transacciones);
					transacciones += '<table border="1" align="center">';
						transacciones += '<thead>';
							transacciones += '<tr>';
								transacciones += '<th width="70px">Fecha</th>';
								transacciones += '<th width="70px">Número de órden</th>';
								transacciones += '<th width="50px">Código</th>';
								transacciones += '<th width="200px">Descripción</th>';
								transacciones += '<th width="100px">Tipo</th>';
								transacciones += '<th width="100px">Monto</th>';
								transacciones += '<th width="100px">Puntos</th>';
								transacciones += '<th width="100px">Documento</th>';
								transacciones += '<th width="300px">Banco Origen</th>';
								transacciones += '<th width="100px">Status comision</th>';
							transacciones += '</tr>';
						transacciones += '</thead>';

						for (var i = 0; i < datos.length; i++) {
							transacciones += "<tr>";
								fecha = datos[i].fecha.substr(8,2)+'/'+datos[i].fecha.substr(5,2)+'/'+datos[i].fecha.substr(0,4);
								transacciones += "<td>"+fecha+"</td>";
								transacciones += "<td>"+datos[i].orden_id+"</td>";
								transacciones += '<td>'+datos[i].tipo+"</td>";
								transacciones += '<td>'+datos[i].nombre_transaccion+"</td>";
								if (datos[i].signo_transaccion=='+') {signo = 'Crédito';} else {signo = 'Débito';}
									transacciones += '<td>'+signo+"</td>";
									transacciones += '<td align="right">'+formatNumber.new(datos[i].precio)+"</td>";
									// transacciones += '<td align="right">'+numberFormat(datos.transacciones[i].precio)+"</td>";
								transacciones += '<td align="right">'+datos[i].puntos+"</td>";
								transacciones += '<td>'+datos[i].documento+"</td>";
								transacciones += '<td>'+datos[i].bancoorigen+"</td>";
								transacciones += '<td>'+datos[i].status_comision+"</td>";
							transacciones += "</tr>";
						}
					transacciones += '</table>';
					document.getElementById("transacciones").innerHTML = transacciones;
				} else {
					document.getElementById("transacciones").innerHTML = '<h2 class="titulo">No hay transacciones asociadas a este afiliado</h2>';						
				}
			}
		};
		xmlhttp.open("GET", "buscatransacciones.php?codigo=" + codigo, true);
		xmlhttp.send();
	}

	function limpiar(){
		document.getElementById("codigo").value = ""; 
		document.getElementById("orden").innerHTML = ""; 
		document.getElementById("detalle").innerHTML = ""; 
		document.getElementById("transacciones").innerHTML = ""; 
	}
</script>
