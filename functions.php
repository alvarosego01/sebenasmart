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




// require( get_stylesheet_directory_uri() . '/functions/index.php' );



function asset_path($dir = '')
{

	return get_stylesheet_directory_uri() . "/dist/" . $dir;
}


add_action('wp_enqueue_scripts', function () {


	wp_register_style('Main.Css', get_stylesheet_directory_uri() . '/dist/styles/main.css', false, THEME_VERSION);
	wp_enqueue_style('Main.Css');

	wp_register_script('Main.Js', get_stylesheet_directory_uri() . '/dist/scripts/main.js', ['jquery'], THEME_VERSION, true);
	wp_enqueue_script('Main.Js');


	wp_register_style('bootstrapCss', get_stylesheet_directory_uri() . '/resources/assets/bootstrap/dist/css/bootstrap.min.css', array(), rand(), 'all');
    wp_enqueue_style('bootstrapCss');

    wp_register_script('bootstrapJs', get_stylesheet_directory_uri() . '/resources/assets/bootstrap/dist/js/bootstrap.min.js', array('jquery'), rand(), 'all');
    wp_enqueue_script('bootstrapJs');


});











