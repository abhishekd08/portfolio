<?php
get_header();

$experience_items = [
    [
        'date' => ['month' => 'March', 'year' => '2025'],
        'company' => 'TechCorp AI',
        'role' => 'Senior Software Engineer',
        'description' => [
            'Leading the development of a generative AI platform serving 1M+ daily users.',
            'Optimized inference latency by 40% through custom kernel implementations.',
            'Mentoring junior engineers and establishing code quality standards.',
            'Architected a distributed feature store that syncs refreshed embeddings across 15 services.',
            'Rebuilt the monitoring stack to surface drift signals within seconds using Kafka streams.',
            'Partnered with product and design to define AI-augmented workflows for enterprise clients.'
        ],
        'tech' => ['Python', 'PyTorch', 'React', 'AWS']
    ],
    [
        'date' => ['month' => 'July', 'year' => '2023'],
        'company' => 'Innovate Solutions',
        'role' => 'Product Engineer',
        'description' => [
            'Built a real-time collaboration tool from scratch using WebSockets.',
            'Reduced cloud infrastructure costs by 25% via serverless architecture.',
            'Collaborated directly with design to implement a pixel-perfect design system.',
            'Launched a component library that decreased handoff churn by 35%.',
            'Migrated legacy services to a container platform with zero downtime deployments.',
            'Created experimentation playbooks to validate product ideas in less than a week.'
        ],
        'tech' => ['Node.js', 'Redis', 'Docker', 'TypeScript']
    ]
];

$projects = [
    [
        'title' => 'Neural Search Engine',
        'description' => 'A semantic search engine built for legal documents that understands context rather than just keyword matching.',
        'problem' => 'Lawyers spend 30% of their time finding relevant case files using outdated keyword search.',
        'value' => 'Reduced research time by 60% with semantic understanding.',
        'stack' => ['Python', 'FastAPI', 'ElasticSearch', 'React'],
        'image' => 'ai',
        'align' => 'left',
        'date' => ['month' => 'May', 'year' => '2024']
    ],
    [
        'title' => 'Global Payments Gateway',
        'description' => 'A unified API for handling payments across 40+ countries with automatic currency conversion and fraud detection.',
        'problem' => 'High transaction failure rates due to poor routing logic in legacy systems.',
        'value' => 'Increased transaction success rate to 99.99%.',
        'stack' => ['Go', 'gRPC', 'PostgreSQL', 'Kafka'],
        'image' => 'web',
        'align' => 'right',
        'date' => ['month' => 'January', 'year' => '2023']
    ]
];

