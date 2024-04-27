<?php

use Inilim\Env\Env;

/**
 * this file added .gitignore
 */
class MyEnv extends Env
{
    /**
     * @var array
     */
    protected static $_ENV = [
        'APP_NAME'  => 'app_name',
        'APP_ENV'   => 'local',
        'APP_KEY'   => '',
        'APP_DEBUG' => true,
        'APP_URL'   => 'http://localhost',

        'LOG_CHANNEL'              => 'stack',
        'LOG_DEPRECATIONS_CHANNEL' => null,
        'LOG_LEVEL'                => 'debug',

        'DB_CONNECTION' => 'mysql',
        'DB_HOST'       => '127.0.0.1',
        'DB_PORT'       => '3306',
        'DB_DATABASE'   => 'db_name',
        'DB_USERNAME'   => 'root',
        'DB_PASSWORD'   => 'root',
    ];
}

function env(string $env_key, $default = null)
{
    return MyEnv::get($env_key, $default);
}
function setEnv(string $env_key, $value): void
{
    return MyEnv::set($env_key, $value);
}
function hasEnv(string $env_key): bool
{
    return MyEnv::has($env_key);
}
