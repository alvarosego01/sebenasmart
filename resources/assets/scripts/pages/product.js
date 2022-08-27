
function add_this_product_cart(){

    jQuery('form.cart .single_add_to_cart_button').click();

}


jQuery(document).ready(function () {

    // form.cart
    // single_add_to_cart_button

    jQuery('.sbn_addCart_this').click(function (e) {
        e.preventDefault();

        add_this_product_cart();

    });


    jQuery('div#sticky-product-info-wapper .container .sticky-product-inner .sc-product-cart a.sbn_buttonCustom').click(function (e) {
        e.preventDefault();

        add_this_product_cart();

    });




});
