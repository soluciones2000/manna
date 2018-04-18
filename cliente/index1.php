<?php 
$nombre = isset($_SESSION['user']) ? utf8_encode($_SESSION['user']) : '';
$codigo = isset($_SESSION['codigo']) ? $_SESSION['codigo'] : '';
$usuario = $nombre ? true : false;


?>
<!doctype html>
<html lang="es">
<head>

	<meta property="og:title" content="Index - Corporación Manna ::. La Provisión que cambiará tu vida">
	<meta property="og:site_name" content="Corporación Manna ::. La Provisión que cambiará tu vida">
	<meta property="og:url" content="http://www.corporacionmanna.com">
	<meta property="og:description" content="Corporación Manna ::. La Provisión que cambiará tu vida">
	<meta property="og:type" content="website">
	<meta property="og:image" content="images/l_allnet.png" />
	
	<meta charset="UTF-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Corporación Manna ::. La Provisión que cambiará tu vida</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

	<!-- CSS Files -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
	
	

	<!-- CSS -->
	<link href="assets/css/allneat.css" rel="stylesheet" />
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-75009044-1', 'auto');
  ga('send', 'pageview');

</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
.style1 {font-size: 28px}
.style2 {font-size: 16px}
-->
</style>



<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
jQuery(function($){
	$.datepicker.regional['es'] = {
		closeText: 'Cerrar',
		prevText: '&#x3c;Ant',
		nextText: 'Sig&#x3e;',
		currentText: 'Hoy',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
		'Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
		dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
		weekHeader: 'Sm',
		dateFormat: 'dd-M-yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['es']);
	$.datepicker.setDefaults({
	  showOn: "both"
	});
});

$(document).ready(function() {
   $("#datepicker").datepicker();
});
</script>

</head>

<body ng-app="" class="index-page">




<!-- Navbar -->
<nav class="navbar navbar-transparent navbar-fixed-top navbar-color-on-scroll">
	<div class="container">
        <div class="navbar-header">
	    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-index">
	        	<span class="sr-only">Toggle navigation</span>
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>	    	</button>
	    	<a href="index.php">
	        	<div class="logo-container">
	                
	                    <img src="images/logoinvertido60.png" alt="Corporación Manna ::. La Provisión que cambiará tu vida" rel="tooltip" title="Ir a la Pagina Principal" data-placement="bottom" data-html="true">
	                
	                    
				</div>
	      	</a>
	    </div>

	    <div class="collapse navbar-collapse" id="navigation-index">
	    	<ul class="nav navbar-nav navbar-right">
	    		
				<li>
					<a rel="tooltip" title="Facebook" data-placement="bottom" href="https://www.facebook.com/mannadevenezuelaoficial/notifications/" target="_blank" class="btn btn-white btn-simple btn-just-icon">
						<i class="fa fa-facebook-square"></i>					</a>				</li>				
				<li>
					<a rel="tooltip" title="Twitter" data-placement="bottom" href="https://twitter.com/corpmanna" target="_blank" class="btn btn-white btn-simple btn-just-icon">
						<i class="fa fa-twitter"></i>					</a>				</li>
				

				<li>
					<a rel="tooltip" title="Instagram" data-placement="bottom" href="https://www.instagram.com/corporacionmannaoficial/" target="_blank" class="btn btn-white btn-simple btn-just-icon">
						<i class="fa fa-instagram"></i>					</a>				</li>
	
	    	</ul>
	    </div>
	</div>
</nav><!-- End Navbar -->

<div class="wrapper">
	<div class="visible-xs visible-sm"><br><br><br></div>
<div class="header header-filter">
	<div class="container-fluid">
		<!-- Carousel Card -->					
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- Wrapper for slides -->
					<div class="carousel-inner">
						<div class="item active">
							<div class="html_div" style="background-image: url('images/img_allneat5.jpg');background-size: 100% auto;background-repeat: no-repeat;">
								<div class="container">
									<div class="row" style="height:20vh;"></div>
									<div class="row">
										<!-- <div class="col-xs-7 hidden-xs">
											 <h2 class="textoamarillo sombra">Feliz Navidad</h2>
											<h2 class="textoamarillo sombra">y Pr&oacute;spero A&ntilde;o Nuevo...</h2> 
										</div>
										<div class="col-xs-5 hidden-xs">
											<img src="images/logo300.png" class="img-responsive"> 
										</div> -->
									</div>
								</div>
							</div>
							<div class="carousel-caption hidden-xs">
								
							</div>
						</div>
						
</div>						
					</div>
			</div>					
		<!-- End Carousel Card -->
	</div>
</div>










	<div class="main main-raised">
	    <div class="section">
	        <div class="container tim-container">

	            <div id="images">

<table width="60%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>

    <td>


<div class="card card-signup">

<?php
		switch ($mensaje) {
			case 'ci':
				echo '<div style="text-align:center">';
					echo '<p><b><font color="red">DEBE INTRODUCIR UN CÓDIGO VÁLIDO.</font></b></p>';
				echo '</div>';
				break;
			case 'cb':
				echo '<div style="text-align:center">';
					echo '<p><b><font color="red">NO PUEDE DEJAR EL CÓDIGO EN BLANCO.</font></b></p>';
				echo '</div>';
				break;
		}
	?>
							<form name="admin" method="post" action="acceso.php">
								<div class="header header-primary text-center">
									
									<h4 class="textoamarillo sombra">Introduzca su código de cliente preferencial (5 dígitos):</h4>
									
								</div>
								
								
								<br>
								
								<div class="content">

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">face</i>
										</span>
										<input type="text" name="codigo" maxlength="5" size="5" class="form-control" placeholder="Numero de Cliente...">
									</div>

								</div>
								<p>
								<div class="footer text-center">
								<button type="submit" name="submit" class="btn btn-primary btn-block">
						
						ENVIAR
						
						</button>
									
								</div>
							</form>
				</div>	
	
	</td>

  </tr>

   
</table>

	                		
			
	        <div class="clearfix"></div>
			

	    </div>
					
	            </div>

	        </div>
	    </div>
	</div>



    <footer class="footer">
	    <div class="container">


	            	<footer class="footer footer-white footer-big">
	            		<div class="container">

	            			<div class="content">
	            				<div class="row">

	            					<div class="col-md-3">
	            						<span class="style1">Corporación Manna</span>
								<br>
								<p>		
										<p class="style2">
Principios
</p>
										<p align="justify">Son nuestros estándares, la bandera que siempre se alzará por encima de la organización, para marcar y establecer los lineamientos éticos y operativos.</p>
            					  </div>
	            					<div class="col-md-2">
	            						
	            					</div>
	            					<div class="col-md-2">
	            						
	            					</div>

	            					<div class="col-md-2">
	            						
	            					</div>
	            					
									
			<div class="col-sm-3 hidden-xs">
				
	        		<img src="images/logo_all.jpg">
	        	
			</div>
									

	            				</div>
	            			</div>

	            			
	            			
	            		</div>
	            	</footer>


	        
	    </div>
	</footer>
		<br>
	<p>
<br>
	<p>

	</div>

<!-- Sart Modal -->
<!-- Sart Modal -->

<!--  End Modal --><!--  End Modal -->


</body>
	<!--   Core JS Files   -->
	<script src="assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/js/material.min.js"></script>

	<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ 
	<script src="assets/js/nouislider.min.js" type="text/javascript"></script>-->

	<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
	<script src="assets/js/bootstrap-datepicker.js" type="text/javascript"></script>

	<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
	<script src="assets/js/material-kit.js" type="text/javascript"></script>

</html>


	
	</div>
	</footer></div>
	            							