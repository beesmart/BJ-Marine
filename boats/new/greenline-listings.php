<?php 
	$_REQUEST['page'] = "boats-new-greenline";
	include $_SERVER['DOCUMENT_ROOT'].'/skin/header.php';

	$brandUri = 'http://www.greenlinehybrid.com/';
?>

	<header class="page-header" id="overview">
		<h2 class="float-left">New Greenline Boats</h2>
		<a class="float-right" target="_blank" href="<?php echo $brandUri; ?>">View in full window</a>
	</header>

	<section>
		<div class="row">
			<div class="span2">
				<?php include 'brand-logos.php' ?>
			</div>
			<div class="span10">
				<iframe class="greenline-iframe" src="<?php echo $brandUri; ?>"></iframe>
			</div>
			<div
		</div>
	</section>

<?php include $_SERVER['DOCUMENT_ROOT'].'/skin/footer.php'; ?>
