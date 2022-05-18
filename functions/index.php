

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

});



?>