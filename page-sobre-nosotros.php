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
			<h1><?php esc_html_e( 'Caverna Radio es comunicacion alternativa desde Ushuaia.', 'caverna' ); ?></h1>
			<p><?php esc_html_e( 'Hacemos radio online, notas, cultura, cannabis, tecnologia, podcasts y contenidos independientes para una audiencia que busca otra forma de informarse y encontrarse.', 'caverna' ); ?></p>
		</section>

		<section class="about-grid content-layout content-layout--narrow">
			<article>
				<h2><?php esc_html_e( 'Que hacemos', 'caverna' ); ?></h2>
				<p><?php esc_html_e( 'Publicamos contenidos propios, acompanamos actividades locales y abrimos espacio para voces, proyectos y comunidades que no siempre entran en los medios tradicionales.', 'caverna' ); ?></p>
			</article>
			<article>
				<h2><?php esc_html_e( 'Por que digital', 'caverna' ); ?></h2>
				<p><?php esc_html_e( 'El sitio y la radio online permiten que cada nota, campana o accion siga visible, pueda compartirse y llegue a la audiencia cuando vuelve al contenido.', 'caverna' ); ?></p>
			</article>
			<article>
				<h2><?php esc_html_e( 'Como participar', 'caverna' ); ?></h2>
				<p><?php esc_html_e( 'Podes escribirnos para acercar noticias, sumarte con propuestas editoriales, difundir eventos o consultar opciones para publicitar.', 'caverna' ); ?></p>
			</article>
		</section>

		<section class="about-cta content-layout content-layout--narrow">
			<a class="advertising-button" href="<?php echo esc_url( caverna_page_url( 'contacto' ) ); ?>"><?php esc_html_e( 'Contactar a Caverna', 'caverna' ); ?></a>
			<a class="read-more-link" href="<?php echo esc_url( caverna_advertising_url() ); ?>"><?php esc_html_e( 'Ver opciones para publicitar', 'caverna' ); ?></a>
		</section>
	</main><!-- #main -->

<?php
get_footer();
