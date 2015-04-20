<?php

function formatSize($size){
    $sizes = array(" B", " K", " M", " GB");

    if ($size == 0) {
        return 'n/a';
    } else {
        return (round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]);
    }
}
