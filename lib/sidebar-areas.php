<?php
if ( ! function_exists( 'chamberpress_sidebar_widgets' ) ) :
function chamberpress_sidebar_widgets() {
	register_sidebar(array(
	  'id' => 'sidebar-widgets',
	  'name' => __( 'Sidebar widgets', 'chamberpress' ),
	  'description' => __( 'Drag widgets to this sidebar container.', 'chamberpress' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h6>',
	  'after_title' => '</h6>',
	));

	register_sidebar(array(
	  'id' => 'footer-widgets',
	  'name' => __( 'Footer widgets', 'chamberpress' ),
	  'description' => __( 'Drag widgets to this footer container', 'chamberpress' ),
	  'before_widget' => '<article id="%1$s" class="large-4 columns widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h6>',
	  'after_title' => '</h6>',
	));
}

add_action( 'widgets_init', 'chamberpress_sidebar_widgets' );
endif;
