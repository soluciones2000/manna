<?php 
include_once("conexion.php");
include_once("cabecera1.php");
$mensaje = isset($_GET['error']) ? $_GET['error'] : '';
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$password1 = isset($_POST['password1']) ? $_POST['password1'] : '';
$pregunta = isset($_POST['pregunta']) ? $_POST['pregunta'] : '';
$respuesta = isset($_POST['respuesta']) ? $_POST['respuesta'] : '';
?>
               