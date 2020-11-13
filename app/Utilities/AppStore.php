<?php

namespace App\Utilities;


use Illuminate\Http\Response;

class AppStore
{
    public static function url($request)
    {
        $iPod = stripos($request->header('User-Agent'), "iPod");
        $iPhone = stripos($request->header('User-Agent'), "iPhone");
        $iPad = stripos($request->header('User-Agent'), "iPad");
        if ( $iPod || $iPhone || $iPad ) {
            return "https://itunes.apple.com/appdir";
        } else {
            return "https://play.google.com/store";
        }
    }

    public static function isAndroid($request)
    {
        $iPod = stripos($request->header('User-Agent'), "iPod");
        $iPhone = stripos($request->header('User-Agent'), "iPhone");
        $iPad = stripos($request->header('User-Agent'), "iPad");
        return (!($iPod || $iPhone || $iPad));
    }
}
