<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

//*** Constructor ***
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model');
	}

//*** Prepara las variables y llama a la vista registro ***
	public function cliente_pref(){
		$data = new stdClass();
		$data->title = "MANNA - La Provisión que cambiará tu vida";
		$data->contenido = "apl/auth/cliente"; //aqui es la dirección física del controlador
		$data->panel_title = "Afiliación de Cliente Preferencial";
		$data->active = "registro";
		$this->load->view('menu',$data);
	}

//*** Prepara las variables y llama a la vista registro ***
	public function reg_cliente(){
		$this->form_validation->set_rules('clte_nombre', 'Nombre', 'required|max_length[150]');
		$this->form_validation->set_rules('clte_cedula', 'Cédula', 'required|min_length[6]|max_length[10]');
		$this->form_validation->set_rules('clte_telefono', 'Teléfono', 'required|max_length[20]');
		$this->form_validation->set_rules('clte_email', 'Correo electrónico', 'required|valid_email|min_length[5]|max_length[100]');
		$this->form_validation->set_rules('clte_direccion', 'Dirección fiscal', 'required|max_length[200]');
		$this->form_validation->set_rules('clte_direccion_envio', 'Dirección de envío', 'required|max_length[200]');
		$this->form_validation->set_rules('patroc_codigo', 'Código del patrocinador', 'required|exact_length[5]|callback_codigocero|callback_validacodigo|callback_existecodigo');

		$this->form_validation->set_message('required', 'El campo {field} es obligatorio, pulse atrás para volver');
		$this->form_validation->set_message('min_length', 'El campo {field} debe tener al menos {param} caracteres, pulse atrás para volver');
		$this->form_validation->set_message('max_length', 'El campo {field} no debe exceder de {param} caracteres, pulse atrás para volver');
		$this->form_validation->set_message('valid_email', 'Debe incluir un correo electrónico válido, pulse atrás para volver');
		$this->form_validation->set_message('exact_length', 'El campo {field} debe tener {param} caracteres, pulse atrás para corregir');
		$this->form_validation->set_message('codigocero', 'El campo {field} no puede ser 00000, pulse atrás para corregir');
		$this->form_validation->set_message('validacodigo', 'El campo {field} debe contener el formato válido para el código (Sólo números y letras mayúsculas), pulse atrás para corregir');
		$this->form_validation->set_message('existecodigo', 'El {field} no está registrado, introduzca un código válido, pulse atrás para corregir');

		if ($this->form_validation->run() == FALSE){
			$this->cliente_pref();
        } else {
			$data = new stdClass();
			$clte_nombre = $this->input->post('clte_nombre');
			$clte_cedula = strtoupper($this->input->post('clte_cedula'));
			$clte_telefono = $this->input->post('clte_telefono');
			$clte_email	= $this->input->post('clte_email');
			$clte_direccion = $this->input->post('clte_direccion');
			$clte_direccion_envio = $this->input->post('clte_direccion_envio');
           	$patroc_codigo = strtoupper($this->input->post('patroc_codigo'));
//			$cod_corto_clte = $this->asignacodclte($this->Auth_model->ultcodclte());
			$cod_corto_clte = asignacodclte($this->Auth_model->ultcodclte());
			$cod_clte = trim($patroc_codigo).trim($cod_corto_clte);

		    $patroc = $this->Auth_model->codigo($patroc_codigo);
           	$patroc_nombre_completo = trim($patroc->tit_nombres).' '.trim($patroc->tit_apellidos);

			$registro = array(
				'cod_clte' => $cod_clte,
				'clte_nombre' => $clte_nombre,
				'clte_cedula' => $clte_cedula,
				'clte_telefono' => $clte_telefono,
				'clte_email' =>	$clte_email,
				'clte_direccion' => $clte_direccion,
				'clte_direccion_envio' => $clte_direccion_envio,
				'patroc_codigo' => $patroc_codigo,
				'cod_corto_clte' => $cod_corto_clte
           	);
			if($this->Auth_model->reg_clte($registro)){
				$this->registro_club_180($cod_clte,'Cliente preferencial',$patroc_codigo);
	            $user = $this->Auth_model->getClte($clte_email);
	           	$_SESSION['cod_clte'] = $user->cod_clte;
	           	$_SESSION['email'] = $user->clte_email;
	           	$_SESSION['clte_nombre'] = $user->clte_nombre;
	           	$_SESSION['is_logged_in'] = TRUE;
				if (strpos(base_url(),'localhost')==FALSE) {	           	
					// envía voucher por email
					$config = array(
						'mailtype' => 'html',
						'charset' => 'utf-8'
					);
					$this->email->initialize($config);
					$this->email->from($_SESSION['emp_email'],$_SESSION['emp_nombre']);
					$this->email->to($_SESSION['email']);
					$this->email->subject('CORPORACIÓN MANNA - Bienvenido Cliente preferencial: '.trim($registro['cod_clte']));
					$this->email->message($this->mensaje($registro,$patroc_nombre_completo));
					if ($this->email->send()) {
						$this->session->set_flashdata("mensaje_success","Se ha enviado un email de bienvenida a: " . $_SESSION['email']);
					} else {
						echo $this->email->print_debugger();
					}
					$this->email->message("Se ha enviado el siguiente mensaje:<br><br>".$this->mensaje($registro,$patroc_nombre_completo));
					$this->email->to('soluciones2000@gmail.com');
					if (!$this->email->send()) {
						echo $this->email->print_debugger();
					}
					// fin envío email
				}
			}
			$data->title = "MANNA - La Provisión que cambiará tu vida";
			$data->contenido = "apl/auth/bienvenida"; //aqui es la dirección física del controlador
			$data->panel_title = "Bienvenido ".$clte_nombre;
			$data->cod_clte = $cod_clte;
			$data->active = "registro";
			$this->load->view('menu',$data);
		}
	}

