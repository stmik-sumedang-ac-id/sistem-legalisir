    <div class="container">      
      <div class="row">
        <div class="col-md-6"><h3>Desain formulir tracer study</h3></div>
        <div class="col-md-6 tright">
			<br />
			<a class="btn btn-primary" href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/input')?>">Tambah pertanyaan <i class="glyphicon glyphicon-plus-sign"></i></a>
			<a class="btn btn-success" href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/preview')?>">Pratinjau formulir tracer study <i class="glyphicon glyphicon-play-circle"></i></a>
		</div>
		
		<div id="content" class="span10">
		<!-- content starts -->
			<div class="row">								
				<?php if(is_array($form->result())): ?>
			 	<table class="table ">										
					<tr>
						<th>#</th>
						<th>Label</th>
						<th>Tipe</th>
						<th>Opsi pilihan</th>
						<th>Petunjuk pengisian</th>
						<th></th>
						<th style="width:15%">Aksi</th>
					</tr>									
			  	<?php 
				$jml = count($form->result());
				$i=1;
				foreach($form->result() as $element):?>
				<tr class="<?php echo $element->aktif==1?'success':'active'?>">
					<td style="text-align:right"><?php echo $i?></td>
					<td><?php echo $element->mandatory==1?'*':''?> <?php echo $element->label?></td>
					<td>
						<?php switch($element->tipedata){
							  	case 'singleword': echo 'Kata';break;
								case 'text': echo 'Kalimat';break;
								case 'email': echo 'Alamat email';break;
								case 'url': echo 'Alamat URL';break;
								case 'number': echo 'Angka';break;
								case 'decimal': echo 'Angka desimal';break;
								case 'date': echo 'Tanggal';break;
								case 'check': ?> Pilihan jamak <br />
									<a href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/add_option/'.$element->id_form)?>" data-toggle="modal" data-target="#modals">+ Pilihan</a>
							  		<?php break;
								case 'longtext': echo 'Teks panjang';
							  		break;
								case 'radio': ?>
								Pilihan tunggal (radio)<br />
								<a href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/add_option/'.$element->id_form)?>" data-toggle="modal" data-target="#modals">+ Pilihan</a>
							  		<?php break;
								case 'combo': ?>Pilihan tunggal (combo)<br />
								<a href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/add_option/'.$element->id_form)?>" data-toggle="modal" data-target="#modals">+ Pilihan</a>
								<?php
							  		break;
							  }; ?>										
					</td>
					<td nowrap="nowrap">
						<?php $jml_opt = 0;
						if(!empty($options[$element->id_form])):
						$jml_opt = count($options[$element->id_form]); ?>
							<ul>
							<?php foreach($options[$element->id_form] as $opt): ?>														
								<li style="list-style: none">
									<div class="col-md-5"><?php echo $opt['label']?></div>
									<div class="col-md-1 tcenter"><a title="<?php echo $opt['selected_value']=='1'?'Klik untuk menjadikan bukan pilihan default':'Klik untuk menjadikan pilihan default'?>" href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/toggle_selected/'.$opt['id'])?>"><span class="label label-<?php echo $opt['selected_value']=='1'?'info':'default'?>"><i class="glyphicon glyphicon-check"></i></span> </a></div>
									<?php if($opt['seq']<>1):?><div class="col-md-1 tcenter"><a href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/option_up/'.$opt['id'])?>"><span class="label label-default"><i class="glyphicon glyphicon-chevron-up"></i></span></a> </div><?php else: echo '<div class="col-md-1"></div>';endif; ?>
									<?php if($opt['seq']<>$jml_opt):?><div class="col-md-1 tcenter"><a href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/option_down/'.$opt['id'])?>"><span class="label label-default"><i class="glyphicon glyphicon-chevron-down"></i></span></a> </div><?php else: echo '<div class="col-md-1"></div>';endif; ?>
									<div class="col-md-1 tcenter"><a href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/edit_option/'.$opt['id'])?>" data-toggle="modal" data-target="#modals"><span class="label label-warning"><i class="glyphicon glyphicon-edit"></i></span></a> </div>
									<div class="col-md-1 tcenter"><a href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/del_option_confirm/'.$opt['id'])?>" data-toggle="modal" data-target="#modals"><span class="label label-danger"><i class="glyphicon glyphicon-trash"></i></span></a></div>
								</li>
							<?php endforeach; ?>
							</ul>
						<?php endif;?>
						
					</td>
					<td>
						<?php if($element->instruksi<>''):?>
						<span class="help-inline"><?php echo $element->instruksi?></span>
						<?php endif;?>
					</td>
					<td><span title="<?php echo $element->aktif==1?'Ditampilkan':'Disembunyikan'?>" class="label<?php echo $element->aktif==1?' label-success':' label-danger'?>"><i class="glyphicon glyphicon-eye-<?php echo $element->aktif==1?'open':'close'?>"></i></td>
					<td>
					<div class="btn-group">
		  				<a class="btn btn-primary" href="#"><i class="glyphicon glyphicon-cog"></i></a>
						<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
						  <ul class="dropdown-menu">
							<?php if($element->seq<>1): ?><li><a href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/up/'.$element->id_form)?>"><i class="glyphicon glyphicon-chevron-up"></i> Naik</a></li><?php endif; ?>
							<?php if($i<>$jml): ?><li><a href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/down/'.$element->id_form)?>"><i class="glyphicon glyphicon-chevron-down"></i> Turun</a></li><?php endif; ?>													
							<li><a href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/edit/'.$element->id_form)?>"><i class="glyphicon glyphicon-edit"></i> Ubah</a></li>													
							<li><a href="<?php echo base_url($this->uri->segment(1).'/'.$this->router->fetch_class().'/del_element_confirm/'.$element->id_form)?>" data-toggle="modal" data-target="#modals"><i class="glyphicon glyphicon-trash"></i> Hapus</a></li>
						  </ul>		
					</div>									
					</td>											
				</tr>																																																													
				<?php $i++;endforeach;?>
				</table>
				<div class="row" style="background:#efefef;padding:3px">
								<div class="col-md-1 tcenter">
								Keterangan: 
								</div>
								<div class="col-md-1 tcenter">
								* Wajib diisi<br />
								</div>
								<div class="col-md-2 tcenter">
								<span class="label label-primary"><i class="glyphicon glyphicon-check"></i></span> / <span class="label label-default"><i class="glyphicon glyphicon-check"></i></span><br />Opsi default / bukan
								</div>
								<div class="col-md-1 tcenter">
								<span class="label label-warning"><i class="glyphicon glyphicon-edit"></i></span><br />Ubah opsi
								</div>
								<div class="col-md-1 tcenter">
								<span class="label label-danger"><i class="glyphicon glyphicon-trash"></i></span><br />Hapus opsi
								</div>
								<div class="col-md-3 tcenter">
								<span class="label label-success"><i class="glyphicon glyphicon-eye-open"></i></span> / <span class="label label-danger"><i class="glyphicon glyphicon-eye-open"></i></span><br />Ditampilkan / Disembunyikan
								</div>	
							</div>
				<br />
				<?php endif;?>
			</div><!--/row-->		    
		<!-- content ends -->
		</div><!--/#content.span10-->
	  </div>
	</div>
	

		<!-- Modal -->
		<div class="modal fade" id="modals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header"></div>
		      <div class="modal-body"></div>		      
		     </div>
		    </div>
		  </div>

 