<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_pengambilan extends MY_Controller {

	public function filter()
	{
		redirect(base_url('adm/laporan_pengambilan/index/'.($_POST['t']).'/'));
	}

	public function getdata($tahun) {
		$bulans = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		foreach ($bulans as $index=>$value) {
			$data = $this->db->query("SELECT (SELECT COUNT(*) from pengajuan where status = '3' AND MONTH(waktu_pengajuan) = $index+1 AND YEAR(waktu_pengajuan) = $tahun) belum_diambil, (SELECT COUNT(*) from pengajuan where status = '4' AND MONTH(waktu_pengajuan) = $index+1 AND YEAR(waktu_pengajuan) = $tahun) sudah_diambil")->row();

			$y['bln'] = $value;
			$y['belum_diambil'] = (int) $data->belum_diambil;
			$y['sudah_diambil'] = (int) $data->sudah_diambil;

			$datanya[] = $y;
		}
		echo json_encode($datanya);
	}

	public function index($tahun = '')
	{
		if (!$tahun) $tahun = 2019;
		$data['tahun'] = $tahun;
		$call = file_get_contents(base_url() . 'adm/laporan_pengambilan/getdata/' . $tahun);
		$data['report'] = json_decode($call);

		$data['customJsSource'] = array('jchartfx.system.js','jchartfx.coreVector.js');
		$data['customCssSource'] = array('jchartfx.css');
		$data['customJs'] = '
				 function loadChart(){
			            chart1 = new cfx.Chart();
			            chart1.getData().setSeries(3);
			            var series1 = chart1.getSeries().getItem(0);
			            var series2 = chart1.getSeries().getItem(1);
			            
			            series1.setGallery(cfx.Gallery.Bar);
			            series2.setGallery(cfx.Gallery.Bar);
			            
						chart1.getAxisX().setStaggered(true);
						
			            chart1.setDataSource('.$call.');
			            chart1.getSeries().getItem(0).setText("Belum Diambil");
						chart1.getSeries().getItem(1).setText("Sudah Diambil");

			            var divHolder = document.getElementById(\'ChartDiv\');
			            chart1.create(divHolder);
			                    
			      }
			      $(document).ready(function($){loadChart()}); ';
	 
		$this->show_view('adm/laporan_pengambilan',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */