<?php 
session_start();

$prod = isset($_GET['prd']) ? strtoupper($_GET['prd']) : '';

$_SESSION["cantidad"] -= $_SESSION["orden"][$prod];
unset($_SESSION["orden"][$prod]);

//unset($_SESSION["orden"]);
//unset($_SESSION["cantidad"]);

$cadena = ($_SESSION["cantidad"]==0) ? 'Location: inicio.php' : 'Location: orden.php' ;
//$cadena = 'Location: orden.php';
/*
echo '<pre>'; 
var_dump($_SESSION);
echo '<br>';
*/
header($cadena);
?>
