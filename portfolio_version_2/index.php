<?php
get_header();

// Fetch Hero/Identity Data from Customizer
$hero_title = get_theme_mod('pv_hero_title', "Hi, I'm Abhishek.");
$hero_roles = get_theme_mod('pv_hero_roles', 'Software Developer · Tech enthusiast · Deep thinker · Systems tinkerer');
$hero_text_1 = get_theme_mod('pv_hero_text_1', "I blend systems engineering with thoughtful product sense to ship AI-first capabilities that feel effortless. From semantic search to custom inference runtimes, I obsess over performance, reliability, and the final polish.");
$hero_text_2 = get_theme_mod('pv_hero_text_2', "Currently advising teams on generative tooling, design systems, and developer workflows. Outside work I'm either sketching new typography ideas or testing climbing routes around the Bay.");
$hero_avatar = get_theme_mod('pv_hero_avatar'); // Get avatar URL
$social_linkedin = get_theme_mod('pv_linkedin', '#');
$social_github = get_theme_mod('pv_github', '#');
$social_instagram = get_theme_mod('pv_instagram', '#');

// Fetch Experience Data
$experience_query = new WP_Query([
    'post_type' => 'experience',
    'posts_per_page' => -1,
    'meta_key' => '_pv_sort_date',
    'orderby' => 'meta_value_num', 
    'order' => 'DESC',
]);

// Fetch Projects Data
$projects_query = new WP_Query([
    'post_type' => 'project',
    'posts_per_page' => -1,
    'meta_key' => '_pv_sort_date',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
]);

