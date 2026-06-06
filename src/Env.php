<?php

namespace Inilim\Env;

use Inilim\Tool\Arr;
use Inilim\Tool\File;

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
    function get(
        $key,
        #[\SensitiveParameter]
        $default = null
    ) {
        return Arr::dataGet($this->_ENV, $key, $default);
    }

    /**
     * @param int|string $key
     */
    function getStr(
        $key,
        #[\SensitiveParameter]
        ?string $default = null
    ): string {
        return Arr::string($this->_ENV, $key, $default);
    }

    /**
     * @param int|string $key
     */
    function getBool(
        $key,
        #[\SensitiveParameter]
        ?bool $default = null
    ): bool {
        return Arr::boolean($this->_ENV, $key, $default);
    }

    /**
     * @param int|string $key
     */
    function getInt(
        $key,
        #[\SensitiveParameter]
        ?int $default = null
    ): int {
        return Arr::integer($this->_ENV, $key, $default);
    }

    /**
     * @param int|string $key
     */
    function getFloat(
        $key,
        #[\SensitiveParameter]
        ?float $default = null
    ): float {
        return Arr::float($this->_ENV, $key, $default);
    }

    /**
     * @param int|string $key
     * @param mixed $value
     * @return self
     */
    function set(
        $key,
        #[\SensitiveParameter]
        $value
    ): Env {
        Arr::dataSet()($this->_ENV, $key, $value);
        return $this;
    }

    /**
     * @param int|string|array<string|int> $keys
     */
    function has($keys): bool
    {
        return Arr::has($this->_ENV, $keys);
    }

    /**
     * @param mixed[] $data
     * @return self
     */
    function load(
        #[\SensitiveParameter]
        array $data,
        bool $overwrite = false
    ): Env {
        if ($overwrite) {
            return $this->overload($data);
        }

        if ($this->_ENV === []) {
            $this->_ENV = $data;
        } else {
            $this->_ENV = \array_merge($this->_ENV, $data);
        }
        return $this;
    }

    /**
     * @param mixed[] $data
     * @return self
     */
    function overload(
        #[\SensitiveParameter]
        array $data
    ): Env {
        $this->_ENV = $data;
        return $this;
    }

    /**
     * @return self
     */
    function loadFromFile(string $file, bool $overwrite = false): Env
    {
        $this->load(File::getRequire($file), $overwrite);
        return $this;
    }

    /**
     * @return mixed[]
     */
    function getAll(): array
    {
        return $this->_ENV;
    }
}
