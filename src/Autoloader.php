<?php

class Autoloader
{
    public static function autoload($class)
    {
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

        // Prepend the base directory (assuming autoload.php is in the src directory)
        $file = __DIR__ . '/' . $class . '.php';

        // Check if the file exists and is readable
        if (is_readable($file)) {
            require_once $file;
        }
    }
}

// Register the autoloader
spl_autoload_register('Autoloader::autoload');
