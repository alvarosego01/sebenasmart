


function sendCouponCart(form){

    var a = jQuery('#coupon_code_custom').val();

    if( a && a != null ){

        jQuery('#coupon_code').val(a);

        jQuery('form.checkout_coupon.woocommerce-form-coupon [type="submit"]').click();


        form.reset();
    }


}



jQuery(document).ready(function () {

});