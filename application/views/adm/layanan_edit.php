		 <div class="container">
		 	<h3>Edit Layanan</h3>
			 <form class="form-horizontal" role="form" action="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/update')?>" method="post">
		 	 	<div class="form-group">
				    <label for="nama" class="col-sm-3 control-label">Nama layanan</label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" name="nama" id="nama" value="<?php echo set_value('nama')?set_value('nama'):$layanan->nama_layanan?>"/>
				    </div>
					<div class="col-sm-4"><?php echo form_error('nama'); ?></div>
					<input type="hidden" name="id" value="<?php echo $layanan->id_layanan ?>"/>
				</div>
		  		<div class="form-group">
			     	<label for="desc" class="col-sm-3 control-label">Deskripsi</label>
				    <div class="col-sm-5">
				      <input type="text" name="desc" class="form-control" id="desc" placeholder="Deskripsi layanan" value="<?php echo set_value('desc')?set_value('desc'):$layanan->deskripsi?>"/>
				    </div>
					<div class="col-sm-4"><?php echo form_error('desc'); ?></div>
				</div> 
			  <div class="form-group">
			    <label for="biaya" class="col-sm-3 control-label">Biaya satuan</label>
			    <div class="col-sm-2">
				  <div class="input-group">
			        <span class="input-group-addon">Rp</span>
			        <input type="text" dir="rtl" name="biaya" class="form-control" id="biaya" placeholder="" value="<?php echo set_value('biaya')?set_value('biaya'):$layanan->biaya?>"/>
			      </div>
			      
			    </div>
				<div class="col-sm-4"><?php echo form_error('biaya'); ?></div>
			  </div>				  
			
			  <div class="form-group">
			    <label for="min" class="col-sm-3 control-label">Jumlah pengajuan minimum </label>
			    <div class="col-sm-1">
			      <input type="text" class="form-control" name="min" id="min" dir="rtl" value="<?php echo set_value('min')?set_value('min'):$layanan->min_qty?>"/>
			    </div>
				<div class="col-sm-offset-3 col-sm-5"><?php echo form_error('min'); ?></div>
			  </div>
			  <div class="form-group">
			    <label for="max" class="col-sm-3 control-label">Jumlah pengajuan maksimum</label>
			    <div class="col-sm-1">
			      <input type="text" name="max" class="form-control" dir="rtl" id="max" value="<?php echo set_value('max')?set_value('max'):$layanan->max_qty?>"/>
			    </div>
				<div class="col-sm-5"><?php echo form_error('max'); ?></div>
			  </div>

			  <div class="form-group">
			    <div class="col-sm-3"><a class="btn btn-danger" href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class())?>">&laquo; Batal</a></div>
			    <div class="col-sm-offset-5 col-sm-3">
			      <button type="submit" class="btn btn-primary">Update layanan</button>
			    </div>
			  </div>
			</form>
		</div>