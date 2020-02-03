<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registrasi extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_mahasiswa','mahasiswa');
		$this->load->model('m_publikasi','publikasi');
	}
	
	public function index()
	{	
		$q = $this->publikasi->getData(array('deleted'=>'0'),array('seq'=>'asc'));
		$data['jurusan'] = $q;
		$this->show_view('registrasi',$data);
	}	
	public function post()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('no_ijazah', 'Nomor ijazah', 'trim|required|is_unique[mahasiswa.no_ijazah]');
		$this->form_validation->set_rules('nim', 'NIM', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('pass', 'Password', 'required');
		$this->form_validation->set_rules('pass2', 'Konfirmasi password', 'required|matches[pass]');
		$this->form_validation->set_rules('ttl', 'Tanggal lahir', 'trim|required');
		$this->form_validation->set_rules('angkatan', 'Tahun masuk', 'required|less_than['.(date("Y")-3).']');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required|is_unique[mahasiswa.email]');
		$this->form_validation->set_rules('prodi', 'Program studi', 'required');
		$this->form_validation->set_rules('no_hp', 'No Telpon', 'trim|required');
		$this->form_validation->set_rules('alamat','Alamat', 'trim|required');
		$this->form_validation->set_rules('provinsi','Provinsi', 'required');
		$this->form_validation->set_rules('kota','Kota', 'required');

		$this->form_validation->set_message('required', '%s wajib diisi');
		$this->form_validation->set_message('is_unique', '%s sudah digunakan');
		$this->form_validation->set_message('valid_email', 'Alamat email tidak valid');
		$this->form_validation->set_message('matches', 'Password dan konfirmasinya harus sama');
		$this->form_validation->set_message('less_than', '%s harus kurang dari tahun %d');
		$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$upload = $this->mahasiswa->uploadIjazah();

			$data['no_ijazah'] 			= $this->input->post('no_ijazah');
			$data['nim'] 				= $this->input->post('nim');
			$data['nama'] 				= $this->input->post('nama');
			$data['password']			= md5($this->input->post('pass'));
			$data['email']				= $this->input->post('email');
			$data['ttl'] 				= $this->input->post('ttl');
			$data['angkatan'] 			= $this->input->post('angkatan');
			$data['email'] 				= $this->input->post('email');
			$data['prodi'] 				= $this->input->post('prodi');
			$data['no_hp']				= $this->input->post('no_hp');
			$data['provinsi']			= $this->input->post('provinsi');
			$data['kota']				= $this->input->post('kota');
			$data['alamat']				= $this->input->post('alamat');
			$data['file_ijazah']		= $upload['file']['file_name'];
			$data['created_at'] 		= date("Y-m-d H:i:s");
			$data['status_verifikasi'] 	= '0';
			$this->mahasiswa->save($data);
			$this->show_view('registrasi sukses');
		}
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */