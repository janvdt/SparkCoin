<?php

// autoload_real.php @generated by Composer

<<<<<<< HEAD
class ComposerAutoloaderInit76d944bbbd50c99ec22d9b01c8338823
=======
class ComposerAutoloaderInit2c689f1d994a3006ce04748ea37078d6
>>>>>>> FETCH_HEAD
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

<<<<<<< HEAD
        spl_autoload_register(array('ComposerAutoloaderInit76d944bbbd50c99ec22d9b01c8338823', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInit76d944bbbd50c99ec22d9b01c8338823', 'loadClassLoader'));
=======
        spl_autoload_register(array('ComposerAutoloaderInit2c689f1d994a3006ce04748ea37078d6', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInit2c689f1d994a3006ce04748ea37078d6', 'loadClassLoader'));
>>>>>>> FETCH_HEAD

        $vendorDir = dirname(__DIR__);
        $baseDir = dirname($vendorDir);

        $includePaths = require __DIR__ . '/include_paths.php';
        array_push($includePaths, get_include_path());
        set_include_path(join(PATH_SEPARATOR, $includePaths));

        $map = require __DIR__ . '/autoload_namespaces.php';
        foreach ($map as $namespace => $path) {
            $loader->set($namespace, $path);
        }

        $map = require __DIR__ . '/autoload_psr4.php';
        foreach ($map as $namespace => $path) {
            $loader->setPsr4($namespace, $path);
        }

        $classMap = require __DIR__ . '/autoload_classmap.php';
        if ($classMap) {
            $loader->addClassMap($classMap);
        }

        $loader->register(true);

        $includeFiles = require __DIR__ . '/autoload_files.php';
        foreach ($includeFiles as $file) {
<<<<<<< HEAD
            composerRequire76d944bbbd50c99ec22d9b01c8338823($file);
=======
            composerRequire2c689f1d994a3006ce04748ea37078d6($file);
>>>>>>> FETCH_HEAD
        }

        return $loader;
    }
}

<<<<<<< HEAD
function composerRequire76d944bbbd50c99ec22d9b01c8338823($file)
=======
function composerRequire2c689f1d994a3006ce04748ea37078d6($file)
>>>>>>> FETCH_HEAD
{
    require $file;
}
