    <div class="container">        
		<div class="row">
			<div class="col-sm-6"><h3>Verifikasi mahasiswa</h3></div>
			<!--<br />
			<div class="col-sm-6 tright"><a class="btn btn-info">Input manual data mahasiswa</a></div>-->
		</div>
		<?php if($this->session->flashdata('success')):?>
		<div class="alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <strong>Sukses</strong> <?php echo $this->session->flashdata('success') ?>
		</div>
		<?php endif; ?>
		
	  
		<?php
		$attributes = array('id' => 'verifi');
		echo form_open($this->uri->segment(1).'/'.$this->router->fetch_class().'/submit',$attributes)?>
		<div class="row">
			<div class="col-sm-3"><button class="btn btn-primary" type="submit" id="check">Verifikasi yang dipilih</button></div>			
		</div>
		<div class="row">
			<div class="col-sm-9">Untuk mengurutkan lebih dari satu kolom, tahan tombol [command] selagi meng-klik kolom</div>			
		</div>
		<div class="row">&nbsp;</div>
		<div class="table-responsive">
		<table class="table table-bordered table-striped responsive-utilities" id="data">
			<thead>
				<tr>
					<th><input type="checkbox" id="cekall"/> </th>
					<th>No Ijazah</th>
					<th>No Telpon</th>
					<th>Alamat</th>
					<th>Nama</th>
					<th>Prodi</th>
					<th>Angkatan</th>					
					<th>Verifikasi</th>					
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($mhs->result() as $m): ?>	<tr<?php $m->status_verifikasi==1?' class="success"':''?>>
					<td><input type="checkbox" name="mhs[]" class="cek" value="<?php echo $m->nim?>"/></td>
					

					<td><?php echo $m->no_ijazah?></td>
					<td><?php echo $m->no_hp?></td>
					<td><?php echo $m->alamat?></td>
					
					<td><a href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/upload/'.$m->no_ijazah) ?>"><?php echo $m->nama?></a></td>
					<td><?php echo $m->prodi?></td>
					<td><?php echo $m->angkatan?></td>				
					<td> <span class="label label-<?php echo $m->status_verifikasi==0?'danger':'success'?>"><?php echo $m->status_verifikasi==0?'Belum':'Ok'?></span></td>
					<td><?php if($m->status_verifikasi==0):?>
						<a href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/submit/'.$m->nim) ?>" class="btn btn-primary">Verifikasi</a>
						<?php else: ?>
						<a href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/disapprove/'.$m->nim) ?>" class="btn btn-warning">Hapus-Verifikasi</a>
						<?php endif; ?>
					</td>					
				</tr>			
			<?php endforeach; ?>
			</tbody>
		</table>			
		</div>
		<div class="row">&nbsp;</div>		
		<div class="row">
			<div class="col-sm-6"><button class="btn btn-primary" type="submit">Verifikasi yang dipilih</button></div>
		</div>
		</form>
	  <div class="row">&nbsp;</div>
	</div>