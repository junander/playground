<?php

/**
 * Loop storage
 */

/**
 * Retreive ids based on a set of p2p connection criteria
 * @global type $post
 * @param type $p2p_cpt
 * @param type $posttype
 * @return array
 */
function bootsavvy_p2p_return_ids($p2p_cpt, $posttype) {
    global $post;
    $p2p_ids_final = array();
    $p2p_final = NULL;
    $p2p_count = 0;

    if ($p2p_cpt && !empty($p2p_cpt)) {
        foreach ($p2p_cpt as $p2p) {

            $p2p_ids = array();
            $p2p_types = array();

            if (is_array($posttype)) {

                foreach ($posttype as $ind_posttype) {
                    $p2p_type_order = array($p2p['posttype'], $ind_posttype);
                    sort($p2p_type_order);
                    $p2p_type_builder = '';
                    $count = 0;
                    foreach ($p2p_type_order as $p2p_type_elem) {
                        $p2p_type_builder .= $p2p_type_elem;
                        if ($count == 0) {
                            $p2p_type_builder .= '_';
                        }
                        $count++;
                    }

                    array_push($p2p_types, $p2p_type_builder);
                }
            } else {

                $p2p_type_order = array($p2p['posttype'], $posttype);
                sort($p2p_type_order);
                $p2p_type_builder = '';
                $count = 0;
                foreach ($p2p_type_order as $p2p_type_elem) {
                    $p2p_type_builder .= $p2p_type_elem;
                    if ($count == 0) {
                        $p2p_type_builder .= '_';
                    }
                    $count++;
                }

                array_push($p2p_types, $p2p_type_builder);
            }

            $post_args = array(
                'post_type' => $posttype,
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'connected_type' => $p2p_types,
                'connected_items' => $p2p['postid'],
            );

            $legacy = $post;
            $post_query = new WP_Query($post_args);
            $count = 1;

            if ($post_query->have_posts()):
                while ($post_query->have_posts()) : $post_query->the_post();
                    array_push($p2p_ids, $post->ID);
                endwhile;
            endif;
            wp_reset_postdata();
            $post = $legacy;

            array_push($p2p_ids_final, $p2p_ids);
            $p2p_count++;
        }
    }

    if ($p2p_count > 1) {
        $p2p_final = call_user_func_array('array_intersect', $p2p_ids_final);
    } else {
        $p2p_final = $p2p_ids;
    }

    return $p2p_final;
}