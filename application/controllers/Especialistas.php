<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Especialistas extends CI_Controller {

//*** Constructor ***
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model');
	}

//*** Prepara las variables y llama a la vista registro ***
	public function medico(){
		$data = new stdClass();
		$data->title = "MANNA - La Provisión que cambiará tu vida";
		$data->contenido = "apl/auth/medico"; //aqui es la dirección física del controlador
		$data->panel_title = "Afiliación de Médicos o profesionales de la salud - Página 1 de 3";
		$data->active = "registro";
		$this->load->view('menu',$data);
	}

//*** Prepara las variables y llama a la vista registro ***
	public function regmedico(){
		$envio = isset($_POST['envio']) ? $_POST['envio'] : 0;

		$this->form_validation->set_rules('enrol_codigo', 'Código del enrolador', 'required|exact_length[5]|callback_codigocero|callback_validacodigo|callback_existecodigo');
		$this->form_validation->set_rules('patroc_codigo', 'Código del patrocinador', 'required|exact_length[5]|callback_codigocero|callback_validacodigo|callback_existecodigo');

		$this->form_validation->set_message('codigocero', 'El campo {field} no puede ser 00000, pulse atrás para corregir');
		$this->form_validation->set_message('validacodigo', 'El campo {field} debe contener el formato válido para el código (Sólo números y/o letras mayúsculas, además debe tener 10 dígitos, rellene con ceros a la izquierda si es necesario), pulse atrás para corregir');
		$this->form_validation->set_message('existecodigo', 'El {field} no está registrado, introduzca un código válido, pulse atrás para corregir');

		if ($this->form_validation->run() == FALSE){
            $this->opcion();
        } else {
			$data = new stdClass();
           	$enrol_codigo = strtoupper($this->input->post('enrol_codigo'));
           	$patroc_codigo = strtoupper($this->input->post('patroc_codigo'));

		    $enrol = $this->Auth_model->codigo($enrol_codigo);
           	$data->enrol_codigo = $enrol_codigo;
           	$data->enrol_nombre_completo = trim($enrol->tit_nombres).' '.trim($enrol->tit_apellidos);

		    $patroc = $this->Auth_model->codigo($patroc_codigo);
           	$data->patroc_codigo = $patroc_codigo;
           	$data->patroc_nombre_completo = trim($patroc->tit_nombres).' '.trim($patroc->tit_apellidos);

           	$data->envio = $envio;
			$data->title = "MANNA - La Provisión que cambiará tu vida";
			$data->contenido = "apl/auth/regmedico"; //aqui es la dirección física del controlador
			$data->panel_title = "Afiliación de Médicos o profesionales de la salud - Página 2 de 3";
			$data->active = "registro";
			$this->load->view('menu',$data);
		}
	}

