<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function getUser($email){
		$this->db->where('email',$email);
		$query = $this->db->get('afiliados');
		return $query->row();
	}

	public function registro($data){
		$success = $this->db->insert('afiliados',$data);
		return $success;
	}

	public function passcambio($data){
		$this->db->set('user_pass', $data['user_pass']);
		$this->db->where('user_email', $data['user_email']);
		$success = $this->db->update('usuarios'); // gives UPDATE mytable SET field = field+1 WHERE id = 2
		return $success;
	}

	public function eliminar($email){
		$this->db->where('user_email', $email);
		$success = $this->db->delete('usuarios');
		return $success;
	}

	public function ultcodigo(){
		$this->db->select_max('tit_codigo', 'ultcodigo');
		$query = $this->db->get('afiliados');
		return $query->row();
	}

	public function codigo($tit_codigo){
		$this->db->where('tit_codigo',$tit_codigo);
		$query = $this->db->get('afiliados');
		return $query->row();
	}

	public function genealogia($data){
		$success = $this->db->insert('genealogia',$data);
		return $success;
	}

	public function organizacion($data){
		$success = $this->db->insert('organizacion',$data);
		return $success;
	}

	public function padre($tit_codigo){
		$this->db->where('hijo',$tit_codigo);
		$query = $this->db->get('genealogia');
		return $query->row();
	}

	public function transaccion($data){
		$success = $this->db->insert('transacciones',$data);
		return $success;
	}

	public function num_orden($codigo,$fecha){
		$this->db->where('codigo',$codigo);
		$this->db->where('fecha',$fecha);
		$query = $this->db->get('ordenes');
		return $query->row();
	}

	public function orden($data){
		$success = $this->db->insert('ordenes',$data);
		$orden = $this->num_orden($data['codigo'],$data['fecha']);
		$orden_id = $orden->orden_id;
		return $orden_id;
	}

	public function det_orden($data){
		$success = $this->db->insert('det_orden',$data);
		return $success;
	}

	public function patrocinio($data){
		$success = $this->db->insert('patrocinio',$data);
		return $success;
	}

	public function ciudades(){
		$query = $this->db->get('ciudades');
		return $query->row();
	}

	public function reg_clte($data){
		$success = $this->db->insert('cliente_preferencial',$data);
		return $success;
	}

	public function ultcodclte(){
		$this->db->select_max('cod_corto_clte', 'ultcodigo');
		$query = $this->db->get('cliente_preferencial');
		return $query->row();
	}

	public function getClte($email){
		$this->db->where('clte_email',$email);
		$query = $this->db->get('cliente_preferencial');
		return $query->row();
	}

	public function club_180($data){
		$success = $this->db->insert('club_180',$data);
		return $success;
	}

	public function getStructure($schema,$db,$tabla){
		$this->db->where('table_schema',$db);
		$this->db->where('table_name',$tabla);
		$query = $this->db->get($schema);
		return $query->result();
	}

	public function getCampos($codigo){
		$this->db->where('tit_codigo',$codigo);
		$query = $this->db->get('afiliados');
		return $query->row();
	}

}