<?php
/**
 * Register Meta Boxes for CPTs.
 */

if (!defined('ABSPATH')) {
    exit;
}

function pv_add_meta_boxes() {
    add_meta_box('pv_experience_meta', 'Experience Details', 'pv_render_experience_meta', 'experience', 'normal', 'high');
    add_meta_box('pv_project_meta', 'Project Details', 'pv_render_project_meta', 'project', 'normal', 'high');
    add_meta_box('pv_post_meta', 'External Link Settings', 'pv_render_post_meta', 'post', 'side', 'default');
}
add_action('add_meta_boxes', 'pv_add_meta_boxes');

// --- Experience Meta Box ---
function pv_render_experience_meta($post) {
    $company = get_post_meta($post->ID, '_pv_company', true);
    $from_month = get_post_meta($post->ID, '_pv_from_month', true);
    $from_year = get_post_meta($post->ID, '_pv_from_year', true);
    $to_month = get_post_meta($post->ID, '_pv_to_month', true);
    $to_year = get_post_meta($post->ID, '_pv_to_year', true);
    // Backward compatibility: if from/to don't exist, use old month/year
    if (empty($from_month) && empty($from_year)) {
        $from_month = get_post_meta($post->ID, '_pv_month', true);
        $from_year = get_post_meta($post->ID, '_pv_year', true);
    }
    $tech = get_post_meta($post->ID, '_pv_tech', true);
    $description = get_post_meta($post->ID, '_pv_description', true);
    
    wp_nonce_field('pv_save_meta', 'pv_meta_nonce');
    ?>
    <p>
        <label>Company Name:</label><br>
        <input type="text" name="pv_company" value="<?php echo esc_attr($company); ?>" class="widefat">
    </p>
    <div style="display: flex; gap: 10px;">
        <p style="flex: 1;">
            <label>From Month (e.g. March):</label><br>
            <input type="text" name="pv_from_month" value="<?php echo esc_attr($from_month); ?>" class="widefat" required>
        </p>
        <p style="flex: 1;">
            <label>From Year (e.g. 2025):</label><br>
            <input type="text" name="pv_from_year" value="<?php echo esc_attr($from_year); ?>" class="widefat" required>
        </p>
    </div>
    <div style="display: flex; gap: 10px;">
        <p style="flex: 1;">
            <label>To Month (e.g. December):</label><br>
            <input type="text" name="pv_to_month" value="<?php echo esc_attr($to_month); ?>" class="widefat" required>
        </p>
        <p style="flex: 1;">
            <label>To Year (e.g. 2025):</label><br>
            <input type="text" name="pv_to_year" value="<?php echo esc_attr($to_year); ?>" class="widefat" required>
        </p>
    </div>
    <p>
        <label>Tech Stack (comma separated):</label><br>
        <input type="text" name="pv_tech" value="<?php echo esc_attr($tech); ?>" class="widefat">
    </p>
    <p>
        <label>Description Points (One per line, HTML formatting allowed):</label><br>
        <?php
        wp_editor($description, 'pv_description', [
            'textarea_name' => 'pv_description',
            'textarea_rows' => 8,
            'media_buttons' => false,
            'teeny' => true,
            'tinymce' => [
                'toolbar1' => 'bold,italic,underline,bullist,numlist',
                'toolbar2' => '',
            ],
        ]);
        ?>
    </p>
    <?php
}

