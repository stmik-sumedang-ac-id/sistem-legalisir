<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tracer_study_data_mhs extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_tracer_form','form');
		$this->load->model('m_tracer_form_data','form_data');
		$this->load->model('m_tracer_form_options','options');
	}
	
	public function filter()
	{
		$idForm = $this->input->post('f');
		$this->index($idForm);
	}
	public function index($idform='all')
	{
		if($idform=='all')
		{
			$data['mhs'] = $this->form_data->getData(array(),array('created_at'=>'desc','seq'=>'asc'));
		}else{
			$data['mhs'] = $this->form_data->getData(array('id_form'=>$idform),array('created_at'=>'desc','seq'=>'asc'));
		}
		$data['idform'] = $idform;		
		$data['pertanyaan'] = $this->form->getData(array('deleted'=>'0'),array('label'=>'asc'));
		$data['customCssSource'] = array('table_jui.css','smoothness/jquery-ui-1.8.4.custom.css');
		$data['customJsSource'] = array('jquery.js');
		$data['customJsSource'] = array('jquery.dataTables.js');
		$data['customJs'] = '$(document).ready(function() {
				oTable = $(\'#data\').dataTable({
					"sPaginationType": "full_numbers",					
					"aaSorting": [[0,"desc" ]],
					
					"oLanguage": {
            			"sUrl": "'.base_url('js/id_ID.txt').'"
					},
					aoColumnDefs: [{
					     bSortable: false,
					     aTargets: [ 2 ]
					  }]                    
				});				
				
			} );
			';		
		$this->show_view($this->uri->segment(1).'/'.$this->router->fetch_class(),$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */