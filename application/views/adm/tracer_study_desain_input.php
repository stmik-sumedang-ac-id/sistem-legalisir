<div class="container">      
      <div class="row">
        <div class="col-md-6"><h3>Tambah pertanyaan tracer study</h3></div>
	  </div>
      <div class="row">
	  	<form class="form-horizontal" action="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/save')?>" method="post">
				  	<div class="form-group">
								    <label for="newlabel" class="col-sm-3 control-label">Label pertanyaan</label>
								    <div class="col-sm-5">
								      <input type="text" class="form-control" name="newlabel" id="newlabel" value="<?php echo set_value('newlabel')?>"/>
								    </div>
									<div class="col-sm-4"><?php echo form_error('newlabel'); ?></div>
								</div>
					<div class="form-group">
								    <label for="newtipe" class="col-sm-3 control-label">Tipe isian</label>
								    <div class="col-sm-5">
								      <select name="newtipe" class="form-control">
											<option value="singleword">Kata (tanpa spasi)</option>
											<option value="text">Kalimat</option>
											<option value="longtext">Teks panjang</option>
											<option value="date">Tanggal</option>
											<option value="email">Alamat email</option>
											<option value="url">Alamat URL</option>
											<option value="number">Angka</option>
											<option value="decimal">Angka desimal</option>
											<option value="radio">Pilihan tunggal (radio button)</option>
											<option value="combo">Pilihan tunggal (combobox)</option>
											<option value="check">Pilihan jamak (checkbox)</option>
										</select>
								    </div>
									<div class="col-sm-4"><?php echo form_error('newtipe'); ?></div>
								</div>
					<div class="form-group">
								    <label for="instruksi" class="col-sm-3 control-label">Petunjuk pengisian</label>
								    <div class="col-sm-5">
								      <input type="text" class="form-control" name="instruksi" id="instruksi" value="<?php echo set_value('instruksi')?>"/>
								    </div>
									<div class="col-sm-4"><?php echo form_error('instruksi'); ?></div>
								</div>
					<div class="form-group">
								    <label for="max" class="col-sm-3 control-label"> </label>
								    <div class="col-sm-5">
								      <label class="checkbox-inline">
											<select name="wajib" class="form-control" >
												<option value="1" selected="selected">Wajib diisi</option>
												<option value="0">Opsional</option>
											</select>
									  	</label>												
										<label class="checkbox-inline">											
											<select name="aktif" class="form-control" >
												<option value="1" selected="selected">Tampilkan</option>
												<option value="0">Sembunyikan</option>
											</select>
									  	</label>
								    </div>
									<div class="col-sm-4"><?php echo form_error('max'); ?></div>
								</div>
					<div class="form-group">
								    <div class="col-sm-1">
										<a href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class())?>" class="btn btn-default"> &laquo; Batal</a>
									</div>
								    <div class="col-sm-offset-6 col-sm-2">
								      <button type="submit" class="btn btn-primary">Tambahkan</button>
								    </div>
								</div>
		</form>
	</div><!--/row-->		    
</div>