<?php

namespace Core\Container;

class Container implements ContainerInterface
{
    private array $services;

    public function set(string $class, callable $callback): void
    {
        $this->services[$class] = $callback;
    }

    public function get(string $class) : object
    {
        if (isset($this->services[$class])) {
            $callback = $this->services[$class];

            return $callback();
        }

        return new $class();
    }

}