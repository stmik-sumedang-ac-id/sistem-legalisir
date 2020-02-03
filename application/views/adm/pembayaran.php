    <div class="container">        
		<div class="row">
			<div class="col-sm-6"><h3>Konfirmasi pembayaran</h3></div>
			<!--<br />
			<div class="col-sm-6 tright"><a class="btn btn-info">Input manual data mahasiswa</a></div>-->
		</div>
		<div class="row" style="background-color: #efefef;">
			<div class="col-sm-3 tright"><strong>Tampilkan status permohonan:</strong></div>
			<div class="col-sm-1 tcenter"<?php if($filter==0) echo ' style="background-color: #003366"'?>><a<?php if($filter==0) echo ' style="color: #ffffff"'?> href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/index/0')?>">Seluruhnya</a></div>
			<div class="col-sm-2 tcenter"<?php if($filter==1) echo ' style="background-color: #999999"'?>><a<?php if($filter==1) echo ' style="color: #ffffff"'?> href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/index/1')?>">Belum bayar</a></div>
			<div class="col-sm-2 tcenter"<?php if($filter==2) echo ' style="background-color: #5BC0DE"'?>><a<?php if($filter==2) echo ' style="color: #ffffff"'?> href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/index/2')?>">Belum selesai</a></div>
			<div class="col-sm-2 tcenter"<?php if($filter==3) echo ' style="background-color: #F0AD4E"'?>><a<?php if($filter==3) echo ' style="color: #ffffff"'?> href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/index/3')?>">Belum diambil</a></div>
			<div class="col-sm-2 tcenter"<?php if($filter==4) echo ' style="background-color: #5CB85C"'?>><a<?php if($filter==4) echo ' style="color: #ffffff"'?> href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/index/4')?>">Sudah diambil</a></div>
		</div>
		<div class="row">
			<div class="col-sm-9">Untuk mengurutkan lebih dari satu kolom, tahan tombol [Shift] selagi meng-klik kolom</div>			
		</div>
		<div class="row">&nbsp;</div>
		<div class="table-responsive">
		<table class="table table-bordered table-striped responsive-utilities" id="data">
			<thead>
				<tr>
					<th>Pengajuan</th>
					<th>NIM, Nama &amp; Prodi</th>
					<th>Layanan</th>
					<th>Pembayaran</th>
					<th>Status</th>					
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($pengajuan->result() as $m): ?>	
				<tr>
					<td><?php echo $m->waktu_pengajuan?></td>
					<td><?php echo $m->nim?><br />
					<?php echo $m->nama?>
					<?php echo $m->prodi?></td>
					<td>
						<table class="table table-striped">
							<tr>
								<th>Jml</th>
								<th>Layanan</th>
								<th colspan="2" nowrap="nowrap">Biaya satuan</th>
								<th colspan="2">Subtotal</th>
							</tr>
						<?php $total = 0;foreach($detail[$m->id_pengajuan] as $item): 
								echo 
								'<tr><td class="tright">'.$item->jumlah.'</td>'.
								'<td class="">'.$item->nama_layanan.'</td>'.
								'<td class="tright">Rp</td>'.
								'<td class="tright">'.$this->tools->angka($item->biaya_satuan).'</td>'.
								'<td class="">Rp</td>'.
								'<td class="tright">'.$this->tools->angka($item->jumlah*$item->biaya_satuan).'</td></tr>';
								$total +=$item->jumlah*$item->biaya_satuan;
						endforeach; ?>		
						</table>					
						
					</td>
					<td class="tright"><?php echo $this->tools->uang($total)?></td>
					<td>
						<?php switch($m->status)
						{
							case 1: echo '<span class="label label-default">'.$m->status.'. Pengajuan, belum bayar</span><br/>';

								if (!empty($m->bukti_transfer)) {
									echo '<br/>bukti pembayaran: 
										<a href="'.base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/b_transfer/'.$m->nim).'" data-toggle="modal" data-target="#modals" class="btn btn-success">Sudah diupload</a>
										';
								}else{
									echo '<br/>bukti pembayaran: 
										<a href="'.base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/b_transfer/'.$m->nim).'" data-toggle="modal" data-target="#modals" class="btn btn-danger">Belum diupload</a>
										';
								}
							break;
							case 2: echo '<span class="label label-info">'.$m->status.'. Sudah bayar, belum selesai</span><br/>';
								if (!empty($m->bukti_transfer)) {
									echo '<br/>bukti pembayaran: 
										<a href="'.base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/b_transfer/'.$m->nim).'" data-toggle="modal" data-target="#modals" class="btn btn-success">Sudah diupload</a>
										';
								}else{
									echo '<br/>bukti pembayaran: 
										<a href="'.base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/b_transfer/'.$m->nim).'" data-toggle="modal" data-target="#modals" class="btn btn-danger">Belum diupload</a>
										';
								}
							break;
							case 3: echo '<span class="label label-warning">'.$m->status.'. Sudah selesai, belum diambil</span><br/>';
								
								foreach($pos as $kurir):
									if (!empty($kurir->id_pengajuan) == $m->id_pengajuan) {
								  		echo'<span class="label label-info">Dikirim Via Kurir</span><br/>';
									}else{
										echo'<span class="label label-danger">Tidak Via Kurir</span><br/>';
									}
								endforeach;
							
								if (!empty($m->bukti_transfer)) {
									echo '<br/>bukti pembayaran: 
										<a href="'.base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/b_transfer/'.$m->nim).'" data-toggle="modal" data-target="#modals" class="btn btn-success">Sudah diupload</a>
										';
								}else{
									echo '<br/>bukti pembayaran: 
										<a href="'.base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/b_transfer/'.$m->nim).'" data-toggle="modal" data-target="#modals" class="btn btn-danger">Belum diupload</a>
										';
								}

							break;
							case 4: echo '<span class="label label-success">'.$m->status.'. Sudah diambil</span><br/>';
								
								foreach($pos as $kurir):
									if (!empty($kurir->id_pengajuan) == $m->id_pengajuan) {
								  		echo'<span class="label label-info">Dikirim Via Kurir</span><br/>';
									}else{
										echo'<span class="label label-danger">Tidak Via Kurir</span><br/>';
									}
								endforeach;

								if (!empty($m->bukti_transfer)) {
									echo '<br/>bukti pembayaran: 
										<a href="'.base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/b_transfer/'.$m->nim).'" data-toggle="modal" data-target="#modals" class="btn btn-success">Sudah diupload</a>
										';
								}else{
									echo '<br/>bukti pembayaran: 
										<a href="'.base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/b_transfer/'.$m->nim).'" data-toggle="modal" data-target="#modals" class="btn btn-danger">Belum diupload</a>
										';
								}
							break;
							
						}?>
					</td>
					<td>
						<?php switch($m->status)
						{
							case 1: 
							if($this->session->userdata('logged_as')['role']=='keu' || $this->session->userdata('logged_as')['role']=='adm'){
							echo '<a href="'.base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/submit_bayar/'.$m->nim.'/'.$m->id_pengajuan).'" class="btn btn-default">Bayar</a>'; }
							break;
							case 2: 
							if($this->session->userdata('logged_as')['role']=='akd' || $this->session->userdata('logged_as')['role']=='adm'){
							echo '<a href="'.base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/submit_selesai/'.$m->nim.'/'.$m->id_pengajuan).'" class="btn btn-info">Set Selesai</a>'; }
							break;
							case 3: 
							if($this->session->userdata('logged_as')['role']=='akd' || $this->session->userdata('logged_as')['role']=='adm') {
							echo '<a href="'.base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/submit_ambil/'.$m->nim.'/'.$m->id_pengajuan).'" class="btn btn-warning">Sudah diambil</a>'; 

							echo '<a href="'.base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/ekspedisi/'.$m->nim.'/'.$m->id_pengajuan).'" data-toggle="modal" data-target="#modals" class="btn btn-primary" style="margin-top: 10px">Kirim Via Kurir</a>';
							}
							break;							
						}?>
					</td>					
				</tr>			
			<?php endforeach; ?>
			</tbody>
		</table>			
		</div>
		<div class="row">&nbsp;</div>
		<div class="row">
			<div class="col-sm-12">
				Status:
				<span class="label label-default">1. Pengajuan, belum bayar</span> &raquo;
				<span class="label label-info">2. Sudah bayar, belum selesai</span> &raquo;
				<span class="label label-warning">3. Sudah selesai, belum diambil</span> &raquo;
				<span class="label label-success">4. Sudah diambil</span>
			</div>
		</div>
		</form>
	  <div class="row">&nbsp;</div>
	</div>

	<!-- Modal -->
		<div class="modal fade" id="modals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header"></div>
		      <div class="modal-body"></div>		      
		     </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
<!-- 

<script type="text/javascript">
	$(function(){
		$.get('<?= site_url('ongkir/get_provinsi')?>',{},(response)=>{
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
			$.get("<?= site_url('ongkir/get_kota/')?>/"+id_provinsi_asal,{},(response)=>{
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
		$.get("<?= site_url('ongkir/get_biaya/')?>"+`/${asal}/${tujuan}/${berat}/${kurir}`,{},(response)=>{
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