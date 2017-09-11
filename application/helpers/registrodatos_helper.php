<?php
// Comentario
	function crea_organizacion($tit_codigo,$enrol_codigo){
		$registro = array(
	       	'padre' => $enrol_codigo,
	       	'hijo' => $tit_codigo
        );
		$this->Auth_model->genealogia($registro);

		$nivel = 0;
		$lado = 0;
		$registro = array(
	       	'organizacion' => $tit_codigo,
	       	'nivel' => $nivel,
	       	'afiliado' => $tit_codigo,
	       	'lado' => $lado
        );
		$this->Auth_model->organizacion($registro);
		$hijo = $tit_codigo;

		$loop = true;
		while ($loop) {
		    $genealogia = $this->Auth_model->padre($hijo);
			if (!$genealogia) {
				$loop = false;
			} else {
			    $organizacion = $genealogia->padre;
				$nivel = $nivel + 1;
				$afiliado = $tit_codigo;
				if ($nivel==0) {
					$lado = 0;
				} else {
					$lado = 1;
				}
				$registro = array(
			       	'organizacion' => $organizacion,
			       	'nivel' => $nivel,
			       	'afiliado' => $afiliado,
			       	'lado' => $lado
		        );
				$this->Auth_model->organizacion($registro);
		        $hijo = $organizacion;
			}
		}
	}

// Comentario
	function transaccion($fechapago,$tit_codigo,$tipo_afiliado,$tipo_kit,$numcomprobante,$bancoorigen){
		switch ($tipo_afiliado) {
			case 'Premium':
				switch ($tipo_kit) {
					case 'Hogar':
						$precio = $_SESSION['pvp_premium_hogar'];
						$monto = $_SESSION['premium_hogar'];
						$puntos = $_SESSION['mp_premium_hogar'];
						break;
					case 'Lq':
						$precio = $_SESSION['pvp_premium_lq'];
						$monto = $_SESSION['premium_lq'];
						$puntos = $_SESSION['mp_premium_lq'];
						break;
					case 'Teatro':
						$precio = $_SESSION['pvp_premium_teatro'];
						$monto = $_SESSION['premium_teatro'];
						$puntos = $_SESSION['mp_premium_teatro'];
						break;
					case 'Todas':
						$precio = $_SESSION['pvp_premium_todas'];
						$monto = $_SESSION['premium_todas'];
						$puntos = $_SESSION['mp_premium_todas'];
						break;
				}
				break;
			case 'VIP':
				switch ($tipo_kit) {
					case 'Hogar':
						$precio = $_SESSION['pvp_vip_hogar'];
						$monto = $_SESSION['vip_hogar'];
						$puntos = $_SESSION['mp_vip_hogar'];
						break;
					case 'Lq':
						$precio = $_SESSION['pvp_vip_lq'];
						$monto = $_SESSION['vip_lq'];
						$puntos = $_SESSION['mp_vip_lq'];
						break;
					case 'Teatro':
						$precio = $_SESSION['pvp_vip_teatro'];
						$monto = $_SESSION['vip_teatro'];
						$puntos = $_SESSION['mp_vip_teatro'];
						break;
					case 'Todas':
						$precio = $_SESSION['pvp_vip_todas'];
						$monto = $_SESSION['vip_todas'];
						$puntos = $_SESSION['mp_vip_todas'];
						break;
				}
				break;
			case 'Oro':
				switch ($tipo_kit) {
					case 'Hogar':
						$precio = $_SESSION['pvp_oro_hogar'];
						$monto = $_SESSION['oro_hogar'];
						$puntos = $_SESSION['mp_oro_hogar'];
						break;
					case 'Lq':
						$precio = $_SESSION['pvp_oro_lq'];
						$monto = $_SESSION['oro_lq'];
						$puntos = $_SESSION['mp_oro_lq'];
						break;
					case 'Teatro':
						$precio = $_SESSION['pvp_oro_teatro'];
						$monto = $_SESSION['oro_teatro'];
						$puntos = $_SESSION['mp_oro_teatro'];
						break;
					case 'Todas':
						$precio = $_SESSION['pvp_oro_todas'];
						$monto = $_SESSION['oro_todas'];
						$puntos = $_SESSION['mp_oro_todas'];
						break;
				}
				break;
		}
		// tipo = '01' corresponde al tipo de transacción "Afliación"
		$registro = array(
	       	'fecha' => $fechapago,
	       	'afiliado' => $tit_codigo,
	       	'tipo' => '01',
	       	'precio' => $precio,
	       	'monto' => $monto,
	       	'puntos' => $puntos,
	       	'documento' => $numcomprobante,
	       	'bancoorigen' => $bancoorigen,
	       	'status_comision' => 'Pendiente'
        );
		$this->Auth_model->transaccion($registro);
	}

