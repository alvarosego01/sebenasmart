<?php
/**
 * Shipping Methods Display
 *
 * In 2.1 we show methods per package. This allows for multiple methods per order if so desired.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

$formatted_destination    = isset( $formatted_destination ) ? $formatted_destination : WC()->countries->get_formatted_address( $package['destination'], ', ' );
$has_calculated_shipping  = ! empty( $has_calculated_shipping );
$show_shipping_calculator = ! empty( $show_shipping_calculator );
$calculator_text          = '';
?>
<tr class="woocommerce-shipping-totals shipping">
	<td colspan="2" data-title="<?php echo esc_attr( $package_name ); ?>">
        <h4 class="shipping-title"><?php echo wp_kses_post( $package_name ); ?></h4>
		<?php if ( $available_methods ) : ?>

			<ul id="shipping_method" class="woocommerce-shipping-methods">
				<?php foreach ( $available_methods as $method ) : ?>

					<li <?php echo checked( $method->id, $chosen_method, false )  ?>
					class="<?php echo esc_attr( sanitize_title( $method->method_id ) ) ?>" >

							<?php
						if ( 1 < count( $available_methods ) ) {
							printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" %4$s />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) ); // WPCS: XSS ok.
						} else {
							printf( '<input type="hidden" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ) ); // WPCS: XSS ok.
						}
						//  printf( '<label for="shipping_method_%1$s_%2$s">%3$s</label>', $index, esc_attr( sanitize_title( $method->id ) ), wc_cart_totals_shipping_method_label( $method ) );

							$for = 'shipping_method_'.$index.'_'.esc_attr( sanitize_title( $method->id ) );
						?>
							<label class="shipping_selector" for="<?php echo $for; ?>">
								<?php
								//  echo wc_cart_totals_shipping_method_label( $method )
								?>
								<div class="iconSection">
									<?php if( $method->method_id === 'flat_rate' ){ ?>
										<i class="las la-shipping-fast"></i>
									<?php } ?>
									<?php if( $method->method_id === 'free_shipping' ){ ?>
										<i class="las la-gift"></i>
									<?php } ?>
								</div>
								<p>
									<?php echo $method->label ?>
								</p>

								<span>
									<?php
									if( $method->method_id === 'free_shipping'){
										echo 'GET IT NOW!';
									}else{
										echo '$'.$method->cost;
									}
									?>
								</span>

							</label>
						<?php
						do_action( 'woocommerce_after_shipping_rate', $method, $index );
						?>

					</li>

				<?php endforeach; ?>

			</ul>
			<?php if ( is_cart() ) : ?>
				<p class="woocommerce-shipping-destination">
					<?php
					if ( $formatted_destination ) {
						// Translators: $s shipping destination.
						printf( esc_html__( 'Shipping to %s.', 'martfury' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' );
						$calculator_text = esc_html__( 'Change address', 'martfury' );
					} else {
						echo wp_kses_post( apply_filters( 'woocommerce_shipping_estimate_html', esc_html__( 'Shipping options will be updated during checkout.', 'martfury' ) ) );
					}
					?>
				</p>
			<?php endif; ?>

		<?php
			$ordertotal = WC()->cart->subtotal;
			if( isset($ordertotal) && $ordertotal < 50 ){
				$resto = 50 - $ordertotal;
				// echo 'cantidad '. $ordertotal;
				// echo ' resto '. $resto;
				?>
					<div class="sectionMention_freeShipping">
						<i class="las la-cart-plus"></i>
						<span>
						Your purchase doesn't qualify for free shipping, add <strong>$<?php echo $resto ?> </strong> in products to your cart and get into the <strong>Free Shipping</strong> boat!
						</span>
					</div>
				<?php

			}
		?>

		<?php
		elseif ( ! $has_calculated_shipping || ! $formatted_destination ) :
			echo wp_kses_post( apply_filters( 'woocommerce_shipping_may_be_available_html', esc_html__( 'Enter your address to view shipping options.', 'martfury' ) ) );
		elseif ( ! is_cart() ) :
			echo wp_kses_post( apply_filters( 'woocommerce_no_shipping_available_html', esc_html__( 'There are no shipping options available. Please ensure that your address has been entered correctly, or contact us if you need any help.', 'martfury' ) ) );
		else :
			// Translators: $s shipping destination.
			echo wp_kses_post( apply_filters( 'woocommerce_cart_no_shipping_available_html', sprintf( esc_html__( 'No shipping options were found for %s.', 'martfury' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' ) ) );
			$calculator_text = esc_html__( 'Enter a different address', 'martfury' );
		endif;
		?>

		<?php if ( $show_package_details ) : ?>
			<?php echo '<p class="woocommerce-shipping-contents"><small>' . esc_html( $package_details ) . '</small></p>'; ?>
		<?php endif; ?>
	</td>
</tr>
