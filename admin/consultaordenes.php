<?php 
	include_once("conexion.php");
	include_once("cabecera.php");
	$menu = "consultas";
	include_once("menu.php");
	$men2 = "ordenes";
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
 	<div class="main-container" onload="busca_orden()">
		<div>
			<label for="orden"><b>Numero de Orden: </b></label>
			<input class="box-btn" type="number" id="orden_id" name="orden_id" onchange="busca_orden()">
			<input type="button" id="buscar" onclick="busca_orden()" value="Buscar" />
			<input type="button" onclick="limpiar()" value="Limpiar" />
		</div>
		<div id="orden" class="container-box1">
		</div>
		<div id="detalle" class="container-box2">
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

	function busca_orden(){
		document.getElementById("orden").innerHTML = ""; 
		document.getElementById("detalle").innerHTML = ""; 
		document.getElementById("transacciones").innerHTML = ""; 
		document.getElementById("orden").innerHTML = '<p>Buscando órden...</p>'; 
		var orden_id = document.getElementById("orden_id").value;
		var datos = '';
		var mensaje = '';
		var orden = '';
		var detalle = '';
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
					orden = '<h2 class="titulo">Orden</h2>';
					orden += '<div>';
						orden += '<ul>';
							orden += '<li id="codigo"><b>Tipo: </b>'+datos.tipo_orden+'</li>';
							switch(datos.tipo_orden) {
								case "Afiliado":
									orden += '<li id="codigo"><b>Afiliado: </b>'+datos.codigo+' - '+datos.nombre+'</li>';
									break;
								case "Cliente":
									orden += '<li id="codigo"><b>Cliente: </b>'+datos.codigo+' - '+datos.nombre+'</li>';
									orden += '<li id="codigo"><b>Patrocinador: </b>'+datos.patroc+' - '+datos.patroc_nombre+'</li>';
									break;
								case "Cliente Preferencial":
									orden += '<li id="codigo"><b>Cliente preferencial: </b>'+datos.codigo+' - '+datos.nombre+'</li>';
									orden += '<li id="codigo"><b>Patrocinador: </b>'+datos.patroc+' - '+datos.patroc_nombre+'</li>';
									break;
							}
							fecha = datos.fecha.substr(8,2)+'/'+datos.fecha.substr(5,2)+'/'+datos.fecha.substr(0,4);
							orden += '<li id="codigo"><b>Fecha: </b>'+fecha+'</li>';
							orden += '<li id="codigo"><b>Monto Doc.: </b>'+formatNumber.new(datos.montodoc)+'</li>';
							orden += '<li id="codigo"><b>Saldo: </b>'+formatNumber.new(datos.monto)+'</li>';
							orden += '<li id="codigo"><b>Puntos: </b>'+datos.puntos+'</li>';
							orden += '<li id="codigo"><b>Dirección de envío: </b>'+datos.direccion_envio+'</li>';
							if (datos.status_orden=="Anulada") {
								orden += '<li id="codigo" style="color:red;font-weight:bold;"><b>Status: </b>'+datos.status_orden+'</li>';	
							} else {
								orden += '<li id="codigo"><b>Status: </b>'+datos.status_orden+'</li>';	
							}
						orden += '</ul>';
					orden += '</div>';
					document.getElementById("orden").innerHTML = orden; 

	/*
					document.getElementById("codigo").innerHTML = "<b>Código: </b>"+datos.codigo;
					fecha = datos.fecha.substr(8,2)+'/'+datos.fecha.substr(5,2)+'/'+datos.fecha.substr(0,4);
					document.getElementById("fecha").innerHTML = "<b>Fecha: </b>"+fecha;
					document.getElementById("montodoc").innerHTML = "<b>Monto Doc: </b>"+formatNumber.new(datos.montodoc);
					document.getElementById("monto").innerHTML = "<b>Saldo: </b>"+formatNumber.new(datos.monto);
					document.getElementById("puntos").innerHTML = "<b>Puntos: </b>"+datos.puntos;
					document.getElementById("direccion_envio").innerHTML = "<b>Dirección Envio: </b>"+datos.direccion_envio;
					document.getElementById("status_orden").innerHTML = "<b>Status Orden: </b>"+datos.status_orden;
	*/
					if (datos.detalles!=undefined) {
						detalle = '<h2 class="titulo">Productos de la órden</h2>';
						detalle += '<table border="1" align="center">';
							detalle += '<thead>';
								detalle += '<tr>';
									detalle += '<th width="50px">Producto</th>';
									detalle += '<th width="400px">Descripción</th>';
									detalle += '<th width="100px">Cantidad</th>';
									detalle += '<th width="100px">Precio</th>';
									detalle += '<th width="100px">Valor comisionable</th>';
									detalle += '<th width="100px">Puntos</th>';
								detalle += '</tr>';
							detalle += '</thead>';

								// statement
							for (var i = 0; i < datos.detalles.length; i++) {
								detalle += "<tr>";
									detalle += "<td>"+datos.detalles[i].codigo+"</td>";
									detalle += '<td>'+datos.detalles[i].desc_corta+"</td>";
									detalle += '<td align="right">'+datos.detalles[i].cantidad+"</td>";
									detalle += '<td align="right">'+formatNumber.new(datos.detalles[i].precio)+"</td>";
									detalle += '<td align="right">'+formatNumber.new(datos.detalles[i].valor_comisionable)+"</td>";
									detalle += '<td align="right">'+datos.detalles[i].puntos+"</td>";
								detalle += "</tr>";
							}
						detalle += '</table>';
						document.getElementById("detalle").innerHTML = detalle; 
					} else {
						document.getElementById("detalle").innerHTML = '<h2 class="titulo">Esta órden está vacía</h2>';
					}

					if (datos.transacciones!=undefined) {
						transacciones = '<h2 class="titulo">Transacciones asociadas a la órden</h2>';
						transacciones += '<table border="1" align="center">';
							transacciones += '<thead>';
								transacciones += '<tr>';
									transacciones += '<th width="70px">Fecha</th>';
									transacciones += '<th width="50px">Código</th>';
									transacciones += '<th width="200px">Descripción</th>';
									transacciones += '<th width="100px">Tipo</th>';
									transacciones += '<th width="100px">Monto</th>';
									transacciones += '<th width="100px">Puntos</th>';
									transacciones += '<th width="100px">Documento</th>';
									transacciones += '<th width="300px">Banco Origen</th>';
								transacciones += '</tr>';
							transacciones += '</thead>';

							for (var i = 0; i < datos.transacciones.length; i++) {
								transacciones += "<tr>";
									fecha = datos.transacciones[i].fecha.substr(8,2)+'/'+datos.transacciones[i].fecha.substr(5,2)+'/'+datos.transacciones[i].fecha.substr(0,4);
									transacciones += "<td>"+fecha+"</td>";
									transacciones += '<td>'+datos.transacciones[i].tipo+"</td>";
									transacciones += '<td>'+datos.transacciones[i].nombre_transaccion+"</td>";
									if (datos.transacciones[i].signo_transaccion=='+') {signo = 'Crédito';} else {signo = 'Débito';}
									transacciones += '<td>'+signo+"</td>";
									transacciones += '<td align="right">'+formatNumber.new(datos.transacciones[i].precio)+"</td>";
									// transacciones += '<td align="right">'+numberFormat(datos.transacciones[i].precio)+"</td>";
									transacciones += '<td align="right">'+datos.transacciones[i].puntos+"</td>";
									transacciones += '<td>'+datos.transacciones[i].documento+"</td>";
									transacciones += '<td>'+datos.transacciones[i].bancoorigen+"</td>";
								transacciones += "</tr>";
							}
						transacciones += '</table>';
						document.getElementById("transacciones").innerHTML = transacciones;
					} else {
						document.getElementById("transacciones").innerHTML = '<h2 class="titulo">No hay transacciones asociadas a la órden</h2>';						
					}
				} else {
					orden = '<h2 class="titulo">Orden no encontrada.</h2>';
					document.getElementById("orden").innerHTML = orden; 
				}
			}
		};
		xmlhttp.open("GET", "buscaordenes.php?orden_id=" + orden_id, true);
		xmlhttp.send();
	}

	function limpiar(){
		document.getElementById("orden_id").value = ""; 
		document.getElementById("orden").innerHTML = ""; 
		document.getElementById("detalle").innerHTML = ""; 
		document.getElementById("transacciones").innerHTML = ""; 
	}
</script>