// Fetch Blog Data
$blog_query = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 3,
    'ignore_sticky_posts' => 1,
]);
?>
<main id="primary" class="pv-main">
    <div class="pv-resume-float">
        <a class="pv-resume-button" href="#" aria-label="Download resume">Resume</a>
    </div>

    <section id="home" class="pv-section pv-hero" data-hero-section data-section="home">
        <div class="pv-container pv-hero__grid">
            <div class="pv-hero__card" data-animate data-animate-delay="100">
                <div class="pv-hero__avatar">
                    <?php if ($hero_avatar) : ?>
                        <img src="<?php echo esc_url($hero_avatar); ?>" alt="Profile Picture" style="width:100%; height:100%; object-fit:cover; border-radius:inherit;">
                    <?php else : ?>
                        <svg viewBox="0 0 200 200" role="presentation" fill="currentColor">
                            <path d="M100 0 C130 0 150 20 150 50 C150 80 130 100 100 100 C70 100 50 80 50 50 C50 20 70 0 100 0 Z M20 200 C20 140 60 110 100 110 C140 110 180 140 180 200 Z"/>
                        </svg>
                    <?php endif; ?>
                </div>
                <div class="pv-hero__socials">
                    <a href="<?php echo esc_url($social_linkedin); ?>" aria-label="LinkedIn" class="pv-social-link" target="_blank" rel="noopener noreferrer">
                        <svg viewBox="0 0 24 24" role="presentation"><path d="M6 9h3v12H6z"/><circle cx="7.5" cy="6.5" r="1.5"/><path d="M13 9h3v2.2a4 4 0 0 1 3-1.2c2.5 0 4 1.6 4 4.8V21h-3v-5.2c0-1.7-.6-2.5-1.8-2.5-1.2 0-2 .8-2 2.5V21h-3z"/></svg>
                    </a>
                    <a href="<?php echo esc_url($social_github); ?>" aria-label="GitHub" class="pv-social-link" target="_blank" rel="noopener noreferrer">
                        <svg viewBox="0 0 24 24" role="presentation"><path d="M12 .5a12 12 0 0 0-3.8 23.4c.6.1.8-.2.8-.5v-1.7c-3.3.7-4-1.6-4-1.6-.5-1.1-1.2-1.4-1.2-1.4-1-.7.1-.7.1-.7 1.1.1 1.7 1.1 1.7 1.1 1 .1.9-.7.9-.7-.8-.6-1.2-1.7-1.2-1.7-.7-2 .1-3.1.1-3.1C6.8 11 8 11.4 8 11.4c.9 0 1.9-.3 3-.7-2.7-.5-4-2-4-4.2A4 4 0 0 1 8.4 3s-.3-1 .3-2.4c0 0 1-.3 3.3 1a11.8 11.8 0 0 1 6 0c2.3-1.3 3.3-1 3.3-1 .6 1.4.3 2.4.3 2.4a4 4 0 0 1 1.4 3.1c0 2.2-1.4 3.7-4 4.2 1.2.4 2.1 1.8 2.1 3.6V22c0 .3.2.6.8.5A12 12 0 0 0 12 .5Z"/></svg>
                    </a>
                    <a href="<?php echo esc_url($social_instagram); ?>" aria-label="Instagram" class="pv-social-link" target="_blank" rel="noopener noreferrer">
                        <svg viewBox="0 0 24 24" role="presentation"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/></svg>
                    </a>
                </div>
            </div>
            <div class="pv-hero__content">
                <div class="pv-hero__name">
                    <h1 data-hero-title><?php echo esc_html($hero_title); ?></h1>
                </div>
                <div class="pv-hero__summary" data-animate data-animate-delay="150">
                    <p class="pv-hero__roles"><?php echo esc_html($hero_roles); ?></p>
                    <div class="pv-hero__text">
                         <p><?php echo nl2br(esc_html($hero_text_1)); ?></p>
                         <?php if ($hero_text_2) : ?>
                            <p><?php echo nl2br(esc_html($hero_text_2)); ?></p>
                         <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="experience" class="pv-section" data-section="experience">
        <div class="pv-container">
            <div class="pv-section__title" data-animate>
                <h2>Experience</h2>
            </div>
            <div class="pv-timeline" data-timeline="experience">
                <?php if ($experience_query->have_posts()) : while ($experience_query->have_posts()) : $experience_query->the_post(); 
                    $role_title = get_the_title();
                    $company = get_post_meta(get_the_ID(), '_pv_company', true);
                    $month = get_post_meta(get_the_ID(), '_pv_month', true);
                    $year = get_post_meta(get_the_ID(), '_pv_year', true);
                    $tech_string = get_post_meta(get_the_ID(), '_pv_tech', true);
                    $description_raw = get_post_meta(get_the_ID(), '_pv_description', true);
                    
                    $tech_stack = $tech_string ? array_map('trim', explode(',', $tech_string)) : [];
                    $description_lines = $description_raw ? array_map('trim', explode("\n", $description_raw)) : [];
                    $visible_count = 5;
                    $date_label = sprintf('%s, %s', $month, $year);
                ?>
                    <article class="pv-experience" data-animate data-timeline-item>
                        <div class="pv-timeline__rail">
                            <span class="pv-timeline__glow" aria-hidden="true"></span>
                            <div class="pv-timeline__date" aria-label="<?php echo esc_attr($date_label); ?>">
                                <span class="pv-timeline__month"><?php echo esc_html($month); ?></span>
                                <span class="pv-timeline__year"><?php echo esc_html($year); ?></span>
                            </div>
                            <span class="pv-timeline__connector" aria-hidden="true"></span>
                        </div>
                        <div class="pv-experience__card" data-experience-card tabindex="0">
                            <h3><?php echo esc_html($role_title); ?></h3>
                            <p class="pv-experience__date-mobile">
                                <span class="pv-experience__date-mobile-text"><?php echo esc_html($month . ' ' . $year); ?></span>
                            </p>
                            <p class="pv-experience__company"><?php echo esc_html($company); ?></p>
                            <ul class="pv-experience__list">
                                <?php foreach ($description_lines as $index => $line) : 
                                    if (empty($line)) continue;
                                    $extra_class = $index >= $visible_count ? ' class="is-extra"' : '';
                                ?>
                                    <li<?php echo $extra_class; ?>><?php echo esc_html($line); ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="pv-badges">
                                <?php foreach ($tech_stack as $tech) : ?>
                                    <span class="pv-badge"><?php echo esc_html($tech); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <button class="pv-experience__toggle" type="button" data-experience-toggle>
                                <span class="pv-experience__toggle-text">Read more</span>
                            </button>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); endif; ?>
            </div>
        </div>
    </section>

    <section id="projects" class="pv-section pv-section--light" data-section="projects">
        <div class="pv-container">
            <div class="pv-section__title" data-animate>
                <h2>Featured Projects</h2>
            </div>
            <div class="pv-projects pv-timeline pv-timeline--projects" data-timeline="projects">
                <?php if ($projects_query->have_posts()) : while ($projects_query->have_posts()) : $projects_query->the_post(); 
                    $project_title = get_the_title();
                    $desc = get_post_meta(get_the_ID(), '_pv_project_desc', true);
                    $problem = get_post_meta(get_the_ID(), '_pv_problem', true);
                    $value = get_post_meta(get_the_ID(), '_pv_value', true);
                    $tech_string = get_post_meta(get_the_ID(), '_pv_project_tech', true);
                    $month = get_post_meta(get_the_ID(), '_pv_project_month', true);
                    $year = get_post_meta(get_the_ID(), '_pv_project_year', true);
                    $image_type = get_post_meta(get_the_ID(), '_pv_image_type', true);
                    $align = get_post_meta(get_the_ID(), '_pv_align', true);
                    
                    $tech_stack = $tech_string ? array_map('trim', explode(',', $tech_string)) : [];
                    $date_label = sprintf('%s, %s', $month, $year);
                    $align_class = $align === 'right' ? 'right' : 'left';
                ?>
                    <article class="pv-project pv-project--<?php echo esc_attr($align_class); ?>" data-animate data-timeline-item>
                        <div class="pv-timeline__rail" aria-hidden="true">
                            <span class="pv-timeline__glow"></span>
                            <div class="pv-timeline__date" aria-label="<?php echo esc_attr($date_label); ?>">
                                <span class="pv-timeline__month"><?php echo esc_html($month); ?></span>
                                <span class="pv-timeline__year"><?php echo esc_html($year); ?></span>
                            </div>
                        </div>
                        <div class="pv-project__inner">
                            <div class="pv-project__overview">
                                <h3><?php echo esc_html($project_title); ?></h3>
                                <p class="pv-project__date-mobile">
                                    <span class="pv-project__date-mobile-text"><?php echo esc_html($month . ' ' . $year); ?></span>
                                </p>
                                <p class="pv-project__description"><?php echo esc_html($desc); ?></p>
                            </div>
                            <div class="pv-project__visual" aria-hidden="true">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="pv-project__img-wrapper" style="width:100%; height:100%; border-radius:12px; overflow:hidden; border:1px solid var(--pv-border); box-shadow:0 20px 40px rgba(0,0,0,0.1);">
                                        <?php the_post_thumbnail('full', ['style' => 'width:100%; height:100%; object-fit:cover; display:block;']); ?>
                                    </div>
                                <?php else : ?>
                                <div class="pv-browser">
                                    <div class="pv-browser__bar">
                                        <span></span><span></span><span></span>
                                    </div>
                                    <div class="pv-browser__body">
                                        <?php if ($image_type === 'ai') : ?>
                                            <svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="32" cy="32" r="30"/>
                                                <path d="M20 32h24"/>
                                                <path d="M32 20v24"/>
                                                <path d="M12 24h8"/>
                                                <path d="M12 40h8"/>
                                                <path d="M44 24h8"/>
                                                <path d="M44 40h8"/>
                                            </svg>
                                        <?php else : ?>
                                            <svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="8" y="12" width="48" height="32" rx="4"/>
                                                <path d="M16 48h32"/>
                                                <path d="M24 56h16"/>
                                            </svg>
                                        <?php endif; ?>
                                        <div class="pv-browser__tag"><?php echo esc_html($project_title); ?> v1.0</div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="pv-project__details">
                                <div class="pv-project__insight">
                                    <p><strong>The Problem:</strong> <?php echo esc_html($problem); ?></p>
                                    <div class="pv-divider"></div>
                                    <p><strong>Value:</strong> <?php echo esc_html($value); ?></p>
                                </div>
                                <div class="pv-badges">
                                    <?php foreach ($tech_stack as $tech) : ?>
                                        <span class="pv-badge"><?php echo esc_html($tech); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); endif; ?>
            </div>
        </div>
    </section>

    <section id="blog" class="pv-section" data-section="blog">
        <div class="pv-container">
            <div class="pv-section__title pv-section__title--center" data-animate>
                <span class="pv-section__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M4 4v16"/>
                        <path d="M14 4v16"/>
                        <path d="M22 6H14"/>
                        <path d="M22 10H14"/>
                        <path d="M22 14H14"/>
                    </svg>
                </span>
                <h2>Writing</h2>
                <a href="#" class="pv-link pv-link--soft">
                    View all posts
                    <svg viewBox="0 0 24 24" role="presentation" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7 17 17 7"/>
                        <path d="M7 7h10v10"/>
                    </svg>
                </a>
            </div>
            <div class="pv-blog-grid">
                <?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); 
                    $summary = get_the_excerpt();
                    $source = get_post_meta(get_the_ID(), '_pv_source', true);
                    $external_url = get_post_meta(get_the_ID(), '_pv_external_url', true);
                    $link = $external_url ? $external_url : get_permalink();
                ?>
                    <article class="pv-blog" data-animate data-tilt-card>
                        <div class="pv-blog__date"><?php echo get_the_date('M j, Y'); ?></div>
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo esc_html($summary); ?></p>
                        <div class="pv-blog__cta">
                            <a href="<?php echo esc_url($link); ?>" class="pv-blog__cta-btn primary" <?php echo $external_url ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
                                <span>Read article</span>
                            </a>
                            <?php if ($external_url) : ?>
                                <a href="<?php echo esc_url($link); ?>" class="pv-blog__cta-btn secondary" aria-label="Open external link" target="_blank" rel="noopener noreferrer">
                                    <svg viewBox="0 0 1043.63 592.71" role="presentation" aria-hidden="true">
                                        <path d="M588.67 296.36c0 163.73-131.84 296.35-294.33 296.35C130.85 592.71 0 460.09 0 296.36 0 132.64 130.85 0 294.34 0s294.33 132.64 294.33 296.36ZM760.73 0c-94.39 0-171 132.64-171 296.36 0 163.73 76.59 296.35 171 296.35s171-132.62 171-296.35C931.76 132.64 855.16 0 760.73 0Zm282.9 32.03c-47.48 0-86 118.46-86 264.33s38.52 264.32 86 264.32 86-118.46 86-264.32-38.52-264.33-86-264.33Z"/>
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); endif; ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
