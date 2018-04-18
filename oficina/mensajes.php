
	<!-- CSS Files -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
	
	

	<!-- CSS -->
	<link href="assets/css/allneat.css" rel="stylesheet" />

<?php 
include_once("conexion.php");
include_once("funciones.php");
//$codigo = isset($_GET['c']) ? $_GET['c'] : $_SESSION["codigo"];
$codigo = isset($_GET['c']) ? $_GET['c'] : '';
?>
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<html>
<head> 
	<style>
		/*body {font-family: Arial;}*/

		/* Style the tab */
		.tab {
		    overflow: hidden;
		    border: 1px solid #ccc;
		    background-color: #f1f1f1;
		}

		/* Style the buttons inside the tab */
		.tab button {
		    background-color: inherit;
		    float: left;
		    border: none;
		    outline: none;
		    cursor: pointer;
		    padding: 14px 16px;
		    transition: 0.3s;
		    font-size: 17px;
		}

		/* Change background color of buttons on hover */
		.tab button:hover {
		    background-color: #ccc;
		}

		/* Create an active/current tablink class */
		.tab button.active {
		    /*background-color: #ccc;*/
		    background-color: #999;
		}

		/* Style the tab content */
		.tabcontent {
		    display: none;
		    padding: 6px 12px;
		    border: 1px solid #ccc;
		    border-top: none;
		}
	</style>
</head>
<body>
	<!-- <h3>Bienvenido <b><?php echo $_SESSION["user"]; ?></b>,</h3> -->
	<div class="tab">
		<button class="tablinks" onClick="opentab(event, 'destinatarios')" id="defaultOpen">1) Seleccionar destinatarios</button>
		<button class="tablinks" onClick="opentab(event, 'mensaje')" id="btnmensaje" disabled>2) Redactar Mensaje</button>
		<button class="tablinks" onClick="opentab(event, 'confirmar')"  id="btnconfirmar" disabled>3) Confirmar y enviar</button>
	</div>

	<div id="destinatarios" class="tabcontent">
		<h3>
			Seleccionar destinatarios:
			<button onClick="enabletab('btnmensaje')" align="right" class="btn btn-primary btn-block" inline>Continuar al paso 2</button>
		</h3>
		<input type="radio" name="seleccionar" id="todalared" value="Toda la red" onClick="todalared(event)">Toda mi red 
		<input type="radio" name="seleccionar" id="seleccionar" value="Destinatarios filtrados" onClick="todalared(event)" checked>Filtrar destinatarios
		<p align="justify">Seleccione los destinatarios del mensaje, puede ser toda la red o puede filtrarlos por alguno de los siguientes criterios:</p>
