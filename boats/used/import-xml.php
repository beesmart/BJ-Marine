<?php 
//This document imports the XML feeds from the spice rack service, you will need to set up a cron job to run this file once a day or more often if the client requires it
ini_set('max_execution_time', '160');

//Set IMT Spicerack URLS, add a new line in the array for each office URL, comment out code below to use elba single broker feed
$urls = array(
	"http://account.boatwizard.com/spice-rack/owner/6105/boats?status=on",
	"http://account.boatwizard.com/spice-rack/owner/19462/boats?status=on",
	"http://account.boatwizard.com/spice-rack/owner/19486/boats?status=on",
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
	if($currencycode == "EUR"){
		$rate = 1;
	} else {
		$rate = $db->findrate('EUR',$currencycode,1);
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
}
}
?>

