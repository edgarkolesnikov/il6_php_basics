<?php

namespace Helper;

class Url
{
    public static function redirect($route)
    {
        header('location: ' . BASE_URL . $route);
    }
}