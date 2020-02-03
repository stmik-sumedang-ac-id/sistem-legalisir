<?php
class m_pengajuan_detail extends MY_Model {
	
	function __construct()
	{
		parent::__construct('pengajuan_detail',array('id_pengajuan_detail'));
	}
	
	function getTotalTagihan($idPengajuan)
	{
		$res = $this->getData(array('id_pengajuan'=>$idPengajuan));
		$total = 0;
		foreach($res->result() as $i):
			$total += $i->jumlah*$i->biaya_satuan;
		endforeach;
		return $total;
	}
} 