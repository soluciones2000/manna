<?php 
include_once("conexion.php");
include_once("cabecera.php");
//$menu = "";
//include_once("menu.php");
$mensaje = isset($_GET['error']) ? $_GET['error'] : '';
?>
<div id="cuerpo">
	<div style="text-align:center">
		<h3>ACCESO AL SISTEMA</h3>
	</div>
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
	<div>
		<table border="1" align="center" width="25%">
			<tr>
				<td valign="top">
					<br>
					<div style="vertical-align:top;">
						<div style="margin: 0% 15% 0% 15%">
					        <form name="admin" method="post" action="acceso.php">
					            <table border=0>
					            	<tr>
					            		<td>
					            			password:
					            		</td>
					            		<td>
								            <INPUT type="password" name="password" maxlength="20" size="20">            			
					            		</td>
					            	</tr>
					            </table>
					            <br>
					            <INPUT type="submit" value="Enviar">
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
