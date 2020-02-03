   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
	<script src="<?php echo base_url() ?>js/jquery-1.10.2.min.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>    
	<?php 
	if(isset($customJsSource) && is_array($customJsSource) && !empty($customJsSource)): 
		foreach($customJsSource as $src): ?>
		<script src="<?php echo base_url() ?>js/<?php echo $src ?>"></script>
	<?php 
		endforeach; 
	endif; ?>	
	<?php 
		if(isset($customJs)): ?>
		<script type="text/javascript">
			<?php echo $customJs ?>
		</script>
	<?php endif; ?>
	<script type="text/javascript">
	$('body').on('hidden.bs.modal', '.modal', function () {
	    $(this).removeData('bs.modal');
	});
	</script>
</body>
</html>