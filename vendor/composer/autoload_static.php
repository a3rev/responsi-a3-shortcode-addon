<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc3fb4725c5f6e28a52fb1d71b3f003a3
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'A3Rev\\RShortcode\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'A3Rev\\RShortcode\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
            1 => __DIR__ . '/../..' . '/admin',
            2 => __DIR__ . '/../..' . '/upgrade',
            3 => __DIR__ . '/../..' . '/classes',
            4 => __DIR__ . '/../..' . '/customize',
            5 => __DIR__ . '/../..' . '/shortcodes',
        ),
    );

    public static $classMap = array (
        'A3Rev\\RShortcode\\Admin' => __DIR__ . '/../..' . '/admin/responsi-a3-shortcode-addon-admin.php',
        'A3Rev\\RShortcode\\Buttons' => __DIR__ . '/../..' . '/shortcodes/shortcode-button-class.php',
        'A3Rev\\RShortcode\\Columns' => __DIR__ . '/../..' . '/shortcodes/shortcode-columns-class.php',
        'A3Rev\\RShortcode\\Customizer' => __DIR__ . '/../..' . '/customize/customize.php',
        'A3Rev\\RShortcode\\Dividers' => __DIR__ . '/../..' . '/shortcodes/shortcode-divider-class.php',
        'A3Rev\\RShortcode\\FiveSixth' => __DIR__ . '/../..' . '/shortcodes/column/class-five-sixth.php',
        'A3Rev\\RShortcode\\Flipboxes' => __DIR__ . '/../..' . '/shortcodes/shortcode-flipboxes-class.php',
        'A3Rev\\RShortcode\\FourFifth' => __DIR__ . '/../..' . '/shortcodes/column/class-four-fifth.php',
        'A3Rev\\RShortcode\\Fullwidth' => __DIR__ . '/../..' . '/shortcodes/shortcode-fullwidth-class.php',
        'A3Rev\\RShortcode\\HookFunction' => __DIR__ . '/../..' . '/shortcodes/responsi-a3-shortcode-class.php',
        'A3Rev\\RShortcode\\Icons' => __DIR__ . '/../..' . '/shortcodes/shortcode-icons-class.php',
        'A3Rev\\RShortcode\\Infobox' => __DIR__ . '/../..' . '/shortcodes/shortcode-infobox-class.php',
        'A3Rev\\RShortcode\\Lists' => __DIR__ . '/../..' . '/shortcodes/shortcode-list-generator-class.php',
        'A3Rev\\RShortcode\\Main' => __DIR__ . '/../..' . '/classes/responsi-a3-shortcode-addon-class.php',
        'A3Rev\\RShortcode\\OneFifth' => __DIR__ . '/../..' . '/shortcodes/column/class-one-fifth.php',
        'A3Rev\\RShortcode\\OneFourth' => __DIR__ . '/../..' . '/shortcodes/column/class-one-fourth.php',
        'A3Rev\\RShortcode\\OneHalf' => __DIR__ . '/../..' . '/shortcodes/column/class-one-half.php',
        'A3Rev\\RShortcode\\OneSixth' => __DIR__ . '/../..' . '/shortcodes/column/class-one-sixth.php',
        'A3Rev\\RShortcode\\OneThird' => __DIR__ . '/../..' . '/shortcodes/column/class-one-third.php',
        'A3Rev\\RShortcode\\SocialLinks' => __DIR__ . '/../..' . '/shortcodes/shortcode-social-links-class.php',
        'A3Rev\\RShortcode\\Tabs' => __DIR__ . '/../..' . '/shortcodes/shortcode-tabs-class.php',
        'A3Rev\\RShortcode\\ThreeFifth' => __DIR__ . '/../..' . '/shortcodes/column/class-three-fifth.php',
        'A3Rev\\RShortcode\\ThreeFourth' => __DIR__ . '/../..' . '/shortcodes/column/class-three-fourth.php',
        'A3Rev\\RShortcode\\Toggles' => __DIR__ . '/../..' . '/shortcodes/shortcode-toggles-class.php',
        'A3Rev\\RShortcode\\TwoFifth' => __DIR__ . '/../..' . '/shortcodes/column/class-two-fifth.php',
        'A3Rev\\RShortcode\\TwoThird' => __DIR__ . '/../..' . '/shortcodes/column/class-two-third.php',
        'A3Rev\\RShortcode\\Typography' => __DIR__ . '/../..' . '/shortcodes/shortcode-typography-class.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc3fb4725c5f6e28a52fb1d71b3f003a3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc3fb4725c5f6e28a52fb1d71b3f003a3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc3fb4725c5f6e28a52fb1d71b3f003a3::$classMap;

        }, null, ClassLoader::class);
    }
}
