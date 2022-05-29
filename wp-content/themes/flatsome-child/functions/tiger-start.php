<?php


//if (!function_exists('tiger_preload_webfonts')) :
//
//    /**
//     * Preloads the main web font to improve performance.
//     *
//     * Only the main web font (font-style: normal) is preloaded here since that font is always relevant (it is used
//     * on every heading, for example). The other font is only needed if there is any applicable content in italic style,
//     * and therefore preloading it would in most cases regress performance when that font would otherwise not be loaded
//     * at all.
//     *
//     * @return void
//     * @since Twenty Twenty-Two 1.0
//     *
//     */
//    function tiger_preload_webfonts()
//    {
//        ?>
<!--        <link rel="preload"-->
<!--              href="--><?php //echo esc_url(get_theme_file_uri('assets/fonts/SourceSerif4Variable-Roman.ttf.woff2')); ?><!--"-->
<!--              as="font" type="font/woff2" crossorigin>-->
<!--        --><?php
//    }
//
//endif;

//add_action('wp_head', 'tiger_preload_webfonts');

/**
 * Proper way to enqueue scripts and styles
 */
function tiger_load_scripts()
{
    wp_enqueue_style('style-main', getStyleUri('menu'), array(), null, 'screen');
}

add_action('wp_enqueue_scripts', 'tiger_load_scripts');

function widget_theme_support()
{
    remove_theme_support('widgets-block-editor');
}

add_action('after_setup_theme', 'widget_theme_support');


// Update CSS within in Admin
function admin_style()
{
    wp_enqueue_style('admin-styles', getStyleUri('admin'));
}

add_action('admin_enqueue_scripts', 'admin_style');