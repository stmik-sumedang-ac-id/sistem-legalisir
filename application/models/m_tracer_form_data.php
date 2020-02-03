<?php
class m_tracer_form_data extends MY_Model {
	
	function __construct()
	{
		parent::__construct('tracer_form_data',array('id_form','nim'));
	}
	function getDistinctPertanyaan()
	{
		return $this->db->query("SELECT * FROM tracer_form_data GROUP BY id_form");
	}
	function getDataOf($idform)
	{
		return $this->db->query("SELECT `data`,count(1) AS jml FROM tracer_form_data WHERE id_form='".$idform."' GROUP BY data ORDER BY seq ASC");
	}
	
} 