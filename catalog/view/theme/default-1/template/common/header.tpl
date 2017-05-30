<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>

<!-- bootstrap -->
<link href="public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<!-- style -->
<link href="public/themes/default/css/style.css" rel="stylesheet" type="text/css" />

<!-- responsive -->
<link href="public/themes/default/css/responsive.css" rel="stylesheet" type="text/css" />

<!-- font-awesome- -->
<link href="public/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<!-- select2 -->
<link href="public\assets\select2\css\select2.min.css" rel="stylesheet" type="text/css" />



<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>
</head>
<body class="<?php echo $class; ?>">
	<!-- Start : Header -->
	<header class="header">
		<!-- Navigation -->
		<nav class="navigation">
			<div class="container">
			
				<div class="pull-left">
					<!-- Top link -->
					
					
				    <!-- Currency -->
					<?php echo $currency; ?>
				    
				    <!-- Languages -->
				    <?php echo $language; ?>
				    
				</div>
				
				<div class="pull-right">
				    <?php if($navigations) { ?>
				    	<ul class="nav navbar-nav">
				    		<?php foreach ($navigations as $navigation) { ?>
				    			<?php if($navigation['children']) { ?>
				    				<li>
				    					<a href="<?php echo $navigation['url']?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $navigation['title']?></a>
				    					<ul class="dropdown-menu">
    				    					<?php foreach ($navigation['children'] as $navigation_2) { ?>
    				    						<li><a href="<?php echo $navigation_2['url']?>"><?php echo $navigation_2['title']?></a></li>	
    				    					<?php } ?>
				    					</ul>
				    				</li>
				    			<?php } else { ?>
				    				<li><a href="<?php echo $navigation['url']?>"><?php echo $navigation['title']?></a></li>
				    			<?php } ?>
				    		<?php } ?>
				    	</ul>
				    <?php } ?>							    
				</div>			
			</div>
		</nav>
		
		<!-- Header Top -->
		<section class="header-top">
			<div class="container">
				<?php if(isset($header_top)) echo $header_top; ?>
			</div>
		</section>
		
		<!-- Header Main -->
		<section class="header-main">
			<div class="container">
				<div class="row">
					
					<!-- logo -->
					<div class="col-xs-12 col-sm-3 col-md-3 logo">
						<?php if($logo) { ?>
							<a href="index"><img src="<?php echo $logo?>" class="img-responsive" title="Logo" alt="Logo" /></a>
						<?php } ?>
					</div>
					
					<!-- search -->
					<div id="cart-block" class="col-xs-7 col-sm-7 col-md-7 header-search-box">
						<?php echo $search ?>	
					</div>
					
					<!-- cart -->
					<div class="col-xs-5 col-sm-2 col-md-2 shopping-cart-box">
						<?php echo $cart?>
					</div>
				</div>
			</div>
		</section>
				
		<!-- Header Bottom -->
		<section class="header-bottom">
			<div class="container">
				<?php if(isset($header_bottom)) echo $header_bottom; ?>
			</div>
		</section>
	</header>	
	<!-- End : Header -->
	
	<!-- Start : Main -->
	<article class="article">
	
	