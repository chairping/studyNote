<?php

// Find the value of a Key
function seekKey($haystack, $needle){
    foreach($haystack as $key => $value){
        if($key == $needle){
            $output = $value;
        }elseif(is_array($value)){
            $output = seekKey($value, $needle);
        }
    }
    return $output;
}

// Find the Key that matches the Value
function seekValue($haystack, $needle){
    foreach($haystack as $key => $value){
        if($key == $needle){
            $output = $value;
        }elseif(is_array($value)){
            $output = seekValue($value, $needle);
        }
    }
    return $output;
}

function seekAndDestroy($haystack, $needle){
    foreach($haystack as $key => $value){
        if($key == $needle){
            unset($key);
        }elseif(is_array($value)){
            $output[$key] = seekAndDestroy($value, $needle);
        }else{
            $output[$key] = $value;
        }
    }
    return $output;
}


function seekAndRename($haystack, $needle, $new){
    foreach($haystack as $key => $value){
        if($key == $needle){
            $output[$new] = $value;
        }elseif(is_array($value)){
            $output[$key] = seekAndRename($value, $needle, $new);
        }else{
            $output[$key] = $value;
        }
    }
    return $output;
}