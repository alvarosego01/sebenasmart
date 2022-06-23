<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Martfury
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="viewport" content="initial-scale=1.0, width=device-width">

    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>



	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

</head>



<?php

	$class = _getField('custom_parent_class_section' , get_the_ID());
	$id = _getField('template_custom' , get_the_ID());

	specialInitFiles( get_the_ID() );


?>



<body <?php body_class( $class ); ?> id="<?php echo $id ?>" >
<?php martfury_body_open(); ?>

<div id="page" class="hfeed site">
	<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
		?>
		<?php do_action( 'martfury_before_header' ); ?>
        <header id="site-header" class="site-header <?php martfury_header_class(); ?>">
			<?php do_action( 'martfury_header' ); ?>
        </header>
	<?php } ?>
	<?php do_action( 'martfury_after_header' ); ?>

    <div id="content" class="site-content">
		<?php do_action( 'martfury_after_site_content_open' ); ?>
