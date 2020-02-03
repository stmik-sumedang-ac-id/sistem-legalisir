<?php

class MY_Controller extends CI_Controller{ 
	
	function __construct()
    {
        parent::__construct();
		//$this->output->enable_profiler(TRUE);			
		date_default_timezone_set('Asia/Jakarta'); 	
		if((($this->router->fetch_class()=='laporan_registrasi'||$this->router->fetch_class()=='laporan_pembayaran'||$this->router->fetch_class()=='laporan_pengambilan')&& ($this->router->fetch_method()=='getdata' || $this->router->fetch_method()=='getdata2') ))
		{
		}else{
			if (!$this->session->userdata('logged_as') &&  ($this->uri->segment(1)=='adm'||$this->uri->segment(1)=='mhs'))
			{
				redirect('home');
			}
		}		
		
    }
	
	function show_view($view_name, $data='') {			
		$this->load->view('html_header',$data); // display your header by giving it the menu
		$this->load->view('header',$data); // display your header by giving it the menu			
		$this->load->view($view_name, $data); // the actual view you wanna load
		$this->load->view('footer',$data); // footer, if you have one
		$this->load->view('html_footer'); // footer, if you have one
	}

} 
?>