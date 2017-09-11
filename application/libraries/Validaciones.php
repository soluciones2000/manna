<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validaciones extends CI_Controller {

//*** Constructor ***
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model');
	}

// Comentario
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
		echo "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
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

}
