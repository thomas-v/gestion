<?php
 
if (!function_exists('dump')) {
     function dump ($var, $exit = true) {

        echo '<pre>';
        var_dump($var);
        echo '</pre>';

        if ($exit == true) {
            die();
        }
        
    }
}
