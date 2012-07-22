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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<title><?php echo $boat['Make'] . " " . $boat['Model']; ?> boat for sale | BJ Marine.net</title>
<meta name="keywords" content="<?php echo $boat['Make']; ?>, <?php echo $boat['Model']; ?>, <?php echo $boat['LocationCountry']; ?>, boat for sale, used boat, brokerage, yacht" />
<meta name="description" content="<?php strip_tags ($boat['Description']); ?>" />
<meta http-equiv='Content-Type' content='Type=text/html; charset=utf-8'/>
<link href="includes/brokerage-boats.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<script type="text/javascript" src="galleria/galleria-1.2.4.min.js"></script>
<meta content="8ulQtunA0sVietNFCJFm31ifp9zCqLPEKKb0JX4FkwA=" name="verify-v1" />
<link href="/favicon.ico" rel="icon" type="image/x-icon"/>
<link href="/images/bjmarine_front.css" rel="stylesheet" type="text/css" />
<link href="/images/news_window.css" rel="StyleSheet" type="text/css"/>
<script src="../ddtabmenufiles/ddtabmenu.js" type="text/javascript"></script>
<link href="../ddtabmenufiles/ddcolortabs.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
//SYNTAX: ddtabmenu.definemenu("tab_menu_id", integer OR "auto")
ddtabmenu.definemenu("ddtabs4", 0) //initialize Tab Menu #4 with 3rd tab selected

</script>
<script type="text/javascript">
//SYNTAX: ddtabmenu.definemenu("tab_menu_id", integer OR "auto")
ddtabmenu.definemenu("ddtabs4", 0) //initialize Tab Menu #4 with 3rd tab selected
function FP_swapImg() {//v1.0
 var doc=document,args=arguments,elm,n; doc.$imgSwaps=new Array(); for(n=2; n<args.length;
 n+=2) { elm=FP_getObjectByID(args[n]); if(elm) { doc.$imgSwaps[doc.$imgSwaps.length]=elm;
 elm.$src=elm.src; elm.src=args[n+1]; } }
}

function FP_preloadImgs() {//v1.0
 var d=document,a=arguments; if(!d.FP_imgs) d.FP_imgs=new Array();
 for(var i=0; i<a.length; i++) { d.FP_imgs[i]=new Image; d.FP_imgs[i].src=a[i]; }
}

function FP_getObjectByID(id,o) {//v1.0
 var c,el,els,f,m,n; if(!o)o=document; if(o.getElementById) el=o.getElementById(id);
 else if(o.layers) c=o.layers; else if(o.all) el=o.all[id]; if(el) return el;
 if(o.id==id || o.name==id) return o; if(o.childNodes) c=o.childNodes; if(c)
 for(n=0; n<c.length; n++) { el=FP_getObjectByID(id,c[n]); if(el) return el; }
 f=o.forms; if(f) for(n=0; n<f.length; n++) { els=f[n].elements;
 for(m=0; m<els.length; m++){ el=FP_getObjectByID(id,els[n]); if(el) return el; } }
 return null;
}

function FP_swapImgRestore() {//v1.0
 var doc=document,i; if(doc.$imgSwaps) { for(i=0;i<doc.$imgSwaps.length;i++) {
  var elm=doc.$imgSwaps[i]; if(elm) { elm.src=elm.$src; elm.$src=null; } } 
  doc.$imgSwaps=null; }
}
</script>

<link rel="stylesheet" type="text/css" href="shadowbox/shadowbox.css" />
<script type="text/javascript" src="shadowbox/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.init({ language: 'en', players: ['img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv'] });
</script>
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
  window.fbAsyncInit = function() {
    FB.init({appId: '159159377546939', status: true, cookie: true, xfbml: true});
                };
window.setTimeout(function() {
    FB.Canvas.setAutoResize();
  }, 250);
  };
  (function() {
    var e = document.createElement('script'); e.async = true;
    e.src = document.location.protocol +
      'http://connect.facebook.net/en_US/all.js';
    document.getElementById('fb-root').appendChild(e);
  }());
</script>
</head>

