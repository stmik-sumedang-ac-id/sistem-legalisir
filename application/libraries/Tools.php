<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tools {
	
	var $CI;
    
	function __construct()
	{				
		$this->CI = &get_instance();		
		$this->CI->load->database();
	} 
	function resizeMarkup($markup, $dimensions)
	{
		$w = $dimensions['width'];
		$h = $dimensions['height'];

		$patterns = array();
		$replacements = array();
		if( !empty($w) )
		{
		$patterns[] = '/width="([0-9]+)"/';
		$patterns[] = '/width:([0-9]+)/';

		$replacements[] = 'width="'.$w.'"';
		$replacements[] = 'width:'.$w;
		}

		if( !empty($h) )
		{
		$patterns[] = '/height="([0-9]+)"/';
		$patterns[] = '/height:([0-9]+)/';

		$replacements[] = 'height="'.$h.'"';
		$replacements[] = 'height:'.$h;
		}

		return preg_replace($patterns, $replacements, $markup);
	}
	function uang($number)
	{
		return 'Rp '.number_format($number,'0',',','.');
	}
    function cekStatInput($nim)
    {
    	$query = $this->CI->db->get_where('tb_spm',array('nim'=>$nim));
    	
	    if ($query->num_rows() == 1)
	    {
	      // Berhasil login
	      return true;
	    }
	    else
	    {	
	      // Gagal login
	      return false;
	    }
    }
     
	function bulan($bulanke=1,$short=0)
	{
		$bulans  = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$shortBulans  = array('Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des');
		return $short?$shortBulans[$bulanke-1]:$bulans[$bulanke-1];
	}
	
	function angka($number,$dec=0)
	{
		return number_format($number,$dec,',','.');
	}
	
	function replaceNonAlNum($string,$replacement='-')
	{
		return preg_replace('~[^\p{L}\p{N}]++~u', $replacement, $string);
	}
	
	function potongString($string,$panjang=50,$lebihan='..')
	{
		return strlen($string)>$panjang?substr($string,0,$panjang).$lebihan:$string;
	}
	
	function timeLeft($timestamp,$showM=1,$showH=1,$showD=1)
	{
		$now  = time();
		if($timestamp<$now)
			return FALSE;
		else
		{
			$sisa = 0;
			$months = floor(($timestamp-$now)/(60*60*24*30));
			$sisa = ($timestamp-$now)%(60*60*24*30);
			$days = floor($sisa/(60*60*24));
			$sisa = $sisa%(60*60*24);
			$hours = floor($sisa/(60*60));
			$sisa = $sisa%(60*60);			
			$mins = floor($sisa/60);
			$timeLeft = '';
			$timeLeft .= $months>0?$months.' bulan':'';
			$timeLeft .= ' '.($days>0&&$showD==1?$days.' hari':'');
			$timeLeft .= ' '.($hours>0&&$showH==1?$hours.' jam':'');
			$timeLeft .= ' '.($mins>0&&$showM==1?$mins.' menit':'');
			return trim($timeLeft)<>''?$timeLeft.' lagi':'';
		}
	}
	
	
	function timeAgo($timestamp,$showM=1,$showH=1,$showD=1)
	{
		$now  = time();
		if($timestamp>$now)
			return FALSE;
		else
		{
			$sisa = 0;
			$months = floor(($now-$timestamp)/(60*60*24*30));
			$sisa = ($now-$timestamp)%(60*60*24*30);
			
			$days = floor($sisa/(60*60*24));
			$sisa = $sisa%(60*60*24);
			$hours = floor($sisa/(60*60));
			$sisa = $sisa%(60*60);			
			$mins = floor($sisa/60);
			
			$timeAgo = '';
			
			$timeAgo .= $months>0?$months.' bulan':'';
			$timeAgo .= ' '.(($days>0&&$showD==1)?$days.' hari':'');
			$timeAgo .= ' '.(($days=0&&$hours>0&&$showH==1)?$hours.' jam':'');
			$timeAgo .= ' '.(($days=0&&$mins>0&&$showM==1)?$mins.' menit':'');
			return $timeAgo.' lalu';
		}
	}
	
	
	function cekCurrentMenu($controller, $method='')
	{
		//echo $this->CI->router->fetch_class().'aaa';
		$sama = false;
		if($controller==$this->CI->router->fetch_class()  && $method=='')
			$sama = true;
		
		if($method<>'' && $controller==$this->CI->router->fetch_class()  && $method==$this->CI->router->fetch_method() )
			$sama = true;
		
		return $sama;
	}
	
	function is_200($file)
	{
		$file_headers = @get_headers($file);
		return ($file_headers[0] == 'HTTP/1.1 404 Not Found') ?false:true;
	}
}

?>