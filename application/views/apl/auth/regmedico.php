<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<br>
<div class="container">
	<div class="col-md-12 center-block no-float">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo $panel_title ?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<p align="center"><b>Los cambpos marcados con <font color="red">(*)</font> son obligatorios</b></p>
				</div>
				<!--<form action="<?php echo base_url(); ?>entrar" method="POST">-->
				<?php if(validation_errors()){ echo '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>'; } ?>
				<?php $hidden = array( 'tipo_persona' => $_POST['tipo_persona'],
										'nacionalidad' => $_POST['nacionalidad'],
										'tipo_afiliado' => $_POST['tipo_afiliado'],
										'tipo_kit' => $_POST['tipo_kit'],
										'fechapago' => $_POST['fechapago'],
										'numcomprobante' => $_POST['numcomprobante'],
										'bancoorigen' => $_POST['bancoorigen'],
										'enrol_codigo' => $_POST['enrol_codigo'],
										'enrol_nombre_completo' => $enrol_nombre_completo,
										'patroc_codigo' => $_POST['patroc_codigo'],
										'patroc_nombre_completo' => $patroc_nombre_completo,
										'envio' => $envio,
										'direccion_envio' => $_POST['direccion_envio']); ?>
				<?php echo form_open('crea_medico','',$hidden); ?>
					<div class="row">
						<div class="col-sm-6">
							<label for="tit_nombres"><font color="red">(*)</font> Nombres del especialista</label>
							<input type="text" name="tit_nombres" value="<?php echo set_value('tit_nombres') ?>" class="form-control" id="tit_nombres" placeholder="Nombres del titular" maxlength="150" required>
						</div>
						<div class="col-sm-6">
							<label for="tit_apellidos"><font color="red">(*)</font> Apellidos del especialista</label>
							<input type="text" name="tit_apellidos" class="form-control" id="tit_apellidos" placeholder="Apellidos del titular" maxlength="150" required>
						</div>
					</div>
					<div class="row" style="margin-top:1%">
						<div class="col-sm-3">
							<label for="tit_cedula"><font color="red">(*)</font> Cédula de Identidad</label>
							<input type="text" name="tit_cedula" value="<?php echo set_value('tit_cedula') ?>" class="form-control" id="tit_cedula" placeholder="Cédula de identidad" maxlength="8" minlength="6" pattern="[0-9]{6,8}" title="Sólo se aceptan números" required>
						</div>
						<div class="col-sm-3">
							<label for="tit_rif"><font color="red">(*)</font> RIF (sin guiones)</label>
							<input type="text" style="text-transform:uppercase;" name="tit_rif" class="form-control" id="tit_rif" placeholder="RIF" maxlength="10" minlength="9" pattern="[V|E]{1}[0-9]{8,9}" title="El primer caracter debe ser la letra V ó E en Mayúscula" required>
						</div>
						<div class="col-sm-3">
							<label for="tit_fecha_nac"><font color="red">(*)</font> Fecha de nacimiento</label>
<!--
								<input type="date" name="tit_fecha_nac" value="<?php echo set_value('tit_fecha_nac') ?>" class="form-control" id="tit_fecha_nac" maxlength="10" minlength="10" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" title="El formato de este campo es 99/99/9999" placeholder="dd/mm/yyyy" required>
-->
								<input data-provide="datepicker" data-date-format="dd/mm/yyyy" data-date-autoclose="true" name="tit_fecha_nac" class="form-control" id="tit_fecha_nac" placeholder="dd/mm/yyyy" value="<?php set_value('tit_fecha_nac') ?>" readonly style="background-color:white;" required>


						</div>
						<div class="col-sm-3">
							<label for="tit_edo_civil"><font color="red">(*)</font> Estado Civil</label><br>
							<select name="tit_edo_civil" value="<?php echo set_value('tit_edo_civil') ?>" class="col-sm-12 form-control" required>
								<option value="soltero">Soltero</option>
								<option value="casado">Casado</option>
								<option value="divorciado">Divorciado</option>
								<option value="otro">Otro</option>
							</select>
						</div>
					</div>
					<div class="row" style="margin-top:1%">
						<div class="col-sm-3">
							<label for="tit_sexo"><font color="red">(*)</font> Sexo</label><br>
							<select name="tit_sexo" value="<?php echo set_value('tit_sexo') ?>" class="col-sm-12 form-control" required>
								<option value="masculino">Masculino</option>
								<option value="femenino">Femenino</option>
							</select>
						</div>
						<div class="col-sm-3">
							<label for="tit_profesion"><font color="red">(*)</font> Especialidad</label>
							<input type="text" name="tit_profesion" class="form-control" id="tit_profesion" placeholder="Especialidad"  maxlength="150" required>
						</div>
					</div>
