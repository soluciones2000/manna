<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ayuda extends CI_Controller {

//*** Constructor ***
	public function __construct()
	{
		parent::__construct();
	}

//*** Prepara las variables y llama a la vista registro ***
	public function fechas(){
		$data = new stdClass();
		$data->title = "MANNA - La Provisión que cambiará tu vida";
		$data->contenido = "apl/auth/fechas"; //aqui es la dirección física del controlador
		$data->panel_title = "Ayuda - tutorial de como insertar fechas";
		$data->active = "fechas";
		$this->load->view('menu',$data);
	}

}
