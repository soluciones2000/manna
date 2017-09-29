<?php 
session_start();

$prod = isset($_GET['prd']) ? strtoupper($_GET['prd']) : '';

$_SESSION["orden"][$prod] += 1;
$_SESSION["cantidad"] += 1;
//var_dump($_SESSION);

//unset($_SESSION["orden"]);
//unset($_SESSION["cantidad"]);

$cadena = 'Location: catalogo.php';

/*
echo '<pre>'; 
var_dump($_SESSION);
echo '<br>';
*/
header($cadena);
?>
