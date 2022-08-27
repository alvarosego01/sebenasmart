
<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<?php




function get_current_post_ID() {
    $postid = get_queried_object_id();
}
add_action( 'template_redirect', 'get_current_post_ID' );



function init_scripts_styles()
{

	wp_enqueue_style('Main.Css',  get_stylesheet_directory_uri() . '/dist/styles/main.css', false, wp_get_theme()->get('Version') );

	wp_enqueue_script('Main.js', get_stylesheet_directory_uri() . '/dist/scripts/main.js', ['jquery'], wp_get_theme()->get('Version') , true);

    wp_enqueue_script('_global.js', get_stylesheet_directory_uri() . '/dist/scripts/global.js', ['jquery'], wp_get_theme()->get('Version') , true);

	// wp_enqueue_style('bootstrapCss',  get_stylesheet_directory_uri() . '/resources/assets/library/bootstrap/css/bootstrap.min.css', array(), rand(), 'all');

	// wp_enqueue_script('bootstrapJs',  get_stylesheet_directory_uri() . '/resources/assets/library/bootstrap/js/bootstrap.min.js', array('jquery'), rand(), 'all');

	wp_enqueue_style('lineAwesome', get_stylesheet_directory_uri() . '/resources/assets/library/line-awesome/css/line-awesome.min.css', array(), rand(), 'all');

	wp_enqueue_style('fontAwesome', get_stylesheet_directory_uri() . '/resources/assets/library/font-awesome/css/all.min.css', array(), rand(), 'all');

    wp_enqueue_style('animate.css', get_stylesheet_directory_uri() . '/resources/assets/library/animate/animate.min.css', array(), rand(), 'all');

}
add_action('wp_enqueue_scripts', 'init_scripts_styles');


    function specialInitFiles( $id = null, $custom = null ){

        if( $id != null ){

            $l = null;

            $l = _getField('template_custom', $id);

            if( isset($l) && $l == 'cart_template' ){
                // echo 'funciona esto '. $l;
                wp_register_script('shoppingCart.js', get_stylesheet_directory_uri() . '/dist/scripts/pages/shoppingCart.js', ['jquery'], wp_get_theme()->get('Version') , true);
                wp_enqueue_script('shoppingCart.js');

            }

            if( isset($l) && $l == 'checkout_template' ){
                // echo 'funciona esto '. $l;
                wp_register_script('checkout.js', get_stylesheet_directory_uri() . '/dist/scripts/pages/checkout.js', ['jquery'], wp_get_theme()->get('Version') , true);
                wp_enqueue_script('checkout.js');

            }

        }

        if( $custom != null ){

            if( isset($custom) && $custom == 'product_template' ){
                // echo 'funciona esto '. $l;

                wp_register_script('product.js', get_stylesheet_directory_uri() . '/dist/scripts/pages/product.js', ['jquery'], wp_get_theme()->get('Version') , true);
                wp_enqueue_script('product.js');


            }

        }

    }



    function customCouponField(){

        if ( wc_coupons_enabled() ) { ?>


            <div class=" customCouponSection">
                <div class="coupon_custom">


                    <a class="collapsibleButton"  collapse_target="couponContainer_custom" open="0">

                        <span class="have">
                            Have a coupon?&nbsp;<strong>Click here</strong>
                        </span>

                        <span class="deploy">
                            <?php esc_html_e( 'Enter your Coupon Discount', 'martfury' ); ?>
                        </span>

                        <i class="las la-angle-right"></i>

                    </a>

                <div class="collapsableContain content couponContainer_custom animate__animated animate__fadeIn" id="couponContainer_custom" >

                    <form onsubmit="event.preventDefault(); sendCouponCart(this)" class="woocommerce-cart-form_custom">
                        <div class="collapseContain">

                            <input required type="text" name="coupon_code_custom" class="input-text" id="coupon_code_custom" value=""
                                placeholder="<?php esc_attr_e( 'Coupon code', 'martfury' ); ?>" />
                            <input type="submit" class="button" name="apply_coupon_custom"
                                value="<?php esc_attr_e( 'Apply coupon', 'martfury' ); ?>" />
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


    //

    // Enable Gutenberg editor for WooCommerce
function j0e_activate_gutenberg_product( $can_edit, $post_type ) {
    if ( $post_type == 'product' ) {
           $can_edit = true;
       }
       return $can_edit;
   }
   add_filter( 'use_block_editor_for_post_type', 'j0e_activate_gutenberg_product', 10, 2 );

   // enable taxonomy fields for woocommerce with gutenberg on
   function j0e_enable_taxonomy_rest( $args ) {
       $args['show_in_rest'] = true;
       return $args;
   }
   add_filter( 'woocommerce_taxonomy_args_product_cat', 'j0e_enable_taxonomy_rest' );
   add_filter( 'woocommerce_taxonomy_args_product_tag', 'j0e_enable_taxonomy_rest' );


    function setTypeUrl(){

        if($_SERVER['SERVER_NAME'] == 'localhost') {

            return '/sebenasmart';

        }else{

            return '';

        }

    }



    // add_shortcode( 'wc_login_form_bbloomer', 'bbloomer_separate_login_form' );

    function bbloomer_separate_login_form() {
       if ( is_admin() ) return;
       if ( is_user_logged_in() ) return;

       $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']  === 'on' ? "https" : "http") .  "://" . $_SERVER['HTTP_HOST'] .  $_SERVER['REQUEST_URI'];

       ob_start();
       woocommerce_login_form( array(

        // 'redirect' => 'https://custom.url'
        'redirect' => $link

        ) );


       return ob_get_clean();
    }




    // echo 'link ' . $link;


?>