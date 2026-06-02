<?php
/**
 * Template part for the Caverna Radio online player.
 *
 * @package caverna
 */

$stream_url = caverna_radio_stream_url();
$class_name = isset( $args['class_name'] ) ? sanitize_html_class( $args['class_name'] ) : '';
$radio_page = get_page_by_path( 'radio' );
$volume_id  = wp_unique_id( 'caverna-radio-volume-' );
?>

<section class="caverna-radio-player <?php echo esc_attr( $class_name ); ?>" data-stream-url="<?php echo esc_url( $stream_url ); ?>" aria-label="<?php esc_attr_e( 'Caverna Radio en vivo', 'caverna' ); ?>">
	<div class="caverna-radio-player__content">
		<div class="caverna-radio-player__meta">
			<span class="caverna-radio-player__badge"><?php esc_html_e( 'EN VIVO', 'caverna' ); ?></span>
			<h2 class="caverna-radio-player__title"><?php esc_html_e( 'Caverna Radio', 'caverna' ); ?></h2>
			<p class="caverna-radio-player__subtitle"><?php esc_html_e( 'Musica online 24/7 desde el sur', 'caverna' ); ?></p>
			<p class="caverna-radio-player__status" aria-live="polite"><?php esc_html_e( 'Pausado', 'caverna' ); ?></p>
			<p class="caverna-radio-player__now-playing" data-now-playing hidden aria-live="polite"></p>
			<?php if ( $radio_page instanceof WP_Post ) : ?>
				<a class="caverna-radio-player__link" href="<?php echo esc_url( get_permalink( $radio_page ) ); ?>"><?php esc_html_e( 'Ir a la radio', 'caverna' ); ?></a>
			<?php endif; ?>
		</div>

		<button class="caverna-radio-player__button" type="button" aria-label="<?php esc_attr_e( 'Reproducir Caverna Radio', 'caverna' ); ?>">
			<span class="caverna-radio-player__icon" aria-hidden="true"></span>
		</button>

		<div class="caverna-radio-player__volume">
			<label for="<?php echo esc_attr( $volume_id ); ?>"><?php esc_html_e( 'Volumen', 'caverna' ); ?></label>
			<input id="<?php echo esc_attr( $volume_id ); ?>" class="caverna-radio-player__volume-range" type="range" min="0" max="100" step="1" value="80" aria-label="<?php esc_attr_e( 'Volumen de Caverna Radio', 'caverna' ); ?>">
			<span class="caverna-radio-player__volume-value" aria-hidden="true">80%</span>
		</div>
	</div>

	<audio class="caverna-radio-player__audio" preload="none">
		<source src="<?php echo esc_url( $stream_url ); ?>" type="audio/mpeg">
	</audio>
</section>
