<?php
class m_users extends MY_Model {
	
	function __construct()
	{
		parent::__construct('users',array('username'));		
	}
	
} 