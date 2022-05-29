<?php
/**
 * Proper way to enqueue scripts and styles
 */
function tiger_load_scripts()
{

    //Add css custom, unapply for customize tools
    if (is_customize_preview()) {
        wp_enqueue_style('style-main', getStyleUri('menu'), array(), null, 'screen');
    }
}

add_action('wp_enqueue_scripts', 'tiger_load_scripts');
