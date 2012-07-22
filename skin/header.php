<?php
	$description 	= "Find boats for sale or sell your boat with BJ Marine in person or online. We have a large selection of boats for sale. Find your new boat today.";
	$Keywords 		= "Boats, Power, Sail, Marina, Berths, Malahide, Dublin, Bangor, Cork, Malta, Brokerage, Used Boats, Yachts";
	$title 			= "BJ Marine - Power Boats, Sail/Yachts for Sale and Brokerage";
	$robots 		= "noindex,nofollow";
?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><? echo $title; ?></title>

	<meta name="Description" content="<? echo $description; ?>" />
	<meta name="Keywords" content="<? echo $Keywords; ?>" />

	<meta name="Author" content="Denis Hoctor - denishoctor@gmail.com" />
	<meta name="Robots" content="<? echo $robots; ?>" />

	<meta name="viewport" content="width=device-width">
	
	<!-- Use SimpLESS (Win/Linux/Mac) or LESS.app (Mac) to compile your .less files
	to style.css, and replace the 2 lines above by this one:

	<link rel="stylesheet" href="/css/style.css">

	-->

	<link rel="stylesheet/less" href="/less/style.less">
	<script src="/js/libs/less-1.3.0.min.js"></script>
	
	<script src="/js/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script>
</head>
<body class="<? echo $_SESSION['page']; ?>">
<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->


	<div class="main container">
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="#"><img src="/img/logo.png" title="BJ Marine" alt="BJ Marine Logo" /></a>
					<div class="nav-collapse">
						<?php include 'menu.php'; ?>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>