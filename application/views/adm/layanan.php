<div class="container">
	<div class="row">&nbsp;</div>
      	<div class="row">
		<div class="col-sm-6"><h3>Layanan:</h3></div>
		<br />
		<div class="col-sm-6 tright"><a class="btn btn-primary" href="<?php echo base_url('adm/layanan/input')?>">Buat layanan baru</a></div>
	  </div>
	  <?php if($this->session->flashdata('sukses_non_aktif')==1 || $this->session->flashdata('sukses_aktif')==1):?>
		<div class="alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <strong>
		  <?php 
		  if($this->session->flashdata('sukses_non_aktif')=='1') echo 'Sukses!';
		  if($this->session->flashdata('sukses_aktif')=='1') echo 'Sukses!';
		  ?></strong> 
		  <?php 
		  if($this->session->flashdata('sukses_non_aktif')=='1') echo 'Layanan berhasil di non-aktifkan.';
		  if($this->session->flashdata('sukses_aktif')=='1') echo 'Layanan berhasil di aktifkan.';
		  ?>
		</div>
		<?php endif; ?>
	  <?php if($this->session->flashdata('sukses_delete')==1):?>
		<div class="alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <strong>Sukses Hapus!</strong> Data layanan admin berhasil dihapus.
		</div>
		<?php endif; ?>
		
	  <div class="row">
		<?php if($this->session->flashdata('sukses_update')==1):?>
		<div class="alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <strong>Sukses!</strong> Biaya legalisir berhasil diupdate.
		</div>
		<?php endif; ?>
	  </div>
	  <br />
	  <div class="row">
	  	<div class="col-sm-12">
		  	<table class="table table-striped table-bordered">
				<tr>
					<th class="tcenter">Layanan</th>
					<th class="tcenter">Biaya</th>
					<th class="tcenter">Min qty</th>
					<th class="tcenter">Max qty</th>
					<th class="tcenter">Aksi</th>
				</tr>
				<?php foreach($services->result() as $svc): ?>	
				<tr<?php if($svc->aktif==1) echo ' class="success"'?>>
					<td><?php echo $svc->nama_layanan?><br />&nbsp;&nbsp;&nbsp;&nbsp;<small><?php echo $svc->deskripsi?></small></td>
					<td class="tright"><?php echo $this->tools->uang($svc->biaya) ?></td>					
					<td class="tright"><?php echo $svc->min_qty ?></td>					
					<td class="tright"><?php echo $svc->max_qty==0?'~':$svc->max_qty; ?></td>					
					<td class="tright">
						<a class="btn btn-default" href="<?php echo base_url('adm/layanan/'.($svc->aktif==1?'non_aktif':'aktif').'/'.$svc->id_layanan)?>"><?php echo ($svc->aktif==1)?'Nonaktifkan':'Aktifkan'?></a>
						<a class="btn btn-warning" href="<?php echo base_url('adm/layanan/edit/'.$svc->id_layanan)?>">Edit</a>						
						<a data-toggle="modal" data-target="#modalConfirm" href="<?php echo base_url('adm/layanan/delete/'.$svc->id_layanan)?>" class="btn btn-danger">Hapus</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
	  </div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">	  
	</div><!-- /.modal -->