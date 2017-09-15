<?php 
include_once("conexion.php");
$query = "SELECT * from empresa";
$result = mysql_query($query,$link);
if ($row = mysql_fetch_array($result)) {
   $empresa = $row["emp_nombre"];
} else {
   $empresa = "Error al conectar a la base de datos.";
}
?>
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<html>
   <head> 
      <style> 
         td.left {
            width: 15%;
         }
         td.center {
            width: 70%;
         }
         td.right {
            width: 15%;
         }
         td.body {
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
            margin-bottom: 10px;
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
/*            font-family: arial;*/
/*            background-color: orange;*/
/*            color: white;*/
            font-size: 8;
            padding-left: 65%;
            top: 93%;
            position: fixed;
         }
      </style>
      <title><?php echo $empresa; ?></title>
<!--  <link rel="icon" type="image/png" href="sgc_ico.png" /> -->
   </head>
   <body>
      <div class="container">
         <table border="0">
            <tr>
               <td class="left">
                  <div class="logo">
                     <img class="logo" SRC="../recursos/img/Manna_peq.png" width="252.5px" height="62.5px" alt=<?php echo '"'.$empresa.'"' ?> /><br>
                  </div>
               </td>
               <td class="center">
                  <div class="header">
                     <h2><font face="arial"><?php echo $empresa; ?></font></h2>
                     <p><font face="arial"><b>OFICINA VIRTUAL</b></font></p>
                  </div>
               </td>
               <td class="center">
                  <div id="sesion" class="header">
   				  </div>
               </td>
            </tr>
            <tr>
               <td >
                  <div class="content">
                     <h5 class="mision">
                     </h5>
                     <br>
                     <div id="menu" class="vertical-menu" align="center">
                        <a id="inicio" class="active" href="#" onclick="refresca(this,'inicio.html')">Inicio</a>
                        <a id="genealogia" class="" href="#" onclick="refresca(this,'genealogia.php')">Genealogia</a>
                        <a id="patrocinios" class="" href="#" onclick="refresca(this,'patrocinios.html')">Patrocinios</a>
                        <a id="pedidos" class="" href="#" onclick="refresca(this,'pedidos.html')">Pedidos</a>
                        <a id="pagos" class="" href="#" onclick="refresca(this,'pagos.html')">Pagos</a>
                        <a id="descargas" class="" href="#" onclick="refresca(this,'descargas.html')">Descargas</a>
                        <a id="billetera" class="" href="#" onclick="refresca(this,'billetera.html')">Billetera</a>
                        <a id="club180" class="" href="#" onclick="refresca(this,'club180.html')">Club 180</a>
                     </div>
                  </div>
               </td>
               <td class="body" colspan="2">
                  <div class="content" align="center">
                     <br>
<!--                 <iframe id="marco" width="99%" height="400px" src="inicio.html">-->
                     <iframe id="marco" width="99%" height="400px" src="inicio.html" frameborder="0">
                        <p>Tu navegador no soporta Frames.</p>
                     </iframe>
                  </div>
               </td>
            </tr>
         </table>
      </div>
      <div class="footer">Haga clic para recigir soporte técncio por chat: <a href="https://m.me/sgcvzla" target="_blank">Facebook</a> o <a href="https://api.whatsapp.com/send?phone=584144802725" target="_blank">Whatsapp</a>
      </div>
      <script>
         function refresca(id,enlace) {
            document.getElementById("inicio").className = "";
            document.getElementById("genealogia").className = "";
            document.getElementById("patrocinios").className = "";
            document.getElementById("pedidos").className = "";
            document.getElementById("pagos").className = "";
            document.getElementById("descargas").className = "";
            document.getElementById("billetera").className = "";
            document.getElementById("club180").className = "";

            id.className = "active";

            document.getElementById("marco").src = enlace;
            document.getElementById("marco").reload();
         }
      </script>
   </body>
</html>