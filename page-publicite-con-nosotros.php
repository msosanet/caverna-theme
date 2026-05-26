<?php
/**
 * Template for the advertising landing page.
 *
 * @package caverna
 */

get_header();

$contact_email = sanitize_email( get_option( 'admin_email' ) );
$contact_href  = 'mailto:' . $contact_email . '?subject=' . rawurlencode( __( 'Quiero publicitar en Caverna Radio', 'caverna' ) );
?>

	<main id="primary" class="site-main advertising-page">
		<section class="advertising-hero content-layout content-layout--narrow">
			<div class="advertising-hero__content">
				<p class="advertising-kicker"><?php esc_html_e( 'Publicidad en Caverna Radio', 'caverna' ); ?></p>
				<h1><?php esc_html_e( 'Inverti donde tu marca se pueda ver, escuchar y recordar.', 'caverna' ); ?></h1>
				<p><?php esc_html_e( 'La publicidad digital permite estar presente cuando la audiencia busca, lee, comparte y vuelve al contenido. En Caverna Radio combinamos presencia web, identidad local y comunicacion directa para que tu inversion tenga mas recorrido.', 'caverna' ); ?></p>
				<a class="advertising-button" href="<?php echo esc_url( $contact_href ); ?>"><?php esc_html_e( 'Consultar disponibilidad', 'caverna' ); ?></a>
			</div>
		</section>

		<section class="advertising-benefits content-layout content-layout--narrow">
			<div class="advertising-copy">
				<p class="advertising-kicker"><?php esc_html_e( 'Digital vs. medios tradicionales', 'caverna' ); ?></p>
				<h2><?php esc_html_e( 'Mas presencia por cada peso invertido.', 'caverna' ); ?></h2>
				<p><?php esc_html_e( 'La publicidad tradicional puede ser util para instalar una marca, pero suele depender de horarios fijos, piezas que pasan una sola vez y poca capacidad de ajuste. En digital, tu anuncio permanece visible, puede compartirse, se adapta a distintos dispositivos y permite construir una presencia continua sin depender de una tanda puntual.', 'caverna' ); ?></p>
			</div>
			<div class="advertising-benefits__grid">
				<article>
					<h3><?php esc_html_e( 'Presencia continua', 'caverna' ); ?></h3>
					<p><?php esc_html_e( 'Tu marca no aparece solo durante unos segundos: queda visible en el sitio mientras la audiencia navega el contenido.', 'caverna' ); ?></p>
				</article>
				<article>
					<h3><?php esc_html_e( 'Mejor contexto', 'caverna' ); ?></h3>
					<p><?php esc_html_e( 'El anuncio convive con notas, radio, cultura y comunidad, en un entorno donde la audiencia ya esta prestando atencion.', 'caverna' ); ?></p>
				</article>
				<article>
					<h3><?php esc_html_e( 'Flexibilidad', 'caverna' ); ?></h3>
					<p><?php esc_html_e( 'Podemos cambiar piezas, ajustar mensajes y combinar formatos sin rehacer una campana completa.', 'caverna' ); ?></p>
				</article>
				<article>
					<h3><?php esc_html_e( 'Accion directa', 'caverna' ); ?></h3>
					<p><?php esc_html_e( 'El usuario puede pasar del anuncio al contacto, consulta, sitio o red social de tu marca en un solo paso.', 'caverna' ); ?></p>
				</article>
			</div>
		</section>

		<section class="advertising-preview content-layout">
			<div class="advertising-preview__main">
				<?php echo caverna_default_ad( 'horizontal' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
			<div class="advertising-preview__side">
				<?php echo caverna_default_ad( 'vertical' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		</section>

		<section class="advertising-why content-layout content-layout--narrow">
			<p class="advertising-kicker"><?php esc_html_e( 'Por que con nosotros', 'caverna' ); ?></p>
			<h2><?php esc_html_e( 'Una alternativa local, directa y cercana en Ushuaia.', 'caverna' ); ?></h2>
			<p><?php esc_html_e( 'A diferencia de propuestas mas impersonales o estructuras tradicionales, Caverna Radio ofrece una comunicacion cercana, flexible y pensada para marcas que quieren hablarle a una comunidad concreta. No vendemos solo un espacio: trabajamos presencia, contexto y acompanamiento para que tu mensaje tenga sentido dentro de nuestra audiencia.', 'caverna' ); ?></p>
			<div class="advertising-why__list">
				<span><?php esc_html_e( 'Identidad local', 'caverna' ); ?></span>
				<span><?php esc_html_e( 'Trato directo', 'caverna' ); ?></span>
				<span><?php esc_html_e( 'Formatos simples', 'caverna' ); ?></span>
				<span><?php esc_html_e( 'Audiencia afin', 'caverna' ); ?></span>
			</div>
		</section>

		<section class="advertising-options content-layout content-layout--narrow">
			<div class="advertising-options__grid">
				<article>
					<h2><?php esc_html_e( 'Portada', 'caverna' ); ?></h2>
					<p><?php esc_html_e( 'Banner destacado en la home para campanas, eventos, lanzamientos y comercios.', 'caverna' ); ?></p>
				</article>
				<article>
					<h2><?php esc_html_e( 'Lateral desktop', 'caverna' ); ?></h2>
					<p><?php esc_html_e( 'Pieza vertical visible junto al contenido principal en pantallas grandes.', 'caverna' ); ?></p>
				</article>
				<article>
					<h2><?php esc_html_e( 'Acciones a medida', 'caverna' ); ?></h2>
					<p><?php esc_html_e( 'Podemos combinar presencia web con menciones y propuestas comerciales simples.', 'caverna' ); ?></p>
				</article>
			</div>
		</section>
	</main>

<?php
get_footer();
