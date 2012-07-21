<?php 
	$_REQUEST['page'] = "home";
	include 'skin/header.php'; 
?>
	<!-- Main hero unit for a primary marketing message or call to action -->
	<div class="hero-unit">
		<div class="row-fluid">
			<div class="span9">
				<p>
					Welcome to BJ Marine, the leading <a href="boats/new/">new boat sales</a> and <a href="boats/used/">used boat sales</a> specialists. We have a full range of new sailing boats, <a href="boats/used/sail.php">used sailing yachts</a>, new power boats and <a href="boats/used/power.php">used motor boats for sale</a>.
				</p>
				<p>
					With our office network in <a href="about/offices/dublin.php">Dublin</a>, <a href="about/offices/belfast.php">Belfast</a> and the <a href="about/offices/mediterranean.php">Mediterranean</a> we can be your one stop shop for expert help whether you are buying a boat or selling.
				</p>
				<p><a class="btn btn-primary">Learn more about us &raquo;</a></p>
			</div>
			<div class="span3 text-center">
				<a href="boats/brokerage/sellyourboat.php">
					<img src="img/used-boats.png" title="Used Boats" alt="Brokerage Logo" data-hover />
				</a>
				<a href="about/offices/belfast.php">
					<img src="img/services-boatyard-header.jpg" title="Used Boats" alt="Brokerage Logo" />
				</a>
			</div>
		</div>
	</div>

	<div class="row-fluid feature-images">
		<div class="span3">
			<a href="boats/new/beneteau-listings.php">
				<img src="img/brands/beneteau/yacht-squared.jpg" data-hover />
			</a>
		</div>
		<div class="span3">
			<a href="boats/new/beneteau-listings.php">
				<img src="img/brands/beneteau/power-squared.jpg" data-hover />
			</a>
		</div>
		<div class="span3">
			<a href="boats/new/fairline-listings.php">
				<img src="img/brands/fairline/power-squared.jpg" data-hover />
			</a>
		</div>
		<div class="span3">
			<a href="boats/new/searay-listings.php">
				<img src="img/brands/searay/power-squared.jpg" data-hover />
			</a>
		</div>
	</div>

<?php include 'skin/footer.php'; ?>