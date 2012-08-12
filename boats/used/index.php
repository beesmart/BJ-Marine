<?php 
//This document displays the search results
ini_set('max_execution_time', '120');

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


//Set number of results per page
$results_per_page=30;

//Enter file path to search results page
$searchurl = "/boats/used/index.php";

//Include database file
require("classes/db.class.php");
$db = new db();

$Query = "SELECT * FROM boatdetails WHERE BoatID > 0";

if (@$_GET['makemodel'] && $_GET['makemodel'] != ""){
	$WholeMakeModel = $db->sanitise($_GET['makemodel']);
	$MakeModels = explode(" ", $WholeMakeModel);
	foreach($MakeModels as $SearchMakeModel){
		$Query.= " AND MakeModel LIKE '%$SearchMakeModel%'";
	}	
}				
if (@$_GET['make'] && $_GET['make'] != ""){
	$SearchMake = $db->sanitise($_GET['make']);
	$Query.= " AND Make ='$SearchMake'";
}
if (@$_GET["type"] && $_GET["type"] != ""){
	$SearchType = $db->sanitise($_GET["type"]);
	$Query.= " AND Category ='$SearchType'";
}
if (@$_GET["minprice"] && $_GET["minprice"] != ""){
	$SearchMinPrice = $db->sanitise($_GET["minprice"]);
	$Query.= " AND Price >='$SearchMinPrice'";
}
if (@$_GET["maxprice"] && $_GET["maxprice"] != ""){
	$SearchMaxPrice = $db->sanitise($_GET["maxprice"]);
	$Query.= " AND Price <='$SearchMaxPrice'";
}
if (@$_GET["units"] && $_GET["units"] == "metres"){
	if (@$_GET["minlength"] && $_GET["minlength"] != ""){
		$SearchMinLength = $db->sanitise($_GET["minlength"]);
		$Query.= " AND Length_mt >='$SearchMinLength'";
	}
	if (@$_GET["maxlength"] && $_GET["maxlength"] != ""){
		$SearchMaxLength = $db->sanitise($_GET["maxlength"]);
		$Query.= " AND Length_mt <='$SearchMaxLength'";
	}
} else {
	if (@$_GET["minlength"] && $_GET["minlength"] != ""){
		$SearchMinLength = $db->sanitise($_GET["minlength"]);
		$Query.= " AND Length_ft >='$SearchMinLength'";
	}
	if (@$_GET["maxlength"] && $_GET["maxlength"] != ""){
		$SearchMaxLength = $db->sanitise($_GET["maxlength"]);
		$Query.= " AND Length_ft <='$SearchMaxLength'";
	}
}
if (@$_GET["location"] && $_GET["location"] != ""){
	$SearchLocation = $db->sanitise($_GET["location"]);
	$Query.= " AND LocationCountry ='$SearchLocation'";
}
if (@$_GET["sort"] && $_GET["sort"] != ""){
	$SortListings = $_GET["sort"];
	if ($SortListings == "lengthdesc"){ $SortListings = "Length_ft DESC"; }
	if ($SortListings == "lengthasc"){ $SortListings = "Length_ft ASC"; }
	if ($SortListings == "pricedesc"){ $SortListings = "Price DESC"; }
	if ($SortListings == "priceasc"){ $SortListings = "Price ASC"; }
	if ($SortListings == "yeardesc"){ $SortListings = "Year DESC"; }
	if ($SortListings == "yearasc"){ $SortListings = "Year ASC"; }
	if ($SortListings == "makedesc"){ $SortListings = "Make DESC"; }
	if ($SortListings == "makeasc"){ $SortListings = "Make ASC"; }
	$Query.= " ORDER BY $SortListings";
	} else {
	$Query.= " ORDER BY Length_ft DESC";
	} 
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
	<script type="text/javascript" src="scripts/usedboats.js<?php echo $appVersion ?>"></script>
	
	<script type="text/javascript">
	function goTo(page) {
		var url="";
		hu=window.location.search.substring(1);
		query=hu.replace(/page=[0-9][0-9]/g,"");
		query=query.replace(/page=[0-9]/g,"");
	    url=url+"?page="+page+"&"+query;
	    url=url.replace(/&&/g,'&');
		document.location.href = url;
		return false;
	}
	</script>

	
	
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

	<section>
		<div class="row">
			<div class="span12">
		<!-- content-wrap starts here -->
		<div id="content-wrap">
			<form name="sortandfilter" class="" action="<?php echo $searchurl;?>" method="get">
			<div id="boat-content">
			
				<!-- START PAGE NUMBERS -->
			<div id="page-numbers">				
				<?php					
				$result=$db->db_query($Query);
				$all_result=$db->db_rows($result);
						
				// calculate total number of pages needed
				$pages=ceil($all_result/$results_per_page);
						
				//Calculate offset based on current page
				if (isset($_GET['page'])){
					$offset=$results_per_page*($_GET['page']-1);
				}else{
					$offset=0;
				}
				
				//Finalise query adding offset and number of results per page
				$Query.= " LIMIT $offset, $results_per_page";
						
				$get_first_result=$db->db_query($Query);
				
				// list number of results found and page navgation [1] 2 3 4 5
				echo $all_result . " results found... ";
				$page=1;
						    
				if (isset($_GET['page'])){
					$currentpage = $_GET['page'];
				}else{
					$currentpage = 1;
				}
					    
				if ($currentpage != 1){
					$previous = $currentpage - 1;
					echo "<a href=\"javascript:goTo(".$previous.");\">&lt;&lt;</a>&nbsp;";
				}
					    
				while($pages) {
					if ($page==$currentpage) {
						echo "<a href=\"javascript:goTo(".$page.");\"><b>[".$page."]</b></a>&nbsp;\n";
					} else {
					    echo "<a href=\"javascript:goTo(".$page.");\">".$page."</a>&nbsp;\n";
					}
					$pages--;
					$page++;
				}
	
				$lastpage=ceil($all_result/$results_per_page);
					
				if ($currentpage != $lastpage){
					$next = $currentpage + 1;
					echo "<a href=\"javascript:goTo(".$next.");\">&gt;&gt;</a>&nbsp;";
				}
	
				?>
				<div id="sort">
					Sort By: 
					<select name="sort" onchange="Javascript:document.sortandfilter.submit()">
						<option value="lengthdesc" <?php if (@$_GET['sort'] == "lengthdesc") { echo "selected=\"selected\"";}?>>Length (high to low)</option>
						<option value="lengthasc" <?php if (@$_GET['sort'] == "lengthasc") { echo "selected=\"selected\"";}?>>Length (low to high)</option>
						<option value="pricedesc" <?php if (@$_GET['sort'] == "pricedesc") { echo "selected=\"selected\"";}?>>Price (high to low)</option>
						<option value="priceasc" <?php if (@$_GET['sort'] == "priceasc") { echo "selected=\"selected\"";}?>>Price (low to high)</option>		
						<option value="yeardesc" <?php if (@$_GET['sort'] == "yeardesc") { echo "selected=\"selected\"";}?>>Year (newer to older)</option>
						<option value="yearasc" <?php if (@$_GET['sort'] == "yearasc") { echo "selected=\"selected\"";}?>>Year (older to newer)</option>
						<option value="makedesc" <?php if (@$_GET['sort'] == "makedesc") { echo "selected=\"selected\"";}?>>Make (Z to A)</option>
						<option value="makeasc" <?php if (@$_GET['sort'] == "makeasc") { echo "selected=\"selected\"";}?>>Make (A to Z)</option>
					</select>
				</div>
			</div><!-- close page-numbers -->
			<!-- END PAGE NUMBERS -->

					
					<!-- START BOATS RESULTS -->
					<div id="search-results">
						<ul class="search-result">
							<?php if ($all_result < 1){ 
								echo "<li style=\"line-height:20px\">There are no boats in our database that match your search today, however if you contact us and let us know what you are looking for, we would be glad to help.</li>";
							} else { 
								$data_p = $db->db_query($Query); 
								$countboats = 0;
								while($info = $db->db_rs($data_p)) { 
									$countboats++;
									if($countboats % 3 != "0"){
										echo "<li class=\"hproduct\">";
									} else {
										echo "<li class=\"hproduct-last\">";
									}

									echo "<a href=\"boat-details.php?BoatID=" . $info['BoatID'] . "\">"; 
									
									//Grab first image from listing
									$id = $info['BoatID'];
									$Queryboat = "SELECT * FROM images WHERE BoatID=$id ORDER BY ImageRanking LIMIT 0, 1";
									$imagedata = $db->db_query($Queryboat); 
									while($image = $db->db_rs($imagedata)) {
										echo "<div class='img-holder'><img src=\"" . $image['ImageURL'] . "\" alt=\"" . $info['Make'] . " " . $info['Model'] . "\"></div></a>";
									} 
									
									//Create H2 tag with Make and Model
									echo "<h2><a href=\"boat-details.php?BoatID=" . $info['BoatID'] . "\">" . $info['Year'] . " " . $info['Make'] . " " .$info['Model'] . "</a></h2>";
									
									//Print Boat Details
									echo "<div id=\"details\">";
									echo "<p>Length: " . $info['Length_ft'] . "ft / " . $info['Length_mt'] . "m<br/>";
									
									//Replace currency letters with the correct sign and print price
									if (@$_GET["currency"] && $_GET["currency"] != $info['PriceCurrency']){
										$fromcurrency = $info['PriceCurrency'];
										$tocurrency = $_GET['currency'];
										$price = $info['Price'];
										$Price = number_format($db->currency($fromcurrency,$tocurrency,$price));
										$PriceCurrency=str_replace("GBP","&pound;",$tocurrency);
										$PriceCurrency=str_replace("USD","&#36;",$tocurrency);
										$PriceCurrency=str_replace("AUD","AUD &#36;",$tocurrency); 
										$PriceCurrency=str_replace("NZD","NZD &#36;",$tocurrency); 
										$PriceCurrency=str_replace("EUR","&#8364;",$tocurrency);
									} else {
										$Price = number_format($info['Price']);
										$PriceCurrency=str_replace("GBP","&pound;",$info['PriceCurrency']);
										$PriceCurrency=str_replace("USD","&#36;",$info['PriceCurrency']);
										$PriceCurrency=str_replace("AUD","AUD &#36;",$info['PriceCurrency']); 
										$PriceCurrency=str_replace("NZD","NZD &#36;",$info['PriceCurrency']); 
										$PriceCurrency=str_replace("EUR","&#8364;",$info['PriceCurrency']);
									}
									$PriceCurrency=str_replace("GBP","&pound;",$PriceCurrency);
									if ($Price != "1") {
										echo "Price: <span class=\"boatprice\">" . $PriceCurrency . $Price;
									} else {
										echo "Price: Contact us for price";
									}
		
									
									//Generate Tax Status
									if ($info['TaxStatus'] == "Not Paid"){
										echo " ex Vat";
									} else if  ($info['TaxStatus'] == "Paid"){
										echo " inc Vat";
									}
									echo "</span><br/>";
									
									//Generate Location and View specs button
									if ($info['LocationCity'] != "Unknown"){
										echo "Location: " . $info['LocationCity'] . ", ";
									} else {
										echo "Location: ";	
									}			
									echo $info['LocationCountry'] . "<br/></p>";
									echo "</div>";
									echo "<div class=\"view-button\"><a href=\"boat-details.php?BoatID=" . $info['BoatID'] . "\" title=\"" .$info['Make'] . " " . $info['Model'] . " for sale\">View Details</a></div>";
									echo "</li>";
								}
							}?>
						</ul>			
					</div>
					<!-- END BOAT RESULTS -->
					
				</div>
				<div id="sidebar-search" class="sidebar-search">
					<div class="sidebar-content">
						<!-- START SEARCH BOX -->
						<h4>SEARCH BOATS FOR SALE</h4>
						<div class="option">
							Boat Type<br/>
								<select name="type" id="Type">
								<?php if (!$_GET['type'] || $_GET['type'] == ""){?>
				              		<option value="" selected="selected">All 
									Boats</option>					
				              	<? }else{ ?>
									<option value="" >All Boats</option>
								<? }
								$Querysearch = "SELECT DISTINCT Category FROM boatdetails ORDER BY Category";
								$result = $db->db_query($Querysearch);
								while ( $row = $db->db_rs( $result ) ) {			
									$SearchType = $row["Category"];
									if ($_GET['type'] == $SearchType){
										echo "<option value=\"" . $SearchType . "\" selected=\"selected\">" . $SearchType . "</option>";
									} else if ($SearchType != ""){	 
		              					echo "<option value=\"" . $SearchType . "\">" . $SearchType . "</option>";
									}
								}?>
		            		</select>            
		            	</div>
		            	<div class="option">
		            		Manufacturer/Model<br/>   
		            		<?php if (@$_GET['makemodel']){ 
		            			echo "<input class='wide' name=\"makemodel\" type=\"text\" value=\"" . $_GET['makemodel'] . "\"/>&nbsp;&nbsp;";
		            		} else {
		            			echo "<input class='wide' name=\"makemodel\" type=\"text\"/>&nbsp;&nbsp;";
		            		}?>
		            	</div>
		            	<div class="option">
		            		Min Price<br/>
		            		<?php if (@$_GET['minprice']){ 
		            			echo "<input class='narrow' name=\"minprice\" type=\"text\" value=\"" . $_GET['minprice'] . "\"/>&nbsp;&nbsp;";
		            		} else {
		            			echo "<input class='narrow' name=\"minprice\" type=\"text\"/>&nbsp;&nbsp;";
		            		}?>
		            	</div>
		            	<div class="option">
		            		Max Price<br/>
		            		<?php if (@$_GET['maxprice']){ 
		            			echo "<input class='narrow' name=\"maxprice\" type=\"text\" value=\"" . $_GET['maxprice'] . "\"/>&nbsp;&nbsp;";
		            		} else {
		            			echo "<input class='narrow' name=\"maxprice\" type=\"text\"/>&nbsp;&nbsp;";
		            		}?>
		            	</div>
		            	<div class="option">
		            		Currency<br/>
							<select name="currency">
								<?php if (!$_GET['currency'] || $_GET['currency'] == ""){?>
				              		<option value="" selected="selected">-</option>
				              		<option value="GBP">British Pounds</option>
									<option value="EUR">Euros</option>
								<? }else if ($_GET['currency'] == "GBP"){ ?>
									<option value="" >-</option>
									<option value="GBP" selected="selected">
									British Pounds</option>
									<option value="EUR">Euros</option>
								<? }else if ($_GET['currency'] == "EUR"){ ?>
									<option value="">-</option>
									<option value="GBP">British Pounds</option>
									<option value="EUR" selected="selected">
									Euros</option>
								<? } ?>
							</select>					
						</div>
		            	<div class="option">
		            		Min Length<br/>
		            		<?php if (@$_GET['minlength']){ 
		            			echo "<input class='narrow' name=\"minlength\" type=\"text\" value=\"" . $_GET['minlength'] . "\"/>&nbsp;&nbsp;";
		            		} else {
		            			echo "<input class='narrow' name=\"minlength\" type=\"text\"/>&nbsp;&nbsp;";
		            		}?>
		            	</div>
		            	<div class="option">
		            		Max Length<br/>
		            		<?php if (@$_GET['maxlength']){ 
		            			echo "<input class='narrow' name=\"maxlength\" type=\"text\" value=\"" . $_GET['maxlength'] . "\"/>&nbsp;&nbsp;";
		            		} else {
		            			echo "<input class='narrow' name=\"maxlength\" type=\"text\"/>&nbsp;&nbsp;";
		            		}?>
		            	</div>
		            	<div class="option">
		            		&nbsp;<br/>
							<select name="units" style="width: 40px">
								<?php if (!$_GET['units'] || $_GET['units'] == ""){?>
				              		<option value="" selected="selected">-</option>
				              		<option value="feet">ft</option>
									<option value="metres">m</option>
								<? }else if ($_GET['units'] == "feet"){ ?>
									<option value="" >-</option>
									<option value="feet" selected="selected">ft</option>
									<option value="metres">m</option>
								<? }else if ($_GET['units'] == "metres"){ ?>
									<option value="">-</option>
									<option value="feet">ft</option>
									<option value="metres" selected="selected">m</option>
								<? } ?>
							</select>					
						</div>
		            	<div class="option">
		            		In This Country<br/>
							<select name="location" id="Location">
								<?php if (!$_GET['location'] || $_GET['location'] == ""){?>
				              		<option value="" selected="selected">
									Anywhere</option>
								<? }else{ ?>
									<option value="" >Anywhere</option>
								<? }
								$Querysearch = "SELECT DISTINCT LocationCountry FROM boatdetails ORDER BY LocationCountry";
								$result = $db->db_query($Querysearch);
								while ( $row = $db->db_rs( $result ) ) {
									$SearchLocation = $row["LocationCountry"]; 
									if ($_GET['location'] == $SearchLocation){ 
										echo "<option value=\"" . $SearchLocation . "\" selected=\"selected\">" . $SearchLocation . "</option>";							
									} else if ($SearchLocation != ""){	 
		              					echo "<option value=\"" . $SearchLocation . "\">" . $SearchLocation . "</option>";
									}
								}?>
		            		</select>            
		            	</div>
		            	<input type="submit" class="button" name="SimpleSearch" value="Search Boats" />
					</form>
		        <!-- END SEARCH BOX -->
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