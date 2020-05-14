<?php

function at_add_fields_metabox() {
    add_meta_box(
        'at_award_fields',
        __('Award Fields'),
        'at_award_fields_callback',
        'award',
        'normal',
        'default'
    );
}

add_action('add_meta_boxes', 'at_add_fields_metabox');

// display meta box content
function at_award_fields_callback($post) {
    wp_nonce_field(basename(__FILE__), 'at_awards_nonce');
    $at_award_stored_meta = get_post_meta($post->ID);
    ?>

    <div class="wrap award-form">
        <div class="form-group">
            <label for="award-date"><?php esc_html_e('Award Date', 'at_domain'); ?></label>
            <input 
                type="text" 
                name="award_date" 
                id="award-date"
                value="<?php if(!empty($at_award_stored_meta['award_date'])) echo esc_attr($at_award_stored_meta['award_date'][0]); ?>"
            >
        </div>

        <div class="form-group">
            <label for="description"><?php esc_html_e('Description', 'at_domain'); ?></label>
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

function at_award_save($post_id) {
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['at_awards_nonce']) && wp_verify_nonce($_POST['at_awards_nonce'], basename(__FILE__))) ? 'true' : 'false';

    if($is_autosave || $is_revision || !$is_valid_nonce) {
        return;
    }

    if(isset($_POST['award_date'])) {
        update_post_meta($post_id, 'award_date', sanitize_text_field($_POST['award_date']));
    }

    if(isset($_POST['description'])) {
        update_post_meta($post_id, 'description', sanitize_text_field($_POST['description']));
    }
}

add_action('save_post', 'at_award_save');