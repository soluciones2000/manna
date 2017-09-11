<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<br>
<div class="container">
	<div class="col-sm-9 center-block no-float">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo $panel_title ?></h3>
			</div>
			<div class="panel-body">
				<?php if(validation_errors()){ echo '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>'; } ?>
				<?php echo form_open(base_url(),'class="form-horizontal"'); ?>
					<div class="row">
						<div class="col-sm-10 control-label">
							<h3>Su código de Cliente Preferencial es: <?php echo trim($cod_clte) ?></h3>
						</div>
					</div>

					<div class="form_group" align="center">
						<div class="col-sm-11 control-label">
							<button type="submit" id="salir" class="btn btn-default" onclick="base_url()">Salir</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