<body id="body_brokerage">
<!-- wrap starts here -->
<div id="wrapnew">
	<div id="xheader">
		<div id="logo">
			<img alt="BJ Marine Header" class="no-border" height="100" src="/images/NewLogo3.jpg" width="1020" /></div>
		<!-- Menu Tabs --></div>
	<div id="ddtabs4" class="ddcolortabs">
		<ul>
			<li id="nav_home"><a href="/index.php"><span>Home</span></a></li>
			<li id="nav_newboats"><a href="/newboats.html"><span>New Boats</span></a></li>
			<li id="nav_brokerage"><a href="/used-boats"><span>Used Boats</span></a></li>
			<li id="nav_sellboat"><a href="/sellyourboat.html"><span>Sell Your Boat</span></a></li>
			<li id="nav_team"><a href="/salesteam.html"><span>Sales Team</span></a></li>
			<li id="nav_offices"><a href="/ouroffices.html"><span>Our Offices</span></a></li>
			<li id="nav_services"><a href="/services.html"><span>Services</span></a></li>
			<li id="nav_about"><a href="/about_bj_marine.html"><span>About</span></a></li>
			<li id="nav_contact"><a href="/contact.html"><span>Contact</span></a></li>
		</ul>
	</div>
	<div class="ddcolortabsline">
	</div>
	<!-- content-wrap starts here -->
	<div id="content-wrap">
		<div id="header-gap">
		</div>
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
					height: 500
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
						$text['AddDescription']=str_replace("ÃƒÂ¢","'",$text['AddDescription']);
						echo "<p>" . $text['AddDescription'] . "</p>";
					}
				}
				$Query = "SELECT * FROM features WHERE BoatID=$id";
				$featuredata = $db->db_query($Query); 
				if ($db->db_rows($featuredata) > 0){
					echo "<ul>";
					while($feature = $db->db_rs($featuredata)) {
						$feature['Feature']=str_replace("ÃƒÂ¢","'",$feature['Feature']);
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
						$text['AddDescription']=str_replace("ÃƒÂ¢","'",$text['AddDescription']);
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
				<?php 
				if ($_GET['sent']){
				echo "<p class=\"top-para\">THANK YOU</p><p>Your enquiry has been sent sucessfully and a member of our team will be in contact as soon as possible</p>";
				}else{?>
		
				<p>Please use this quick contact form if you have any questions about this boat or to request a brochure. </p>
				<p>Email address is a required field.</p>
				<form style="width:265px; text-align:left" action="contact-form.php" method="post">
					<input type="hidden" name="url" value="<?php echo $url;?>"/>
					<input type="hidden" name="destination" value="<?php echo $boat['BrokerEmail'];?>"/>
					<div class="option">												
						Name:<br/> 
						<input type="text" name="name" style="width: 200px;" />				
					</div>
					<div class="option">							
						Email: <br/>
						<input type="text" name="email" style="width: 200px" />
					</div>
					<div class="option">	
						Phone: <br/>
						<input type="text" name="phone" style="width: 200px;" />
					</div>
					<div class="option">	
						Subject: <br/>
						<input type="text" name="interested" style="width: 200px;" value="<?php echo $boat['BoatID'] . " - " . $boat['Make'] . " " . $boat['Model']; ?>" />
					</div>
					<div class="option">
						Enquiry:<br/>
						<textarea name="comments" style="height: 100px; width: 200px;" cols="20"></textarea>
					</div>
					<div class="option"><input class="check" type="checkbox" name="brochure"/> Tick to request a brochure</div>
					<br/>
					<input class="button" type="submit" name="Submit0" value="Submit Enquiry" />		
				</form>
					
				<? } ?>
				<!-- END CONTACT FORM -->
			</div>	
			 <div class="sidebar-content">
						<!-- START CONTACT FORM -->
						<h4>CAN'T FIND THE PERFECT BOAT?</h4>
						<?php 
						if ($_GET['sent']){
						echo "<p class=\"top-para\">THANK YOU</p><p>Your enquiry has been sent sucessfully and a member of our team will be in contact as soon as possible</p>";
						}else{?>
				
						<p>Let us know what you are looking for using the enquiry form below</p>
						<p>Email address is a required field.</p>
						<form style="width:265px; text-align:left" action="boat-shopper.php" method="post">
							<input type="hidden" name="url" value="<?php echo $url;?>"/>
							<div class="option">												
								Name:<br/> 
								<input type="text" name="name" style="width: 190px;" />				
							</div>
							<div class="option">							
								Email: <br/>
								<input type="text" name="email" style="width: 190px" />
							</div>
							<div class="option">	
								Phone: <br/>
								<input type="text" name="phone" style="width: 190px;" />
							</div>
							<div class="option">
								Enquiry:<br/>
								<textarea name="comments" style="height: 100px; width: 190px;" cols="20"></textarea>
							</div>
							<br/>
							<input class="button" type="submit" name="Submit0" value="Submit Enquiry" />		
						</form>
							
						<? } ?>
						<!-- END CONTACT FORM -->
					</div>
	
		</div>
	</div>	
	<div id="footer-wrap">
		<div id="footer-columns">
			<div class="col3">
				<h3>Dublin</h3>
				Malahide<br />
				Dublin, Ireland<br />
				Tel:(+353) 1 8061560<br />
				<a href="mailto:sales&#64;bjmarine.net">sales&#64;bjmarine.net</a>
			</div>
			<div class="col3-center">
				<h3>Belfast</h3>
				Bangor Marina<br />
				Co. Down, N. Ireland<br />
				Tel:(+44) 2891 271434<br />
				<a href="mailto:sales&#64;bjmarine.net">sales&#64;bjmarine.net</a>
			</div>
			<div class="col3">
				<h3>Mediterranean</h3>
				Grand Harbour Marina<br />
				Malta<br />
				Tel:(+356) 27019356<br />
				<a href="mailto:sales&#64;bjmarine.net">sales&#64;bjmarine.net</a>
			</div>
		<!-- footer-columns ends -->
		</div>
	
		<div id="footer-bottom">		
			<p>&copy; 2010 <strong>BJ Marine Ltd.</strong> | 
			Design by: <a href="mailto:denishoctor@gmail.com">Denis Hoctor</a> | 
			Valid <a href="http://validator.w3.org/check?uri=referer">XHTML</a> | 
			<a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>	
   			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="index.php">Home</a>&nbsp;|&nbsp;
   			<a href="contact.html">Contact</a>
   			</p>		
		</div>	
	<!-- footer ends-->
	</div>
<!-- wrap ends here -->
</div>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-1206900-2");
pageTracker._initData();
pageTracker._trackPageview();
</script>

</body>
</html>