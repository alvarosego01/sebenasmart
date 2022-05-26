<?php


add_action( 'wp_enqueue_scripts', 'martfury_child_enqueue_scripts', 20 );

function martfury_child_enqueue_scripts() {
	wp_enqueue_style( 'martfury-child-style', get_stylesheet_uri() );
	if ( is_rtl() ) {
		wp_enqueue_style( 'martfury-rtl', get_template_directory_uri() . '/rtl.css', array(), '20180105' );
	}
}

$theme = wp_get_theme();

define('THEME_VERSION', $theme->Version);
define( 'CHILD_DIR', get_stylesheet_directory_uri() );

// instanciar index

// echo get_stylesheet_directory();

require get_stylesheet_directory() . '/functions/index.php';















