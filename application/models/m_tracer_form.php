<?php
class m_tracer_form extends MY_Model {
	
	function __construct()
	{
		parent::__construct('tracer_form',array('id_form'));
	}
	
	public function getNewSequence()
	{
		$res = $this->db->query("SELECT MAX(`seq`) as max FROM tracer_form");
		$res2 = $res->row();
		return $res2->max+1;
	}	
	
	function up($id)
	{		
		$detail = $this->getRowByPks(array($id));
		
		if($detail->seq==1) return FALSE;
		$lists = $this->getData(array('deleted'=>'0'),array('seq'=>'asc'));
		
		$urutan_lama = $detail->seq;
		$urutan_baru = $detail->seq-1;
		$old_id = null;
		foreach($lists->result() as $item)
		{
			if($item->seq==$urutan_baru && $item->id_form<>$old_id){
				$data['seq'] = $urutan_lama;
				$old_id = $item->id_form;
				$this->updateCondition(array('id_form'=>$item->id_form),$data);
				continue;
			}
			if($item->seq==$urutan_lama && $item->id_form<>$old_id){
				$data['seq'] = $urutan_baru;
				$this->updateCondition(array('id_form'=>$item->id_form),$data);
				continue;
			}
		}
	}
	function down($id)
	{		
		$detail = $this->getRowByPks(array($id));
		$lists = $this->getData(array('deleted'=>'0'),array('seq'=>'asc'));
		if($detail->seq==$lists->num_rows()) return FALSE;
		
		$urutan_lama = $detail->seq;
		$urutan_baru = $detail->seq+1;
		foreach($lists->result() as $item)
		{
			if($item->seq==$urutan_baru){
				$data['seq'] = $urutan_lama;
				$this->update(array($item->id_form),$data);
				continue;
			}
			if($item->seq==$urutan_lama){
				$data['seq'] = $urutan_baru;
				$this->update(array($item->id_form),$data);
				continue;
			}
		}
	}
} 