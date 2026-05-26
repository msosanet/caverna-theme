<?php
/**
 * The template for displaying 404 pages.
 *
 * @package caverna
 */

get_header();
?>

	<main id="primary" class="site-main">
		<section class="error-404 not-found content-layout content-layout--narrow">
			<header class="page-header">
				<p class="advertising-kicker"><?php esc_html_e( '404', 'caverna' ); ?></p>
				<h1 class="page-title"><?php esc_html_e( 'Esa pagina no esta disponible.', 'caverna' ); ?></h1>
				<p><?php esc_html_e( 'Puede haber cambiado de lugar o ya no existir. Buscala de nuevo o volve a las secciones principales.', 'caverna' ); ?></p>
			</header>

			<div class="not-found-actions">
				<?php get_search_form(); ?>
				<a class="advertising-button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Ir al inicio', 'caverna' ); ?></a>
				<a class="read-more-link" href="<?php echo esc_url( caverna_advertising_url() ); ?>"><?php esc_html_e( 'Publicitar en Caverna', 'caverna' ); ?></a>
				<a class="read-more-link" href="<?php echo esc_url( caverna_page_url( 'contacto' ) ); ?>"><?php esc_html_e( 'Contactar', 'caverna' ); ?></a>
			</div>
		</section>
	</main><!-- #main -->

<?php
get_footer();
