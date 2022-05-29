<?php
/**
 * Proper way to enqueue scripts and styles
 */
function tiger_load_scripts()
{
    wp_enqueue_style('style-main', getStyleUri('menu'), array(), null, 'screen');
}

add_action('wp_enqueue_scripts', 'tiger_load_scripts');

//function widget_theme_support()
//{
//    remove_theme_support('widgets-block-editor');
//}
//
//add_action('after_setup_theme', 'widget_theme_support');


// Update CSS within in Admin
//function admin_style()
//{
//    wp_enqueue_style('admin-styles', getStyleUri('admin'));
//}
//
//add_action('admin_enqueue_scripts', 'admin_style');