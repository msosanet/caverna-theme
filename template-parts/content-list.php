<?php
/**
 * Template part for displaying posts in the latest list on home.
 *
 * @package caverna
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'latest-item' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="latest-thumb" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php the_post_thumbnail( 'thumbnail' ); ?>
		</a>
	<?php endif; ?>
	<div class="latest-content">
		<header class="entry-header">
			<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php caverna_posted_on(); ?>
				</div>
			<?php endif; ?>
		</header>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article>
