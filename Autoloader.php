<?php

class Autoloader
{
    public static function autoload($class)
    {
        $class = str_replace('\\', '/', $class);
        $file = __DIR__ . '/' . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
}

spl_autoload_register('Autoloader::autoload');