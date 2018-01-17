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
					<p align="center"><b>Los campos marcados con <font color="red">(*)</font> son obligatorios</b></p>
				</div>
				<!--<form action="<?php echo base_url(); ?>entrar" method="POST">-->
				<?php if(validation_errors()){ echo '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>'; } ?>
				<?php
					$hidden = array(
							'tipo_persona' => 'Especialista',
							'tipo_afiliado' => 'Premium',
							'tipo_kit' => 'Todas',
							'fechapago' => date('d/m/Y'),
							'numcomprobante' => '',
							'bancoorigen' => 'Defecto',
							'envio' => '',
							'direccion_envio' => ''
							);
				?>
				<?php echo form_open('regmedico','class="form-horizontal"',$hidden); ?>
					<div class="row">
						<div class="form_group">
							<label for="nacionalidad" class="col-sm-5 control-label">Nacionalidad</label>
							<?php if (set_value('nacionalidad')==="Extranjero"): ?>
								<div class="radio-inline col-sm-6" >
									<div class="col-sm-3">
										<input type="radio" name="nacionalidad" id="nacionalidad" value="Local">Local (VE)
									</div>
									<div class="col-sm-3">
										<input type="radio" name="nacionalidad" id="nacionalidad" value="Extranjero" checked>Extranjero
									</div>
								</div>
							<?php else: ?>
								<div class="radio-inline col-sm-6" >
									<div class="col-sm-3">
										<input type="radio" name="nacionalidad" id="nacionalidad" value="Local" checked>Local (VE)
									</div>
									<div class="col-sm-3">
										<input type="radio" name="nacionalidad" id="nacionalidad" value="Extranjero">Extranjero
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
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

<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
