<?php
class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $file = strtolower($class) . '.php';
            if (file_exists('controllers/' . $file)) {
                require_once 'controllers/' . $file;
            } elseif (file_exists('models/' . $file)) {
                require_once 'models/' . $file;
            } elseif (file_exists('views/' . $file)) {
                require_once 'views/' . $file;
            }
        });
    }
}
