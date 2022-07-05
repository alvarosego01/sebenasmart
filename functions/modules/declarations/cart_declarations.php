<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<?php


if(!function_exists('cart_remove_actions')){
	function cart_remove_actions(){
		remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );
		remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );
    }
}
add_action( 'init', 'cart_remove_actions');



if ( ! function_exists( 'sbn_woocommerce_widget_shopping_cart_button_view_cart' ) ) {

	/**
	 * Output the view cart button.
	 */
	function sbn_woocommerce_widget_shopping_cart_button_view_cart() {
		echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="sbn_buttonCustom sbn_btn_small sbn_secondaryButton left_side "><span class="icon_container"><i class="fa-solid fa-cart-shopping"></i></span> ' . esc_html__( 'View cart', 'woocommerce' ) . '</a>';
	}
}



add_action( 'woocommerce_widget_shopping_cart_buttons', 'sbn_woocommerce_widget_shopping_cart_button_view_cart', 10 );

if ( ! function_exists( 'sbn_woocommerce_widget_shopping_cart_proceed_to_checkout' ) ) {

	/**
	 * Output the view cart button.
	 */
	function sbn_woocommerce_widget_shopping_cart_proceed_to_checkout() {
		echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="sbn_buttonCustom sbn_btn_small sbn_primaryButton left_side "><span class="icon_container"><i class="fa-solid fa-credit-card"></i></span>' . esc_html__( 'Checkout', 'woocommerce' ) . '</a>';
	}
}



add_action( 'woocommerce_widget_shopping_cart_buttons', 'sbn_woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );

?>