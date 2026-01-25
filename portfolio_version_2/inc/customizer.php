<?php
/**
 * Register Customizer settings.
 */

if (!defined('ABSPATH')) {
    exit;
}

function pv_customize_register($wp_customize) {
    // Identity Section
    $wp_customize->add_section('pv_identity', [
        'title' => 'Portfolio Identity',
        'priority' => 30,
    ]);

    // Roles
    $wp_customize->add_setting('pv_hero_roles', [
        'default' => 'Software Developer · Tech enthusiast · Deep thinker · Systems tinkerer',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('pv_hero_roles', [
        'label' => 'Hero Roles (Top)',
        'section' => 'pv_identity',
        'type' => 'text',
    ]);

    // Avatar
    $wp_customize->add_setting('pv_hero_avatar', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'pv_hero_avatar', [
        'label' => 'Profile Picture',
        'section' => 'pv_identity',
        'settings' => 'pv_hero_avatar',
    ]));

    // Hero Title
    $wp_customize->add_setting('pv_hero_title', [
        'default' => "Hi, I'm Abhishek.",
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('pv_hero_title', [
        'label' => 'Hero Title',
        'section' => 'pv_identity',
        'type' => 'text',
    ]);

    // Hero Text 1 (Bio)
    $wp_customize->add_setting('pv_hero_text_1', [
        'default' => 'I blend systems engineering with thoughtful product sense to ship AI-first capabilities that feel effortless. From semantic search to custom inference runtimes, I obsess over performance, reliability, and the final polish.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('pv_hero_text_1', [
        'label' => 'Bio Paragraph 1',
        'section' => 'pv_identity',
        'type' => 'textarea',
    ]);

    // Hero Text 2 (Bio)
    $wp_customize->add_setting('pv_hero_text_2', [
        'default' => "Currently advising teams on generative tooling, design systems, and developer workflows. Outside work I'm either sketching new typography ideas or testing climbing routes around the Bay.",
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('pv_hero_text_2', [
        'label' => 'Bio Paragraph 2',
        'section' => 'pv_identity',
        'type' => 'textarea',
    ]);

    // Social Links
    $wp_customize->add_section('pv_socials', [
        'title' => 'Social Links',
        'priority' => 31,
    ]);

    $wp_customize->add_setting('pv_linkedin', ['default' => '#', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('pv_linkedin', ['label' => 'LinkedIn URL', 'section' => 'pv_socials', 'type' => 'url']);

    $wp_customize->add_setting('pv_github', ['default' => '#', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('pv_github', ['label' => 'GitHub URL', 'section' => 'pv_socials', 'type' => 'url']);

    $wp_customize->add_setting('pv_instagram', ['default' => '#', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('pv_instagram', ['label' => 'Instagram URL', 'section' => 'pv_socials', 'type' => 'url']);

    $wp_customize->add_setting('pv_medium', ['default' => '#', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('pv_medium', ['label' => 'Medium URL', 'section' => 'pv_socials', 'type' => 'url']);

    $wp_customize->add_setting('pv_email', ['default' => '#', 'sanitize_callback' => 'sanitize_email']);
    $wp_customize->add_control('pv_email', ['label' => 'Email Address', 'section' => 'pv_socials', 'type' => 'text']);
    // --- Footer ---
    $wp_customize->add_section('pv_footer', [
        'title' => 'Footer',
        'priority' => 32,
    ]);

    // Footer Heading
    $wp_customize->add_setting('pv_footer_heading', [
        'default' => 'Thanks for dropping by!',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('pv_footer_heading', [
        'label' => 'Footer Heading',
        'section' => 'pv_footer',
        'type' => 'text',
    ]);

    // Footer Copyright
    $wp_customize->add_setting('pv_footer_copyright', [
        'default' => 'Abhishek Deshpande. Crafted for WordPress.',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('pv_footer_copyright', [
        'label' => 'Footer Copyright Text',
        'section' => 'pv_footer',
        'type' => 'text',
        'description' => 'Will be prefixed by © [Year]',
    ]);
}
add_action('customize_register', 'pv_customize_register');
