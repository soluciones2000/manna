<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<br>
<div class="container">
	<div class="col-md-12 center-block no-float">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo $panel_title ?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<p align="center"><b>Los campos marcados con <font color="red">(*)</font> son obligatorios</b></p>
				</div>
				<!--<form action="<?php echo base_url(); ?>entrar" method="POST">-->
				<?php if(validation_errors()){ echo '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>'; } ?>
				<?php echo form_open('registro','class="form-horizontal"'); ?>
					<div class="row">
						<div class="form_group">
							<label for="tipo_persona" class="col-sm-5 control-label">Tipo de afiliado</label>
							<div class="radio-inline col-sm-6" >
								<div class="col-sm-3">
									<input type="radio" name="tipo_persona" id="tipo_persona" value="Natural" checked>Natural
								</div>
								<div class="col-sm-3">
									<input type="radio" name="tipo_persona" id="tipo_persona" value="Jurídico">Jurídico
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form_group">
							<label for="nacionalidad" class="col-sm-5 control-label">Nacionalidad</label>
							<div class="radio-inline col-sm-6" >
								<div class="col-sm-3">
									<input type="radio" name="nacionalidad" id="nacionalidad" value="Local" checked>Local (VE)
								</div>
								<div class="col-sm-3">
									<input type="radio" name="nacionalidad" id="nacionalidad" value="Extranjero">Extranjero
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form_group">
							<label for="tipo_afiliado" class="col-sm-5 control-label">Paquete de afiliación</label>
							<div class="radio-inline col-sm-6" >
								<div class="col-sm-3">
									<input type="radio" name="tipo_afiliado" id="tipo_afiliado" value="Premium" checked>Premium
								</div>
								<div class="col-sm-3">
									<input type="radio" name="tipo_afiliado" id="tipo_afiliado" value="VIP">VIP
								</div>
								<div class="col-sm-3">
									<input type="radio" name="tipo_afiliado" id="tipo_afiliado" value="Oro">Oro
								</div>
							</div>
							<label for="tipo_afiliado" class="col-sm-5 control-label">Kit de inicio</label>
							<div class="radio-inline col-sm-6" >
								<div class="col-sm-3">
									<input type="radio" name="tipo_kit" id="tipo_kit" value="Hogar">Hogar
								</div>
								<div class="col-sm-3">
									<input type="radio" name="tipo_kit" id="tipo_kit" value="Teatro">Teatro
								</div>
								<div class="col-sm-3">
									<input type="radio" name="tipo_kit" id="tipo_kit" value="Todas" checked>Todas las líneas
								</div>
							</div>
						</div>
					</div>
					<br>
<!-- ******************************************************************************* -->
<!--
					<div class="row">
						<label for="monto" class="col-sm-5 control-label">Monto</label>
						<label for="bspago" id="bspago" class="col-sm-6">
							<font color="red">Bs. <?php echo number_format(350000,2,',','.'); ?></font>
						</label>
					</div>
					<br>
-->
					<div class="row">
						<label for="fechapago" class="col-sm-5 control-label"><font color="red">(*)</font> Fecha de pago (dd/mm/yyyy)</label>
						<div class="col-sm-2">
<!--
							<input type="date" name="fechapago" class="form-control" id="fechapago" id="datepicker" size="10" />
-->
							<input type="date" name="fechapago" class="form-control" id="fechapago" maxlength="10" minlength="10" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" title="El formato de este campo es 99/99/9999" placeholder="dd/mm/yyyy" required>
						</div>
					</div>
					<br>
					<div class="row">
						<label for="numcomprobante" class="col-sm-5 control-label"><font color="red">(*)</font> Número de comprobante (10 dígitos, complete con 0)</label>
						<div class="col-sm-3">
							<input type="text" name="numcomprobante" class="form-control" id="numcomprobante" maxlength="10" minlength="10" pattern="[0-9]{10}" title="Sólo se aceptan números y debe tener 10 dígitos complete con ceros si es necesario" placeholder="Número de comprobante" required>
						</div>
					</div>
					<br>
					<div class="row">
						<label for="bancoorigen" class="col-sm-5 control-label"><font color="red">(*)</font> Banco de origen</label>
						<div class="col-sm-4">
							<select name="bancoorigen" value="<?php echo set_value('bancoorigen') ?>" class="col-sm-3 form-control" required>
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
<!-- ******************************************************************************* -->
					<br>
					<div class="row">
						<label for="enrol_codigo" class="col-sm-5 control-label"><font color="red">(*)</font> Código Enrolador (5 caracteres)</label>
						<div class="col-sm-2">
							<input type="text" style="text-transform:uppercase;" name="enrol_codigo" value="<?php echo set_value('enrol_codigo') ?>" class="form-control" id="enrol_codigo" placeholder="Cód. Enrolador" minlength="5" maxlength="5" pattern="[0-9|A-Z|a-z]{5}" title="Este campo sólo puede tener números o letras" required>
						</div>
					</div>
					<br>
					<div class="row">
						<label for="patroc_codigo" class="col-sm-5 control-label"><font color="red">(*)</font> Código Patrocinador (5 caracteres)</label>
						<div class="col-sm-2">
							<input type="text" style="text-transform:uppercase;" name="patroc_codigo" value="<?php echo set_value('patroc_codigo') ?>" class="form-control" id="patroc_codigo" placeholder="Cód. Patrocinador" minlength="5" maxlength="5" pattern="[0-9|A-Z|a-z]{5}" title="Este campo sólo puede tener números o letras" required>
						</div>
					</div>

					<br>
					<div class="row">
						<label for="patroc_codigo" class="col-sm-5 control-label">¿Desea que su kit sea enviado a su dirección?</label>
						<div class="col-sm-2">
							<input type="checkbox" name="envio">
						</div>
					</div>
					<br>
					<div class="row">
						<label for="patroc_codigo" class="col-sm-5 control-label">Si desea que se envíe el pedido indique una dirección<br>Si no deje en blanco</label>
						<div class="col-sm-4">
							<textarea type="text" name="direccion_envio" value="<?php echo set_value('direccion_envio') ?>" class="form-control" id="direccion_envio" placeholder="Dirección de envío" maxlength="500" title="Escriba la dirección a donde desea que se envíe su KIT, si desea retirarlo por la oficina desmarque la casilla y déje este campo en blanco"></textarea>
						</div>
					</div>



					<div class="form_group" align="right">
						<div class="col-sm-12 control-label">
							<button type="submit" id="registro" class="btn btn-default">Continuar </button>
							<button type="submit" id="salir" class="btn btn-default" onclick="redirect(base_url())">Salir</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
