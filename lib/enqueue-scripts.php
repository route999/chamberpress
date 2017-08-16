<?php 
if ( ! function_exists( 'foundationpress_scripts' ) ) :
	function chamber_scripts() {
		
		wp_enqueue_style( 'main-stylesheet', THEMEDIR . '/css/foundation.min.css', array(), '6.3.1', 'all' );
		wp_enqueue_style( 'theme-stylesheet', THEMEDIR . '/style.css', array('main-stylesheet'), '', 'all' );
		wp_enqueue_script( 'what-input', THEMEDIR . '/js/vendor/what-input.js', array('jquery'), '6.3.1', true );
		wp_enqueue_script( 'foundation', THEMEDIR . '/js/vendor/foundation.min.js', array('what-input'), '6.3.1', true );
		wp_enqueue_script( 'theme-main', THEMEDIR . '/js/app.js', array('what-input'), '6.3.1', true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'chamber_scripts' );
endif;