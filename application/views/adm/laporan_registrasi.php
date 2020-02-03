    <div class="container">    
		
      <div class="row">
        <h3>Laporan registrasi</h3>
		<form class="form-horizontal" role="form" action="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/filter')?>" method="post">
		<div class="row">
			<label class="col-sm-2 control-label">Tahun registrasi</label> 
			<div class="col-sm-2"><select name="y" class="form-control">
			<option <?php if($tahun == 2016) echo 'selected'?> value="2016">2016</option>
			<option <?php if($tahun == 2017) echo 'selected'?> value="2017">2017</option>
			<option <?php if($tahun == 2018) echo 'selected'?> value="2018">2018</option>
			<option <?php if($tahun == 2019) echo 'selected'?> value="2019">2019</option>

			</select></div>
			<div class="col-sm-2">
				<div class="tright col-sm-4" style=""><button class="btn btn-primary">Tampilkan</button></div>
				</div>
			
		</div>
		
		</form>
		<h4 class="tcenter">Laporan Registrasi Aplikasi Legalisir Tahun <?= $tahun;?> Seluruh Prodi</h4>
		<div class="row">
			<div class="col-sm-7">
				<div id="ChartDiv" class="ajax" style="width:640px;height:400px;display:inline-block"></div>
			</div>
			<div class="col-sm-5">
				
				<table class="table table-striped table-bordered">
					<tr>
						<th class="tcenter">Bulan</th>
						<th class="tcenter">Diverifikasi</th>
						<th class="tcenter">Belum diverifikasi</th>
						<th class="tcenter">Total</th>
						<th class="tcenter">% verifikasi</th>
					</tr>
					<?php $total = 0;$total_ver = 0;$total_unver = 0; foreach($report as $item){ ?>
						  	<tr>
								<td><?php echo $item->bln?></td>
								<td class="tright"><?php echo $this->tools->angka($item->verified)?></td>
								<td class="tright"><?php echo $this->tools->angka($item->unverified)?></td>
								<td class="tright"><?php echo $this->tools->angka($item->verified+$item->unverified);
								$total += $item->verified+$item->unverified;
								$total_unver += $item->unverified;
								$total_ver += $item->verified;?></td>
								<td class="tright"><?php echo round($item->verified+$item->unverified>0?($item->verified/($item->verified+$item->unverified)*100):0,2).'%'?></td>
							</tr>	
						  <?php 
						  }
						  ?>
						  <tr style="font-weight: bold;border-top: 2px solid #333333">
						  	<td class="tright">TOTAL</td>
						  	<td class="tright"><?php echo $this->tools->angka($total_ver)?></td>
						  	<td class="tright"><?php echo $this->tools->angka($total_unver)?></td>
						  	<td class="tright"><?php echo $this->tools->angka($total)?></td>
						  	<td class="tright"><?php echo round($total>0?($total_ver/($total_ver+$total_unver)*100):0,2).'%'?></td>
						  </tr>					
				</table>
			</div>
		</div>			
	  </div>
	</div>