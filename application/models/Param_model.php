<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Param_model extends CI_Model {

	public function getParam(){
//		$this->db->delete('ci_sessions', array('timestamp <' => 'UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 DAY))'));
		$query = $this->db->get('empresa');
		return $query->row();
	}
}