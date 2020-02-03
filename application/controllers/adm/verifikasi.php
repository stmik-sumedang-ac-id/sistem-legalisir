<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verifikasi extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_pos','pos');
		$this->load->model('m_mahasiswa','mahasiswa');
		$this->load->model('m_publikasi','publikasi');
		$this->load->model('m_mahasiswa_dokumen','mahasiswa_dokumen');
		$this->load->model('m_layanan','layanan');
		$this->load->model('m_pengajuan','pengajuan');
		$this->load->model('m_ongkir');
	}
	
	public function submit($nim='')
	{
		if($nim<>'')
		{
			$data = array();
			$data['status_verifikasi']='1';
			$data['waktu_verifikasi']=date('Y-m-d H:i:s');
			$data['user_verifikasi']=$this->session->userdata('logged_as')['username'];
			$this->mahasiswa->updateCondition(array('nim'=>$nim),$data);	
		}elseif(is_array($this->input->post('mhs'))){
			foreach($this->input->post('mhs') as $nim)
			{
				$data = array();
				$data['status_verifikasi']='1';
				$data['waktu_verifikasi']=date('Y-m-d H:i:s');
				$data['user_verifikasi']=$this->session->userdata('logged_as')['username'];
				$this->mahasiswa->updateCondition(array('nim'=>$nim),$data);	
			}
		}
		redirect($this->uri->segment(1).'/'.$this->router->fetch_class().'/index','refresh');
		
	}
	public function disapprove($nim='')
	{
		if($nim<>'')
		{
			$this->mahasiswa->updateCondition(array('nim'=>$nim),array('status_verifikasi'=>'0'));	
		}
		redirect($this->uri->segment(1).'/'.$this->router->fetch_class().'/index','refresh');
		
	}
	
	public function upload_doc()
	{
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$config['file_name'] = $this->input->post('layanan');		
		$config['overwrite'] = TRUE;
		
		$dir = './uploads/'.str_replace('/','-',$this->input->post('ijazah'));
		if(!is_dir($dir)) mkdir($dir,0775,TRUE);
		
		$config['upload_path'] = $dir;
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload('filenya'))
		{
			$error = array('error' => $this->upload->display_errors());
			redirect($this->uri->segment(1).'/'.$this->router->fetch_class().'/upload/'.$this->input->post('ijazah'),'refresh');
		}
		else
		{
			
			$upload_data = $this->upload->data();
			$data['no_ijazah'] 	= $this->input->post('ijazah');
			$data['id_layanan']	= $this->input->post('layanan');
			$data['ukuran'] 	= $upload_data['file_size'];
			$data['ext'] 		= $upload_data['file_ext'];
			$data['created_at']	= date("Y-m-d H:i:s");
			$cek = $this->mahasiswa_dokumen->getRowByPks(array($data['no_ijazah'],$data['id_layanan']));
			if(isset($cek->created_at))
				$this->mahasiswa_dokumen->update(array($data['no_ijazah'],$data['id_layanan']),$data);
			else
				$this->mahasiswa_dokumen->save($data);
				
			redirect($this->uri->segment(1).'/'.$this->router->fetch_class().'/upload/'.$this->input->post('ijazah'),'refresh');
			
		}
	}
	
	public function download($layanan){
		$noijazah= substr($this->uri->uri_string(),strlen($this->uri->segment(1).'/'.$this->router->fetch_class().'/download/'.$layanan.'/'),40);
		$detail_layanan = $this->layanan->getRowByPks(array($layanan));
		$detail_dok = $this->mahasiswa_dokumen->getRowByPks(array($noijazah,$layanan));
		$nama_file = str_replace(' ','-',$detail_layanan->nama_layanan).$detail_dok->ext;
		$this->load->helper('download');		
		$dir = './uploads/'.str_replace('/','-',$noijazah).'/';
		$data = file_get_contents($dir.$layanan.$detail_dok->ext); // Read the file's contents
		force_download($nama_file, $data); 
		redirect($this->uri->segment(1).'/'.$this->router->fetch_class().'/upload/'.$noijazah,'refresh');
	}
	
	public function upload()
	{
		$noijazah= substr($this->uri->uri_string(),22,40);
		$mhs = $this->mahasiswa->getRowByPks(array($noijazah));
		$pos = $this->pos->getRowByPks(array($noijazah));
		$bayar = $this->pengajuan->getData(array('nim'=>$mhs->nim))->result();

		if(!$mhs)
		{
			redirect($this->uri->segment(1).'/'.$this->router->fetch_class().'/index','refresh');
		}else
		{
			$data['bayar'] = $bayar;
			$data['pos'] = $pos;
			$data['mhs'] = $mhs;
			$data['layanan'] = $this->layanan->getData(array('deleted'=>'0'))->result();
			$res = $this->mahasiswa_dokumen->getData(array('no_ijazah'=>$noijazah));
			$up = array();
			foreach($res->result() as $doc){
				$up[] = $doc->id_layanan;
			}			
			$data['uploaded'] = $up;			
			$this->show_view($this->uri->segment(1).'/'.$this->router->fetch_class().'_upload',$data);
		}		
	}
	
	public function input_save()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('ijazah', 'Nomor ijazah', 'trim|required|is_unique[mahasiswa.no_ijazah]');
		$this->form_validation->set_rules('nim', 'NIM', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('prodi', 'Program studi', 'required');
		
		$this->form_validation->set_message('required', '%s wajib diisi');
		$this->form_validation->set_message('is_unique', '%s sudah digunakan');
		$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
		
		if ($this->form_validation->run() == FALSE)
		{			
			$this->input();
		}
		else
		{
			$data['no_ijazah'] 			= $this->input->post('ijazah');
			$data['nim'] 				= $this->input->post('nim');
			$data['nama'] 				= $this->input->post('nama');
			$data['password']			= md5($this->input->post('pass')?$this->input->post('pass'):$this->input->post('nim'));
			$data['prodi'] 				= $this->input->post('prodi');
			$data['created_at'] 		= date("Y-m-d H:i:s");
			$data['status_verifikasi'] 	= '1';
			$this->mahasiswa->save($data);
			$this->session->set_flashdata('success', 'Data mahasiswa berhasil diinput');
			
			
			if($this->input->post('inputLagi')==1)
				redirect($this->uri->segment(1).'/'.$this->router->fetch_class().'/index','refresh');
			else
				redirect($this->uri->segment(1).'/'.$this->router->fetch_class().'/input','refresh');
		}
		
	}
	
	public function input()
	{
		$q = $this->publikasi->getData(array('deleted'=>'0'),array('seq'=>'asc'));
		$data['jurusan'] = $q;
		$data['customJs'] = "$('#inputLagiBtn').click(function() {
							    $('#inputLagi').val(1);
							    $('#form1').submit();
							})";
		$this->show_view($this->uri->segment(1).'/'.$this->router->fetch_class().'_input',$data);
	}
	
	public function index()
	{
		$data['mhs'] = $this->mahasiswa->getData();		
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
				
			} );
			 $(\'#check\').on(\'click\', function () {
		        var IsChecked = !! $(\'.cek:checked\').length;
		        if(!IsChecked){ alert(\'Silahkan pilih user yang akan diverifikasi\');return false;};
		    });
			
			$(\'#cekall\').click(function () {
			    $(\'.cek\').prop(\'checked\', this.checked);
				$(\'.cek\').closest(\'tr\').toggleClass("highlight", this.checked);
			});

			$(\'.cek\').change(function () {
			    var check = ($(\'.cek\').filter(":checked").length == $(\'.cek\').length);
			    $(\'#cekall\').prop("checked", check);				
				$(this).closest("tr").toggleClass("highlight", this.checked);
			});';
		
		$this->show_view($this->uri->segment(1).'/'.$this->router->fetch_class(),$data);

	}

	public function addpos(){
		$data['no_ijazah']			= $this->input->post('no_ijazah');
		$data['id_pengajuan']		= $this->input->post('id_pengajuan');
		$data['nim']				= $this->input->post('nim');
		$data['nama']				= $this->input->post('nama');
		$data['provinsi_asal']		= $this->input->post('provinsi_asal');
		$data['kota_asal']			= $this->input->post('kota_asal');
		$data['provinsi_tujuan']	= $this->input->post('provinsi_tujuan');
		$data['kota_tujuan']		= $this->input->post('kota_tujuan');
		$data['berat']				= $this->input->post('berat');
		$data['kurir']				= $this->input->post('kurir');
		$data['service']			= $this->input->post('service');
		$data['alamat_lengkap']		= $this->input->post('alamat_lengkap');
		$data['tanggal']			= $this->input->post(now('Y-m-d H:i:s'));

		$this->pos->save($data);
		redirect($_SERVER['HTTP_REFERER']);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */