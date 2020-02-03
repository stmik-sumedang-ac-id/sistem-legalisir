		<div class="container">      
			<div class="row">
				<div class="col-md-12">
					<h3>Data tracer study</h3>					
					<table class="table table-striped">
						<?php foreach($forms->result() as $form): ?>
						<tr>
							<th class="col-md-3"><?php echo $form->label ?></th>
							<td><?php echo $form->data; ?></td>
						</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 tright">
					<a href="<?php echo base_url($this->uri->segment(1).'/dashboard')?>" class="btn btn-primary">&laquo; Kembali ke dashboard</a>
				</div>
			</div>
		</div>
		<br/>d