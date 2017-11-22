<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct()
	{
//		session_destroy();
		parent::__construct();
		$this->load->model('Param_model');
	}

	public function index()
	{

	    $param = $this->Param_model->getParam();
    	if (!$param) {
	      $this->session->set_flashdata("mensaje_error","Parmetros de la empresa incorrectos, comuniquese con soporte");
    	  redirect();
	    }
	    $_SESSION['emp_id'] = $param->id;
	    $_SESSION['emp_nombre'] = $param->emp_nombre;
    	$_SESSION['emp_rif'] = $param->emp_rif;
    	$_SESSION['emp_web'] = $param->emp_web;
    	$_SESSION['emp_email'] = $param->emp_email;
    	$_SESSION['emp_direccion'] = $param->emp_direccion;
    	$_SESSION['emp_logo'] = $param->emp_logo;
    	$_SESSION['prefijo_pais'] = $param->prefijo_pais;

        $_SESSION['pvp_premium_hogar'] = $param->pvp_premium_hogar;
        $_SESSION['pvp_premium_lq'] = $param->pvp_premium_lq;
        $_SESSION['pvp_premium_teatro'] = $param->pvp_premium_teatro;
        $_SESSION['pvp_premium_todas'] = $param->pvp_premium_todas;
        $_SESSION['pvp_vip_hogar'] = $param->pvp_vip_hogar;
        $_SESSION['pvp_vip_lq'] = $param->pvp_vip_lq;
        $_SESSION['pvp_vip_teatro'] = $param->pvp_vip_teatro;
        $_SESSION['pvp_vip_todas'] = $param->pvp_vip_todas;
        $_SESSION['pvp_oro_hogar'] = $param->pvp_oro_hogar;
        $_SESSION['pvp_oro_lq'] = $param->pvp_oro_lq;
        $_SESSION['pvp_oro_teatro'] = $param->pvp_oro_teatro;
        $_SESSION['pvp_oro_todas'] = $param->pvp_oro_todas;

    	$_SESSION['premium_hogar'] = $param->premium_hogar;
    	$_SESSION['premium_lq'] = $param->premium_lq;
    	$_SESSION['premium_teatro'] = $param->premium_teatro;
    	$_SESSION['premium_todas'] = $param->premium_todas;
    	$_SESSION['vip_hogar'] = $param->vip_hogar;
    	$_SESSION['vip_lq'] = $param->vip_lq;
    	$_SESSION['vip_teatro'] = $param->vip_teatro;
    	$_SESSION['vip_todas'] = $param->vip_todas;
    	$_SESSION['oro_hogar'] = $param->oro_hogar;
    	$_SESSION['oro_lq'] = $param->oro_lq;
    	$_SESSION['oro_teatro'] = $param->oro_teatro;
    	$_SESSION['oro_todas'] = $param->oro_todas;

        $_SESSION['mp_premium_hogar'] = $param->mp_premium_hogar;
        $_SESSION['mp_premium_lq'] = $param->mp_premium_lq;
        $_SESSION['mp_premium_teatro'] = $param->mp_premium_teatro;
        $_SESSION['mp_premium_todas'] = $param->mp_premium_todas;
        $_SESSION['mp_vip_hogar'] = $param->mp_vip_hogar;
        $_SESSION['mp_vip_lq'] = $param->mp_vip_lq;
        $_SESSION['mp_vip_teatro'] = $param->mp_vip_teatro;
        $_SESSION['mp_vip_todas'] = $param->mp_vip_todas;
        $_SESSION['mp_oro_hogar'] = $param->mp_oro_hogar;
        $_SESSION['mp_oro_lq'] = $param->mp_oro_lq;
        $_SESSION['mp_oro_teatro'] = $param->mp_oro_teatro;
        $_SESSION['mp_oro_todas'] = $param->mp_oro_todas;
        $_SESSION['valor_punto'] = $param->valor_punto;

		$data = new stdClass();

		$data->title = "MANNA - La Provisión que cambiará tu vida";
		$data->logo = $_SESSION['emp_logo'];
		$data->contenido = "holamundo/hola";
		
		$this->load->view('menu',$data);

	}
}
