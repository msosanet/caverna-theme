<?php
/**
 * caverna functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package caverna
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function caverna_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on caverna, use a find and replace
		* to change 'caverna' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'caverna', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'caverna' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'caverna_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'caverna_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function caverna_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'caverna_content_width', 640 );
}
add_action( 'after_setup_theme', 'caverna_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function caverna_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'caverna' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'caverna' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Ad - Home Top', 'caverna' ),
			'id'            => 'ad-home-top',
			'description'   => esc_html__( 'Ad slot under the featured block on the home page.', 'caverna' ),
			'before_widget' => '<section id="%1$s" class="widget ad-slot %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Ad - Home Inline', 'caverna' ),
			'id'            => 'ad-home-inline',
			'description'   => esc_html__( 'Ad slot between the secondary grid and the latest list.', 'caverna' ),
			'before_widget' => '<section id="%1$s" class="widget ad-slot %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Ad - Sidebar', 'caverna' ),
			'id'            => 'ad-sidebar',
			'description'   => esc_html__( 'Ad slot for the sidebar.', 'caverna' ),
			'before_widget' => '<section id="%1$s" class="widget ad-slot %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'caverna_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function caverna_scripts() {
	wp_enqueue_style( 'caverna-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'caverna-style', 'rtl', 'replace' );

	wp_enqueue_script( 'caverna-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'caverna_scripts' );

/**
 * Pick between adsense and own ad on each page load.
 *
 * @param string $adsense AdSense or external ad code.
 * @param string $own Own ad HTML.
 * @return string
 */
function caverna_pick_ad( $adsense, $own ) {
	$adsense = trim( (string) $adsense );
	$own     = trim( (string) $own );

	if ( $adsense && $own ) {
		return wp_rand( 0, 1 ) ? $adsense : $own;
	}

	return $adsense ? $adsense : $own;
}

/**
 * Render the default in-house ad artwork.
 *
 * @param string $format horizontal|vertical.
 * @return string
 */
function caverna_default_ad( $format = 'horizontal' ) {
	$is_vertical = 'vertical' === $format;
	$horizontal  = get_template_directory_uri() . '/assets/ads/publicite-aqui-horizontal.png';
	$vertical    = get_template_directory_uri() . '/assets/ads/publicite-aqui-vertical.png';
	$class       = $is_vertical ? 'caverna-house-ad--vertical' : 'caverna-house-ad--horizontal';
	$mailto      = sanitize_email( get_option( 'admin_email' ) );
	$image       = sprintf(
		'<img src="%1$s" alt="%2$s" loading="eager" decoding="async" fetchpriority="high">',
		esc_url( $is_vertical ? $vertical : $horizontal ),
		esc_attr__( 'Publicite aqui en Caverna Radio', 'caverna' )
	);

	if ( $is_vertical ) {
		$image = sprintf(
			'<picture><source srcset="%1$s" media="(min-width: 64em)">%2$s</picture>',
			esc_url( $vertical ),
			sprintf(
				'<img src="%1$s" alt="%2$s" loading="eager" decoding="async" fetchpriority="high">',
				esc_url( $horizontal ),
				esc_attr__( 'Publicite aqui en Caverna Radio', 'caverna' )
			)
		);
	}

	return sprintf(
		'<a class="caverna-house-ad %1$s" href="mailto:%2$s?subject=%3$s">%4$s</a>',
		esc_attr( $class ),
		esc_attr( $mailto ),
		rawurlencode( __( 'Quiero publicitar en Caverna Radio', 'caverna' ) ),
		$image
	);
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

