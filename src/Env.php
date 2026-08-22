<?php

namespace Inilim\Env;

use Inilim\Tool\File;
use Inilim\Tool\LarArr;

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
        return LarArr::dataGet($this->_ENV, $key, $default);
    }

    /**
     * @param int|string $key
     */
    function getStr(
        $key,
        #[\SensitiveParameter]
        ?string $default = null
    ): string {
        return LarArr::string($this->_ENV, $key, $default);
    }

    /**
     * @param int|string $key
     */
    function getBool(
        $key,
        #[\SensitiveParameter]
        ?bool $default = null
    ): bool {
        return LarArr::boolean($this->_ENV, $key, $default);
    }

    /**
     * @param int|string $key
     */
    function getInt(
        $key,
        #[\SensitiveParameter]
        ?int $default = null
    ): int {
        return LarArr::integer($this->_ENV, $key, $default);
    }

    /**
     * @param int|string $key
     */
    function getFloat(
        $key,
        #[\SensitiveParameter]
        ?float $default = null
    ): float {
        return LarArr::float($this->_ENV, $key, $default);
    }

    /**
     * @param int|string $key
     * @param mixed $value
     */
    function set(
        $key,
        #[\SensitiveParameter]
        $value
    ): self {
        LarArr::dataSet()($this->_ENV, $key, $value);
        return $this;
    }

    /**
     * @param int|string|array<string|int> $keys
     */
    function has($keys): bool
    {
        return LarArr::has($this->_ENV, $keys);
    }

    /**
     * @param mixed[] $data
     */
    function load(
        #[\SensitiveParameter]
        array $data,
        bool $overwrite = false
    ): self {
        if ($overwrite) {
            return $this->overload($data);
        }

        if ([] === $this->_ENV) {
            $this->_ENV = $data;
        } else {
            $this->_ENV = \array_merge($this->_ENV, $data);
        }
        return $this;
    }

    /**
     * @param mixed[] $data
     */
    function overload(
        #[\SensitiveParameter]
        array $data
    ): self {
        $this->_ENV = $data;
        return $this;
    }

    /**
     */
    function loadFromFile(string $file, bool $overwrite = false): self
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
