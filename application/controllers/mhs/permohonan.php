<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permohonan extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_mahasiswa','mahasiswa');
		$this->load->model('m_pos','pos');
		$this->load->model('m_layanan','layanan');
		$this->load->model('m_pengajuan','pengajuan');
		$this->load->model('m_pengajuan_detail','pengajuan_detail');
		$this->load->model('m_mahasiswa_dokumen','mahasiswa_dokumen');
	}
	
	public function confirm()
	{		


		$layanan = $this->layanan->getLayanan();
		foreach($layanan->result() as $lay)
		{
			$layanans[$lay->id_layanan]['biaya']=$lay->biaya;
			$layanans[$lay->id_layanan]['nama']=$lay->nama_layanan;
		}
		$data['total']=0;
		foreach($_POST as $key=>$val)
		{	
			if (strpos($key, '_') == false){
				//echo '<script>alert("'.var_dump($val).'");</script>';
				$data['qtykirim'] = $this->input->post('qtkirim');
				$data['prcongkir'] = $this->input->post('prcongkir');
				$ongkir = str_replace('.', '', $data['prcongkir']);
			}elseif (strpos($key, '_') == true){
				
				$temp = explode('_',$key);
				$data['permohonan'][$temp[1]]['qty'] 	= $val;
				$data['permohonan'][$temp[1]]['biaya']	= $layanans[$temp[1]]['biaya'];
				$data['permohonan'][$temp[1]]['nama']	= $layanans[$temp[1]]['nama'];
				$data['permohonan'][$temp[1]]['total']= $val*$layanans[$temp[1]]['biaya'];
				$data['total']			+= $val*$layanans[$temp[1]]['biaya'];
			}
		}
		if($data['total']<=0 || empty($data['total'])) 
		{
			$this->session->set_flashdata('msg_warning', 'Silahkan isi permohonan');
			redirect('mhs/permohonan','refresh');
		}
		$this->session->set_flashdata('post', $_POST);
		$data['layanan'] = $layanan;
		$data['jumlah'] = $data['total'] + intval($ongkir);
		$this->show_view('mhs/permohonan_confirm',$data);
	}

	public function submit()
	{
		if($this->session->flashdata('post'))
		{
			$layanan = $this->layanan->getLayanan();
			foreach($layanan->result() as $lay)
			{
				$layanans[$lay->id_layanan]['biaya']=$lay->biaya;
				$layanans[$lay->id_layanan]['nama']=$lay->nama_layanan;
				$layanans[$lay->id_layanan]['desc']=$lay->deskripsi;
			}
			
			$dataPengajuan['nim'] 				=	$this->session->userdata('logged_as')['nim'];
			$dataPengajuan['nama'] 				=	$this->session->userdata('logged_as')['nama'];
			$dataPengajuan['prodi'] 			=	$this->session->userdata('logged_as')['prodi'];
			$dataPengajuan['waktu_pengajuan'] 	= 	date('Y-m-d H:i:s');
			$dataPengajuan['status']			= 	'1';
			$idPengajuan = $this->pengajuan->save($dataPengajuan);
			
			$post = $this->session->flashdata('post');
			$total = 0;
			$ongkir = 0;
			
			if (!empty($post['qtkirim'])) {
				$qtykirim = $post['qtkirim'];
				$prcongkir = $post['prcongkir'];
				$kurir = $post['kurir'];
				$service = $post['layananKurir'];
				$ongkir = str_replace('.', '', $prcongkir);

				$mhs = $this->mahasiswa->getData(array('no_ijazah'=>$this->session->userdata('logged_as')['no_ijazah']));

				foreach($mhs->result() as $mhs){
					$dataPos['id_pengajuan'] = $idPengajuan;
					$dataPos['no_ijazah'] = $this->session->userdata('logged_as')['no_ijazah'];
					$dataPos['nim'] = $this->session->userdata('logged_as')['nim'];
					$dataPos['nama'] = $this->session->userdata('logged_as')['nama'];
					$dataPos['provinsi_asal'] = 'Jawa Barat';
					$dataPos['kota_asal'] = 'Sumedang';
					$dataPos['provinsi_tujuan'] = $mhs->provinsi;
					$dataPos['kota_tujuan'] = $mhs->kota;
					$dataPos['berat'] = 1;
					$dataPos['kurir'] = $kurir;
					$dataPos['service'] = $service;
					$dataPos['ongkir'] = $ongkir;
					$dataPos['alamat_lengkap'] = $mhs->alamat;
					$dataPos['tanggal'] = date("Y-m-d h:i:s");
				}
				$this->pos->save($dataPos);
			
				$dataKurir = array(
					'id_pengajuan' => $idPengajuan,
					'id_layanan' => 0,
					'nama_layanan' => 'kirim via kurir',
					'deskripsi_layanan' => 'Mengirimkan hasil legalisir via kurir',
					'jumlah' => 1,
					'biaya_satuan' => $ongkir,
				);
					
				$this->pengajuan_detail->save($dataKurir);	
			}

			unset($post['qtkirim']);
			unset($post['kurir']);
			unset($post['service']);
			unset($post['layananKurir']);
			unset($post['prcongkir']);

			foreach($post as $key=>$val)
			{
				$detail=array();
				
					if($val==0) continue;
					$temp = explode('_',$key);
					$detail['id_pengajuan'] = $idPengajuan;
					$detail['id_layanan'] = $temp[1];
					$detail['nama_layanan'] = $layanans[$temp[1]]['nama'];
					$detail['deskripsi_layanan'] = $layanans[$temp[1]]['desc'];
					$detail['jumlah'] = $val;
					$detail['biaya_satuan'] = $layanans[$temp[1]]['biaya'];	
					$total = $total + ($val*$layanans[$temp[1]]['biaya']);
			
				$this->pengajuan_detail->save($detail);
			}
			$this->pengajuan->update(array($idPengajuan),array('total_tagihan'=>$total + intval($ongkir)));
			$this->session->set_flashdata('sukses_pengajuan', '1');			
		}		
		redirect('mhs/dashboard','refresh');
		
	}
	public function index()
	{
		$data['layanan'] = $this->layanan->getLayanan();
		$noijazah = $this->session->userdata('logged_as')['no_ijazah'];
		
		$data['mahasiswa'] = $this->mahasiswa->getData(array('no_ijazah'=>$noijazah))->result();

		
		$res = $this->mahasiswa_dokumen->getData(array('no_ijazah'=>$noijazah));
		$up = array();
		foreach($res->result() as $doc){
				$up[] = $doc->id_layanan;
			}			
		$data['uploaded'] = $up;			

		$data['customJs'] = '
			function numberWithCommas(x) {
			  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			}
			function removeComma(x) {
			  return x.toString().replace(".", "");
			}
			$(document).ready(function() {';
		foreach($data['layanan']->result() as $layanan)
		{
			if($layanan->max_qty==1):
				$data['customJs'] .= '					
					$(\'#qty_'.$layanan->id_layanan.'\').click(function() {
						if ($(\'#qty_'.$layanan->id_layanan.'\').is(\':checked\')) {
							$(\'#t_'.$layanan->id_layanan.'\').val(numberWithCommas('.$layanan->biaya.')); // show total;	  
						}else{
							$(\'#t_'.$layanan->id_layanan.'\').val(numberWithCommas(0)); // show total
						}            
            	});';
			else:
			$data['customJs'] .= '
					$(\'#qty_'.$layanan->id_layanan.'\').on(\'keyup\', function(e) {  
					
	                var quan = $("#qty_'.$layanan->id_layanan.'").val() != "" ? parseFloat($("#qty_'.$layanan->id_layanan.'").val()) : 1,  //  Get quantity value
	                    pric = '.$layanan->biaya.';
	                $(\'#t_'.$layanan->id_layanan.'\').val(numberWithCommas(pric*quan)); // show total
            	});';
			endif;
		}
		$data['customJs'] .= '
				$("input[name^=qty_]").keyup(function() {
					    var sum = 0;
						var ong_kir = parseInt(removeComma($("#ongkos").val()));    
					    $("input[name^=price_]").each(function() {
					        var number = parseInt(removeComma(this.value)) || 0;
					        sum += number;
					    });
					    $("#total").val(numberWithCommas(sum+ong_kir));
				});
				$("input[name^=qty_]").click(function() {
				    var sum = 0;
				    var ong_kir = parseInt(removeComma($("#ongkos").val()));
				    $("input[name^=price_]").each(function() {
				        var number = parseInt(removeComma(this.value)) || 0;
				        sum += number;
				    });
				    $("#total").val(numberWithCommas(sum+ong_kir));
				});
				 
			} );';
		
		$this->show_view('mhs/permohonan',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */