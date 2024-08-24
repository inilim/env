<?php

namespace Inilim\Env;

class Env
{
    protected array $_ENV = [];

    /**
     * @param int|string $key
     * @param mixed $default
     * @return mixed
     */
    function get($key, $default = null)
    {
        return \_arr()->dataGet2($this->_ENV, $key, $default);
    }

    /**
     * @param int|string $key
     * @param mixed $value
     */
    function set($key, $value): void
    {
        \_arr()->dataSet($this->_ENV, $key, $value);
    }

    /**
     * @param int|string|array<string|int> $keys
     */
    function has($keys): bool
    {
        return \_arr()->has($this->_ENV, $keys);
    }

    function addToRoot(array $values): void
    {
        $this->_ENV = \array_merge($this->_ENV, $values);
    }

    function setToRoot(array $values): void
    {
        $this->_ENV = $values;
    }
}
