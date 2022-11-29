<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<?php
    // sbn_sidebar_cart_buttons
    add_action( 'sbn_sidebar_cart_buttons', 'sbn_sidebar_cart_buttons');
    if ( ! function_exists( 'sbn_sidebar_cart_buttons' ) ) {
        function sbn_sidebar_cart_buttons() {
            $checkout = setTypeUrl() . '/checkout';
            $cart = setTypeUrl() . '/cart';
            $shop = setTypeUrl() . '/shop';
            ?>

            <div class="layer1">

                <a
                class="sbn_buttonCustom sbn_btn_small sbn_primaryButton left_side"
                href="<?php echo $checkout ?>">
                    <span class="icon_container">
                        <i class="fa-solid fa-credit-card"></i>
                    </span>
                    Go to checkout
                </a>

            </div>
            <div class="layer2">

                <a
                class="sbn_buttonCustom sbn_btn_small sbn_secondaryButton left_side"
                href="<?php echo $shop ?>">
                    <span class="icon_container">
                        <i class="las la-undo"></i>
                    </span>
                    Continue shop
                </a>
                <a
                class="sbn_buttonCustom sbn_btn_small sbn_secondaryButton left_side"
                href="<?php echo $cart ?>">
                    <span class="icon_container">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </span>
                    View cart page
                </a>

            </div>
            <?php
        }
    }
    add_filter('woocommerce_paypal_payments_checkout_button_renderer_hook', function() {
        return 'woocommerce_review_order_before_submit';
    });

?>