<?php

define('pagination_count',10);

function getFolder(){

    return app()->getLocale() === 'ar' ? 'css-rtl' : 'css';
}

 function saveImage($photo , $folder){

    $photo->store('/',$folder);
    $file_name = $photo->hashName();
    return $file_name;
}


