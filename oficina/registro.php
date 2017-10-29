<?php 
include_once("conexion.php");
include_once("cabecera.php");
$mensaje = isset($_GET['error']) ? $_GET['error'] : '';
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$password1 = isset($_POST['password1']) ? $_POST['password1'] : '';
$pregunta = isset($_POST['pregunta']) ? $_POST['pregunta'] : '';
$respuesta = isset($_POST['respuesta']) ? $_POST['respuesta'] : '';
?>
               <td class="body" colspan="3">
<!-- Esta parte del código va en la celda -->
                  <div id="cuerpo">
                     <br>
                     <div style="text-align:center">
                        <h3>CREACIÓN DE PASSWORD</h3>
                     </div>
                     <?php
                        switch ($mensaje) {
                           case 'cvc':
                              echo '<div style="text-align:center">';
                                 echo '<p><b><font color="red">NO PUEDE DEJAR CAMPOS VACÍOS.</font></b></p>';
                              echo '</div>';
                              break;
                           case 'cin':
                              echo '<div style="text-align:center">';
                                 echo '<p><b><font color="red">DEBE INTRODUCIR UN CÓDIGO VÁLIDO.</font></b></p>';
                              echo '</div>';
                              break;
                           case 'pnc':
                              echo '<div style="text-align:center">';
                                 echo '<p><b><font color="red">CONFIRMACIÓN DEL PASSWORD NO COINCIDE.</font></b></p>';
                              echo '</div>';
                              break;
                           case 'irb':
                              echo '<div style="text-align:center">';
                                 echo '<p><b><font color="red">OCURRIÓ UN ERROR INTERNO, INTENTE MÁS TARDE O CONUNIQUESE CON SOPORTE.</font></b></p>';
                              echo '</div>';
                              break;
                           case 'upb':
                              echo '<div style="text-align:center">';
                                 echo '<p><b><font color="red">OCURRIÓ UN ERROR INTERNO, INTENTE MÁS TARDE O CONUNIQUESE CON SOPORTE.</font></b></p>';
                              echo '</div>';
                              break;
                        }
                     ?>
                     <div>
                        <table border="1" align="center" width="40%">
                           <tr>
                              <td valign="top" align="center">
                                 <br>
                                 <div style="vertical-align:top;">
                                    <div style="margin: 0% 15% 0% 15%">
                                         <form name="admin" method="post" action="validapass.php">
                                             <table border="0">
                                                <tr>
                                                   <td>Código de asociado:</td>
                                                   <td><INPUT type="text" name="codigo" maxlength="5" size="5" style="text-align: center;text-transform:uppercase;"></td>
                                                </tr>
                                                <tr>
                                                   <td>Password:</td>
                                                   <td><INPUT type="password" name="password" maxlength="20" size="20"></td>
                                                </tr>
                                                <tr>
                                                   <td>Confirme el Password:</td>
                                                   <td><INPUT type="password" name="password1" maxlength="20" size="20"></td>
                                                </tr>
                                                <tr>
                                                   <td>Pregunta de seguridad:</td>
                                                   <td><INPUT type="text" name="pregunta" maxlength="50" size="20"></td>
                                                </tr>
                                                <tr>
                                                   <td>Respuesta:</td>
                                                   <td><INPUT type="password" name="respuesta" maxlength="50" size="20"></td>
                                                </tr>
                                                <tr>
                                                   <td colspan="2" align="center">
                                                      <br>
                                                      <INPUT type="submit" value="Enviar">
                                                   </td>
                                                </tr>
                                             </table>
                                       </form>
                                       <br>
                                    </div>
                                 </div>
                              </td>
                           </tr>
                        </table>
                     </div>
                  </div> 
               </td>

<!-- Hasta aquí -->
<?php
      include_once("pie.php");
?>
