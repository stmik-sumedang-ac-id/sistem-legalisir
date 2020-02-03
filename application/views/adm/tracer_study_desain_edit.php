<div class="container">      
      <div class="row">
        <div class="col-md-6"><h3>Ubah pertanyaan tracer study</h3></div>
	  </div>
      <div class="row">
	  	<form class="form-horizontal" action="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/update')?>" method="post">			
			<input type="hidden" name="idform" value="<?php echo $q->id_form?>"/>
		  	<div class="form-group">
			    <label for="newlabel" class="col-sm-3 control-label">Label pertanyaan</label>
			    <div class="col-sm-5">
			      <input type="text" class="form-control" name="newlabel" id="newlabel" value="<?php echo set_value('newlabel')?set_value('newlabel'):$q->label?>"/>
			    </div>
				<div class="col-sm-4"><?php echo form_error('newlabel'); ?></div>
			</div>
			<div class="form-group">
			    <label for="newtipe" class="col-sm-3 control-label">Tipe isian</label>
			    <div class="col-sm-5">
			      <select name="newtipe" class="form-control">
						<option value="singleword"<?php if($q->tipedata=='singleword') echo ' selected="selected"';elseif(set_value('newtipe')=='singleword')echo ' selected="selected"'; ?>>Kata (tanpa spasi)</option>
						<option value="text"<?php if($q->tipedata=='text') echo ' selected="selected"';elseif(set_value('newtipe')=='text')echo ' selected="selected"'; ?>>Kalimat</option>
						<option value="longtext"<?php if($q->tipedata=='longtext') echo ' selected="selected"';elseif(set_value('newtipe')=='longtext')echo ' selected="selected"'; ?>>Teks panjang</option>
						<option value="date"<?php if($q->tipedata=='date') echo ' selected="selected"';elseif(set_value('newtipe')=='date')echo ' selected="selected"'; ?>>Tanggal</option>
						<option value="email"<?php if($q->tipedata=='email') echo ' selected="selected"';elseif(set_value('newtipe')=='email')echo ' selected="selected"'; ?>>Alamat email</option>
						<option value="url"<?php if($q->tipedata=='url') echo ' selected="selected"';elseif(set_value('newtipe')=='url')echo ' selected="selected"'; ?>>Alamat URL</option>
						<option value="number"<?php if($q->tipedata=='number') echo ' selected="selected"';elseif(set_value('newtipe')=='number')echo ' selected="selected"'; ?>>Angka</option>
						<option value="decimal"<?php if($q->tipedata=='decimal') echo ' selected="selected"';elseif(set_value('newtipe')=='decimal')echo ' selected="selected"'; ?>>Angka desimal</option>
						<option value="radio"<?php if($q->tipedata=='radio') echo ' selected="selected"';elseif(set_value('newtipe')=='radio')echo ' selected="selected"'; ?>>Pilihan tunggal (radio button)</option>
						<option value="combo"<?php if($q->tipedata=='combo') echo ' selected="selected"';elseif(set_value('newtipe')=='combo')echo ' selected="selected"'; ?>>Pilihan tunggal (combobox)</option>
						<option value="check"<?php if($q->tipedata=='check') echo ' selected="selected"';elseif(set_value('newtipe')=='check')echo ' selected="selected"'; ?>>Pilihan jamak (checkbox)</option>
					</select>
			    </div>
				<div class="col-sm-4"><?php echo form_error('newtipe'); ?></div>
			</div>
			<div class="form-group">
			    <label for="instruksi" class="col-sm-3 control-label">Petunjuk pengisian</label>
			    <div class="col-sm-5">
			      <input type="text" class="form-control" name="instruksi" id="instruksi" value="<?php echo set_value('instruksi')?set_value('instruksi'):$q->instruksi?>"/>
			    </div>
				<div class="col-sm-4"><?php echo form_error('instruksi'); ?></div>
			</div>
			<div class="form-group">
			    <label for="max" class="col-sm-3 control-label"> </label>
			    <div class="col-sm-5">
			      <label class="checkbox-inline">
						<select name="wajib" class="form-control" >
							<option value="1"<?php if($q->mandatory=='1') echo ' selected="selected"';elseif(set_value('wajib')=='1')echo ' selected="selected"';?>>Wajib diisi</option>
							<option value="0"<?php if($q->mandatory=='0') echo ' selected="selected"';elseif(set_value('wajib')=='0')echo ' selected="selected"';?>>Opsional</option>
						</select>
				  	</label>												
					<label class="checkbox-inline">											
						<select name="aktif" class="form-control" >
							<option value="1"<?php if($q->aktif=='1') echo ' selected="selected"';elseif(set_value('aktif')=='1')echo ' selected="selected"';?>>Tampilkan</option>
							<option value="0"<?php if($q->aktif=='0') echo ' selected="selected"';elseif(set_value('aktif')=='0')echo ' selected="selected"';?>>Sembunyikan</option>
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
			      <button type="submit" class="btn btn-primary">Perbaharui</button>
			    </div>
			</div>
		</form>
	</div><!--/row-->		    
</div>