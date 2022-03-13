<?php

declare(strict_types=1);

namespace Helper;

class Url
{
    /**
     * @param string $route
     */
    public static function redirect(string $route): void
    {
        header('location: ' . BASE_URL . $route);
    }

    /**
     * @param string $path
     * @param string|null $param
     * @return string
     */
    public static function link(string $path, ?string $param = null): string
    {
        $link = BASE_URL.$path;

        if($param !== null){
            $link .= '/'.$param;
        }
        return $link;
    }

    /**
     * @param string $string
     * @return string
     */
    public static function slug(string $string): string
    {
        $string = strtolower($string);
        $string = str_replace(' ', '-', $string);

        return $string;
    }
}