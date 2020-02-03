<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Layanan extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_layanan','layanan');
	}
	
	public function index()
	{
		$data['services'] = $this->layanan->getData(array('deleted'=>'0'),array('nama_layanan'=>'asc'));
		$this->show_view('adm/layanan',$data);
	}
	public function input()
	{
		$data['customJs'] = '
				$(\'#biaya\').keyup(function(event) {
			  if(event.which >= 37 && event.which <= 40){
			    event.defaultPrevented();
			  }

			  $(this).val(function(index, value) {
			    return value
			      .replace(/\D/g, "")
			      .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
			    ;
			  });
			});';
		$this->show_view('adm/layanan_input',$data);
	}
	public function edit($id_layanan)
	{
		$data['customJs'] = '
				$(\'#biaya\').keyup(function(event) {
			  if(event.which >= 37 && event.which <= 40){
			    event.defaultPrevented();
			  }

			  $(this).val(function(index, value) {
			    return value
			      .replace(/\D/g, "")
			      .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
			    ;
			  });
			});';
		$data['layanan'] = $this->layanan->getRowByPks(array($id_layanan));
		$this->show_view('adm/layanan_edit',$data);
	}
	public function save()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama layanan', 'trim|required');
		$this->form_validation->set_rules('desc', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('biaya', 'Biaya', 'trim|required|greater_than[0]');
		$this->form_validation->set_rules('min', 'Jumlah pengajuan minimum', 'required');
		$this->form_validation->set_rules('max', 'Jumlah pengajuan maksimum', 'required|greater_than[0]');
		
		$this->form_validation->set_message('required', '%s wajib diisi');
		$this->form_validation->set_message('greater_than', '%s harus lebih dari 0');
		$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->input();
		}
		else
		{
			$data['nama_layanan'] 	= $this->input->post('nama');
			$data['deskripsi']		= $this->input->post('desc');
			$data['biaya'] 			= str_replace('.','',$this->input->post('biaya'));
			$data['min_qty']		= $this->input->post('min');
			$data['max_qty']		= $this->input->post('max');
			$data['aktif'] 			= '1';
			$data['deleted'] 		= '0';
			$this->layanan->save($data);
			redirect('adm/layanan/index','refresh');
		}
	}
	
	public function update()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama layanan', 'trim|required');
		$this->form_validation->set_rules('desc', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('biaya', 'Biaya', 'trim|required|greater_than[0]');
		$this->form_validation->set_rules('min', 'Jumlah pengajuan minimum', 'required');
		$this->form_validation->set_rules('max', 'Jumlah pengajuan maksimum', 'required|greater_than[0]');
		
		$this->form_validation->set_message('required', '%s wajib diisi');
		$this->form_validation->set_message('greater_than', '%s harus lebih dari 0');
		$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}
		else
		{
			$data['nama_layanan'] 	= $this->input->post('nama');
			$data['deskripsi']		= $this->input->post('desc');
			$data['biaya'] 			= str_replace('.','',$this->input->post('biaya'));
			$data['min_qty']		= $this->input->post('min');
			$data['max_qty']		= $this->input->post('max');
			$this->layanan->update(array($this->input->post('id')),$data);
			redirect('adm/layanan/index','refresh');
		}
	}
	
	public function delete($id_layanan)
	{
		
		$layanan = $this->layanan->getRowByPks(array($id_layanan));
		if($layanan)
		{echo 
			'<div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Konfirmasi hapus layanan</h4>
			      </div>
			      <div class="modal-body">
				  Anda akan menghapus layanan: <strong>'.$layanan->nama_layanan.'</strong>
			      </div>
			      <div class="modal-footer">
			        <a class="btn btn-default" data-dismiss="modal">tutup</a>
			        <a class="btn btn-danger" href="'.base_url('adm/layanan/delete_layanan/'.$layanan->id_layanan).'">Hapus layanan</a>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->';
		}
	}
	
	public function delete_layanan($id_layanan)
	{
		$this->layanan->updateCondition(array('id_layanan'=>$id_layanan,'deleted'=>'0'),array('deleted'=>'1'));
		$this->session->set_flashdata('sukses_delete', '1');
		redirect('adm/layanan/index','refresh');
	}
	public function non_aktif($id_layanan)
	{
		$this->layanan->updateCondition(array('id_layanan'=>$id_layanan,'aktif'=>'1'),array('aktif'=>'0'));
		$this->session->set_flashdata('sukses_non_aktif', '1');
		redirect('adm/layanan/index','refresh');
	}
	public function aktif($id_layanan)
	{
		$this->layanan->updateCondition(array('id_layanan'=>$id_layanan,'aktif'=>'0'),array('aktif'=>'1'));
		$this->session->set_flashdata('sukses_aktif', '1');
		redirect('adm/layanan/index','refresh');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */