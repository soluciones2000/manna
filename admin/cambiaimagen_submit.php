<?php 
include_once("conexion.php");

$dir_subida = '../tienda/img/';
$cod = '';

echo '<pre>';
var_dump($_POST);
echo '<br>';
var_dump($_FILES);
echo '</pre>';

echo $_FILES[$_POST["codigo"]]["name"];

if ($_FILES[$_POST["codigo"]]["name"]<>'') {
	$fichero_subido = $dir_subida . basename(trim($_POST["codigo"]).".jpg");

	echo '<pre>';
	var_dump($_FILES);
	echo 'dir_subida '.$dir_subida.'<br>';
	echo 'fichero_subido '.$fichero_subido;

	if (move_uploaded_file($_FILES[$_POST["codigo"]]['tmp_name'], $fichero_subido)) {
	    echo "El fichero es válido y se subió con éxito.\n";
	} else {
	    echo "¡Posible ataque de subida de ficheros!\n";
	}

	echo 'Más información de depuración:';
	print_r($_FILES);

	print "</pre>";
} else {
    echo "<br>No hay fichero.\n";
}

// $cadena = 'Location: preciospro.php'; 

// header($cadena);

echo "
<script>
	parent.opener.location.reload();
	window.close();
</script>
";
?>
