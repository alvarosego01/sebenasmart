

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

        console.log('se setea');
        jQuery('a[openCartButton]').click(function (e) {
            e.preventDefault();

            console.log('se clickea');

            jQuery('.xoo-wsc-basket').click();

        });

    }

}

jQuery(document).ready(function () {

    action_collapsibleButton();
    action_openCartButton();

});

jQuery(document).ajaxSuccess(function () {

    action_collapsibleButton();
    action_openCartButton();

});
