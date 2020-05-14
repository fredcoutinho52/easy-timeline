<?php

// list awards
function at_list_awards($atts, $content=null) {
    global $post;

    $atts = shortcode_atts(array(
        'title' => 'Awards Timeline',
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
        'post_type' => 'award',
        'post_status' => 'publish',
        'orderby' => 'created',
        'order' => 'DESC',
        'posts_per_page' => $atts['count'],
        'tax_query' => $terms
    );

    // fetch awards
    $awards = new WP_Query($args);

    // check for awards
    if($awards->have_posts()) {
        $category = str_replace('-', ' ', $atts['category']);

        // init output
        $output = '';

        // counter for posts
        $counter = 0;

        // build output
        $output .= '<div class="container timeline-container">';
        $output .= '<ul class="timeline">';

        while($awards->have_posts()) {
            $awards->the_post();

            // get field values
            $award_date = get_post_meta($post->ID, 'award_date', true);
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
            $output .= '<p class="date"><small class="text-muted">' . $award_date . '</small></p>';
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
        return '<p>No Awards Found</p>';
    }
}

// awards list shortcode
add_shortcode('awards', 'at_list_awards');