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
$social_medium = get_theme_mod('pv_medium', '#');

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
        <a class="pv-resume-button" href="<?php echo get_template_directory_uri(); ?>/assets/resume.pdf" download aria-label="Download resume">Resume</a>
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
                    <a href="<?php echo esc_url($social_linkedin); ?>" aria-label="LinkedIn" class="pv-social-link pv-social-link--linkedin" target="_blank" rel="noopener noreferrer">
                        <svg viewBox="0 0 32 32" role="presentation" fill="currentColor"><path d="M26.111,3H5.889c-1.595,0-2.889,1.293-2.889,2.889V26.111c0,1.595,1.293,2.889,2.889,2.889H26.111c1.595,0,2.889-1.293,2.889-2.889V5.889c0-1.595-1.293-2.889-2.889-2.889ZM10.861,25.389h-3.877V12.87h3.877v12.519Zm-1.957-14.158c-1.267,0-2.293-1.034-2.293-2.31s1.026-2.31,2.293-2.31,2.292,1.034,2.292,2.31-1.026,2.31-2.292,2.31Zm16.485,14.158h-3.858v-6.571c0-1.802-.685-2.809-2.111-2.809-1.551,0-2.362,1.048-2.362,2.809v6.571h-3.718V12.87h3.718v1.686s1.118-2.069,3.775-2.069,4.556,1.621,4.556,4.975v7.926Z" fill-rule="evenodd"></path></svg>
                    </a>
                    <a href="<?php echo esc_url($social_github); ?>" aria-label="GitHub" class="pv-social-link pv-social-link--github" target="_blank" rel="noopener noreferrer">
                        <svg viewBox="0 0 32 32" role="presentation" fill="currentColor"><path d="M16,2.345c7.735,0,14,6.265,14,14-.002,6.015-3.839,11.359-9.537,13.282-.7,.14-.963-.298-.963-.665,0-.473,.018-1.978,.018-3.85,0-1.312-.437-2.152-.945-2.59,3.115-.35,6.388-1.54,6.388-6.912,0-1.54-.543-2.783-1.435-3.762,.14-.35,.63-1.785-.14-3.71,0,0-1.173-.385-3.85,1.435-1.12-.315-2.31-.472-3.5-.472s-2.38,.157-3.5,.472c-2.677-1.802-3.85-1.435-3.85-1.435-.77,1.925-.28,3.36-.14,3.71-.892,.98-1.435,2.24-1.435,3.762,0,5.355,3.255,6.563,6.37,6.913-.403,.35-.77,.963-.893,1.872-.805,.368-2.818,.963-4.077-1.155-.263-.42-1.05-1.452-2.152-1.435-1.173,.018-.472,.665,.017,.927,.595,.332,1.277,1.575,1.435,1.978,.28,.787,1.19,2.293,4.707,1.645,0,1.173,.018,2.275,.018,2.607,0,.368-.263,.787-.963,.665-5.719-1.904-9.576-7.255-9.573-13.283,0-7.735,6.265-14,14-14Z"></path></svg>
                    </a>
                    <a href="<?php echo esc_url($social_instagram); ?>" aria-label="Instagram" class="pv-social-link pv-social-link--instagram" target="_blank" rel="noopener noreferrer">
                        <svg viewBox="0 0 32 32" role="presentation" fill="currentColor"><path d="M10.202,2.098c-1.49,.07-2.507,.308-3.396,.657-.92,.359-1.7,.84-2.477,1.619-.776,.779-1.254,1.56-1.61,2.481-.345,.891-.578,1.909-.644,3.4-.066,1.49-.08,1.97-.073,5.771s.024,4.278,.096,5.772c.071,1.489,.308,2.506,.657,3.396,.359,.92,.84,1.7,1.619,2.477,.779,.776,1.559,1.253,2.483,1.61,.89,.344,1.909,.579,3.399,.644,1.49,.065,1.97,.08,5.771,.073,3.801-.007,4.279-.024,5.773-.095s2.505-.309,3.395-.657c.92-.36,1.701-.84,2.477-1.62s1.254-1.561,1.609-2.483c.345-.89,.579-1.909,.644-3.398,.065-1.494,.081-1.971,.073-5.773s-.024-4.278-.095-5.771-.308-2.507-.657-3.397c-.36-.92-.84-1.7-1.619-2.477s-1.561-1.254-2.483-1.609c-.891-.345-1.909-.58-3.399-.644s-1.97-.081-5.772-.074-4.278,.024-5.771,.096m.164,25.309c-1.365-.059-2.106-.286-2.6-.476-.654-.252-1.12-.557-1.612-1.044s-.795-.955-1.05-1.608c-.192-.494-.423-1.234-.487-2.599-.069-1.475-.084-1.918-.092-5.656s.006-4.18,.071-5.656c.058-1.364,.286-2.106,.476-2.6,.252-.655,.556-1.12,1.044-1.612s.955-.795,1.608-1.05c.493-.193,1.234-.422,2.598-.487,1.476-.07,1.919-.084,5.656-.092,3.737-.008,4.181,.006,5.658,.071,1.364,.059,2.106,.285,2.599,.476,.654,.252,1.12,.555,1.612,1.044s.795,.954,1.051,1.609c.193,.492,.422,1.232,.486,2.597,.07,1.476,.086,1.919,.093,5.656,.007,3.737-.006,4.181-.071,5.656-.06,1.365-.286,2.106-.476,2.601-.252,.654-.556,1.12-1.045,1.612s-.955,.795-1.608,1.05c-.493,.192-1.234,.422-2.597,.487-1.476,.069-1.919,.084-5.657,.092s-4.18-.007-5.656-.071M21.779,8.517c.002,.928,.755,1.679,1.683,1.677s1.679-.755,1.677-1.683c-.002-.928-.755-1.679-1.683-1.677,0,0,0,0,0,0-.928,.002-1.678,.755-1.677,1.683m-12.967,7.496c.008,3.97,3.232,7.182,7.202,7.174s7.183-3.232,7.176-7.202c-.008-3.97-3.233-7.183-7.203-7.175s-7.182,3.233-7.174,7.203m2.522-.005c-.005-2.577,2.08-4.671,4.658-4.676,2.577-.005,4.671,2.08,4.676,4.658,.005,2.577-2.08,4.671-4.658,4.676-2.577,.005-4.671-2.079-4.676-4.656h0"></path></svg>
                    </a>
                    <a href="<?php echo esc_url($social_medium); ?>" aria-label="Medium" class="pv-social-link pv-social-link--medium" target="_blank" rel="noopener noreferrer">
                         <svg viewBox="0 0 32 32" role="presentation" fill="currentColor"><path d="M18.05,16c0,5.018-4.041,9.087-9.025,9.087S0,21.018,0,16,4.041,6.913,9.025,6.913s9.025,4.069,9.025,9.087m9.901,0c0,4.724-2.02,8.555-4.513,8.555s-4.513-3.831-4.513-8.555,2.02-8.555,4.512-8.555,4.513,3.83,4.513,8.555m4.05,0c0,4.231-.71,7.664-1.587,7.664s-1.587-3.431-1.587-7.664,.71-7.664,1.587-7.664,1.587,3.431,1.587,7.664"></path></svg>
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
                         <p><?php echo wp_kses_post(wpautop($hero_text_1)); ?></p>
                         <?php if ($hero_text_2) : ?>
                            <p><?php echo wp_kses_post(wpautop($hero_text_2)); ?></p>
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
                    $from_month = get_post_meta(get_the_ID(), '_pv_from_month', true);
                    $from_year = get_post_meta(get_the_ID(), '_pv_from_year', true);
                    $to_month = get_post_meta(get_the_ID(), '_pv_to_month', true);
                    $to_year = get_post_meta(get_the_ID(), '_pv_to_year', true);
                    // Backward compatibility
                    if (empty($from_month) && empty($from_year)) {
                        $from_month = get_post_meta(get_the_ID(), '_pv_month', true);
                        $from_year = get_post_meta(get_the_ID(), '_pv_year', true);
                    }
                    $tech_string = get_post_meta(get_the_ID(), '_pv_tech', true);
                    $description_raw = get_post_meta(get_the_ID(), '_pv_description', true);
                    
                    $tech_stack = $tech_string ? array_map('trim', explode(',', $tech_string)) : [];
                    $description_lines = $description_raw ? array_map('trim', explode("\n", $description_raw)) : [];
                    $visible_count = 5;
                    $to_display = (empty($to_month) || empty($to_year)) ? 'Present' : trim($to_month . ' ' . $to_year);
                    $from_display = trim($from_month . ' ' . $from_year);
                    $date_label = $from_display . ' - ' . $to_display;
                    $date_display = $from_display . ' - ' . $to_display;
                ?>
                    <article class="pv-experience" data-animate data-timeline-item>
                        <div class="pv-timeline__rail">
                            <span class="pv-timeline__glow" aria-hidden="true"></span>
                            <div class="pv-timeline__date" aria-label="<?php echo esc_attr($date_label); ?>">
                                <span class="pv-timeline__to"><?php echo esc_html($to_display); ?></span>
                                <span class="pv-timeline__separator" aria-hidden="true">⋮</span>
                                <span class="pv-timeline__from"><?php echo esc_html($from_display); ?></span>
                            </div>
                            <span class="pv-timeline__connector" aria-hidden="true"></span>
                        </div>
                        <div class="pv-experience__card" data-experience-card tabindex="0">
                            <h3><?php echo esc_html($role_title); ?></h3>
                            <p class="pv-experience__date-range">
                                <span class="pv-experience__date-range-text"><?php echo esc_html($date_display); ?></span>
                            </p>
                            <p class="pv-experience__company"><?php echo esc_html($company); ?></p>
                            <ul class="pv-experience__list">
                                <?php foreach ($description_lines as $index => $line) : 
                                    if (empty($line)) continue;
                                    $extra_class = $index >= $visible_count ? ' class="is-extra"' : '';
                                ?>
                                    <li<?php echo $extra_class; ?>><?php echo wp_kses_post($line); ?></li>
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
                    $tech_string = get_post_meta(get_the_ID(), '_pv_project_tech', true);
                    $month = get_post_meta(get_the_ID(), '_pv_project_month', true);
                    $year = get_post_meta(get_the_ID(), '_pv_project_year', true);
                    $image_type = get_post_meta(get_the_ID(), '_pv_image_type', true);
                    $align = get_post_meta(get_the_ID(), '_pv_align', true);
                    
                    // Get repeater fields or fallback to old problem/value
                    $project_fields = get_post_meta(get_the_ID(), '_pv_project_fields', true);
                    if (empty($project_fields)) {
                        // Backward compatibility
                        $problem = get_post_meta(get_the_ID(), '_pv_problem', true);
                        $value = get_post_meta(get_the_ID(), '_pv_value', true);
                        $project_fields = [];
                        if (!empty($problem)) {
                            $project_fields[] = ['label' => 'The Problem', 'content' => $problem];
                        }
                        if (!empty($value)) {
                            $project_fields[] = ['label' => 'Value', 'content' => $value];
                        }
                    }
                    
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
                                <p class="pv-project__description"><?php echo wp_kses_post(wpautop($desc)); ?></p>
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
                                <?php if (!empty($project_fields)) : ?>
                                    <div class="pv-project__insight">
                                        <?php foreach ($project_fields as $index => $field) : 
                                            if (empty($field['label']) && empty($field['content'])) continue;
                                        ?>
                                            <?php if (!empty($field['label'])) : ?>
                                                <p><strong><?php echo esc_html($field['label']); ?>:</strong> <?php echo wp_kses_post($field['content']); ?></p>
                                            <?php else : ?>
                                                <p><?php echo wp_kses_post($field['content']); ?></p>
                                            <?php endif; ?>
                                            <?php if ($index < count($project_fields) - 1) : ?>
                                                <div class="pv-divider"></div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
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
