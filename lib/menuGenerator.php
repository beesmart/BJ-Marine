<?php
	class MenuGenerator
	{
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
					.$this->getMenu($menuItem['children'], 'dropdown-menu');
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

		function getMenu($menuItems, $ulClass = 'nav') {
			$menu = '<ul class="'.$ulClass.'">';

			foreach ($menuItems as $menuItem) {
				$menu .= $this->getMenuItem($menuItem);
			}

			$menu .= '</ul>';
			return $menu;
		}
	}
?>
