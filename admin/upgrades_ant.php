<?php 
include_once("conexion.php");
include_once("cabecera.php");
$menu="upgrade";
include_once("menu.php");

$quer0 = "SELECT * FROM empresa";
$resul0 = mysql_query($quer0,$link);
$ro0 = mysql_fetch_array($resul0);
$pvp_premium_hogar = $ro0["pvp_premium_hogar"];
$pvp_premium_lq = $ro0["pvp_premium_lq"];
$pvp_premium_teatro = $ro0["pvp_premium_teatro"];
$pvp_premium_todas = $ro0["pvp_premium_todas"];

$pvp_vip_hogar = $ro0["pvp_vip_hogar"];
$pvp_vip_lq = $ro0["pvp_vip_lq"];
$pvp_vip_teatro = $ro0["pvp_vip_teatro"];
$pvp_vip_todas = $ro0["pvp_vip_todas"];

$query = "SELECT upgrade.*,transacciones.precio,afiliados.tipo_afiliado as tipoinicial,afiliados.tipo_kit from upgrade left outer join transacciones on upgrade.codigo=transacciones.afiliado left outer join afiliados on upgrade.codigo=afiliados.tit_codigo where transacciones.tipo='01' order by codigo";
$result = mysql_query($query,$link);
$vacio = true;
$first = true;
$registro = array();
$upgrades = array();
$notas_cr = array();
while($row = mysql_fetch_array($result)) {
	if ($first) {
		$vacio = false;
		$first = false;
		$tabla = '<table border="1">
					<tr>
						<th>Código</th>
						<th>Nivel inicial</th>
						<th>Nivel solicitado</th>
						<th>Monto requerido</th>
						<th>Monto depositado</th>
						<th>Mensaje</th>
						<th>¿Conforme?</th>
					</tr>';
	}

	$id = $row["id"];
	$codigo = $row["codigo"];
	$tipo_afiliado = $row["tipo_afiliado"];
	$fechapago = $row["fechapago"];
	$numcomprobante = $row["numcomprobante"];
	$bancoorigen = $row["bancoorigen"];
	$monto = $row["monto"];
	$precio =  $row["precio"];
	$tipoinicial =  $row["tipoinicial"];
	$tipo_kit =  $row["tipo_kit"];
	$mensaje = "";
	$nc = 0.00;
	$aplica = false;
	$registro[]=array($id,$codigo);
	switch ($tipo_afiliado) {
		case 'Premium':
			if ($tipoinicial=='Premium') {
				$mensaje = "No puede hacer upgrade, ya alcanzó el nivel máximo, se generará una nota de crédito para consumos";
				$nc = $monto;
				$notas_cr[$codigo]=array($id,$fechapago,$codigo,"03",$nc,0,0,$numcomprobante,$bancoorigen,"No aplica");
			} else {
				switch ($tipo_kit) {
					case 'Hogar':
						$diferencia = $pvp_premium_hogar-$precio;
						break;
					case 'Lq':
						$diferencia = $pvp_premium_lq-$precio;
						break;
					case 'Teatro':
						$diferencia = $pvp_premium_teatro-$precio;
						break;
					case 'Todas':
						$diferencia = $pvp_premium_todas-$precio;
						break;
				}
				if ($diferencia>$monto) {
					$mensaje = "El monto depositado no es suficiente para subir de nivel, se generará una nota de crédito para consumos, para hacer el upgrade deposite la cantidad de Bs. ".number_format($diferencia,2,',','.');
					$nc = $monto;
					$notas_cr[$codigo]=array($id,$fechapago,$codigo,"03",$nc,0,0,$numcomprobante,$bancoorigen,"No aplica");
				} else if ($diferencia<$monto) {
					$mensaje = "Ha depositado de más para este nivel, se aplicará el cambio y se generará una nota de crédito para consumos por la diferencia equivalente a Bs. ".number_format($monto-$diferencia,2,',','.');
					$nc = $monto-$diferencia;
					$upgrades[$codigo]=array($id,$fechapago,$codigo,"02",$monto-$nc,0,0,$numcomprobante,$bancoorigen,"No aplica");
					$notas_cr[$codigo]=array($id,$fechapago,$codigo,"03",$nc,0,0,$numcomprobante,$bancoorigen,"No aplica");
				} else {
					$mensaje = "Se aplicarán los cambios a su perfil de afiliado";
					$aplica = true;
					$nc = 0.00;
					$upgrades[$codigo]=array($id,$fechapago,$codigo,"02",$monto,0,0,$numcomprobante,$bancoorigen,"No aplica");
				}
			}
			break;
		case 'VIP':
			if ($tipoinicial=='Premium') {
				$mensaje = "No puede hacer downgrade, ya alcanzó el nivel máximo, se generará una nota de crédito para consumos";
				$nc = $monto;
				$notas_cr[$codigo]=array($id,$fechapago,$codigo,"03",$nc,0,0,$numcomprobante,$bancoorigen,"No aplica");
			} else if ($tipoinicial=='VIP') {
				$mensaje = "No puede hacer upgrade al mismo nivel en el que ya se encuentra, se generará una nota de crédito para consumos";
				$nc = $monto;
				$notas_cr[$codigo]=array($id,$fechapago,$codigo,"03",$nc,0,0,$numcomprobante,$bancoorigen,"No aplica");
			} else {
				switch ($tipo_kit) {
					case 'Hogar':
						$diferencia = $pvp_vip_hogar-$monto;
						break;
					case 'Lq':
						$diferencia = $pvp_vip_lq-$monto;
						break;
					case 'Teatro':
						$diferencia = $pvp_vip_teatro-$monto;
						break;
					case 'Todas':
						$diferencia = $pvp_vip_todas-$monto;
						break;
				}
				if ($diferencia>$monto) {
					$mensaje = "El monto depositado no es suficiente para subir de nivel, se generará una nota de crédito para consumos, para hacer el upgrade deposite la cantidad de Bs. ".number_format($diferencia,2,',','.');
					$nc = $diferencia;
					$notas_cr[$codigo]=array($id,$fechapago,$codigo,"03",$nc,0,0,$numcomprobante,$bancoorigen,"No aplica");
				} else if ($diferencia<$monto) {
					$mensaje = "Ha depositado de más para este nivel, se aplicará el cambio y se generará una nota de crédito para consumos por la diferencia equivalente a Bs. ".number_format($monto-$diferencia,2,',','.');
					$nc = $monto-$diferencia;
					$upgrades[$codigo]=array($id,$fechapago,$codigo,"02",$monto-$nc,0,0,$numcomprobante,$bancoorigen,"No aplica");
					$notas_cr[$codigo]=array($id,$fechapago,$codigo,"03",$nc,0,0,$numcomprobante,$bancoorigen,"No aplica");
				} else {
					$mensaje = "Se aplicarán los cambios a su perfil de afiliado";
					$aplica = true;
					$nc = 0.00;
					$upgrades[$codigo]=array($id,$fechapago,$codigo,"02",$monto,0,0,$numcomprobante,$bancoorigen,"No aplica");
				}
			}
			break;
	}
	$tabla .= '<tr>
				<td align="center">'.$codigo.'</td>
				<td align="center">'.$tipoinicial.'</td>
				<td align="center">'.$tipo_afiliado.'</td>
				<td align="right">'.number_format($diferencia,2,',','.').'</td>
				<td align="right">'.number_format($monto,2,',','.').'</td>
				<td align="center">'.$mensaje.'</td>';
	
	if ($aplica) {
		$tabla .= '	<td align="center"><input type="checkbox" name="'.$codigo.'" value="1" checked disabled> SI</td>';
		$tabla .= '	<input type="hidden" name="'.$codigo.'" value="'.$id.'">';
	} else {
		$tabla .= '	<td align="center"><input type="checkbox" name="'.$codigo.'" value="'.$id.'"> SI</td>';
	}
	$tabla .= '</tr>';
}
$tabla .= '</table>';
?>

<div id="cuerpo" align="center">
	<br>
	<br>
	<h3>APROBACIÓN DE UPGRADE DE AFILIADOS</h3>
	<br>
	<form action="aplicaupgrade.php" method="post">
		<?php echo $tabla; ?>
		<input type="hidden" name="registro" value='<?php echo serialize($registro) ?>'></input>
		<input type="hidden" name="upgrades" value='<?php echo serialize($upgrades) ?>'></input>
		<input type="hidden" name="notas_cr" value='<?php echo serialize($notas_cr) ?>'></input>
		<br>
		<div align="right" style="padding-right:2%"><input type="submit" value="Aprobar"></div>
	</form>
</div> 
<?php
include_once("pie.php");
?>