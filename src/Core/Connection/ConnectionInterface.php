<?php

namespace Core\Connection;

interface ConnectionInterface
{
    public function exec(): void;

    public function query();

}