<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu = "inactivar";
include_once("menu.php");
$mensaje = isset($_GET['error']) ? $_GET['error'] : '';
?>
<div id="cuerpo">
	<div style="text-align:center">
		<h3>ACTIVAR O INACTIVAR CÓDIGOS</h3>
	</div>
	<?php
		switch ($mensaje) {
			case 'cb':
				echo '<div style="text-align:center">';
					echo '<p><b><font color="red">NO PUEDE DEJAR EL CÓDIGO EN BLANCO.</font></b></p>';
				echo '</div>';
				break;
			case 'ci':
				echo '<div style="text-align:center">';
					echo '<p><b><font color="red">DEBE INTRODUCIR UN CÓDIGO VÁLIDO.</font></b></p>';
				echo '</div>';
				break;
			case 'ca':
				echo '<div style="text-align:center">';
					echo '<p><b><font color="red">DEBE INTRODUCIR UN CÓDIGO DE AFILIADO (5 CARACTERES).</font></b></p>';
				echo '</div>';
				break;
			case 'cc':
				echo '<div style="text-align:center">';
					echo '<p><b><font color="red">DEBE INTRODUCIR UN CÓDIGO DE CLIENTE (10 CARACTERES).</font></b></p>';
				echo '</div>';
				break;
		}
	?>
	<div>
		<table border="1" align="center" width="30%">
			<tr>
				<td valign="top">
					<br>
					<div style="vertical-align:top;">
						<div style="margin: 0% 15% 0% 15%">
					        <form name="admin" method="post" action="cambiostatus.php">
					            <table border=0>
					            	<tr>
					            		<td valign="middle">
					            			Activar/Inactivar:
					            		</td>
					            		<td>
											<input type="radio" name="tipo" value="Afiliado" checked> Aliado comercial
											<br>
											<input type="radio" name="tipo" value="Cliente"> Cliente Preferencial
					            		</td>
					            	</tr>
					            	<tr>
					            		<td>
					            			Código:
					            		</td>
					            		<td>
											<input type="text" style="text-transform:uppercase;text-align:center;" size="10" name="codigo" minlength="5" maxlength="10" pattern="[0-9|A-Z|a-z]{5-10}" title="Este campo sólo puede tener números o letras">
					            		</td>
					            	</tr>
					            </table>
					            <br>
					            <div align="center">
						            <INPUT type="submit" value="Enviar">
					            </div>
	        				</form>
							<br>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div> 
<?php
include_once("pie.php");
?>
