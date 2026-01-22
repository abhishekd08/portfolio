<?php
get_header();

$experience_items = [
    [
        'date' => '2023 - Present',
        'company' => 'TechCorp AI',
        'role' => 'Senior Software Engineer',
        'description' => [
            'Leading the development of a generative AI platform serving 1M+ daily users.',
            'Optimized inference latency by 40% through custom kernel implementations.',
            'Mentoring junior engineers and establishing code quality standards.'
        ],
        'tech' => ['Python', 'PyTorch', 'React', 'AWS']
    ],
    [
        'date' => '2021 - 2023',
        'company' => 'Innovate Solutions',
        'role' => 'Product Engineer',
        'description' => [
            'Built a real-time collaboration tool from scratch using WebSockets.',
            'Reduced cloud infrastructure costs by 25% via serverless architecture.',
            'Collaborated directly with design to implement a pixel-perfect design system.'
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
        'align' => 'left'
    ],
    [
        'title' => 'Global Payments Gateway',
        'description' => 'A unified API for handling payments across 40+ countries with automatic currency conversion and fraud detection.',
        'problem' => 'High transaction failure rates due to poor routing logic in legacy systems.',
        'value' => 'Increased transaction success rate to 99.99%.',
        'stack' => ['Go', 'gRPC', 'PostgreSQL', 'Kafka'],
        'image' => 'web',
        'align' => 'right'
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

    <section id="home" class="pv-section pv-hero" data-hero-section>
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
                    <h1 data-hero-title>Abhishek</h1>
                </div>
                <div class="pv-hero__summary" data-animate data-animate-delay="150">
                    <h2>Software Engineer working on AI, systems, and products.</h2>
                    <div class="pv-hero__text">
                        <p>
                            I build scalable infrastructure and intuitive user interfaces. Currently obsessed with the intersection of generative AI and human-computer interaction to create products that feel like magic.
                        </p>
                        <p>
                            Based in San Francisco, I spend my time optimizing inference kernels and crafting fluid motion systems. When I'm not coding, you can find me exploring typography or hiking.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="experience" class="pv-section" data-section>
        <div class="pv-container">
            <div class="pv-section__title" data-animate>
                <h2>Experience</h2>
                <div class="pv-section__divider"></div>
            </div>
            <div class="pv-timeline">
                <?php foreach ($experience_items as $item) : ?>
                    <article class="pv-experience" data-animate>
                        <div class="pv-experience__date">
                            <span><?php echo esc_html($item['date']); ?></span>
                        </div>
                        <div class="pv-experience__body">
                            <h3><?php echo esc_html($item['role']); ?></h3>
                            <p class="pv-experience__company"><?php echo esc_html($item['company']); ?></p>
                            <ul>
                                <?php foreach ($item['description'] as $line) : ?>
                                    <li><?php echo esc_html($line); ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="pv-badges">
                                <?php foreach ($item['tech'] as $tech) : ?>
                                    <span class="pv-badge"><?php echo esc_html($tech); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="projects" class="pv-section pv-section--light" data-section>
        <div class="pv-container">
            <div class="pv-section__heading" data-animate>
                <span class="pv-section__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 3h14v6H5z"/>
                        <path d="M3 9h18v12H3z"/>
                        <path d="M9 13h6v4H9z"/>
                    </svg>
                </span>
                <h2>Featured Projects</h2>
            </div>
            <div class="pv-projects">
                <?php foreach ($projects as $project) : ?>
                    <article class="pv-project pv-project--<?php echo esc_attr($project['align']); ?>" data-animate>
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
                        <div class="pv-project__content">
                            <h3><?php echo esc_html($project['title']); ?></h3>
                            <p class="pv-project__description"><?php echo esc_html($project['description']); ?></p>
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
                            <a href="#" class="pv-link">
                                View Case Study
                                <svg viewBox="0 0 24 24" role="presentation" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M7 17 17 7"/>
                                    <path d="M7 7h10v10"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="blog" class="pv-section" data-section>
        <div class="pv-container">
            <div class="pv-section__heading pv-section__heading--spread" data-animate>
                <div class="pv-heading__group">
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
                </div>
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
                    <article class="pv-blog" data-animate>
                        <div class="pv-blog__date"><?php echo esc_html($post['date']); ?></div>
                        <h3><?php echo esc_html($post['title']); ?></h3>
                        <p><?php echo esc_html($post['summary']); ?></p>
                        <div class="pv-blog__cta">
                            <button type="button">Read on Medium</button>
                            <button type="button" class="ghost">Read Locally</button>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
