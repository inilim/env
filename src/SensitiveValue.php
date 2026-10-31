<?php

declare(strict_types=1);

namespace Inilim\Env;

use Inilim\Tool\Check;
use Inilim\Tool\Obj;

final class SensitiveValue
{
    /**
     * @var \Closure():mixed[]|\SensitiveParameterValue
     */
    private object $env;

    /**
     * @param mixed[] $env
     * @throws \InvalidArgumentException
     */
    function __construct(
        #[\SensitiveParameter]
        $env
    ) {
        if (!\is_array($env)) {
            throw Obj::sprintfInvalidArgumentException('Invalid type value. Expect array, given %s', [\gettype($env)]);
        }
        // \Closure hidden data for var_export
        $this->env = Check::php82() ? new \SensitiveParameterValue($env) : static fn(): array => $env;
    }

    function getValue(): array
    {
        return $this->env instanceof \SensitiveParameterValue ? $this->env->getValue() : ($this->env)();
    }

    function __debugInfo(): array
    {
        return [];
    }
}
