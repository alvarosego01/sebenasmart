<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<?php
    function transformByName( $name ){
        if($name != null){
            $str = $name;
            for ($i = 0; $i < strlen($str); $i++){
                if( $i == 0 ){

                    echo $str[$i];

                }
                elseif ( $i == strlen($str) - 1 ){

                    echo $str[$i];

                }else{

                    echo '*';

                }

            }

        }
    }

?>