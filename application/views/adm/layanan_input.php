		 <div class="container">
		 	<h3>Input Layanan</h3>
			 <form class="form-horizontal" role="form" action="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/save')?>" method="post">
		 	 	<div class="form-group">
				    <label for="nama" class="col-sm-3 control-label">Nama layanan</label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama layanan" value="<?php echo set_value('nama')?>"/>
				    </div>
					<div class="col-sm-4"><?php echo form_error('nama'); ?></div>
				</div>
		  		<div class="form-group">
			     	<label for="desc" class="col-sm-3 control-label">Deskripsi</label>
				    <div class="col-sm-5">
				      <input type="text" name="desc" class="form-control" id="desc" placeholder="Deskripsi layanan" value="<?php echo set_value('desc')?>"/>
				    </div>
					<div class="col-sm-4"><?php echo form_error('desc'); ?></div>
				</div> 
			  <div class="form-group">
			    <label for="biaya" class="col-sm-3 control-label">Biaya satuan</label>
			    <div class="col-sm-2">
				  <div class="input-group">
			        <span class="input-group-addon">Rp</span>
			        <input type="text" dir="rtl" name="biaya" class="form-control" id="biaya" placeholder="" value="<?php echo set_value('biaya')?>"/>
			      </div>
			      
			    </div>
				<div class="col-sm-4"><?php echo form_error('biaya'); ?></div>
			  </div>				  
			
			  <div class="form-group">
			    <label for="min" class="col-sm-3 control-label">Jumlah pengajuan minimum </label>
			    <div class="col-sm-1">
			      <input type="text" class="form-control" name="min" id="min" dir="rtl" value="<?php echo set_value('min')?set_value('min'):'1'?>"/>
			    </div>
				<div class="col-sm-offset-3 col-sm-5"><?php echo form_error('min'); ?></div>
			  </div>
			  <div class="form-group">
			    <label for="max" class="col-sm-3 control-label">Jumlah pengajuan maksimum</label>
			    <div class="col-sm-1">
			      <input type="text" name="max" class="form-control" dir="rtl" id="max" value="<?php echo set_value('max')?set_value('max'):'1'?>"/>
			    </div>
				<div class="col-sm-5"><?php echo form_error('max'); ?></div>
			  </div>

			  <div class="form-group">
			    <div class="col-sm-3"><a class="btn btn-danger" href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class())?>">&laquo; Batal</a></div>
			    <div class="col-sm-offset-5 col-sm-3">
			      <button type="submit" class="btn btn-primary">Simpan layanan</button>
			    </div>
			  </div>
			</form>
		</div>