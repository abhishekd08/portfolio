<?php
/**
 * Main template for Focused Portfolio theme.
 */

global $post;
$focused_data = focused_portfolio_get_data();
get_header();
?>
<div class="container hero" id="top">
	<div>
		<h1 class="hero-name"><?php echo esc_html( $focused_data['name'] ); ?></h1>
		<p class="hero-role"><?php echo esc_html( $focused_data['role'] ); ?></p>
		<div class="cta-group">
			<?php foreach ( $focused_data['socials'] as $social ) : ?>
				<a class="btn btn-primary" href="<?php echo esc_url( $social['url'] ); ?>" target="_blank" rel="noreferrer noopener"><?php echo esc_html( $social['label'] ); ?></a>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="hero-portrait">
		<img src="<?php echo esc_url( $focused_data['portrait'] ); ?>" alt="Portrait of <?php echo esc_attr( $focused_data['name'] ); ?>">
	</div>
</div>
<section id="about">
	<div class="container">
		<h2 class="section-heading">About &amp; Skills</h2>
		<p><?php echo esc_html( $focused_data['about'] ); ?></p>
		<div class="skills-grid" aria-label="Skills">
			<?php foreach ( $focused_data['skills'] as $skill_group ) : ?>
				<div class="skill-card">
					<h4><?php echo esc_html( $skill_group['label'] ); ?></h4>
					<ul>
						<?php foreach ( $skill_group['items'] as $item ) : ?>
							<li><?php echo esc_html( $item ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<section id="experience">
	<div class="container">
		<h2 class="section-heading">Work Experience</h2>
		<div class="timeline">
			<?php foreach ( $focused_data['experience'] as $role ) : ?>
				<article class="timeline-item">
					<span class="timeline-bullet" aria-hidden="true"></span>
					<div class="timeline-header">
						<span class="timeline-range"><?php echo esc_html( $role['range'] ); ?></span>
						<h3 class="timeline-role"><?php echo esc_html( $role['role'] ); ?></h3>
						<span class="timeline-company">@ <?php echo esc_html( $role['company'] ); ?></span>
					</div>
					<ul class="timeline-points">
						<?php foreach ( $role['bullets'] as $bullet ) : ?>
							<li><?php echo esc_html( $bullet ); ?></li>
						<?php endforeach; ?>
					</ul>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<section id="projects">
	<div class="container">
		<h2 class="section-heading">Projects</h2>
		<div class="project-list">
			<?php foreach ( $focused_data['projects'] as $project ) : ?>
				<article class="project-card">
					<h3><?php echo esc_html( $project['name'] ); ?></h3>
					<div class="project-meta">
						<span><?php echo esc_html( $project['timeframe'] ); ?></span>
						<span><?php echo esc_html( $project['tech'] ); ?></span>
					</div>
					<div class="project-details">
						<div><strong>Context</strong><p><?php echo esc_html( $project['context'] ); ?></p></div>
						<div><strong>Impact</strong><p><?php echo esc_html( $project['impact'] ); ?></p></div>
						<div><strong>Challenges</strong><p><?php echo esc_html( $project['challenges'] ); ?></p></div>
						<div><strong>Learnings</strong><p><?php echo esc_html( $project['learnings'] ); ?></p></div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<section id="writing">
	<div class="container">
		<h2 class="section-heading">Writing</h2>
		<div class="blog-grid">
			<?php foreach ( $focused_data['writing'] as $post_item ) : ?>
				<article class="blog-card">
					<span class="source"><?php echo esc_html( $post_item['source'] ); ?></span>
					<h3 class="title"><?php echo esc_html( $post_item['title'] ); ?></h3>
					<p><?php echo esc_html( $post_item['excerpt'] ); ?></p>
					<a class="icon-link" href="<?php echo esc_url( $post_item['url'] ); ?>" target="_blank" rel="noreferrer noopener">
						<span>Read</span> <span aria-hidden="true">↗</span>
					</a>
				</article>
			<?php endforeach; ?>
		</div>
		<?php
		$blog_link = '';
		foreach ( $focused_data['socials'] as $social ) {
			if ( 'Blog' === $social['label'] ) {
				$blog_link = $social['url'];
				break;
			}
		}
		?>
		<?php if ( $blog_link ) : ?>
			<div style="margin-top:32px;">
				<a class="btn" href="<?php echo esc_url( $blog_link ); ?>" target="_blank" rel="noreferrer noopener">View all writing</a>
			</div>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
