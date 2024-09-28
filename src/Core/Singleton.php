<?php

namespace App\Core;

abstract class Singleton
{
    /**
     * @var array<string, static>
     */
    private static array $instances = [];

    abstract protected function __construct();

    protected function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception('Cannot unserialize a singleton.');
    }

    final public static function getInstance(): static
    {
        $class = static::class;

        if (! isset(self::$instances[$class])) {
            self::$instances[$class] = new static();
        }

        return self::$instances[$class];
    }
}
