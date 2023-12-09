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

function status($status){
    if($status == 1){
        return "Activo";
    }
    else{
        return "Inactivo";
    }
}

function extension_document(){
    $ext = ['Sc','Lp','Cb','Tj','Ch','Or','Pt','Bn','Pd','Otro'];
    return $ext;
}

