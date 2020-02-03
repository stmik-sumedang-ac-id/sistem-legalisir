		<div class="container">      
			<div class="row">
				<div class="col-md-12">
					<h3>Konfirmasi formulir tracer study</h3>					
					<table class="table table-striped">
						<?php foreach($forms->result() as $form): ?>
						<tr>
							<th class="col-md-3"><?php echo $form->label ?></th>
							<td><?php 
							switch($form->tipedata){
								case 'singleword':
								case 'text':
								case 'longtext':
								case 'email':
								case 'url':
								case 'number':
								case 'decimal':
								case 'date':
									echo $post[$form->id_form];
									break;
								case 'radio':
								case 'check':
								case 'combo':
									echo $options[$post[$form->id_form]];
									break;
							}
							
							?></td>
						</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 tright">
					<a href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/submit')?>" class="btn btn-primary">Ok, Simpan</a>
				</div>
			</div>
		</div>
		<br/>