<?php

/**
 * Functionalities that are sitewide, i.e. persistent
 */

/**
 * Create a custom excerpt
 * @param type $text - post->content
 * @param type $excerpt - post->excerpt, to see if custom excerpt already exists
 * @param type $count - word count
 * @return type
 */
function bootsavvy_my_excerpt($text, $excerpt, $count = 55) {
    if ($excerpt)
        return $excerpt;

    $text = strip_shortcodes($text);

    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    $text = strip_tags($text);
    $excerpt_length = apply_filters('excerpt_length', $count);
    $excerpt_more = apply_filters('excerpt_more', ' ' . '...');
    $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if (count($words) > $excerpt_length) {
        array_pop($words);
        $text = implode(' ', $words);
        $text = $text . $excerpt_more;
    } else {
        $text = implode(' ', $words);
    }

    return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}

/**
 * Returns a slug for URL needs
 * @param type $str
 * @param type $replace
 * @param type $delimiter
 * @return type
 */
function bootsavvy_slug_generator($str, $replace = array(), $delimiter = '-') {
    if (!empty($replace)) {
        $str = str_replace((array) $replace, ' ', $str);
    }

    $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
    $clean = strtolower(trim($clean, '-'));
    $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

    return $clean;
}

/**
 * Get content with formatting in place 
 * @param type $more_link_text
 * @param type $stripteaser
 * @param type $more_file
 * @return type
 */
function get_the_content_with_formatting($more_link_text = '(more...)', $stripteaser = 0) {
    $content = get_the_content($more_link_text, $stripteaser);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}

/**
 * Comprehensive text/textarea/wysiwyg checker
 * Looks to see if field exists and if it's not empty space
 * @param type $field
 * @return boolean
 */
function bootsavvy_field_verification($field) {
    $return_value = NULL;

    if ($field && !ctype_space($field) && $field !== '') {
        $return_value = true;
    }

    return $return_value;
}

function bootsavvy_ob_get($filename) {
    global $post;
}
