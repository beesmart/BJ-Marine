<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/lib/menuGenerator.php';

	$menuGenerator = new MenuGenerator();

	$menuData = array(
		array("label" => "Our Team", "url" => "/about/team.php", "activeTag" => "team"),
		array("label" => "Our Offices", "url" => "/about/offices/index.php", "activeTag" => "offices"),
		array("label" => "About Us", "url" => "/about/index.php", "activeTag" => "history"),
		array("label" => "Services", "url" => "/about/services.php", "activeTag" => "services")
	);

	echo $menuGenerator->getMenu($menuData);
?>
