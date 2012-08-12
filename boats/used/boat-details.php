<?php 
//This document displays the individual boat spec
ini_set('max_execution_time', '60');

//Include database class
require("classes/db.class.php");
$db = new db();

//Include details php file
require("includes/get-details.php");

//Contact form redirect code
function curPageURL() {
$pageURL = 'http';
if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}
$url = curPageURL();
?>

<?php
	$_REQUEST['description'] 	= "Find boats for sale or sell your boat with BJ Marine in person or online. We have a large selection of boats for sale. Find your new boat today.";
	$_REQUEST['Keywords'] 		= "Boats, Power, Sail, Marina, Berths, Malahide, Dublin, Bangor, Cork, Malta, Brokerage, Used Boats, Yachts";
	$_REQUEST['title'] 			= "BJ Marine - Power Boats, Sail/Yachts for Sale and Brokerage";

	$appVersion = "?v2.1.3";
?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php echo $_REQUEST['title']; ?></title>

	<meta name="Description" content="<?php echo $_REQUEST['description']; ?>" />
	<meta name="Keywords" content="<?php echo $_REQUEST['Keywords']; ?>" />

	<meta name="Author" content="Denis Hoctor - denishoctor@gmail.com" />
	<meta name="Robots" content="<?php echo $_REQUEST['robots']; ?>" />

	<meta name="viewport" content="width=940">

	<link href="/css/style.css<?php echo $appVersion ?>" rel="stylesheet" type="text/css" />
	<link href="includes/brokerage-boats.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
	<script type="text/javascript" src="galleria/galleria-1.2.4.min.js<?php echo $appVersion ?>"></script>
	<!-- Facebook Opengraph -->
	<meta property="og:title" content="<?php echo $boat['Make'] . " " . $boat['Model']; ?> for sale" />
	<meta property="og:type" content="product" />
	<meta property="og:url" content="<?php echo $url; ?>" />
	<meta property="og:image" content="http://www.boatwizardwebsolutions.co.uk/used-boats-for-sale/for-sale.gif" />
	<meta property="og:description" content="View this boat for sale. Includes price information and photo gallery!" />
	<meta property="og:site_name" content="BJ Marine" />
	<meta property="fb:admins" content="100002748181602" />
	<meta property="fb:app_id" content="159159377546939" />
	<div id="fb-root"></div>
	<script type="text/javascript">
	window.fbAsyncInit = function () {
		   FB.init({ 
			  appId: '159159377546939', 
			  status: true, 
			  cookie: true, 
			  xfbml: true, 
			  oauth: true 
		   });
		   FB.Canvas.setAutoGrow();
	   }
	</script>
	<script src="//connect.facebook.net/en_US/all.js" type="text/javascript"></script>
	<script type="text/javascript" src="scripts/usedboats.js<?php echo $appVersion ?>"></script>

