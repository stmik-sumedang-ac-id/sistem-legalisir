<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ongkir extends CI_Controller{


	public function get_provinsi(){
		$provinces = $this->rajaongkir->province();
		$this->output->set_content_type('application/json')->set_output($provinces);
	}

	public function get_kota($id_provinsi){
		$kota = $this->rajaongkir->city($id_provinsi);
		$this->output->set_content_type('application/json')->set_output($kota);
	}

	public function get_biaya($asal,$tujuan,$berat,$kurir){
		$ongkir = $this->rajaongkir->cost($asal,$tujuan,$berat,$kurir);
		$this->output->set_content_type('application/json')->set_output($ongkir);
	}

	function addpos(){
		$data = array(
			'no_ijazah'=>$this->input->post('no_ijazah'),
			'nim'=>$this->input->post('nim'),
			'nama'=>$this->input->post('nama'),
			'provinsi_asal'=>$this->input->post('provinsi_asal'),
			'kota_asal'=>$this->input->post('kota_asal'),
			'provinsi_tujuan'=>$this->input->post('provinsi_tujuan'),
			'kota_tujuan'=>$this->input->post('kota_tujuan'),
			'berat'=>$this->input->post('berat'),
			'kurir'=>$this->input->post('kurir'),
			'service'=>$this->input->post('service'),
			'alamat_lengkap'=>$this->input->post('alamat')
		);
		$query = $this->m_ongkir->ongkir($data);
		if ($query = true) {
			$this->session->set_flashdata('berhasil','Berhasil');
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$this->session->set_flashdata('gagal','Gagal');
			redirect($_SERVER['HTTP_REFERER']);
		}
		
	}
}