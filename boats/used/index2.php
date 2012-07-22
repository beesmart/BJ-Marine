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
$searchurl = "/used-boats/index.php";

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
	// BJ Marine Header
	$_REQUEST['page'] = "boats-used";
	include $_SERVER['DOCUMENT_ROOT'].'/skin/header.php';
?>

<form name="sortandfilter" class="" action="<?php echo $searchurl;?>" method="get">

<div id="boat-content">

	<!-- START PAGE NUMBERS -->
	<div id="page-numbers">				
		<?php					
		$result=$db->db_query($Query);
		$all_result=$db->db_rows($result);
				
		// calculate total number of pages needed
		$pages=ceil($all_result/$results_per_page);
				
		if (isset($_GET['page'])){
			$offset=$results_per_page*($_GET['page']-1);
		}else{
			$offset=0;
		}
				
		$Query.= " LIMIT $offset, $results_per_page";
				
		$get_first_result=$db->db_query($Query);
		// list page navgation ([1] 2 3 4 5)
			echo $all_result . " results found... ";
			$page=1;
					
			if (isset($_GET['page'])){
				$currentpage = $_GET['page'];
			}else{
				$currentpage = 1;
			}
			
			$lastpage=ceil($all_result/$results_per_page);
					
			if ($currentpage != 1){
				//If current page is not first page
				$previous = $currentpage - 1;
				echo "<a href=\"javascript:goTo(".$previous.");\">&lt;&lt; Previous</a>&nbsp;<a href=\"javascript:goTo(".($currentpage-1).");\">".($currentpage-1)."</a>";
			}
			
			echo "&nbsp;<a href=\"javascript:goTo(".$page.");\"><b>[".$currentpage."]</b></a>\n";
			
			if ($currentpage != $lastpage && ($currentpage+1) != $lastpage && $currentpage == 1){
				//If current page is not last page and is first page
				$next = $currentpage + 1;
				echo "<a href=\"javascript:goTo(".($currentpage+1).");\">".($currentpage+1)."</a>&nbsp;<a href=\"javascript:goTo(".($currentpage+2).");\">".($currentpage+2)."</a>&nbsp;<a href=\"javascript:goTo(".$next.");\">Next &gt;&gt;</a>&nbsp;";
			} else if ($currentpage != $lastpage ){
				//If current page is not last page
				$next = $currentpage + 1;
				echo "<a href=\"javascript:goTo(".($currentpage+1).");\">".($currentpage+1)."</a>&nbsp;<a href=\"javascript:goTo(".$next.");\">Next &gt;&gt;</a>&nbsp;";
			}
			?>
			<div id="sort">
				Sort By: 
				<select name="sort" onchange="Javascript:document.sortandfilter.submit()">
					<option value="lengthdesc" <?php if (@$_GET['sort'] == "lengthdesc") { echo "selected=\"selected\"";}?>>
					Length (high to low)</option>
					<option value="lengthasc" <?php if (@$_GET['sort'] == "lengthasc") { echo "selected=\"selected\"";}?>>
					Length (low to high)</option>
					<option value="pricedesc" <?php if (@$_GET['sort'] == "pricedesc") { echo "selected=\"selected\"";}?>>
					Price (high to low)</option>
					<option value="priceasc" <?php if (@$_GET['sort'] == "priceasc") { echo "selected=\"selected\"";}?>>
					Price (low to high)</option>
					<option value="yeardesc" <?php if (@$_GET['sort'] == "yeardesc") { echo "selected=\"selected\"";}?>>
					Year (newer to older)</option>
					<option value="yearasc" <?php if (@$_GET['sort'] == "yearasc") { echo "selected=\"selected\"";}?>>
					Year (older to newer)</option>
					<option value="makedesc" <?php if (@$_GET['sort'] == "makedesc") { echo "selected=\"selected\"";}?>>
					Make (Z to A)</option>
					<option value="makeasc" <?php if (@$_GET['sort'] == "makeasc") { echo "selected=\"selected\"";}?>>
					Make (A to Z)</option>
				</select>
			</div>
		</div>
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
		<!-- START PAGE NUMBERS -->
		<div id="page-numbers">				
		<?php					
			// list page navgation ([1] 2 3 4 5)
			$bottompages=ceil($all_result/$results_per_page);
				
			echo $all_result . " results found... ";
			$bottompage=1;
					
			if (isset($_GET['page'])){
				$bottomcurrentpage = $_GET['page'];
			}else{
				$bottomcurrentpage = 1;
			}
			
			if ($bottomcurrentpage != 1){
				//If current page is not first page
				$previous = $bottomcurrentpage - 1;
				echo "<a href=\"javascript:goTo(".$previous.");\">&lt;&lt; Previous</a>&nbsp;<a href=\"javascript:goTo(".($bottomcurrentpage-1).");\">".($bottomcurrentpage-1)."</a>";
			}
			
			echo "&nbsp;<a href=\"javascript:goTo(".$page.");\"><b>[".$bottomcurrentpage."]</b></a>\n";
			
			if ($bottomcurrentpage != $lastpage && ($bottomcurrentpage+1) != $lastpage && $bottomcurrentpage == 1){
				//If current page is not last page and is first page
				$next = $bottomcurrentpage + 1;
				echo "<a href=\"javascript:goTo(".($bottomcurrentpage+1).");\">".($bottomcurrentpage+1)."</a>&nbsp;<a href=\"javascript:goTo(".($bottomcurrentpage+2).");\">".($bottomcurrentpage+2)."</a>&nbsp;<a href=\"javascript:goTo(".$next.");\">Next &gt;&gt;</a>&nbsp;";
			} else if ($bottomcurrentpage != $lastpage ){
				//If current page is not last page
				$next = $bottomcurrentpage + 1;
				echo "<a href=\"javascript:goTo(".($bottomcurrentpage+1).");\">".($bottomcurrentpage+1)."</a>&nbsp;<a href=\"javascript:goTo(".$next.");\">Next &gt;&gt;</a>&nbsp;";
			}

		?>
		</div>
		<!-- END PAGE NUMBERS -->
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
			<?php 
			if ($_GET['sent']){
			echo "<p class=\"top-para\">THANK YOU</p><p>Your enquiry has been sent sucessfully and a member of our team will be in contact as soon as possible</p>";
			}else{?>
	
			<p>Let us know what you are looking for using the 
			enquiry form below</p>
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

<?php include $_SERVER['DOCUMENT_ROOT'].'/skin/footer.php'; ?>