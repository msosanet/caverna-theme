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

	</div><!-- #caverna-view -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<div class="footer-brand">
				<strong><?php bloginfo( 'name' ); ?></strong>
				<span><?php esc_html_e( 'Comunicacion alternativa desde Ushuaia: radio online, noticias, cultura y contenidos independientes.', 'caverna' ); ?></span>
			</div>
			<nav class="footer-links" aria-label="<?php esc_attr_e( 'Links del pie', 'caverna' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Inicio', 'caverna' ); ?></a>
				<a href="<?php echo esc_url( caverna_page_url( 'sobre-nosotros' ) ); ?>"><?php esc_html_e( 'Sobre nosotros', 'caverna' ); ?></a>
				<a href="<?php echo esc_url( caverna_advertising_url() ); ?>"><?php esc_html_e( 'Publicite', 'caverna' ); ?></a>
				<a href="<?php echo esc_url( caverna_page_url( 'contacto' ) ); ?>"><?php esc_html_e( 'Contacto', 'caverna' ); ?></a>
				<a href="<?php echo esc_url( get_privacy_policy_url() ); ?>"><?php esc_html_e( 'Privacidad', 'caverna' ); ?></a>
			</nav>
			<?php caverna_social_links_markup( 'footer-social-links' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