// --- Project Meta Box ---
function pv_render_project_meta($post) {
    $description = get_post_meta($post->ID, '_pv_project_desc', true);
    $tech = get_post_meta($post->ID, '_pv_project_tech', true);
    $month = get_post_meta($post->ID, '_pv_project_month', true);
    $year = get_post_meta($post->ID, '_pv_project_year', true);
    $image_type = get_post_meta($post->ID, '_pv_image_type', true); // 'ai' or 'web'
    $align = get_post_meta($post->ID, '_pv_align', true); // 'left' or 'right'

    // Get repeater fields or migrate from old problem/value
    $project_fields = get_post_meta($post->ID, '_pv_project_fields', true);
    if (empty($project_fields)) {
        $project_fields = [];
        $problem = get_post_meta($post->ID, '_pv_problem', true);
        $value = get_post_meta($post->ID, '_pv_value', true);
        if (!empty($problem)) {
            $project_fields[] = ['label' => 'The Problem', 'content' => $problem];
        }
        if (!empty($value)) {
            $project_fields[] = ['label' => 'Value', 'content' => $value];
        }
    }
    if (empty($project_fields)) {
        $project_fields = [['label' => '', 'content' => '']];
    }

    wp_nonce_field('pv_save_meta', 'pv_meta_nonce');
    ?>
    <p>
        <label>Short Description:</label><br>
        <?php
        wp_editor($description, 'pv_project_desc', [
            'textarea_name' => 'pv_project_desc',
            'textarea_rows' => 4,
            'media_buttons' => false,
            'teeny' => true,
            'tinymce' => [
                'toolbar1' => 'bold,italic,underline,bullist,numlist',
                'toolbar2' => '',
            ],
        ]);
        ?>
    </p>
    <div id="pv-project-fields-repeater" style="margin: 20px 0;">
        <label style="font-weight: 600; display: block; margin-bottom: 10px;">Project Details (Custom Fields):</label>
        <p class="description" style="margin-bottom: 15px;">Add custom fields like "The Problem", "Value", "Core Implementation", etc. Each field will display in a yellow box on the frontend.</p>
        <div id="pv-project-fields-container">
            <?php foreach ($project_fields as $index => $field) : ?>
                <div class="pv-project-field-row" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; background: #f9f9f9;">
                    <div style="display: flex; gap: 10px; margin-bottom: 10px;">
                        <div style="flex: 1;">
                            <label>Field Label:</label><br>
                            <input type="text" name="pv_project_fields[<?php echo $index; ?>][label]" value="<?php echo esc_attr($field['label']); ?>" class="widefat" placeholder="e.g., The Problem, Value, Core Implementation">
                        </div>
                        <div style="display: flex; align-items: flex-end;">
                            <button type="button" class="button pv-remove-field" style="margin-bottom: 0;">Remove</button>
                        </div>
                    </div>
                    <div>
                        <label>Field Content:</label><br>
                        <?php
                        $editor_id = 'pv_project_field_' . $index;
                        wp_editor($field['content'], $editor_id, [
                            'textarea_name' => 'pv_project_fields[' . $index . '][content]',
                            'textarea_rows' => 3,
                            'media_buttons' => false,
                            'teeny' => true,
                            'tinymce' => [
                                'toolbar1' => 'bold,italic,underline,bullist,numlist',
                                'toolbar2' => '',
                            ],
                        ]);
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="button button-secondary" id="pv-add-project-field">+ Add Field</button>
    </div>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        var fieldIndex = <?php echo count($project_fields); ?>;
        
        $('#pv-add-project-field').on('click', function() {
            var fieldHtml = '<div class="pv-project-field-row" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; background: #f9f9f9;">' +
                '<div style="display: flex; gap: 10px; margin-bottom: 10px;">' +
                '<div style="flex: 1;">' +
                '<label>Field Label:</label><br>' +
                '<input type="text" name="pv_project_fields[' + fieldIndex + '][label]" value="" class="widefat" placeholder="e.g., The Problem, Value, Core Implementation">' +
                '</div>' +
                '<div style="display: flex; align-items: flex-end;">' +
                '<button type="button" class="button pv-remove-field" style="margin-bottom: 0;">Remove</button>' +
                '</div>' +
                '</div>' +
                '<div>' +
                '<label>Field Content:</label><br>' +
                '<textarea name="pv_project_fields[' + fieldIndex + '][content]" rows="3" class="widefat pv-field-content"></textarea>' +
                '</div>' +
                '</div>';
            
            $('#pv-project-fields-container').append(fieldHtml);
            
            // Initialize editor for the new textarea
            var editorId = 'pv_project_field_' + fieldIndex;
            var textarea = $('#pv-project-fields-container .pv-project-field-row:last .pv-field-content');
            textarea.attr('id', editorId);
            
            // Initialize TinyMCE if available
            if (typeof tinyMCE !== 'undefined' && typeof QTags !== 'undefined') {
                // Use quicktags for simpler initialization
                QTags.addButton('pv_' + editorId, 'Bold', '<strong>', '</strong>');
                QTags.addButton('pv_' + editorId + '_i', 'Italic', '<em>', '</em>');
                QTags.addButton('pv_' + editorId + '_u', 'Underline', '<u>', '</u>');
                
                // Try to initialize TinyMCE
                if (tinyMCE.get(editorId) === null) {
                    try {
                        tinyMCE.execCommand('mceAddEditor', false, editorId);
                    } catch(e) {
                        // If TinyMCE fails, at least quicktags will work
                        if (typeof quicktags !== 'undefined') {
                            quicktags({id: editorId});
                        }
                    }
                }
            } else if (typeof quicktags !== 'undefined') {
                quicktags({id: editorId});
            }
            
            fieldIndex++;
        });
        
        $(document).on('click', '.pv-remove-field', function() {
            $(this).closest('.pv-project-field-row').remove();
        });
    });
    </script>
    <p>
        <label>Tech Stack (comma separated):</label><br>
        <input type="text" name="pv_project_tech" value="<?php echo esc_attr($tech); ?>" class="widefat">
    </p>
    <div style="display: flex; gap: 10px;">
        <p style="flex: 1;">
            <label>Month:</label><br>
            <input type="text" name="pv_project_month" value="<?php echo esc_attr($month); ?>" class="widefat">
        </p>
        <p style="flex: 1;">
            <label>Year:</label><br>
            <input type="text" name="pv_project_year" value="<?php echo esc_attr($year); ?>" class="widefat">
        </p>
    </div>
    <div style="display: flex; gap: 10px;">
         <p style="flex: 1;">
            <label>Image Type (Icon):</label><br>
            <select name="pv_image_type" class="widefat">
                <option value="ai" <?php selected($image_type, 'ai'); ?>>AI Brain Icon</option>
                <option value="web" <?php selected($image_type, 'web'); ?>>Web App Window</option>
            </select>
        </p>
        <p style="flex: 1;">
            <label>Alignment on Desktop:</label><br>
            <select name="pv_align" class="widefat">
                <option value="left" <?php selected($align, 'left'); ?>>Image Left / Text Right</option>
                <option value="right" <?php selected($align, 'right'); ?>>Image Right / Text Left</option>
            </select>
        </p>
    </div>
    <?php
}

