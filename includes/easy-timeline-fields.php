<?php

function estl_add_fields_metabox() {
    add_meta_box(
        'estl_item_fields',
        __('Items Fields'),
        'estl_item_fields_callback',
        'item',
        'normal',
        'default'
    );
}

add_action('add_meta_boxes', 'estl_add_fields_metabox');

// display meta box content
function estl_item_fields_callback($post) {
    wp_nonce_field(basename(__FILE__), 'estl_items_nonce');
    $estl_item_stored_meta = get_post_meta($post->ID);
    ?>

    <div class="wrap timeline-form">
        <div class="form-group">
            <label class="form-label" for="item-date"><?php esc_html_e('Item Date:', 'estl_domain'); ?></label>
            <input 
                type="text"
                name="item_date"
                id="item-date"
                value="<?php if(!empty($at_award_stored_meta['item_date'])) echo esc_attr($at_award_stored_meta['item_date'][0]); ?>"
            >
        </div>

        <div class="form-group">
            <label class="form-label" for="description"><?php esc_html_e('Description', 'estl_domain'); ?></label>
            <?php
                $content = get_post_meta($post->ID, 'description', true);
                $editor = 'description';
                $settings = array(
                    'textarea_rows' => 8,
                    'media_buttons' => false
                );

                wp_editor($content, $editor, $settings);
            ?>
        </div>
    </div>

    <?php
}

function estl_item_save($post_id) {
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['estl_items_nonce']) && wp_verify_nonce($_POST['estl_items_nonce'], basename(__FILE__))) ? 'true' : 'false';

    if($is_autosave || $is_revision || !$is_valid_nonce) {
        return;
    }

    if(isset($_POST['item_date'])) {
        update_post_meta($post_id, 'item_date', sanitize_text_field($_POST['item_date']));
    }

    if(isset($_POST['description'])) {
        update_post_meta($post_id, 'description', sanitize_text_field($_POST['description']));
    }
}

add_action('save_post', 'estl_item_save');