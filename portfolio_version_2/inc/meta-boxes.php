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
    $month = get_post_meta($post->ID, '_pv_month', true);
    $year = get_post_meta($post->ID, '_pv_year', true);
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
            <label>Start Month (e.g. March):</label><br>
            <input type="text" name="pv_month" value="<?php echo esc_attr($month); ?>" class="widefat">
        </p>
        <p style="flex: 1;">
            <label>Start Year (e.g. 2025):</label><br>
            <input type="text" name="pv_year" value="<?php echo esc_attr($year); ?>" class="widefat">
        </p>
    </div>
    <p>
        <label>Tech Stack (comma separated):</label><br>
        <input type="text" name="pv_tech" value="<?php echo esc_attr($tech); ?>" class="widefat">
    </p>
    <p>
        <label>Description Points (One per line):</label><br>
        <textarea name="pv_description" rows="5" class="widefat"><?php echo esc_textarea($description); ?></textarea>
    </p>
    <?php
}

// --- Project Meta Box ---
function pv_render_project_meta($post) {
    $description = get_post_meta($post->ID, '_pv_project_desc', true);
    $problem = get_post_meta($post->ID, '_pv_problem', true);
    $value = get_post_meta($post->ID, '_pv_value', true);
    $tech = get_post_meta($post->ID, '_pv_project_tech', true);
    $month = get_post_meta($post->ID, '_pv_project_month', true);
    $year = get_post_meta($post->ID, '_pv_project_year', true);
    $image_type = get_post_meta($post->ID, '_pv_image_type', true); // 'ai' or 'web'
    $align = get_post_meta($post->ID, '_pv_align', true); // 'left' or 'right'

    ?>
    <p>
        <label>Short Description:</label><br>
        <textarea name="pv_project_desc" rows="2" class="widefat"><?php echo esc_textarea($description); ?></textarea>
    </p>
    <p>
        <label>The Problem:</label><br>
        <textarea name="pv_problem" rows="2" class="widefat"><?php echo esc_textarea($problem); ?></textarea>
    </p>
    <p>
        <label>Value Delivered:</label><br>
        <textarea name="pv_value" rows="2" class="widefat"><?php echo esc_textarea($value); ?></textarea>
    </p>
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
    if (isset($_POST['pv_month'])) update_post_meta($post_id, '_pv_month', sanitize_text_field($_POST['pv_month']));
    if (isset($_POST['pv_year'])) update_post_meta($post_id, '_pv_year', sanitize_text_field($_POST['pv_year']));
    if (isset($_POST['pv_tech'])) update_post_meta($post_id, '_pv_tech', sanitize_text_field($_POST['pv_tech']));
    if (isset($_POST['pv_description'])) update_post_meta($post_id, '_pv_description', sanitize_textarea_field($_POST['pv_description']));

    // Projects
    if (isset($_POST['pv_project_desc'])) update_post_meta($post_id, '_pv_project_desc', sanitize_textarea_field($_POST['pv_project_desc']));
    if (isset($_POST['pv_problem'])) update_post_meta($post_id, '_pv_problem', sanitize_textarea_field($_POST['pv_problem']));
    if (isset($_POST['pv_value'])) update_post_meta($post_id, '_pv_value', sanitize_textarea_field($_POST['pv_value']));
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
