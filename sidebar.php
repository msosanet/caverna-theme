<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package caverna
 */

if ( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'ad-sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php
	$sidebar_ad = get_theme_mod( 'caverna_sidebar_ad', '' );
	$sidebar_ad_own = get_theme_mod( 'caverna_sidebar_ad_own', '' );
	$sidebar_pick   = caverna_pick_ad( $sidebar_ad, $sidebar_ad_own );
	if ( ! empty( $sidebar_pick ) ) :
		?>
		<div class="ad-banner ad-banner--rectangle">
			<?php echo $sidebar_pick; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
	<?php elseif ( is_active_sidebar( 'ad-sidebar' ) ) : ?>
		<?php dynamic_sidebar( 'ad-sidebar' ); ?>
	<?php elseif ( is_customize_preview() ) : ?>
		<div class="ad-placeholder ad-placeholder--rectangle" aria-hidden="true">
			Espacio publicidad (300x250)
		</div>
	<?php endif; ?>
</aside><!-- #secondary -->
