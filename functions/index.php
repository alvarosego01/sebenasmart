<?php


require "modules/main.php";
require 'mf_customFunctions/mf_customFunctions.php';






$theme = wp_get_theme();

define('THEME_VERSION', $theme->Version);
define( 'CHILD_DIR', get_stylesheet_directory_uri() );

function asset_path($dir = '')
{

	return get_stylesheet_directory_uri() . "/dist/" . $dir;
}






?>