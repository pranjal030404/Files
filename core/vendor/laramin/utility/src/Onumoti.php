<?php

namespace Laramin\Utility;

class Onumoti{

    public static function getData(){
    }

    public static function mySite($site,$className){
        $myClass = VugiChugi::clsNm();
        if($myClass != $className){
            return $site->middleware(VugiChugi::mdNm());
        }
    }
}