</head>
<body class="<?php echo $_REQUEST['page']; ?>">
<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->


	<div class="main container">

		<div class="navbar topnav">
			<div class="navbar-inner">
				<div class="container">
					<div class="nav-collapse">
						<?php include $_SERVER['DOCUMENT_ROOT'].'/skin/top-menu.php'; ?>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="span4">
				<a class="brand" href="/"><img class="bj-logo" src="/img/logo.png" title="BJ Marine" alt="BJ Marine Logo" /></a>
			</div>
			<div class="span8">
				<ul class="title-locations">
					<li>Ireland</li>
					<li>UK</li>
					<li>Mediterranean</li>
				</ul>
			</div>
		</div>

		<div class="navbar mainnav">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<div class="nav-collapse">
						<?php include $_SERVER['DOCUMENT_ROOT'].'/skin/main-menu.php'; ?>
					</div>
				</div>
			</div>
		</div>

		<header class="page-header" id="overview">
			<h1>Used Boats</h1>
		</header>
		<section>
			<div class="row">
				<div class="span12">
					<!-- content-wrap starts here -->
					<div id="content-wrap">
						<div id="boat-content">
						
							<div id="page-numbers">
								<a href="javascript:history.back(1);">&lt; Back to Previous Page</a>
							</div>
							
							<div id="description">
								<div class="price"><?php if ($boat['Price'] != "1"){ echo $boat['PriceCurrency']; ?><?php echo $boat['Price']; 
										} else { echo "Contact us for price"; }?></div>
								<h1><?php echo $boat['Make'] . " " . $boat['Model']; ?></h1>	
								<p><strong>Location:</strong> <?php echo $boat['LocationCity'] . ", " . $boat['LocationCountry']; ?></p>
								<p><?php echo $boat['Description'] ?></p>
								<script type="text/javascript" src="http://connect.facebook.net/en_US/all.js#appId=159159377546939&amp;xfbml=1"></script>
								<fb:like href="<?php echo $url; ?>" send="true" width="470" show_faces="true" font=""></fb:like>
								<br/><br/>
							</div>
							
							<!-- START IMAGE GALLERY -->
							<?php $boatid = $_GET['BoatID'];?>
							<div id="image-gallery">
								<div id="gallery">
									<?php 
									$Query = "SELECT * FROM images WHERE BoatID=$id";
									$imagedata = $db->db_query($Query); 
									while($image = $db->db_rs($imagedata)) {?>
									<img src="<?php echo $image['ImageURL'] ?>" /><br/>
									<?php }?>
								</div>
								<script type="text/javascript">
									Galleria.loadTheme('galleria/themes/classic/galleria.classic.min.js');
									$("#gallery").galleria({
									autoplay: 5000,
									width: 650,
									height: 500,
									imageTimeout:60000
									});
								</script>
							</div>
							<!-- END IMAGE GALLERY -->
								
							<!--START BASIC DETAILS-->
							
							<table id="specs">
								<tbody>
									<tr><td class="specs-heading" colspan="2"><?php echo $boat['Make'] . " " . $boat['Model']; ?> Details</td></tr>
									<?php 			
									echo "<tr><td class='field'>Boat Reference: </td><td>" . $boat['BoatID'] . "</td></tr>";			
									if (isset($boat['Name']) && $boat['Name'] != ""){ echo "<tr><td class='field'>Name: </td><td>" . $boat['Name'] . "</td></tr>"; };
									if (isset($boat['Year'])){ echo "<tr><td class='field'>Year Built: </td><td>" . $boat['Year'] . "</td></tr>"; };
									if (isset($boat['Builder']) && $boat['Builder'] != ""){ echo "<tr><td class='field'>Builder: </td><td>" . $boat['Builder'] . "</td></tr>"; };
									if (isset($boat['Designer']) && $boat['Designer'] != ""){ echo "<tr><td class='field'>Designer: </td><td>" . $boat['Designer'] . "</td></tr>"; };
									if (isset($boat['HullMaterial'])){ echo "<tr><td class='field'>Hull Material: </td><td>" . $boat['HullMaterial'] . "</td></tr>"; };
									if (isset($boat['Length_mt'])){ echo "<tr><td class='field'>Length: </td><td>" . $boat['Length_mt'] . " metres / " . $boat['Length_ft'] . " feet</td></tr>"; };
									if ($boat['Beam'] != 0){ echo "<tr><td class='field'>Beam: </td><td>" . $boat['Beam'] . "</td></tr>"; };
									if ($boat['Displacement'] != 0){ echo "<tr><td class='field'>Displacement: </td><td>" . $boat['Displacement'] . " ". $boat['DisplacementUnit'] . "</td></tr>"; };
									if ($boat['MaxDraft'] != 0){ echo "<tr><td class='field'>Max Draft: </td><td>" . $boat['MaxDraft'] . "</td></tr>"; };
									if ($boat['Ballast'] != 0){ echo "<tr><td class='field'>Ballast: </td><td>" . $boat['Ballast'] . " " . $boat['BallastUnit'] . "</td></tr>"; };
									if ($engine['EngineNo'] != 0){ echo "<tr><td class='field'>Engines: </td><td>" . $engine['EngineNo'] . " x " . $engine['EngineMake'] . " " . $engine['EngineModel'] . "</td></tr>"; };
									if ($boat['CruisingSpeed'] != 0){ echo "<tr><td class='field'>Cruising Speed: </td><td>" . $boat['CruisingSpeed'] . "</td></tr>"; };
									if ($boat['MaxSpeed'] != 0){ echo "<tr><td class='field'>Max Speed: </td><td>" . $boat['MaxSpeed'] . "</td></tr>"; };
									if ($boat['FuelTankNo'] != 0){ echo "<tr><td class='field'>Fuel Tankage: </td><td>" . $boat['FuelTankNo'] . " x " . $boat['FuelTankCap'] . " " . $boat['FuelTankCapUnit'] . "</td></tr>"; };
									if ($boat['WaterTankNo'] != 0){ echo "<tr><td class='field'>Water Tankage: </td><td>" . $boat['WaterTankNo'] . " x " . $boat['WaterTankCap'] . " " . $boat['WaterTankCapUnit'] . "</td></tr>"; };
									if ($boat['HoldingTankNo'] != 0){ echo "<tr><td class='field'>Holding Tankage: </td><td>" . $boat['HoldingTankNo'] . " x " . $boat['HoldingTankCap'] . " " . $boat['HoldingTankCapUnit'] . "</td></tr>"; };
									?>
								</tbody>
							</table>
							<div id="descriptions">
								<?php 
								$Query = "SELECT * FROM descriptions WHERE BoatID=$id";
								$textdata = $db->db_query($Query); 
								while($text = $db->db_rs($textdata)) {
									if ($text['AddTitle'] != "customContactInformation" && $text['AddTitle'] != "Disclaimer"){
										echo "<h4>" . $text['AddTitle'] . "</h4>";
										$text['AddDescription']=str_replace("ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢","'",$text['AddDescription']);
										echo "<p>" . $text['AddDescription'] . "</p>";
									}
								}
								$Query = "SELECT * FROM features WHERE BoatID=$id";
								$featuredata = $db->db_query($Query); 
								if ($db->db_rows($featuredata) > 0){
									echo "<ul>";
									while($feature = $db->db_rs($featuredata)) {
										$feature['Feature']=str_replace("ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢","'",$feature['Feature']);
										$feature['Feature']=str_replace("_"," ",$feature['Feature']);
										$feature['Feature']=strtolower($feature['Feature']);
										$feature['Feature']=ucfirst($feature['Feature']);
										echo "<li>" . $feature['Feature'] . "</li>";
									}
									echo"</ul><br/><br/>";
								}
								$Query = "SELECT * FROM descriptions WHERE BoatID=$id";
								$textdata = $db->db_query($Query); 
								while($text = $db->db_rs($textdata)) {
									if ($text['AddTitle'] == "customContactInformation" || $text['AddTitle'] == "Disclaimer"){
										$text['AddTitle']=str_replace("customContactInformation","Additional Contact Information",$text['AddTitle']);
										echo "<h4>" . $text['AddTitle'] . "</h4>";
										$text['AddDescription']=str_replace("ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢","'",$text['AddDescription']);
										echo "<p>" . $text['AddDescription'] . "</p>";
									}
								}?>
							</div>
							<!--END BASIC DETAILS-->
							
						</div>
						<div id="sidebar-search" class="sidebar-search">
							<div class="sidebar-content">
								<!-- START CONTACT FORM -->
								<h4>QUICK CONTACT FORM</h4>
								<form id="contact-form">
									<div class='formResponse'></div>
									<div class='form-content'>
										<p>Please use this quick contact form if you have any questions about this boat or to request a brochure. </p>
										<input type="hidden" name="url" value="<?php echo $url;?>"/>
										<input type="hidden" name="required" value="email,captcha"/>
										<input type="hidden" name="interested" value="<?php echo $boat['BoatID'] . " - " . $boat['Make'] . " " . $boat['Model']; ?>" />
										<div class="option name-text">												
											Name:<br/> 
											<input class="wide" type="text" name="name" style="width: 200px;" />				
										</div>
										<div class="option email-text">							
											Email(required): <br/>
											<input class="wide" type="text" name="email" style="width: 200px" />
										</div>
										<div class="option phone-text">	
											Phone: <br/>
											<input class="wide" type="text" name="phone" style="width: 200px;" />
										</div>
										<div class="option comments-text">
											Enquiry:<br/>
											<textarea name="comments" style="height: 100px; width: 200px;" cols="20"></textarea>
										</div>
										<div class="option"><input class="check" type="checkbox" name="brochure"/> Tick to request a brochure</div>
										<br/>
										<div class="option captcha-text">
											Please help us avoid spam by entering the characters below: <br/>
											<input type="hidden" id="contact_captcha_challenge" name="captcha_challenge" class="captcha_challenge" value="">
											<center><img id="contact_captcha_image" class="captcha_image"/></center>
											<input class="wide" type="text" name="captcha" value=""><br/>
											<a href="javascript:getCaptcha('contact_captcha_image', 'contact_captcha_challenge');">Request a new image</a>
										</div>
										<script>
										getCaptcha('contact_captcha_image', 'contact_captcha_challenge');</script>
										<input class="button" type="button" name="send" value="Send Enquiry" onclick="javascript:submitContactForm('contact-form')"/></p>
									</div>
								</form>
								<!-- END CONTACT FORM -->
							</div>	
							<div class="sidebar-content">
								<!-- START CONTACT FORM -->
								<h4>CAN'T FIND THE PERFECT BOAT?</h4>
								<form id="general-form">
									<div class='formResponse'></div>
									<div class='form-content'>

										<p>Let us know what you are looking for using the enquiry form below</p>
										<input type="hidden" name="url" value="<?php echo $url;?>"/>
										<input type="hidden" name="required" value="email,captcha"/>
										<div class="option name-text">												
											Name:<br/> 
											<input class="wide" type="text" name="name" style="width: 190px;" />				
										</div>
										<div class="option email-text">							
											Email(required): <br/>
											<input class="wide" type="text" name="email" style="width: 190px" />
										</div>
										<div class="option phone-text">	
											Phone: <br/>
											<input class="wide" type="text" name="phone" style="width: 190px;" />
										</div>
										<div class="option comments-text">
											Enquiry:<br/>
											<textarea name="comments" style="height: 100px; width: 190px;" cols="20"></textarea>
										</div>

										<div class="option captcha-text">
											Please help us avoid spam by entering the characters below: <br/>
											<input type="hidden" id="general_captcha_challenge" name="captcha_challenge" class="captcha_challenge" value="">
											<center><img id="general_captcha_image" class="captcha_image"/></center>
											<input class="wide" type="text" name="captcha" value=""><br/>
											<a href="javascript:getCaptcha('general_captcha_image', 'general_captcha_challenge');">Request a new image</a>
										</div>
										<script>
										getCaptcha('general_captcha_image', 'general_captcha_challenge');</script>
										<input class="button" type="button" name="send" value="Send Enquiry" onclick="javascript:submitContactForm('general-form')"/></p>
									</div>
								</form>

							<!-- END CONTACT FORM -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php 
	$_REQUEST['page'] = "boats-used";
	include $_SERVER['DOCUMENT_ROOT'].'/skin/footer.php';
	?>
	