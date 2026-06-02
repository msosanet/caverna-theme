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
	</main>

<?php
get_footer();
