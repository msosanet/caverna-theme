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
