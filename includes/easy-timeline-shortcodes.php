<?php

// list awards
function estl_list_items($atts, $content=null) {
    global $post;

    $atts = shortcode_atts(array(
        'title' => 'Items Timeline',
        'count' => 20,
        'category' => 'all'
    ), $atts);

    // check category
    if($atts['category'] == 'all') {
        $terms = '';
    } else {
        $terms = array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $atts['category']
            )
            );
    }

    // query args
    $args = array(
        'post_type' => 'item',
        'post_status' => 'publish',
        'orderby' => 'created',
        'order' => 'DESC',
        'posts_per_page' => $atts['count'],
        'tax_query' => $terms
    );

    // fetch awards
    $items = new WP_Query($args);

    // check for awards
    if($items->have_posts()) {
        $category = str_replace('-', ' ', $atts['category']);

        // init output
        $output = '';

        // counter for posts
        $counter = 0;

        // build output
        $output .= '<div class="container timeline-container">';
        $output .= '<ul class="timeline">';

        while($items->have_posts()) {
            $items->the_post();

            // get field values
            $item_date = get_post_meta($post->ID, 'item_date', true);
            $description = get_post_meta($post->ID, 'description', true);

            // building each post
            if($counter % 2 == 0) {
                $output .= '<li>';
            } else {
                $output .= '<li class="timeline-inverted">';
            }

            $output .= '<div class="timeline-badge"></div>';

            $output .= '<div class="timeline-panel">';

            $output .= '<div class="timeline-heading">';
            $output .= '<h4 class="timeline-title">' . get_the_title() . '</h4>';
            $output .= '<p class="date"><small class="text-muted">' . $item_date . '</small></p>';
            $output .= '</div>';

            $output .= '<div class="timeline-body">';
            $output .= '<p>' . $description . '</p>';
            $output .= '</div>';

            $output .= '</div>';

            $output .= '</li>';

            $counter += 1;
        }

        $output .= '</ul>';
        $output .= '</div>';

        // reset post data
        wp_reset_postdata();

        return $output;
    } else {
        return '<p>No Items Found</p>';
    }
}

// awards list shortcode
add_shortcode('timeline', 'estl_list_items');