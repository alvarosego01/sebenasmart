<?php




define('THEME_VERSION', wp_get_theme()->get('Version'));
define( 'CHILD_DIR', get_stylesheet_directory_uri() );



add_action( 'wp_enqueue_scripts', 'martfury_child_enqueue_scripts', 20 );
function martfury_child_enqueue_scripts() {
	wp_enqueue_style( 'martfury-child-style', get_stylesheet_uri() );
	if ( is_rtl() ) {
		wp_enqueue_style( 'martfury-rtl', get_template_directory_uri() . '/rtl.css', array(), '20180105' );
	}
}






require get_stylesheet_directory() . '/functions/index.php';


















