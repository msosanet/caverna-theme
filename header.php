<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package caverna
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'caverna' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-header-inner">
			<div class="site-branding">
				<div class="site-logo">
					<?php caverna_header_logo_markup(); ?>
				</div>
				<?php
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$caverna_description = get_bloginfo( 'description', 'display' );
				if ( $caverna_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $caverna_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'caverna' ); ?></button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'fallback_cb'    => 'caverna_primary_menu_fallback',
					)
				);
				?>
			</nav><!-- #site-navigation -->
		</div>

		<?php
		$header_ad_code = get_theme_mod( 'caverna_header_ad_code', '' );
		$header_ad_own  = get_theme_mod( 'caverna_header_ad_own', '' );
		$header_ad      = caverna_pick_ad( $header_ad_code, $header_ad_own );
		if ( empty( $header_ad ) ) {
			$header_ad = caverna_default_ad( 'horizontal' );
		}

		if ( ! empty( $header_ad ) || get_header_image() || is_customize_preview() ) :
			?>
			<div class="header-ad">
				<?php if ( get_header_image() ) : ?>
					<div class="header-ad__image">
						<?php the_header_image_tag(); ?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $header_ad ) ) : ?>
					<div class="ad-banner ad-banner--leaderboard">
						<?php echo $header_ad; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				<?php elseif ( is_customize_preview() ) : ?>
					<div class="ad-placeholder ad-placeholder--leaderboard">
						Espacio publicidad (728x90)
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</header><!-- #masthead -->
