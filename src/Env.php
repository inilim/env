<?php

namespace Inilim\Env;

use Inilim\Tool\Arr;

final class Env
{
    /**
     * @var mixed[]
     */
    protected $_ENV = [];

    /**
     * @param int|string $key
     * @param mixed $default
     * @return mixed
     */
    function get($key, $default = null)
    {
        return Arr::dataGetV2($this->_ENV, $key, $default);
    }

    /**
     * @param int|string $key
     * @param mixed $value
     * @return void
     */
    function set($key, $value)
    {
        Arr::dataSet()($this->_ENV, $key, $value);
    }

    /**
     * @param int|string|array<string|int> $keys
     * @return bool
     */
    function has($keys)
    {
        return Arr::has($this->_ENV, $keys);
    }

    /**
     * @return void
     */
    function addToRoot(array $values)
    {
        $this->_ENV = \array_merge($this->_ENV, $values);
    }

    /**
     * @return void
     */
    function setToRoot(array $values)
    {
        $this->_ENV = $values;
    }
}
