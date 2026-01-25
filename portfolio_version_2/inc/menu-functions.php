<?php
/**
 * Menu enhancements.
 */

if (!defined('ABSPATH')) {
    exit;
}

// Add data attributes to menu items
function pv_add_menu_attributes($atts, $item, $args) {
    if ($args->theme_location !== 'primary') {
        return $atts;
    }

    // Add data-scroll-link for smooth scroll JS
    $atts['data-scroll-link'] = '';

    // Add data-nav-link based on the href (assuming href="#home", ID='home')
    $href = $atts['href'];
    if (strpos($href, '#') === 0) {
        $id = substr($href, 1);
        $atts['data-nav-link'] = $id;
    }

    // Add class for styling
    $class_names = empty($item->classes) ? [] : (array) $item->classes;
    $class_names[] = 'pv-nav__link';
    
    // We can't easily add classes strictly via $atts, so we filter classes separately
    // But wait, the walker combines $atts.
    
    return $atts;
}
add_filter('nav_menu_link_attributes', 'pv_add_menu_attributes', 10, 3);

// Custom Walker to output clean <a> tags without <li>
class PV_Walker_Nav_Menu extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $atts = [];
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';
        $atts['class']  = 'pv-nav__link'; 

        // Add active class if current
        if ($item->current) {
            $atts['class'] .= ' is-active';
        }

        // Logic for data attributes
        if ($args->theme_location === 'primary') {
             $atts['data-scroll-link'] = '';
             $href = $atts['href'];
             // Extract ID from #hash
             if (strpos($href, '#') !== false) {
                 $parts = explode('#', $href);
                 $fragment = end($parts);
                 if ($fragment) {
                     $atts['data-nav-link'] = $fragment;
                 }
             }
        }

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value) || $attr === 'data-scroll-link') { // data-scroll-link is empty val
                $value = ($attr === 'href') ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= $item_output;
    }

    // Disable closing tags
    public function end_el(&$output, $item, $depth = 0, $args = null) {}
}
