<?php

// add scripts
function at_add_acripts() {
    wp_enqueue_style('at-main-style', plugins_url() . '/awards-timeline/css/style.css');
}

add_action('wp_enqueue_scripts', 'at_add_acripts');