$blog_posts = [
    [
        'date' => 'Oct 12, 2024',
        'title' => 'The Future of Frontend Architecture',
        'summary' => 'Why server components are changing the way we think about state management and data fetching.'
    ],
    [
        'date' => 'Sep 28, 2024',
        'title' => 'Scaling Vector Databases',
        'summary' => 'Lessons learned from managing 100M+ vectors in production environments.'
    ],
    [
        'date' => 'Aug 15, 2024',
        'title' => 'Design Systems for Engineers',
        'summary' => 'Bridging the gap between Figma and Code with automated tokens and robust component APIs.'
    ]
];
?>
<main id="primary" class="pv-main">
    <div class="pv-resume-float">
        <a class="pv-resume-button" href="#" aria-label="Download resume">Resume</a>
    </div>

    <section id="home" class="pv-section pv-hero" data-hero-section data-section="home">
        <div class="pv-container pv-hero__grid">
            <div class="pv-hero__card" data-animate data-animate-delay="100">
                <div class="pv-hero__avatar">
                    <svg viewBox="0 0 200 200" role="presentation" fill="currentColor">
                        <path d="M100 0 C130 0 150 20 150 50 C150 80 130 100 100 100 C70 100 50 80 50 50 C50 20 70 0 100 0 Z M20 200 C20 140 60 110 100 110 C140 110 180 140 180 200 Z"/>
                    </svg>
                </div>
                <div class="pv-hero__socials">
                    <a href="#" aria-label="LinkedIn" class="pv-social-link">
                        <svg viewBox="0 0 24 24" role="presentation"><path d="M6 9h3v12H6z"/><circle cx="7.5" cy="6.5" r="1.5"/><path d="M13 9h3v2.2a4 4 0 0 1 3-1.2c2.5 0 4 1.6 4 4.8V21h-3v-5.2c0-1.7-.6-2.5-1.8-2.5-1.2 0-2 .8-2 2.5V21h-3z"/></svg>
                    </a>
                    <a href="#" aria-label="GitHub" class="pv-social-link">
                        <svg viewBox="0 0 24 24" role="presentation"><path d="M12 .5a12 12 0 0 0-3.8 23.4c.6.1.8-.2.8-.5v-1.7c-3.3.7-4-1.6-4-1.6-.5-1.1-1.2-1.4-1.2-1.4-1-.7.1-.7.1-.7 1.1.1 1.7 1.1 1.7 1.1 1 .1.9-.7.9-.7-.8-.6-1.2-1.7-1.2-1.7-.7-2 .1-3.1.1-3.1C6.8 11 8 11.4 8 11.4c.9 0 1.9-.3 3-.7-2.7-.5-4-2-4-4.2A4 4 0 0 1 8.4 3s-.3-1 .3-2.4c0 0 1-.3 3.3 1a11.8 11.8 0 0 1 6 0c2.3-1.3 3.3-1 3.3-1 .6 1.4.3 2.4.3 2.4a4 4 0 0 1 1.4 3.1c0 2.2-1.4 3.7-4 4.2 1.2.4 2.1 1.8 2.1 3.6V22c0 .3.2.6.8.5A12 12 0 0 0 12 .5Z"/></svg>
                    </a>
                    <a href="#" aria-label="Instagram" class="pv-social-link">
                        <svg viewBox="0 0 24 24" role="presentation"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/></svg>
                    </a>
                </div>
            </div>
            <div class="pv-hero__content">
                <div class="pv-hero__name">
                    <h1 data-hero-title>Hi, I'm Abhishek.</h1>
                </div>
                <div class="pv-hero__summary" data-animate data-animate-delay="150">
                    <p class="pv-hero__roles">Software Developer · Tech enthusiast · Deep thinker · Systems tinkerer</p>
                    <div class="pv-hero__text">
                        <p>
                            I blend systems engineering with thoughtful product sense to ship AI-first capabilities that feel effortless. From semantic search to custom inference runtimes, I obsess over performance, reliability, and the final polish.
                        </p>
                        <p>
                            Currently advising teams on generative tooling, design systems, and developer workflows. Outside work I'm either sketching new typography ideas or testing climbing routes around the Bay.
                        </p>
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
                <?php foreach ($experience_items as $item) : 
                    $visible_count = 5;
                    $date_label = sprintf('%s, %s', $item['date']['month'], $item['date']['year']);
                ?>
                    <article class="pv-experience" data-animate data-timeline-item>
                        <div class="pv-timeline__rail">
                            <span class="pv-timeline__glow" aria-hidden="true"></span>
                            <div class="pv-timeline__date" aria-label="<?php echo esc_attr($date_label); ?>">
                                <span class="pv-timeline__month"><?php echo esc_html($item['date']['month']); ?></span>
                                <span class="pv-timeline__year"><?php echo esc_html($item['date']['year']); ?></span>
                            </div>
                            <span class="pv-timeline__connector" aria-hidden="true"></span>
                        </div>
                        <div class="pv-experience__card" data-experience-card tabindex="0">
                            <h3><?php echo esc_html($item['role']); ?></h3>
                            <p class="pv-experience__date-mobile">
                                <span class="pv-experience__date-mobile-text"><?php echo esc_html($item['date']['month'] . ' ' . $item['date']['year']); ?></span>
                            </p>
                            <p class="pv-experience__company"><?php echo esc_html($item['company']); ?></p>
                            <ul class="pv-experience__list">
                                <?php foreach ($item['description'] as $index => $line) : 
                                    $extra_class = $index >= $visible_count ? ' class="is-extra"' : '';
                                ?>
                                    <li<?php echo $extra_class; ?>><?php echo esc_html($line); ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="pv-badges">
                                <?php foreach ($item['tech'] as $tech) : ?>
                                    <span class="pv-badge"><?php echo esc_html($tech); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <button class="pv-experience__toggle" type="button" data-experience-toggle>
                                <span class="pv-experience__toggle-text">Read more</span>
                            </button>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="projects" class="pv-section pv-section--light" data-section="projects">
        <div class="pv-container">
            <div class="pv-section__title" data-animate>
                <h2>Featured Projects</h2>
            </div>
            <div class="pv-projects pv-timeline pv-timeline--projects" data-timeline="projects">
                <?php foreach ($projects as $project) : 
                    $date_label = sprintf('%s, %s', $project['date']['month'], $project['date']['year']);
                ?>
                    <article class="pv-project pv-project--<?php echo esc_attr($project['align']); ?>" data-animate data-timeline-item>
                        <div class="pv-timeline__rail" aria-hidden="true">
                            <span class="pv-timeline__glow"></span>
                            <div class="pv-timeline__date" aria-label="<?php echo esc_attr($date_label); ?>">
                                <span class="pv-timeline__month"><?php echo esc_html($project['date']['month']); ?></span>
                                <span class="pv-timeline__year"><?php echo esc_html($project['date']['year']); ?></span>
                            </div>
                        </div>
                        <div class="pv-project__inner">
                            <div class="pv-project__overview">
                                <h3><?php echo esc_html($project['title']); ?></h3>
                                <p class="pv-project__date-mobile">
                                    <span class="pv-project__date-mobile-text"><?php echo esc_html($project['date']['month'] . ' ' . $project['date']['year']); ?></span>
                                </p>
                                <p class="pv-project__description"><?php echo esc_html($project['description']); ?></p>
                            </div>
                            <div class="pv-project__visual" aria-hidden="true">
                                <div class="pv-browser">
                                    <div class="pv-browser__bar">
                                        <span></span><span></span><span></span>
                                    </div>
                                    <div class="pv-browser__body">
                                        <?php if ($project['image'] === 'ai') : ?>
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
                                        <div class="pv-browser__tag"><?php echo esc_html($project['title']); ?> v1.0</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pv-project__details">
                                <div class="pv-project__insight">
                                    <p><strong>The Problem:</strong> <?php echo esc_html($project['problem']); ?></p>
                                    <div class="pv-divider"></div>
                                    <p><strong>Value:</strong> <?php echo esc_html($project['value']); ?></p>
                                </div>
                                <div class="pv-badges">
                                    <?php foreach ($project['stack'] as $tech) : ?>
                                        <span class="pv-badge"><?php echo esc_html($tech); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
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
                <?php foreach ($blog_posts as $post) : ?>
                    <article class="pv-blog" data-animate data-tilt-card>
                        <div class="pv-blog__date"><?php echo esc_html($post['date']); ?></div>
                        <h3><?php echo esc_html($post['title']); ?></h3>
                        <p><?php echo esc_html($post['summary']); ?></p>
                        <div class="pv-blog__cta">
                            <button type="button" class="pv-blog__cta-btn primary">
                                <span>Read article</span>
                            </button>
                            <button type="button" class="pv-blog__cta-btn secondary" aria-label="Open on Medium">
                                <svg viewBox="0 0 1043.63 592.71" role="presentation" aria-hidden="true">
                                    <path d="M588.67 296.36c0 163.73-131.84 296.35-294.33 296.35C130.85 592.71 0 460.09 0 296.36 0 132.64 130.85 0 294.34 0s294.33 132.64 294.33 296.36ZM760.73 0c-94.39 0-171 132.64-171 296.36 0 163.73 76.59 296.35 171 296.35s171-132.62 171-296.35C931.76 132.64 855.16 0 760.73 0Zm282.9 32.03c-47.48 0-86 118.46-86 264.33s38.52 264.32 86 264.32 86-118.46 86-264.32-38.52-264.33-86-264.33Z"/>
                                </svg>
                            </button>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
