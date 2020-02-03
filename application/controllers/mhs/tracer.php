<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tracer extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_tracer_form','form');
		$this->load->model('m_tracer_form_data','form_data');
		$this->load->model('m_tracer_form_options','options');
	}
	
	public function preview()
	{
		$data['forms'] = $this->form->getData(array('deleted'=>'0','aktif'=>'1'),array('seq'=>'asc'));
		$options	= $this->options->getData(array('deleted'=>'0'),array('seq'=>'asc','id_option'=>'asc'));
		$temp = array();
		$option = array();
		foreach($options->result() as $opt)
		{			
			$option[$opt->id_option]=$opt->value;
		}
		$data['options'] = $option;
		$data['post'] = $this->session->flashdata('data');
		$this->session->keep_flashdata('data');
		$this->show_view($this->uri->segment(1).'/'.$this->router->fetch_class().'_'.$this->router->fetch_method(),$data);
	}
	public function preview_exist($existing_tracer)
	{
		$data['forms'] = $existing_tracer;
		$this->show_view($this->uri->segment(1).'/'.$this->router->fetch_class().'_preview_exists',$data);
	}
	public function submit()
	{
		$datanya = $this->session->flashdata('data');
		if(is_array($datanya)&& !empty($datanya))
		{
			foreach($datanya as $id_form => $data){
				$detail_form = $this->form->getRowByPks(array($id_form));
				if(in_array($detail_form->tipedata,array('radio','check','combo')))
				{
					$detail_option = $this->options->getRowByPks(array($data));
					$save_data = $detail_option->value;
				}else 
					$save_data = $data;
					
				$this->form_data->save(
						array(
							'id_form'=>$id_form,
							'no_ijazah'=>$this->session->userdata('logged_as')['no_ijazah'],
							'jurusan'=>$this->session->userdata('logged_as')['prodi'],
							'seq'=>$detail_form->seq,
							'label'=>$detail_form->label,
							'data'=>$save_data,
							'created_at'=>date("Y-m-d- H:i:s")
							)
						);
			}//end foreach
			$this->session->set_flashdata('sukses_tracer', 1);
		}
		redirect($this->uri->segment(1).'/dashboard','refresh');
	}
	
	public function index()
	{
		$cek = $this->form_data->getData(array('no_ijazah'=>$this->session->userdata('logged_as')['no_ijazah']));
		if($cek->num_rows()>0)
		{
			$this->preview_exist($cek);			
		}else{
			$data['forms'] = $this->form->getData(array('deleted'=>'0','aktif'=>'1'),array('seq'=>'asc'));
			$options	= $this->options->getData(array('deleted'=>'0'),array('seq'=>'asc'));
			$temp = array();
			$option = array();
			foreach($options->result() as $opt)
			{			
				$temp = array();
				$temp['label']=$opt->label;
				$temp['value']=$opt->value;
				$temp['selected_value']=$opt->selected_value;
				$temp['id']=$opt->id_option;
				$option[$opt->id_form][] = $temp;
			}
			$data['options'] = $option;
			
			if($_POST)
			{
				$this->load->library('form_validation');
				$this->form_validation->set_message('required', '%s wajib diisi');
				$this->form_validation->set_message('is_unique', '%s sudah digunakan');
				$this->form_validation->set_message('valid_email', 'Alamat email tidak valid');
				$this->form_validation->set_message('matches', 'Password dan konfirmasinya harus sama');
				$this->form_validation->set_message('less_than', '%s harus kurang dari tahun %d');
				$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
				
				$rules = array();
				$rules[] = 'trim';
				foreach($data['forms']->result() as $element)
				{
					$rules = array();
					$rules[] = 'trim';			
					if($element->mandatory=='1') $rules[] = 'required';
					if($element->tipedata=='email') $rules[] = 'valid_email';
					$this->form_validation->set_rules('elemen['.$element->id_form.']', $element->label, implode('|',$rules));
				}
				
				if ($this->form_validation->run() == FALSE)
				{
					//redirect($this->uri->segment(1).'/'.$this->router->fetch_class().'/index','refresh');
					$this->show_view($this->uri->segment(1).'/'.$this->router->fetch_class(),$data);
				}
				else 
				{
					$this->session->set_flashdata('data', $_POST['elemen']);
					redirect($this->uri->segment(1).'/'.$this->router->fetch_class().'/preview', 'refresh');
				}
					
			}else 
				$this->show_view($this->uri->segment(1).'/'.$this->router->fetch_class(),$data);
		}
		}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */