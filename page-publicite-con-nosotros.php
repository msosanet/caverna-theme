<?php
/**
 * Template for the advertising landing page.
 *
 * @package caverna
 */

get_header();

$contact_name = caverna_advertising_contact_name();
$contact_href = caverna_advertising_whatsapp_url();
$whatsapp     = caverna_advertising_whatsapp_number();
?>

	<main id="primary" class="site-main advertising-page">
		<section class="advertising-hero content-layout content-layout--narrow">
			<div class="advertising-hero__content">
				<p class="advertising-kicker"><?php esc_html_e( 'Publicidad en Caverna Radio', 'caverna' ); ?></p>
				<h1><?php esc_html_e( 'Inverti donde tu marca se pueda ver, escuchar y recordar.', 'caverna' ); ?></h1>
				<p><?php esc_html_e( 'La publicidad digital permite estar presente cuando la audiencia busca, lee, comparte y vuelve al contenido. En Caverna Radio combinamos presencia web, identidad local y comunicacion directa para que tu inversion tenga mas recorrido.', 'caverna' ); ?></p>
				<a class="advertising-button" href="<?php echo esc_url( $contact_href ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Consultar por WhatsApp', 'caverna' ); ?></a>
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
				<?php foreach ( caverna_advertising_packages() as $package ) : ?>
					<article>
						<h2><?php echo esc_html( $package['title'] ); ?></h2>
						<p><?php echo esc_html( $package['text'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</section>

		<section class="advertising-pricing content-layout content-layout--narrow">
			<div class="advertising-copy">
				<p class="advertising-kicker"><?php esc_html_e( 'Precios de lanzamiento', 'caverna' ); ?></p>
				<h2><?php esc_html_e( 'Publicidad simple, directa y con beneficio para la comunidad.', 'caverna' ); ?></h2>
				<p><?php esc_html_e( 'Nos interesa que las marcas se vean, pero tambien que nuestros oyentes y seguidores reciban algo a cambio: un sorteo, descuento, promo, beneficio o regalo que conecte tu marca con la comunidad de Caverna.', 'caverna' ); ?></p>
			</div>
			<div class="advertising-pricing__grid">
				<article class="pricing-card">
					<p class="pricing-card__eyebrow"><?php esc_html_e( 'Spot publicitario', 'caverna' ); ?></p>
					<h3><?php esc_html_e( '$50.000 ARS', 'caverna' ); ?></h3>
					<p><?php esc_html_e( 'Un spot publicitario para radio online o presencia en nuestro sitio, segun el objetivo de la campana.', 'caverna' ); ?></p>
					<ul>
						<li><?php esc_html_e( 'Formato simple para arrancar rapido.', 'caverna' ); ?></li>
						<li><?php esc_html_e( 'Puede aplicarse en radio online o web.', 'caverna' ); ?></li>
						<li><?php esc_html_e( 'Incluye propuesta de regalo o beneficio para oyentes/seguidores.', 'caverna' ); ?></li>
					</ul>
				</article>
				<article class="pricing-card pricing-card--featured">
					<p class="pricing-card__eyebrow"><?php esc_html_e( 'Combo recomendado', 'caverna' ); ?></p>
					<h3><?php esc_html_e( '$65.000 ARS', 'caverna' ); ?></h3>
					<p><?php esc_html_e( 'Presencia combinada en radio online, pagina web y redes sociales para reforzar el mensaje en distintos puntos de contacto.', 'caverna' ); ?></p>
					<ul>
						<li><?php esc_html_e( 'Radio online + sitio web + redes sociales.', 'caverna' ); ?></li>
						<li><?php esc_html_e( 'Ideal para comercios, eventos, marcas locales y emprendimientos.', 'caverna' ); ?></li>
						<li><?php esc_html_e( 'Incluye regalo, sorteo, promo o beneficio para que la audiencia tambien gane.', 'caverna' ); ?></li>
					</ul>
				</article>
			</div>
		</section>

		<section class="advertising-cta content-layout content-layout--narrow">
			<h2><?php esc_html_e( 'Ideal para comercios, eventos, marcas locales y emprendimientos.', 'caverna' ); ?></h2>
			<p><?php esc_html_e( 'Contanos que queres promocionar y te respondemos con una propuesta simple para web, radio online o un combo a medida.', 'caverna' ); ?></p>
			<a class="advertising-button" href="<?php echo esc_url( $contact_href ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Hablar con publicidad', 'caverna' ); ?></a>
		</section>
	</main>

<?php
get_footer();
