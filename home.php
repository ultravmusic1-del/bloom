<?php
/**
 * Blog posts index
 *
 * @package Bloom
 */

get_header();

$archive_layout = apply_filters( 'bloom_archive_layout', bloom_get_option( 'bloom_archive_layout', 'grid' ) );
?>

<main id="primary" class="site-main">

	<div class="archive-header">
		<div class="container">
			<div class="archive-header__text">
				<h1 class="archive-title"><?php esc_html_e( 'The Blog', 'bloom' ); ?></h1>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="archive-wrap">
			<div class="archive-main">

				<?php if ( have_posts() ) : ?>

				<div class="archive-toolbar">
					<div class="archive-toolbar__count">
						<?php
						global $wp_query;
						printf( esc_html( _n( '%d post', '%d posts', $wp_query->found_posts, 'bloom' ) ), $wp_query->found_posts );
						?>
					</div>
					<div class="archive-toolbar__layouts">
						<a href="?layout=grid"    data-layout="grid"    class="layout-btn <?php echo 'grid'    === $archive_layout ? 'is-active' : ''; ?>">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
						</a>
						<a href="?layout=list"    data-layout="list"    class="layout-btn <?php echo 'list'    === $archive_layout ? 'is-active' : ''; ?>">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/></svg>
						</a>
						<a href="?layout=masonry" data-layout="masonry" class="layout-btn <?php echo 'masonry' === $archive_layout ? 'is-active' : ''; ?>">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><rect x="3" y="3" width="7" height="10"/><rect x="14" y="3" width="7" height="6"/><rect x="3" y="16" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/></svg>
						</a>
					</div>
				</div>

				<?php $layout_class = 'list' === $archive_layout ? 'posts-list' : ( 'masonry' === $archive_layout ? 'posts-masonry' : 'posts-grid posts-grid--three-col' ); ?>

				<div class="<?php echo esc_attr( $layout_class ); ?>">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/content/content', $archive_layout === 'list' ? 'list' : 'grid' ); ?>
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
