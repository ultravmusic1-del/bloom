<?php
/**
 * Main template file — fallback for all queries
 *
 * @package Bloom
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container">
		<div class="content-area <?php echo has_nav_menu( 'primary' ) ? 'has-sidebar' : 'full-width'; ?>">

			<?php if ( have_posts() ) : ?>

				<?php if ( is_home() && ! is_front_page() ) : ?>
					<header class="page-header">
						<h1 class="page-title"><?php single_post_title(); ?></h1>
					</header>
				<?php endif; ?>

				<div class="posts-grid posts-grid--three-col">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/content/content', 'grid' ); ?>
					<?php endwhile; ?>
				</div>

				<?php bloom_pagination(); ?>

			<?php else : ?>
				<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
			<?php endif; ?>

		</div>

		<?php get_sidebar(); ?>
	</div>
</main>

<?php get_footer(); ?>
