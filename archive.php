<?php
/**
 * Archive template
 *
 * @package Bloom
 */

get_header();

$archive_layout = bloom_get_option( 'bloom_archive_layout', 'grid' );
?>

<main id="primary" class="site-main">

	<?php if ( have_posts() ) : ?>

		<div class="archive-header">
			<div class="container">
				<div class="archive-header__inner">
					<?php if ( is_category() ) : ?>
						<?php
						$cat_id    = get_queried_object_id();
						$cat_image = get_term_meta( $cat_id, 'bloom_category_image', true );
						if ( $cat_image ) :
						?>
						<div class="archive-header__image">
							<?php echo wp_get_attachment_image( $cat_image, 'bloom-wide', false, [ 'class' => 'archive-header__bg' ] ); ?>
						</div>
						<?php endif; ?>
					<?php endif; ?>

					<div class="archive-header__text">
						<?php the_archive_title( '<h1 class="archive-title">', '</h1>' ); ?>
						<?php the_archive_description( '<p class="archive-description">', '</p>' ); ?>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="archive-wrap">

				<div class="archive-main">

					<div class="archive-toolbar">
						<div class="archive-toolbar__count">
							<?php
							global $wp_query;
							printf(
								/* translators: %d: post count */
								esc_html( _n( '%d post', '%d posts', $wp_query->found_posts, 'bloom' ) ),
								esc_html( $wp_query->found_posts )
							);
							?>
						</div>
						<div class="archive-toolbar__layouts">
							<a href="?layout=grid"  class="layout-btn <?php echo 'grid'    === $archive_layout ? 'is-active' : ''; ?>" title="<?php esc_attr_e( 'Grid view', 'bloom' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
							</a>
							<a href="?layout=list"  class="layout-btn <?php echo 'list'    === $archive_layout ? 'is-active' : ''; ?>" title="<?php esc_attr_e( 'List view', 'bloom' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
							</a>
							<a href="?layout=masonry" class="layout-btn <?php echo 'masonry' === $archive_layout ? 'is-active' : ''; ?>" title="<?php esc_attr_e( 'Masonry view', 'bloom' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><rect x="3" y="3" width="7" height="10"/><rect x="14" y="3" width="7" height="6"/><rect x="3" y="16" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/></svg>
							</a>
						</div>
					</div>

					<?php
					$layout_class = 'grid' === $archive_layout ? 'posts-grid posts-grid--three-col' :
					                ( 'list' === $archive_layout ? 'posts-list' : 'posts-masonry' );
					?>
					<div class="<?php echo esc_attr( $layout_class ); ?>" data-layout="<?php echo esc_attr( $archive_layout ); ?>">
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'template-parts/content/content', $archive_layout ); ?>
						<?php endwhile; ?>
					</div>

					<?php bloom_pagination(); ?>

				</div>

				<?php get_sidebar(); ?>

			</div>
		</div>

	<?php else : ?>
		<div class="container">
			<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
		</div>
	<?php endif; ?>

</main>

<?php get_footer(); ?>
