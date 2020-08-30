
<?php
function remove_arr_value(&$arr, $value){ 
    if (in_array($value, $arr)) {   
        $key = array_search($value, $arr);
        $key=$key+0;    
        if($key !== false){ 
            unset($arr[$key]);
        }
    }
}
?>