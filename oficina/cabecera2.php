<?php 
ini_set("session.cookie_lifetime","7200");
ini_set("session.gc_maxlifetime","7200");
session_start();
$query = "SELECT * from empresa";
$result = mysql_query($query,$link);
if ($row = mysql_fetch_array($result)) {
   $empresa = utf8_encode($row["emp_nombre"]);
   $_SESSION["iva1"] = $row["iva1"];
   $_SESSION["iva2"] = $row["iva2"];
   $_SESSION["iva3"] = $row["iva3"];
   $_SESSION["valor_punto"] = $row["valor_punto"];
} else {
   $empresa = "Error al conectar a la base de datos.";
   $_SESSION["iva1"] = 0.00;
   $_SESSION["iva2"] = 0.00;
   $_SESSION["iva3"] = 0.00;
   $_SESSION["valor_punto"] = 0.00;
}
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

      <style>
         /* The Modal (background) */
         .modal {
             display: none; /* Hidden by default */
             position: fixed; /* Stay in place */
             z-index: auto; /* Sit on top */
             padding-top: 30px; /* Location of the box */
             left: 0px;
             top: 0px;
             width: 100%; /* Full width */
             height: 100%; /* Full height */
             overflow: auto; /* Enable scroll if needed */
             background-color: rgb(0,0,0); /* Fallback color */
             background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
         }

         /* Modal Content */
         .modal-content {
             background-color: #fefefe;
             margin: auto;
             padding: 10px;
             border: 1px solid #888;
             width: 40%;
             height: auto;
             text-align: center;
         }

         /* The Close Button */
         .close {
             color: #aaaaaa;
             float: right;
             font-size: 28px;
             font-weight: bold;
         }

         .close:hover,
         .close:focus {
             color: #000;
             text-decoration: none;
             cursor: pointer;
         }

         td.left {
            width: 15%;
/*            height: 100%;*/
         }
         td.center {
            width: 60%;
         }
         td.right {
            width: 25%;
         }

         td.body {
            width: 85%;
            height: 100%;
         }
         h5.mision {
            font-style: italic;
            margin-top: 1px;
            margin-bottom: 3px;
            color: red;
            text-align: center;
         }
         .vertical-menu {
            width: 80%;
            padding-left: 10%;
            padding-right: 10%;
            font-family: arial;
            text-transform: uppercase;
            text-align: center;
         }
         .vertical-menu a {
            background-color: #33ceff;
            color: white;
            display: block;
            padding: 5px;
            margin-bottom: 9px;
            text-decoration: none;
            text-align: center;
         }
         .vertical-menu a:hover {
            background-color: gray;
         }
         .vertical-menu a.active {
            background-color: #66a7de;
            color: white;
         }
         div.container {
            width: 100%;
            height: 500%;
         }
         div.logo {
            float: left;
            text-align: center;
            display: inline;
         }  
         img.logo {
            width: 90%;
            height: 90%;
         }
         div.header {
            text-align: center;
         }
         div.dato-user {
            text-align: right;
         }
         div.user {
            float: right;
         }
         div.left {
            text-align: center;
            clear: both;
            float: left;
         }
         div.content {
            height: 100%;
         }
         div.right {
            float: right;
         }
         div.footer {
/*            font-size: 8;*/
            padding-left: 65%;
            top: 95%;
            position: fixed;
         }
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

<body class="index-page" onLoad="Abrir_ventana()">

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
			
			
			
			
			
			


					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="material-icons">view_day</i> Menu Oficina::.
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu dropdown-with-icons">
							<li>
							
								<a id="inicio" class="active" class="page-scroll" href="#" onclick="refresca(this,'inicio.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">
									Inicio
								</a>
							</li>
							<li>
							

							
							
								<a class="page-scroll" id="genealogia" href="#" onclick="refresca(this,'menugenealogia.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">
									Genealogia
								</a>
							</li>
							<li>

								<a class="page-scroll" id="afiliacion" href="#" onclick="refresca(this,'advertencia.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">
									Bonos
								</a>
		
<!-- 								<a class="page-scroll" id="afiliacion" href="#" onclick="refresca(this,'menubonos.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">
									Bonos
								</a>
 -->							</li>

							<li>
								<a class="page-scroll" id="calif" href="#" onclick="refresca(this,'calificaciones.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">
									Calificaciones
									</a>
							</li>

							<li>
								
								<a class="page-scroll" id="billetera" href="#" onclick="refresca(this,'billetera.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">
									Billetera
									</a>
							</li>



							<li>
							
							
								<a class="page-scroll" id="ordenes" href="#" onclick="refresca(this,'catalogo.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">
									Ordenar Prod.
									</a>
							</li>
							
							
							
							
							
							
							<li>
							
								<a class="page-scroll" id="pagos" href="#" onclick="refresca(this,'ordenespendientes.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">
									Pagos
									</a>
							</li>
							
							
							
														
							<li>
							
							
								<a class="page-scroll" id="tracking" href="#" onclick="refresca(this,'tracking.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">
									Status Órdenes
									</a>
							</li>
							
							
							
							
							<li>
							
								<a class="page-scroll" id="mensajes" href="#" onclick="refresca(this,'mensajes.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">
									Mensajes
								</a>
							</li>														



							<li>
									
								<a class="page-scroll" id="academia" href="#" onclick="refresca(this,'academia.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">
									Academia
									</a>
							</li>	
							
							
							
							

							<li>
							
							
							
								<a class="page-scroll" id="salir" href="logout.php">
									Salir
								</a>
							</li>


						</ul>
					</li>







			
			
			
			
			
	    		
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

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>

    <td>


