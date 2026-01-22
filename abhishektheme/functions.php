<?php
/**
 * Focused Portfolio Theme functions.
 */

define( 'FOCUSED_PORTFOLIO_VERSION', '1.0.0' );

function focused_portfolio_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'focused_portfolio_setup' );

function focused_portfolio_assets() {
	$theme_uri = get_template_directory_uri();

	wp_enqueue_style( 'focused-portfolio-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap', array(), null );
	wp_enqueue_style( 'focused-portfolio-base', get_stylesheet_uri(), array( 'focused-portfolio-fonts' ), FOCUSED_PORTFOLIO_VERSION );
	wp_enqueue_style( 'focused-portfolio-main', $theme_uri . '/assets/css/main.css', array( 'focused-portfolio-base' ), FOCUSED_PORTFOLIO_VERSION );
	wp_enqueue_script( 'focused-portfolio-main', $theme_uri . '/assets/js/main.js', array(), FOCUSED_PORTFOLIO_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'focused_portfolio_assets' );

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Shim for WordPress versions prior to 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

if ( ! function_exists( 'focused_portfolio_get_data' ) ) {
	function focused_portfolio_get_data() {
		$data = array(
		'name'      => 'Adrian Keller',
		'role'      => 'Senior WordPress & Frontend Engineer',
		'portrait'  => 'https://via.placeholder.com/640x780.png?text=Portrait',
		'about'     => 'I design and ship pragmatic WordPress experiences with a focus on recruiter-friendly UX. Over the past decade I have helped startups, agencies, and enterprise teams build performant, content-forward products. I lead with clarity, keep stacks lean, and deliver polished, documented hand-offs.',
		'socials'   => array(
			array(
				'label' => 'GitHub',
				'url'   => 'https://github.com/username',
			),
			array(
				'label' => 'LinkedIn',
				'url'   => 'https://linkedin.com/in/username',
			),
			array(
				'label' => 'Blog',
				'url'   => 'https://example.com/blog',
			),
		),
		'contact'   => array(
			'email'  => 'hello@example.com',
			'phone'  => '+1 (555) 123-4567',
			'phone_tel' => '+15551234567',
			'resume' => 'https://example.com/resume.pdf',
		),
		'skills'    => array(
			array(
				'label' => 'Languages',
				'items' => array( 'PHP', 'TypeScript', 'HTML/CSS', 'SQL', 'GraphQL' ),
			),
			array(
				'label' => 'Frameworks',
				'items' => array( 'WordPress', 'Next.js', 'React', 'Laravel', 'Tailwind' ),
			),
			array(
				'label' => 'Tools',
				'items' => array( 'Figma', 'Storybook', 'GitHub Actions', 'Docker', 'Jira' ),
			),
		),
		'experience' => array(
			array(
				'range'   => 'Jan 2022 – Present',
				'role'    => 'Lead Frontend Engineer',
				'company' => 'Northwind Labs',
				'bullets' => array(
					'Owned redesign of recruiting portal focused on clarity and conversion, improving referral-to-apply rate by 38%.',
					'Created modular WordPress blocks with zero third-party dependencies, trimming load time by 32%.',
					'Partnered with talent ops on data-informed UX experiments using minimal JS test harnesses.',
				),
			),
			array(
				'range'   => 'May 2018 – Dec 2021',
				'role'    => 'Senior Product Engineer',
				'company' => 'Atlas Creative',
				'bullets' => array(
					'Led theme system powering 40+ client sites with shared accessibility baseline.',
					'Introduced recruiter-first storytelling framework for portfolio projects used by agency partners.',
					'Reduced design-to-dev handoff cycle by 50% with living documentation in Storybook.',
				),
			),
			array(
				'range'   => 'Jul 2014 – Apr 2018',
				'role'    => 'WordPress Engineer',
				'company' => 'Faro Studio',
				'bullets' => array(
					'Re-architected high traffic editorial theme resulting in 99.98% uptime.',
					'Embedded with strategy team to surface hiring manager narratives on landing pages.',
					'Shipped rapid prototyping kit for content strategists reducing review cycles.',
				),
			),
		),
		'projects' => array(
			array(
				'name'       => 'Candidate Hub',
				'timeframe'  => '2023',
				'context'    => 'WordPress-powered internal recruiting portal for global SaaS org.',
				'impact'     => 'Streamlined pipeline visibility and created self-serve recruiter dashboards.',
				'challenges' => 'Had to align distributed teams on lean tooling without plugins.',
				'learnings'  => 'Document-first UX reviews keep stakeholders aligned across timezones.',
				'tech'       => 'WordPress, Timber, Alpine.js, REST API',
			),
			array(
				'name'       => 'Referral Narrative Kit',
				'timeframe'  => '2022',
				'context'    => 'Single page storytelling theme enabling recruiters to share curated wins.',
				'impact'     => 'Boosted referral conversions by highlighting impact metrics up front.',
				'challenges' => 'Needed to keep layout editable without page builders.',
				'learnings'  => 'Structured content arrays ensure ACF adoption later without rewrites.',
				'tech'       => 'WordPress, Advanced Custom Fields (optional), SCSS, Vite',
			),
			array(
				'name'       => 'Briefcase UI Library',
				'timeframe'  => '2021',
				'context'    => 'Portable UI kit for portfolio-ready case studies.',
				'impact'     => 'Enabled design partners to publish stories 4x faster.',
				'challenges' => 'Needed to support legacy PHP hosting environments.',
				'learnings'  => 'Isolation and progressive enhancement keep maintenance light.',
				'tech'       => 'WordPress, Vanilla JS, Storybook',
			),
		),
		'writing' => array(
			array(
				'title'   => 'Structuring Recruiter-Friendly Portfolios',
				'excerpt' => 'A simple checklist for surfacing impact, context, and hand-off readiness.',
				'source'  => 'WordPress',
				'url'     => 'https://example.com/post-1',
			),
			array(
				'title'   => 'Keeping WordPress Themes Lean in 2024',
				'excerpt' => 'Strategies for minimizing dependencies while improving maintainability.',
				'source'  => 'Medium',
				'url'     => 'https://medium.com/example-post',
			),
			array(
				'title'   => 'Designing Fixed Contact Rails for Mobile',
				'excerpt' => 'Lessons learned from dozens of recruiter workflow audits.',
				'source'  => 'WordPress',
				'url'     => 'https://example.com/post-3',
			),
		),
	);

		return apply_filters( 'focused_portfolio_data', $data );
	}
}
