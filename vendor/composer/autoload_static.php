<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb3425906e30bcbaadc726f4a19b9d137
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'Blx32\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Blx32\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Blx32',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb3425906e30bcbaadc726f4a19b9d137::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb3425906e30bcbaadc726f4a19b9d137::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}