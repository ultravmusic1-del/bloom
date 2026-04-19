<?php
/**
 * Single portfolio item template
 *
 * @package Bloom
 */

get_header();
?>

<main id="primary" class="site-main portfolio-single">

	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-article' ); ?>>

			<?php if ( has_post_thumbnail() ) : ?>
			<div class="portfolio-single__hero">
				<?php the_post_thumbnail( 'bloom-hero', [ 'class' => 'portfolio-single__hero-img' ] ); ?>
			</div>
			<?php endif; ?>

			<div class="container">
				<div class="portfolio-single__layout">

					<div class="portfolio-single__content">
						<header class="portfolio-single__header">
							<div class="portfolio-single__cats">
								<?php the_terms( get_the_ID(), 'portfolio_category', '', ' / ' ); ?>
							</div>
							<h1 class="portfolio-single__title"><?php the_title(); ?></h1>
						</header>

						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					</div>

					<aside class="portfolio-single__meta">
						<div class="portfolio-meta-card">

							<?php
							$project_url  = get_post_meta( get_the_ID(), '_bloom_project_url',  true );
							$project_date = get_post_meta( get_the_ID(), '_bloom_project_date',  true );
							$project_tags = get_post_meta( get_the_ID(), '_bloom_project_tags',  true );
							?>

							<?php if ( $project_date ) : ?>
							<div class="portfolio-meta-row">
								<span class="portfolio-meta-label"><?php esc_html_e( 'Date', 'bloom' ); ?></span>
								<span class="portfolio-meta-value"><?php echo esc_html( $project_date ); ?></span>
							</div>
							<?php endif; ?>

							<?php if ( $project_tags ) : ?>
							<div class="portfolio-meta-row">
								<span class="portfolio-meta-label"><?php esc_html_e( 'Tags', 'bloom' ); ?></span>
								<span class="portfolio-meta-value"><?php echo esc_html( $project_tags ); ?></span>
							</div>
							<?php endif; ?>

							<?php if ( $project_url ) : ?>
							<a href="<?php echo esc_url( $project_url ); ?>" class="btn btn--primary" target="_blank" rel="noopener noreferrer" style="margin-top:var(--space-6);width:100%;justify-content:center;">
								<?php esc_html_e( 'View Project', 'bloom' ); ?>
								<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
							</a>
							<?php endif; ?>

							<a href="<?php echo esc_url( bloom_portfolio_page_link() ); ?>" class="btn btn--ghost" style="margin-top:var(--space-4);width:100%;justify-content:center;">
								&larr; <?php esc_html_e( 'Back to Portfolio', 'bloom' ); ?>
							</a>
						</div>
					</aside>

				</div>

				<!-- Adjacent portfolio items -->
				<nav class="single-post__nav post-navigation" aria-label="<?php esc_attr_e( 'Portfolio navigation', 'bloom' ); ?>">
					<?php
					the_post_navigation( [
						'post_type'  => 'bloom_portfolio',
						'prev_text'  => '<span class="nav-label">' . __( 'Previous Project', 'bloom' ) . '</span><span class="nav-title">%title</span>',
						'next_text'  => '<span class="nav-label">' . __( 'Next Project', 'bloom' )     . '</span><span class="nav-title">%title</span>',
					] );
					?>
				</nav>

			</div>

		</article>

	<?php endwhile; ?>

</main>

<style>
.portfolio-single__hero { width:100%; max-height:70vh; overflow:hidden; }
.portfolio-single__hero-img { width:100%; height:100%; object-fit:cover; }
.portfolio-single__layout {
	display: grid;
	grid-template-columns: 1fr 300px;
	gap: var(--space-12);
	align-items: start;
	padding-block: var(--space-12);
}
.portfolio-single__cats { font-size:var(--text-xs); font-weight:600; letter-spacing:var(--tracking-wider); text-transform:uppercase; color:var(--color-primary-dark); margin-bottom:var(--space-3); }
.portfolio-single__title { font-size:clamp(var(--text-3xl),4vw,var(--text-4xl)); margin-bottom:var(--space-8); }
.portfolio-meta-card { background:var(--color-cream); border-radius:var(--radius-xl); padding:var(--space-6); position:sticky; top:calc(var(--header-total) + var(--space-8)); }
.portfolio-meta-row { display:flex; flex-direction:column; gap:var(--space-1); padding-block:var(--space-4); border-bottom:1px solid var(--color-border); }
.portfolio-meta-row:last-of-type { border-bottom:none; }
.portfolio-meta-label { font-size:var(--text-xs); font-weight:700; letter-spacing:var(--tracking-wider); text-transform:uppercase; color:var(--color-text-muted); }
.portfolio-meta-value { font-size:var(--text-sm); color:var(--color-text); }
@media (max-width:900px) { .portfolio-single__layout { grid-template-columns:1fr; } }
</style>

<?php get_footer(); ?>
