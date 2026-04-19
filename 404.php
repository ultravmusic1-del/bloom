<?php
/**
 * 404 template
 *
 * @package Bloom
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container">
		<section class="error-404">
			<div class="error-404__inner">
				<div class="error-404__number">404</div>
				<h1 class="error-404__title"><?php esc_html_e( 'Page Not Found', 'bloom' ); ?></h1>
				<p class="error-404__description">
					<?php esc_html_e( 'The page you\'re looking for seems to have wandered off. Let\'s help you find your way back.', 'bloom' ); ?>
				</p>
				<div class="error-404__search">
					<?php get_search_form(); ?>
				</div>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">
					<?php esc_html_e( 'Back to Homepage', 'bloom' ); ?>
				</a>
			</div>
		</section>
	</div>
</main>

<?php get_footer(); ?>