//*** Se ejecuta al darle submit en la forma registro ***
	public function crea_medico(){
		if ($this->input->post('tipo_persona')=="Natural") {
			$nombres = 'Nombres del titular';
			$apellid = 'Apellidos del titular';
			$cedulas = 'Cédula de identidad';
			$numerif = 'RIF del titular';
		} else {
			$nombres = 'Razón social';
			$apellid = 'Representante legal';
			$cedulas = 'C.I. Representante legal';
			$numerif = 'RIF de la empresa';
		}
		if ($this->input->post('nacionalidad')=="Local") {
			$condced = 'required|min_length[6]|max_length[8]|callback_validanumero';
			$condrif = 'required|min_length[9]|max_length[10]|callback_validarif';
		} else {
			$condced = 'required|min_length[6]|max_length[9]|callback_validanumero';
			$condrif = 'required|min_length[9]|max_length[11]|callback_validarif';
		}
		$this->form_validation->set_rules('tit_nombres', $nombres, 'required|max_length[150]');
		$this->form_validation->set_rules('tit_apellidos', $apellid, 'required|max_length[150]');
		$this->form_validation->set_rules('tit_cedula', $cedulas, $condced);
		$this->form_validation->set_rules('tit_rif', $numerif, $condrif);
		if ($this->input->post('tipo_persona')=="Natural") {
			$this->form_validation->set_rules('tit_fecha_nac', 'Fecha de nacimiento', 'required');
			$this->form_validation->set_rules('tit_edo_civil', 'Estado Civil', 'required');
			$this->form_validation->set_rules('tit_sexo', 'Sexo', 'required');
			$this->form_validation->set_rules('tit_profesion', 'Profesión', 'required|max_length[150]');

			$this->form_validation->set_rules('cot_nombres', 'Nombres del cotitular', 'max_length[150]');
			$this->form_validation->set_rules('cot_apellidos', 'Apellidos del cotitular', 'max_length[150]');
			$this->form_validation->set_rules('cot_cedula', 'Cédula de identidad', 'min_length[6]|max_length[9]|callback_validanumero');
			$this->form_validation->set_rules('cot_rif', 'RIF del cotitular', 'min_length[8]|max_length[11]|callback_validarif');
		}
		$this->form_validation->set_rules('calle', 'Calle/Avenida/Vereda', 'required|max_length[150]');
		$this->form_validation->set_rules('cruce', 'Cruce con/Entre calles', 'max_length[150]');
		$this->form_validation->set_rules('casa', 'Casa/Edificio', 'required|max_length[50]');
		$this->form_validation->set_rules('sector', 'Urbanización/Sector', 'required|max_length[150]');
		$this->form_validation->set_rules('piso', 'Piso Nro.', 'max_length[50]');
		$this->form_validation->set_rules('apto', 'Apto.', 'max_length[50]');
		$this->form_validation->set_rules('referencia', 'Punto de referencia', 'max_length[150]');
		$this->form_validation->set_rules('ciudad', 'Ciudad', 'required|max_length[150]');
		$this->form_validation->set_rules('municipio', 'Municipio', 'required|max_length[150]');
		$this->form_validation->set_rules('estado', 'Estado', 'required|max_length[150]');
		$this->form_validation->set_rules('parroquia', 'Parroquia', 'required|max_length[150]');
		$this->form_validation->set_rules('cod_postal', 'Código Postal', 'required|max_length[10]');
		$this->form_validation->set_rules('pais', 'País', 'required|max_length[150]');
		$this->form_validation->set_rules('tel_local', 'Teléfono Local', 'required|min_length[11]|max_length[50]|callback_validanumero');
		$this->form_validation->set_rules('tel_celular', 'Teléfono Celular', 'required|min_length[11]|max_length[50]|callback_validanumero');
		$this->form_validation->set_rules('email', 'Dirección de Correo Electrónico', 'required|max_length[150]|valid_email');

		$this->form_validation->set_rules('enrol_codigo', 'Código del enrolador', 'required|exact_length[5]|callback_validacodigo|callback_existecodigo');
		$this->form_validation->set_rules('enrol_nombre_completo', 'Nombres y Apellidos del enrolador', 'required|max_length[200]');

		$this->form_validation->set_rules('patroc_codigo', 'Código del patrocinador', 'required|exact_length[5]|callback_validacodigo|callback_existecodigo');
		$this->form_validation->set_rules('patroc_nombre_completo', 'Nombres y Apellidos del patrocinador', 'required|max_length[200]');

		$this->form_validation->set_rules('banco_nombre_cta', 'Nombre del titula de la cuenta', 'required|max_length[200]');
		$this->form_validation->set_rules('banco_numero_cta', 'Número de cuenta bancaria', 'required|min_length[13]|max_length[20]|callback_validanumero');
		$this->form_validation->set_rules('banco_nombre_bco', 'Nombre del Banco', 'required|max_length[150]');
		$this->form_validation->set_rules('banco_sucursal', 'Sucursal bancaria', 'required|max_length[150]');
		$this->form_validation->set_rules('banco_estado', 'Estado de ubicación del banco', 'required|max_length[150]');
		$this->form_validation->set_rules('banco_tipo_cta', 'Tipo de cuenta', 'required');

		$this->form_validation->set_message('required', 'El campo {field} es obligatorio, pulse atrás para corregir');
		$this->form_validation->set_message('valid_email', 'Debe incluir un correo electrónico válido, pulse atrás para corregir');
		$this->form_validation->set_message('max_length', 'El campo {field} no debe exceder de {param} caracteres, pulse atrás para corregir');
		$this->form_validation->set_message('min_length', 'El campo {field} debe tener al menos {param} caracteres, pulse atrás para corregir');
		$this->form_validation->set_message('exact_length', 'El campo {field} debe tener {param} caracteres, pulse atrás para corregir');
		$this->form_validation->set_message('validanumero', 'El campo {field} sólo debe contener números, pulse atrás para corregir');
		$this->form_validation->set_message('validarif', 'El campo {field} debe contener el formato válido para RIF (1 letra: V, J ó E) y hasta 10 números sin guiones ni puntos, pulse atrás para corregir');
		$this->form_validation->set_message('validacodigo', 'El campo {field} debe contener el formato válido para el código largo (XXX-YYYYY-ZZZZ), pulse atrás para corregir');
		$this->form_validation->set_message('existecodigo', 'El {field} no está registrado, introduzca un código válido, pulse atrás para corregir');

		if ($this->form_validation->run() == FALSE){
            $this->registro();
        } else {
			$data = new stdClass();
			$data->title = "MANNA - La Provisión que cambiará tu vida";
			$data->contenido = "apl/auth/contmedico"; //aqui es la dirección física del controlador
			$data->panel_title = "Afiliación de Médicos o profesionales de la salud - Página 3 de 3";

			$data->tit_nombres = $this->input->post('tit_nombres');
           	$data->tit_apellidos = $this->input->post('tit_apellidos');
           	$data->tit_cedula = $this->input->post('tit_cedula');
           	$data->tit_rif = $this->input->post('tit_rif');
           	$data->tit_fecha_nac = $this->input->post('tit_fecha_nac');
           	$data->tit_edo_civil = $this->input->post('tit_edo_civil');
           	$data->tit_sexo = $this->input->post('tit_sexo');
           	$data->tit_profesion = $this->input->post('tit_profesion');
        	$data->cot_nombres = $this->input->post('cot_nombres');
           	$data->cot_apellidos = $this->input->post('cot_apellidos');
           	$data->cot_cedula = $this->input->post('cot_cedula');
           	$data->cot_rif = $this->input->post('cot_rif');
           	$data->cot_fecha_nac = $this->input->post('cot_fecha_nac');
           	$data->cot_edo_civil = $this->input->post('cot_edo_civil');
           	$data->cot_sexo = $this->input->post('cot_sexo');
           	$data->calle = $this->input->post('calle');
           	$data->cruce = $this->input->post('cruce');
           	$data->casa = $this->input->post('casa');
           	$data->sector = $this->input->post('sector');
           	$data->piso = $this->input->post('piso');
           	$data->apto = $this->input->post('apto');
           	$data->referencia = $this->input->post('referencia');
           	$data->ciudad = $this->input->post('ciudad');
           	$data->municipio = $this->input->post('municipio');
           	$data->estado = $this->input->post('estado');
           	$data->parroquia = $this->input->post('parroquia');
           	$data->cod_postal = $this->input->post('cod_postal');
           	$data->pais = $this->input->post('pais');
           	$data->tel_local = $this->input->post('tel_local');
           	$data->tel_celular = $this->input->post('tel_celular');
           	$data->email = $this->input->post('email');
           	$data->enrol_codigo = $this->input->post('enrol_codigo');
           	$data->enrol_nombre_completo = $this->input->post('enrol_nombre_completo');
           	$data->patroc_codigo = $this->input->post('patroc_codigo');
           	$data->patroc_nombre_completo = $this->input->post('patroc_nombre_completo');
           	$data->banco_nombre_cta = $this->input->post('banco_nombre_cta');
           	$data->banco_numero_cta = $this->input->post('banco_numero_cta');
           	$data->banco_nombre_bco = $this->input->post('banco_nombre_bco');
           	$data->banco_sucursal = $this->input->post('banco_sucursal');
           	$data->banco_estado = $this->input->post('banco_estado');
           	$data->banco_tipo_cta = $this->input->post('banco_tipo_cta');
           	$data->tipo_persona = $this->input->post('tipo_persona');
           	$data->nacionalidad = $this->input->post('nacionalidad');
           	$data->tipo_afiliado = $this->input->post('tipo_afiliado');
           	$data->tipo_kit = $this->input->post('tipo_kit');
         	$data->fechapago = substr($this->input->post('fechapago'),6,4)."-".substr($this->input->post('fechapago'),3,2)."-".substr($this->input->post('fechapago'),0,2);
           	$data->numcomprobante = $this->input->post('numcomprobante');
           	$data->bancoorigen = $this->input->post('bancoorigen');
           	$data->envio = $this->input->post('envio');           	
           	$data->direccion_envio = $this->input->post('direccion_envio');

			$data->active = "registro";
			$this->load->view('menu',$data);
		}
	}

