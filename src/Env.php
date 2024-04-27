<?php

namespace Inilim\Env;

abstract class Env
{
    /**
     * @var array
     */
    protected static $_ENV = [];

    /**
     * @param int|string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        return static::$_ENV[$key] ?? $default;
    }

    /**
     * @param int|string $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value)
    {
        static::$_ENV[$key] = $value;
    }

    /**
     * @param int|string $key
     * @return bool
     */
    public static function has($key)
    {
        return \array_key_exists($key, static::$_ENV);
    }
}
