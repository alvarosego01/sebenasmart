

<?php

function get_current_post_ID() {
    $postid = get_queried_object_id();
}
add_action( 'template_redirect', 'get_current_post_ID' );


    function init_scripts_styles()
    {


        wp_register_style('Main.Css', get_stylesheet_directory_uri() . '/dist/styles/main.css', false, THEME_VERSION);
	    wp_enqueue_style('Main.Css');

	    wp_register_script('Main.js', get_stylesheet_directory_uri() . '/dist/scripts/main.js', ['jquery'], THEME_VERSION, true);
	    wp_enqueue_script('Main.js');


	    wp_register_style('bootstrapCss', get_stylesheet_directory_uri() . '/resources/assets/library/bootstrap/css/bootstrap.min.css', array(), rand(), 'all');
        wp_enqueue_style('bootstrapCss');

        wp_register_script('bootstrapJs', get_stylesheet_directory_uri() . '/resources/assets/library/bootstrap/js/bootstrap.min.js', array('jquery'), rand(), 'all');
        wp_enqueue_script('bootstrapJs');

	    wp_register_style('lineAwesome', get_stylesheet_directory_uri() . '/resources/assets/library/line-awesome/css/line-awesome.min.css', array(), rand(), 'all');
        wp_enqueue_style('lineAwesome');



    }
    add_action('wp_enqueue_scripts', init_scripts_styles() );

    function specialInitFiles( $id ){

        if( $id != null ){


            $l = null;

            $l = _getField('template_custom', $id);


            if( isset($l) && $l == 'cart_template' ){
                // echo 'funciona esto '. $l;
                wp_register_script('shoppingCart.js', get_stylesheet_directory_uri() . '/dist/scripts/pages/shoppingCart.js', ['jquery'], THEME_VERSION, true);
                wp_enqueue_script('shoppingCart.js');

            }
            if( isset($l) && $l == 'checkout_template' ){
                // echo 'funciona esto '. $l;
                wp_register_script('checkout.js', get_stylesheet_directory_uri() . '/dist/scripts/pages/checkout.js', ['jquery'], THEME_VERSION, true);
                wp_enqueue_script('checkout.js');

            }

        }

    }



    function customCouponField(){

        if ( wc_coupons_enabled() ) { ?>
            <div class=" customCouponSection">
                <div class="coupon_custom">
                    <label for="coupon_code_custom">
					<a  data-bs-toggle="collapse" href="#couponContainer_custom" role="button" aria-expanded="false" aria-controls="couponContainer_custom">

						<span class="have">
						Have a coupon? <strong>Click here</strong>
						</span>

						<span class="deploy">
							<?php esc_html_e( 'Enter your Coupon Discount', 'martfury' ); ?>
						</span>
						<i class="las la-angle-right"></i>
				  	</a>
					</label>
					<div class="collapse couponContainer_custom" id="couponContainer_custom">
					<form onsubmit="event.preventDefault(); sendCouponCart(this)" class="woocommerce-cart-form_custom" >
						<div class="collapseContain">

							<input required type="text" name="coupon_code_custom" class="input-text" id="coupon_code_custom" value=""
							placeholder="<?php esc_attr_e( 'Coupon code', 'martfury' ); ?>"/>
							<input type="submit" class="button" name="apply_coupon_custom"
							value="<?php esc_attr_e( 'Apply coupon', 'martfury' ); ?>"/>
							<?php do_action( 'woocommerce_cart_coupon' ); ?>

						</div>
						</form>
					</div>
                </div>
            </div>

	<?php }

    }
    add_action( 'woocommerce_after_cart_totals', 'customCouponField' );
    add_action( 'woocommerce_review_order_after_submit', 'customCouponField' );


    // remove sku
    add_filter( 'wc_product_sku_enabled', '__return_false' );



?>