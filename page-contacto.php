<?php
/**
 * Template for the contact page.
 *
 * @package caverna
 */

get_header();

$contact_name = caverna_advertising_contact_name();
$contact_href = caverna_advertising_whatsapp_url();
$whatsapp     = caverna_advertising_whatsapp_number();
?>

	<main id="primary" class="site-main contact-page">
		<section class="contact-hero content-layout content-layout--narrow">
			<div class="contact-hero__content">
				<p class="advertising-kicker"><?php esc_html_e( 'Contacto', 'caverna' ); ?></p>
				<h1><?php esc_html_e( 'Hablemos de tu marca, evento o proyecto.', 'caverna' ); ?></h1>
				<p><?php esc_html_e( 'Caverna Radio combina sitio web, radio online y comunidad local para que tu mensaje llegue con presencia digital y acompanamiento directo.', 'caverna' ); ?></p>
				<a class="advertising-button" href="<?php echo esc_url( $contact_href ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Escribir por WhatsApp', 'caverna' ); ?></a>
				<p class="advertising-contact">
					<?php
					printf(
						/* translators: 1: contact name, 2: WhatsApp number. */
						esc_html__( 'Contacto: %1$s · WhatsApp %2$s', 'caverna' ),
						esc_html( $contact_name ),
						esc_html( $whatsapp )
					);
					?>
				</p>
			</div>
		</section>

		<section class="contact-grid content-layout content-layout--narrow">
			<article>
				<h2><?php esc_html_e( 'Publicidad', 'caverna' ); ?></h2>
				<p><?php esc_html_e( 'Armamos propuestas para comercios, marcas, eventos y emprendimientos que necesitan visibilidad en web y radio online.', 'caverna' ); ?></p>
				<a class="read-more-link" href="<?php echo esc_url( caverna_advertising_url() ); ?>"><?php esc_html_e( 'Ver opciones comerciales', 'caverna' ); ?></a>
			</article>
			<article>
				<h2><?php esc_html_e( 'Contenido y prensa', 'caverna' ); ?></h2>
				<p><?php esc_html_e( 'Si queres acercar una noticia, actividad cultural, lanzamiento o propuesta editorial, escribinos con la informacion principal.', 'caverna' ); ?></p>
				<a class="read-more-link" href="<?php echo esc_url( $contact_href ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Enviar informacion', 'caverna' ); ?></a>
			</article>
			<?php if ( caverna_social_links() ) : ?>
				<article class="contact-social-card">
					<h2><?php esc_html_e( 'Redes sociales', 'caverna' ); ?></h2>
					<p><?php esc_html_e( 'Tambien podes seguirnos y escribirnos por nuestros perfiles para conocer notas, acciones, sorteos y novedades.', 'caverna' ); ?></p>
					<?php caverna_social_links_markup( 'contact-social-links' ); ?>
				</article>
			<?php endif; ?>
		</section>

		<?php caverna_newsletter_form(); ?>
	</main><!-- #main -->

<?php
get_footer();
