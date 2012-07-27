<?php 
	$_REQUEST['page'] = "boats-new-cranchi";
	include $_SERVER['DOCUMENT_ROOT'].'/skin/header.php';

	$brandUri = 'http://www.cranchi.com/';
?>

	<header class="page-header" id="overview">
		<h2>New Cranchi Boats</h2>
	</header>

	<section>
		<div class="row">
			<div class="span2">
				<?php include 'brand-logos.php' ?>
			</div>
			<div class="span10">
				<iframe class="cranchi-iframe" src="<?php echo $brandUri; ?>"></iframe>
			</div>
			<div
		</div>
	</section>

<?php include $_SERVER['DOCUMENT_ROOT'].'/skin/footer.php'; ?>
