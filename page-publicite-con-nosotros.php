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
$plans        = array(
	array(
		'name'        => __( 'Plan Presencia Local', 'caverna' ),
		'price'       => __( '$65.000 / mes', 'caverna' ),
		'description' => __( 'Ideal para negocios que quieren comenzar a tener visibilidad en Caverna.', 'caverna' ),
		'button'      => __( 'Quiero este plan', 'caverna' ),
		'features'    => array(
			__( 'Presencia mensual como comercio anunciante.', 'caverna' ),
			__( 'Menciones en Caverna Radio.', 'caverna' ),
			__( 'Presencia en el sitio web.', 'caverna' ),
			__( 'Difusion en redes sociales.', 'caverna' ),
			__( 'Comunicacion de promociones, novedades o eventos.', 'caverna' ),
			__( 'Inclusion en acciones de comercios amigos.', 'caverna' ),
		),
	),
	array(
		'name'        => __( 'Plan Impulso Digital', 'caverna' ),
		'price'       => __( '$95.000 / mes', 'caverna' ),
		'description' => __( 'Ideal para negocios que necesitan mas presencia y comunicacion durante el mes.', 'caverna' ),
		'button'      => __( 'Consultar por este plan', 'caverna' ),
		'badge'       => __( 'Recomendado', 'caverna' ),
		'features'    => array(
			__( 'Todo lo del Plan Presencia Local.', 'caverna' ),
			__( 'Mayor frecuencia de menciones.', 'caverna' ),
			__( 'Publicacion dedicada en redes.', 'caverna' ),
			__( 'Pieza grafica simple.', 'caverna' ),
			__( 'Difusion de una promo, evento, producto o servicio.', 'caverna' ),
			__( 'Presencia destacada en el sitio.', 'caverna' ),
			__( 'Acompanamiento basico para mejorar el mensaje comercial.', 'caverna' ),
		),
	),
	array(
		'name'        => __( 'Plan Aliado Surco + Caverna', 'caverna' ),
		'price'       => __( '$150.000 / mes', 'caverna' ),
		'description' => __( 'Ideal para marcas, espacios gastronomicos, turismo, eventos y proyectos que buscan una presencia mas completa.', 'caverna' ),
		'button'      => __( 'Quiero ser aliado', 'caverna' ),
		'features'    => array(
			__( 'Todo lo del Plan Impulso Digital.', 'caverna' ),
			__( 'Nota breve o contenido patrocinado en cavernaradio.net.', 'caverna' ),
			__( 'Entrevista, mencion editorial o cobertura simple.', 'caverna' ),
			__( 'Reel o pieza audiovisual simple.', 'caverna' ),
			__( 'Diagnostico basico de presencia digital.', 'caverna' ),
			__( 'Propuesta de mejora para redes, web, WhatsApp o pauta.', 'caverna' ),
			__( 'Prioridad en campanas, sorteos y acciones especiales.', 'caverna' ),
		),
	),
);
$audiences    = array(
	__( 'Bares y cervecerias', 'caverna' ),
	__( 'Restaurantes y cafeterias', 'caverna' ),
	__( 'Comercios locales', 'caverna' ),
	__( 'Turismo y alojamientos', 'caverna' ),
	__( 'Eventos culturales', 'caverna' ),
	__( 'Artistas y productores', 'caverna' ),
	__( 'Barberias, tattoo y estetica', 'caverna' ),
	__( 'Indumentaria y emprendimientos', 'caverna' ),
);
$surco_services = array(
	__( 'Diseno y desarrollo web', 'caverna' ),
	__( 'Landing pages', 'caverna' ),
	__( 'Carta digital o menu QR', 'caverna' ),
	__( 'Gestion de redes sociales', 'caverna' ),
	__( 'Campanas publicitarias', 'caverna' ),
	__( 'Automatizacion de WhatsApp', 'caverna' ),
	__( 'Produccion de contenido', 'caverna' ),
	__( 'Identidad visual y comunicacion comercial', 'caverna' ),
);
$benefits     = array(
	__( 'Llegas a una audiencia local de Ushuaia.', 'caverna' ),
	__( 'Tu marca aparece en un medio con identidad cultural.', 'caverna' ),
	__( 'Podes comunicar promociones, eventos y novedades.', 'caverna' ),
	__( 'Tenes presencia en radio online, sitio web y redes.', 'caverna' ),
	__( 'Podes empezar con publicidad y escalar a marketing digital.', 'caverna' ),
	__( 'Te acompanamos con contenido y estrategia.', 'caverna' ),
);
?>

	<main id="primary" class="site-main advertising-page">
		<a class="advertising-sticky-cta" href="<?php echo esc_url( $contact_href ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Publicitar por WhatsApp', 'caverna' ); ?></a>

		<section class="advertising-hero content-layout content-layout--narrow">
			<div class="advertising-hero__content">
				<p class="advertising-kicker"><?php esc_html_e( 'Publicidad digital local', 'caverna' ); ?></p>
				<h1><?php esc_html_e( 'Publicita en Caverna Radio', 'caverna' ); ?></h1>
				<p class="advertising-hero__lead"><?php esc_html_e( 'Un medio digital local de Ushuaia impulsado por Surco.ar', 'caverna' ); ?></p>
				<p><?php esc_html_e( 'Caverna Radio conecta comercios, emprendimientos, eventos y marcas locales con una audiencia activa mediante radio online, sitio web, redes sociales y contenido digital.', 'caverna' ); ?></p>
				<div class="advertising-actions">
					<a class="advertising-button" href="<?php echo esc_url( $contact_href ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Solicitar propuesta por WhatsApp', 'caverna' ); ?></a>
					<a class="advertising-button advertising-button--secondary" href="#planes-publicitarios"><?php esc_html_e( 'Ver planes publicitarios', 'caverna' ); ?></a>
				</div>
				<p class="advertising-contact">
					<?php
					printf(
						/* translators: 1: contact name, 2: WhatsApp number. */
						esc_html__( 'Contacto: %1$s - WhatsApp %2$s', 'caverna' ),
						esc_html( $contact_name ),
						esc_html( $whatsapp )
					);
					?>
				</p>
			</div>
		</section>

		<section class="advertising-positioning content-layout content-layout--narrow">
			<div class="advertising-copy">
				<p class="advertising-kicker"><?php esc_html_e( 'Caverna + Surco.ar', 'caverna' ); ?></p>
				<h2><?php esc_html_e( 'Una plataforma local para ganar visibilidad.', 'caverna' ); ?></h2>
			</div>
			<div class="advertising-positioning__grid">
				<article>
					<h3><?php esc_html_e( 'Medio independiente', 'caverna' ); ?></h3>
					<p><?php esc_html_e( 'Caverna Radio es un medio digital independiente de Ushuaia enfocado en cultura, comunidad, agenda local, musica, podcasts y contenidos alternativos.', 'caverna' ); ?></p>
				</article>
				<article>
					<h3><?php esc_html_e( 'Impulso digital', 'caverna' ); ?></h3>
					<p><?php esc_html_e( 'Desde Surco.ar, agencia de marketing digital y desarrollo web, impulsamos Caverna como una plataforma de comunicacion para que negocios locales ganen visibilidad y puedan escalar su presencia digital.', 'caverna' ); ?></p>
				</article>
			</div>
			<a class="read-more-link" href="#planes-publicitarios"><?php esc_html_e( 'Conocer planes', 'caverna' ); ?></a>
		</section>

		<section class="advertising-audience content-layout content-layout--narrow">
			<div class="advertising-copy">
				<p class="advertising-kicker"><?php esc_html_e( 'Para quien es', 'caverna' ); ?></p>
				<h2><?php esc_html_e( 'Pensado para proyectos locales que necesitan estar presentes.', 'caverna' ); ?></h2>
			</div>
			<div class="advertising-audience__grid">
				<?php foreach ( $audiences as $audience ) : ?>
					<article>
						<span aria-hidden="true">+</span>
						<h3><?php echo esc_html( $audience ); ?></h3>
					</article>
				<?php endforeach; ?>
			</div>
		</section>

		<section id="planes-publicitarios" class="advertising-pricing content-layout content-layout--narrow">
			<div class="advertising-copy">
				<p class="advertising-kicker"><?php esc_html_e( 'Planes publicitarios', 'caverna' ); ?></p>
				<h2><?php esc_html_e( 'Presencia mensual clara, accesible y escalable.', 'caverna' ); ?></h2>
				<p><?php esc_html_e( 'Elegimos planes simples para que cada comercio pueda empezar con una base concreta y crecer hacia una comunicacion digital mas completa.', 'caverna' ); ?></p>
			</div>
			<div class="advertising-pricing__grid">
				<?php foreach ( $plans as $plan ) : ?>
					<article class="pricing-card<?php echo ! empty( $plan['badge'] ) ? ' pricing-card--featured' : ''; ?>">
						<?php if ( ! empty( $plan['badge'] ) ) : ?>
							<p class="pricing-card__badge"><?php echo esc_html( $plan['badge'] ); ?></p>
						<?php endif; ?>
						<p class="pricing-card__eyebrow"><?php echo esc_html( $plan['name'] ); ?></p>
						<h3><?php echo esc_html( $plan['price'] ); ?></h3>
						<p><?php echo esc_html( $plan['description'] ); ?></p>
						<ul>
							<?php foreach ( $plan['features'] as $feature ) : ?>
								<li><?php echo esc_html( $feature ); ?></li>
							<?php endforeach; ?>
						</ul>
						<a class="advertising-button pricing-card__button" href="<?php echo esc_url( $contact_href ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $plan['button'] ); ?></a>
					</article>
				<?php endforeach; ?>
			</div>
			<div class="advertising-pricing__note">
				<p><?php esc_html_e( 'Valores mensuales expresados en pesos argentinos. Los planes pueden adaptarse segun rubro, calendario, materiales disponibles y objetivo comercial.', 'caverna' ); ?></p>
				<a class="advertising-button" href="<?php echo esc_url( $contact_href ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Solicitar propuesta', 'caverna' ); ?></a>
			</div>
		</section>

		<section class="advertising-surco content-layout content-layout--narrow">
			<div class="advertising-copy">
				<p class="advertising-kicker"><?php esc_html_e( 'Servicios Surco.ar', 'caverna' ); ?></p>
				<h2><?php esc_html_e( 'Tambien podemos ayudarte a escalar tu presencia digital.', 'caverna' ); ?></h2>
				<p><?php esc_html_e( 'Ademas de la publicidad mensual en Caverna Radio, desde Surco.ar podemos acompanar a comercios y emprendimientos con soluciones digitales.', 'caverna' ); ?></p>
			</div>
			<div class="advertising-surco__grid">
				<?php foreach ( $surco_services as $service ) : ?>
					<span><?php echo esc_html( $service ); ?></span>
				<?php endforeach; ?>
			</div>
			<a class="advertising-button" href="<?php echo esc_url( $contact_href ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Consultar servicios digitales', 'caverna' ); ?></a>
		</section>

		<section class="advertising-benefits content-layout content-layout--narrow">
			<div class="advertising-copy">
				<p class="advertising-kicker"><?php esc_html_e( 'Beneficios', 'caverna' ); ?></p>
				<h2><?php esc_html_e( 'Publicidad local con contenido, contexto y acompanamiento.', 'caverna' ); ?></h2>
			</div>
			<div class="advertising-benefits__grid">
				<?php foreach ( $benefits as $benefit ) : ?>
					<article>
						<h3><?php echo esc_html( $benefit ); ?></h3>
					</article>
				<?php endforeach; ?>
			</div>
			<a class="read-more-link" href="#contacto-publicidad"><?php esc_html_e( 'Hablar con Caverna', 'caverna' ); ?></a>
		</section>

		<section id="contacto-publicidad" class="advertising-cta content-layout content-layout--narrow">
			<p class="advertising-kicker"><?php esc_html_e( 'Contacto', 'caverna' ); ?></p>
			<h2><?php esc_html_e( 'Suma tu comercio a Caverna', 'caverna' ); ?></h2>
			<p><?php esc_html_e( 'Si tenes un comercio, emprendimiento, evento o marca local, podemos ayudarte a ganar visibilidad con una propuesta mensual accesible y adaptada a tu negocio.', 'caverna' ); ?></p>
			<div class="advertising-actions">
				<a class="advertising-button" href="<?php echo esc_url( $contact_href ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Escribir por WhatsApp', 'caverna' ); ?></a>
				<a class="advertising-button advertising-button--secondary" href="<?php echo esc_url( caverna_page_url( 'contacto' ) ); ?>"><?php esc_html_e( 'Enviar consulta', 'caverna' ); ?></a>
			</div>
		</section>
	</main>

<?php
get_footer();
