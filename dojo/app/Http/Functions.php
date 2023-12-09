<?php
function key_value_from_json($json, $key){
    if($json == null):
        return null;
    else:
        $json = $json;
        $json = json_decode($json, true);
        if(array_key_exists($key, $json)):
            return $json[$key];
        else:
            return null;
        endif;
    endif;
}

function verify_permission_value ($value){
    $data = null;
    if($value == true):
         $data = $value;
         return $data;
    else:
        $data = null;
        return $data;
    endif;
}


?>
