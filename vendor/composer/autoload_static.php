<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitffeaafa3fc816bf139899ae09117a97d
{
    public static $files = array (
        '4f0f258269e886bc9165177945bf3095' => __DIR__ . '/../..' . '/www/source/Config.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Source\\' => 7,
        ),
        'C' => 
        array (
            'CoffeeCode\\Router\\' => 18,
            'CoffeeCode\\DataLayer\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Source\\' => 
        array (
            0 => __DIR__ . '/../..' . '/www/source',
        ),
        'CoffeeCode\\Router\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/router/src',
        ),
        'CoffeeCode\\DataLayer\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/datalayer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitffeaafa3fc816bf139899ae09117a97d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitffeaafa3fc816bf139899ae09117a97d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}