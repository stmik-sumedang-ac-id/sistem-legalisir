<?php
class m_pembayaran extends MY_Model {
	
	function __construct()
	{
		parent::__construct('pembayaran',array('id_bayar'));
	}

	
} 