// Comentario
	function orden($tit_codigo,$tipo_afiliado,$tipo_kit,$direccion_envio,$nombre_completo,$cedula,$telefono,$comprobante,$email,$fechapago){
		switch ($tipo_afiliado) {
			case 'Premium':
				switch ($tipo_kit) {
					case 'Hogar':
						$codigo = 'KITPHO';
						$nombre = 'Kit de afiliación Premium Línea Hogar';
						$precio = $_SESSION['pvp_premium_hogar'];
						$monto = $_SESSION['premium_hogar'];
						$puntos = $_SESSION['mp_premium_hogar'];
						break;
					case 'Lq':
						$codigo = 'KITPLQ';
						$nombre = 'Kit de afiliación Premium Línea LQ';
						$precio = $_SESSION['pvp_premium_lq'];
						$monto = $_SESSION['premium_lq'];
						$puntos = $_SESSION['mp_premium_lq'];
						break;
					case 'Teatro':
						$codigo = 'KITPTE';
						$nombre = 'Kit de afiliación Premium Teatro Infantil';
						$precio = $_SESSION['pvp_premium_teatro'];
						$monto = $_SESSION['premium_teatro'];
						$puntos = $_SESSION['mp_premium_teatro'];
						break;
					case 'Todas':
						$codigo = 'KITPTO';
						$nombre = 'Kit de afiliación Premium Todas las Líneas';
						$precio = $_SESSION['pvp_premium_todas'];
						$monto = $_SESSION['premium_todas'];
						$puntos = $_SESSION['mp_premium_todas'];
						break;
				}
				break;
			case 'VIP':
				switch ($tipo_kit) {
					case 'Hogar':
						$codigo = 'KITVHO';
						$nombre = 'Kit de afiliación VIP Línea Hogar';
						$precio = $_SESSION['pvp_vip_hogar'];
						$monto = $_SESSION['vip_hogar'];
						$puntos = $_SESSION['mp_vip_hogar'];
						break;
					case 'Lq':
						$codigo = 'KITVLQ';
						$nombre = 'Kit de afiliación VIP Línea LQ';
						$precio = $_SESSION['pvp_vip_lq'];
						$monto = $_SESSION['vip_lq'];
						$puntos = $_SESSION['mp_vip_lq'];
						break;
					case 'Teatro':
						$codigo = 'KITVTE';
						$nombre = 'Kit de afiliación VIP Teatro Infantil';
						$precio = $_SESSION['pvp_vip_teatro'];
						$monto = $_SESSION['vip_teatro'];
						$puntos = $_SESSION['mp_vip_teatro'];
						break;
					case 'Todas':
						$codigo = 'KITVTO';
						$nombre = 'Kit de afiliación VIP Todas las Líneas';
						$precio = $_SESSION['pvp_vip_todas'];
						$monto = $_SESSION['vip_todas'];
						$puntos = $_SESSION['mp_vip_todas'];
						break;
				}
				break;
			case 'Oro':
				switch ($tipo_kit) {
					case 'Hogar':
						$codigo = 'KITOHO';
						$nombre = 'Kit de afiliación Oro Línea Hogar';
						$precio = $_SESSION['pvp_oro_hogar'];
						$monto = $_SESSION['oro_hogar'];
						$puntos = $_SESSION['mp_oro_hogar'];
						break;
					case 'Lq':
						$codigo = 'KITOLQ';
						$nombre = 'Kit de afiliación Oro Línea LQ';
						$precio = $_SESSION['pvp_oro_lq'];
						$monto = $_SESSION['oro_lq'];
						$puntos = $_SESSION['mp_oro_lq'];
						break;
					case 'Teatro':
						$codigo = 'KITOTE';
						$nombre = 'Kit de afiliación Oro Teatro Infantil';
						$precio = $_SESSION['pvp_oro_teatro'];
						$monto = $_SESSION['oro_teatro'];
						$puntos = $_SESSION['mp_oro_teatro'];
						break;
					case 'Todas':
						$codigo = 'KITOTO';
						$nombre = 'Kit de afiliación Oro Todas las Líneas';
						$precio = $_SESSION['pvp_oro_todas'];
						$monto = $_SESSION['oro_todas'];
						$puntos = $_SESSION['mp_oro_todas'];
						break;
				}
				break;
		}
		$fechaorden  = date('Y-m-d H:i:s');
		$registro = array(
	       	'codigo' => $tit_codigo,
	       	'fecha' => $fechaorden,
	       	'monto' => $precio,
	       	'valor_comisionable' => $monto,
	       	'puntos' => $puntos,
	       	'direccion_envio' => $direccion_envio
        );
		$orden_id =	$this->Auth_model->orden($registro);
		$detalle = array(
	       	'orden_id' => $orden_id,
	       	'id_pro' => $codigo,
	       	'cantidad' => 1,
	       	'precio' => $precio,
	       	'valor_comisionable' => $monto,
	       	'puntos' => $puntos
		);
		$this->Auth_model->det_orden($detalle);

		if (strpos(base_url(),'localhost')==FALSE) {	           	
			$hoy = date("Y-m-d");
			$mensaje = "Orden de pedido No. ".$orden_id."<br>";
			$mensaje .= "Fecha: ".date('d/m/Y')."<br>";
			$mensaje .= "Asociado: ".trim($tit_codigo)." - ".trim($nombre_completo)." C.I. ".trim($cedula)."<br>";
			$mensaje .= "Dirección de envío: ".$direccion_envio."<br>";
			$mensaje .= "Teléfono: ".$telefono."<br>";
			$mensaje .= "--------------------------------------------------<br>";
			$mensaje .= "Kit: ".trim($codigo)." - ".trim($nombre).", cantidad: 1 x ".number_format($precio,2,',','.')." = Bs. ".number_format($precio,2,',','.')."<br>";
			$mensaje .= "     Valor comisionable ".number_format($monto,2,',','.')."<br>";
			$mensaje .= "     MP: ".number_format($puntos,0,',','.')."<br>";
			$mensaje .= "==================================================<br>";
			$mensaje .= "TOTAL PAGADO Bs. ".number_format($precio,2,',','.')."<br>";
			$mensaje .= "Número de comprobante bancario: ".trim($comprobante)."<br>";
			$mensaje .= "Fecha de la transacción bancaria: ".trim($fechapago)."<br>";

			$asunto = "Orden de pedido No.: ".$orden_id;
			$cabeceras = 'Content-type: text/html;';
			mail($email,$asunto,$mensaje,$cabeceras);
			mail("baudetguerra@gmail.com",$asunto,$mensaje,$cabeceras);
			mail("soluciones2000@gmail.com",$asunto,$mensaje,$cabeceras);
		}
	}

// Comentario
	function patrocinio($patroc_codigo,$tit_codigo,$fecha_afiliacion){
		$fecha_fin_bono = strtotime('+60 day', strtotime ($fecha_afiliacion));
		$fecha_fin_bono = date ( 'Y-m-d' , $fecha_fin_bono );
		$registro = array(
	       	'patroc_codigo' => $patroc_codigo,
	       	'tit_codigo' => $tit_codigo,
	       	'fecha_afiliacion' => $fecha_afiliacion,
	       	'fecha_fin_bono' => $fecha_fin_bono
        );
		$this->Auth_model->patrocinio($registro);
	}

// Comentario
	function registro_club_180($cod_miembro,$tipo_miembro,$patroc_codigo){
		$registro = array(
	       	'cod_miembro' => $cod_miembro,
	       	'tipo_miembro' => $tipo_miembro,
	       	'patroc_codigo' => $patroc_codigo
        );
		$this->Auth_model->club_180($registro);
	}

?>
