<?php

namespace App;

class Autoloader
{
        public static function register()
    {
        spl_autoload_register(function ($className) {
            $classPath = str_replace('\\', '/', $className) . '.php';
            if (file_exists($classPath)) {
                require_once $classPath;
            } else {
                echo "Класс $className не найден";
            }
        });

    }

}