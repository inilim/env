<?php

namespace Inilim\Env;

use Inilim\Tool\Arr;

final class Env
{
    /**
     * @var mixed[]
     */
    protected array $_ENV = [];

    /**
     * @param int|string $key
     * @param mixed $default
     * @return mixed
     */
    function get($key, $default = null)
    {
        return Arr::dataGet($this->_ENV, $key, $default);
    }

    /**
     * @param int|string $key
     */
    function getStr($key, ?string $default = null): string
    {
        return Arr::string($this->_ENV, $key, $default);
    }

    /**
     * @param int|string $key
     */
    function getBool($key, ?bool $default = null): bool
    {
        return Arr::boolean($this->_ENV, $key, $default);
    }

    /**
     * @param int|string $key
     */
    function getInt($key, ?int $default = null): int
    {
        return Arr::integer($this->_ENV, $key, $default);
    }

    /**
     * @param int|string $key
     */
    function getFloat($key, ?float $default = null): float
    {
        return Arr::float($this->_ENV, $key, $default);
    }

    /**
     * @param int|string $key
     * @param mixed $value
     * @return self
     */
    function set($key, $value)
    {
        Arr::dataSet()($this->_ENV, $key, $value);
        return $this;
    }

    /**
     * @param int|string|array<string|int> $keys
     * @return bool
     */
    function has($keys): bool
    {
        return Arr::has($this->_ENV, $keys);
    }

    /**
     * @return self
     */
    function addToRoot(array $values)
    {
        $this->_ENV = \array_merge($this->_ENV, $values);
        return $this;
    }

    /**
     * @return self
     */
    function setToRoot(array $values)
    {
        $this->_ENV = $values;
        return $this;
    }
}
