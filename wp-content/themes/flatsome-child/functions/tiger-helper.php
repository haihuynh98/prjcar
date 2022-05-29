<?php

/*
|--------------------------------------------------------------------------
| Helper functions
|--------------------------------------------------------------------------
*/

/**
 * Dump variables and die.
 */
if (!function_exists('dd')) {

    function dd($data)
    {
        ini_set("highlight.comment", "#969896; font-style: italic");
        ini_set("highlight.default", "#FFFFFF");
        ini_set("highlight.html", "#D16568");
        ini_set("highlight.keyword", "#7FA3BC; font-weight: bold");
        ini_set("highlight.string", "#F2C47E");
        $output = highlight_string("<?php\n\n" . var_export($data, true), true);
        echo "<div style=\"background-color: #1C1E21; padding: 1rem\">{$output}</div>";
        die();
    }

}

/**
 * Get uri asset
 */
if (!function_exists('getAssestUri')) {

    function getAssetUri(): string
    {
        return get_template_directory_uri() . '-child/assets';
    }

}

/**
 * Get uri of style file
 */
if (!function_exists('getStyleUri')) {

    function getStyleUri($fileName): string
    {
        $extension = '.css';
        $pos = strpos($fileName, $extension);
        if ($pos) {
            return getAssetUri() . '/css/' . $fileName;
        }
        return getAssetUri() . '/css/' . $fileName . $extension;
    }

}

/**
 * Get uri of js file
 */
if (!function_exists('getScriptUri')) {

    function getScriptUri($fileName): string
    {
        $extension = '.js';
        $pos = strpos($fileName, $extension);
        if ($pos) {
            return getAssetUri() . '/js/' . $fileName;
        }
        return getAssetUri() . '/js/' . $fileName . $extension;
    }

}

/**
 * Get images of js file
 */
if (!function_exists('getMediaUri')) {

    function getMediaUri($fileName, $path = '/images'): string
    {
        return getAssetUri() . $path . '/' . $fileName;
    }

}


/**
 * Get images thumbnail with post id
 */
if (!function_exists('getScrThumbnail')) {

    function getScrThumbnail($post, $size = 'single-post-thumbnail'): string
    {
        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size);
        return $image[0];
    }

}

/**
 * Get content of post with id
 */
if (!function_exists('getPostContent')) {

    function getPostContent($post): string
    {
        return apply_filters('the_content', get_post_field('post_content', $post->ID));
    }

}
