<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitec5bf0f6d066d9cee0e87a020d7be77b
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitec5bf0f6d066d9cee0e87a020d7be77b', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitec5bf0f6d066d9cee0e87a020d7be77b', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitec5bf0f6d066d9cee0e87a020d7be77b::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
