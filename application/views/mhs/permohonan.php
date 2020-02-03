    <div class="container">      
      <div class="row">
	  	<div class="col-sm-6">
	  		<br/>
        <h3>Membuat permohonan legalisir</h3>
		</div>
	  </div>
	  <div class="row">
	  	<div class="col-sm-9">
			<?php if($this->session->flashdata('msg_warning')):
			echo '<div class="alert alert-warning alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				  <strong>Terjadi kesalahan!</strong> '.$this->session->flashdata('msg_warning').'</div>';
			endif;
			?>
			<!-- <?php echo form_open('mhs/permohonan/alternatif', 'name=alternatif', 'id=alternatif')?> -->
        	<?php echo form_open('mhs/permohonan/confirm')?>
			<table class="table table-striped">
				<tr>
					<th>NIM</th>
					<td colspan="3"><?php echo $this->session->userdata('logged_as')['nim']?></td>
				</tr>
				<tr>
					<th>Nama</th>
					<td colspan="3"><?php echo $this->session->userdata('logged_as')['nama']?></td>
				</tr>
				<tr>
					<th>Program studi</th>
					<td colspan="3"><?php echo $this->session->userdata('logged_as')['prodi']?></td>
				</tr>	
			</table>
			<div class="alert alert-info col-sm-offset-1">
				<p>Bila layanan tidak bisa di gunakan berarti dokumen anda belum terupload di sistem, silahkan hubungi akademik untuk info lebih lanjut</p>
			</div>

			<table class="table table-striped col-sm-offset-1 table-responsive">
				<tr>					
					<th class="col-sm-1">Qty</th>
					<th class="col-sm-5">Permohonan</th>
					<th class="col-sm-1">Biaya</th>
					<th class="col-sm-2">Total</th>
				</tr>
				<!-- auto -->
				<tr>
					<td><input  type="checkbox" name="qtkirim" value="1" id="qtkirim" class="form-control"></td>
					<td>
						Kirim Via Kurir
						<div id="layanan_pos" style="display: none">
							<label>Kurir</label>
							<select  onchange="get_ongkir()" id="kurir" class="form-control" name="kurir">
								<option disabled selected>-- Pilih Kurir --</option>
								<option value="jne">JNE</option>
		            			<option value="pos">POS</option>
		            			<option value="tiki">TIKI</option>
							</select>
							<label>Layanan</label>
							<select name="service" id="service" class="form-control"></select>
							<input type="hidden" name="layananKurir" id="layananKurir">
						</div>
					</td>
					<td class="tright">
						<p id="ongkoskirim">Rp 0</p>
					</td>
					<td class="tright">
						<div class="input-group">
							<span class="input-group-addon">Rp</span>
							<input  dir="rtl" name="prcongkir" id="ongkos" value="0" class="form-control" readonly />
						</div>
					</td>
				</tr>
				<!-- auto -->
				<?php foreach($layanan->result() as $svc): ?>
				<tr>
					<td>
						<?php if($svc->max_qty==1): ?>
						<input value="1" name="qty_<?php echo $svc->id_layanan ?>" type="checkbox" id="qty_<?php echo $svc->id_layanan ?>" class="form-control"/>
						<?php else: ?>
						<input value="0" name="qty_<?php echo $svc->id_layanan ?>" <?php if(!in_array($svc->id_layanan,$uploaded)) {echo 'disabled';} ?> type="text" id="qty_<?php echo $svc->id_layanan ?>" class="form-control price"/>
						<?php endif; ?>
					</td>
					<td><?php echo $svc->nama_layanan ?></td>
					<td class="tright"><?php echo $this->tools->uang($svc->biaya) ?></td>
					<td class="tright">
						<div class="input-group">
						  <span class="input-group-addon">Rp</span>
							<input dir="rtl" name="price_<?php echo $svc->id_layanan ?>" id="t_<?php echo $svc->id_layanan ?>" value="0" class="form-control" disabled/>
						</div>
					</td>
				</tr>
				<?php endforeach; ?>
				<tr>
					<th class="tright" colspan="3">TOTAL</th>
					<td>
						<div class="input-group">
						  <span class="input-group-addon">Rp</span>
							<input dir="rtl" id="total" value="0" class="form-control" disabled/>
						</div>
					</td>
				</tr>
			</table>
			

			<table class="table table-striped">			
				<tr>					
					<td colspan="2" class="tright">
						<button  onclick="kirim()" type="submit" class="btn btn-primary">Berikutnya, konfirmasi &raquo;</button>
						<!-- <input type="submit" id="input_alternatif" style="display:none;" form="alternatif"> -->
					</td>
				</tr>
			</table>
			</form>
		</div>
	  </div>
	</div>
<?php foreach($mahasiswa as $mhs){?>
	<script type="text/javascript">
		function kirim(){
			document.alternatif.submit();
		}

		function get_ongkir(){
			let berat = 1;
			let asal = 440; //440 adalah kota sumedang di API RajaOngkir
			let tujuan = <?= $mhs->kota?>;
			//console.log(tujuan);
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
							output+=`<option value="${val.value}">${jenis_layanan} -- Rp.${val.value} ${val.etd} Hari
							</option>`
						})
					}
				})
				$(`#service`).html(output)
			});
		}

		
		$('#qtkirim').click(function(){
			var x = document.getElementById('layanan_pos');

			if ($('#qtkirim').is(':checked')) {
				//$('#ongkos').val(numberWithCommas(10000));
				//$('#ongkoskirim').val(numberWithCommas(ongkos));			
				x.style.display = 'block';
				// $('#total').val(numberWithCommas(0));
			}else{
				$('#ongkos').val(numberWithCommas(0));
				// $('#total').val(numberWithCommas(0));
				document.getElementById('ongkoskirim').innerHTML = 'Rp '+ numberWithCommas(0);
				x.style.display = 'none';
			}
		});

		
		$('#service').click(function(){
			var e = document.getElementById('service');
			var ongkos = e.options[e.selectedIndex].value;
			var kata = e.options[e.selectedIndex].text;
			if ($('#service').select()) {

				$('#ongkos').val(numberWithCommas(ongkos));
				$('#total').val(numberWithCommas(ongkos));
				$('#layananKurir').val(kata);
				document.getElementById('ongkoskirim').innerHTML = 'Rp '+ numberWithCommas(ongkos);
			}else{
				$('#ongkos').val(numberWithCommas(0));
				// $('#total').val(numberWithCommas(0));
				document.getElementById('layananKurir').innerHTML = '';
				document.getElementById('ongkoskirim').innerHTML = 'Rp '+ numberWithCommas(0);
			}
		});

		
		// $('input[name*="qty"]').keyup(function(){
		// 	var sum = 0;
		// 	var ong_kir = parseInt(removeComma($('#ongkos').val()));

		// 	$("input[name^='price_']").each(function(){
		// 		var number = parseInt(removeComma(this.value));
		// 		sum += number;
		// 	});
			
		// 	var jumlah = sum+ong_kir;
		// 	console.log(jumlah);
			
		// 	$('#total').val(numberWithCommas(jumlah));
		// });

		// $('input[name*="qty"]').click(function(){
		// 	var sum = 0;
		// 	var ong_kir = parseInt(removeComma($('#ongkos').val()));

		// 	$("input[name^='price_']").each(function(){
		// 		var number = parseInt(removeComma(this.value));
		// 		sum += number;
		// 	});
			
		// 	var jumlah = sum+ong_kir;
		// 	console.log(jumlah);
			
		// 	$('#total').val(numberWithCommas(sum));
		// });

	</script>
<?php }?>




