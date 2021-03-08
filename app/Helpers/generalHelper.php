<?php

define('pagination_count',10);

function getFolder(){

    return app()->getLocale() === 'ar' ? 'css-rtl' : 'css';
}
