<?php
/**
 * Single post template
 *
 * @package Bloom
 */

get_header();

$post_layout = get_post_meta( get_the_ID(), '_bloom_post_layout', true ) ?: bloom_get_option( 'bloom_post_layout', 'sidebar' );
?>

<main id="primary" class="site-main">

	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?>>

			<?php if ( has_post_thumbnail() ) : ?>
			<div class="single-post__hero">
				<?php the_post_thumbnail( 'bloom-hero', [ 'class' => 'single-post__hero-image' ] ); ?>
			</div>
			<?php endif; ?>

			<div class="container">
				<div class="single-post__layout single-post__layout--<?php echo esc_attr( $post_layout ); ?>">

					<div class="single-post__content-wrap">

						<header class="single-post__header">
							<div class="single-post__meta">
								<?php bloom_post_categories( get_the_ID(), 'pill' ); ?>
							</div>

							<h1 class="single-post__title"><?php the_title(); ?></h1>

							<div class="single-post__byline">
								<div class="single-post__author">
									<?php echo get_avatar( get_the_author_meta( 'ID' ), 36, '', '', [ 'class' => 'author-avatar' ] ); ?>
									<span><?php the_author_posts_link(); ?></span>
								</div>
								<span class="single-post__date">
									<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
								</span>
								<span class="single-post__reading-time">
									<?php
									printf(
										/* translators: %d: minutes */
										esc_html( _n( '%d min read', '%d min read', bloom_reading_time(), 'bloom' ) ),
										bloom_reading_time()
									);
									?>
								</span>
							</div>
						</header>

						<div class="single-post__body entry-content">
							<?php the_content(); ?>
							<?php
							wp_link_pages( [
								'before'      => '<div class="page-links"><span>' . __( 'Pages:', 'bloom' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							] );
							?>
						</div>

						<?php if ( has_tag() ) : ?>
						<footer class="single-post__tags">
							<span class="tags-label"><?php esc_html_e( 'Tagged:', 'bloom' ); ?></span>
							<?php the_tags( '', ', ', '' ); ?>
						</footer>
						<?php endif; ?>

						<?php get_template_part( 'template-parts/post/shop-the-post' ); ?>

						<div class="single-post__share">
							<?php bloom_share_buttons(); ?>
						</div>

						<div class="single-post__author-bio">
							<?php bloom_author_box(); ?>
						</div>

						<nav class="single-post__nav post-navigation">
							<?php
							the_post_navigation( [
								'prev_text' => '<span class="nav-label">' . __( 'Previous', 'bloom' ) . '</span><span class="nav-title">%title</span>',
								'next_text' => '<span class="nav-label">' . __( 'Next', 'bloom' ) . '</span><span class="nav-title">%title</span>',
							] );
							?>
						</nav>

						<?php get_template_part( 'template-parts/post/related-posts' ); ?>

						<?php if ( comments_open() || get_comments_number() ) : ?>
							<?php comments_template(); ?>
						<?php endif; ?>

					</div><!-- .single-post__content-wrap -->

					<?php if ( 'sidebar' === $post_layout ) : ?>
						<?php get_sidebar(); ?>
					<?php endif; ?>

				</div><!-- .single-post__layout -->
			</div><!-- .container -->

		</article>

	<?php endwhile; ?>

</main>

<?php get_footer(); ?>
