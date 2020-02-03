<?php
class m_mahasiswa extends MY_Model {
	
	function __construct()
	{
		parent::__construct('mahasiswa',array('no_ijazah'));
		//$this->publikasi = $this->load->database('publikasi', true);
	}
	
	function getReportBulan($bulan,$tahun)
	{
		return $this->db->query("SELECT 
			(SELECT count(1) FROM mahasiswa WHERE status_verifikasi='0' AND MONTH(created_at)={$bulan} AND YEAR(created_at)={$tahun}) unver,
			(SELECT count(1) FROM mahasiswa WHERE status_verifikasi='1' AND MONTH(created_at)={$bulan} AND YEAR(created_at)={$tahun}) ver")->row();
	}
	function getLaporan($status, $view, $tahun)
	{
		$sql = '';
		switch($status){
			case 'ver': $sql .= " AND status_verifikasi = '0'";
				break;
			case 'unver': $sql .= " AND status_verifikasi = '1'";
				break;
			case 'verall':
			default:
				break;
		}
		return $this->db->query('SELECT count(1) jml,MONTH(created_at) bln FROM `mahasiswa` WHERE 1 '.$sql.' GROUP BY MONTH(created_at)'); 
		
	}

	function uploadIjazah(){
		$config['upload_path']		= './uploads/ijazah/';
		$config['allowed_types']	= 'jpg|png|pdf';
		$config['max_size']			= 5024;

		$this->load->library('upload',$config);
		if ($this->upload->do_upload('berkas')) {
			$return =  array('result'=>'success','file'=>$this->upload->data(),'error'=>'');
			return $return;
		}
	}
	
}