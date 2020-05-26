<?php

// check if is admin and add admin scripts
if(is_admin()) {
    function estl_add_admin_scripts() {
        wp_enqueue_style('estl-main-admin-style', plugins_url() . '/easy-timeline/css/admin.css');
    }

    add_action('admin_init', 'estl_add_admin_scripts');
}

// add scripts
function estl_add_acripts() {
    wp_enqueue_style('estl-main-style', plugins_url() . '/easy-timeline/css/style.css');
}

add_action('wp_enqueue_scripts', 'estl_add_acripts');