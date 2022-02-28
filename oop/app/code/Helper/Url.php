<?php

namespace Helper;

class Url
{
    public static function redirect($route)
    {
        header('location: ' . BASE_URL . $route);
    }

    public static function link($path, $param = null)
    {
        $link = BASE_URL.$path;

        if($param !== null){
            $link .= '/'.$param;
        }
        return $link;
    }

    public static function slug($string)
    {
        $string = strtolower($string);
        $string = str_replace(' ', '-', $string);

        return $string;
    }
}