<!-- -->
					<div class="row">
						<hr width=100% align="center" style="height:1px;background-color:powderblue">
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label for="cot_nombres">Nombres del cotitular</label>
							<input type="text" name="cot_nombres" value="<?php echo set_value('cot_nombres') ?>" class="form-control" id="cot_nombres" placeholder="Nombres del cotitular" maxlength="150">
						</div>
						<div class="col-sm-6">
							<label for="cot_apellidos">Apellidos del cotitular</label>
							<input type="text" name="cot_apellidos" class="form-control" id="cot_apellidos" placeholder="Apellidos del cotitular" maxlength="150">
						</div>
					</div>
					<div class="row" style="margin-top:1%">
						<div class="col-sm-3">
							<label for="cot_cedula">Cédula de dentidad</label>
							<input type="text" name="cot_cedula" value="<?php echo set_value('cot_cedula') ?>" class="form-control" id="cot_cedula" placeholder="Cédula de identidad" maxlength="9" minlength="6" pattern="[0-9]{6,9}" title="Sólo se aceptan números">
						</div>
						<div class="col-sm-3">
							<label for="cot_rif">RIF (sin guiones)</label>
							<input type="text" style="text-transform:uppercase;" name="cot_rif" class="form-control" id="cot_rif" placeholder="RIF" maxlength="11" minlength="9" pattern="[J|V|E]{1}[0-9]{8,10}" title="el primer caracter debe ser la letra J, V ó E en Mayúscula">
						</div>
						<div class="col-sm-3">
							<label for="cot_fecha_nac">Fecha de nacimiento</label>
<!--
								<input type="date" name="cot_fecha_nac" value="<?php echo set_value('cot_fecha_nac') ?>" class="form-control" id="cot_fecha_nac" maxlength="10" minlength="10" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" title="El formato de este campo es 99/99/9999" placeholder="dd/mm/yyyy">
-->
								<input data-provide="datepicker" data-date-format="dd/mm/yyyy" data-date-autoclose="true" name="cot_fecha_nac" class="form-control" id="cot_fecha_nac" placeholder="dd/mm/yyyy" value="<?php set_value('cot_fecha_nac') ?>" readonly style="background-color:white;" required>
						</div>
						<div class="col-sm-3">
							<label for="cot_edo_civil">Estado Civil</label><br>
							<select name="cot_edo_civil" value="<?php echo set_value('cot_edo_civil') ?>" class="col-sm-12 form-control">
								<option value="soltero">Soltero</option>
								<option value="casado">Casado</option>
								<option value="divorciado">Divorciado</option>
								<option value="otro">Otro</option>
							</select>
						</div>
					</div>
					<div class="row" style="margin-top:1%">
						<div class="col-sm-3">
							<label for="cot_sexo">Sexo</label><br>
							<select name="cot_sexo" value="<?php echo set_value('cot_sexo') ?>" class="col-sm-12 form-control">
								<option value="masculino">Masculino</option>
								<option value="femenino">Femenino</option>
							</select>
						</div>
					</div>
