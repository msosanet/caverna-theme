<?php
/**
 * Search form template.
 *
 * @package caverna
 */

$caverna_search_id = wp_unique_id( 'search-field-' );
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $caverna_search_id ); ?>">
		<span><?php esc_html_e( 'Buscar en Caverna Radio', 'caverna' ); ?></span>
		<input id="<?php echo esc_attr( $caverna_search_id ); ?>" class="search-field" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Buscar notas, podcasts o temas', 'caverna' ); ?>">
	</label>
	<button class="search-submit" type="submit"><?php esc_html_e( 'Buscar', 'caverna' ); ?></button>
</form>
