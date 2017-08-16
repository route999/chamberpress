<?php

if ( ! function_exists( 'chamberpress_start_cleanup' ) ) :
function chamberpress_start_cleanup() {
	add_action( 'init', 'chamberpress_cleanup_head' );
	add_filter( 'the_generator', 'chamberpress_remove_rss_version' );
	add_filter( 'wp_head', 'chamberpress_remove_wp_widget_recent_comments_style', 1 );
	add_action( 'wp_head', 'chamberpress_remove_recent_comments_style', 1 );

}
add_action( 'after_setup_theme','chamberpress_start_cleanup' );
endif;


if ( ! function_exists( 'chamberpress_cleanup_head' ) ) :
function chamberpress_cleanup_head() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'rel_canonical', 10, 0 );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
}
endif;


if ( ! function_exists( 'chamberpress_remove_rss_version' ) ) :
function chamberpress_remove_rss_version() { return ''; }
endif;


if ( ! function_exists( 'chamberpress_remove_wp_widget_recent_comments_style' ) ) :
function chamberpress_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
	  remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}
endif;


if ( ! function_exists( 'chamberpress_remove_recent_comments_style' ) ) :
function chamberpress_remove_recent_comments_style() {
	global $wp_widget_factory;
	if ( isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments']) ) {
	remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}
endif;