<!-- -->
					<div class="row">
						<hr width=100% align="center" style="height:1px;background-color:powderblue">
					</div>
					<div class="row">
						<div class="col-sm-12">
							<label for="direccion"><font color="red">(*)</font> Dirección</label>
						</div>
					</div>
					<div class="row" style="margin-top:1%">
						<div class="col-sm-6">
							<input type="text" name="calle" value="<?php echo set_value('calle') ?>" class="form-control" id="calle" placeholder="Calle/Avenida/Vereda"  maxlength="150" required>
						</div>
						<div class="col-sm-6">
							<input type="text" name="cruce" value="<?php echo set_value('cruce') ?>" class="form-control" id="cruce" placeholder="Cruce con/Entre calles" maxlength="150">
						</div>
					</div>
					<div class="row" style="margin-top:1%">
						<div class="col-sm-3">
							<input type="text" name="casa" value="<?php echo set_value('casa') ?>" class="form-control" id="casa" placeholder="Casa/Edificio" maxlength="50" required>
						</div>
						<div class="col-sm-3">
							<input type="text" name="sector" value="<?php echo set_value('sector') ?>" class="form-control" id="sector" placeholder="Urbanización/Sector" maxlength="150" required>
						</div>
						<div class="col-sm-3">
							<input type="text" name="piso" value="<?php echo set_value('piso') ?>" class="form-control" id="piso" placeholder="Piso Nro." maxlength="50">
						</div>
						<div class="col-sm-3">
							<input type="text" name="apto" value="<?php echo set_value('apto') ?>" class="form-control" id="apto" placeholder="Apto." maxlength="50">
						</div>
					</div>
					<div class="row" style="margin-top:1%">
						<div class="col-sm-4">
							<input type="text" name="referencia" value="<?php echo set_value('referencia') ?>" class="form-control" id="referencia" placeholder="Punto de referencia" maxlength="150">
						</div>
						<div class="col-sm-2">
							<select name="ciudad" value="<?php echo set_value('ciudad') ?>" class="col-sm-2 form-control" required>
								<option value="Defecto">Ciudad</option>
								<option value="Acarigua">Acarigua</option>
								<option value="Anaco">Anaco</option>
								<option value="Araure">Araure</option>
								<option value="Barcelona">Barcelona</option>
								<option value="Barinas">Barinas</option>
								<option value="Barquisimeto">Barquisimeto</option>
								<option value="Cabimas">Cabimas</option>
								<option value="Cabudare">Cabudare</option>
								<option value="Cagua">Cagua</option>
								<option value="Caicara del Orinoco">Caicara del Orinoco</option>
								<option value="Calabozo">Calabozo</option>
								<option value="Caracas">Caracas</option>
								<option value="Carora">Carora</option>
								<option value="Carúpano">Carúpano</option>
								<option value="Charallave">Charallave</option>
								<option value="Ciudad Bolívar">Ciudad Bolívar</option>
								<option value="Ciudad Guayana">Ciudad Guayana</option>
								<option value="Ciudad Ojeda">Ciudad Ojeda</option>
								<option value="Coro">Coro</option>
								<option value="Cúa">Cúa</option>
								<option value="Cumaná">Cumaná</option>
								<option value="Ejido">Ejido</option>
								<option value="El Limón">El Limón</option>
								<option value="El Tigre">El Tigre</option>
								<option value="El Tocuyo">El Tocuyo</option>
								<option value="El Vigía">El Vigía</option>
								<option value="Guacara">Guacara</option>
								<option value="Guanare">Guanare</option>
								<option value="Guarenas">Guarenas</option>
								<option value="Guasdualito">Guasdualito</option>
								<option value="Guatire">Guatire</option>
								<option value="Güigüe">Güigüe</option>
								<option value="Higuerote">Higuerote</option>
								<option value="La Concepción">La Concepción</option>
								<option value="La Victoria">La Victoria</option>
								<option value="Los Guayos">Los Guayos</option>
								<option value="Los Puertos de Altagracia">Los Puertos de Altagracia</option>
								<option value="Los Teques">Los Teques</option>
								<option value="Machiques">Machiques</option>
								<option value="Maracaibo">Maracaibo</option>
								<option value="Maracay">Maracay</option>
								<option value="Mariara">Mariara</option>
								<option value="Maturín">Maturín</option>
								<option value="Mérida">Mérida</option>
								<option value="Naguanagua">Naguanagua</option>
								<option value="Ocumare del Tuy">Ocumare del Tuy</option>
								<option value="Porlamar">Porlamar</option>
								<option value="Puerto Ayacucho">Puerto Ayacucho</option>
								<option value="Puerto Cabello">Puerto Cabello</option>
								<option value="Puerto La Cruz">Puerto La Cruz</option>
								<option value="Punto Fijo">Punto Fijo</option>
								<option value="Quíbor">Quíbor</option>
								<option value="San Carlos">San Carlos</option>
								<option value="San Cristóbal">San Cristóbal</option>
								<option value="San Felipe">San Felipe</option>
								<option value="San Fernando de Apure">San Fernando de Apure</option>
								<option value="San Joaquin">San Joaquin</option>
								<option value="San Juan de Los Morros">San Juan de Los Morros</option>
								<option value="Santa Bárbara del Zulia">Santa Bárbara del Zulia</option>
								<option value="Santa Lucía">Santa Lucía</option>
								<option value="Santa Rita">Santa Rita</option>
								<option value="Santa Teresa del Tuy">Santa Teresa del Tuy</option>
								<option value="Táriba">Táriba</option>
								<option value="Tinaquillo">Tinaquillo</option>
								<option value="Tocuyito">Tocuyito</option>
								<option value="Tovar">Tovar</option>
								<option value="Tucupita">Tucupita</option>
								<option value="Turmero">Turmero</option>
								<option value="Upata">Upata</option>
								<option value="Valencia">Valencia</option>
								<option value="Valera">Valera</option>
								<option value="Valle de la Pascua">Valle de la Pascua</option>
								<option value="Villa de Cura">Villa de Cura</option>
								<option value="Yaritagua">Yaritagua</option>
								<option value="Zaraza">Zaraza</option>
							</select>
						</div>
						<div class="col-sm-2">
							<input type="text" name="municipio" value="<?php echo set_value('municipio') ?>" class="form-control" id="municipio" placeholder="Municipio" maxlength="150" required>
						</div>
						<div class="col-sm-2">
							<select name="estado" value="<?php echo set_value('estado') ?>" class="col-sm-2 form-control" required>
								<option value="Defecto">Estado</option>
								<option value="Amazonas">Amazonas</option>
								<option value="Anzoátegui">Anzoátegui</option>
								<option value="Apure">Apure</option>
								<option value="Aragua">Aragua</option>
								<option value="Barinas">Barinas</option>
								<option value="Bolívar">Bolívar</option>
								<option value="Carabobo">Carabobo</option>
								<option value="Cojedes">Cojedes</option>
								<option value="Delta Amacuro">Delta Amacuro</option>
								<option value="Distrito Capital">Distrito Capital</option>
								<option value="Falcón">Falcón</option>
								<option value="Guárico">Guárico</option>
								<option value="Lara">Lara</option>
								<option value="Mérida">Mérida</option>
								<option value="Miranda">Miranda</option>
								<option value="Monagas">Monagas</option>
								<option value="Nueva Esparta">Nueva Esparta</option>
								<option value="Portuguesa">Portuguesa</option>
								<option value="Sucre">Sucre</option>
								<option value="Táchira">Táchira</option>
								<option value="Trujillo">Trujillo</option>
								<option value="Vargas">Vargas</option>
								<option value="Yaracuy">Yaracuy</option>
								<option value="Zulia">Zulia</option>
							</select>
						</div>
						<div class="col-sm-2">
							<input type="text" name="parroquia" value="<?php echo set_value('parroquia') ?>" class="form-control" id="parroquia" placeholder="Parroquia" maxlength="150" required>
						</div>
					</div>
					<div class="row" style="margin-top:1%">
						<div class="col-sm-3">
							<input type="text" name="cod_postal" value="<?php echo set_value('cod_postal') ?>" class="form-control" id="cod_postal" placeholder="Código Postal" maxlength="10" required>
						</div>
						<div class="col-sm-3">
							<select name="pais" value="<?php echo set_value('pais') ?>" class="col-sm-3 form-control" required>
								<option value="Defecto">País</option>
								<option value="Afganistán">Afganistán</option>
								<option value="Albania">Albania</option>
								<option value="Alemania">Alemania</option>
								<option value="Andorra">Andorra</option>
								<option value="Angola">Angola</option>
								<option value="Antigua y Barbuda">Antigua y Barbuda</option>
								<option value="Arabia Saudita">Arabia Saudita</option>
								<option value="Argelia">Argelia</option>
								<option value="Argentina">Argentina</option>
								<option value="Armenia">Armenia</option>
								<option value="Australia">Australia</option>
								<option value="Austria">Austria</option>
								<option value="Azerbaiyán">Azerbaiyán</option>
								<option value="Bahamas">Bahamas</option>
								<option value="Bangladés">Bangladés</option>
								<option value="Barbados">Barbados</option>
								<option value="Baréin">Baréin</option>
								<option value="Bélgica">Bélgica</option>
								<option value="Belice">Belice</option>
								<option value="Benín">Benín</option>
								<option value="Bielorrusia">Bielorrusia</option>
								<option value="Birmania">Birmania</option>
								<option value="Bolivia">Bolivia</option>
								<option value="Bosnia-Herzegovina">Bosnia-Herzegovina</option>
								<option value="Botsuana">Botsuana</option>
								<option value="Brasil">Brasil</option>
								<option value="Brunéi">Brunéi</option>
								<option value="Bulgaria">Bulgaria</option>
								<option value="Burkina Faso">Burkina Faso</option>
								<option value="Burundi">Burundi</option>
								<option value="Bután">Bután</option>
								<option value="Cabo Verde">Cabo Verde</option>
								<option value="Camboya">Camboya</option>
								<option value="Camerún">Camerún</option>
								<option value="Canadá">Canadá</option>
								<option value="Catar">Catar</option>
								<option value="Chad">Chad</option>
								<option value="Chile">Chile</option>
								<option value="China">China</option>
								<option value="Chipre">Chipre</option>
								<option value="Colombia">Colombia</option>
								<option value="Comoras">Comoras</option>
								<option value="Congo">Congo</option>
								<option value="Corea del Norte">Corea del Norte</option>
								<option value="Corea del Sur">Corea del Sur</option>
								<option value="Costa de Marfil">Costa de Marfil</option>
								<option value="Costa Rica">Costa Rica</option>
								<option value="Croacia">Croacia</option>
								<option value="Cuba">Cuba</option>
								<option value="Dinamarca">Dinamarca</option>
								<option value="Dominica">Dominica</option>
								<option value="Ecuador">Ecuador</option>
								<option value="Egipto">Egipto</option>
								<option value="El Salvador">El Salvador</option>
								<option value="Emiratos Árabes Unidos">Emiratos Árabes Unidos</option>
								<option value="Eritrea">Eritrea</option>
								<option value="Eslovaquia">Eslovaquia</option>
								<option value="Eslovenia">Eslovenia</option>
								<option value="España">España</option>
								<option value="Estados Unidos">Estados Unidos</option>
								<option value="Estonia">Estonia</option>
								<option value="Etiopía">Etiopía</option>
								<option value="Filipinas">Filipinas</option>
								<option value="Finlandia">Finlandia</option>
								<option value="Fiyi">Fiyi</option>
								<option value="Francia">Francia</option>
								<option value="Gabón">Gabón</option>
								<option value="Gambia">Gambia</option>
								<option value="Georgia">Georgia</option>
								<option value="Ghana">Ghana</option>
								<option value="Granada">Granada</option>
								<option value="Grecia">Grecia</option>
								<option value="Guatemala">Guatemala</option>
								<option value="Guinea">Guinea</option>
								<option value="Guinea Ecuatorial">Guinea Ecuatorial</option>
								<option value="Guinea-Bisáu">Guinea-Bisáu</option>
								<option value="Guyana">Guyana</option>
								<option value="Haití">Haití</option>
								<option value="Honduras">Honduras</option>
								<option value="Hungría">Hungría</option>
								<option value="India">India</option>
								<option value="Indonesia">Indonesia</option>
								<option value="Irak">Irak</option>
								<option value="Irán">Irán</option>
								<option value="Irlanda">Irlanda</option>
								<option value="Islandia">Islandia</option>
								<option value="Islas Marshall">Islas Marshall</option>
								<option value="Islas Salomón">Islas Salomón</option>
								<option value="Israel">Israel</option>
								<option value="Italia">Italia</option>
								<option value="Jamaica">Jamaica</option>
								<option value="Japón">Japón</option>
								<option value="Jordania">Jordania</option>
								<option value="Kazajistán">Kazajistán</option>
								<option value="Kenia">Kenia</option>
								<option value="Kirguistán">Kirguistán</option>
								<option value="Kiribati">Kiribati</option>
								<option value="Kosovo">Kosovo</option>
								<option value="Kuwait">Kuwait</option>
								<option value="Laos">Laos</option>
								<option value="Lesoto">Lesoto</option>
								<option value="Letonia">Letonia</option>
								<option value="Líbano">Líbano</option>
								<option value="Liberia">Liberia</option>
								<option value="Libia">Libia</option>
								<option value="Liechtenstein">Liechtenstein</option>
								<option value="Lituania">Lituania</option>
								<option value="Luxemburgo">Luxemburgo</option>
								<option value="Macedonia">Macedonia</option>
								<option value="Madagascar">Madagascar</option>
								<option value="Malasia">Malasia</option>
								<option value="Malaui">Malaui</option>
								<option value="Maldivas">Maldivas</option>
								<option value="Malí">Malí</option>
								<option value="Malta">Malta</option>
								<option value="Marruecos">Marruecos</option>
								<option value="Mauricio">Mauricio</option>
								<option value="Mauritania">Mauritania</option>
								<option value="México">México</option>
								<option value="Micronesia">Micronesia</option>
								<option value="Moldavia">Moldavia</option>
								<option value="Mónaco">Mónaco</option>
								<option value="Mongolia">Mongolia</option>
								<option value="Montenegro">Montenegro</option>
								<option value="Mozambique">Mozambique</option>
								<option value="Namibia">Namibia</option>
								<option value="Nauru">Nauru</option>
								<option value="Nepal">Nepal</option>
								<option value="Nicaragua">Nicaragua</option>
								<option value="Níger">Níger</option>
								<option value="Nigeria">Nigeria</option>
								<option value="Noruega">Noruega</option>
								<option value="Nueva Zelanda">Nueva Zelanda</option>
								<option value="Omán">Omán</option>
								<option value="Países Bajos">Países Bajos</option>
								<option value="Pakistán">Pakistán</option>
								<option value="Palaos">Palaos</option>
								<option value="Palestina">Palestina</option>
								<option value="Panamá">Panamá</option>
								<option value="Papúa Nueva Guinea">Papúa Nueva Guinea</option>
								<option value="Paraguay">Paraguay</option>
								<option value="Perú">Perú</option>
								<option value="Polonia">Polonia</option>
								<option value="Portugal">Portugal</option>
								<option value="Reino Unido">Reino Unido</option>
								<option value="República Centroafricana">República Centroafricana</option>
								<option value="República Checa">República Checa</option>
								<option value="República Democrática del Congo">República Democrática del Congo</option>
								<option value="República Dominicana">República Dominicana</option>
								<option value="Ruanda">Ruanda</option>
								<option value="Rumania">Rumania</option>
								<option value="Rusia">Rusia</option>
								<option value="Samoa">Samoa</option>
								<option value="San Cristóbal y Nieves">San Cristóbal y Nieves</option>
								<option value="San Marino">San Marino</option>
								<option value="San Vicente y las Granadinas">San Vicente y las Granadinas</option>
								<option value="Santa Lucía">Santa Lucía</option>
								<option value="Santo Tomé y Príncipe">Santo Tomé y Príncipe</option>
								<option value="Senegal">Senegal</option>
								<option value="Serbia">Serbia</option>
								<option value="Seychelles">Seychelles</option>
								<option value="Sierra Leona">Sierra Leona</option>
								<option value="Singapur">Singapur</option>
								<option value="Siria">Siria</option>
								<option value="Somalia">Somalia</option>
								<option value="Sri Lanka">Sri Lanka</option>
								<option value="Suazilandia">Suazilandia</option>
								<option value="Sudáfrica">Sudáfrica</option>
								<option value="Sudán">Sudán</option>
								<option value="Sudán del Sur">Sudán del Sur</option>
								<option value="Suecia">Suecia</option>
								<option value="Suiza">Suiza</option>
								<option value="Surinam">Surinam</option>
								<option value="Tailandia">Tailandia</option>
								<option value="Taiwán">Taiwán</option>
								<option value="Tanzania">Tanzania</option>
								<option value="Tayikistán">Tayikistán</option>
								<option value="Timor Oriental">Timor Oriental</option>
								<option value="Togo">Togo</option>
								<option value="Tonga">Tonga</option>
								<option value="Trinidad y Tobago">Trinidad y Tobago</option>
								<option value="Túnez">Túnez</option>
								<option value="Turkmenistán">Turkmenistán</option>
								<option value="Turquía">Turquía</option>
								<option value="Tuvalu">Tuvalu</option>
								<option value="Ucrania">Ucrania</option>
								<option value="Uganda">Uganda</option>
								<option value="Uruguay">Uruguay</option>
								<option value="Uzbekistán">Uzbekistán</option>
								<option value="Vanuatu">Vanuatu</option>
								<option value="Vaticano">Vaticano</option>
								<option value="Venezuela">Venezuela</option>
								<option value="Vietnam">Vietnam</option>
								<option value="Yemen">Yemen</option>
								<option value="Yibuti">Yibuti</option>
								<option value="Zambia">Zambia</option>
								<option value="Zimbabue">Zimbabue</option>
							</select>
						</div>
					</div>
					<div class="row" style="margin-top:1%">
						<div class="col-sm-3">
							<input type="text" name="tel_local" value="<?php echo set_value('tel_local') ?>" class="form-control" id="tel_local" placeholder="Teléfono Local (sólo números)" maxlength="50" pattern="[0-9]{11,50}" title="Sólo se aceptan números y debe tener por lo menos 11 dígitos" required>
						</div>
						<div class="col-sm-3">
							<input type="text" name="tel_celular" value="<?php echo set_value('tel_celular') ?>" class="form-control" id="tel_celular" placeholder="Teléfono Celular (sólo números)" maxlength="50" pattern="[0-9]{11,50}" title="Sólo se aceptan números y debe tener por lo menos 11 dígitos" required>
						</div>
						<div class="col-sm-6">
							<input type="email" name="email" value="<?php echo set_value('email') ?>" class="form-control" id="email" placeholder="Dirección de Correo Electrónico" maxlength="150" required>
						</div>
					</div>
					<div align="center">
						<br>
						A través de este contrato, Corporación Manna C.A. adquiere el derecho de contactar al Titular y/o Cotitular por teléfono, correo postal y/o por comunicaciones electrónicas.<br>
					</div>
					<div class="row">
						<hr width=100% align="center" style="height:1px;background-color:powderblue">
					</div>
					<div class="row">
						<div class="col-sm-12">
							<label for="enrolamiento">Información de Patrocinio y Enrolamiento</label>
						</div>
					</div>
					<div class="row" style="margin-top:1%">
						<div class="col-sm-offset-2 col-sm-2 form_control">
							<label id="enrol_codigo"><font color="red"><?php echo $enrol_codigo ?></font></label>
						</div>
						<div class="col-sm-6 form_control">
							<label id="enrol_nombre_completo"><font color="red"><?php echo $enrol_nombre_completo ?></font></label>
						</div>
					</div>
					<div class="row" style="margin-top:1%">
						<div class="col-sm-offset-2 col-sm-2 form_control">
							<label id="patroc_codigo"><font color="red"><?php echo $patroc_codigo ?></font></label>
						</div>
						<div class="col-sm-6 form_control">
							<label id="patroc_nombre_completo"><font color="red"><?php echo $patroc_nombre_completo ?></font></label>
						</div>
					</div>
					<div class="row">
						<hr width=100% align="center" style="height:1px;background-color:powderblue">
					</div>
					<div class="row">
						<div class="col-sm-12">
							<label for="enrolamiento"><font color="red">(*)</font> Información Bancaria del Titular</label>
						</div>
					</div>
					<div class="row" style="margin-top:1%">
						<div class="col-sm-4">
							<input type="text" name="banco_nombre_cta" value="<?php echo set_value('banco_nombre_cta') ?>" class="form-control" id="banco_nombre_cta" placeholder="Nombre del Titular de la cuenta" maxlength="200" required>
						</div>
						<div class="col-sm-4">
							<input type="text" name="banco_numero_cta" class="form-control" id="banco_numero_cta" placeholder="Número de Cuenta Bancaria (sólo números)" maxlength="20" pattern="[0-9]{13,20}" title="Sólo se aceptan números y debe tener entre 13 y 20 dígitos" required>
						</div>
						<div class="col-sm-4">
							<select name="banco_nombre_bco" value="<?php echo set_value('banco_nombre_bco') ?>" class="col-sm-3 form-control" required>
								<option value="Defecto">Banco</option>
								<option value="100% Banco">100% Banco</option>
								<option value="Bancamiga">Bancamiga</option>
								<option value="Bancaribe">Bancaribe</option>
								<option value="Banco Activo">Banco Activo</option>
								<option value="Banco Agrícola de Venezuela">Banco Agrícola de Venezuela</option>
								<option value="Banco Caroní">Banco Caroní</option>
								<option value="Banco de Exportación y Comercio">Banco de Exportación y Comercio</option>
								<option value="Banco de Venezuela">Banco de Venezuela</option>
								<option value="Banco del Tesoro">Banco del Tesoro</option>
								<option value="Banco Exterior">Banco Exterior</option>
								<option value="Banco Fondo Común">Banco Fondo Común</option>
								<option value="Banco Nacional de Crédito">Banco Nacional de Crédito</option>
								<option value="Banco Occidental de Descuento BOD">Banco Occidental de Descuento BOD</option>
								<option value="Banco Plaza">Banco Plaza</option>
								<option value="Banco Sofitasa">Banco Sofitasa</option>
								<option value="Bancoex">Bancoex</option>
								<option value="Bancrecer">Bancrecer</option>
								<option value="Banesco">Banesco</option>
								<option value="Banfanb">Banfanb</option>
								<option value="Bangente">Bangente</option>
								<option value="Banplus">Banplus</option>
								<option value="BBVA Provincial">BBVA Provincial</option>
								<option value="Bicentenario Banco Universal">Bicentenario Banco Universal</option>
								<option value="Citibank">Citibank</option>
								<option value="DEL SUR">DEL SUR</option>
								<option value="Mercantil">Mercantil</option>
								<option value="Mi Banco">Mi Banco</option>
								<option value="Novo Banco">Novo Banco</option>
								<option value="Venezolano de Crédito">Venezolano de Crédito</option>
							</select>
						</div>
					</div>
					<div class="row" style="margin-top:1%">
						<div class="col-sm-3">
							<input type="text" name="banco_sucursal" value="<?php echo set_value('banco_sucursal') ?>" class="form-control" id="banco_sucursal" placeholder="Sucursal bancaria" maxlength="150" required>
						</div>
						<div class="col-sm-3">
							<select name="banco_estado" value="<?php echo set_value('banco_estado') ?>" class="col-sm-2 form-control" required>
								<option value="Defecto">Estado</option>
								<option value="Amazonas">Amazonas</option>
								<option value="Anzoátegui">Anzoátegui</option>
								<option value="Apure">Apure</option>
								<option value="Aragua">Aragua</option>
								<option value="Barinas">Barinas</option>
								<option value="Bolívar">Bolívar</option>
								<option value="Carabobo">Carabobo</option>
								<option value="Cojedes">Cojedes</option>
								<option value="Delta Amacuro">Delta Amacuro</option>
								<option value="Distrito Capital">Distrito Capital</option>
								<option value="Falcón">Falcón</option>
								<option value="Guárico">Guárico</option>
								<option value="Lara">Lara</option>
								<option value="Mérida">Mérida</option>
								<option value="Miranda">Miranda</option>
								<option value="Monagas">Monagas</option>
								<option value="Nueva Esparta">Nueva Esparta</option>
								<option value="Portuguesa">Portuguesa</option>
								<option value="Sucre">Sucre</option>
								<option value="Táchira">Táchira</option>
								<option value="Trujillo">Trujillo</option>
								<option value="Vargas">Vargas</option>
								<option value="Yaracuy">Yaracuy</option>
								<option value="Zulia">Zulia</option>
							</select>
						</div>
						<div class="col-sm-3">
							<select name="banco_tipo_cta" value="<?php echo set_value('banco_tipo_cta') ?>" class="col-sm-3 form-control" required>
								<option value="Defecto">Tipo de cuenta</option>
								<option value="corriente">Corriente</option>
								<option value="ahorro">Ahorro</option>
							</select>
						</div>
					</div>
					<div class="row" style="margin-top:1%" align="right">
						<div class="form_group">
							<div class="col-sm-12 control-label">
								<button type="submit" id="registro" class="btn btn-default">Continuar </button>
								<button type="submit" id="salir" class="btn btn-default" onclick="redirect(base_url())">Salir</button>
							</div>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<!--
					</div>
					<div class="form-group">
-->