// Comentario
	function mensaje($registro,$patroc_nombre_completo){
		$texto = '
			<br>
			<h3 align="center">BIENVENIDO</h3>
			<br>
			<br>
			<p align="right"><b> Número de cliente preferencial: </b>'.trim($registro['cod_clte']).'</p>
			<br>
			<h4 align="center">DATOS DEL CLIENTE</h4>
			<br>
			<p align="left">
				<b>Nombre: </b>'.trim($registro['clte_nombre']).'<br>
				<b>Cédula de identidad: </b>'.trim($registro['clte_cedula']).'<br>
				<b>Teléfono: </b>'.trim($registro['clte_telefono']).'<br>
				<b>Correo electrónico: </b>'.trim($registro['clte_email']).'<br>
				<b>Dirección fiscal: </b>'.trim($registro['clte_direccion']).'<br>
				<b>Dirección de envío: </b>'.trim($registro['clte_direccion_envio']).'<br>
				<b>Patrocinador: </b>'.trim($registro['patroc_codigo']).' - '.$patroc_nombre_completo.'<br>
			</p>
			<br>
			<br>
			<br>
			<p align="center">
				-----------------------------------------------------------
			</p>
			<br>
			<p align="justify">
				Atentamente,
			</p>
			<br>
			<p align="justify">
				El Equipo Manna.
			</p>
		';
		return $texto;
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

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
	public function registro_club_180($cod_miembro,$tipo_miembro,$patroc_codigo){
		$registro = array(
	       	'cod_miembro' => $cod_miembro,
	       	'tipo_miembro' => $tipo_miembro,
	       	'patroc_codigo' => $patroc_codigo
        );
		$this->Auth_model->club_180($registro);
	}

/*
// Comentario
	public function asignacodclte($ultcodigo){
		$valores = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$codigo = '';
		$arriba = 1;
		$newcodigo = '';
		$numero = $ultcodigo->ultcodigo;
		$numero = (strlen($numero)<=0) ? "00000" : $numero ;
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
*/
}
