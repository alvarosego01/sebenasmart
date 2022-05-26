<?php


class ACF_CUSTOM
{

    public function setACF()
    {

        if (function_exists('acf_add_local_field_group')) {

            acf_add_local_field_group(

                $this->allWeb()

            );
        }
    }

    private function allWeb()
    {


        return array(
            'key' => 'popup_page_config',
            'title' => 'PopUp selector bootstrap',

            'fields' => array(
                array(

                    'key' => 'enable_popup',
                    'label' => '¿Use PopUp?',
                    'name' => '¿Use PopUp?',
                    'type' => 'true_false',

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

        );
    }



    public static function registerFieldGroups($fieldsPack)
    {
        if (count($fieldsPack) > 0) {

            foreach ($fieldsPack as $key => $fieldGroup) {
                // $fieldGroup['location'] = self::$rules[$key];
                if (function_exists('acf_add_local_field_group')) {

                    acf_add_local_field_group($fieldGroup);

                }
            }
        }
    }


    public static function _getField($field, $id = null)
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

    public static function testClass(){

        echo 'AAAAAAAAAA FUNCIONA';

    }




}


?>