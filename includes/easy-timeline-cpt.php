<?php

// create custom post type
function estl_register_item() {
    $singular_name = apply_filters('estl_label_single', 'Item');
    $plural_name = apply_filters('estl_label_plural', 'Items');

    $labels = array(
        'name' => 'Timeline Items',
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
        'menu_name' => 'Timeline'
    );

    $args = apply_filters('estl_item_args', array(
        'labels' => $labels,
        'description' => 'Items by category',
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
    register_post_type('item', $args);
}

add_action('init', 'estl_register_item');