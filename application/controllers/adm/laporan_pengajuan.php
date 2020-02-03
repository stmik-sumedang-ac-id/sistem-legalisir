<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_pengajuan extends MY_Controller {

	public function data()
	{
		$a=array(
			array(
				"Bulan"=>"Januari",
				"Motor"=>1500,
				"Onderdil"=>1234
			),
			array(
				"Bulan"=>"Februari",
				"Motor"=>1500,
				"Onderdil"=>1234
			),
			array(
				"Bulan"=>"Maret",
				"Motor"=>1500,
				"Onderdil"=>1234
			),
			array(
				"Bulan"=>"April",
				"Motor"=>1500,
				"Onderdil"=>1234
			),
			array(
				"Bulan"=>"Mei",
				"Motor"=>1500,
				"Onderdil"=>1234
			),
			array(
				"Bulan"=>"Juni",
				"Motor"=>1500,
				"Onderdil"=>1234
			),
			array(
				"Bulan"=>"Juli",
				"Motor"=>1500,
				"Onderdil"=>1234
			),
			array(
				"Bulan"=>"Agustus",
				"Motor"=>1500,
				"Onderdil"=>1234
			),
			array(
				"Bulan"=>"September",
				"Motor"=>1500,
				"Onderdil"=>1234
			),
			array(
				"Bulan"=>"Oktober",
				"Motor"=>1500,
				"Onderdil"=>1234
			),
			array(
				"Bulan"=>"November",
				"Motor"=>1500,
				"Onderdil"=>1234
			),
			array(
				"Bulan"=>"Desember",
				"Motor"=>1500,
				"Onderdil"=>1234
			),
		);
		echo json_encode($a);
		exit();
	}
	public function index($filter='')
	{
		$data['customJsSource'] = array('jchartfx.system.js','jchartfx.coreVector.js');
		$data['customCssSource'] = array('jchartfx.css');
		$data['customJs'] = '
	    function loadChart(){
	           $.ajax({
	                url: ("'.base_url('adm/laporan_pengajuan/data/').'"),
	                type: "POST",
	                contentType: "application/json; charset=utf-8",
	                dataType : "json",
	                success: function (result) {
						chart1 = new cfx.Chart();
			            chart1.getData().setSeries(2);
			            chart1.getAxisY().setMin(500);
			            chart1.getAxisY().setMax(2000);
			            var series1 = chart1.getSeries().getItem(0);
			            var series2 = chart1.getSeries().getItem(1);
			            series1.setGallery(cfx.Gallery.Lines);
			            series2.setGallery(cfx.Gallery.Bar);
			            
	                    chart1.setDataSource(result.d);
						var divHolder = document.getElementById(\'ChartDiv\');
        				chart1.create(divHolder);
	                },
	                error: function (xhr, txt, err) {
	                    alert("error connecting to data: " + txt);            }
	            });
      }
	  $(document).ready(function($){loadChart()});';
	 
		$this->show_view('adm/laporan_pengajuan',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */