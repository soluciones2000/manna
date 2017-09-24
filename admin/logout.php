<?php 
session_start();
unset($_SESSION["user"]);
//var_dump($_SESSION);
header('Location: index.php');
?>
