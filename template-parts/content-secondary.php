<?php
/**
 * Template part for displaying secondary posts on home.
 *
 * @package caverna
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'secondary-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="secondary-media" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php the_post_thumbnail( 'medium_large' ); ?>
		</a>
	<?php else : ?>
		<?php caverna_post_visual_fallback( 'post-visual-fallback--secondary' ); ?>
	<?php endif; ?>
	<header class="entry-header">
		<?php caverna_card_meta(); ?>
		<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php caverna_posted_on(); ?>
			</div>
		<?php endif; ?>
	</header>
	<a class="read-more-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Leer nota completa', 'caverna' ); ?></a>
</article>
