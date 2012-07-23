<?php 
	$_REQUEST['page'] = "boats-new-beneteau";
	include $_SERVER['DOCUMENT_ROOT'].'/skin/header.php';
?>

	<header class="page-header" id="overview">
		<h2>New Beneteau Boats</h2>
	</header>

	<section>
		<div class="row">
			<div class="span2">
				<a href="/boats/new/beneteau-listings.php"><img src="/img/brands/beneteau/logo.jpg" title="Beneteau" alt="Beneteau Logo" data-hover /></a>
				<a href="/boats/new/searay-listings.php"><img src="/img/brands/searay/logo.jpg" title="SeaRay" alt="SeaRay Logo" data-hover /></a>
				<a href="/boats/new/fairline-listings.php"><img src="/img/brands/fairline/logo.jpg" title="Fairline" alt="Fairline Logo"  data-hover /></a>
			</div>
			<div class="span10">
				<p>The listing below is the current Beneteau power and sail range. Please click on each for full details including 360° tour, brochure, plans, specifications and pricing. If you would like some advice or assistance about any aspect of buying a boat or if you wish to view a particular model please <a href="/contact.php">contact us</a>.</p>
				<iframe class="beneteauframe" src ="http://www.yachtworld-international.com/beneteau"></iframe>
			</div>
		</div>
	</section>

<?php include $_SERVER['DOCUMENT_ROOT'].'/skin/footer.php'; ?>

