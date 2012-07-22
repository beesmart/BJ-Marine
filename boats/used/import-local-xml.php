<?php 
//Set XML URLS, add a new line in the array for each office URL, or single line for single broker feed
$urls = array(
	"/home/wizard/public_html/bjmarine.net/used-boats/bjmarine.xml",
	);

//-------------No need to edit below this line--------------

//Include Database File
require("classes/db.class.php");
$db = new db();

//Clear Database
$clear = "DELETE FROM boatdetails";
$db->db_query($clear);

$clear = "DELETE FROM descriptions";
$db->db_query($clear);

$clear = "DELETE FROM engines";
$db->db_query($clear);

$clear = "DELETE FROM features";
$db->db_query($clear);

$clear = "DELETE FROM images";
$db->db_query($clear);

$clear = "DELETE FROM videos";
$db->db_query($clear);

$clear = "DELETE FROM currencies";
$db->db_query($clear);

//Import currencies
$currencycodes = array("AUD","CAD","DKK","EUR","NZD","NOK","GBP","RUB","SEK","USD",);
foreach ($currencycodes as $currencycode){
	if($currencycode == "GBP"){
		$rate = 1;
	} else {
		$rate = $db->findrate('GBP',$currencycode,1);
	}
							
	//Insert currencies into db
	$insert = "INSERT INTO currencies
	SET currency = '$currencycode',
	rate = '$rate'
	";
	$result = $db->db_query($insert);
}

//Run import on each XML URL in array
foreach ($urls as $url){
$result = $db->run_import($url);
if ($result == 1){
	echo "$url Feed imported sucessfully<br>";
} else {
	echo "$url Feed import unsucessful<br>";
	$msg = "BJ Marine XML feed unsucessful: $url";
	$mailheaders  = "MIME-Version: 1.0\r\n";
	$mailheaders .= "Content-type: text/plain; charset=iso-8859-1\r\n";
	$mailheaders .= "From: BWWS Alerts <info@boatwizardwebsolutions.co.uk>\r\n";
	$mailheaders .= "Reply-To: BWWS Alerts <info@boatwizardwebsolutions.co.uk>\r\n"; 
	mail("support@boats.com","BWWS XML Alert",stripslashes($msg), $mailheaders);
}
}
?>

