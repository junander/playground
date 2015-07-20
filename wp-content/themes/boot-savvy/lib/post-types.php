<?php

/**
 * Post type and related Taxonomic declarations
 */
//arg variable declerations; also let's us see all cpts at a glance
$color_args = array();
$shape_args = array();
$style_args = array();

//colors
$color_args['name'] = 'colors';
$color_args['post_type'] = array('post');
$color_args['labels'] = array(
    'singular' => 'Color',
    'plural' => 'Colors',
);

$Colors = new Bamboo_Custom_Taxonomy($color_args);

//shapes
$shape_args['name'] = 'shapes';
$shape_args['post_type'] = array('post');
$shape_args['labels'] = array(
    'singular' => 'Shape',
    'plural' => 'Shapes',
);

$Shapes = new Bamboo_Custom_Taxonomy($shape_args);

//styles
$style_args['name'] = 'styles';
$style_args['post_type'] = array('post');
$style_args['labels'] = array(
    'singular' => 'Style',
    'plural' => 'Styles',
);

$Styles = new Bamboo_Custom_Taxonomy($style_args);

/* Register connection */

function bootsavvy_register_connections() {
    
}

add_action('init', 'bootsavvy_register_connections');
