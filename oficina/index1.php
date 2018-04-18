<?php 
include_once("conexion.php");
$usuario = false;
include_once("cabecera.php");
$mensaje = isset($_GET['error']) ? $_GET['error'] : '';
?>
               <td class="body" colspan="3">
<!-- Esta parte del código va en la celda -->
                  <div id="cuerpo">
                     <br>
                     <div style="text-align:center">
                        <h3>ACCESO AL SISTEMA</h3>
                     </div>
                     <?php
                        switch ($mensaje) {
                           case 'ok':
                              echo '<div style="text-align:center">';
                                 echo '<p><b><font color="blue">PASSWORD CREADO CORECTAMENTE, PUEDE INGRESAR AL SISTEMA.</font></b></p>';
                              echo '</div>';
                              break;
                           case 'ci':
                              echo '<div style="text-align:center">';
                                 echo '<p><b><font color="red">CÓDIGO Y/O PASSWORD INCORRECTO.</font></b></p>';
                              echo '</div>';
                              break;
                           case 'cb':
                              echo '<div style="text-align:center">';
                                 echo '<p><b><font color="red">NO PUEDE DEJAR CAMPOS EN BLANCO.</font></b></p>';
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
                                         <form name="admin" method="post" action="acceso.php">
                                             <table border="0">
                                                <tr>
                                                   <td>Código de asociado:</td>
                                                   <td><INPUT type="tect" name="codigo" maxlength="5" size="5" style="text-align:center;text-transform:uppercase;"></td>
                                                </tr>
                                                <tr>
                                                   <td>Password:</td>
                                                   <td><INPUT type="password" name="password" maxlength="20" size="20"></td>
                                                </tr>
                                                <tr>
                                                   <td colspan="2" align="center">
                                                      <br>
                                                      <INPUT type="submit" value="Enviar">
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td colspan="2" align="center"><br><a href="registro.php">Si no tiene password, créelo aquí</a></td>
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
