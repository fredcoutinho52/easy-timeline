<?php
/**
 * Plugin Name: Awards Timeline
 * Description: Add a awards timeline to your website
 * Version: 1.0
 * Author: Fred Coutinho
 */

 // exit if accessed directly
 if(!defined('ABSPATH')) {
    exit;
}

// load scripts
require_once(plugin_dir_path(__FILE__) . '/includes/awards-timeline-scripts.php');

// load shortcodes
require_once(plugin_dir_path(__FILE__) . '/includes/awards-timeline-shortcodes.php');

// check if is admin and include admin scripts
if(is_admin()) {
    // load custom post type
    require_once(plugin_dir_path(__FILE__) . '/includes/awards-timeline-cpt.php');

    // load post fields
    require_once(plugin_dir_path(__FILE__) . '/includes/awards-timeline-fields.php');
}