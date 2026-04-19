<?php
/**
 * Search results template
 *
 * @package Bloom
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container">
		<header class="page-header search-header">
			<h1 class="page-title">
				<?php
				printf(
					/* translators: %s: search query */
					esc_html__( 'Search results for: %s', 'bloom' ),
					'<span class="search-query">' . get_search_query() . '</span>'
				);
				?>
			</h1>
			<?php get_search_form(); ?>
		</header>

		<div class="archive-wrap">
			<div class="archive-main">
				<?php if ( have_posts() ) : ?>
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
	</div>
</main>

<?php get_footer(); ?>