<!--
 		<div id="grupos" style="display:inline;">
			<input type="checkbox" id="selrangos" onclick="selerangos(event)">Por rango
			<input type="checkbox" id="seltipos" onclick="seletipos(event)">Por tipo
		</div>
 -->
		<fieldset style="width:97%;" id="frango"><legend>Por Rango:</legend>
			<input type="checkbox" id="rngall" onClick="todoslosrangos(event)">Todos<br>
			<input class="rangos" type="checkbox" name="ascenso" value="En Ascenso" id="rngascenso" onClick="unrango(event)">En Ascenso
			<input class="rangos" type="checkbox" name="gerente" value="Gerente" id="rnggerente" onClick="unrango(event)">Gerente
			<input class="rangos" type="checkbox" name="gtesenior" value="Gerente Senior" id="rnggtesenior" onClick="unrango(event)">Gte. Senior
			<input class="rangos" type="checkbox" name="oro" value="Oro" id="rngoro" onClick="unrango(event)">Oro
			<input class="rangos" type="checkbox" name="platino" value="Platino" id="rngplatino" onClick="unrango(event)">Platino
			<input class="rangos" type="checkbox" name="rubi" value="Rubí" id="rngrubi" onClick="unrango(event)">Rubí
			<input class="rangos" type="checkbox" name="diamante" value="Diamante" id="rngdiamante" onClick="unrango(event)">Diamante
			<input class="rangos" type="checkbox" name="embajador" value="Embajador" id="rngembajador"  onClick="unrango(event)">Embajador
			<input class="rangos" type="checkbox" name="embajejec" value="Embajador Ejecutivo" id="rngembajejec" onClick="unrango(event)">Embaj. Ejec.
			<input class="rangos" type="checkbox" name="embajpres" value="Embajador Presidencial" id="rngembajpres" onClick="unrango(event)">Embaj. Presid.
			<input class="rangos" type="checkbox" name="embajinter" value="Embajador Internacional" id="rngembajinter" onClick="unrango(event)">Embaj. Internacional
		</fieldset>
		<div>
			<fieldset style="width:24%;display:inline;" id="ftipo"><legend>Por Tipo de afiliado:</legend>
				<input type="checkbox" name="tiptodos" id="tipall" onClick="todoslostipos(event)">Todos<br>
				<input class="tipos" type="checkbox" name="tippremium" value="Premium" id="tippremium" class="form-control" onClick="untipo(event)">Premium
				<input class="tipos" type="checkbox" name="tipvip" value="VIP" id="tipvip" onClick="untipo(event)">V.I.P.
				<input class="tipos" type="checkbox" name="tiporo" value="Oro" id="tiporo" onClick="untipo(event)">Oro
			</fieldset>
			<fieldset style="width:70%;display:inline;" id="fnivel"><legend>Por nivel en la organización:</legend>
				<input type="checkbox" name="nivtodos" id="nivall" onClick="todosniveles(event)">Todos<br>
				<input class="niveles" type="checkbox" name="niv1" value="Nivel 1" id="niv1" onClick="unnivel(event)">Nivel 1
				<input class="niveles" type="checkbox" name="niv2" value="Nivel 2" id="niv2" onClick="unnivel(event)">Nivel 2
				<input class="niveles" type="checkbox" name="niv3" value="Nivel 3" id="niv3" onClick="unnivel(event)">Nivel 3
				<input class="niveles" type="checkbox" name="niv4" value="Nivel 4" id="niv4" onClick="unnivel(event)">Nivel 4
				<input class="niveles" type="checkbox" name="niv5" value="Nivel 5" id="niv5" onClick="unnivel(event)">Nivel 5
				<input class="niveles" type="checkbox" name="niv6" value="Nivel 6" id="niv6" onClick="unnivel(event)">Nivel 6
				<input class="niveles" type="checkbox" name="niv7" value="Nivel 7" id="niv7" onClick="unnivel(event)">Nivel 7
				<input class="niveles" type="checkbox" name="niv8" value="Nivel 8" id="niv8" onClick="unnivel(event)">Nivel 8
				<input class="niveles" type="checkbox" name="niv9" value="Niveles inferiores al 8" id="niv9" onClick="unnivel(event)">Nivel 9 en adelante
			</fieldset>
		</div>
		<div>
			<fieldset style="width:24%;display:inline;" id="fsexo"><legend>Por sexo:</legend>
				<input type="checkbox" name="sextodos" id="sexall" onClick="todoslossexos(event)">Todos<br>
				<input class="sexos" type="checkbox" name="masculino" value="Masculino" id="masculino" onClick="unsexo(event)">Masculino
				<input class="sexos" type="checkbox" name="femenino" value="Femenino" id="femenino" onClick="unsexo(event)">Femenino
			</fieldset>
			<fieldset style="width:70%;display:inline;" id="fedad"><legend>Por edad:</legend>
				<input type="checkbox" name="edtodos" id="edtodos" onClick="todosedades(event)">Todos<br>
				<input class="edades" type="checkbox" name="d00h20" value="Hasta los 20 años" id="d00h20" onClick="unaedad(event)">Hasta los 20 años
				<input class="edades" type="checkbox" name="d21h30" value="Entre 21 y 30 años" id="d21h30" onClick="unaedad(event)">De 21 a 30 años
				<input class="edades" type="checkbox" name="d31h40" value="Entre 31 y 40 años" id="d31h40" onClick="unaedad(event)">De 31 a 40 años
				<input class="edades" type="checkbox" name="d41h50" value="Entre 41 y 50 años" id="d41h50" onClick="unaedad(event)">De 41 a 50 años
				<input class="edades" type="checkbox" name="d51h00" value="De 51 años en adelante" id="d51h00" onClick="unaedad(event)">De 51 años en adelante
			</fieldset>
		</div>
		<div>
			<fieldset style="width:34%;display:inline;" id="fpersona"><legend>Por tipo de persona:</legend>
				<input type="checkbox" name="perstodos" id="persall" onClick="todospersonas(event)">Todos<br>
				<input class="personas" type="checkbox" name="persnatural" value="Persona Natural" id="persnatural" onClick="unapers(event)">Persona Natural
				<input class="personas" type="checkbox" name="persjuridica" value="Persona Juridica" id="persjuridica" onClick="unapers(event)">Persona Jurídica
				<input class="personas" type="checkbox" name="persesepcialista" value="Especialista" id="persespecialista" onClick="unapers(event)">Especialista
			</fieldset>
			<fieldset style="width:22%;display:inline;" id="fnacionalidad"><legend>Por nacionalidad:</legend>
				<input type="checkbox" name="nactodos" id="nactodos" onClick="todosnacionalidad(event)">Todos<br>
				<input class="nacionalidades" type="checkbox" name="local" value="Local (VE)" id="local" onClick="unacion(event)">Local (VE)
				<input class="nacionalidades" type="checkbox" name="extranjero" value="Extranjero" id="extranjero" onClick="unacion(event)">Extranjero
			</fieldset>
			<fieldset style="width:35%;display:inline;" id="fedocivil"><legend>Por Estado civil:</legend>
				<input type="checkbox" name="edoctodos" id="edocall" onClick="todosedocivil(event)">Todos<br>
				<input class="edociviles" type="checkbox" name="soltero" value="Soltero" id="soltero" onClick="unedociv(event)">Soltero
				<input class="edociviles" type="checkbox" name="casado" value="Casado" id="casado" onClick="unedociv(event)">Casado
				<input class="edociviles" type="checkbox" name="divorciado" value="Divorciado" id="divorciado" onClick="unedociv(event)">Divorciado
				<input class="edociviles" type="checkbox" name="edocotro" value="Otro estado civil" id="edocotro" onClick="unedociv(event)">Otro estado civil
			</fieldset>
		</div>
		<fieldset style="width:97%;" id="festado"><legend>Por Estado geográfico:</legend>
			<input type="checkbox" id="estall" onClick="todosestados(event)">Todos<br>
			<?php
				$query = "SELECT * from estados order by estado";
				$result = mysql_query($query,$link);
				while($row = mysql_fetch_array($result)) {
					$estado = $row["estado"];
					echo '<input type="checkbox" class="estados" name="'.trim($estado).'" value="'.trim($estado).'" id="'.trim($estado).'" onclick="unestado(event)">'.trim($estado);
				}

			?>
		</fieldset>
		<fieldset style="width:97%;" id="fcorreos"><legend>Cuentas individuales:</legend>
			Agregue cuentas de correo individuales separadas por comas (,):<br>
			<textarea rows="4" cols="127" name="correos" id="correos" class="form-control" placeholder="Agregue las Cuentas..."></textarea>
		</fieldset>
		<br>
		<button onClick="enabletab('btnmensaje')" class="btn btn-primary btn-block">Continuar al paso 2</button>
	</div>

	<div id="mensaje" class="tabcontent">
		<h3>
			Redactar Mensaje:
			<button onClick="enabletab('defaultOpen')" class="btn btn-primary btn-block" inline>Regresar al paso 1</button>
			<button onClick="enabletab('btnconfirmar')" class="btn btn-primary btn-block" inline>Continuar al paso 3</button>
		</h3>
		Asunto:<br>
		<input type="text" id="asunto" name="asunto" size="169" maxlength="169" class="form-control" placeholder="Indique el Asunto..."><br>
		Cuerpo del mensaje:<br>
		<textarea rows="10" cols="127" id="cuerpo" name="cuerpo" class="form-control" placeholder="Indique el Mensaje..."></textarea>
		<button onClick="enabletab('defaultOpen')" class="btn btn-primary btn-block">Regresar al paso 1</button>
		<button onClick="enabletab('btnconfirmar')" class="btn btn-primary btn-block">Continuar al paso 3</button>
	</div>

	<div id="confirmar" class="tabcontent">
		<h3>
			Confirmar y enviar
			<button onClick="enabletab('btnmensaje')" class="btn btn-primary btn-block" inline>Regresar al paso 2</button>
			<button onClick="enviarmensaje('<?php echo $codigo ?>',todalared.checked)" class="btn btn-primary btn-block" inline>Enviar</button>
		</h3>
		<b>Destinatarios:</b>
		<p id="to"></p>

		<b>Asunto:</b>
		<p id="subject"></p>

		<b>Mensaje:</b>
		<p id="message"></p>

		<button onClick="enabletab('btnmensaje')" class="btn btn-primary btn-block">Regresar al paso 2</button>
		<button onClick="enviarmensaje('<?php echo $codigo; ?>',todalared.checked)" class="btn btn-primary btn-block">Enviar</button>
	</div>

	<script src="//code.jquery.com/jquery-1.12.4.js"></script>
	<script>
	var err = 0;
	function opentab(evt, opcion) {
		var i, tabcontent, tablinks, to, subject, message, x, y, z;
		if (opcion=="confirmar") {
			if (document.getElementById("todalared").checked) {
				to = "<ul><li>Toda la red.</li></ul>";
			} else {
				to = "";

				to += armato("rangos","rngall","<li>Todos los rangos.","<li>Rangos: ");
				to += armato("tipos","tipall","<li>Todos los tipos de afiliado.","<li>Tipos de afiliado: ");
				to += armato("niveles","nivall","<li>Todos los niveles de la organización.","<li>Niveles de la organización: ");
				to += armato("sexos","sexall","<li>Ambos sexos.","<li>Sexo: ");
				to += armato("edades","edtodos","<li>Todas las edades.","<li>Edades: ");
				to += armato("personas","persall","<li>Todas los tipos de persona.","<li>Tipo de persona: ");
				to += armato("nacionalidades","nactodos","<li>Todas las nacionalidades.","<li>Nacionalidad: ");
				to += armato("edociviles","edocall","<li>Todos los estados civiles.","<li>Estado civil: ");
				to += armato("estados","estall","<li>Todos los estados geográficos.","<li>Estados: ");
				if(document.getElementById("correos").value.length>0) {
					to = to+"<li>Correos individuales: "+document.getElementById("correos").value+"</li>";
				}
			}
			if (to.length+document.getElementById("asunto").value.length+document.getElementById("cuerpo").value.length==0) {
				alert('No se puede enviar un mensaje sin destinatarios, asunto ni cuerpo.');
				opcion = 'destinatarios';
				err = 1;
			} else {
				if(to.length==0) {
					alert('No se puede enviar un mensaje sin destinatarios.');
					opcion = 'destinatarios';
					err = 1;
				} else {
					document.getElementById("to").innerHTML = '<ul>'+to+'</ul>';
					if (document.getElementById("asunto").value.length==0) {
						alert('No se puede enviar un mensaje sin asunto.');
						opcion = 'mensaje';
						err = 2;
					} else {
						document.getElementById("subject").innerHTML = '<ul><li>'+document.getElementById("asunto").value+'</li></ul>';
						if (document.getElementById("cuerpo").value.length==0) {
							alert('No se puede enviar un mensaje vacío.');
							opcion = 'mensaje';
							err = 2;
						} else {
							document.getElementById("message").innerHTML = '<ul><li>'+document.getElementById("cuerpo").value+'</li></ul>';
							err = 3;
						}
					}
				}
			}
		}
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		}
		document.getElementById(opcion).style.display = "block";
		evt.currentTarget.className += " active";
		if (err==1) {
			tablinks[0].className += " active";
			tablinks[1].className = tablinks[1].className.replace(" active", "");
			tablinks[2].className = tablinks[2].className.replace(" active", "");
			err=0;
		} else {
			if (err==2) {
				tablinks[0].className = tablinks[2].className.replace(" active", "");
				tablinks[1].className += " active";
				tablinks[2].className = tablinks[1].className.replace(" active", "");
				err=0;
			} else {
				if (err==3) {
					tablinks[0].className = tablinks[1].className.replace(" active", "");
					tablinks[1].className = tablinks[2].className.replace(" active", "");
					tablinks[2].className += " active";
					err=0;
				} else {
					for (i = 0; i < tablinks.length; i++) {
						tablinks[i].className = tablinks[i].className.replace(" active", "");
					}
					evt.currentTarget.className += " active";
				}
			}
		}
	}
	// Get the element with id="defaultOpen" and click on it
	document.getElementById("defaultOpen").click();

	function enabletab(opcion) {
		document.getElementById(opcion).disabled = false;
		document.getElementById(opcion).click();
	}

	function enviarmensaje(opcion) {
		var surl, opcion2, rng, tip, niv, sex, eda, per, nac, edc, est, emails, txt,  xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				exito();
			}
		};
		txt = "c="+opcion;

		if (document.getElementById('todalared').checked) {
			opcion2 = document.getElementById('todalared').value;
//			txt += "&todalared=on"+opcion2;
			txt += "&todalared=on";
		} else {
			opcion2 = document.getElementById('seleccionar').value;
//			txt += "&todalared="+opcion2;
			txt += "&todalared=";

			txt += armapost('rngall','rangos');
			txt += armapost('tipall','tipos');
			txt += armapost('nivall','niveles');
			txt += armapost('sexall','sexos');
			txt += armapost('edtodos','edades');
			txt += armapost('persall','personas');
			txt += armapost('nactodos','nacionalidades');
			txt += armapost('edocall','edociviles');
			txt += armapost('estall','estados');
		}
		if(document.getElementById("correos").value.length>0) {
			txt += "&emails="+document.getElementById("correos").value;
		}
		if(document.getElementById("asunto").value.length>0) {
			txt += "&asunto="+document.getElementById("asunto").value
		}
		if(document.getElementById("cuerpo").value.length>0) {
			txt += "&cuerpo="+document.getElementById("cuerpo").value
		}
		surl = "enviarmensaje.php";
		xhttp.open("POST", surl, true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(txt);
	}

	function exito(){
		alert('Mensaje enviado!');
		document.getElementById('btnmensaje').disabled = true;
		document.getElementById('btnconfirmar').disabled = true;
		document.getElementById("defaultOpen").click();
	}

	function todalared(evt){
		if (document.getElementById("todalared").checked) {
			document.getElementById("rngall").checked = true;
			todoslosrangos(evt);
			document.getElementById("frango").disabled = true;

			document.getElementById("tipall").checked = true;
			todoslostipos(evt);
			document.getElementById("ftipo").disabled = true;

			document.getElementById("nivall").checked = true;
			todosniveles(evt);
			document.getElementById("fnivel").disabled = true;

			document.getElementById("sexall").checked = true;
			todoslossexos(evt);
			document.getElementById("fsexo").disabled = true;

			document.getElementById("persall").checked = true;
			todospersonas(evt);
			document.getElementById("fpersona").disabled = true;

			document.getElementById("edtodos").checked = true;
			todosedades(evt);
			document.getElementById("fedad").disabled = true;

			document.getElementById("nactodos").checked = true;
			todosnacionalidad(evt);
			document.getElementById("fnacionalidad").disabled = true;

			document.getElementById("edocall").checked = true;
			todosedocivil(evt);
			document.getElementById("fedocivil").disabled = true;

			document.getElementById("estall").checked = true;
			todosestados(evt);
			document.getElementById("festado").disabled = true;

			document.getElementById("fcorreos").disabled = true;
		} else {
			document.getElementById("rngall").checked = false;
			todoslosrangos(evt);
			document.getElementById("frango").disabled = false;

			document.getElementById("tipall").checked = false;
			todoslostipos(evt);
			document.getElementById("ftipo").disabled = false;

			document.getElementById("nivall").checked = false;
			todosniveles(evt);
			document.getElementById("fnivel").disabled = false;

			document.getElementById("sexall").checked = false;
			todoslossexos(evt);
			document.getElementById("fsexo").disabled = false;

			document.getElementById("persall").checked = false;
			todospersonas(evt);
			document.getElementById("fpersona").disabled = false;

			document.getElementById("edtodos").checked = false;
			todosedades(evt);
			document.getElementById("fedad").disabled = false;

			document.getElementById("nactodos").checked = false;
			todosnacionalidad(evt);
			document.getElementById("fnacionalidad").disabled = false;

			document.getElementById("edocall").checked = false;
			todosedocivil(evt);
			document.getElementById("fedocivil").disabled = false;

			document.getElementById("estall").checked = false;
			todosestados(evt);
			document.getElementById("festado").disabled = false;

			document.getElementById("fcorreos").disabled = false;
		}
	}

	function todoslosrangos(evt){
		if (document.getElementById("rngall").checked) {
			document.getElementById("rngascenso").checked = true;
			document.getElementById("rnggerente").checked = true;
			document.getElementById("rnggtesenior").checked = true;
			document.getElementById("rngoro").checked = true;
			document.getElementById("rngplatino").checked = true;
			document.getElementById("rngrubi").checked = true;
			document.getElementById("rngdiamante").checked = true;
			document.getElementById("rngembajador").checked = true;
			document.getElementById("rngembajejec").checked = true;
			document.getElementById("rngembajpres").checked = true;
			document.getElementById("rngembajinter").checked = true;
		} else {
			document.getElementById("seleccionar").checked = true;
			document.getElementById("rngascenso").checked = false;
			document.getElementById("rnggerente").checked = false;
			document.getElementById("rnggtesenior").checked = false;
			document.getElementById("rngoro").checked = false;
			document.getElementById("rngplatino").checked = false;
			document.getElementById("rngrubi").checked = false;
			document.getElementById("rngdiamante").checked = false;
			document.getElementById("rngembajador").checked = false;
			document.getElementById("rngembajejec").checked = false;
			document.getElementById("rngembajpres").checked = false;
			document.getElementById("rngembajinter").checked = false;
		}
	}

	function todoslostipos(evt){
		// if (evt.currentTarget.checked) {
		if (document.getElementById("tipall").checked) {
			document.getElementById("tippremium").checked = true;
			document.getElementById("tipvip").checked = true;
			document.getElementById("tiporo").checked = true;
		} else {
			document.getElementById("tippremium").checked = false;
			document.getElementById("tipvip").checked = false;
			document.getElementById("tiporo").checked = false;
		}
	}
	
	function todosniveles(evt){
		// if (evt.currentTarget.checked) {
		if (document.getElementById("nivall").checked) {
			document.getElementById("niv1").checked = true;
			document.getElementById("niv2").checked = true;
			document.getElementById("niv3").checked = true;
			document.getElementById("niv4").checked = true;
			document.getElementById("niv5").checked = true;
			document.getElementById("niv6").checked = true;
			document.getElementById("niv7").checked = true;
			document.getElementById("niv8").checked = true;
			document.getElementById("niv9").checked = true;
		} else {
			document.getElementById("niv1").checked = false;
			document.getElementById("niv2").checked = false;
			document.getElementById("niv3").checked = false;
			document.getElementById("niv4").checked = false;
			document.getElementById("niv5").checked = false;
			document.getElementById("niv6").checked = false;
			document.getElementById("niv7").checked = false;
			document.getElementById("niv8").checked = false;
			document.getElementById("niv9").checked = false;
		}
	}
	
	function todoslossexos(evt){
		// if (evt.currentTarget.checked) {
		if (document.getElementById("sexall").checked) {
			document.getElementById("masculino").checked = true;
			document.getElementById("femenino").checked = true;
		} else {
			document.getElementById("masculino").checked = false;
			document.getElementById("femenino").checked = false;
		}
	}
	
	function todospersonas(evt){
		// if (evt.currentTarget.checked) {
		if (document.getElementById("persall").checked) {
			document.getElementById("persnatural").checked = true;
			document.getElementById("persjuridica").checked = true;
		} else {
			document.getElementById("persnatural").checked = false;
			document.getElementById("persjuridica").checked = false;
		}
	}
	
	function todosedades(evt){
		// if (evt.currentTarget.checked) {
		if (document.getElementById("edtodos").checked) {
			document.getElementById("d00h20").checked = true;
			document.getElementById("d21h30").checked = true;
			document.getElementById("d31h40").checked = true;
			document.getElementById("d41h50").checked = true;
			document.getElementById("d51h00").checked = true;
		} else {
			document.getElementById("d00h20").checked = false;
			document.getElementById("d21h30").checked = false;
			document.getElementById("d31h40").checked = false;
			document.getElementById("d41h50").checked = false;
			document.getElementById("d51h00").checked = false;
		}
	}
	
	function todosnacionalidad(evt){
		// if (evt.currentTarget.checked) {
		if (document.getElementById("nactodos").checked) {
			document.getElementById("local").checked = true;
			document.getElementById("extranjero").checked = true;
		} else {
			document.getElementById("local").checked = false;
			document.getElementById("extranjero").checked = false;
		}
	}
	
	function todosedocivil(evt){
		// if (evt.currentTarget.checked) {
		if (document.getElementById("edocall").checked) {
			document.getElementById("soltero").checked = true;
			document.getElementById("casado").checked = true;
			document.getElementById("divorciado").checked = true;
			document.getElementById("edocotro").checked = true;
		} else {
			document.getElementById("soltero").checked = false;
			document.getElementById("casado").checked = false;
			document.getElementById("divorciado").checked = false;
			document.getElementById("edocotro").checked = false;
		}
	}

	function todosestados(evt){
		var est,i;
		est = document.getElementsByClassName("estados");
		if (document.getElementById("estall").checked) {
			for (i = 0; i < est.length; i++) {
				est[i].checked = true;
			}
		} else {
			for (i = 0; i < est.length; i++) {
				est[i].checked = false;
			}
		}
	}

	function unrango(evt){
		var x,y,i;
		x = document.getElementsByClassName("rangos");
		y = 0;
		for (i = 0; i < x.length; i++) {
			if (x[i].checked) {
				y++;
			}
		}
		if (y==x.length) {
			document.getElementById("rngall").checked = true;
		} else {
			document.getElementById("rngall").checked = false;
		}
	}

	function untipo(evt){
		var x,y,i;
		x = document.getElementsByClassName("tipos");
		y = 0;
		for (i = 0; i < x.length; i++) {
			if (x[i].checked) {
				y++;
			}
		}
		if (y==x.length) {
			document.getElementById("tipall").checked = true;
		} else {
			document.getElementById("tipall").checked = false;
		}
	}

	function unnivel(evt){
		var x,y,i;
		x = document.getElementsByClassName("niveles");
		y = 0;
		for (i = 0; i < x.length; i++) {
			if (x[i].checked) {
				y++;
			}
		}
		if (y==x.length) {
			document.getElementById("nivall").checked = true;
		} else {
			document.getElementById("nivall").checked = false;
		}
	}

	function unsexo(evt){
		var x,y,i;
		x = document.getElementsByClassName("sexos");
		y = 0;
		for (i = 0; i < x.length; i++) {
			if (x[i].checked) {
				y++;
			}
		}
		if (y==x.length) {
			document.getElementById("sexall").checked = true;
		} else {
			document.getElementById("sexall").checked = false;
		}
	}

	function unaedad(evt){
		var x,y,i;
		x = document.getElementsByClassName("edades");
		y = 0;
		for (i = 0; i < x.length; i++) {
			if (x[i].checked) {
				y++;
			}
		}
		if (y==x.length) {
			document.getElementById("edtodos").checked = true;
		} else {
			document.getElementById("edtodos").checked = false;
		}
	}

	function unapers(evt){
		var x,y,i;
		x = document.getElementsByClassName("personas");
		y = 0;
		for (i = 0; i < x.length; i++) {
			if (x[i].checked) {
				y++;
			}
		}
		if (y==x.length) {
			document.getElementById("persall").checked = true;
		} else {
			document.getElementById("persall").checked = false;
		}
	}

	function unacion(evt){
		var x,y,i;
		x = document.getElementsByClassName("nacionalidades");
		y = 0;
		for (i = 0; i < x.length; i++) {
			if (x[i].checked) {
				y++;
			}
		}
		if (y==x.length) {
			document.getElementById("nactodos").checked = true;
		} else {
			document.getElementById("nactodos").checked = false;
		}
	}

	function unedociv(evt){
		var x,y,i;
		x = document.getElementsByClassName("edociviles");
		y = 0;
		for (i = 0; i < x.length; i++) {
			if (x[i].checked) {
				y++;
			}
		}
		if (y==x.length) {
			document.getElementById("edcall").checked = true;
		} else {
			document.getElementById("edcall").checked = false;
		}
	}

	function unestado(evt){
		var x,y,i;
		x = document.getElementsByClassName("estados");
		y = 0;
		for (i = 0; i < x.length; i++) {
			if (x[i].checked) {
				y++;
			}
		}
		if (y==x.length) {
			document.getElementById("estall").checked = true;
		} else {
			document.getElementById("estall").checked = false;
		}
	}

	function armato(clase, tipo, mensajesi, mensajeno) {
		var z, x, i, to, y;
		z = 0;
		x = document.getElementsByClassName(clase);
		to = "";
		for (i = 0; i < x.length; i++) { if (x[i].checked) { z++; } }
		if (document.getElementById(tipo).checked || z!=0) {
			if (document.getElementById(tipo).checked) {
				to = to+mensajesi;
			} else {
				to = to+mensajeno;
				y=0;
				for (i = 0; i < x.length; i++) {
					if (x[i].checked) {
						y++;
						if (y==1) {
							to += x[i].value;
						} else {
							to += ', '+x[i].value;
						}
					}
				}
				to = to+".</li>";
			}
		}
		return to;
	}

	function armapost(todos,lista) {
		var crng, x, i, rng = "";
		if (document.getElementById(todos).checked) {
			rng += '&'+todos+"="+document.getElementById(todos).value;
		} else {
			crng = document.getElementsByClassName(lista);
			x=0;
			for (i = 0; i < crng.length; i++) {
				if (crng[i].checked) {
					rng += '&'+crng[i].id+"="+crng[i].value;
				}
			}
		}
		return rng;
	}

	</script>
</body>
</html>