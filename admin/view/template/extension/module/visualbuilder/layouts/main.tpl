<div class="builder-grid">
	
	<!-- Start : Header -->
	<div class="header-module">
		<div class="row">
		    <!-- Header top -->
			<div class="col-md-12">
				<?php include ($adminPositionsDir . "header_top.tpl");	?>
			</div>
			
			<!-- Header bottom -->
        	<div class="col-md-12">
        		<?php include ($adminPositionsDir . "header_bottom.tpl");	?>
        	</div>
		</div>
	</div>
	<!-- End : Header -->
	
	<!-- Start : Main -->
	<div class="main-module">
		
		<!-- Main Top -->
		<div class="row">
			<div class="col-md-12"><?php include ($adminPositionsDir . "main_top.tpl"); ?></div>
		</div>
		
		<!-- Main Middle -->
		<div class="row">
			<div class="col-md-3">
				<?php include ($adminPositionsDir . "column_left.tpl");	?>
			</div>
        	<div class="col-md-6">
        		<?php include ($adminPositionsDir . "content_top.tpl");	?>
        		<?php include ($adminPositionsDir . "content_bottom.tpl"); ?>
        	</div>
        	<div class="col-md-3">
        		<?php include ($adminPositionsDir . "column_right.tpl"); ?>
        	</div>
		</div>
		
		<!-- Main Footer -->
		<div class="row">
			<div class="col-md-12">
				<?php include ($adminPositionsDir . "main_bottom.tpl"); ?>
			</div>
		</div>
	</div>
	<!-- End : Main -->
	
	<!-- Start : Footer -->
	<div class="footer-module">
		 <div class="row">
			<div class="col-md-12">
				<?php include ($adminPositionsDir . "footer_top.tpl");	?>
        	</div>
        	<div class="col-md-12">
        		<?php include ($adminPositionsDir . "footer_bottom.tpl");	?>
        	</div>
		</div>
	</div>
	<!-- End : Footer -->	
</div>