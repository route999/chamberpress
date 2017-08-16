<?php
define("SITEURL", get_bloginfo("url"));
define("THEMEDIR", get_template_directory_uri());


require_once( 'lib/enqueue-scripts.php' );
require_once( 'lib/clean-header.php' );
require_once( 'lib/foundation.php' );
require_once( 'lib/nav.php' );
require_once( 'lib/sidebar-areas.php' );
require_once( 'lib/foundation-classes.php' );


if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Logos',
		'menu_title'	=> 'Logos',
		'menu_slug' 	=> 'logos-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
}