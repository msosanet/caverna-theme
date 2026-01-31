<?php
/**
 * Template part for displaying the featured post on home.
 *
 * @package caverna
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'featured-card featured-card--dual' ); ?>>
	<div class="featured-media">
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php the_post_thumbnail( 'large' ); ?>
			</a>
		<?php endif; ?>
	</div>
	<div class="featured-content">
		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php
					caverna_posted_on();
					caverna_posted_by();
					?>
				</div>
			<?php endif; ?>
		</header>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article>
