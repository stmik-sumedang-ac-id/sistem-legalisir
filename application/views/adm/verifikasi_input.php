		 <div class="container">
		 	<h3>Input manual data mahasiswa</h3>
			<?php if($this->session->flashdata('success')):?>
			<div class="alert alert-success alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			  <strong>Sukses</strong> <?php echo $this->session->flashdata('success') ?>
			</div>
			<?php endif; ?>
			
			 <form class="form-horizontal" role="form" action="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/input_save')?>" method="post" id="form1">
			 	<div class="panel panel-info">
				 <div class="panel-heading">Digunakan untuk login</div>
  				 <div class="panel-body">
				 	<div class="form-group">
					    <label for="ijazah" class="col-sm-2 control-label">Nomor ijazah</label>
					    <div class="col-sm-5">
					      <input type="text" class="form-control" name="ijazah" id="ijazah" placeholder="Nomor ijazah" value="<?php echo set_value('ijazah')?>"/>
					    </div>
						<div class="col-sm-5"><?php echo form_error('ijazah'); ?></div>
					</div>
			  		<div class="form-group">
				     	<label for="pass" class="col-sm-2 control-label">Password</label>
					    <div class="col-sm-5">
					      <input type="password" name="pass" class="form-control" id="pass" placeholder="Password">
					    </div>
						<div class="col-sm-5"><?php echo form_error('pass'); ?></div>
					</div> 
				  <div class="form-group">
				    <label for="pass2" class="col-sm-2 control-label"> </label>
				    <div class="col-sm-6">
				      Kosongkan password, maka NIM akan digunakan sebagai password default
				    </div>
				  </div>				  
				 </div>
				</div>
				
			  <div class="form-group">
			    <label for="nim" class="col-sm-2 control-label">NIM</label>
			    <div class="col-sm-2">
			      <input type="text" class="form-control" name="nim" id="nim" placeholder="NIM" value="<?php echo set_value('nim')?>"/>
			    </div>
				<div class="col-sm-offset-3 col-sm-5"><?php echo form_error('nim'); ?></div>
			  </div>		   	
			  <div class="form-group">
			    <label for="prodi" class="col-sm-2 control-label">Program studi</label>
			    <div class="col-sm-5">
			      <select name="prodi" id="prodi" class="form-control">
				  	<?php foreach($jurusan->result() as $prodi):?>
				  	<option value="<?php echo $prodi->nama_jurusan; ?>"><?php echo $prodi->nama_jurusan; ?></option>
					<?php endforeach;?>
				  </select>
			    </div>
				<div class="col-sm-5"><?php echo form_error('prodi'); ?></div>
			  </div>
			  <div class="form-group">
			    <label for="nama" class="col-sm-2 control-label">Nama lengkap</label>
			    <div class="col-sm-5">
			      <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama lengkap" value="<?php echo set_value('nama')?>"/>
			    </div>
				<div class="col-sm-5"><?php echo form_error('nama'); ?></div>
			  </div>

			  <div class="form-group">
			    <div class="col-sm-offset-4 col-sm-1">
			      <button type="submit" class="btn btn-info">Simpan</button>
			    </div>
				<div class="col-sm-2">
			      <button type="submit" class="btn btn-primary" id="inputLagiBtn">Simpan &amp; Input lagi</button>
				  <input type="hidden" name="inputlagi" id="inputlagi" value="0"/>
			    </div>
			  </div>
			</form>
		</div>