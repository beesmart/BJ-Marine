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
				<?php include 'brand-logos.php' ?>
			</div>
			<div class="span10">
				<p>The listing below is the current Beneteau power and sail range. Please click on each for full details including 360° tour, brochure, plans, specifications and pricing. If you would like some advice or assistance about any aspect of buying a boat or if you wish to view a particular model please <a href="/contact.php">contact us</a>.</p>
				<iframe class="beneteau-iframe" src ="http://www.yachtworld-international.com/beneteau"></iframe>
			</div>
		</div>
	</section>

<?php include $_SERVER['DOCUMENT_ROOT'].'/skin/footer.php'; ?>
