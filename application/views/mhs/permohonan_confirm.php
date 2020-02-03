<div class="container">      
      <div class="row">
	  	<div class="col-sm-6">
	  		<br/>
        <h3>Konfirmasi permohonan layanan</h3>
		</div>
	  </div>
	  <div class="row">
	  	<div class="col-sm-9">
        	<?php echo form_open('mhs/permohonan/submit')?>
			<table class="table table-striped">
				<tr>
					<th>NIM</th>
					<td><?php echo $this->session->userdata('logged_as')['nim']?></td>
				</tr>
				<tr>
					<th>Nama</th>
					<td><?php echo $this->session->userdata('logged_as')['nama']?></td>
				</tr>
				<tr>
					<th>Program studi</th>
					<td><?php echo $this->session->userdata('logged_as')['prodi']?></td>
				</tr>
			</table>
			<table class="table table-striped col-sm-offset-1">
				<tr>					
					<th class="col-sm-1 tright">Qty</th>
					<th class="col-sm-5">Permohonan</th>
					<th class="col-sm-1" colspan="2">Biaya</th>
					<th class="col-sm-2" colspan="2">Total</th>
				</tr>
				<?php if($qtykirim==1){?>
				<tr>
					<td class="tright"><?php echo $qtykirim?></td>
					<td>kirim via kurir</td>
					<td class="tright">Rp</td>
					<td class="tright"><?php echo $prcongkir?></td>
					<td class="tright">Rp</td>
					<td class="tright"><?php echo $prcongkir?></td>
				</tr>
				<?php }?>
				<?php foreach($permohonan as $svc): 
				if($svc['qty']==0) continue;
				?>
				<tr>
					<td class="tright"><?php echo $svc['qty'];?></td>
					<td><?php echo $svc['nama'];?></td>
					<td class="tright">Rp</td>
					<td class="tright"><?php echo $this->tools->angka($svc['biaya']) ?></td>
					<td class="tright">Rp</td>
					<td class="tright"><?php echo $this->tools->angka($svc['total']) ?></td>
				</tr>
				<?php endforeach; ?>
				<tr>
					<th class="tright" colspan="4">TOTAL</th>
					<td class="tright"><strong>Rp</strong></td>					
					<td class="tright"><strong><?php echo $this->tools->angka($jumlah) ?></strong></td>
				</tr>
			</table>
			<table class="table table-striped">			
				<tr>					
					<td colspan="2" class="tright"><button type="submit" class="btn btn-primary">Submit permohonan &raquo;</button></td>
				</tr>
			</table>
			</form>
		</div>
	  </div>
	</div>