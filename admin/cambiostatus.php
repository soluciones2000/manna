<?php 
include_once("conexion.php");
if (isset($_POST["codigo"])) {
	if ($_POST["tipo"]=="Afiliado") {
		if (strlen($_POST["codigo"])<>5) {
			$cadena = 'Location: inactivarcodigo.php?error=ca';
		} else {
			$query = "select * from afiliados where tit_codigo='".trim($_POST["codigo"])."'";
			$result = mysql_query($query,$link);
			if ($row = mysql_fetch_array($result)) {
				$st = ($row["status_afiliado"]=="Activo") ? "Inactivo" : "Activo" ;
				$query = "UPDATE afiliados SET status_afiliado='".trim($st)."' where tit_codigo='".trim($_POST["codigo"])."'";
				$result = mysql_query($query,$link);
				$cadena = 'Location: inicio.php';
			} else {
				$cadena = 'Location: inactivarcodigo.php?error=ci';
			}
		}
	} elseif ($_POST["tipo"]=="Cliente") {
		if (strlen($_POST["codigo"])<>10) {
			$cadena = 'Location: inactivarcodigo.php?error=cc';
		} else {
			$query = "select * from cliente_preferencial where cod_clte='".trim($_POST["codigo"])."'";
			$result = mysql_query($query,$link);
			if ($row = mysql_fetch_array($result)) {
				$st = ($row["status_cliente"]=="Activo") ? "Inactivo" : "Activo" ;
				$query = "UPDATE cliente_preferencial SET status_cliente='".trim($st)."' where cod_clte='".trim($_POST["codigo"])."'";
				$result = mysql_query($query,$link);
				$cadena = 'Location: inicio.php';
			} else {
				$cadena = 'Location: inactivarcodigo.php?error=ci';
			}
		}
	}
} else {
	$cadena = 'Location: inactivarcodigo.php?error=cb';
}
header($cadena);
?>
