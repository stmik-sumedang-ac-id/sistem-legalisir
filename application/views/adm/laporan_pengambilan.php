    <div class="container">    
		
      <div class="row">
        <h3>Laporan pengambilan legalisir/ transkrip</h3>
		<form class="form-horizontal" role="form" action="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/filter')?>" method="post">
		<div class="row">
			
			<label class="col-sm-2 control-label">Tahun registrasi</label> 
			<div class="col-sm-2"><select name="t" class="form-control">
			<option <?php if($tahun == 2016) echo 'selected'; ?>>2016</option>
			<option <?php if($tahun == 2017) echo 'selected'; ?>>2017</option>
			<option <?php if($tahun == 2018) echo 'selected'; ?>>2018</option>
			<option <?php if($tahun == 2019) echo 'selected'; ?>>2019</option>
			</select></div>
				<div class=" tright col-sm-2" ><button class="btn btn-primary">Tampilkan</button></div>
			
		</div>
		</form>
		<h4 class="tcenter">Laporan Pengambilan Aplikasi Legalisir Tahun <?= $tahun?> Seluruh Prodi</h4>
		<div class="row">
			<div class="col-sm-6">
				<div id="ChartDiv" class="ajax" style="width:580px;height:400px;display:inline-block"></div>
			</div>
			<div class="col-sm-5">
				<table class="table table-striped table-bordered">
					<tr>
						<th class="tcenter">Bulan</th>
						<th class="tcenter">Belum Diambil</th>
						<th class="tcenter">Sudah Diambil</th>
						<th class="tcenter">Jumlah</th>
					</tr>
					<?php foreach($report as $item) {?>
					<tr>
						<td class="tcenter"><?= $item->bln?></td>
						<td class="tright"><?= $item->belum_diambil;?></td>
						<td class="tright"><?= $item->sudah_diambil;?></td>
						<td class="tright"><?= $item->belum_diambil+$item->sudah_diambil;?></td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</div>			
	  </div>
	</div>