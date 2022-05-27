

<?php

function asset_path($dir = '')
{

	return get_stylesheet_directory_uri() . "/dist/" . $dir;
}


add_action('wp_enqueue_scripts', function () {


	wp_register_style('Main.Css', get_stylesheet_directory_uri() . '/dist/styles/main.css', false, THEME_VERSION);
	wp_enqueue_style('Main.Css');

	wp_register_script('Main.Js', get_stylesheet_directory_uri() . '/dist/scripts/main.js', ['jquery'], THEME_VERSION, true);
	wp_enqueue_script('Main.Js');


	wp_register_style('bootstrapCss', get_stylesheet_directory_uri() . '/resources/assets/library/bootstrap/css/bootstrap.min.css', array(), rand(), 'all');
    wp_enqueue_style('bootstrapCss');

    wp_register_script('bootstrapJs', get_stylesheet_directory_uri() . '/resources/assets/library/bootstrap/js/bootstrap.min.js', array('jquery'), rand(), 'all');
    wp_enqueue_script('bootstrapJs');

	wp_register_style('lineAwesome', get_stylesheet_directory_uri() . '/resources/assets/library/line-awesome/css/line-awesome.min.css', array(), rand(), 'all');
    wp_enqueue_style('lineAwesome');



});


// remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

// add_action( 'woocommerce_review_order_after_payment', 'woocommerce_checkout_coupon_form' );


// require get_stylesheet_directory() . '/functions/classes/index.php';

// require 'classes/mainClasses.php';

// $l = new ACF_CUSTOM();

// $l->testClass();


?>