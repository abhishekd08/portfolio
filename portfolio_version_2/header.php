<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class('pv-body'); ?>>
<?php wp_body_open(); ?>
<header class="pv-header" data-header>
    <div class="pv-container pv-header__inner">
        <div class="pv-header__logo">
            <span class="pv-header__title" data-header-title aria-hidden="true">Abhishek</span>
        </div>
        <nav class="pv-nav" aria-label="Primary">
            <a href="#home" class="pv-nav__link" data-scroll-link>Home</a>
            <a href="#experience" class="pv-nav__link" data-scroll-link>Experience</a>
            <a href="#projects" class="pv-nav__link" data-scroll-link>Projects</a>
            <a href="#blog" class="pv-nav__link" data-scroll-link>Blog</a>
        </nav>
        <div class="pv-header__actions">
            <button class="pv-theme-toggle" data-theme-toggle aria-label="Toggle theme">
                <span class="pv-icon pv-icon--sun" aria-hidden="true">
                    <svg viewBox="0 0 24 24" role="presentation" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="5" />
                        <line x1="12" y1="1" x2="12" y2="4" />
                        <line x1="12" y1="20" x2="12" y2="23" />
                        <line x1="4.22" y1="4.22" x2="6.34" y2="6.34" />
                        <line x1="17.66" y1="17.66" x2="19.78" y2="19.78" />
                        <line x1="1" y1="12" x2="4" y2="12" />
                        <line x1="20" y1="12" x2="23" y2="12" />
                        <line x1="4.22" y1="19.78" x2="6.34" y2="17.66" />
                        <line x1="17.66" y1="6.34" x2="19.78" y2="4.22" />
                    </svg>
                </span>
                <span class="pv-icon pv-icon--moon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" role="presentation" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 14.5A8.5 8.5 0 0 1 9.5 3a7 7 0 1 0 11.5 11.5Z" />
                    </svg>
                </span>
            </button>
            <button class="pv-mobile-trigger" data-mobile-open aria-label="Open navigation">
                <svg viewBox="0 0 24 24" role="presentation" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="6" x2="21" y2="6" />
                    <line x1="3" y1="12" x2="21" y2="12" />
                    <line x1="3" y1="18" x2="21" y2="18" />
                </svg>
            </button>
        </div>
    </div>
    <div class="pv-mobile-panel" data-mobile-panel>
        <div class="pv-mobile-panel__header">
            <span>Menu</span>
            <button class="pv-mobile-close" data-mobile-close aria-label="Close navigation">
                <svg viewBox="0 0 24 24" role="presentation" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="5" x2="19" y2="19" />
                    <line x1="19" y1="5" x2="5" y2="19" />
                </svg>
            </button>
        </div>
        <nav class="pv-mobile-nav" aria-label="Mobile">
            <a href="#home" data-scroll-link>Home</a>
            <a href="#experience" data-scroll-link>Experience</a>
            <a href="#projects" data-scroll-link>Projects</a>
            <a href="#blog" data-scroll-link>Blog</a>
        </nav>
    </div>
    <div class="pv-mobile-overlay" data-mobile-overlay></div>
</header>
