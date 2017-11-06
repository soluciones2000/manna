<?php 
session_start();
$query = "SELECT * from empresa";
$result = mysql_query($query,$link);
if ($row = mysql_fetch_array($result)) {
   $empresa = utf8_encode($row["emp_nombre"]);
   $_SESSION["iva1"] = $row["iva1"];
   $_SESSION["iva2"] = $row["iva2"];
   $_SESSION["iva3"] = $row["iva3"];
} else {
   $empresa = "Error al conectar a la base de datos.";
   $_SESSION["iva1"] = 0;
   $_SESSION["iva2"] = 0;
   $_SESSION["iva3"] = 0;
}
?>

<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<html>
   <head> 
      <style> 
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
               <td class="right">
                  <div id="sesion" class="dato-user">
                     <?php
                        $nombre = isset($_SESSION['user']) ? utf8_encode($_SESSION['user']) : '';
                        if ($usuario) {
                           echo '<label id="user">Buen día: '.trim($nombre).'</label><br>';
                           echo '<label id="rango">Rango: '.$_SESSION["rango"].'</label><br>';
                           echo '<label id="pm">PM del mes: '.number_format($_SESSION["pm"],0,',','.').'</label><br>';
                           echo '<label id="pmo">PMO: '.number_format($_SESSION["pmo"],0,',','.').'</label><br>';
                        }
                      ?>
   				  </div>
               </td>
            </tr>
            <tr>
