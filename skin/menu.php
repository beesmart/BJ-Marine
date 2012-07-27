<?php

	function getMenuItem($menuItem) {
		$item = '';
		if(isset($menuItem) && is_array($menuItem) && array_key_exists('children', $menuItem)) {
			if(strpos($_REQUEST['page'],$menuItem['activeTag']) !== false) {
				$item .= '<li class="active dropdown">';
			} else {
				$item .= '<li class="dropdown">';
			}
			$item .= '<a class="dropdown-toggle" data-toggle="dropdown" href="#">'
				.$menuItem['label'].' <b class="caret"></b></a>'
				.writeMenuItems($menuItem['children'], 'dropdown-menu');
		} else {
			if(strpos($_REQUEST['page'],$menuItem['activeTag']) !== false) {
				$item .= '<li class="active">';
			} else {
				$item .= '<li>';
			}
			$item .= '<a href="'.$menuItem['url'].'">'
				.$menuItem['label'].'</a>';
		}

		return $item.'</li>';
	}

	function writeMenuItems($menuItems, $ulClass = 'nav') {
		$menu = '<ul class="'.$ulClass.'">';

		foreach ($menuItems as $menuItem) {
			$menu .= getMenuItem($menuItem);
		}

		$menu .= '</ul>';
		return $menu;
	}

	$linksLeft = array(
		array("label" => "Home", "url" => "/index.php", "activeTag" => "home"),
		array("label" => "New Boats", "url" => "/boats/new/index.php", "activeTag" => "boats-new"),
		array("label" => "Used Boats", "url" => "/boats/used/index.php", "activeTag" => "boats-used"),
		array("label" => "Sell Your Boat", "url" => "/boats/brokerage/index.php", "activeTag" => "boats-brokerage")
	);

	$linksRight = array(
		array("label" => "Our Team", "url" => "/about/team.php", "activeTag" => "team"),
		array("label" => "About Us", "url" => "", "activeTag" => "about",
			"children" => array(
				array("label" => "Our History", "url" => "/about/index.php", "activeTag" => "about-history"),
				array("label" => "Our Offices", "url" => "/about/offices/index.php", "activeTag" => "about-offices"),
				array("label" => "Our Services", "url" => "/about/services.php", "activeTag" => "about-services")
			)
		),
		array("label" => "Contact", "url" => "/contact.php", "activeTag" => "contact")
	);

	echo writeMenuItems($linksLeft);
	echo writeMenuItems($linksRight, 'nav pull-right');

?>

