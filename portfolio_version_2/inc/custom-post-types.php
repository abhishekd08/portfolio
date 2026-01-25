<?php
/**
 * Register Custom Post Types.
 */

if (!defined('ABSPATH')) {
    exit;
}

function pv_register_post_types() {
    // Experience CPT
    register_post_type('experience', [
        'labels' => [
            'name' => 'Experience',
            'singular_name' => 'Experience Role',
            'add_new_item' => 'Add New Role',
            'edit_item' => 'Edit Role',
            'all_items' => 'All Experience',
        ],
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-businessperson',
        'supports' => ['title'], // We will use custom metaboxes for everything else
        'show_in_rest' => true,
        'menu_position' => 20,
    ]);

    // Project CPT
    register_post_type('project', [
        'labels' => [
            'name' => 'Projects',
            'singular_name' => 'Project',
            'add_new_item' => 'Add New Project',
            'edit_item' => 'Edit Project',
            'all_items' => 'All Projects',
        ],
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => ['title', 'editor'], // Editor for full description? Or just custom fields?
        // Staying true to original strict structure, we will use custom fields for specific parts
        // But keeping 'editor' support is good specifically if user wants to type a lot
        // However, the original theme had very specific fields: Problem, Value, Description.
        'supports' => ['title', 'thumbnail'], 
        'show_in_rest' => true,
        'menu_position' => 21,
    ]);
}
add_action('init', 'pv_register_post_types');

/**
 * Calculate and save a numeric sort date (YYYYMM) whenever a post is saved.
 * This allows correct chronological sorting by "Month Name, Year".
 */
function pv_update_sort_date($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    
    $post_type = get_post_type($post_id);
    if (!in_array($post_type, ['experience', 'project'])) return;

    // Define field names based on type
    if ($post_type === 'experience') {
        $month_key = '_pv_month';
        $year_key  = '_pv_year';
    } else {
        $month_key = '_pv_project_month';
        $year_key  = '_pv_project_year';
    }

    $month_str = get_post_meta($post_id, $month_key, true);
    $year_str  = get_post_meta($post_id, $year_key, true);

    if (empty($year_str)) return; 

    // Parse Month
    $month_num = 1; // Default to Jan
    if ($month_str) {
        // Try parsing "March", "Mar", "03", etc.
        $ts = strtotime("$month_str 1 $year_str");
        if ($ts) {
            $month_num = date('n', $ts);
        }
    }

    $sort_val = sprintf('%04d%02d', intval($year_str), $month_num);
    update_post_meta($post_id, '_pv_sort_date', $sort_val);
}
add_action('save_post', 'pv_update_sort_date');
