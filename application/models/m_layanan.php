<?php
class m_layanan extends MY_Model {
	
	function __construct()
	{
		parent::__construct('layanan',array('id_layanan'));		
	}
	
	function getLayanan()
	{
		return $this->getData(array('aktif'=>'1','deleted'=>'0'),array('nama_layanan'=>'asc'));
	}
} 