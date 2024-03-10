<?php

namespace Inilim\Env;

abstract class Env
{
    protected static array $_ENV = [];

    /**
     * @param mixed $default
     * @return mixed
     */
    public static function get(string $env_key, $default = null)
    {
        if (self::has($env_key)) return static::$_ENV[$env_key];
        else return $default;
    }

    /**
     * @param mixed $value
     */
    public static function set(string $env_key, $value): void
    {
        static::$_ENV[$env_key] = $value;
    }

    public static function has(string $env_key): bool
    {
        return \array_key_exists($env_key, static::$_ENV);
    }
}
