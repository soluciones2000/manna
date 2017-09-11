<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<br>
<div class="container">
	<div class="col-md-9 center-block no-float">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo $panel_title ?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<p align="center"><b>Los cambpos marcados con <font color="red">(*)</font> son obligatorios</b></p>
				</div>
				<!--<form action="<?php echo base_url(); ?>entrar" method="POST">-->
				<?php if(validation_errors()){ echo '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>'; } ?>
				<?php echo form_open('reg_cliente','class="form-horizontal"'); ?>
					<div class="row">
						<label for="clte_nombre" class="col-sm-5 control-label"><font color="red">(*)</font> Nombre</label>
						<div class="col-sm-5">
							<input type="text" name="clte_nombre" value="<?php echo set_value('clte_nombre') ?>" class="form-control" id="clte_nombre" placeholder="Nombre para la factura" maxlength="150" required>
						</div>
					</div>
					<br>
					<div class="row">
						<label for="clte_cedula" class="col-sm-5 control-label"><font color="red">(*)</font>Cédula o R.I.F.</label>
						<div class="col-sm-2">
							<input type="text" style="text-transform:uppercase;" name="clte_cedula" value="<?php echo set_value('clte_cedula') ?>" class="form-control" id="clte_cedula" placeholder="Cédula o R.I.F. (sin puntos ni guiones)" minlength="6" maxlength="10" pattern="[V|E|J|0-9]{6-10}" title="Este campo sólo puede tener números o las letras V, E y J" required>
						</div>
					</div>
					<br>
					<div class="row">
						<label for="clte_telefono" class="col-sm-5 control-label"><font color="red">(*)</font> Teléfono</label>
						<div class="col-sm-3">
							<input type="text" name="clte_telefono" value="<?php echo set_value('clte_telefono') ?>" class="form-control" id="clte_telefono" placeholder="No. de teléfono" maxlength="50" pattern="[0-9]{0-50}" title="Este campo sólo puede tener números" required>
						</div>
					</div>
					<br>
					<div class="row">
						<label for="clte_email" class="col-sm-5 control-label"><font color="red">(*)</font> Correo electrónico</label>
						<div class="col-sm-5">
							<input type="email" name="clte_email" value="<?php echo set_value('clte_email') ?>" class="form-control" id="clte_email" placeholder="Correo electrónico" minlength="5" maxlength="150" required>
						</div>
					</div>
					<br>
					<div class="row">
						<label for="clte_direccion" class="col-sm-5 control-label"><font color="red">(*)</font> Dirección fiscal</label>
						<div class="col-sm-4">
							<textarea type="text" name="clte_direccion" value="<?php echo set_value('clte_direccion') ?>" class="form-control" id="clte_direccion" placeholder="Dirección fiscal" maxlength="200" required></textarea>
						</div>
					</div>
					<br>
					<div class="row">
						<label for="clte_direccion_envio" class="col-sm-5 control-label">Dirección de envío</label>
						<div class="col-sm-4">
							<textarea type="text" name="clte_direccion_envio" value="<?php echo set_value('clte_direccion_envio') ?>" class="form-control" id="clte_direccion_envio" placeholder="(opcional)" maxlength="200" required></textarea>
						</div>
					</div>
					<br>
					<div class="row">
						<label for="patroc_codigo" class="col-sm-5 control-label"><font color="red">(*)</font> Código Patrocinador (5 caracteres)</label>
						<div class="col-sm-2">
							<input type="text" style="text-transform:uppercase;" name="patroc_codigo" value="<?php echo set_value('patroc_codigo') ?>" class="form-control" id="patroc_codigo" placeholder="Cód. Patrocinador" minlength="5" maxlength="5" pattern="[0-9|A-Z|a-z]{5}" title="Este campo sólo puede tener números o letras" required>
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
