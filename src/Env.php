<?php

declare(strict_types=1);

namespace Inilim\Env;

use Inilim\Env\SensitiveValue;
use Inilim\Tool\File;
use Inilim\Tool\Lar;
use Inilim\Tool\LarArr;
use Inilim\Tool\PF;

final class Env
{
    private SensitiveValue $env;

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
        return Lar::dataGet($this->env->getValue(), $key, $default);
    }

    /**
     * @param int|string $key
     * @return mixed[]
     */
    function getArray($key): array
    {
        $value = Lar::dataGet($this->env->getValue(), $key);
        if (!\is_array($value)) {
            throw new \InvalidArgumentException(
                \sprintf('Array value for key [%s] must be a array, %s found.', $key, \gettype($value))
            );
        }
        return $value;
    }

    /**
     * @param int|string $key
     * @return list<mixed>
     */
    function getArrayList($key): array
    {
        $value = $this->getArray($key);
        if (!PF::array_is_list($value)) {
            throw new \InvalidArgumentException(
                \sprintf('Array value for key [%s] must be a list.', $key)
            );
        }

        return $value;
    }

    /**
     * @param int|string $key
     */
    function getStr(
        $key,
        #[\SensitiveParameter]
        ?string $default = null
    ): string {
        return LarArr::string($this->env->getValue(), $key, $default);
    }

    /**
     * @param int|string $key
     */
    function getBool(
        $key,
        ?bool $default = null
    ): bool {
        return LarArr::boolean($this->env->getValue(), $key, $default);
    }

    /**
     * @param int|string $key
     */
    function getInt(
        $key,
        #[\SensitiveParameter]
        ?int $default = null
    ): int {
        return LarArr::integer($this->env->getValue(), $key, $default);
    }

    /**
     * @param int|string $key
     */
    function getFloat(
        $key,
        #[\SensitiveParameter]
        ?float $default = null
    ): float {
        return LarArr::float($this->env->getValue(), $key, $default);
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
        Lar::dataSet()($this->env->getValue(), $key, $value);
        return $this;
    }

    /**
     * @param int|string|array<string|int> $keys
     */
    function has($keys): bool
    {
        return LarArr::has($this->env->getValue(), $keys);
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

        if ([] === $this->env->getValue()) {
            $this->env = new SensitiveValue($data);
        } else {
            $this->env = new SensitiveValue(\array_merge($this->env->getValue(), $data));
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
        $this->env = new SensitiveValue($data);
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
        return $this->env->getValue();
    }
}
