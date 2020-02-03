    <div class="container">    
		
      <div class="row">
        <h3>Laporan tracer study</h3>
		<form class="form-horizontal" role="form" action="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/filter')?>" method="post">
		<div class="row">
			<div class="col-sm-1 control-label">Tampilkan: </div>
			<div class="col-sm-2">
			<label class="control-label"><input type="checkbox" name="unver" value="1" /> Telah diverifikasi</label><br />
			</div>
			<label class="col-sm-2 control-label">Tahun registrasi</label> 
			<div class="col-sm-2"><select name="t" class="form-control"><option>2013</option></select></div>
			
		</div>
		<div class="row">			
			<div class="col-sm-offset-1 col-sm-2">
			<label class="control-label"><input type="checkbox" name="ver" value="1" /> Belum diverifikasi</label></div>
			<label class="col-sm-2 control-label">Tampilkan</label> 
			<div class="col-sm-2"><select name="t" class="form-control"><option>Seluruhnya</option><option>Per-prodi</option></select></div>			
		</div>
		<div class="row">
			<div class="col-sm-offset-5 tright col-sm-2" style="padding-top:5px"><button class="btn btn-primary">Tampilkan</button></div>
		</div>
		</form>
		<h4 class="tcenter">Laporan Registrasi Aplikasi Legalisir Tahun 2013 Seluruh Prodi</h4>
		<div class="row">
			<div class="col-sm-6">
				<div id="ChartDiv" class="ajax" style="width:580px;height:400px;display:inline-block"></div>
			</div>
			<div class="col-sm-5">
				<table class="table table-striped table-bordered">
					<tr>
						<th class="tcenter">Bulan</th>
						<th class="tcenter">Jumlah</th>
					</tr>
					<tr>
						<td class="tcenter">Januari</td>
						<td class="tright">15</td>
					</tr>
					<tr>
						<td class="tcenter">Februari</td>
						<td class="tright">30</td>
					</tr>
				</table>
			</div>
		</div>			
	  </div>
	</div>