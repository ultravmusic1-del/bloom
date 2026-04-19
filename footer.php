<?php
/**
 * Footer template
 *
 * @package Bloom
 */
?>

	<footer id="colophon" class="site-footer">

		<?php if ( bloom_get_option( 'bloom_footer_instagram', false ) ) : ?>
		<div class="footer-instagram">
			<div class="container">
				<div class="footer-instagram__heading">
					<span class="footer-instagram__icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
					</span>
					<a href="<?php echo esc_url( bloom_get_option( 'bloom_instagram_url', '#' ) ); ?>" target="_blank" rel="noopener noreferrer">
						<?php echo esc_html( bloom_get_option( 'bloom_instagram_handle', '@yourblog' ) ); ?>
					</a>
				</div>
				<div class="footer-instagram__feed">
					<?php bloom_instagram_feed_placeholder(); ?>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
		<div class="footer-widgets">
			<div class="container">
				<div class="footer-widgets__grid">
					<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
						<?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>
						<div class="footer-widgets__col">
							<?php dynamic_sidebar( 'footer-' . $i ); ?>
						</div>
						<?php endif; ?>
					<?php endfor; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<?php if ( bloom_get_option( 'bloom_footer_newsletter', true ) ) : ?>
		<div class="footer-newsletter">
			<div class="container">
				<div class="footer-newsletter__inner">
					<div class="footer-newsletter__text">
						<h3><?php echo esc_html( bloom_get_option( 'bloom_newsletter_title', 'Join the Community' ) ); ?></h3>
						<p><?php echo esc_html( bloom_get_option( 'bloom_newsletter_description', 'Get weekly inspiration delivered straight to your inbox.' ) ); ?></p>
					</div>
					<form class="footer-newsletter__form" action="#" method="post">
						<div class="newsletter-field-group">
							<input type="email" name="email" placeholder="<?php esc_attr_e( 'Your email address…', 'bloom' ); ?>" required>
							<button type="submit" class="btn btn--primary">
								<?php echo esc_html( bloom_get_option( 'bloom_newsletter_button', 'Subscribe' ) ); ?>
							</button>
						</div>
						<small><?php esc_html_e( 'No spam, ever. Unsubscribe anytime.', 'bloom' ); ?></small>
					</form>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<div class="footer-bottom">
			<div class="container">
				<div class="footer-bottom__inner">
					<div class="footer-bottom__brand">
						<?php bloom_site_logo( 'footer' ); ?>
					</div>

					<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Navigation', 'bloom' ); ?>">
						<?php
						wp_nav_menu( [
							'theme_location' => 'footer',
							'menu_class'     => 'footer-nav-menu',
							'container'      => false,
							'depth'          => 1,
							'fallback_cb'    => false,
						] );
						?>
					</nav>

					<div class="footer-bottom__social">
						<?php bloom_social_icons(); ?>
					</div>
				</div>

				<div class="footer-bottom__copy">
					<p>
						&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>.
						<?php
						printf(
							/* translators: %s: WordPress link */
							esc_html__( 'Powered by %s', 'bloom' ),
							'<a href="https://wordpress.org" rel="noopener noreferrer" target="_blank">WordPress</a>'
						);
						?>
						&bull;
						<?php
						printf(
							/* translators: %s: Theme name link */
							esc_html__( 'Theme: %s', 'bloom' ),
							'<a href="https://example.com/bloom" rel="noopener noreferrer" target="_blank">Bloom</a>'
						);
						?>
					</p>
				</div>
			</div>
		</div>

	</footer><!-- #colophon -->

</div><!-- #page -->

<button id="back-to-top" class="back-to-top" aria-label="<?php esc_attr_e( 'Back to top', 'bloom' ); ?>">
	<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="18 15 12 9 6 15"/></svg>
</button>

<?php wp_footer(); ?>
</body>
</html>
