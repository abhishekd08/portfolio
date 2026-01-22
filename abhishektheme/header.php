<?php
/**
 * Header template
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php $focused_data = focused_portfolio_get_data(); ?>
<header class="sticky-bar">
	<div class="container sticky-inner">
		<p class="sticky-name"><?php echo esc_html( $focused_data['name'] ); ?></p>
		<div class="sticky-links">
			<?php foreach ( $focused_data['socials'] as $social ) : ?>
				<a href="<?php echo esc_url( $social['url'] ); ?>" class="btn" target="_blank" rel="noreferrer noopener"><?php echo esc_html( $social['label'] ); ?></a>
			<?php endforeach; ?>
		</div>
	</div>
</header>
<div class="floating-actions" aria-label="Contact actions">
	<a class="btn-primary" href="<?php echo esc_url( $focused_data['contact']['resume'] ); ?>" target="_blank" rel="noopener">Download Résumé</a>
	<a class="btn-primary" href="mailto:<?php echo antispambot( $focused_data['contact']['email'] ); ?>">Email</a>
	<button type="button" class="btn-primary" data-phone-copy="<?php echo esc_attr( $focused_data['contact']['phone'] ); ?>" data-phone-tel="tel:<?php echo esc_attr( preg_replace( '/[^\d+]/', '', $focused_data['contact']['phone_tel'] ) ); ?>">
		<span class="phone-text"><?php echo esc_html( $focused_data['contact']['phone'] ); ?></span>
	</button>
</div>
<main id="primary" class="site-main">
