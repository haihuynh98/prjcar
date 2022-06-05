<?php

// Our custom post type function
function create_projects_posttype()
{
//register taxonomy for custom post tags
	$labels = array(
		'name' => 'Phân loại báo giá',
		'singular' => 'Phân loại',
		'menu_name' => 'Phân loại'
	);
	register_taxonomy(
		'price_tag', //taxonomy
		'price_list', //post-type
		array(
			'hierarchical'  => false,
			'labels'        => $labels,
			'rewrite'       => true,
			'query_var'     => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		));
    register_post_type('price_list',
        // CPT Options
        array(
            'labels' => array(
                'name' => __('Báo giá'),
                'singular_name' => __('Báo giá'),
                'add_new_item' => 'Thêm báo giá',
                'add_new' => 'Thêm báo giá',
                'new_item' => 'Thêm báo giá',
            ),
            'description' => __('Danh sách báo giá xe', 'flatsomechild'),
            // Features this CPT supports in Post Editor
            'supports' => array('title', 'author', 'thumbnail', 'revisions'),
            'taxonomies' => array( 'price_tag'),
            'public' => true,
            'has_archive' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
            'rewrite' => array('slug' => 'price-list'),
            'show_in_rest' => true,
            'exclude_from_search' => TRUE,
			'can_export' => true,
            'menu_icon'    => 'dashicons-analytics',
			'_edit_link' => 'post.php?post_type=price_list&post=%d'
        )
    );
}

// Hooking up our function to theme setup
add_action('init', 'create_projects_posttype');

if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
    // Image size for single posts
    add_image_size('single-post-thumbnail', 500, 500);
}


function getProjectsListing($postsPerPage = 10)
{
    $args = array('post_type' => 'projects', 'posts_per_page' => $postsPerPage);
    $posts = get_posts($args);
//
//    $result = NULL;
//    foreach ($posts as $post) {
//        $item = [
//            'image' => htmlentities(get_the_post_thumbnail_url( $post->ID) )
//        ];
//        $result[] = $item;
//    }
    return $posts;
//    $the_query = new WP_Query($args);
//
//    $arrsOutput = NULL;
//    if ($the_query->have_posts()) {
//
//        $arrsOutput = get_posts( $args );
//        echo'<div class="' . $containerClass . '">';
//        while ($the_query->have_posts()) {
//            $the_query->the_post();
//            echo '<div class="' . $itemClass . '">';
//            echo the_post_thumbnail('full');
//            echo '</div>';
//        }
//        wp_reset_postdata();
//        echo '</div>';
//    }
}

add_action('getClientsListing', 'getClientsListing');


function project_add_meta_box()
{
//this will add the metabox for the project post type
    $screens = array('projects');

    foreach ($screens as $screen) {

        add_meta_box(
            'project_description',
            __('Project Details', 'project_textdomain'),
            'project_description_box',
            $screen
        );
    }
}

add_action('add_meta_boxes', 'project_add_meta_box');

function project_description_box($post)
{
    $value = get_post_meta($post->ID, '_project_description', true);
    wp_editor($value, '_project_description', array(
        'wpautop' => true,
        'media_buttons' => false,
        'textarea_rows' => 10,
        'teeny' => true
    ));
}

function _diwp_save_custom_project_description()
{

    global $post;

    if (isset($_POST['_project_description'])) {
        update_post_meta($post->ID, '_project_description', $_POST['_project_description']);
    }

}

add_action('save_post', '_diwp_save_custom_project_description');

function getProjectDescription($post)
{
    return apply_filters('the_content', get_post_meta($post->ID, '_project_description', true));
}

function getPostTag($post): string
{
    $tags = get_the_tags($post->ID);

    $tagResult = [];
    if (!empty($tags)) {
        foreach ($tags as $tag) {
            $tagResult[] = $tag->name;
        }
    }


    return implode(' - ', $tagResult);
}
