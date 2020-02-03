		<div class="container">      
			<br />
			<h3>Pratinjau formulir tracer study</h3>
			<div class="row">
				<form class="form-horizontal">
					<div class="col-md-12">
					<!-- content starts -->					
					 	<?php if(is_array($forms->result())): ?>
						<?php 
						$jml = count($forms->result());
						$i=1;
						foreach($forms->result() as $element):?>
						<div class="form-group">
							<label class="col-sm-3 control-label" style="width:300px;" for="prependedInput"><?php echo ($element->mandatory=='1')?'* ':''; ?><?php echo $element->label?></label>
							<div class="col-sm-5">
							<?php								
								switch($element->tipedata){
									case 'singleword':
									case 'text':?><input name="elemen[<?php echo $element->id_form?>]" size="36" type="text" class="form-control"/><?php break;
									case 'url':?>
										<div class="input-group">
									        <span class="input-group-addon">http://</span>
									        <input name="elemen[<?php echo $element->id_form?>]" size="36" type="text" class="form-control"/>
									      </div>
									<?php
										break;
									case 'email':?><input name="elemen[<?php echo $element->id_form?>]" size="36" type="text" class="form-control"/><?php break;
									case 'date':?><input name="elemen[<?php echo $element->id_form?>]" size="36" type="text" class="form-control datepicker"/><?php break;
									case 'number':?><input name="elemen[<?php echo $element->id_form?>]" size="36" type="text" class="form-control"/><?php break;
									case 'decimal':?><input name="elemen[<?php echo $element->id_form?>]" size="36" type="text"  class="form-control"/><?php break;
									case 'longtext':?><textarea class="form-control" rows="7" name="elemen[<?php echo $element->id_form?>]"></textarea><?php break;
									case 'radio':?>
										<?php if(!empty($options[$element->id_form])):?>														
										<?php foreach($options[$element->id_form] as $opt): ?>														
											<label class="radio">
												<div class="radio">
													<span class="checked">
														<?php unset($terpilih);$terpilih = (isset($selectedOptions[$element->id_form][$opt['id']]) && $selectedOptions[$element->id_form][$opt['id']]==$opt['value'])?'1':'0'; ?><input name="elemen[<?php echo $element->id_form?>]" value="<?php echo $opt['id']?>" <?php echo $terpilih=='1'?'checked=""':''?> <?php echo ($opt['selected_value']=='1')?'checked=""':''?> type="radio">
													</span>																	
													<?php echo $opt['label']?>  
												</div>
										  	</label>											
										<?php endforeach; ?>														
										<?php endif;?>
								  	<?php break;
									case 'check':?>
										<?php if(!empty($options[$element->id_form])):?>
										<?php foreach($options[$element->id_form] as $opt): ?>														
											<label class="checkbox inline">
												<div class="checker">
													<?php unset($terpilih);$terpilih = (isset($selectedOptions[$element->id_form][$opt['id']]) && $selectedOptions[$element->id_form][$opt['id']]==$opt['value'])?'1':'0'; ?>
													<input name="elemen[<?php echo $element->id_form?>][<?php echo $opt['id']?>]"  value="<?php echo $opt['value']?>" <?php echo $terpilih=='1'?'checked=""':''?> <?php echo ($opt['selected_value']=='1'&&$jmlTerisi==0)?'checked=""':''?> type="checkbox">
												</div>
												<?php echo $opt['label']?>  																
											</label>
											<div style="clear:both"></div>
										<?php endforeach; ?>
										<?php endif;?>
									<?php break;
									case 'combo':?>
										<?php if(!empty($options[$element->id_form])):?>
										<select name="elemen[<?php echo $element->id_form?>]"  class="form-control">
										<?php foreach($options[$element->id_form] as $opt): ?>
											<?php unset($terpilih);$terpilih = (isset($selectedOptions[$element->id_form][$opt['id']]) && $selectedOptions[$element->id_form][$opt['id']]==$opt['value'])?'1':'0'; ?>
											<option value="<?php echo $opt['id']?>" <?php echo $opt['selected_value']=='1'?'selected=""':''?> <?php echo $terpilih=='1'?'selected=""':''?> <?php echo ($opt['selected_value']=='1')?'selected=""':''?>>
											<?php echo $opt['label']?>
											</option>
										<?php endforeach; ?>
										</select>
										<?php endif;?>
										
									<?php break;
								}
							?>										  
							  <span class="help-inline"><?php echo $element->instruksi?></span>
							</div>
						</div>
						<?php $i++;endforeach;?>
						 <div class="form-actions">
						 	<div class="row">										
								<div class="col-md-3"><a href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class())?>" class="btn btn-info pull-right"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a> </div>
								<div class="col-md-offset-2 col-md-3"><button type="button" class="btn btn-primary pull-right">Submit formulir tracer study</button></div>
							</div>
						  </div>
						<?php endif;?>					
					<!-- content ends -->
					</div><!--/#content.span10-->
				</form>
			</div>
		</div>
		<br/>