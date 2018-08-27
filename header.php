<?php
require_once "sistem/fonksiyon.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="<?php echo $arow->site_desc; ?>">
    <meta name="author" content="https://www.Zerotheme.com">
	
    <title><?php echo $arow->site_baslik; ?></title>
	
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css"  type="text/css">
	
	<!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">


    <!-- Owl Carousel Assets -->
    <link href="owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="owl-carousel/owl.theme.css" rel="stylesheet">
	
	<!-- Custom Fonts -->
    <link rel="stylesheet" href="font-awesome-4.4.0/css/font-awesome.min.css"  type="text/css">
	
	<!-- jQuery -->
	<script src="js/jquery-2.1.1.js"></script>
	
	<!-- Core JavaScript Files -->  	 
    <script src="js/bootstrap.min.js"></script>
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<header>
	<!--Top-->
	<nav id="top">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<strong><?php echo  $arow->site_desc; ?></strong>
				</div>
				<div class="col-md-6 col-sm-6">

			
					<ul class="list-inline top-link link">
						<li><a href="<?php echo $arow->siteurl; ?>"><i class="fa fa-home"></i> Anasayfa</a></li>
                        <li><a href="panel/giris.php"><i class="fa fa-folder-open"></i> Panel</a></li>




                        <li><a href="contact.php"><i class="fa fa-comments"></i> İletişim</a></li>
						<li><a href="#"><i class="fa fa-question-circle"></i> SSS</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	
	<!--Navigation-->
    <nav id="menu" class="navbar">
		<div class="container">
			<div class="navbar-header"><span id="heading" class="visible-xs">Categories</span>
			  <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li><a href="<?php echo $arow->site_url; ?>"><i class="fa fa-home"></i> Anasayfa</a></li>

<!--
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Üyelik</a>
						<div class="dropdown-menu">
							<div class="dropdown-inner">
								<ul class="list-unstyled">
									<li><a href="archive.html">Giriş</a></li>
									<li><a href="archive.html">Kayıt</a></li>
								</ul>
							</div>
						</div>
					</li>
-->
<!--
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-play-circle-o"></i> Video</a>
						<div class="dropdown-menu">
							<div class="dropdown-inner">
								<ul class="list-unstyled">
									<li><a href="archive.html">Text 201</a></li>
									<li><a href="archive.html">Text 202</a></li>
									<li><a href="archive.html">Text 203</a></li>
									<li><a href="archive.html">Text 204</a></li>
									<li><a href="archive.html">Text 205</a></li>
								</ul>
							</div> 
						</div>
					</li>
-->


					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-list"></i> Kategori</a>
						<div class="dropdown-menu" >
							<div class="dropdown-inner">
								<ul class="list-unstyled">
									<li><?php kategori_link($ana_kategori_id); ?></li>
								</ul>
								
							</div>
						</div>
					</li>
					<li><a href="contact.php"><i class="fa fa-envelope"></i> İletişim</a></li>
				</ul>

 			</div>
		</div>
	</nav>


    <!--Header Slider -->

    <?php include "h_slider.php"; ?>
</header>
<!-- Header -->