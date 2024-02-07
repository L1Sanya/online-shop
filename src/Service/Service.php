<?php

namespace Service;

use JetBrains\PhpStorm\NoReturn;

class Service
{
    #[NoReturn] public static function redirect(string $path): void
    {
        header("Location: $path");
        die();
    }
}