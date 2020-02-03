	    <div class="container">      
      	<div class="row">&nbsp;</div>
      	<div class="row">
		  	<div class="col-sm-4">
				<h3>Permohonan legalisir anda:</h3>
			</div>
		  	<div class="col-sm-offset-4 col-sm-4 tright">
				<br />
				<a href="<?php echo base_url('mhs/permohonan')?>" class="btn btn-primary">Buat permohonan legalisir</a>
				<a href="<?php echo base_url('mhs/tracer')?>" class="btn btn-primary">Tracer Study</a>
			</div>
		</div>
		<div class="row">&nbsp;</div>
		<?php if($this->session->flashdata('sukses_pengajuan')==1):?>
		<div class="alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <strong>Permohonan disubmit!</strong> Permohonan anda berhasil disubmit.
		</div>
		<?php endif; ?>
		
		
		
		<div class="row">
		<?php if($this->session->flashdata('sukses_tracer')==1):?>
		<div class="alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <strong>Tracer Study!</strong> Data tracer study anda berhasil disimpan.
		</div>
		<?php endif; ?>
		
		<div class="row">
	  		<div class="col-sm-12" style="overflow-x: auto">
				<?php if($pengajuan->num_rows()>0): ?>
				<table class="table table-striped table-bordered">
					<tr>
						<th>Waktu pengajuan</th>
						<th>Permohonan</th>
						<th>Tagihan</th>
						<th>Status</th>
					</tr>
					<?php foreach($pengajuan->result() as $p): ?>
					<tr>
						<td><?php echo $p->waktu_pengajuan ?></td>
						<td>
						<table class="table table-striped">
							<tr>
								<th>Jml</th>
								<th>Layanan</th>
								<th colspan="2">Biaya satuan</th>
								<th colspan="2">Subtotal</th>
							</tr>
						<?php $total = 0;foreach($detail[$p->id_pengajuan] as $item): 
								echo 
								'<tr><td class="tright">'.$item->jumlah.'</td>'.
								'<td class="">'.$item->nama_layanan.'</td>'.
								'<td class="tright">@ Rp</td>'.
								'<td class="tright">'.$this->tools->angka($item->biaya_satuan).'</td>'.
								'<td class="">Rp</td>'.
								'<td class="tright">'.$this->tools->angka($item->jumlah*$item->biaya_satuan).'</td></tr>';
								$total +=$item->jumlah*$item->biaya_satuan;
						endforeach; ?>

						</table>					
						</td>
						<td class="tright">
							<?php echo $this->tools->uang($total)?>
							<br/><br/>
							<?php
							echo '<a href="'.base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/b_transfer/'.$p->id_pengajuan).'" data-toggle="modal" data-target="#modals" class="btn btn-primary">Upload Bukti Transfer</a><br/>';

								if (!empty($p->bukti_transfer)) {
									echo 'Status: <span class="label label-success">Sudah diupload</span>';
								}elseif(empty($p->bukti_transfer)){
									echo 'Status: <span class="label label-danger">Belum diupload</span>';	
								}?>
						</td>
						<td><?php switch($p->status)
						{
							case 1: echo '<span class="label label-default">1. Pengajuan, belum bayar</span>';break;
							case 2: echo '<span class="label label-info">2. Sudah bayar, belum selesai</span>';break;
							case 3: echo '<span class="label label-warning">3. Sudah selesai, belum diambil</span>';break;
							case 4: echo '<span class="label label-success">4. Sudah diambil</span>';break;
						} 
						echo '<br />';
						?>
						<br />
						<form action="<?= base_url('mhs/dashboard/bukti_permohonan/')?>" method="post">
						<input type="hidden" name="aidi" value="<?= $p->id_pengajuan?>" />
						<button class="btn btn-info">Bukti Permohonan</button>
						</form>
						
						<br>
						<?php if (!($p->status == 1))  { ?>
						
						<form action="<?= base_url('mhs/dashboard/bukti_pembayaran/')?>" method="post">
						<input type="hidden" name="aidi" value="<?= $p->id_pengajuan?>" />
						<button class="btn btn-success">Bukti Pembayaran</button>
						</form>
						 <?php } ?>

						 <?php foreach($pos->result() as $m){
						 	if ($p->status == '3') {
							 	if (!empty($m->id_pengajuan == $p->id_pengajuan)) {
							 		echo '<a href="'.base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/b_pengiriman/'.$p->id_pengajuan).'" data-toggle="modal" data-target="#modals" class="btn btn-primary">Cek Pengiriman</a><br/>';	
							 	}
							}elseif($p->status == '4'){
								if (!empty($m->id_pengajuan == $p->id_pengajuan)) {
							 		echo '<a href="'.base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/b_pengiriman/'.$p->id_pengajuan).'" data-toggle="modal" data-target="#modals" class="btn btn-primary">Bukti Pengiriman</a><br/>';
							 	}
							}elseif(empty($m->id_pengajuan)){
								echo'';
							}
						 }?>
						</td>						
					</tr>
					<?php endforeach; ?>
				</table>
				<?php else: ?>
					Anda belum membuat pengajuan legalisir
				<?php endif; ?>
			</div>
	  </div>
	  <div class="row">
			<div class="col-sm-12">
				<label>Status:</label>
				<span class="label label-default">1. Pengajuan, belum bayar</span> &raquo;
				<span class="label label-info">2. Sudah bayar, belum selesai</span> &raquo;
				<span class="label label-warning">3. Sudah selesai, belum diambil</span> &raquo;
				<span class="label label-success">4. Sudah diambil</span>
			</div>
		</div>
	</div>
	<br/>

 <!-- Modal -->
		<div class="modal fade" id="modals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header"></div>
		      <div class="modal-body"></div>		      
		     </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->


<!-- <script type="text/javascript">
	$(function(){
		$.get('<?= site_url('adm/verifikasi/get_provinsi')?>',{},(response)=>{
			let output = '';
			let provinsi  = response.rajaongkir.results
			console.log(response)
		
			provinsi.map((val,i)=>{
				output+=`<option value="${val.province_id}" >${val.province}</option>`
			})
			$('.provinsi').html(output)

		})
	});

	function get_kota(type){
			let id_provinsi_asal = $(`#provinsi_${type}`).val();
			//alert(id_provinsi_asal)
			$.get("<?= site_url('adm/verifikasi/get_kota/')?>/"+id_provinsi_asal,{},(response)=>{
			let output = '';
			let kota  = response.rajaongkir.results
			console.log(response)

			kota.map((val,i)=>{
				output+=`<option value="${val.city_id}" >${val.city_name}</option>`
			})
			$(`#kota_${type}`).html(output)
		});
	}

	function get_ongkir(){
		let berat = $('#berat').val();
		let asal = $('#kota_asal').val();
		let tujuan = $('#kota_tujuan').val();
		let kurir = $('#kurir').val();
		let output = '';
		$.get("<?= site_url('adm/verifikasi/get_biaya/')?>"+`/${asal}/${tujuan}/${berat}/${kurir}`,{},(response)=>{
			console.log(response)
			let biaya  = response.rajaongkir.results
			console.log(biaya)

			biaya.map((val,i)=>{
				for (var i = 0; i < val.costs.length; i++) {
					let jenis_layanan = val.costs[i].service
					val.costs[i].cost.map((val,i)=>{
						output+=`<option value="${jenis_layanan} -- Rp.${val.value} ${val.etd} Hari">${jenis_layanan} -- Rp.${val.value} ${val.etd} Hari
						</option>`
					})
				}
			})
			$(`#service`).html(output)
		});
	}
	
</script> -->