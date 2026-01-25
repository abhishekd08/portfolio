<?php
/**
 * Seeder to populate dummy data.
 * Usage: This runs on 'init'. It checks for a transient/flag to ensure it only runs once.
 */

if (!defined('ABSPATH')) {
    exit;
}

function pv_seed_dummy_data() {
    // Check if we already seeded
    if (get_option('pv_dummy_data_seeded')) {
        return;
    }

    // --- 1. Experience ---
    $experiences = [
        [
            'title' => 'Senior Software Engineer',
            'company' => 'TechCorp AI',
            'month' => 'March',
            'year' => '2025',
            'tech' => 'Python, PyTorch, React, AWS',
            'desc' => "Leading the development of a generative AI platform serving 1M+ daily users.\nOptimized inference latency by 40% through custom kernel implementations.\nMentoring junior engineers and establishing code quality standards.\nArchitected a distributed feature store that syncs refreshed embeddings across 15 services."
        ],
        [
            'title' => 'Product Engineer',
            'company' => 'Innovate Solutions',
            'month' => 'July',
            'year' => '2023',
            'tech' => 'Node.js, Redis, Docker, TypeScript',
            'desc' => "Built a real-time collaboration tool from scratch using WebSockets.\nReduced cloud infrastructure costs by 25% via serverless architecture.\nCollaborated directly with design to implement a pixel-perfect design system.\nMigrated legacy services to a container platform with zero downtime deployments."
        ]
    ];

    foreach ($experiences as $exp) {
        $post_id = wp_insert_post([
            'post_type' => 'experience',
            'post_title' => $exp['title'],
            'post_status' => 'publish',
        ]);
        
        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_pv_company', $exp['company']);
            update_post_meta($post_id, '_pv_month', $exp['month']);
            update_post_meta($post_id, '_pv_year', $exp['year']);
            update_post_meta($post_id, '_pv_tech', $exp['tech']);
            update_post_meta($post_id, '_pv_description', $exp['desc']);
        }
    }

    // --- 2. Projects ---
    $projects = [
        [
            'title' => 'Neural Search Engine',
            'desc' => 'A semantic search engine built for legal documents that understands context rather than just keyword matching.',
            'problem' => 'Lawyers spend 30% of their time finding relevant case files using outdated keyword search.',
            'value' => 'Reduced research time by 60% with semantic understanding.',
            'tech' => 'Python, FastAPI, ElasticSearch, React',
            'month' => 'May',
            'year' => '2024',
            'image' => 'ai',
            'align' => 'left'
        ],
        [
            'title' => 'Global Payments Gateway',
            'desc' => 'A unified API for handling payments across 40+ countries with automatic currency conversion and fraud detection.',
            'problem' => 'High transaction failure rates due to poor routing logic in legacy systems.',
            'value' => 'Increased transaction success rate to 99.99%.',
            'tech' => 'Go, gRPC, PostgreSQL, Kafka',
            'month' => 'Jan',
            'year' => '2023',
            'image' => 'web',
            'align' => 'right'
        ],
        [
            'title' => 'Crypto Analytics Dashboard',
            'desc' => 'Real-time dashboard for tracking DeFi portfolio performance across multiple chains.',
            'problem' => 'Fragmented data sources made it impossible to get a holistic view of assets.',
            'value' => 'Unified 10+ chains into a single view, saving users ~5 hours/week of manual tracking.',
            'tech' => 'Solidity, Web3.js, Next.js, Graph Protocol',
            'month' => 'Nov',
            'year' => '2022',
            'image' => 'web',
            'align' => 'left'
        ]
    ];

    foreach ($projects as $proj) {
        $post_id = wp_insert_post([
            'post_type' => 'project',
            'post_title' => $proj['title'],
            'post_status' => 'publish',
        ]);

        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_pv_project_desc', $proj['desc']);
            update_post_meta($post_id, '_pv_problem', $proj['problem']);
            update_post_meta($post_id, '_pv_value', $proj['value']);
            update_post_meta($post_id, '_pv_project_tech', $proj['tech']);
            update_post_meta($post_id, '_pv_project_month', $proj['month']);
            update_post_meta($post_id, '_pv_project_year', $proj['year']);
            update_post_meta($post_id, '_pv_image_type', $proj['image']);
            update_post_meta($post_id, '_pv_align', $proj['align']);
        }
    }

    // --- 3. Writings (Standard Posts) ---
    $posts = [
        [
            'title' => 'The Future of Frontend Architecture',
            'excerpt' => 'Why server components are changing the way we think about state management and data fetching.',
            'date' => '2024-10-12 10:00:00',
            'source' => 'Medium',
            'url' => 'https://medium.com'
        ],
        [
            'title' => 'Scaling Vector Databases',
            'excerpt' => 'Lessons learned from managing 100M+ vectors in production environments.',
            'date' => '2024-09-28 10:00:00',
            'source' => 'Dev.to',
            'url' => 'https://dev.to'
        ],
        [
            'title' => 'Design Systems for Engineers',
            'excerpt' => 'Bridging the gap between Figma and Code with automated tokens and robust component APIs.',
            'date' => '2024-08-15 10:00:00',
            'source' => 'Personal Blog',
            'url' => ''
        ]
    ];

    foreach ($posts as $p) {
        $post_id = wp_insert_post([
            'post_type' => 'post',
            'post_title' => $p['title'],
            'post_excerpt' => $p['excerpt'],
            'post_status' => 'publish',
            'post_date' => $p['date'],
        ]);

        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_pv_source', $p['source']);
            update_post_meta($post_id, '_pv_external_url', $p['url']);
        }
    }

    // Mark as seeded
    update_option('pv_dummy_data_seeded', true);
}
add_action('init', 'pv_seed_dummy_data');

