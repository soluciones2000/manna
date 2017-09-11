<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <a class="navbar-brand" href="/"><img src="recursos/img/<?php echo $_SESSION['emp_logo'] ?>" width=117.6px height=34px /></a>

        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
<!--
      <a class="navbar-brand" href="#">
        <div>
          <img src="<?php echo base_url(); ?>recursos/img/<?php echo $_SESSION['emp_logo'] ?>" class="img-responsive" alt="Responsive image" width="8%" height="auto" >
        </div>
        <div>
           <?php echo $_SESSION['emp_nombre'] ?> - Pasarela de pagos
        </div>
      </a>
-->
      <a class="navbar-brand" href="#"><?php echo $_SESSION['emp_nombre'] ?> - Módulo de afiliación de aliados comerciales
      </a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li <?php if(isset($active) && $active=="registro"){ echo 'class="active"';} ?> class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Registro de afiliados<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url(); ?>medico">Médico o profesional de la salud</a></li>
            <li><a href="<?php echo base_url(); ?>opcion">Aliados comerciales independientes</a></li>
          </ul>
        </li>
      
        <li <?php if(isset($active) && $active=="contacto"){ echo 'class="active"';} ?>><a href="<?php echo base_url(); ?>contacto">Contáctenos</a></li>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container">
  <?php
    if ($this->session->flashdata('mensaje_error') != NULL) {
      echo '<div class="alert alert-danger" role="alert">' . $this->session->flashdata('mensaje_error') . '</div>';
    }
    if ($this->session->flashdata('mensaje_success') != NULL) {
      echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('mensaje_success') . '</div>';
    }
  ?>
</div>

        <!--
        <li <?php if(isset($active) && $active=="reporte"){ echo 'class="active"';} ?>><a href="<?php echo base_url(); ?>reg_pdf">Reporte PDF</a></li>

        <?php if (!empty($_SESSION['is_logged_in'])): ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bienvenido <?php echo $_SESSION['nombre']; ?> <span class="  caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url(); ?>cambio">Cambiar clave</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="<?php echo base_url(); ?>logout">Salir</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li <?php if(isset($active) && $active=="login"){ echo 'class="active"';} ?> ><a href="<?php echo base_url(); ?>login">Administración del sitio</a></li>
        <?php endif; ?>
        -->
