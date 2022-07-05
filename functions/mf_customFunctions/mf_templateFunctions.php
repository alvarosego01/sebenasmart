<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<?php

if ( ! function_exists( 'sbn_get_content_columns' ) ) :
	function sbn_get_content_columns( $layout = null ) {
		$layout  = $layout ? $layout : martfury_get_layout();
		$classes = array( 'col-md-9', 'col-sm-12', 'col-xs-12' );

		if ( is_product() ) {

			if(martfury_get_product_layout() == '2'){
				$classes = array( 'col-md-12', 'col-sm-12', 'col-xs-12' );

				// woocommerce_after_single_product_summary
				remove_action('woocommerce_after_single_product_summary', 0);

			}

		}

		if ( ! in_array( $layout, array( 'sidebar-content', 'content-sidebar', 'small-thumb' ) ) ) {
			$classes = array( 'col-md-12' );
		}


		return $classes;
	}

endif;

/**
 * Echos Bootstrap column classes for content area
 *
 * @since 1.0
 */

if ( ! function_exists( 'sbn_content_columns' ) ) :
	function sbn_content_columns( $layout = null ) {

		echo implode( ' ', sbn_get_content_columns( $layout ) );

	}
endif;

add_action( 'wp', 'njengah_remove_sidebar_product_pages' );

function  njengah_remove_sidebar_product_pages() {

    if ( is_product() ) {

    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

   }

}


?>