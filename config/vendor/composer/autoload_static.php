<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfe8fa543696a8215d45a3756813c0a02
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfe8fa543696a8215d45a3756813c0a02::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfe8fa543696a8215d45a3756813c0a02::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