//*** Se ejecuta al darle submit en la forma registro ***
	public function contmedico(){
       	$tit_nombres = $this->input->post('tit_nombres');
       	$tit_apellidos = $this->input->post('tit_apellidos');
       	$tit_cedula = $this->input->post('tit_cedula');
       	$tit_rif = $this->input->post('tit_rif');
       	$tit_fecha_nac = $this->input->post('tit_fecha_nac');
       	$tit_edo_civil = $this->input->post('tit_edo_civil');
       	$tit_sexo = $this->input->post('tit_sexo');
       	$tit_profesion = $this->input->post('tit_profesion');
    	$cot_nombres = $this->input->post('cot_nombres');
       	$cot_apellidos = $this->input->post('cot_apellidos');
       	$cot_cedula = $this->input->post('cot_cedula');
       	$cot_rif = $this->input->post('cot_rif');
       	$cot_fecha_nac = $this->input->post('cot_fecha_nac');
       	$cot_edo_civil = $this->input->post('cot_edo_civil');
       	$cot_sexo = $this->input->post('cot_sexo');
       	$calle = $this->input->post('calle');
       	$cruce = $this->input->post('cruce');
       	$casa = $this->input->post('casa');
       	$sector = $this->input->post('sector');
       	$piso = $this->input->post('piso');
       	$apto = $this->input->post('apto');
       	$referencia = $this->input->post('referencia');
       	$ciudad = $this->input->post('ciudad');
       	$municipio = $this->input->post('municipio');
       	$estado = $this->input->post('estado');
       	$parroquia = $this->input->post('parroquia');
       	$cod_postal = $this->input->post('cod_postal');
       	$pais = $this->input->post('pais');
       	$tel_local = $this->input->post('tel_local');
       	$tel_celular = $this->input->post('tel_celular');
       	$email = $this->input->post('email');
       	$enrol_codigo = $this->input->post('enrol_codigo');
       	$enrol_nombre_completo = $this->input->post('enrol_nombre_completo');
       	$patroc_codigo = $this->input->post('patroc_codigo');
       	$patroc_nombre_completo = $this->input->post('patroc_nombre_completo');
       	$banco_nombre_cta = $this->input->post('banco_nombre_cta');
       	$banco_numero_cta = $this->input->post('banco_numero_cta');
       	$banco_nombre_bco = $this->input->post('banco_nombre_bco');
       	$banco_sucursal = $this->input->post('banco_sucursal');
       	$banco_estado = $this->input->post('banco_estado');
       	$banco_tipo_cta = $this->input->post('banco_tipo_cta');
       	$tipo_persona = $this->input->post('tipo_persona');
       	$nacionalidad = $this->input->post('nacionalidad');
       	$tipo_afiliado = $this->input->post('tipo_afiliado');
       	$tipo_kit = $this->input->post('tipo_kit');
       	$fechapago = $this->input->post('fechapago');
       	$numcomprobante = $this->input->post('numcomprobante');
       	$bancoorigen = $this->input->post('bancoorigen');
       	$envio = $this->input->post('envio');
       	$sienvia = ($this->input->post('envio')) ? TRUE : FALSE ;
       	$direccion_envio = $this->input->post('direccion_envio');

       	$user = $this->Auth_model->getUser($email);
		if (!$user) {
			$tp = 'E';
			if ($nacionalidad=='Local') {
				$nc = 'L';
			} else {
				$nc = 'E';
			}
			switch ($tipo_afiliado) {
				case 'Premium':
					$af = 'P';
					break;
				case 'VIP':
					$af = 'V';
					break;
				case 'Oro':
					$af = 'O';
					break;
			}
			$tit_codigo = asignacodigo($this->Auth_model->ultcodigo());
	        $tit_codigo_largo = $_SESSION['prefijo_pais'].'-'.$tit_codigo.'-T'.$tp.$nc.$af;
	        $cot_codigo_largo = $_SESSION['prefijo_pais'].'-'.$tit_codigo.'-C'.$tp.$nc.$af;
			$registro = array(
	          	'tit_codigo' => $tit_codigo,
	          	'tit_codigo_largo' => $tit_codigo_largo,
	          	'cot_codigo_largo' => $cot_codigo_largo,
	        	'tit_nombres' => $tit_nombres,
	           	'tit_apellidos' => $tit_apellidos,
	           	'tit_cedula' => $tit_cedula,
	           	'tit_rif' => $tit_rif,
	           	'tit_fecha_nac' => $tit_fecha_nac,
	           	'tit_edo_civil' => $tit_edo_civil,
	           	'tit_sexo' => $tit_sexo,
	           	'tit_profesion' => $tit_profesion,
	        	'cot_nombres' => $cot_nombres,
	           	'cot_apellidos' => $cot_apellidos,
	           	'cot_cedula' => $cot_cedula,
	           	'cot_rif' => $cot_rif,
	           	'cot_fecha_nac' => $cot_fecha_nac,
	           	'cot_edo_civil' => $cot_edo_civil,
	           	'cot_sexo' => $cot_sexo,
	           	'calle' => $calle,
	           	'cruce' => $cruce,
	           	'casa' => $casa,
	           	'sector' => $sector,
	           	'piso' => $piso,
	           	'apto' => $apto,
	           	'referencia' => $referencia,
	           	'ciudad' => $ciudad,
	           	'municipio' => $municipio,
	           	'estado' => $estado,
	           	'parroquia' => $parroquia,
	           	'cod_postal' => $cod_postal,
	           	'pais' => $pais,
	           	'tel_local' => $tel_local,
	           	'tel_celular' => $tel_celular,
	           	'email' => $email,
	           	'enrol_codigo' => $enrol_codigo,
	           	'enrol_nombre_completo' => $enrol_nombre_completo,
	           	'patroc_codigo' => $patroc_codigo,
	           	'patroc_nombre_completo' => $patroc_nombre_completo,
	           	'banco_nombre_cta' => $banco_nombre_cta,
	           	'banco_numero_cta' => $banco_numero_cta,
	           	'banco_nombre_bco' => $banco_nombre_bco,
	           	'banco_sucursal' => $banco_sucursal,
	           	'banco_estado' => $banco_estado,
	           	'banco_tipo_cta' => $banco_tipo_cta,
	           	'tipo_persona' => $tipo_persona,
	           	'nacionalidad' => $nacionalidad,
	           	'tipo_afiliado' => $tipo_afiliado,
	           	'tipo_kit' => $tipo_kit,
	           	'fecha_afiliacion' => date("Y-m-d"),
	           	'envio' => $sienvia,
	           	'direccion_envio' => $direccion_envio
           	);
           	if ($envio) {
           		$direccion_envio = $direccion_envio;
           	} else {
           		$direccion_envio = 'Calle '.trim($calle).',cruce '.trim($cruce).', casa No. '.trim($casa).', piso '.trim($piso).', apto. '.trim($apto).', sector '.trim($sector).', referencia '.trim($referencia).', parroquia '.trim($parroquia).', ciudad '.trim($ciudad).', municipio '.trim($municipio).', estado '.trim($estado).', Código postal '.trim($cod_postal).', país '.trim($pais);
           	}
           	
			if($this->Auth_model->registro($registro)){
				$this->crea_organizacion($registro['tit_codigo'],$registro['enrol_codigo']);
				$this->transaccion($fechapago,$tit_codigo,$tipo_afiliado,$tipo_kit,$numcomprobante,$bancoorigen);
				$this->orden($tit_codigo,$tipo_afiliado,$tipo_kit,$direccion_envio,trim($tit_nombres).' '.trim($tit_apellidos),trim($tit_cedula),trim($tel_local).' / '.trim($tel_celular),trim($numcomprobante),trim($email),$fechapago);
				$this->patrocinio($patroc_codigo,$tit_codigo,date("Y-m-d"));

	            $user = $this->Auth_model->getUser($email);
	           	$_SESSION['userid'] = $user->id;
	           	$_SESSION['tit_codigo'] = $user->tit_codigo;
	           	$_SESSION['email'] = $user->email;
	           	$_SESSION['tit_nombres'] = $user->tit_nombres;
	           	$_SESSION['tit_apellidos'] = $user->tit_apellidos;
	           	$_SESSION['is_logged_in'] = TRUE;
	           	$this->session->set_flashdata('mensaje_success','Bienvenido ' . trim($_SESSION['tit_nombres']).' '.trim($_SESSION['tit_apellidos']).' número de afiliado: '.trim($_SESSION['tit_codigo']));

				if (strpos(base_url(),'localhost')!==FALSE) {
					$campos = $this->Auth_model->getStructure('information_schema.columns','manna','afiliados');
				} elseif (strpos(base_url(),'pruebas')!==FALSE) {
					$campos = $this->Auth_model->getStructure('information_schema.columns','sgcconsu_manna','afiliados');
				} else {
					$campos = $this->Auth_model->getStructure('information_schema.columns','corpmann_manna','afiliados');
				}
	            $datos = $this->Auth_model->getCampos($tit_codigo);

				$cadena = '<div style="text-align:center">';
					$cadena = '<h3>REGISTRO DE AFILIADO</h3>';
				$cadena .= '</div>';
				$cadena .= '<table align="center" border="1" cellpadding="5">';
	            foreach ($campos as $key) {
					$campo = $key->COLUMN_COMMENT;
					$indice = $key->COLUMN_NAME;
					$cadena .= '<tr>';
						$cadena .= '<td width="45%"><b>'.$campo.'</b></td>';
						$cadena .= '<td width="45%">'.$datos->$indice.'</td>';
					$cadena .= '</tr>';
	            }
				$cadena .= '</table>';
				$cadena .= '<br>';

				if (strpos(base_url(),'localhost')==FALSE) {	           	
					// envía voucher por email
					$config = array(
						'mailtype' => 'html',
						'charset' => 'utf-8'
					);
					$this->email->initialize($config);
					$this->email->from($_SESSION['emp_email'],$_SESSION['emp_nombre']);
					$this->email->to($_SESSION['email']);
					$this->email->subject('CORPORACIÓN MANNA - Certificado de Afiliado: '.trim($registro['tit_codigo_largo']));
					$this->email->message($this->mens_med($registro));
					if ($this->email->send()) {
						$this->session->set_flashdata("mensaje_success","Se ha enviado el certificado al email: " . $_SESSION['email']);
					} else {
						echo $this->email->print_debugger();
					}
					$this->email->initialize($config);
					$this->email->from($_SESSION['emp_email'],$_SESSION['emp_nombre']);
//					$this->email->to('soluciones2000@gmail.com,baudetguerra@gmail.com');
					$this->email->to('soluciones2000@gmail.com');
					$this->email->subject('Datos de la planilla de nuevo afiliado');
					$this->email->message($cadena);
					if ($this->email->send()) {
						$this->session->set_flashdata("mensaje_success","Se ha enviado el certificado al email: " . $_SESSION['email']);
					} else {
						echo $this->email->print_debugger();
					}
					// fin envío email
				}

	           	$this->reg_pdfmed($registro);

    	        redirect(base_url() . 'menu');

			}
		} else {
           	$this->session->set_flashdata("mensaje_error","Usuario ya registrado, pulse atrás para volver");
        	redirect(base_url() . 'medico');
		}
	}

