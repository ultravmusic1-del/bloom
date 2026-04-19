<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'bloom' ); ?></a>

	<?php
	$header_style  = bloom_get_option( 'bloom_header_style', 'default' );
	$is_transparent = bloom_get_option( 'bloom_header_transparent', false ) && is_front_page();
	$topbar_text    = bloom_get_option( 'bloom_topbar_text', '' );
	?>

	<?php if ( $topbar_text ) : ?>
	<div class="bloom-topbar">
		<div class="container">
			<span><?php echo wp_kses_post( $topbar_text ); ?></span>
		</div>
	</div>
	<?php endif; ?>

	<header id="masthead" class="site-header site-header--<?php echo esc_attr( $header_style ); ?><?php echo $is_transparent ? ' is-transparent' : ''; ?>">
		<div class="container">

			<?php if ( 'centered' === $header_style ) : ?>
				<!-- Centered header: nav / logo / social -->
				<nav class="main-navigation main-navigation--top" aria-label="<?php esc_attr_e( 'Top Navigation', 'bloom' ); ?>">
					<?php
					wp_nav_menu( [
						'theme_location' => 'primary',
						'menu_class'     => 'nav-menu nav-menu--left',
						'container'      => false,
						'depth'          => 3,
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					] );
					?>
				</nav>

				<div class="site-branding site-branding--center">
					<?php bloom_site_logo(); ?>
				</div>

				<div class="header-actions header-actions--right">
					<?php bloom_header_social_icons(); ?>
					<?php bloom_header_search_toggle(); ?>
				</div>

			<?php else : ?>
				<!-- Default header: logo left / nav right -->
				<div class="site-branding">
					<?php bloom_site_logo(); ?>
				</div>

				<div class="header-right">
					<nav class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'bloom' ); ?>">
						<?php
						wp_nav_menu( [
							'theme_location' => 'primary',
							'menu_class'     => 'nav-menu',
							'container'      => false,
							'depth'          => 3,
							'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						] );
						?>
					</nav>

					<div class="header-actions">
						<?php bloom_header_search_toggle(); ?>
						<?php if ( bloom_is_woocommerce_active() ) : ?>
							<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="header-cart" aria-label="<?php esc_attr_e( 'Cart', 'bloom' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
								<?php if ( function_exists( 'WC' ) ) : ?>
									<span class="cart-count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
								<?php endif; ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>

			<!-- Mobile menu toggle -->
			<button class="menu-toggle" aria-controls="mobile-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle mobile menu', 'bloom' ); ?>">
				<span class="hamburger"><span></span><span></span><span></span></span>
			</button>

		</div><!-- .container -->

		<!-- Search overlay -->
		<div class="search-overlay" role="dialog" aria-label="<?php esc_attr_e( 'Search', 'bloom' ); ?>" aria-hidden="true">
			<div class="search-overlay__inner">
				<button class="search-overlay__close" aria-label="<?php esc_attr_e( 'Close search', 'bloom' ); ?>">&times;</button>
				<?php get_search_form(); ?>
			</div>
		</div>
	</header><!-- #masthead -->

	<!-- Off-canvas mobile menu -->
	<div id="mobile-menu" class="mobile-menu" aria-hidden="true">
		<div class="mobile-menu__backdrop"></div>
		<div class="mobile-menu__panel">
			<div class="mobile-menu__header">
				<?php bloom_site_logo(); ?>
				<button class="mobile-menu__close" aria-label="<?php esc_attr_e( 'Close menu', 'bloom' ); ?>">&times;</button>
			</div>
			<div class="mobile-menu__body">
				<?php
				wp_nav_menu( [
					'theme_location' => 'primary',
					'menu_class'     => 'mobile-nav-menu',
					'container'      => false,
					'depth'          => 3,
				] );
				?>
				<div class="mobile-menu__social">
					<?php bloom_social_icons(); ?>
				</div>
			</div>
		</div>
	</div>
