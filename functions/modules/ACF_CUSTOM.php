<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


     function setACF()
    {

        if (function_exists('acf_add_local_field_group')) {

            registerFieldGroups(
                allWeb()
            );


        }
    }

    function allWeb()
    {
        return array(
            array(
                'key' => 'custom_settings',
                'title' => 'General custom settings',
                'fields' => array(

                    array(
                        'key' => 'custom_parent_class_section',
                        'label' => 'Custom parent class',
                        'name' => 'Custom parent class',
                        'type' => 'text',
                    ),

                    array(
                        'key' => 'template_custom',
                        'label' => 'Template base',
                        'name' => 'Template base',
                        'type' => 'select',
                        'choices' => array(
                            'regular_template' => 'Regular',
                            'home_template' => 'Home template',
                            'cart_template' => 'Cart template',
                            'checkout_template' => 'Checkout template',
                            'tracking_template' => 'Track order template',
                            'shop_template' => 'Shop page template',
                            'dashboard_template' => 'Dashboard page template',
                        ),
                    ),

                ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'post_type',
                                'operator' => '==',
                                'value' => 'page',
                            ),
                        ),

                    ),
            )
        );

    }


      function registerFieldGroups( $fieldsPack )
    {


        if( count($fieldsPack) > 0 ){

            foreach ($fieldsPack as $key => $fieldGroup) {

                if ( function_exists('acf_add_local_field_group') ) {

                    acf_add_local_field_group($fieldGroup);

                }
            }
        }
    }


      function _getField($field, $id = null)
    {

        if (function_exists('get_field')) {

            $l = null;
            if ($id) {
                $l = get_field($field, $id);
            } else {
                $l = get_field($field);
            }

            if ($l != null || $l != '') {

                return $l;
            } else {
                return null;
            }
        } else {

            return null;
        }

    }

      function _getFields( $post_id, $format_value = 0 )
    {

        if (function_exists('get_fields')) {

            $l = null;
            if ($format_value) {
                $l = get_fields($post_id, $format_value);
            } else {
                $l = get_fields($post_id);
            }

            if ($l != null || $l != '') {

                return $l;
            } else {
                return null;
            }



        } else {

            return null;
        }

    }





    add_action('acf/init', setACF() );



?>