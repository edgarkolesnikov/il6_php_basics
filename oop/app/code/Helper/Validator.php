<?php

declare(strict_types=1);

namespace Helper;

class Validator
{
    /**
     * @param string $pass
     * @param string $pass2
     * @return string
     */
    public static function checkPassword(string $pass, string $pass2): bool
    {
     return $pass === $pass2;
    }

    /**
     * @param string $email
     * @return string
     */
    public static function checkEmail(string $email): bool
    {
        return strpos($email, '@') !== false;
    }
}