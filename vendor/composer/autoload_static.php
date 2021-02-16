<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6018c9340d64040e7368de6b0347d653
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Phpcrud\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Phpcrud\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6018c9340d64040e7368de6b0347d653::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6018c9340d64040e7368de6b0347d653::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
