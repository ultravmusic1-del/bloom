<?php
/**
 * Page template
 *
 * @package Bloom
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container">
		<div class="page-layout">
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-article' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="page-hero">
						<?php the_post_thumbnail( 'bloom-wide', [ 'class' => 'page-hero__image' ] ); ?>
					</div>
					<?php endif; ?>
					<div class="page-content-wrap">
						<header class="page-article__header">
							<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
						</header>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					</div>
				</article>

				<?php if ( comments_open() || get_comments_number() ) : ?>
					<?php comments_template(); ?>
				<?php endif; ?>
			<?php endwhile; ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>
