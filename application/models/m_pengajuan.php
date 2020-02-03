<?php
class m_pengajuan extends MY_Model {
	
	function __construct()
	{
		parent::__construct('pengajuan',array('id_pengajuan'));
	}


	function bukti(){
		$config['upload_path']		= './uploads/bukti_transfer/';
		$config['allowed_types']	= 'jpg|png|pdf|jpeg';
		$config['max_size']			= 5024;

		$this->load->library('upload',$config);
		if ($this->upload->do_upload('bukti_transfer')) {
			$return =  array('result'=>'success','file'=>$this->upload->data(),'error'=>'');
			return $return;
		}
	}

	function simpan_bukti($id,$data){
		$this->db->where('id_pengajuan',$id);
		return $this->db->update('pengajuan',$data);
	}
} 