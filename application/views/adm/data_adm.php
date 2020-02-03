    <div class="container">        
		<div class="row">
			<div class="col-sm-6"><h2>Data admin</h2></div>
			<br />
			<div class="col-sm-6 tright"><a class="btn btn-info" href="<?php echo base_url('adm/data_adm/input') ?>">Buat user administrator</a></div>
		</div>
		<?php if($this->session->flashdata('sukses')==1):?>
		<div class="alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <strong>Sukses!</strong> Data user admin berhasil disimpan.
		</div>
		<?php endif; ?>
		<?php if($this->session->flashdata('sukses_nonaktif')==1 || $this->session->flashdata('sukses_aktif')==1):?>
		<div class="alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <strong>
		  <?php 
		  if($this->session->flashdata('sukses_nonaktif')=='1') echo 'Sukses non-aktifkan user!';
		  if($this->session->flashdata('sukses_aktif')=='1') echo 'Sukses mengaktifkan user!';
		  ?></strong> 
		  <?php 
		  if($this->session->flashdata('sukses_nonaktif')=='1') echo 'User admin berhasil di non-aktifkan.';
		  if($this->session->flashdata('sukses_aktif')=='1') echo 'User admin berhasil di aktifkan.';
		  ?>
		</div>
		<?php endif; ?>
		<?php if($this->session->flashdata('sukses_delete')==1):?>
		<div class="alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <strong>Sukses Hapus!</strong> Data user admin berhasil dihapus.
		</div>
		<?php endif; ?>
		<div class="row">
			<div class="col-sm-9">Untuk mengurutkan lebih dari satu kolom, tahan tombol [Shift] selagi meng-klik kolom</div>			
		</div>
		<div class="row">&nbsp;</div>
		<div class="table-responsive">
		<table class="table table-bordered table-striped responsive-utilities" id="data">
			<thead>
				<tr>
					<th>Username</th>
					<th>Role</th>
					<th>Terakhir login</th>
					<th>Aktif</th>
					<th>Dibuat pada</th>				
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($users->result() as $user): ?>	
				<tr>
					<td><?php echo $user->username?></td>
					<td><?php if($user->role == "adm") {echo "Administrator";} elseif ($user->role == "akd") {echo "Admin Akademik";} elseif($user->role == "keu") {echo "Admin Keuangan";} ?></td>
					<td><?php echo $user->last_login?></td>
					<td class="tcenter" style="color:#ffffff;background-color: <?php echo $user->aktif==1?'#5CB85C':'#D9534F' ?>"><?php echo $user->aktif==1?'Aktif':'Non-aktif'?></td>
					<td><?php echo $user->created_at?></td>
					<td>
						<?php if($this->session->userdata('logged_as')['username']!=$user->username):?>
						<a href="" class="btn btn-info">Reset password</a>
						<a data-toggle="modal" data-target="#modalConfirm" href="<?php echo base_url('adm/data_adm/'.($user->aktif=='1'?'deaktif':'aktif').'/'.$user->username)?>" class="btn btn-warning"><?php echo ($user->aktif=='1'?'Non-aktifkan':'Aktifkan')?></a>
						<a data-toggle="modal" data-target="#modalConfirm" href="<?php echo base_url('adm/data_adm/delete/'.$user->username)?>" class="btn btn-danger">Hapus</a>
						<?php endif; ?>
					</td>
				</tr>			
			<?php endforeach; ?>
			</tbody>
		</table>			
		</div>
		<div class="row">&nbsp;</div>		
		
	  <div class="row">&nbsp;</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">	  
	</div><!-- /.modal -->