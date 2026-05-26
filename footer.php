<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package caverna
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<strong><?php bloginfo( 'name' ); ?></strong>
			<span><?php esc_html_e( 'Radio, noticias y cultura independiente.', 'caverna' ); ?></span>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
