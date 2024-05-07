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
        return \_arr()->dataGet(static::$_ENV, $key, $default);
    }

    /**
     * @param int|string $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value)
    {
        \_arr()->dataSet(static::$_ENV, $key, $value);
    }

    /**
     * @param int|string|array<string|int> $keys
     * @return bool
     */
    public static function has($keys)
    {
        return \_arr()->has(static::$_ENV, $keys);
    }
}
