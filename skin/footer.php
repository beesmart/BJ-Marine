	<footer class="footer">

		<div class="row">
			<div class="span4">
				<address>
					<div class="locality"><a href="/about/offices/dublin.php">Ireland</a></div>
					<div class="city">Dublin</div>
					<div class="tel">(+353) 1 8061560</div>
					<a class="email" href="mailto:sales@bjmarine.net">sales@bjmarine.net</a>
				</address>
			</div>
			<div class="span4">
				<address>
					<div class="locality"><a href="/about/offices/belfast.php">United Kingdom</a></div>
					<div class="city">Belfast</div>
					<div class="tel">(+44) 2891 271434</div>
					<a class="email" href="mailto:sales@bjmarine.net">sales@bjmarine.net</a>
				</address>
			</div>
			<div class="span3">
				<address>
					<div class="locality"><a href="/about/offices/mediterranean.php">Mediterranean</a></div>
					<div class="country-name">Malta</div>
					<div class="tel">(+356) 27019356</div>
					<a class="email" href="mailto:sales@bjmarine.net">sales@bjmarine.net</a>
				</address>
			</div>
		</div>

		<hr>

		<p>&copy; 2012 <strong class="lighten">BJ Marine Ltd.</strong></p>
	</footer>

	</div> <!-- /container -->
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="/js/libs/jquery-1.7.2.min.js"><\/script>')</script>

	<script src="/js/plugins.js<?php echo $appVersion ?>"></script>
	<script src="/js/script.js<?php echo $appVersion ?>"></script>
	<!-- end scripts-->

	<?php if(strpos($_SERVER['HTTP_HOST'],'www.bjmarine.dev') === false) { ?>
	<script>
		var _gaq=[['_setAccount','UA-1206900-2'],['_trackPageview']];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
		g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g,s)}(document,'script'));
	</script>
	<?php } ?>
</body>
</html>