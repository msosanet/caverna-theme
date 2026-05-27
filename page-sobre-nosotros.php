<?php
/**
 * Template for the about page.
 *
 * @package caverna
 */

get_header();
?>

	<main id="primary" class="site-main about-page">
		<section class="about-hero content-layout content-layout--narrow">
			<p class="advertising-kicker"><?php esc_html_e( 'Sobre nosotros', 'caverna' ); ?></p>
			<h1><?php esc_html_e( 'Caverna Radio es un medio independiente de comunicacion y entretenimiento desde Ushuaia.', 'caverna' ); ?></h1>
			<p><?php esc_html_e( 'Somos propiedad de Surco.Ar, agencia de marketing, SEO y desarrollo web. No buscamos ser un portfolio: queremos construir un medio con servicios de comunicacion, contenidos, radio online y entretenimiento para una comunidad que busca otras perspectivas.', 'caverna' ); ?></p>
		</section>

		<section class="about-grid content-layout content-layout--narrow">
			<article>
				<h2><?php esc_html_e( 'Linea editorial', 'caverna' ); ?></h2>
				<p><?php esc_html_e( 'Buscamos exponer perspectivas que los medios tradicionales no siempre pueden tocar por su propia linea de negocios. Abrimos espacio para temas, voces y enfoques que necesitan otra forma de circulacion.', 'caverna' ); ?></p>
			</article>
			<article>
				<h2><?php esc_html_e( 'Que ofrecemos', 'caverna' ); ?></h2>
				<p><?php esc_html_e( 'Brindamos contenidos, radio online, acciones comerciales, difusion digital y propuestas de comunicacion para marcas, proyectos, eventos y comunidades.', 'caverna' ); ?></p>
			</article>
			<article>
				<h2><?php esc_html_e( 'Contacto', 'caverna' ); ?></h2>
				<p><?php esc_html_e( 'Estamos en Ushuaia y se puede contactar al telefono comercial de Surco.Ar para propuestas, prensa, contenidos o publicidad.', 'caverna' ); ?></p>
			</article>
		</section>

		<section class="about-cta content-layout content-layout--narrow">
			<a class="advertising-button" href="<?php echo esc_url( caverna_page_url( 'contacto' ) ); ?>"><?php esc_html_e( 'Contactar a Caverna', 'caverna' ); ?></a>
			<a class="read-more-link" href="<?php echo esc_url( caverna_advertising_url() ); ?>"><?php esc_html_e( 'Ver opciones para publicitar', 'caverna' ); ?></a>
		</section>
	</main><!-- #main -->

<?php
get_footer();
