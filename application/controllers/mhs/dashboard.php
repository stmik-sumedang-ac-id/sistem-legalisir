<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_pos','pos');
		$this->load->model('m_mahasiswa','mahasiswa');
		$this->load->model('m_pengajuan','pengajuan');
		$this->load->model('m_pengajuan_detail','pengajuan_detail');
		$this->load->model('m_mailer','mailer');
		
	}
	public function index()
	{
		//Custom query by yysofiyan https://www.codeigniter.com/user_guide/database/queries.html
		//menambakan fungsi escape sting 
		$this->db->escape('nim  = '. $this->session->userdata('logged_as')['nim']);
		$dataq =$this->db->get('mahasiswa')->result();
		
		if (!$dataq[0]->email) {
			$this->load->view('confirm_email');
		} else {
		//end 

		$data['pos'] = $this->pos->getData(array('nim'=>$this->session->userdata('logged_as')['nim']));
		
		$data['pengajuan'] = $this->pengajuan->getData(array('nim'=>$this->session->userdata('logged_as')['nim']),array('waktu_pengajuan'=>'desc'));
		foreach($data['pengajuan']->result() as $pengajuan)
		{
			$data['bukti'] = $this->pengajuan->getData(array('id_pengajuan'=>$pengajuan->id_pengajuan));
			$res = $this->pengajuan_detail->getData(array('id_pengajuan'=>$pengajuan->id_pengajuan));
			foreach($res->result() as $detail):				
				$data['detail'][$pengajuan->id_pengajuan][] = $detail;
			endforeach;

			//$oke = $this->pengajuan_kurir->getData(array)

		}

		

		$this->show_view('mhs/dashboard',$data);
		}
	}
	public function bukti_pembayaran() {
		$id = $this->input->post("aidi");
		if(!$id) {
			echo '<div style="font-family:Helvetica;font-size:250px;text-align:center;">YOU CANT SEE ME</h1>';
		} else {
			$this->db->where('pengajuan.id_pengajuan =' . $id);
			$this->db->join("mahasiswa", "pengajuan.nim = mahasiswa.nim");
			$this->db->join("pembayaran", "pengajuan.id_pengajuan = pembayaran.id_pengajuan");
			$data['data'] = $this->db->get('pengajuan')->result();
			$this->db->where('id_pengajuan =' . $id);
			$data['data_detail'] = $this->db->get('pengajuan_detail')->result();
			$this->load->view('inv',$data);
		}
	}

	public function bukti_permohonan() {
		$id = $this->input->post("aidi");
		if(!$id) {
			echo '<div style="font-family:Helvetica;font-size:250px;text-align:center;">YOU CANT SEE ME</h1>';
		} else {
			$this->db->where('pengajuan.id_pengajuan =' . $id);
			$this->db->join("mahasiswa", "pengajuan.nim = mahasiswa.nim");
			
			$data['data'] = $this->db->get('pengajuan')->result();
			$this->db->where('id_pengajuan =' . $id);
			$data['data_detail'] = $this->db->get('pengajuan_detail')->result();
			$this->load->view('inv',$data);
		}
	}


	public function okeoce() {
		$nim = $this->session->userdata('logged_as')['nim'];
		$data['email'] = $this->input->post("email");

		$this->db->where("nim = ".$nim);
		$this->db->update("mahasiswa",$data);
		redirect('mhs/dashboard','refresh');
	}

	public function submit_ambil($nim,$id_pengajuan){
		if ($nim<>'' && $id_pengajuan<>'') {
			$pengajuan = $this->pengajuan->getRowByPks(array($id_pengajuan));
			if (isset($pengajuan->id_pengajuan))
				$this->pengajuan->updateCondition(array('id_pengajuan'=>$pengajuan->id_pengajuan),array('status'=>'4','perubahan_status'=>date('Y-m-d H:i:s')));
		}
		redirect('mhs/dashboard/index','refresh');
	}

	public function upload_bukti(){
		$id = $this->uri->segment(4);
		$pengajuan = $this->pengajuan->getRowByPks(array($id));

		if (!empty($pengajuan->bukti_transfer)) {
			unlink('uploads/bukti_transfer/'.$pengajuan->bukti_transfer);
			$upload = $this->pengajuan->bukti();
			$data['bukti_transfer'] = $upload['file']['file_name'];;
			$this->pengajuan->simpan_bukti($id,$data);
		}elseif (empty($pengajuan->bukti_transfer)) {
			$upload = $this->pengajuan->bukti();
			$data['bukti_transfer'] = $upload['file']['file_name'];;
			$this->pengajuan->simpan_bukti($id,$data);
		}
		

		redirect('mhs/dashboard','refresh');
	}


	public function b_transfer($id){
		echo '<div class="modal-dialog">
				<form method="post" enctype="multipart/form-data" action="'.base_url().'mhs/dashboard/upload_bukti/'.$id.'">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Upload Bukti Transfer</h4>
						</div>
						<div class="modal-body">
						<div class="form-group">
								<label for="inputbukti">Bukti Transfer</label>
								<input type="file" name="bukti_transfer" class="form-control" required>
								<label>format : PNG/JPEG/JPG</label>
							</div>
						</div>
						<div class="modal-footer">
							<button class="btn btn-danger" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
					</form>
			</div>';
	}

	public function b_pengiriman($id){
		$pengajuan = $this->pengajuan->getData(array('nim'=>$this->session->userdata('logged_as')['nim']));
		$pos = $this->pos->getData(array('id_pengajuan'=>$id));
		foreach ($pengajuan->result() as $p);
		foreach($pos->result() as $rm){
		echo '
			<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Pengiriman Via Ekspedisi</h4>
			</div>
			<div class="modal-body">
            	<div class="panel-body" style="overflow-x: auto">
	            		<table class="table table-striped table-bordered table-responsive">
	            			<tr>
	            				<td>Dikirim Dari : Kampus STMIK Sumedang</td>
	            			</tr>
	            		</table>
	            		<br/>
	            		<table class="table table-striped table-bordered table-responsive">
	            			<tr>
	            				<td colspan="2">Penerima :</td>
	            			</tr>
	            			<tr>
	            				<td colspan="2">Nama : '.$rm->nama.'</td>
	            			</tr>
	            			<tr>
	            				<td colspan="2">Alamat : </td>
	            			</tr>
	            			<tr>
	            				<td colspan="2">'.$rm->alamat_lengkap.'</td>
	            			</tr>
	            			<tr>
	            				<td>Kurir : </td>
	            				<td>Layanan &amp; Ongkos Kirim : </td>
	            			</tr>
	            			<tr>
	            				<td>'.$rm->kurir.'</td>
	            				<td>'.$rm->service.'</td>
	            			</tr>
	            			<tr>
	            				<td colspan="2">*Ongkir dibayar oleh penerima</td>
	            			</tr>
	            		</table>';
	            		if ($p->status == '3') { 
	            			echo '<a href="'.base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/submit_ambil/'.$p->nim.'/'.$p->id_pengajuan).'" class="btn btn-warning">Sudah diambil</a>
	            				<p>*konfirmasi setelatnya 2 hari setelah dokumen diterima</p>';
	            		}else{
	            			echo '<span class="label label-success">Sudah Diambil</span>';
	            		}
	 echo '
				</div>
			</div>
		</div>
	</div>';
		}
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */