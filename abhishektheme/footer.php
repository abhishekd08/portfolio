<?php
/**
 * Footer template
 */
?>
</main>
<?php $focused_data = focused_portfolio_get_data(); ?>
<footer class="footer">
	<div class="container footer-content">
		<div>
			<strong><?php echo esc_html( $focused_data['name'] ); ?></strong>
			<p style="margin:8px 0 0; color:var(--color-muted);">
				<a href="mailto:<?php echo antispambot( $focused_data['contact']['email'] ); ?>"><?php echo antispambot( $focused_data['contact']['email'] ); ?></a> ·
				<a href="tel:<?php echo esc_attr( preg_replace( '/[^\d+]/', '', $focused_data['contact']['phone_tel'] ) ); ?>"><?php echo esc_html( $focused_data['contact']['phone'] ); ?></a>
			</p>
		</div>
		<div class="footer-links">
			<a href="<?php echo esc_url( $focused_data['socials'][0]['url'] ); ?>" target="_blank" rel="noreferrer noopener">GitHub</a>
			<a href="<?php echo esc_url( $focused_data['socials'][1]['url'] ); ?>" target="_blank" rel="noreferrer noopener">LinkedIn</a>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
