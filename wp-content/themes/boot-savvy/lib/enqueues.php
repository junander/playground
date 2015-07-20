<?php

/**
 * Asset enqueueing
 * WordPress has an enqueueing system for stylesheets and js assets
 * Let's plugins, themes, etc. prevent loading, makes sure an asset is never loaded more than once, makes it easy to load assets into the footer, etc.
 */

/**
 * For loading front end assets
 * Hits both the front and back end, but easy to limit via !is_admin conditional
 * @global type $post
 */
function bootsavvy_load_scripts() {
    global $post;

    /**
     * scripts, additional functionality
     */
    if (!is_admin()) {
        /**
         * I use FireLess to debug the root less styles, and it needs less to run through the js compiler
         * This has obvious performance implications, so I created a flag to relegate this action to dev environments
         */
        if (CSS_DEBUG) {
            wp_register_script('less-config-js', get_stylesheet_directory_uri() . '/js/less.config.js', array('jquery'));
            wp_enqueue_script('less-config-js');
            wp_register_script('less-js', get_stylesheet_directory_uri() . '/js/less-1.7.4.js', array('jquery'));
            wp_enqueue_script('less-js');
        }

        wp_register_script('url-min-js', get_stylesheet_directory_uri() . '/js/url.min.js', array('jquery'));
        wp_enqueue_script('url-min-js');
        wp_register_script('bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array('jquery'));
    }
}

add_action('wp_enqueue_scripts', 'bootsavvy_load_scripts');

//admin scripts
function bootsavvy_admin_scripts() {

    wp_register_style('admin-styles', get_stylesheet_directory_uri() . '/css/admin.css', array(), '2015', 'all');
    wp_enqueue_style('admin-styles');
}

add_action('admin_enqueue_scripts', 'bootsavvy_admin_scripts');

/**
 * Giving the main stylesheet the highest priority among stylesheets to make sure it loads last
 */
function bootsavvy_load_scripts_high_priority() {
    //less compliation via js so we can check styles in firebug via fireless - local dev only
    //@to-do: way to enqueue as last item?
    if (CSS_DEBUG) {
        wp_register_style('main-styles', get_stylesheet_directory_uri() . '/style.less', array(), '20130604', 'all');
        wp_enqueue_style('main-styles');
    } else {
        wp_register_style('main-styles', get_stylesheet_uri(), array(), '20130604', 'all');
        wp_enqueue_style('main-styles');
    }
}

add_action('wp_enqueue_scripts', 'bootsavvy_load_scripts_high_priority', 999);

//for less js - local dev only
function enqueue_less_styles($tag, $handle) {
    global $wp_styles;
    $match_pattern = '/\.less$/U';
    if (preg_match($match_pattern, $wp_styles->registered[$handle]->src)) {
        $handle = $wp_styles->registered[$handle]->handle;
        $media = $wp_styles->registered[$handle]->args;
        $href = $wp_styles->registered[$handle]->src;
        $rel = isset($wp_styles->registered[$handle]->extra['alt']) && $wp_styles->registered[$handle]->extra['alt'] ? 'alternate stylesheet' : 'stylesheet';
        $title = isset($wp_styles->registered[$handle]->extra['title']) ? "title='" . esc_attr($wp_styles->registered[$handle]->extra['title']) . "'" : '';

        $tag = "<link rel='stylesheet/less' $title href='$href' type='text/css' media='$media' />";
    }
    return $tag;
}

add_filter('style_loader_tag', 'enqueue_less_styles', 5, 2);
