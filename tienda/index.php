<?php 
include_once("conexion.php");
$_SESSION['user'] = '';
$_SESSION['codigo'] = '';
include_once("cabecera.php");
$mensaje = isset($_GET['error']) ? $_GET['error'] : '';
?>
<div id="cuerpo">
	<br><br>
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
		<table border="1" align="center" width="24%">
			<tr>
				<td valign="top">
					<br>
					<div style="vertical-align:top;">
						<div style="margin: 0% 15% 0% 15%">
					        <form name="admin" method="post" action="acceso.php">
					            <table border="0" align="center">
					            	<tr>
					            		<td>
					            			Número de tienda:
					            		</td>
					            		<td>
								            <INPUT type="text" name="codigo" maxlength="5" size="5" style="text-align:center;">            			
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
include_once("pie0.php");
?>
