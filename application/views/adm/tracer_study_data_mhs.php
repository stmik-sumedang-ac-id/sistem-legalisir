    <div class="container">        
		<form class="form-horizontal" method="post" action="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/filter')?>">
		<div class="row">
			<div class="col-sm-4"><h3>Data tracer study per mahasiswa</h3></div>
			<div class="col-sm-4 tright"><br />Filter pertanyaan:</div>
			<div class="col-sm-3"><br />				
					<select class="form-control" name="f">
						<option value="all"<?php echo $idform=='all'?' selected="selected"':''?>>Seluruh pertanyaan</option>
					<?php foreach($pertanyaan->result() as $p): ?>
						<option value="<?php echo $p->id_form?>"<?php echo $idform==$p->id_form?' selected="selected"':''?>><?php echo $p->label ?></option>
					<?php endforeach;?>
					</select>
			</div>			
			<div class="col-sm-1"><br />
				<button type="submit" class="btn btn-primary">Filter</button>
			</div>
		</div>
		</form>
		<div class="row">
			<div class="col-sm-12">Untuk mengurutkan lebih dari satu kolom, tahan tombol [Shift] selagi meng-klik kolom</div>			
		</div>
		<div class="table-responsive">
		<table class="table table-bordered table-striped responsive-utilities" id="data">
			<thead>
				<tr>
					<th>Tgl Input</th>
					<th>NIM</th>
					<th>Data Tracer Study</th>
					<th>Prodi</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($mhs->result() as $m): ?>	
				<tr>
					<td><?php echo $m->created_at?></td>
					<td><?php echo $m->no_ijazah?></td>
					<td><span class="col-sm-6 tright"><?php echo $m->label?> :</span><span class="col-sm-6"><?php echo $m->data?></span></td>					
					<td><?php echo $m->jurusan?></td>					
				</tr>			
			<?php endforeach; ?>
			</tbody>
		</table>			
		</div>
	</div>
	<br/>