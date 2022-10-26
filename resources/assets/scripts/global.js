




const Toast = Swal.mixin({
    toast: true,
    position: 'top-start',
    showConfirmButton: false,
    timer: 3750,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});



//   Toast.fire({
//     icon: 'success',
//     title: ' has been added to cart',
//     text: 'niti nesciunt quaerat blanditiis! Unde, atque??'
// });


function action_collapsibleButton() {


    if (jQuery('.collapsibleButton').length > 0) {

        var x = jQuery._data(jQuery('.collapsibleButton')[0], 'events');

        if (x != null) {
            return;
        }

        jQuery('.collapsibleButton').click(function (e) {

            e.preventDefault();

            var target = jQuery(this).attr('collapse_target');
            if (jQuery('#' + target).length > 0) {

                jQuery(this).toggleClass('active');

                jQuery('#' + target).toggleClass('collapsableContain');

            }

        });

    }
}

function action_openCartButton() {

    if (jQuery('a[openCartButton]').length > 0) {

        var x = jQuery._data(jQuery('a[openCartButton]')[0], 'events');

        if (x != null) {
            return;
        }

        jQuery('a[openCartButton]').click(function (e) {
            e.preventDefault();


            jQuery('.xoo-wsc-basket').click();

        });

    }

}


function addEventListenerAll(target, listener, ...otherArguments) {

    // install listeners for all natively triggered events
    for (const key in target) {
        if (/^on/.test(key)) {
            const eventType = key.substr(2);
            target.addEventListener(eventType, listener, ...otherArguments);
        }
    }

    // dynamically install listeners for all manually triggered events, just-in-time before they're dispatched ;D
    const dispatchEvent_original = EventTarget.prototype.dispatchEvent;
    function dispatchEvent(event) {
        target.addEventListener(event.type, listener, ...otherArguments);  // multiple identical listeners are automatically discarded
        dispatchEvent_original.apply(this, arguments);
    }
    EventTarget.prototype.dispatchEvent = dispatchEvent;
    if (EventTarget.prototype.dispatchEvent !== dispatchEvent) throw new Error(`Browser is smarter than you think!`);

}


function addXMLRequestCallback(callback) {
    var oldSend, i;
    if (XMLHttpRequest.callbacks) {
        // we've already overridden send() so just add the callback
        XMLHttpRequest.callbacks.push(callback);
    } else {
        // create a callback queue
        XMLHttpRequest.callbacks = [callback];
        // store the native send()
        oldSend = XMLHttpRequest.prototype.send;
        // override the native send()
        XMLHttpRequest.prototype.send = function () {
            // process the callback queue
            // the xhr instance is passed into each callback but seems pretty useless
            // you can't tell what its destination is or call abort() without an error
            // so only really good for logging that a request has happened
            // I could be wrong, I hope so...
            // EDIT: I suppose you could override the onreadystatechange handler though
            for (i = 0; i < XMLHttpRequest.callbacks.length; i++) {
                XMLHttpRequest.callbacks[i](this);
            }
            // call the native send()
            oldSend.apply(this, arguments);
        }
    }
}

function custom_add_to_cart_ajax(event = null, xhr = null, settings = null) {

    if (event != null && settings != null) {

        settings_data = settings.data || null;
        settings_url = settings.url || null;

        target_element = event.target.activeElement || null;


        console.log('settings.type', settings.type);
        console.log('xhr.status', xhr.status);
        console.log('settings_url', settings_url);
        console.log('settings_data', settings_data);


        let urlSearchParams = new URLSearchParams(settings_data);
        let params_data = Object.fromEntries(urlSearchParams.entries());

        console.log('los params params_data', params_data );

        if (
            ( settings.type === 'POST' && xhr.status === 200 ) &&
            (
                ( settings_url === window.location.href &&
                jQuery(target_element).hasClass('single_add_to_cart_button') == true &&
                settings_data.includes("add-to-cart") ) ||
                ( settings_url.includes("add_to_cart") &&
                Number(params_data.quantity) > 0 )
            )
        ) {

            let productName = null;
            let qty = params_data.quantity || 0;
            console.log('entra aca');

            if (jQuery('h1.product_title.entry-title').length > 0) {

                productName = jQuery('h1.product_title.entry-title').text();

            } else
            if (jQuery('h2.product_title').length > 0) {

                productName = jQuery('h2.product_title').text();

            }


            if(params_data.title){

                productName = params_data.title;

            }

            if( qty != 0 ){

                productName = qty + 'x ' + productName;

            }


            Toast.fire({
                icon: 'success',
                title: productName,
                text: 'Has been added to cart'
            });

            jQuery('.xoo-wsc-basket').click();

        }

        // console.log('settings.url', settings.url);
        // console.log('settings.method', settings.method);
        // console.log('xhr', xhr.status);
        // console.log('settings_data', settings_data);

        if (
            (
                settings.url.includes("?wc-ajax=xoo_wsc_update_item_quantity") &&
                settings.type === 'POST' &&
                xhr.status === 200 &&
                settings_data.includes("qty=0")
            )
        ) {

            Toast.fire({
                icon: 'success',
                title: 'The product has been removed from the shopping cart',
            });

            // jQuery('.xoo-wsc-basket').click();

        }


    }


    return;

}

jQuery(document).ready(function () {

    action_collapsibleButton();
    action_openCartButton();

    // custom_add_to_cart();

});

jQuery(document).ajaxSuccess(function (event, xhr, settings) {

    console.log('ajax success event', event);
    console.log('ajax success xhr', xhr);
    console.log('ajax success settings', settings);

    action_collapsibleButton();
    action_openCartButton();


    custom_add_to_cart_ajax(event, xhr, settings)

});


