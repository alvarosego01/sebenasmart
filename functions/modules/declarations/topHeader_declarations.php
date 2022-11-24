<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<?php
if(!function_exists('topHeader_remove_actions')){
	function topHeader_remove_actions(){

        remove_action( 'martfury_before_header', 'martfury_promotion', 5 );

    }
}
add_action( 'init', 'topHeader_remove_actions');


if ( ! function_exists( 'sbn_custom_promotion' ) ) {
	function sbn_custom_promotion() {
		$promotion = apply_filters( 'martfury_get_promotion', martfury_get_option( 'promotion' ) );
		if ( ! intval( $promotion ) ) {

			return;
		}

		if ( is_404() || is_page_template( 'template-coming-soon-page.php' ) ) {

			return;
		}

		if ( intval( martfury_get_option( 'promotion_home_only' ) ) && ! is_front_page() ) {

			return;
		}

		$button      = '';
		$button_text = martfury_get_option( 'promotion_button_text' );
		$button_link = martfury_get_option( 'promotion_button_link' );
		if ( ! empty( $button_text ) && ! empty( $button_link ) ) {
			$button = sprintf( '<a class="sbn_buttonCustom sbn_btn_small sbn_primaryButton left_side" href="%s"><span class="icon_container"><i class="fa-solid fa-arrow-right-long"></i></span> %s</a>', esc_url( $button_link ), esc_html( $button_text ) );
		}

		if ( intval( martfury_get_option( 'promotion_close' ) ) ) {
			$button .= '<span class="close"><i class="icon-cross2"></i></span>';
		}

		printf(
			'<div id="top-promotion" class="top-promotion promotion style-%s">
				<div class="%s">
					<div class="promotion-content">
						<div class="promo-inner">
						%s
						</div>
						<div class="promo-link">
						%s
						</div>
					</div>
				</div>
			</div>',
			esc_attr( martfury_get_option( 'promotion_style' ) ),
			martfury_header_container_classes(),
			do_shortcode( wp_kses( martfury_get_option( 'promotion_content' ), wp_kses_allowed_html( 'post' ) ) ),
			$button
		);


		print_r($martfury_header_container_classes);
	}
}
add_action( 'martfury_before_header', 'sbn_custom_promotion', 5 );

?>