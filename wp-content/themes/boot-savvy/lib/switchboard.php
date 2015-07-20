<?php

/**
 * Directing traffic
 * Page and post conditionals
 */
function bootsavvy_post_conditionals() {
    global $post;
    $post_content = '';

    switch ($post->post_type):

        default:
            $post_content = get_the_content_with_formatting();
            break;

    endswitch;

    return $post_content;
}

function bootsavvy_page_conditionals() {
    global $post;
    $page_content = '';

    switch ($post->post_name):
        
        case 'sample-filtering':
            $page_content = bootsavvy_get_sample_filtering();
            break;
        default:
            $page_content = get_the_content_with_formatting();
            break;

    endswitch;

    echo $page_content;
}
