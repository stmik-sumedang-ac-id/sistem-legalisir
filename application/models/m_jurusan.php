<?php
class m_mahasiswa extends MY_Model {
	
	function __construct()
	{
		parent::__construct('mahasiswa',array('nim'));
		$this->publikasi = $this->load->database('publikasi', false);
	}
	
}