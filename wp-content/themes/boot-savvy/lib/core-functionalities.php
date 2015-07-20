<?php

/*
 * Core functionalities for this theme
 */

function bootsavvy_core_setup() {
    add_theme_support('post-thumbnails');
    global $content_width;
    register_nav_menus(array(
        'main' => __('Main Menu', 'opening'),
    ));
}

add_action('after_setup_theme', 'bootsavvy_core_setup');

/**
 * Image Sizes
 */
add_image_size('preview', 350, 150);

/* * Higher quality images* */

function bootsavvy_higher_quality_compression($quality) {

    $quality = 100;
    return $quality;
}

add_filter('jpeg_quality', 'bootsavvy_higher_quality_compression');

/**
 * post/page title to body classes
 */
function wpprogrammer_post_name_in_body_class($classes) {
    global $post;
    if (is_singular()) {
        array_push($classes, "{$post->post_type}-{$post->post_name}");
    }

    return $classes;
}

add_filter('body_class', 'wpprogrammer_post_name_in_body_class');