// --- Post Meta Box ---
function pv_render_post_meta($post) {
    $source = get_post_meta($post->ID, '_pv_source', true);
    $url = get_post_meta($post->ID, '_pv_external_url', true);
    wp_nonce_field('pv_save_meta', 'pv_meta_nonce');
    ?>
    <p>
        <label>Source Label (e.g. Medium):</label><br>
        <input type="text" name="pv_source" value="<?php echo esc_attr($source); ?>" class="widefat">
    </p>
    <p>
        <label>External URL (optional):</label><br>
        <input type="url" name="pv_external_url" value="<?php echo esc_attr($url); ?>" class="widefat">
        <span class="description">If set, "Read article" will link here.</span>
    </p>
    <?php
}

// --- Save Meta ---
function pv_save_meta_data($post_id) {
    if (!isset($_POST['pv_meta_nonce']) || !wp_verify_nonce($_POST['pv_meta_nonce'], 'pv_save_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // Experience
    if (isset($_POST['pv_company'])) update_post_meta($post_id, '_pv_company', sanitize_text_field($_POST['pv_company']));
    if (isset($_POST['pv_from_month'])) update_post_meta($post_id, '_pv_from_month', sanitize_text_field($_POST['pv_from_month']));
    if (isset($_POST['pv_from_year'])) update_post_meta($post_id, '_pv_from_year', sanitize_text_field($_POST['pv_from_year']));
    if (isset($_POST['pv_to_month'])) update_post_meta($post_id, '_pv_to_month', sanitize_text_field($_POST['pv_to_month']));
    if (isset($_POST['pv_to_year'])) update_post_meta($post_id, '_pv_to_year', sanitize_text_field($_POST['pv_to_year']));
    if (isset($_POST['pv_tech'])) update_post_meta($post_id, '_pv_tech', sanitize_text_field($_POST['pv_tech']));
    if (isset($_POST['pv_description'])) update_post_meta($post_id, '_pv_description', wp_kses_post($_POST['pv_description']));

    // Projects
    if (isset($_POST['pv_project_desc'])) update_post_meta($post_id, '_pv_project_desc', wp_kses_post($_POST['pv_project_desc']));
    
    // Handle repeater fields
    if (isset($_POST['pv_project_fields']) && is_array($_POST['pv_project_fields'])) {
        $project_fields = [];
        foreach ($_POST['pv_project_fields'] as $field) {
            if (!empty($field['label']) || !empty($field['content'])) {
                $project_fields[] = [
                    'label' => sanitize_text_field($field['label']),
                    'content' => wp_kses_post($field['content'])
                ];
            }
        }
        update_post_meta($post_id, '_pv_project_fields', $project_fields);
    } else {
        // If no repeater fields and old problem/value exist, migrate them
        $existing_fields = get_post_meta($post_id, '_pv_project_fields', true);
        if (empty($existing_fields)) {
            $problem = get_post_meta($post_id, '_pv_problem', true);
            $value = get_post_meta($post_id, '_pv_value', true);
            $migrated_fields = [];
            if (!empty($problem)) {
                $migrated_fields[] = ['label' => 'The Problem', 'content' => $problem];
            }
            if (!empty($value)) {
                $migrated_fields[] = ['label' => 'Value', 'content' => $value];
            }
            if (!empty($migrated_fields)) {
                update_post_meta($post_id, '_pv_project_fields', $migrated_fields);
            }
        }
    }
    
    if (isset($_POST['pv_project_tech'])) update_post_meta($post_id, '_pv_project_tech', sanitize_text_field($_POST['pv_project_tech']));
    if (isset($_POST['pv_project_month'])) update_post_meta($post_id, '_pv_project_month', sanitize_text_field($_POST['pv_project_month']));
    if (isset($_POST['pv_project_year'])) update_post_meta($post_id, '_pv_project_year', sanitize_text_field($_POST['pv_project_year']));
    if (isset($_POST['pv_image_type'])) update_post_meta($post_id, '_pv_image_type', sanitize_text_field($_POST['pv_image_type']));
    if (isset($_POST['pv_align'])) update_post_meta($post_id, '_pv_align', sanitize_text_field($_POST['pv_align']));

    // Posts
    if (isset($_POST['pv_source'])) update_post_meta($post_id, '_pv_source', sanitize_text_field($_POST['pv_source']));
    if (isset($_POST['pv_external_url'])) update_post_meta($post_id, '_pv_external_url', esc_url_raw($_POST['pv_external_url']));
}
add_action('save_post', 'pv_save_meta_data');
