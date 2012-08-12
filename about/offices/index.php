<?php 
	$_REQUEST['page'] = "offices";
	include $_SERVER['DOCUMENT_ROOT'].'/skin/header.php';
?>

	<header class="page-header" id="overview">
		<h1>Our Offices and Locations</h1>
	</header>


	<section id="intro">
		<div class="row-fluid">
			<div class="span12">
				<p>We offer new and used boats for sale in Dublin, Belfast and Malta. You will find Sail and Power Boats on display at our bases in Ireland, the UK and Mediterranean.</p>
				
				<p>BJ Marine's network of offices and showroom are located in prime boating locations throughout the island of Ireland and the centre of the Mediterranean. Our <strong><a href="/about/offices/dublin.php">Dublin Office</a></strong> is based at Malahide Marina, just 15 minutes from Dublin Airport. Our <a href="/about/offices/belfast.php"><strong>Belfast Office</strong></a> is based at Bangor Marina just 15 minutes from Belfast City Airport and our <strong><a href="/about/offices/mediterranean.php">Mediterranean Office</a></strong> in Malta is at Grand Harbour Marina also only 15 minutes from the Airport. Each office will have a continually changing range of new boats both power boats and sailing boats and used boats both motor boats and sailing yachts on display. You could say it's "like a boat show everyday".</p>
			</div>
		</div>
	</section>


	<section id="offices">
		<div class="row-fluid feature-images">
			<div class="span4">
				<a href="/about/offices/dublin.php">
					<img src="/img/offices/dublin.jpg" title="Our Dublin Office," alt="Malahide Marina, Dublin" />
				</a>
			</div>
			<div class="span4">
				<a href="/about/offices/belfast.php">
					<img src="/img/offices/belfast.jpg" title="Our Belfast Office," alt="Bangor Marina, Belfast" />
				</a>
			</div>
			<div class="span4">
				<a href="/about/offices/mediterranean.php">
					<img src="/img/offices/mediterranean.jpg" title="Our Mediterranean Office," alt="Grand Harbour Marina, Malta" />
				</a>
			</div>
		</div>
	</section>

<?php include $_SERVER['DOCUMENT_ROOT'].'/skin/footer.php'; ?>

