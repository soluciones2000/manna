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
							<div class="html_div" style="background-image: url('images/img_allneat4.jpg');background-size: 100% auto;background-repeat: no-repeat;">
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

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>

    <td>


<div class="card card-signup">


							
								<div class="header header-primary text-center">
									
									<h4 class="textoamarillo sombra">Resguardamos la Salud de tu Hogar con Productos de Excelente Calidad</h4>
									
								</div>
								
								
								<br>
								
								<div class="content">

									
						<?
									
$ant = "pago";
$bnr = true;
$des = "orden";
//include_once("menu.php");
//include_once("catalogo.php");
//include_once("promocion.php");
//include_once("pie.php");
									
						?>
						
						
<!--
<script type="text/javascript">
	function cambiaorden(codigo,cantidad){
		alert(codigo);
		var x = '<?php echo $_SESSION["orden"]; ?>';
//		cantidad++;
//		document.getElementById("verorden").innerHTML = "valor"+"("+cantidad+")";
		alert(x+"-"+cantidad);
	} 
</script>
-->
		<table border="0" align="center" width="100%" height="10%">
			<tr>
				<td width="20%">
					<font face="arial">
						<?php if ($ant=="pago"): ?>
							<a href="validacliente.php?ruta=pago" id="anterior">Reportar pago</a>
							<br>
							<a href="validacliente.php?ruta=tracking" id="tracking">Seguimiento de órdenes</a>
						<?php endif ?>
						<?php if ($ant=="catalogo"): ?>
							<a href="inicio.php" id="anterior">Volver al Catálogo</a>
						<?php endif ?>
						<?php if ($ant=="orden"): ?>
							<a href="#" id="anterior">Ver orden</a>
						<?php endif ?>
					</font>
				</td>
				<td align="center" width="60%">
					<?php
						if ($bnr) {
							$query = "SELECT * FROM banners where activa='1'";
							$result = mysql_query($query,$link);
							while ($row = mysql_fetch_array($result)) {
								if ($row["orden"]) {
									echo '<a href="agrega.php?prd='.$row["id_pro"].'">';
										echo '<img SRC="banners/'.trim($row["banner"]).'" width="60%" height="5%" alt="Agregar a la orden" title="Agregar a la orden">';
									echo '</a>';
								} else {
									echo '<img SRC="banners/'.trim($row["banner"]).'" width="60%" height="5%">';
								}
							}
						} else {
							if ($titulo<>'') {
								echo '<h3>'.trim($titulo).'</h3>';
							}
						}
					?>
				</td>
				<td align="right" valign="middle" width="20%" style="padding-right:2%">
					<font face="arial">
<!--						Items en la orden: {{cantidad}}<br>-->
						<?php if ($des=="orden"): ?>
							Items en la orden: <?php echo $_SESSION["cantidad"]; ?><br>
							<?php if ($_SESSION["cantidad"]<>0): ?>
								<a href="orden.php" id="siguiente">Ver orden</a>
							<?php endif ?>
						<?php endif ?>
						<?php if ($des=="checkout"): ?>
							Items en la orden: <?php echo $_SESSION["cantidad"]; ?><br>
						<?php endif ?>
					</font>
				</td>
			</tr>



			<tr>
				<td colspan="3">
					<table border="0" width="100%">
						<?php 
							$query = "SELECT * FROM productos where publico='General' order by familia,id_pro";
							$result = mysql_query($query,$link);
							$contador = 1;
							while($row = mysql_fetch_array($result)) {
								$id_pro = $row["id_pro"];
								$desc_corta = utf8_encode($row["desc_corta"]);
								$desc_pro = trim(utf8_encode($row["desc_pro"]));
								if ($_SESSION["iva2"]<>0.00) {
									$precio_pro = $row["pvp_clipref"]/(1+($_SESSION["iva2"]/100));
								} else {
									$precio_pro = $row["pvp_clipref"];
								}
								$imagen = $row["imagen"];
								if (file_exists('img/'.trim($imagen).'.jpg')) {
									$imagen = 'img/'.trim($imagen).'.jpg';
								} else {
									$imagen = 'img/sin_imagen.jpg';
								}
								if ($precio_pro>0.00) {
									if ($contador==1) {
										echo '<tr>';
									}
									echo '<h3>';
									echo '<td align="center" width="25%" style="padding:2%">';
										echo  '<img SRC="'.trim($imagen).'" width="150px" height="150px" title="'.$desc_pro.'"><br>';
										echo trim($id_pro).'<br>';
										echo trim($desc_corta).'<br>';
										echo 'Precio Bs. '.number_format($precio_pro,2,',','.').'<br>';
									echo '</h3>';	
									
									echo '<a class="btn btn-primary btn-raised btn-round btn-lg" href="agrega.php?prd='.$id_pro.'"><i class="material-icons">add_shopping_cart</i>&nbsp;&nbsp;Agregar a la Orden</a>';
										
										
										
									
									
									
									
									echo '</td>';
									if ($contador==4) {
										echo '</tr>';
										$contador = 0;
									}
									$contador++;
								}
							}
						 ?>
					</table>					
				</td>
			</tr>
		</table>
	</div>

<!--
	<div id="paginas">
		<table border="0" align="center" width="100%">
			<tr>
				<td style="padding-left:2%">
					<font face="arial">
						<a href="#"><<</a>
						<a href="#"> 1</a>
						<a href="#"> >></a>
					</font>
				</td>
			</tr>
		</table>
	</div>
-->




		<div id="promocion1">
			<table border="0" align="center">
				<tr>
					<td width="80%" align="center">
						<?php
							$query = "SELECT * FROM banners where activa='1'";
							$result = mysql_query($query,$link);
							while ($row = mysql_fetch_array($result)) {
								if ($row["orden"]) {
									echo '<a href="agrega.php?prd='.$row["id_pro"].'">';
										echo '<img SRC="banners/'.trim($row["banner"]).'" width="40%" height="30%" alt="Agregar a la orden" title="Agregar a la orden">';
									echo '</a>';
								} else {
									echo '<img SRC="banners/'.trim($row["banner"]).'" width="40%" height="30%">';
								}
							}
						?>
					</td>
				</tr>
			</table>
		</div>





		<br>
		<div id="pie" top="10%">
			<table border="0" align="center" width="100%">
				<tr>
<!--
					<td width="50%" style="padding-left:10%">
						<font face="arial">
							Datos bancarios:<br>
							Corporación Manna C.A.<br>
							Banco Mercantil<br>
							Cuenta corriente<br>
							9999-9999-99-9999999999<br>
						</font>
					</td>
					<td  width="50%" style="padding-left:10%">
						<font face="arial">
							Contacto:<br>
							Teléfono: 0499-999.99.99<br>
							email: xxxxxxxxxxx@yyyyy.zzz<br>
							Dirección corporativa<br>
							Edificio Kerdell<br>
						</font>
					</td>
-->
					<td width="100%" align="center">
						<img SRC="banco.jpg" width="40%" height="30%" alt="Agregar a la orden" title="Agregar a la orden">';
					</td>
				</tr>
			</table>
		</div>

									
									
								</div>
								
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
	            							