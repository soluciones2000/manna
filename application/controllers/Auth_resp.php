<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

//*** Constructor ***
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model');
	}

//*** Prepara las variables y llama a la vista login ***
	public function login(){
		$data = new stdClass();
		$data->title = "MANNA - La Provisión que cambiará tu vida";
		$data->contenido = "apl/auth/login"; //aqui es la dirección física del controlador
		$data->panel_title = "Inicio de sesión para el administrador";
		$data->active = "login";
		$this->load->view('menu',$data);
	}

//*** Se ejecuta al darle submit en la forma login ***
	public function entrar(){
		$this->form_validation->set_rules('correo', 'Email', 'required|valid_email|max_length[150]');
		$this->form_validation->set_rules('pass', 'Password', 'required|min_length[8]|max_length[16]');

		$this->form_validation->set_message('required', 'El campo {field} es obligatorio, pulse atrás para volver');
		$this->form_validation->set_message('valid_email', 'Debe incluir un correo electrónico válido, pulse atrás para volver');
		$this->form_validation->set_message('max_length', 'El campo {field} no debe exceder de {param} caracteres, pulse atrás para volver');
		$this->form_validation->set_message('min_length', 'El campo {field} debe tener al menos {param} caracteres, pulse atrás para volver');

		if ($this->form_validation->run() == FALSE){
			$this->login();
        } else {
            $correo = $this->input->post('correo');
            $pass = $this->input->post('pass');

            $user = $this->Auth_model->getUser($correo);
            if (!$user) {
            	$this->session->set_flashdata("mensaje_error","Datos de usuario incorrectos, pulse atrás para volver");
            	redirect(base_url() . 'login');
            }
            if ($user->user_pass != sha1(md5($pass))) {
            	$this->session->set_flashdata("mensaje_error","Datos de usuario incorrectos, pulse atrás para volver");
            	redirect(base_url() . 'login');
            }
            $_SESSION['userid'] = $user->id;
           	$_SESSION['user_email'] = $user->user_email;
           	$_SESSION['nombre'] = $user->name_user;
           	$_SESSION['is_logged_in'] = TRUE;
            redirect(base_url().'monto');
        }
	}

//*** Prepara las variables y llama a la vista registro ***
	public function registro(){
		$data = new stdClass();
		$data->title = "MANNA - La Provisión que cambiará tu vida";
		$data->contenido = "apl/auth/registro"; //aqui es la dirección física del controlador
		$data->panel_title = "Afiliación de aliados comerciales - Página 1 de 2";
		$data->active = "registro";
		$this->load->view('menu',$data);
	}

