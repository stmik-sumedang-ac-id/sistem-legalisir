	<div class="navbar navbar-legalisir navbar-fixed-top" role="navigation" >
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" style="margin-top:0px ;padding-top:0px;margin-bottom: 0px;padding-bottom: 0px;" href="<?php echo base_url()?>"><img src="<?php echo base_url('images/stmik-small.png')?>" style="height:50px;margin: 0px;padding: 0px" /> Sistem Legalisir</a>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
        </div>
        <div class="navbar-collapse collapse">

		<!--Menu mahasiswa -->
		<?php if(isset($this->session->userdata('logged_as')['nim'])&&$this->session->userdata('logged_as')['nim']<>''):?>
          <ul class="nav navbar-nav">
            <li<?php if($this->router->fetch_class()=='dashboard') echo ' class="active"'?>><a href="<?php echo base_url('mhs/dashboard') ?>">Dashboard</a></li>
            <?php $a = 1;if($a): ?>
            <li<?php if($this->router->fetch_class()=='tracer') echo ' class="active"'?>><a href="<?php echo base_url('mhs/tracer') ?>">Tracer Study</a></li>
     <?php endif; ?>
          </ul>
		  <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url('authenticate/logout')?>">Keluar <i class="glyphicon glyphicon-log-out"></i></a></li>
          </ul>
		  
		  <?php endif; ?>
      <!--End menu mahasiswa -->
      
		  <!--Menu admin -->
		  <?php if(isset($this->session->userdata('logged_as')['role'])&&($this->session->userdata('logged_as')['role']=='adm' || $this->session->userdata('logged_as')['role']=='keu' || $this->session->userdata('logged_as')['role']=='akd')):?>		
          <ul class="nav navbar-nav">
            <li class="dropdown<?php if(substr($this->router->fetch_class(),0,10)=='verifikasi') echo ' active'?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Verifikasi <b class="caret"></b></a>				
	              <ul class="dropdown-menu">
	                <li><a href="<?php echo base_url('adm/verifikasi') ?>">Verifikasi</a></li>
					<li><a href="<?php echo base_url('adm/verifikasi/input') ?>">Input data mhs</a></li>					
	              </ul>
			</li>		
			<li<?php if($this->router->fetch_class()=='pembayaran') echo ' class="active"'?>><a href="<?php echo base_url('adm/pembayaran') ?>">Pembayaran</a></li>            				
			<li class="dropdown<?php if(substr($this->router->fetch_class(),0,7)=='laporan') echo ' active'?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url('adm/laporan_registrasi') ?>">Registrasi</a></li>                
				           <!-- <li><a href="<?php echo base_url('adm/laporan_pengajuan') ?>">Pengajuan</a></li> -->
				            <li><a href="<?php echo base_url('adm/laporan_pembayaran') ?>">Pembayaran</a></li>
				            <li><a href="<?php echo base_url('adm/laporan_pengambilan') ?>">Pengambilan</a></li>
                    <?php $a = 1; if(!$a): ?>
				          <li><a href="<?php echo base_url('adm/laporan_tracer_study') ?>">Tracer study</a></li>
        <?php endif;?>
              </ul>
            </li>
            <?php $a = 1; if(!$a): ?>

            <ul class="nav navbar-nav navbar-right">
			<li class="dropdown<?php if(substr($this->router->fetch_class(),0,12)=='tracer_study') echo ' active'?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tracer study <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url('adm/tracer_study_desain') ?>">Desain form</a></li>
                <li><a href="<?php echo base_url('adm/tracer_study_data_mhs') ?>">Isian per mahasiswa</a></li>
                <li><a href="<?php echo base_url('adm/tracer_study_data') ?>">Isian per pertanyaan</a></li>
              </ul>
            </li>			
          <?php endif;?>
          </ul>
          
		  <ul class="nav navbar-nav navbar-right">
        <li class="dropdown<?php if(substr($this->router->fetch_class(),0,12)=='tracer_study') echo ' active'?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tracer study <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url('adm/tracer_study_desain') ?>">Desain form</a></li>
                <li><a href="<?php echo base_url('adm/tracer_study_data_mhs') ?>">Isian per mahasiswa</a></li>
                <li><a href="<?php echo base_url('adm/tracer_study_data') ?>">Isian per pertanyaan</a></li>
              </ul>
            </li>     
		  	<li class="dropdown<?php if(substr($this->router->fetch_class(),0,4)=='data') echo ' active'?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url('adm/data_adm') ?>">Data admin</a></li>
                <li><a href="<?php echo base_url('adm/layanan') ?>">Layanan</a></li>
              </ul>
            </li>
            <li><a href="<?php echo base_url('authenticate/logout')?>">Keluar <i class="glyphicon glyphicon-log-out"></i></a></li>
          </ul>		  
		  <?php endif; ?>
		  <!--End menu mahasiswa -->
		  
		  <?php if(!isset($this->session->userdata('logged_as')['role']) && !isset($this->session->userdata('logged_as')['nim'])):?>		
		  <?php if($this->uri->segment(1)!='registrasi'): ?>
		  <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url('registrasi')?>">Registrasi</a></li>
          </ul>
		  <?php endif;?>
      <form class="navbar-form navbar-right" action="<?php echo base_url('authenticate/login')?>" method="post">
      
     <!-- <form class="navbar-form-navbar-rihgt" action="<?php echo base_url('authenticate/forgotpass')?>" method="post"> -->
            <div class="form-group">
              <input type="text" placeholder="Nomor ijazah" name="u" class="form-control" required>
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" name="p" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
          
		  <?php endif; ?>
        </div><!--/.nav-collapse -->
      </div>
	  <?php if(isset($this->session->userdata('logged_as')['role'])||isset($this->session->userdata('logged_as')['nim'])):?>		
	    <div class="row" style="background-color: #EFEFEF">
	        <div class="container">
				<div class="col-sm-3"><?php echo date("l, j F Y")?></div>
				<div class="col-sm-7 pull-right" style="text-align: right">
					Selamat datang, <?php echo isset($this->session->userdata('logged_as')['username'])?$this->session->userdata('logged_as')['username']:'('.$this->session->userdata('logged_as')['nim'].') '.$this->session->userdata('logged_as')['nama']; ?>					
				</div>
			</div>
		</div>		
		<?php endif; ?>
	</div> 
	