//*** Para generar el pdf ***
	function reg_pdfmed($registro){
		$this->load->library('pdf');
		$pdf = new PDF('P', 'mm', 'letter', true, 'UTF‐8', false);
		$pdf->SetTitle('CERTIFICADO DE AFILIACIÓN');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_MAIN));
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetAutoPageBreak(true,PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setPrintHeader(false);
		$pdf->AddPage();
		// get the current page break margin
		$bMargin = $pdf->getBreakMargin();
		// get current auto-page-break mode
		$auto_page_break = $pdf->getAutoPageBreak();
		// disable auto-page-break
		$pdf->SetAutoPageBreak(false, 0);
		// set bacground image
		$img_file = K_PATH_IMAGES.'fondocertificado.jpg';
		$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
		// restore auto-page-break status
		$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
		// set the starting point for the page content
		$pdf->setPageMark();		
		$pdf->Writehtml('
			<br>
			<br>
			<br>
			<br>
			<h1 align="center">CERTIFICADO DE AFILIACIÓN</h1>
			<br>
			<br>
			<h3 align="center">BIENVENIDO</h3>
			<br>
			<br>
			<p align="right"><b> Número de afiliado: </b>'.trim($registro['tit_codigo']).'</p>
			<br>
			<h4 align="center">DATOS DEL AFILIADO</h4>
			<br>
			<p align="left">
				<b>Nombre: </b>'.trim($registro['tit_nombres']).' '.trim($registro['tit_apellidos']).'<br>
				<b>Tipo de afiliado: </b>'.trim($registro['tipo_afiliado']).'<br>
				<b>Cédula de identidad: </b>'.trim($registro['tit_cedula']).'<br>
				<b>Código del sistema: </b>'.trim($registro['tit_codigo_largo']).'<br>
			</p>
			<br>
			<br>
			<br>
			<br>
			<h4 align="center">DATOS DEL ENROLADOR</h4>
			<br>
			<p align="left">
				<b>Nombre: </b>'.trim($registro['enrol_nombre_completo']).'<br>
				<b>Número de afiliado: </b>'.trim($registro['enrol_codigo']).'<br>
			</p>
			<br>
			<br>
			<br>
			<br>
			<br>
			<h4 align="center">DATOS DEL PATROCINADOR</h4>
			<br>
			<p align="left">
				<b>Nombre: </b>'.trim($registro['patroc_nombre_completo']).'<br>
				<b>Número de afiliado: </b>'.trim($registro['patroc_codigo']).'<br>
			</p>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<p align="center">
				-----------------------------------------------------------
				<br>
			</p>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<p align="justify">
				<b>NOTA IMPORTANTE: </b>Este certificado no es un recibo de ingreso, la emisión de este documento significa que el afiliado ha completado exitosamente el proceso de registro y que forma parte de nuestra base de datos, para completar el proceso deberá realizar los trámites administrativos correspondientes.
				<br>
			</p>
		', true, false, true, false, '');
		$pdf->Output('Certificado_'.trim($registro['tit_codigo_largo']).'.pdf', 'I');
	}

// Comentario
	function mens_med($registro){
		$texto = '
			<br>
			<h3 align="center">BIENVENIDO</h3>
			<br>
			<br>
			<p align="right"><b> Número de afiliado: </b>'.trim($registro['tit_codigo']).'</p>
			<br>
			<h4 align="center">DATOS DEL AFILIADO</h4>
			<br>
			<p align="left">
				<b>Nombre: </b>'.trim($registro['tit_nombres']).' '.trim($registro['tit_apellidos']).'<br>
				<b>Tipo de afiliado: </b>'.trim($registro['tipo_afiliado']).'<br>
				<b>Cédula de identidad: </b>'.trim($registro['tit_cedula']).'<br>
				<b>Código del sistema: </b>'.trim($registro['tit_codigo_largo']).'<br>
			</p>
			<br>
			<br>
			<h4 align="center">DATOS DEL ENROLADOR</h4>
			<br>
			<p align="left">
				<b>Nombre: </b>'.trim($registro['enrol_nombre_completo']).'<br>
				<b>Número de afiliado: </b>'.trim($registro['enrol_codigo']).'<br>
			</p>
			<br>
			<br>
			<br>
			<h4 align="center">DATOS DEL PATROCINADOR</h4>
			<br>
			<p align="left">
				<b>Nombre: </b>'.trim($registro['patroc_nombre_completo']).'<br>
				<b>Número de afiliado: </b>'.trim($registro['patroc_codigo']).'<br>
			</p>
			<br>
			<br>
			<br>
			<p align="center">
				-----------------------------------------------------------
				<br>
			</p>
			<br>
			<br>
			<br>
			<p align="justify">
				<b>NOTA IMPORTANTE: </b>Este certificado no es un recibo de ingreso, la emisión de este documento significa que el afiliado ha completado exitosamente el proceso de registro y que forma parte de nuestra base de datos, para completar el proceso deberá realizar los trámites administrativos correspondientes.
				<br>
			</p>
			<br>
			<br>
			<p align="justify">
				<b>DOCUMENTOS: </b>Por favor escanee y envíe sus credenciales profesionales que lo avalen como Médico o profesional de la salud al email <a href="documentos@corporacionmanna.com" target="_blank">documentos@corporacionmanna.com</a>.
				<br>
			</p>
		';
		return $texto;
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function validanumero($numero){
		$valores = '0123456789';
		$valido = true;
		for ($i=0; $i < strlen(strval($numero)); $i++) { 
			$pos = strpos($valores, substr(strval($numero),$i,1));
			if ($pos === false) {
				$valido = false;
				break;
			}
		}
		return $valido;
	}

// Comentario
	public function codigocero($numero){
		if ($numero=='00000') {
			$valido = false;
		} else {
			$valido = true;
		}
		return $valido;
	}

// Comentario
	public function validacodigo($numero){
		$valores = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$valido = true;
		for ($i=0; $i < strlen(strval($numero)); $i++) { 
			$pos = strpos($valores, substr(strval($numero),$i,1));
			if ($pos === false) {
				$valido = false;
				break;
			}
		}
		return $valido;
	}

// Comentario
	public function existecodigo($numero){
		$valido = true;
	    $user = $this->Auth_model->codigo($numero);
		if (!$user) {
			$valido = false;
		}
		return $valido;
	}

// Comentario
	public function validarif($numero){
		$valido = true;
		if (strlen(strval($numero))>0) {
			$letras = "JjVvEe";
			$valores = '0123456789';
			$valido = true;
			$pos = strpos($letras, substr(strval($numero),0,1));
			if ($pos === false) {
				$valido = false;
				return $valido;
			}
			for ($i=1; $i < strlen(strval($numero)); $i++) { 
				$pos = strpos($valores, substr(strval($numero),$i,1));
				if ($pos === false) {
					$valido = false;
					break;
				}
			}
		}
		return $valido;
	}
/*
// Comentario
	public function asignacodigo($ultcodigo){
		$valores = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$codigo = '';
		$arriba = 1;
		$newcodigo = '';
		$numero = $ultcodigo->ultcodigo;
		for ($i=strlen($numero)-1 ; $i>=0 ; $i--) { 
			$pos = strpos($valores, substr($numero,$i,1));
			$a = strlen($valores)-1;
			if ($arriba==1) {
				if ($pos==strlen($valores)-1) {
					$codigo = substr($valores,0,1);
				} else {
					$codigo = substr($valores,$pos+1,1);
					$arriba = 0;
				}
			} else {
				$codigo = substr($numero,$i,1);
			}
			$newcodigo = $codigo.$newcodigo;
		}		
		return $newcodigo;
	}
//****************************************************************************************************
*/

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

}
