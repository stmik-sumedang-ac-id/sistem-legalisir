<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authenticate extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_mahasiswa','mahasiswa');
		$this->load->model('m_users','users');
	}
	
	public function login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('u', 'Username', 'trim|required');
		$this->form_validation->set_rules('p', 'Password', 'trim|required');
		if ($this->form_validation->run()){		
			$User = $this->users->getRow(array('username'=>$this->input->post('u'),'password'=>md5($this->input->post('p'))));
			$Mhs = $this->mahasiswa->getRow(array('no_ijazah'=>$this->input->post('u'),'password'=>md5($this->input->post('p')),'status_verifikasi'=>'1'));
			
			if(isset($User->role) && ($User->role=='adm' || $User->role=='keu' || $User->role=='akd'))
			{
				$this->session->set_userdata('logged_as', get_object_vars($User));
				$this->users->update(array($User->username),array('last_login'=>date("Y-m-d H:i:s")));
				redirect('adm/pembayaran/index','refresh');				
			}elseif(isset($Mhs->nim) && $Mhs->nim<>''){
				$this->session->set_userdata('logged_as', get_object_vars($Mhs));
				$this->mahasiswa->updateCondition(array('no_ijazah'=>$Mhs->no_ijazah),array('last_login'=>date("Y-m-d H:i:s")));
				redirect('mhs/dashboard/index','refresh');
			}else{
				redirect('home','refresh');
			}
		}else{
			redirect('home','refresh');
		}
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('home','refresh');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */