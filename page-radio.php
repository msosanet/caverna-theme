<?php
/**
 * Template for the online radio page.
 *
 * @package caverna
 */

get_header();
?>

	<main id="primary" class="site-main radio-page">
		<section class="radio-page__hero content-layout content-layout--narrow">
			<p class="advertising-kicker"><?php esc_html_e( 'Senal online', 'caverna' ); ?></p>
			<h1><?php esc_html_e( 'Caverna Radio en vivo', 'caverna' ); ?></h1>
			<p><?php esc_html_e( 'Musica, cultura y contenidos alternativos desde Ushuaia. Escuchanos online sin autoplay: la transmision empieza cuando tocas play.', 'caverna' ); ?></p>
		</section>

		<div class="content-layout content-layout--narrow">
			<?php caverna_radio_player( array( 'class_name' => 'caverna-radio-player--page' ) ); ?>
		</div>

		<section class="radio-schedule content-layout" aria-labelledby="radio-schedule-title">
			<div class="radio-schedule__header">
				<div>
					<p class="advertising-kicker"><?php esc_html_e( 'Programacion', 'caverna' ); ?></p>
					<h2 id="radio-schedule-title"><?php esc_html_e( 'Grilla de podcasts', 'caverna' ); ?></h2>
					<p><?php esc_html_e( 'Este sera el espacio para los programas que graben su podcast con Caverna Radio. Por ahora estamos abriendo la grilla.', 'caverna' ); ?></p>
				</div>
			</div>

			<div class="radio-schedule__grid">
				<article class="radio-schedule__slot radio-schedule__slot--open">
					<span><?php esc_html_e( 'Lunes', 'caverna' ); ?></span>
					<h3><?php esc_html_e( 'Espacio disponible', 'caverna' ); ?></h3>
					<p><?php esc_html_e( 'Un podcast semanal de una hora para iniciar la semana con identidad propia.', 'caverna' ); ?></p>
				</article>
				<article class="radio-schedule__slot radio-schedule__slot--open">
					<span><?php esc_html_e( 'Miercoles', 'caverna' ); ?></span>
					<h3><?php esc_html_e( 'Espacio disponible', 'caverna' ); ?></h3>
					<p><?php esc_html_e( 'Entrevistas, cultura, comunidad, politica local o el formato que estes pensando.', 'caverna' ); ?></p>
				</article>
				<article class="radio-schedule__slot radio-schedule__slot--open">
					<span><?php esc_html_e( 'Viernes', 'caverna' ); ?></span>
					<h3><?php esc_html_e( 'Espacio disponible', 'caverna' ); ?></h3>
					<p><?php esc_html_e( 'Cierre de semana para proyectos, marcas, colectivos o creadores independientes.', 'caverna' ); ?></p>
				</article>
			</div>
		</section>

		<section class="podcast-studio content-layout" aria-labelledby="podcast-studio-title">
			<div class="podcast-studio__copy">
				<p class="advertising-kicker"><?php esc_html_e( 'Estudio podcast', 'caverna' ); ?></p>
				<h2 id="podcast-studio-title"><?php esc_html_e( 'Graba tu podcast con nosotros', 'caverna' ); ?></h2>
				<p><?php esc_html_e( 'Sumate a la grilla de Caverna Radio con un espacio mensual de grabacion. Ideal para programas, entrevistas, columnas, ciclos culturales, proyectos comerciales o contenidos independientes.', 'caverna' ); ?></p>
			</div>

			<div class="podcast-studio__price" aria-label="<?php esc_attr_e( 'Precio de grabacion de podcast', 'caverna' ); ?>">
				<span><?php esc_html_e( 'Plan mensual', 'caverna' ); ?></span>
				<strong>$100.000 ARS</strong>
				<p><?php esc_html_e( 'Incluye 4 horas de grabacion mensual: 1 hora por semana.', 'caverna' ); ?></p>
				<small><?php esc_html_e( 'Valor de referencia: $25.000 ARS la hora.', 'caverna' ); ?></small>
			</div>

			<form class="podcast-studio__form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
				<input type="hidden" name="action" value="caverna_podcast_inquiry">
				<?php wp_nonce_field( 'caverna_podcast_inquiry', 'caverna_podcast_nonce' ); ?>

				<label for="podcast_name"><?php esc_html_e( 'Nombre', 'caverna' ); ?></label>
				<input id="podcast_name" type="text" name="podcast_name" placeholder="<?php esc_attr_e( 'Tu nombre o equipo', 'caverna' ); ?>" required>

				<label for="podcast_contact"><?php esc_html_e( 'Contacto', 'caverna' ); ?></label>
				<input id="podcast_contact" type="text" name="podcast_contact" placeholder="<?php esc_attr_e( 'WhatsApp, Instagram o email', 'caverna' ); ?>" required>

				<label for="podcast_project"><?php esc_html_e( 'Nombre del podcast o idea', 'caverna' ); ?></label>
				<input id="podcast_project" type="text" name="podcast_project" placeholder="<?php esc_attr_e( 'Ej: Voces del sur', 'caverna' ); ?>" required>

				<label for="podcast_message"><?php esc_html_e( 'Contanos brevemente la idea', 'caverna' ); ?></label>
				<textarea id="podcast_message" name="podcast_message" rows="5" placeholder="<?php esc_attr_e( 'Tema, formato, invitados, horarios posibles...', 'caverna' ); ?>"></textarea>

				<label class="newsletter-hp" for="podcast_website"><?php esc_html_e( 'Sitio web', 'caverna' ); ?></label>
				<input class="newsletter-hp" id="podcast_website" type="text" name="podcast_website" tabindex="-1" autocomplete="off">

				<button type="submit"><?php esc_html_e( 'Consultar por grabacion', 'caverna' ); ?></button>

				<?php
				$podcast_status = isset( $_GET['podcast'] ) ? sanitize_key( wp_unslash( $_GET['podcast'] ) ) : '';
				if ( 'ok' === $podcast_status ) :
					?>
					<p class="podcast-studio__status"><?php esc_html_e( 'Consulta enviada. Te vamos a contactar para coordinar.', 'caverna' ); ?></p>
				<?php elseif ( $podcast_status ) : ?>
					<p class="podcast-studio__status podcast-studio__status--error"><?php esc_html_e( 'No pudimos enviar la consulta. Revisala e intenta otra vez.', 'caverna' ); ?></p>
				<?php endif; ?>
			</form>
		</section>

		<section class="radio-message content-layout content-layout--narrow" aria-labelledby="radio-message-title">
			<div class="radio-message__intro">
				<p class="advertising-kicker"><?php esc_html_e( 'Participa', 'caverna' ); ?></p>
				<h2 id="radio-message-title"><?php esc_html_e( 'Mandanos un mensaje al aire', 'caverna' ); ?></h2>
				<p><?php esc_html_e( 'Pedi una cancion, deja un saludo o manda un dato para la mesa. Los mensajes llegan a un panel interno del sitio.', 'caverna' ); ?></p>
			</div>

			<form class="radio-message__form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
				<input type="hidden" name="action" value="caverna_air_message">
				<?php wp_nonce_field( 'caverna_air_message', 'caverna_air_message_nonce' ); ?>

				<label for="air_message_name"><?php esc_html_e( 'Nombre', 'caverna' ); ?></label>
				<input id="air_message_name" type="text" name="air_message_name" placeholder="<?php esc_attr_e( 'Como queres salir al aire', 'caverna' ); ?>" required>

				<label for="air_message_contact"><?php esc_html_e( 'Contacto opcional', 'caverna' ); ?></label>
				<input id="air_message_contact" type="text" name="air_message_contact" placeholder="<?php esc_attr_e( 'WhatsApp, Instagram o email', 'caverna' ); ?>">

				<label for="air_message_type"><?php esc_html_e( 'Tipo de mensaje', 'caverna' ); ?></label>
				<select id="air_message_type" name="air_message_type">
					<option value="mensaje"><?php esc_html_e( 'Mensaje al aire', 'caverna' ); ?></option>
					<option value="cancion"><?php esc_html_e( 'Solicitud de cancion', 'caverna' ); ?></option>
					<option value="saludo"><?php esc_html_e( 'Saludo', 'caverna' ); ?></option>
					<option value="denuncia"><?php esc_html_e( 'Dato / denuncia', 'caverna' ); ?></option>
				</select>

				<label for="air_message_text"><?php esc_html_e( 'Mensaje', 'caverna' ); ?></label>
				<textarea id="air_message_text" name="air_message_text" rows="5" placeholder="<?php esc_attr_e( 'Escribi tu mensaje...', 'caverna' ); ?>" required></textarea>

				<label class="newsletter-hp" for="air_message_website"><?php esc_html_e( 'Sitio web', 'caverna' ); ?></label>
				<input class="newsletter-hp" id="air_message_website" type="text" name="air_message_website" tabindex="-1" autocomplete="off">

				<button type="submit"><?php esc_html_e( 'Enviar a la radio', 'caverna' ); ?></button>

				<?php
				$message_status = isset( $_GET['mensaje'] ) ? sanitize_key( wp_unslash( $_GET['mensaje'] ) ) : '';
				if ( 'ok' === $message_status ) :
					?>
					<p class="radio-message__status"><?php esc_html_e( 'Mensaje enviado. Gracias por sumarte.', 'caverna' ); ?></p>
				<?php elseif ( $message_status ) : ?>
					<p class="radio-message__status radio-message__status--error"><?php esc_html_e( 'No pudimos enviar el mensaje. Revisalo e intenta otra vez.', 'caverna' ); ?></p>
				<?php endif; ?>
			</form>
		</section>
	</main>

<?php
get_footer();
