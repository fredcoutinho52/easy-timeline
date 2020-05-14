<?php

// create custom post type
function at_register_award() {
    $singular_name = apply_filters('yg_label_single', 'Award');
    $plural_name = apply_filters('yg_label_plural', 'Awards');

    $labels = array(
        'name' => $plural_name,
        'singular_name' => $singular_name,
        'add_new' => 'Add New',
        'add_new_item' => 'Add New ' . $singular_name,
        'edit' => 'Edit',
        'edit_item' => 'Edit ' . $singular_name,
        'new_item' => 'New ' . $singular_name,
        'view' => 'View',
        'view_item' => 'View' . $singular_name,
        'search_items' => 'Search ' . $plural_name,
        'not_found' => 'No ' . $plural_name . ' Found',
        'not_found_in_trash' => 'No ' . $plural_name . ' Found',
        'menu_name' => $plural_name
    );

    $args = apply_filters('at_award_args', array(
        'labels' => $labels,
        'description' => 'Awards by category',
        'taxonomies' => array('category'),
        'public' => true,
        'show_in_menu' => true,
        'menu_position' => 8,
        'menu_icon' => 'dashicons-calendar-alt',
        'show_in_nav_menus' => true,
        'capability_type' => 'post',
        'supports' => array(
            'title'
        )
    ));

    // resgiter post type
    register_post_type('award', $args);
}

add_action('init', 'at_register_award');