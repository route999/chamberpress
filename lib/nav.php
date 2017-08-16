<?php
/**
 * Register Menus
 *
 * @link http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

register_nav_menus(array(
	'main-nav'  => 'Main Menu',
	'footer-nav' => 'Footer Menu',
));

if ( ! function_exists( 'foundationpress_top_bar_r' ) ) {
	function foundationpress_top_bar_r() {
		wp_nav_menu( array(
			'container'      => false,
			'menu_class'     => 'dropdown menu',
			'items_wrap'     => '<ul id="%1$s" class="%2$s desktop-menu" data-dropdown-menu>%3$s</ul>',
			'theme_location' => 'main-nav',
			'depth'          => 3,
			'fallback_cb'    => false,
			'walker'         => new Foundation_Top_Bar_Walker(),
		));
	}
}

if ( ! function_exists( 'foundationpress_mobile_nav' ) ) {
	function foundationpress_mobile_nav() {
		wp_nav_menu( array(
			'container'      => false,
			'menu'           => 'footer-nav',
			'menu_class'     => 'vertical menu',
			'theme_location' => 'mobile-nav',
			'items_wrap'     => '<ul id="%1$s" class="%2$s" data-accordion-menu>%3$s</ul>',
			'fallback_cb'    => false,
			'walker'         => new Foundation_Top_Bar_Walker(),
		));
	}
}

