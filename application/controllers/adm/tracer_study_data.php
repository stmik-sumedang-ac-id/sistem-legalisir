<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tracer_study_data extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_tracer_form','form');
		$this->load->model('m_tracer_form_data','form_data');
		$this->load->model('m_tracer_form_options','options');
	}
	
	public function index()
	{
		
		$pertanyaan = $this->form_data->getDistinctPertanyaan();
		$d  = array();
		$jawaban = array();
		foreach($pertanyaan->result() as $q){
			$d[] = $q;
			$jwbs = $this->form_data->getDataof($q->id_form);
			
			foreach($jwbs->result() as $jwb){
				$jawaban[$q->id_form][] = $jwb;
			}			
		}
		
		//echo json_encode($jawaban);
		$data['pertanyaan'] = $d;
		$data['jawaban'] = $jawaban;
		$data['customCssSource'] = array('table_jui.css','smoothness/jquery-ui-1.8.4.custom.css');
		$data['customJsSource'] = array('jquery.js');
		$data['customJsSource'] = array('jquery.dataTables.js');
		$data['customJs'] = '$(document).ready(function() {
				oTable = $(\'#data\').dataTable({
					"sPaginationType": "full_numbers",					
					"aaSorting": [[0,"asc" ]],
					
					"oLanguage": {
            			"sUrl": "'.base_url('js/id_ID.txt').'"
					},
					aoColumnDefs: [{
					     bSortable: false,
					     aTargets: [ 1 ]
					  }]                    
				});				
				
			} );
			';		
		
		$this->show_view('adm/tracer_study_data',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */