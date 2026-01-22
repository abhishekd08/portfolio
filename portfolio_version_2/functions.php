<?php
/**
 * Portfolio Version 2 Theme setup.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('portfolio_version_2_setup')) {
    function portfolio_version_2_setup() {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    }
}
add_action('after_setup_theme', 'portfolio_version_2_setup');

if (!function_exists('portfolio_version_2_scripts')) {
    function portfolio_version_2_scripts() {
        $theme_version = wp_get_theme()->get('Version');

        wp_enqueue_style(
            'portfolio-version-2-style',
            get_stylesheet_uri(),
            [],
            $theme_version
        );

        wp_enqueue_style(
            'portfolio-version-2-main',
            get_template_directory_uri() . '/assets/css/main.css',
            ['portfolio-version-2-style'],
            $theme_version
        );

        wp_enqueue_script(
            'portfolio-version-2-main',
            get_template_directory_uri() . '/assets/js/main.js',
            [],
            $theme_version,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'portfolio_version_2_scripts');
