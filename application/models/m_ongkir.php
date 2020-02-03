<?php
defined('BASEPATH') Or exit('No direct script access allowed');

class M_ongkir extends CI_Model{

	function ongkir($data){
		return $this->db->insert('history_pos',$data);
	}

}