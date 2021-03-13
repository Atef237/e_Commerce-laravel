<?php

define('pagination_count',10);

function getFolder(){

    return app()->getLocale() === 'ar' ? 'css-rtl' : 'css';
}

 function saveImage($photo , $folder){
    $image = $photo->getClientOriginalExtension();
    $file_name =  $image->hashName();
    return $file_name;
}


