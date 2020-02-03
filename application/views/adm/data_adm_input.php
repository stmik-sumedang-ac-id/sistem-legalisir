		 <div class="container">
		 	<div class="row">&nbsp;</div>
			<div class="panel panel-info">			 
				 <div class="panel-heading">Buat User Administrator</div>
  				 <div class="panel-body">
				 <form class="form-horizontal" role="form" action="<?php echo base_url('adm/data_adm/submit')?>" method="post">			 	
				 	<div class="form-group">
				    <label for="username" class="col-sm-2 control-label">Username</label>
				    <div class="col-sm-2">
				      <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo set_value('username')?>"/>
				    </div>
					<div class="col-sm-offset-3 col-sm-5"><?php echo form_error('username'); ?></div>
				  </div>
				 	<div class="form-group">
				    <label for="pass" class="col-sm-2 control-label">Password</label>
				    <div class="col-sm-5">
				      <input type="password" name="pass" class="form-control" id="pass" placeholder="Password">
				    </div>
					<div class="col-sm-5"><?php echo form_error('pass'); ?></div>
				  </div> 
				 	<div class="form-group">
				    <label for="pass2" class="col-sm-2 control-label">Konfirmasi password</label>
				    <div class="col-sm-5">
				      <input type="password" name="pass2" class="form-control" id="pass2" placeholder="Ulangi password">
				    </div>
					<div class="col-sm-5"><?php echo form_error('pass2'); ?></div>
				  </div>			
				  <div class="form-group">
				  	<label for="pass2" class="col-sm-2 control-label">Tipe Pengguna</label>
				  	<div class="col-sm-5">
				  		<select name="tipe" class="form-control">
				  		<option value="adm">Administrator</option>
				  		<option value="akd">Admin Akademik</option>
				  		<option value="keu">Admin Keuangan</option>
				  		</select>
				  	</div>
				  </div>
				 <div class="form-group">
				 	<div class="col-sm-5">
				    	<a class="btn btn-default" href="<?php echo base_url('adm/data_adm')?>">&laquo; Batal</a>
				    </div>
					<div class="col-sm-2 tright">
				    	<button type="submit" class="btn btn-primary">Simpan</button>
				    </div>
					
				 </div>
				</form>
				</div>
			</div>
		</div>