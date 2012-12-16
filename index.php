<?php
	$_REQUEST['page'] = "home";
	include $_SERVER['DOCUMENT_ROOT'].'/skin/header.php';
?>

	<div class="row">
		<div class="span12 slider">
			<ul class="bjqs">
				<li>
					<a href="/extra/boatshows.php">
						<img src="img/slider/boatshows.jpg<?php echo $appVersion ?>" alt="Upcoming Boat Shows Slider" title="Checkout the upcoming boat shows around Europe" />
					</a>
				</li>
				<li>
					<a href="/extra/greenline.php">
						<img src="img/slider/greenline.jpg<?php echo $appVersion ?>" alt="Greenline Hybrid Advert" title="Checkout the latest Hybrid Boats from Greenline" />
					</a>
				</li>
				<li>
					<a href="/boats/used/index.php">
						<img src="img/slider/sellyourboat.jpg<?php echo $appVersion ?>" alt="Used Boats Advert" title="Review our used boat stock" />
					</a>
				</li>
				<li>
					<a href="/boats/brokerage/index.php">
						<img src="img/slider/brokerage.jpg<?php echo $appVersion ?>" alt="Sell your Boat/Brokerage Advert" title="Contact us today to sell your boat" />
					</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="row-fluid feature-images">
		<div class="span4">
			<a href="boats/new/beneteau-listings.php">
				<img src="img/brands/beneteau/yacht-squared.jpg<?php echo $appVersion ?>" title="New Beneteau Yachts" alt="Beneteau Yacht" />
			</a>
		</div>
		<div class="span4">
			<a href="boats/new/beneteau-listings.php">
				<img src="img/brands/beneteau/power-squared.jpg<?php echo $appVersion ?>" title="New Beneteau Power Boats" alt="Beneteau Power Boat" />
			</a>
		</div>
		<div class="span4">
			<a href="boats/new/fairline-listings.php">
				<img src="img/brands/fairline/power-squared.jpg<?php echo $appVersion ?>" title="New Fairline Power Boats" alt="Fairline Power Boat" />
			</a>
		</div>
	</div>

	<div class="row-fluid feature-images">
		<div class="span4">
			<a href="boats/new/searay-listings.php">
				<img src="img/brands/searay/power-squared.jpg<?php echo $appVersion ?>" title="New SeaRay Power Boats" alt="SeaRay Power Boat" />
			</a>
		</div>
		<div class="span4">
			<a href="boats/new/cranchi-listings.php">
				<img src="img/brands/cranchi/power-squared.jpg<?php echo $appVersion ?>" title="New Cranchi Power Boats" alt="Cranchi Power Boat" />
			</a>
		</div>
		<div class="span4">
			<a href="boats/new/greenline-listings.php">
				<img src="img/brands/greenline/power-squared.jpg<?php echo $appVersion ?>" title="New Greenline Power Boats" alt="Greenline Power Boat" />
			</a>
		</div>
	</div>

	<div class="hero-unit">
		<div class="row-fluid">
			<div class="span9">
				<p>
					Welcome to BJ Marine, the leading <a href="boats/new/index.php">new boat sales</a> and <a href="boats/used/index.php">used boat sales</a> specialists. We have a full range of new sailing boats, used sailing yachts, new power boats and used motor boats for sale.
				</p>
				<p>
					With our office network in <a href="about/offices/dublin.php">Ireland</a>, <a href="about/offices/belfast.php">UK</a> and the <a href="about/offices/mediterranean.php">Mediterranean </a>we can be your one stop shop for expert help whether you are buying a boat or selling contact us today.
				</p>
			</div>
			<div class="span3 text-center">
				<a href="boats/brokerage/index.php">
					<img src="img/used-boats.png" title="Used Boats" alt="Brokerage Logo" data-hover />
				</a>
				<a href="about/offices/belfast.php">
					<img src="img/services-boatyard-header.jpg" title="Used Boats" alt="Brokerage Logo" />
				</a>
			</div>
		</div>
	</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/skin/footer.php'; ?>