<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_pembayaran extends MY_Controller {

	function __construct()
    {
        parent::__construct();
    }


    public function filter()
	{
		redirect(base_url('adm/laporan_pembayaran/index/'.($_POST['t']).'/'));
	}

	public function getdata($tahun) {
		$bulans = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		
		foreach($bulans as $index=>$value){
			$data = $this->db->query("SELECT sum(biaya_total) as 'biaya' FROM `pembayaran` where MONTH(waktu_bayar) = $index+1 AND YEAR(waktu_bayar) = $tahun")->row();
			$data2 = $this->db->query("SELECT (SELECT COUNT(*) from pengajuan where status = '1' AND MONTH(waktu_pengajuan) = $index+1 AND YEAR(waktu_pengajuan) = $tahun) belumbayar,(SELECT COUNT(*) from pengajuan where status = '4' AND MONTH(waktu_pengajuan) = $index+1 AND YEAR(waktu_pengajuan) = $tahun) sudahbayar")->row();

			$y['bln'] = $value;
			
			$y['bbayar'] = (int) $data2->belumbayar;
			$y['sbayar'] = (int) $data2->sudahbayar;
			$datanya[] = $y;
		}
		echo json_encode($datanya);
	}

	public function getdata2($tahun) {
		$bulans = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		
		foreach($bulans as $index=>$value){
			$data = $this->db->query("SELECT sum(biaya_total) as 'biaya' FROM `pembayaran` where MONTH(waktu_bayar) = $index+1 AND YEAR(waktu_bayar) = $tahun")->row();
			$data2 = $this->db->query("SELECT (SELECT COUNT(*) from pengajuan where status = '1' AND MONTH(waktu_pengajuan) = $index+1 AND YEAR(waktu_pengajuan) = $tahun) belumbayar,(SELECT COUNT(*) from pengajuan where status = '4' AND MONTH(waktu_pengajuan) = $index+1 AND YEAR(waktu_pengajuan) = $tahun) sudahbayar")->row();

			$y['bln'] = $value;
			$y['biaya'] = (int) $data->biaya;
			$y['bbayar'] = (int) $data2->belumbayar;
			$y['sbayar'] = (int) $data2->sudahbayar;
			$datanya[] = $y;
		}
		echo json_encode($datanya);
	}

	public function index($tahun = '')
	{
		if (!$tahun) $tahun = 2019;
		$data['tahun'] = $tahun;
		
		$data['customJsSource'] = array('jchartfx.system.js','jchartfx.coreVector.js');
		$data['customCssSource'] = array('jchartfx.css');

		$call = file_get_contents(base_url() . 'adm/laporan_pembayaran/getdata/' . $tahun);
		$data['report'] = json_decode($call);

		$call2 = file_get_contents(base_url() .'adm/laporan_pembayaran/getdata2/' . $tahun);
		$data['report2'] = json_decode($call2);
		
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
			            chart1.getSeries().getItem(0).setText("Belum Bayar");
						chart1.getSeries().getItem(1).setText("Sudah Bayar");

			            var divHolder = document.getElementById(\'ChartDiv\');
			            chart1.create(divHolder);
			                    
			      }
			      $(document).ready(function($){loadChart()}); ';

		$this->show_view('adm/laporan_pembayaran',$data);

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */