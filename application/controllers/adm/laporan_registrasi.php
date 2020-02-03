<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_registrasi extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_mahasiswa','mahasiswa');
	}
	
	public function filter()
	{
		redirect(base_url('adm/laporan_registrasi/index/verall/bulan/'.($_POST['y']).'/'));
	}

	
	public function getdata($ver,$view,$tahun)
	{
		$bulans = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		//$bulans = array('Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des');
		//$bulans = array('J','F','M','A','M','J','J','A','S','O','N','D');
		/*
		$res = $this->mahasiswa->getLaporan($unver,$ver,$view,$tahun);
		$data = array();
		foreach($res->result() as $r){
			$x[$r->bln] =  (int) $r->jml;			
		}*/
		foreach($bulans as $index=>$value){
			$data = $this->mahasiswa->getReportBulan($index+1,$tahun);
			$y['bln'] = $value;
			if($ver == 'verall') {
				$y['verified'] 		= (int) $data->ver;
				$y['unverified'] 	= (int) $data->unver;
			} elseif ($ver == 'ver') {
				$y['verified'] 		= (int) $data->ver;
				$y['unverified'] 	= 0;
			} elseif($ver == 'unver') {
				$y['verified'] 		= 0;
				$y['unverified'] 	= (int) $data->unver;
			}
			$datanya[] = $y;
		}
		
		echo json_encode($datanya);
		
		//echo '[{"Bulan":"Januari","Motor":1500},{"Bulan":"Februari","Motor":1500},{"Bulan":"Maret","Motor":1500},{"Bulan":"April","Motor":1500},{"Bulan":"Mei","Motor":1500},{"Bulan":"Juni","Motor":1500},{"Bulan":"Juli","Motor":1500},{"Bulan":"Agustus","Motor":1500},{"Bulan":"September","Motor":1500},{"Bulan":"Oktober","Motor":1500},{"Bulan":"November","Motor":1500},{"Bulan":"Desember","Motor":1500}]';
	}
	
	public function index($ver='verall',$view='bulan',$tahun='')
	{
		if($tahun == '') $tahun = 2019;
		$temp = $this->mahasiswa->getLaporan($ver,$view,$tahun);
		$jml = array();
		foreach($temp->result() as $d){
			$jml[$d->bln-1] = $d->jml;
		}
		$data['jml'] = $jml;
		
		$data['bulans'] = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$data['customJsSource'] = array('jchartfx.system.js','jchartfx.coreVector.js');
		$data['customCssSource'] = array('jchartfx.css');
		
	     $call = file_get_contents(base_url() . 'adm/laporan_registrasi/getdata/'.$ver.'/'.$view.'/'.$tahun);
		 $data['report'] = json_decode($call);

		 $data['customJs'] = '
				 function loadChart(){
			            chart1 = new cfx.Chart();
			            chart1.getData().setSeries(2);
			            var series1 = chart1.getSeries().getItem(0);
			            var series2 = chart1.getSeries().getItem(1);
			            series1.setGallery(cfx.Gallery.Bar);
			            series2.setGallery(cfx.Gallery.Bar);
						chart1.getAxisX().setStaggered(true);
						
			            chart1.setDataSource('.$call.');
						chart1.getSeries().getItem(0).setText("Sudah diverifikasi");
						chart1.getSeries().getItem(1).setText("Belum diverifikasi");

			            var divHolder = document.getElementById(\'ChartDiv\');
			            chart1.create(divHolder);
			                    
			      }
			      $(document).ready(function($){loadChart()}); ';
	  /*
		$data['customJs'] = '
		 function loadChart(){
	               $.ajax({
	                    url: (\''.base_url('adm/laporan_registrasi/getdata/'.$unver.'/'.$ver.'/'.$view.'/'.$tahun).'\'),
	                    type: "POST",
	                    contentType: "application/json; charset=utf-8",
	                    dataType : "json",
	                    success: function (result) {
	                        chart1 = new cfx.Chart();
	                        chart1.getData().setSeries(2);
	                        var series1 = chart1.getSeries().getItem(0);
	                        var series2 = chart1.getSeries().getItem(1);
	                        series1.setGallery(cfx.Gallery.Bar);
	                        series2.setGallery(cfx.Gallery.Bar);
	                        chart1.setDataSource(result);
	                        var divHolder = document.getElementById(\'ChartDiv\');
	                        chart1.create(divHolder);
	                    },
	                    error: function (xhr, txt, err) {
	                        alert("error connecting to data: " + txt);            }
	                });
	      }
	      $(document).ready(function($){loadChart()}); ';*/
	      $data['tahun'] = $tahun;
		$this->show_view('adm/laporan_registrasi',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */