<?php

namespace Laramin\Utility;

class Helpmate{

    public static function sysPass(){
        return true;
    }

    public static function appUrl(){
        $current = @$_SERVER['REQUEST_SCHEME'] ?? 'http' . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $url = substr($current, 0, -9);
        return  $url;
    }

}