//*** Se ejecuta al darle submit en la forma registro ***
	public function crea_user(){
		$this->form_validation->set_rules('tit_nombres', 'Nombres del titular', 'required|max_length[150]');
		$this->form_validation->set_rules('tit_apellidos', 'Apellidos del titular', 'required|max_length[150]');
		$this->form_validation->set_rules('tit_cedula', 'Cédula de identidad', 'required|min_length[6]|max_length[8]|callback_validanumero');
		$this->form_validation->set_rules('tit_rif', 'RIF', 'required|min_length[8]|max_length[10]|callback_validarif');
		$this->form_validation->set_rules('tit_fecha_nac', 'Fecha de nacimiento', 'required');
		$this->form_validation->set_rules('tit_edo_civil', 'Estado Civil', 'required');
		$this->form_validation->set_rules('tit_sexo', 'Sexo', 'required');
		$this->form_validation->set_rules('tit_profesion', 'Profesión', 'required|max_length[150]');

		$this->form_validation->set_rules('cot_nombres', 'Nombres del cotitular', 'required|max_length[150]');
		$this->form_validation->set_rules('cot_apellidos', 'Apellidos del cotitular', 'required|max_length[150]');
		$this->form_validation->set_rules('cot_cedula', 'Cédula de identidad', 'required|min_length[6]|max_length[8]|callback_validanumero');
		$this->form_validation->set_rules('cot_rif', 'RIF', 'required|min_length[8]|max_length[10]|callback_validarif');
		$this->form_validation->set_rules('cot_fecha_nac', 'Fecha de nacimiento', 'required');
		$this->form_validation->set_rules('cot_edo_civil', 'Estado Civil', 'required');
		$this->form_validation->set_rules('cot_sexo', 'Sexo', 'required');

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

		$this->form_validation->set_rules('enrol_codigo', 'Número del enrolador', 'required|max_length[20]|callback_validanumero');
		$this->form_validation->set_rules('enrol_nombre_completo', 'Nombres y Apellidos del enrolador', 'required|max_length[200]');
		$this->form_validation->set_rules('enrol_pais', 'País del enrolador', 'required|max_length[150]');

		$this->form_validation->set_rules('patroc_codigo', 'Número del patrocinador', 'required|max_length[20]|callback_validanumero');
		$this->form_validation->set_rules('patroc_nombre_completo', 'Nombres y Apellidos del patrocinador', 'required|max_length[200]');
		$this->form_validation->set_rules('patroc_pais', 'País del patrocinador', 'required|max_length[150]');

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
		$this->form_validation->set_message('validanumero', 'El campo {field} sólo debe contener números, pulse atrás para corregir');
		$this->form_validation->set_message('validarif', 'El campo {field} debe contener el formato válido para RIF (1 letra: V ó J) y hasta 9 números, pulse atrás para corregir');

		if ($this->form_validation->run() == FALSE){
            $this->registro();
        } else {
/*        	$tit_nombres = $this->input->post('tit_nombres');
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
           	$enrol_pais = $this->input->post('enrol_pais');
           	$patroc_codigo = $this->input->post('patroc_codigo');
           	$patroc_nombre_completo = $this->input->post('patroc_nombre_completo');
           	$patroc_pais = $this->input->post('patroc_pais');
           	$banco_nombre_cta = $this->input->post('banco_nombre_cta');
           	$banco_numero_cta = $this->input->post('banco_numero_cta');
           	$banco_nombre_bco = $this->input->post('banco_nombre_bco');
           	$banco_sucursal = $this->input->post('banco_sucursal');
           	$banco_estado = $this->input->post('banco_estado');
           	$banco_tipo_cta = $this->input->post('banco_tipo_cta');

           	$user = $this->Auth_model->getUser($email);
			if (!$user) {
				$registro = array(
		           	'tit_codigo' => $tit_cedula,
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
		           	'enrol_pais' => $enrol_pais,
		           	'patroc_codigo' => $patroc_codigo,
		           	'patroc_nombre_completo' => $patroc_nombre_completo,
		           	'patroc_pais' => $patroc_pais,
		           	'banco_nombre_cta' => $banco_nombre_cta,
		           	'banco_numero_cta' => $banco_numero_cta,
		           	'banco_nombre_bco' => $banco_nombre_bco,
		           	'banco_sucursal' => $banco_sucursal,
		           	'banco_estado' => $banco_estado,
		           	'banco_tipo_cta' => $banco_tipo_cta
	           	);
			if($this->Auth_model->registro($registro)){
		            $user = $this->Auth_model->getUser($email);
		           	$_SESSION['userid'] = $user->id;
		           	$_SESSION['tit_codigo'] = $user->tit_codigo;
		           	$_SESSION['email'] = $user->email;
		           	$_SESSION['tit_nombres'] = $user->tit_nombres;
		           	$_SESSION['tit_apellidos'] = $user->tit_apellidos;
		           	$_SESSION['is_logged_in'] = TRUE;
		           	$this->session->set_flashdata('mensaje_success','Bienvenido ' . trim($_SESSION['tit_nombres']).' '.trim($_SESSION['tit_apellidos']).' Número de afiliado: '.trim($_SESSION['tit_codigo']));
    	        	redirect(base_url() . 'menu');
				}*/
			$data = new stdClass();
			$data->title = "MANNA - La Provisión que cambiará tu vida";
			$data->contenido = "apl/auth/contrato"; //aqui es la dirección física del controlador
			$data->panel_title = "Afiliación de aliados comerciales";
			$data->active = "registro";
			$this->load->view('menu',$data);
		/*	} else {
            	$this->session->set_flashdata("mensaje_error","Usuario ya registrado, pulse atrás para volver");
           		redirect(base_url() . 'registro');
			}
        }*/
	}

//*** Prepara las variables y llama a la vista cambio de clave ***
	public function cambio(){
		$data = new stdClass();
		$data->title = "Pasarela de pagos";
		$data->contenido = "apl/auth/cambio"; //aqui es la dirección física del controlador
		$data->panel_title = "Cambio de clave";
		$data->active = "cambio";
		$this->load->view('menu',$data);
	}

//*** Se ejecuta al darle submit en la forma cambio de clave ***
	public function passchange(){
		$this->form_validation->set_rules('passact', 'Contraseña actual', 'required|min_length[8]|max_length[16]');
		$this->form_validation->set_rules('passnew', 'Contraseña nueva', 'required|min_length[8]|max_length[16]');
		$this->form_validation->set_rules('passconfnew', 'Confirmar contraseña nueva', 'required|min_length[8]|max_length[16]|matches[passnew]');

		$this->form_validation->set_message('required', 'El campo {field} es obligatorio, pulse atrás para volver');
		$this->form_validation->set_message('max_length', 'El campo {field} no debe exceder de {param} caracteres, pulse atrás para volver');
		$this->form_validation->set_message('min_length', 'El campo {field} debe tener al menos {param} caracteres, pulse atrás para volver');
		$this->form_validation->set_message('matches', 'El campo {field} debe coincidir con {param}, pulse atrás para volver');
		if ($this->form_validation->run() == FALSE){
            $this->cambio();
        } else {
        	$correo = $_SESSION['user_email'];
            $passact = $this->input->post('passact');
           	$passnew = $this->input->post('passnew');
           	$passconfnew = $this->input->post('passconfnew');

           	$user = $this->Auth_model->getUser($correo);
			if (!$user) {
            	$this->session->set_flashdata("mensaje_error","Datos de usuario incorrectos, pulse atrás para volver");
            	redirect(base_url() . 'logout');
            }
            if ($user->user_pass != sha1(md5($passact))) {
            	$this->session->set_flashdata("mensaje_error","Contrseña actual incorrecta, pulse atrás para volver");
            	redirect(base_url() . 'cambio');
            }
			$registro = array(
				'user_email' => $correo,
				'user_pass' => sha1(md5($passnew))
			);
			if($this->Auth_model->passcambio($registro)){
				$this->session->set_flashdata('mensaje_success','Cambio de clave exitoso');
				$data = new stdClass();

				$data->title = "Pasarela de pagos";
				$data->panel_title = "Procesamiento de pagos";
				$data->contenido = "apl/pago/formulario"; //aqui es la dirección física del controlador
				
				$this->load->view('menu',$data);
			}
        }
	}

//*** Prepara las variables y llama a la vista recuperar clave ***
	public function recuperar(){
		$data = new stdClass();
		$data->title = "Pasarela de pagos";
		$data->contenido = "apl/auth/recuperar"; //aqui es la dirección física del controlador
		$data->panel_title = "Recuperación de contraseña";
		$data->active = "recuperar";
		$this->load->view('menu',$data);
	}

//*** Se ejecuta al darle submit en la forma recuperar clave ***
	public function pregunta(){
		$this->form_validation->set_rules('correo', 'Email', 'required|valid_email|max_length[150]');

		$this->form_validation->set_message('required', 'El campo {field} es obligatorio, pulse atrás para volver');
		$this->form_validation->set_message('valid_email', 'Debe incluir un correo electrónico válido, pulse atrás para volver');
		$this->form_validation->set_message('max_length', 'El campo {field} no debe exceder de {param} caracteres, pulse atrás para volver');

		if ($this->form_validation->run() == FALSE){
			$this->recuperar();
        } else {
            $correo = $this->input->post('correo');
            $user = $this->Auth_model->getUser($correo);
            if (!$user) {
            	$this->session->set_flashdata("mensaje_error","Datos de usuario incorrectos, pulse atrás para volver");
            	redirect(base_url() . 'recuperar');
            }
            $this->respuesta();
		}
	}

//*** Prepara las variables y llama a la vista de la pregunta de desafío ***
	public function respuesta(){
        $correo = $_POST['correo'];
        $user = $this->Auth_model->getUser($correo);
        $pista = $user->pista;
        $respuesta = $user->respuesta;
		$data = new stdClass();

		$data->title = "Pasarela de pagos";
		$data->panel_title = "Pregunta de seguridad";
		$data->correo = $correo;
		$data->respuesta = $respuesta;
		$data->label = $pista;
		$data->contenido = "apl/auth/pregunta"; //aqui es la dirección física del controlador
				
		$this->load->view('menu',$data);
	}

//*** Se ejecuta al darle submit en la forma de la pregunta de desafío, valida la respuesta ***
	public function passretrieve(){
        $correo = $_POST['correo'];
		$this->form_validation->set_rules('answer', 'Respuesta a la pregunta de seguridad', 'required|max_length[150]');

		$this->form_validation->set_message('required', 'El campo {field} es obligatorio');
		$this->form_validation->set_message('max_length', 'El campo {field} no debe exceder de {param} caracteres');
		if ($this->form_validation->run() == FALSE){
			$this->respuesta();
        } elseif ($this->input->post('respuesta') != sha1(md5(strtoupper($this->input->post('answer'))))) {
        	$this->session->set_flashdata("mensaje_error","Respuesta incorrecta");
//        	redirect(base_url().'logout');

			$data = new stdClass();

			$data->correo = $correo;
			$data->title = "Pasarela de pagos";
			$data->panel_title = "Respuesta equivocada";
			$data->contenido = "apl/auth/norespuesta"; //aqui es la dirección física del controlador
				
			$this->load->view('menu',$data);
        } else {
			$this->session->set_flashdata('mensaje_success','Respuesta correcta, establezca de nuevo su contraseña');
			$data = new stdClass();

			$data->title = "Pasarela de pagos";
			$data->correo = $this->input->post('correo');
			$data->panel_title = "Reinicio de clave";
			$data->contenido = "apl/auth/respuesta"; //aqui es la dirección física del controlador
				
			$this->load->view('menu',$data);

        }
	}

	public function hint(){
        $correo = $_POST['correo'];
        $this->Auth_model->eliminar($correo);
        redirect(base_url() . 'logout');
	}

	public function reset(){
        print_r($_POST);
		$data = new stdClass();

		$data->title = "Pasarela de pagos";
		$data->panel_title = "Reinicio de clave";
		$data->contenido = "apl/auth/respuesta"; //aqui es la dirección física del controlador
				
		$this->load->view('menu',$data);
	}

	public function reinicio(){
		$this->form_validation->set_rules('pass', 'Contraseña', 'required|min_length[8]|max_length[16]');
		$this->form_validation->set_rules('passconf', 'Confirmar contraseña', 'required|min_length[8]|max_length[16]|matches[pass]');

		$this->form_validation->set_message('required', 'El campo {field} es obligatorio, pulse atrás para volver');
		$this->form_validation->set_message('max_length', 'El campo {field} no debe exceder de {param} caracteres, pulse atrás para volver');
		$this->form_validation->set_message('min_length', 'El campo {field} debe tener al menos {param} caracteres, pulse atrás para volver');
		$this->form_validation->set_message('matches', 'El campo {field} debe coincidir con {param}, pulse atrás para volver');
		if ($this->form_validation->run() == FALSE){
            $this->reset();
        } else {
        	$correo = $this->input->post('correo');
           	$pass = $this->input->post('pass');
           	$passconf = $this->input->post('passconf');

           	$user = $this->Auth_model->getUser($correo);
			if (!$user) {
            	$this->session->set_flashdata("mensaje_error","Datos de usuario incorrectos, pulse atrás para volver");
            	redirect(base_url() . 'logout');
            }
			$registro = array(
				'user_email' => $correo,
				'user_pass' => sha1(md5($pass))
			);
			if($this->Auth_model->passcambio($registro)){
				$this->session->set_flashdata('mensaje_success','Cambio de clave exitoso');
				redirect(base_url().'login');
			}
        }
	}

	public function logout(){
		session_destroy();
		redirect();
	}

	function validanumero($numero){
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

	function validarif($numero){
		$letras = "JV";
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
		return $valido;
	}

}
