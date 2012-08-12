<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/lib/menuGenerator.php';

	$menuGenerator = new MenuGenerator();

	$menuData = array(
		array("label" => "Home", "url" => "/index.php", "activeTag" => "home"),
		array("label" => "New Boats", "url" => "/boats/new/index.php", "activeTag" => "boats-new"),
		array("label" => "Used Boats", "url" => "/boats/used/index.php", "activeTag" => "boats-used"),
		array("label" => "Sell Your Boat", "url" => "/boats/brokerage/index.php", "activeTag" => "boats-brokerage"),
		array("label" => "Contact", "url" => "/contact.php", "activeTag" => "contact")
	);

	echo $menuGenerator->getMenu($menuData);
?>
