    <div class="container">        
		<div class="row">
			<div class="col-sm-3"><h3>Data tracer study</h3></div>			
			<div class="col-sm-6"><br /><br />Untuk mengurutkan lebih dari satu kolom, tahan tombol [Shift] selagi meng-klik kolom</div>			

		</div>
		<div class="table-responsive">
		<table class="table table-bordered table-striped responsive-utilities" id="data">
			<thead>
				<tr>
					<th>Pertanyaan</th>
					<th>Jawaban</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($pertanyaan as $q): ?>	
				<tr>
					<td><?php echo $q->label?></td>
					<td><span class="col-sm-12">
						<?php foreach((array)$jawaban[$q->id_form] as $jwb):?>
							
						<span class="col-sm-1 tright"> <?php echo $jwb->jml>0?$jwb->jml:'0'; ?></span> <span class="col-sm-6"><?php echo $jwb->data; ?></span> <br />
						<?php endforeach;?>
						</span>
					</td>
				</tr>			
			<?php endforeach; ?>
			</tbody>
		</table>			
		</div>
	</div>
	<br/>