<?php

class MY_Model extends CI_Model{ 

	// will hold the table name of the current instance
	var $tabel = "";
	var $pks = array();
	
	// this constructor will help us initialize our child classes
	public function __construct($tablename='', $pks=array())
	{
		$this->tabel = $tablename;
		$this->pks = $pks;
		parent::__construct();
	}
	
	function save($data){		
		if(is_array($data)) {
			$this->db->insert($this->tabel, $data);
			return $this->db->insert_id('');
		} else
			return FALSE;		
	}	
	
	function getRow($conditions=array(),$sorts=array())
	{
		$i=0;
		foreach($conditions as $column=>$value)
		{
			if(substr($column,0,6)=='wlike_')
				$this->db->like(substr($column,6),$value);
			else
				$this->db->where($column,$value);
			$i++;
		}
		if(!empty($sorts))
		{
			foreach($sorts as $column=>$type)
			{
				$this->db->order_by($column, in_array($type,array('asc','desc'))?$type:'asc'); 
			}
		}
		
		$query = $this->db->get($this->tabel);		
		return ($query->num_rows() > 0)?$query->row():FALSE;
	}
	
	function getRowByPks($ids)
	{
		$i=0;
		foreach($this->pks as $pk)
		{
			$this->db->where($pk,$ids[$i]);
			$i++;
		}
		$query = $this->db->get($this->tabel);		
		return ($query->num_rows() > 0)?$query->row():FALSE;
	}
	
	function deleteCondition($conditions)
	{
		foreach($conditions as $column=>$value)
		{
			$this->db->where($column,$value);
		}
		$this->db->delete($this->tabel); 
	}
	
	function delete($ids)
	{
		$i=0;
		foreach($this->pks as $pk)
		{
			$this->db->where($pk,$ids[$i]);
			$i++;
		}
		$this->db->delete($this->tabel); 
	}
	
	function getData($conditions=array(),$sorts=array(), $start=0, $limit=1215752191)
	{	
		if(!empty($conditions))
		{
			foreach($conditions as $column=>$value)
			{
				$this->db->where($column,$value);
			}
		}	
		if(!empty($sorts))
		{
			foreach($sorts as $column=>$type)
			{
				$this->db->order_by($column, in_array($type,array('asc','desc'))?$type:'asc'); 
			}
		}	
		$this->db->limit($limit, $start);
		return $this->db->get($this->tabel);
	}
	
	function update($ids, $data)
	{
		$i=0;
		foreach($this->pks as $pk)
		{
			$this->db->where($pk,$ids[$i]);
			$i++;
		}
		$this->db->update($this->tabel, $data); 
	}
	
	function updateCondition($conditions, $data)
	{
		foreach($conditions as $column=>$value)
		{
			$this->db->where($column,$value);
		}
		$this->db->update($this->tabel, $data); 
	}
		
	function countData($conditions=array()){
		if(!empty($conditions))
		{
			foreach($conditions as $column=>$value)
			{
				$this->db->where($column,$value);
			}
		}			
		$this->db->from($this->tabel);
		return $this->db->count_all_results();
	}
} 
?>