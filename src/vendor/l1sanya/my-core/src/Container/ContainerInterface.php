<?php

namespace l1sanya\MyCore\Container;

interface ContainerInterface
{
    public function get(string $class): object;

    public function set(string $class, callable $callback);

}