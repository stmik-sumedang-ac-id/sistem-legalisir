<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tracer_study_desain extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_tracer_form','form');
		$this->load->model('m_tracer_form_options','options');
	}
	public function delete_elemen_form($idform)
	{		
		$this->form->update(array($idform),array('deleted'=>'1'));
		$questions = $this->form->getData(array('deleted'=>'0'),array('seq'=>'asc'));
		$i=1;
		foreach($questions->result() as $q)
		{
			$this->form->update(array($q->id_form),array('seq'=>$i));
			$i++;
		}
		redirect($this->uri->segment(1).'/'.$this->router->fetch_class(), 'refresh');
	}
	
	public function index()
	{
		$data['form'] = $this->form->getData(array('deleted'=>'0','deleted'=>'0'),array('seq'=>'asc'));
		$options	= $this->options->getData(array('deleted'=>'0'),array('seq'=>'asc'));
		$temp = array();
		$option = array();
		foreach($options->result() as $opt)
		{
			$temp = array();
			$temp['label']=$opt->label;
			$temp['value']=$opt->value;
			$temp['seq']=$opt->seq;
			$temp['selected_value']=$opt->selected_value;
			$temp['id']=$opt->id_option;
			$option[$opt->id_form][] = $temp;
		}
		$data['options'] = $option;
		$this->show_view($this->uri->segment(1).'/'.$this->router->fetch_class(),$data);
	}
	
	public function preview()
	{
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
		$this->show_view($this->uri->segment(1).'/'.$this->router->fetch_class().'_preview',$data);
	}
	
	public function input()
	{
		$this->show_view('adm/tracer_study_desain_input');
	}
	
	public function edit($idform)
	{
		$data['q'] = $this->form->getRowByPks(array($idform));
		$this->show_view('adm/tracer_study_desain_edit',$data);
	}
	
	public function save()
	{
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('newlabel', 'Label', 'required');
		$this->form_validation->set_rules('newtipe', 'Tipe isian', 'required');
		$this->form_validation->set_rules('instruksi', 'Instruksi', 'trim');
		
		$this->form_validation->set_message('required', '%s wajib diisi');
		$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
		
		if ($this->form_validation->run() == TRUE)
		{ 
			$data['seq'] 		= $this->form->getNewSequence();
			$data['label'] 		= $this->input->post('newlabel');
			$data['tipedata'] 	= $this->input->post('newtipe');
			$data['mandatory'] 	= $this->input->post('wajib')=='1'?'1':'0';
			$data['aktif']		= $this->input->post('aktif')=='1'?'1':'0';
			$data['instruksi']	= $this->input->post('instruksi');
			$this->form->save($data);			
			redirect($this->uri->segment(1).'/'.$this->router->fetch_class(), 'refresh');		
		}
		else $this->index();
		
	}
	
	public function update()
	{
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('newlabel', 'Label', 'required');
		$this->form_validation->set_rules('newtipe', 'Tipe isian', 'required');
		$this->form_validation->set_rules('instruksi', 'Instruksi', 'trim');
		$this->form_validation->set_rules('idform', 'Form', 'required');
		
		$this->form_validation->set_message('required', '%s wajib diisi');
		$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
		
		if ($this->form_validation->run() == TRUE)
		{ 
			$data['seq'] 		= $this->form->getNewSequence();
			$data['label'] 		= $this->input->post('newlabel');
			$data['tipedata'] 	= $this->input->post('newtipe');
			$data['mandatory'] 	= $this->input->post('wajib')=='1'?'1':'0';
			$data['aktif']		= $this->input->post('aktif')=='1'?'1':'0';
			$data['instruksi']	= $this->input->post('instruksi');
			$this->form->update(array($this->input->post('idform')),$data);			
			redirect($this->uri->segment(1).'/'.$this->router->fetch_class(), 'refresh');		
		}
		else $this->index();
		
	}
	
	public function down($idform)
	{	
		$this->form->down($idform);
		redirect($this->uri->segment(1).'/'.$this->router->fetch_class(), 'refresh');		
	}
	public function up($idform)
	{	
		$this->form->up($idform);
		redirect($this->uri->segment(1).'/'.$this->router->fetch_class(), 'refresh');		
	}
	public function option_down($idoption)
	{	
		$this->options->down($idoption);
		redirect($this->uri->segment(1).'/'.$this->router->fetch_class(), 'refresh');		
	}
	public function option_up($idoption)
	{	
		$this->options->up($idoption);
		redirect($this->uri->segment(1).'/'.$this->router->fetch_class(), 'refresh');		
	}
	
	public function add_option($idform)
	{
			echo '<div class="modal-dialog">
					<form method="post" class="form-horizontal" action="'.base_url('adm/tracer_study_desain/save_option').'">
			        <div class="modal-content">
			            <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                 <h4 class="modal-title">Tambahkan pilihan</h4>
			            </div>
			            <div class="modal-body">							
							<div class="form-group">
								<label class="col-sm-3  control-label" for="opsi">Opsi: </label>
								<div class="col-sm-5">
									<input  type="text" name="opsi" id="opsi" class="form-control"/>
								</div>
								<input type="hidden" value="'.$idform.'" name="idform"/>
							</div>
						</div>
			            <div class="modal-footer">
					        <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
							<button type="submit" class="btn btn-primary">Simpan opsi</button>
						</div>
			        </div>
					</form>
			    </div>';
	}
	public function save_option()
	{		
		$data['label'] = $this->input->post('opsi');
		$data['value'] = $this->input->post('opsi');
		$data['seq'] = $this->options->getNewSequence($this->input->post('idform'));
		$data['id_form'] = $this->input->post('idform');
		$this->options->save($data);
		redirect($this->uri->segment(1).'/'.$this->router->fetch_class(), 'refresh');
	}
	public function toggle_selected($idoption)
	{
		$detail_o = $this->options->getRowByPks(array($idoption));
		$detail_f = $this->form->getRowByPks(array($detail_o->id_form));
		if($detail_f->tipedata=='radio'||$detail_f->tipedata=='combo')
		{
			$this->options->updateCondition(array('id_form'=>$detail_o->id_form),array('selected_value'=>'0'));
		}
		$this->options->update(array($idoption),array('selected_value'=>!$detail_o->selected_value));
		redirect($this->uri->segment(1).'/'.$this->router->fetch_class(), 'refresh');
	}
	public function edit_option($idoption)
	{
		$detail = $this->options->getRowByPks(array($idoption));
		echo '
			<form method="post" class="form-horizontal" action="'.base_url('adm/tracer_study_desain/update_option').'">
			<div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                 <h4 class="modal-title">Ubah opsi</h4>
		            </div>
		            <div class="modal-body">
						<div class="form-group">
							<label class="col-sm-3  control-label" for="opsi">Opsi: </label>
							<div class="col-sm-5">
								<input  type="text" name="opsi" id="opsi" value="'.$detail->label.'" class="form-control"/>
							</div>
							<input  type="hidden" value="'.$idoption.'" name="idoption"/>
						</div>						
					</div>
		            <div class="modal-footer">
				        <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
						<button type="submit" class="btn btn-primary">Update opsi</button>
					</div>
		        </div>
		    </div>
			</form>';
	}
	public function update_option()
	{		
		$data['label']=$this->input->post('opsi');
		$data['value']=$this->input->post('opsi');
		$this->options->update(array($this->input->post('idoption')),$data);
		redirect($this->uri->segment(1).'/'.$this->router->fetch_class(), 'refresh');
	}
	public function delete_option($idoption)
	{
		$this->options->updateCondition(array('id_option'=>$idoption),array('deleted'=>'1'));
		redirect($this->uri->segment(1).'/'.$this->router->fetch_class(), 'refresh');
	}
	
	public function del_element_confirm($idform)
	{	
		$detail = $this->form->getRowByPks(array($idform));
		echo '<div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                 <h4 class="modal-title">Konfirmasi hapus pertanyaan</h4>
		            </div>
		            <div class="modal-body">
						Anda akan menghapus elemen: <br />'.$detail->label.'</strong><br />
						Tipe: '.$detail->tipedata.'<br />
						Petunjuk pengisian: '.$detail->instruksi.'			
					</div>
		            <div class="modal-footer">
				        <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
						<button class="btn btn-danger" onclick="window.location=\''.base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/delete_elemen_form/'.$idform).'\'">Hapus</button>
					</div>
		        </div>
		    </div>';
	}
	public function del_option_confirm($idoption)
	{	
		$detail = $this->options->getRowByPks(array($idoption));
		echo '<div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                 <h4 class="modal-title">Hapus opsi</h4>
		            </div>
		            <div class="modal-body">
						Anda akan menghapus opsi: <br />'.$detail->label.'</strong>						
					</div>
		            <div class="modal-footer">
				        <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
						<button class="btn btn-danger" onclick="window.location=\''.base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/delete_option/'.$idoption).'\'">Hapus</button>
					</div>
		        </div>
		    </div>';
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */