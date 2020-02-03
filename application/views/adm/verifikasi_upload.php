		 <?php
		 if ($this->session->flashdata('berhasil')) {
		 	echo'
		 	<script>alert("'.$this->session->flashdata('berhasil').'")</script>
		 	';
		 }elseif($this->session->flashdata('gagal')){
		 	echo'
		 	<script>alert("'.$this->session->flashdata('gagal').'")</script>
		 	';
		 }
		 ?>
		 <div class="container">
		 	<h3>Upload dokumen mahasiswa: <?php echo $mhs->nama?></h3>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped">
						<tr>
							<th class="col-md-1"><a class="btn btn-danger" href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class())?>">&laquo; Kembali</a></th>
							<th class="col-md-2 tright">No. Ijazah: </th>
							<td class="col-md-2"><?php echo $mhs->no_ijazah?></td>
							<th class="col-md-1 tright">File Ijazah:</th>
							<td class="col-md-3"><a target="_blank" href="<?php echo base_url('uploads/ijazah/'.$mhs->file_ijazah)?>"><?php echo $mhs->file_ijazah?></a></td>				
							<th class="col-md-2 tright">Program studi: </th>
							<td><?php echo $mhs->prodi?></td>
						</tr>
						<tr>
							<td class="col-md-1"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viapos">Kirim Via Kurir</button></td>
							<td>
							<?php if (!empty($pos->no_ijazah) == $mhs->no_ijazah) {
								echo'Status : <span class="label label-primary">Dokumen dikirim via Kurir</span>';
							}else{
								echo'Status : <span class="label label-danger">Dokumen tidak dikirim via Kurir</span>';
							}?>
							</td>
							
							<td><button class="btn btn-primary" data-toggle="modal" data-target="#bukti-transfer">Bukti Pembayaran</button></td>
							<?php foreach($bayar as $byr);
								if(!empty($byr->bukti_transfer)){
									echo '<td>Status: <span class="label label-success">Sudah diupload</span></td>';
							 	}else{
									echo '<td>Status: <span class="label label-danger">Belum diupload</span></td>';
								}
							?>
						</tr>		
					</table>
				</div>
			</div>
			 
			  <?php foreach($layanan as $l): ?>
			  <form class="form-horizontal" role="form" action="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/upload_doc')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">			  
				  <div class="form-group" style="border-bottom: 1px solid #cccccc;padding-bottom: 5px;">
				    
					<label for="nim" class="col-sm-1">
						<?php if(in_array($l->id_layanan,$uploaded)): ?>
						<a class="btn btn-success btn-xs" href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/download/'.$l->id_layanan.'/'.$mhs->no_ijazah)?>"><i class="glyphicon glyphicon-download"></i> Download</a> 
						<?php endif; ?>
					</label>
										
				    <label for="nim" class="col-sm-5">Dokumen <?php echo $l->nama_layanan?></label>
				    <div class="col-sm-5">
				      	<div style="position:relative;">
						        <a class='btn btn-primary' href='javascript:;'>
						            Choose File...
						            <input name="filenya" type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info-<?php echo $l->id_layanan?>").html($(this).val());'>
									<input type="hidden" name="layanan" value="<?php echo $l->id_layanan?>" />
									<input type="hidden" name="ijazah" value="<?php echo $mhs->no_ijazah?>" />
						        </a>
						        <span class='label label-info' id="upload-file-info-<?php echo $l->id_layanan?>"></span>
						</div>
				    </div>
				  	<div class="col-sm-1">
			      		<button type="submit" class="btn btn-primary">Upload</button>
			    	</div>
			  	</div>				 
			</form>
			<?php endforeach; ?>
		</div>

<div class="modal fade" id="bukti-transfer" aria-hidden="true" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Bukti Pembayaran</h4>
			</div>
			<div class="modal-body">
				<?php
				if (!empty($byr->bukti_transfer)) {
					echo '<img style="width: 100%;height: 100%" src="'.base_url().'uploads/bukti_transfer/'.$byr->bukti_transfer.'">';	
				}else{
					echo 'Status: <span class="label label-warning">Belum diupload</span>';
				}
				?>
				
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="viapos" aria-hidden="true" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">				
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Kirim Via Kurir</h4>
			</div>
			<div class="modal-body">
            	<div class="panel-body">
	            	<form method="post" action="<?php echo base_url('adm/verifikasi/addpos')?>">
	            		<input type="hidden" name="no_ijazah" value="<?php echo $mhs->no_ijazah?>">
	            		<input type="hidden" name="nim" value="<?php echo $mhs->nim?>">
	            		<input type="hidden" name="nama" value="<?php echo $mhs->nama?>">
	                	

	                	<div class="form-group">
	                    	<label for="provinsi_asal">Provinsi Asal </label>
	                    	<select onchange="get_kota('asal')" required class="form-control provinsi" name="provinsi_asal" id="provinsi_asal">
	                    		
	                    	</select>
	                	</div>
	                	<div class="form-group">
	                    	<label for="kota_asal">Kota Asal </label>
	                    	<select id="kota_asal" required class="form-control" name="kota_asal" >
	                    	</select>
	                	</div>
	                	<hr>
	                	<hr>
	                <div class="form-group">
	                    <label for="provinsi_tujuan">Provinsi Tujuan </label><br>    
	                    <select onchange="get_kota('tujuan')" required class="form-control provinsi" name="provinsi_tujuan" id="provinsi_tujuan">
	                    </select>
	                </div>

	            	<div class="form-group">
	                	<label for="kota_tujuan">Kota Tujuan </label><br>
	                	<select required class="form-control" name="kota_tujuan" id="kota_tujuan">
	                	</select>
	            	</div>

	            	<div class="form-group">
	                    	<label for="alamat">Alamat Lengkap</label>
	                    	<textarea class="form-control" name="alamat_lengkap"><?php echo $mhs->alamat?></textarea>
	                </div>

	            	<div class="form-group">
	            		<label for="berat">Berat (bulatkan ke dalam kg)</label>
	            		<input type="number" name="berat" id="berat" class="form-control">
	            	</div>

	            	<div class="form-group">
	            		<label for="kurir">Kurir</label>
	            		<select onchange="get_ongkir()" name="kurir" id="kurir" class="form-control">
	            			<option selected="" disabled="">-- Pilih Kurir --</option>
	            			<option value="jne">JNE</option>
	            			<option value="pos">POS</option>
	            			<option value="tiki">TIKI</option>
	            		</select>
	            	</div>

	            	<div class="form-group">
	            		<label for="service">Service</label>
	            		<select name="service" id="service" class="form-control">
	            			
	            		</select>
	            	</div>

	            	<div class="form-group">
	            		<input type="submit" name="submit" value="Submit" class="btn btn-primary">
	            	</div>
	            </form>
				</div>
			</div>
		</div>
	</div>
</div>

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
	
</script>