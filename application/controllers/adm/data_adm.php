<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_adm extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_users','users');
	}
	
	
	public function activate_user($username)
	{
		$this->users->updateCondition(array('username'=>$username,'aktif'=>'0'),array('aktif'=>'1'));
		$this->session->set_flashdata('sukses_aktif', '1');
		redirect('adm/data_adm/index','refresh');
	}
	public function deactivate_user($username)
	{
		$this->users->updateCondition(array('username'=>$username,'aktif'=>'1'),array('aktif'=>'0'));
		$this->session->set_flashdata('sukses_nonaktif', '1');
		redirect('adm/data_adm/index','refresh');
	}
	public function delete_user($username)
	{
		$this->users->updateCondition(array('username'=>$username,'deleted'=>'0'),array('deleted'=>'1'));
		$this->session->set_flashdata('sukses_delete', '1');
		redirect('adm/data_adm/index','refresh');
	}
	
	public function deaktif($username)
	{
		
		$user = $this->users->getRowByPks(array($username));
		if($user)
		{echo 
			'<div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Konfirmasi non-aktifkan user</h4>
			      </div>
			      <div class="modal-body">
				  Anda akan non-aktifkan user: <strong>'.$user->username.'</strong>
			      </div>
			      <div class="modal-footer">
			        <a class="btn btn-default" data-dismiss="modal">tutup</a>
			        <a class="btn btn-warning" href="'.base_url('adm/data_adm/deactivate_user/'.$user->username).'">Non-aktifkan user</a>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->';
		}
	}
	public function aktif($username)
	{
		
		$user = $this->users->getRowByPks(array($username));
		if($user)
		{echo 
			'<div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Konfirmasi aktifkan user</h4>
			      </div>
			      <div class="modal-body">
				  Anda akan mengaktifkan user: <strong>'.$user->username.'</strong>
			      </div>
			      <div class="modal-footer">
			        <a class="btn btn-default" data-dismiss="modal">tutup</a>
			        <a class="btn btn-success" href="'.base_url('adm/data_adm/activate_user/'.$user->username).'">Aktifkan user</a>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->';
		}
	}
	public function delete($username)
	{
		
		$user = $this->users->getRowByPks(array($username));
		if($user)
		{echo 
			'<div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Konfirmasi hapus user</h4>
			      </div>
			      <div class="modal-body">
				  Anda akan menghapus user: <strong>'.$user->username.'</strong>
			      </div>
			      <div class="modal-footer">
			        <a class="btn btn-default" data-dismiss="modal">tutup</a>
			        <a class="btn btn-danger" href="'.base_url('adm/data_adm/delete_user/'.$user->username).'">Hapus user</a>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->';
		}
	}
	public function index()
	{
		$data['users'] = $this->users->getData(array('deleted'=>'0'));		
		$data['customCssSource'] = array('table_jui.css','smoothness/jquery-ui-1.8.4.custom.css');
		$data['customJsSource'] = array('jquery.js');
		$data['customJsSource'] = array('jquery.dataTables.js');
		$data['customJs'] = '$(document).ready(function() {
				oTable = $(\'#data\').dataTable({
					"sPaginationType": "full_numbers",					
					"aaSorting": [[ 1, "asc" ],[ 7, "asc" ],],
					"bStateSave": true,
					"oLanguage": {
            			"sUrl": "'.base_url('js/id_ID.txt').'"
					},
					aoColumnDefs: [{
					     bSortable: false,
					     aTargets: [ 0,-1 ]
					  }]                    
				});				
				
			} );';
		
		$this->show_view('adm/data_adm',$data);
	}
	
	public function input()
	{
		$data=array();
		$this->show_view('adm/data_adm_input');
	}
	
	public function submit()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]');
		$this->form_validation->set_rules('pass', 'Password', 'required');
		$this->form_validation->set_rules('pass2', 'Konfirmasi password', 'required|matches[pass]');
		
		$this->form_validation->set_message('required', '%s wajib diisi');
		$this->form_validation->set_message('is_unique', 'Username sudah digunakan');
		$this->form_validation->set_message('matches', 'Password dan konfirmasinya harus sama');
		$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
		if ($this->form_validation->run() == FALSE)
		{
			$this->input();
		}
		else
		{
			$data['username'] 	= $this->input->post('username');
			$data['password']	= md5($this->input->post('pass'));
			$data['role'] 		= $this->input->post('tipe');
			$data['aktif'] 		= '1';
			$data['created_at'] = date("Y-m-d H:i:s");
			$this->users->save($data);
			$this->session->set_flashdata('sukses', '1');
			redirect('adm/data_adm/index','refresh');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */