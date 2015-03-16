<?php
/**
 * Plugin Name: Responsive Images for Developers
 * Plugin URI: https://github.com/digitalunited/du-responsive-images
 * Author: Digital United, Tim Samuelsson
 * Author URI: http://digitalunited.io
 */

//$plugginFile = __FILE__;
//
//register_activation_hook($plugginFile, function () {
//    $themeDir = get_template_directory();
//    $customThemeFile = 'VcCleanUpConfig.php';
//
//    if (file_exists($themeDir . '/' . $customThemeFile)) {
//        return;
//    }
//
//    $stringData = file_get_contents('configBoilerplate.php', FILE_USE_INCLUDE_PATH);
//
//    $fh = fopen($themeDir . '/' . $customThemeFile, 'w') or die('cant open file');
//    fwrite($fh, $stringData);
//    fclose($fh);
//});

require __DIR__ . '/libs/aq_resizer.php';
require __DIR__ . '/libs/php-html-generator/HtmlTag.php';
require __DIR__ . '/libs/php-html-generator/Markup.php';

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
}

require __DIR__ . '/ResponsiveImage.php';

//TODO Move to separate files.
//TODO Rename css and js files
function DuResponsiveImageStyles()
{
    wp_register_style('custom-style', plugins_url('/assets/css/main.css', __FILE__), array(), '20120208', 'all');
    wp_enqueue_style('custom-style');
}

add_action('wp_enqueue_scripts', 'DuResponsiveImageStyles');

function DuResponsiveImageScripts()
{
    wp_register_script('custom-script', plugins_url('/assets/js/scripts.min.js', __FILE__));
    wp_enqueue_script('custom-script');
}

add_action('wp_enqueue_scripts', 'DuResponsiveImageScripts');