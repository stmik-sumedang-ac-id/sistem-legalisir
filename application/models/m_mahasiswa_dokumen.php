<?php
class m_mahasiswa_dokumen extends MY_Model {
	
	function __construct()
	{
		parent::__construct('mahasiswa_dokumen',array('no_ijazah','id_layanan'));		
	}
		
} 