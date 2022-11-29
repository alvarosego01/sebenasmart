
console.log('product');

 function add_this_product_cart() {

    jQuery('form.cart .single_add_to_cart_button').click();

    let a = jQuery('h1.product_title.entry-title').offset().top;
    a = a - 125;

    jQuery('html, body').animate({ scrollTop: a }, 'slow');

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

function direct_add_cart(){

    let a = jQuery('h1.product_title.entry-title').offset().top;
    a = a - 125;

    jQuery('html, body').animate({ scrollTop: a }, 'slow');

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

jQuery(document).ready(function () {

    // form.cart
    // single_add_to_cart_button

    jQuery('.sbn_addCart_this').click(function (e) {


        add_this_product_cart();

    });


    jQuery('body#product_template.mobile-version button.single_add_to_cart_button').click( function (e) {


        direct_add_cart();

    });


    jQuery('div#sticky-product-info-wapper .container .sticky-product-inner .sc-product-cart a.sbn_buttonCustom').click(function (e) {


        add_this_product_cart();

    });




});
