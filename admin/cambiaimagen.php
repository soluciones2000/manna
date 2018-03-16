<?php 
if (file_exists('../tienda/img/'.trim($_GET["nomima"]).'.jpg')) {
	$imagen = '../tienda/img/'.trim($_GET["nomima"]).'.jpg';
} else {
	$imagen = '../tienda/img/sin_imagen.jpg';
}

echo '
<div style="text-align: center;align-content: center;">
	<img id="foto" SRC="'.$imagen.'" height="auto" width="65%" / >
	<p>Código del producto: '.$_GET["nomima"].'</p>
	<form action="cambiaimagen_submit.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
		<input type="hidden" name="codigo" value="'.trim($_GET["nomima"]).'" />
		<p>Seleccione la nueva imagen para reemplazar la actual:</p>
		<input type="file" name="'.$_GET["nomima"].'" value="Archivo" />
		<br>
		<br>
		<input type="submit" value="Enviar">
	</form>
</div>
';
?>