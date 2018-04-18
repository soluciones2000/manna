<?php 
	include_once("conexion.php");
	include_once("cabecera.php");
	$menu = "consultas";
	include_once("menu.php");
	$men2 = "ordxafi";
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
			<input class="box-btn" type="text" id="codigo" name="codigo" maxlength="5" size="5" onkeyup="this.value = this.value.toUpperCase();" onchange="busca_ordxafi()">
			<input type="button" onclick="busca_ordxafi()" value="Buscar" />
			<input type="button" onclick="limpiar()" value="Limpiar" />
		</div>
		<div id="ordxafi" class="container-box2">
		</div>
		<a href=""></a>
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

	function busca_ordxafi(){
		document.getElementById("ordxafi").innerHTML = '<p>Buscando registros...</p>'; 
		var codigo = document.getElementById("codigo").value;
		var datos = '';
		var mensaje = '';
		var ordxafi = '';
 		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				console.log(typeof this.responseText);
				console.log(this.responseText);

				if (this.responseText!='No encontrada') {
					console.log(JSON.parse(this.responseText));
					datos = JSON.parse(this.responseText);
					console.log(datos);

					ordxafi = '<h3 class="titulo">Órdenes asociadas al afiliado: '+datos[0].afiliado+'</h3>';
					console.log(ordxafi);
					ordxafi += '<table border="1" align="center">';
						ordxafi += '<thead>';
							ordxafi += '<tr>';
								ordxafi += '<th width="70px">Número de órden</th>';
								ordxafi += '<th width="70px">Fecha</th>';
								ordxafi += '<th width="100px">Monto</th>';
								ordxafi += '<th width="100px">Saldo</th>';
								ordxafi += '<th width="100px">Puntos</th>';
								ordxafi += '<th width="100px">Status órden</th>';
							ordxafi += '</tr>';
						ordxafi += '</thead>';

						for (var i = 0; i < datos.length; i++) {
							ordxafi += "<tr>";
								fecha = datos[i].fecha.substr(8,2)+'/'+datos[i].fecha.substr(5,2)+'/'+datos[i].fecha.substr(0,4);
								ordxafi += '<td>'+datos[i].orden_id+'</td>';
								ordxafi += "<td>"+fecha+"</td>";
								ordxafi += '<td align="right">'+formatNumber.new(datos[i].montodoc)+"</td>";
								ordxafi += '<td align="right">'+formatNumber.new(datos[i].monto)+"</td>";
								ordxafi += '<td align="right">'+datos[i].puntos+"</td>";
								ordxafi += '<td>'+datos[i].status_orden+"</td>";
							ordxafi += "</tr>";
						}
					ordxafi += '</table>';
					document.getElementById("ordxafi").innerHTML = ordxafi;
				} else {
					document.getElementById("ordxafi").innerHTML = '<h2 class="titulo">No hay órdenes asociadas a este afiliado</h2>';						
				}
			}
		};
		xmlhttp.open("GET", "buscaordxafi.php?codigo=" + codigo, true);
		xmlhttp.send();
	}

	function limpiar(){
		document.getElementById("codigo").value = ""; 
		document.getElementById("orden").innerHTML = ""; 
		document.getElementById("detalle").innerHTML = ""; 
		document.getElementById("ordxafi").innerHTML = ""; 
	}
</script>