/**
 * Separate function to ensure menu is created even if data seeded returned early.
 */
function pv_ensure_menu_exists() {
    $menu_name = 'Primary Menu';
    $menu_exists = wp_get_nav_menu_object($menu_name);

    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menu_name);

        if ($menu_id && !is_wp_error($menu_id)) {
            // Add Items
            wp_update_nav_menu_item($menu_id, 0, [
                'menu-item-title' => 'Home',
                'menu-item-url' => '#home',
                'menu-item-status' => 'publish',
            ]);
            wp_update_nav_menu_item($menu_id, 0, [
                'menu-item-title' => 'Experience',
                'menu-item-url' => '#experience',
                'menu-item-status' => 'publish',
            ]);
            wp_update_nav_menu_item($menu_id, 0, [
                'menu-item-title' => 'Projects',
                'menu-item-url' => '#projects',
                'menu-item-status' => 'publish',
            ]);
            wp_update_nav_menu_item($menu_id, 0, [
                'menu-item-title' => 'Blog',
                'menu-item-url' => '#blog',
                'menu-item-status' => 'publish',
            ]);
            
            // Force assignment
            $locations = get_theme_mod('nav_menu_locations');
            $locations['primary'] = $menu_id;
            set_theme_mod('nav_menu_locations', $locations);
        }
    } else {
        // Menu exists, check if assigned
        $locations = get_theme_mod('nav_menu_locations');
        if (empty($locations['primary']) || $locations['primary'] !== $menu_exists->term_id) {
             $locations['primary'] = $menu_exists->term_id;
             set_theme_mod('nav_menu_locations', $locations);
        }
    }
}
add_action('init', 'pv_ensure_menu_exists');

/**
 * Backfill sort dates for existing items if missing.
 */
function pv_backfill_sort_dates() {
    // Only run if we haven't done this migration yet
    if (get_option('pv_sorted_backfill_done')) return;

    $args = [
        'post_type' => ['experience', 'project'],
        'posts_per_page' => -1,
        'fields' => 'ids',
    ];
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        foreach ($query->posts as $pid) {
            // Re-trigger calculation
            pv_update_sort_date($pid);
        }
    }
    
    update_option('pv_sorted_backfill_done', true);
}
add_action('init', 'pv_backfill_sort_dates');
