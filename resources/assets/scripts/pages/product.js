
console.log('product');

let valid_flag = false;

function check_valid_select() {

    if (jQuery('body#product_template button.single_add_to_cart_button').length > 0) {

        // disabled wc-variation-selection-needed
        let aux = jQuery('body#product_template button.single_add_to_cart_button');

        if (aux.hasClass('disabled') || aux.hasClass('wc-variation-selection-needed')) {

            valid_flag = false;
            return;

        } else {
            valid_flag = true;
            return;
        }

    } else {
        valid_flag = false;
        return;
    }

}

function add_this_product_cart() {

    jQuery('form.variations_form.cart').submit();

}

function direct_add_cart() {

    check_valid_select();

    let a = jQuery('h1.product_title.entry-title').offset().top;
    a = a - 125;

    jQuery('html, body').animate({ scrollTop: a }, 'slow');


    if (valid_flag != false) {
        return false;
    }


    // await setTimeout(function(){}, 1500);

    jQuery('form.variations_form.cart.swatches-support table.variations')[0].addEventListener('animationend', function (e) {
        // do something

        if (e.animationName == 'shakeY') {

            // jQuery('nav', sideNavBar)[0].classList.add("animate__slideInRight")
            // jQuery( 'form.variations_form.cart.swatches-support table.variations' )[0].classList.remove("animate__animated animate__shakeY");

            jQuery('form.variations_form.cart.swatches-support table.variations').removeClass("animate__animated animate__shakeY animate__delay-1s");

            e.target.removeEventListener('animationend', function () {

            });

        }

    });

    jQuery('form.variations_form.cart.swatches-support table.variations').addClass("animate__animated animate__shakeY animate__delay-1s");

    return false;

}

function delay(time) {
    return new Promise(resolve => setTimeout(resolve, time));
  }


async function listen_add_to_cart( event = null, xhr = null, settings = null ){

    if (event != null && settings != null) {

        settings_data = settings.data || null;
        settings_url = settings.url || null;

        target_element = event.target.activeElement || null;

        let urlSearchParams = new URLSearchParams(settings_data);
        let params_data = Object.fromEntries(urlSearchParams.entries());

        // console.log('los params params_data', params_data );

        if (
            ( settings.type === 'POST' && xhr.status === 200 ) &&
            (
                ( settings_url === window.location.href &&
                jQuery(target_element).hasClass('single_add_to_cart_button') == true &&
                settings_data.includes("add-to-cart") ) ||
                ( Number(params_data.quantity) > 0 )
            )
        ) {

            // await delay(1000);
            if( jQuery('.xoo-wsc-modal').length > 0 ){

                if( !jQuery('.xoo-wsc-modal').hasClass('xoo-wsc-cart-active') ){

                    jQuery('.xoo-wsc-basket').click();

                }

            }

        }

        return;

    }

}

jQuery(document).ready(function () {

    // form.cart
    // single_add_to_cart_button

    jQuery('.sbn_addCart_this').click(function (e) {


        jQuery('button.single_add_to_cart_button.button.alt').click();

    });


    jQuery('body#product_template button.single_add_to_cart_button').click(function (e) {

        direct_add_cart();

    });

    jQuery('body#product_template div#sticky-product-info-wapper .sticky-product-inner .sc-product-cart a.button').click(function (e) {

        jQuery('button.single_add_to_cart_button.button.alt').click();

    });


    jQuery('div#sticky-product-info-wapper .container .sticky-product-inner .sc-product-cart a.sbn_buttonCustom').click(function (e) {


        jQuery('button.single_add_to_cart_button.button.alt').click();

    });



});


jQuery(document).ajaxSuccess(function (event, xhr, settings) {

    // console.log('ajax success event', event);
    // console.log('ajax success xhr', xhr);
    // console.log('ajax success settings', settings);

    listen_add_to_cart( event, xhr, settings );

});