<div class="card card-signup">

								<div class="header header-primary text-center">
									
									<h4 class="textoamarillo sombra"><?php echo $empresa; ?> &nbsp;OFICINA VIRTUAL
									
									
									
									<div id="sesion">
                     <?php
                        $nombre = isset($_SESSION['user']) ? utf8_encode($_SESSION['user']) : '';
                        if ($usuario) {
                           echo 'Buen día: '.trim($nombre).' - ';
                           // echo '<label id="afiliado">Afiliado '.trim($_SESSION["tipo_afiliado"]).'</label><br>';
                           echo 'Rango: '.$_SESSION["rango"].' - ';
                           echo 'PM del mes: '.number_format($_SESSION["pm"],0,',','.').' - ';
                           echo 'PMO: '.number_format($_SESSION["pmo"],0,',','.').'';
                        }
                      ?>
   				  </div>
				  
				  </h4>
									
								</div>
								
								
								<br>
								
								<div class="content">









   <?php 
      $query = "SELECT rango,flag from afiliados WHERE tit_codigo='".trim($_SESSION['codigo'])."'";
      $result = mysql_query($query,$link);
      if ($row = mysql_fetch_array($result)) {
         $rango = $row["rango"];
         $flag = $row["flag"];
         if ($flag) {
            $falso = false;
            $query = "UPDATE afiliados SET flag='".$falso."' WHERE tit_codigo='".trim($_SESSION['codigo'])."'";
            $result = mysql_query($query,$link);
         }
      } else {
         $flag = false;
      }
   ?>
   <?php if ($flag): ?>
      <!-- The Modal -->
      <div id="myModal" class="modal">
         <!-- Modal content -->
         <div class="modal-content">
            <span class="close">&times;</span>
            <h2>¡¡¡Felicitaciones!!!</h2>
            <img SRC="logro2.jpg" height="auto" width="80%">
            <p><font size="4">Has alcanzado el rango de <b><?php echo strtoupper($rango); ?>.</b></font></p>
            <p><font size="4">A partir de ahora podrás disfrutar de los beneficios de este nuevo nivel, continúa realizando ese excelente trabajo.</font></p>
         </div>
      </div>
      <script>
         // Get the modal
         var modal = document.getElementById('myModal');

         // Get the <span> element that closes the modal
         var span = document.getElementsByClassName("close")[0];

         // variables de la imagen
//         var imagen = "'.$imagen.'";

         // When the user clicks the button, open the modal 
         function Abrir_ventana() {
                modal.style.display = "block";
         }

         // When the user clicks on <span> (x), close the modal
         span.onclick = function() {
             modal.style.display = "none";
         }

         // When the user clicks anywhere outside of the modal, close it
         window.onclick = function(event) {
             if (event.target == modal) {
                 modal.style.display = "none";
             }
         }
      </script>
   <?php endif; ?>

   <div class="container">
         <table border="0" width="100%">
            <tr>
               <td class="left">
                  
               </td>
               <td class="center">
                
               </td>
               <td class="right">
                  
               </td>
            </tr>
            <tr>


               
			   
			   
			   
			   
			   
			   
			  
			  
			  
			  
			  
			  
			   <tr>
               
               <td colspan="3">
                  <div class="content" align="center">
                     <br>
<!--                 <iframe id="marco" width="99%" height="400px" src="inicio.html">-->
                     <iframe id="marco" width="99%" height="500px" src="inicio.php?c=<?php echo $_SESSION["codigo"]; ?>" frameborder="0">
                        <p>Tu navegador no soporta Frames.</p>
                     </iframe>
                  </div>
               </td>
            </tr>
         </table>
      </div>
<!--      <div class="footer">Haga clic para recigir soporte técncio por chat: <a href="https://m.me/sgcvzla" target="_blank">Facebook</a> o <a href="https://api.whatsapp.com/send?phone=584144802725" target="_blank">Whatsapp</a>
      </div>-->
      <script>
         function refresca(id,enlace,c) {
            document.getElementById("inicio").className = "";
            document.getElementById("genealogia").className = "";
            // document.getElementById("patrocinio").className = "";
            document.getElementById("afiliacion").className = "";
            // document.getElementById("unilevel").className = "";
            document.getElementById("calif").className = "";
            // document.getElementById("c180").className = "";
            document.getElementById("billetera").className = "";
            document.getElementById("ordenes").className = "";
            document.getElementById("pagos").className = "";
            document.getElementById("tracking").className = "";
            document.getElementById("mensajes").className = "";
            document.getElementById("academia").className = "";
            document.getElementById("salir").className = "";
/*            
            document.getElementById("pedidos").className = "";
            document.getElementById("pagos").className = "";
            document.getElementById("descargas").className = "";
            document.getElementById("billetera").className = "";
            document.getElementById("club180").className = "";
*/
            id.className = "active";

            document.getElementById("marco").src = enlace+'?c='+c;
            document.getElementById("marco").reload();
         }
      </script>

			  
			  
			  
			  
			  
			   
			   
			   
			   
			                     </tr>
                        </table>
                     </div>
                  </div> 
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
	
