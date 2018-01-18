            <tr>
               <td class="left">
                  <div class="content">
                     <h5 class="mision">
                     </h5>
                     <br>
                     <div id="menu" class="vertical-menu" align="center">
                        <a id="inicio" class="active" href="#" onclick="refresca(this,'inicio.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">Inicio</a>
                        <a id="genealogia" class="" href="#" onclick="refresca(this,'menugenealogia.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">Genealogia</a>
                        <!-- <a id="patrocinio" class="" href="#" onclick="refresca(this,'patrocinio.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">Patrocinios</a> -->
                        <a id="afiliacion" class="" href="#" onclick="refresca(this,'menubonos.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">Bonos</a>
                        <!-- <a id="unilevel" class="" href="#" onclick="refresca(this,'unilevel.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">Bono Unilevel</a> -->
                        <a id="calif" class="" href="#" onclick="refresca(this,'calificaciones.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">Calificaciones</a>
                        <a id="c180" class="" href="#" onclick="refresca(this,'club_180.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">Club 180</a>
                        <a id="billetera" class="" href="#" onclick="refresca(this,'billetera.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">Billetera</a>
                        <a id="ordenes" class="" href="#" onclick="refresca(this,'catalogo.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">Ordenar prod.</a>
                        <a id="pagos" class="" href="#" onclick="refresca(this,'reportapago.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">Reportar pago</a>
                        <a id="tracking" class="" href="#" onclick="refresca(this,'tracking.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">Status órdenes</a>
                        <a id="mensajes" class="" href="#" onclick="refresca(this,'mensajes.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">Mensajes</a>
                        <a id="academia" class="" href="#" onclick="refresca(this,'academia.php',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">Academia</a>
                        <a id="salir" class="" href="logout.php">Salir</a>
<!--
                        <a id="pedidos" class="" href="#" onclick="refresca(this,'pedidos.html',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">Pedidos</a>
                        <a id="pagos" class="" href="#" onclick="refresca(this,'pagos.html',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">Pagos</a>
                        <a id="descargas" class="" href="#" onclick="refresca(this,'descargas.html',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">Descargas</a>
                        <a id="billetera" class="" href="#" onclick="refresca(this,'billetera.html',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">Billetera</a>
                        <a id="club180" class="" href="#" onclick="refresca(this,'club180.html',<?php echo "'".$_SESSION["codigo"]."'"; ?>)">Club 180</a>
-->
                     </div>
                  </div>
               </td>
               <td class="body" colspan="2">
                  <div class="content" align="center">
                     <br>
<!--                 <iframe id="marco" width="99%" height="400px" src="inicio.html">-->
                     <iframe id="marco" width="99%" height="445px" src="inicio.php?c=<?php echo $_SESSION["codigo"]; ?>" frameborder="0">
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
            document.getElementById("c180").className = "";
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
