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
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	add_image_size( 'caverna-card', 640, 420, true );
	add_image_size( 'caverna-wide', 1200, 630, true );

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
 * Remove block styles from the public site when the theme renders classic templates.
 *
 * @return void
 */
function caverna_dequeue_block_styles() {
	if ( is_admin() ) {
		return;
	}

	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'caverna_dequeue_block_styles', 100 );

/**
 * Load the main stylesheet without blocking first paint.
 *
 * @param string $html Style tag HTML.
 * @param string $handle Style handle.
 * @param string $href Stylesheet URL.
 * @param string $media Media attribute.
 * @return string
 */
function caverna_defer_theme_styles( $html, $handle, $href, $media ) {
	if ( is_admin() || 'caverna-style' !== $handle ) {
		return $html;
	}

	$media = $media ? $media : 'all';

	return sprintf(
		'<link rel="stylesheet" id="%1$s-css" href="%2$s" media="print" onload="this.media=%3$s"><noscript><link rel="stylesheet" id="%1$s-css-noscript" href="%2$s" media="%4$s"></noscript>' . "\n",
		esc_attr( $handle ),
		esc_url( $href ),
		esc_attr( "'" . $media . "'" ),
		esc_attr( $media )
	);
}
add_filter( 'style_loader_tag', 'caverna_defer_theme_styles', 10, 4 );

/**
 * Return the optimized theme logo fallback URL.
 *
 * @param string $size Logo asset size.
 * @return string
 */
function caverna_optimized_logo_url( $size = '192' ) {
	$file = '320' === $size ? 'caverna-logo-320.png' : 'caverna-logo-192.png';
	return get_template_directory_uri() . '/assets/' . $file;
}

/**
 * Render the header logo with explicit dimensions and priority hints.
 *
 * @return void
 */
function caverna_header_logo_markup() {
	if ( has_custom_logo() ) {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$logo = wp_get_attachment_image(
			$custom_logo_id,
			'thumbnail',
			false,
			array(
				'class'         => 'custom-logo',
				'decoding'      => 'async',
				'fetchpriority' => is_front_page() ? 'high' : 'auto',
				'loading'       => is_front_page() ? 'eager' : 'lazy',
			)
		);
		echo '<a class="custom-logo-link" href="' . esc_url( home_url( '/' ) ) . '" rel="home" aria-label="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . $logo . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		return;
	}
	?>
	<a class="custom-logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
		<img class="custom-logo" src="<?php echo esc_url( caverna_optimized_logo_url( '192' ) ); ?>" srcset="<?php echo esc_url( caverna_optimized_logo_url( '192' ) ); ?> 192w, <?php echo esc_url( caverna_optimized_logo_url( '320' ) ); ?> 320w" sizes="96px" width="96" height="96" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" decoding="async" fetchpriority="high">
	</a>
	<?php
}

/**
 * Preload the header logo fallback when it is part of the first viewport.
 *
 * @return void
 */
function caverna_preload_logo_asset() {
	if ( ! is_front_page() || has_custom_logo() ) {
		return;
	}
	?>
	<link rel="preload" as="image" href="<?php echo esc_url( caverna_optimized_logo_url( '192' ) ); ?>" imagesrcset="<?php echo esc_attr( caverna_optimized_logo_url( '192' ) . ' 192w, ' . caverna_optimized_logo_url( '320' ) . ' 320w' ); ?>" imagesizes="96px">
	<?php
}
add_action( 'wp_head', 'caverna_preload_logo_asset', 1 );

/**
 * Register newsletter subscribers in the admin.
 *
 * @return void
 */
function caverna_register_newsletter_subscriber() {
	register_post_type(
		'caverna_subscriber',
		array(
			'labels'              => array(
				'name'          => esc_html__( 'Suscriptores', 'caverna' ),
				'singular_name' => esc_html__( 'Suscriptor', 'caverna' ),
				'menu_name'     => esc_html__( 'Newsletter', 'caverna' ),
			),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_icon'           => 'dashicons-email-alt2',
			'supports'            => array( 'title' ),
			'capability_type'     => 'post',
			'exclude_from_search' => true,
		)
	);
}
add_action( 'init', 'caverna_register_newsletter_subscriber' );

/**
 * Store newsletter form submissions.
 *
 * @return void
 */
function caverna_handle_newsletter_subscribe() {
	$redirect = wp_get_referer() ? wp_get_referer() : home_url( '/' );

	if ( ! empty( $_POST['newsletter_website'] ) ) {
		wp_safe_redirect( add_query_arg( 'newsletter', 'ok', $redirect ) );
		exit;
	}

	if ( ! isset( $_POST['caverna_newsletter_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['caverna_newsletter_nonce'] ) ), 'caverna_newsletter_subscribe' ) ) {
		wp_safe_redirect( add_query_arg( 'newsletter', 'error', $redirect ) );
		exit;
	}

	$name      = isset( $_POST['newsletter_name'] ) ? sanitize_text_field( wp_unslash( $_POST['newsletter_name'] ) ) : '';
	$email     = isset( $_POST['newsletter_email'] ) ? sanitize_email( wp_unslash( $_POST['newsletter_email'] ) ) : '';
	$interests = isset( $_POST['newsletter_interests'] ) && is_array( $_POST['newsletter_interests'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['newsletter_interests'] ) ) : array();
	$consent   = ! empty( $_POST['newsletter_consent'] );

	if ( ! is_email( $email ) || ! $consent ) {
		wp_safe_redirect( add_query_arg( 'newsletter', 'invalid', $redirect ) );
		exit;
	}

	$existing = get_posts(
		array(
			'post_type'      => 'caverna_subscriber',
			'title'          => $email,
			'post_status'    => 'private',
			'posts_per_page' => 1,
			'fields'         => 'ids',
		)
	);

	if ( $existing ) {
		wp_safe_redirect( add_query_arg( 'newsletter', 'exists', $redirect ) );
		exit;
	}

	$subscriber_id = wp_insert_post(
		array(
			'post_type'   => 'caverna_subscriber',
			'post_status' => 'private',
			'post_title'  => $name ? $name . ' - ' . $email : $email,
		)
	);

	if ( is_wp_error( $subscriber_id ) || ! $subscriber_id ) {
		wp_safe_redirect( add_query_arg( 'newsletter', 'error', $redirect ) );
		exit;
	}

	update_post_meta( $subscriber_id, 'subscriber_name', $name );
	update_post_meta( $subscriber_id, 'subscriber_email', $email );
	update_post_meta( $subscriber_id, 'subscriber_source', esc_url_raw( $redirect ) );
	update_post_meta( $subscriber_id, 'subscriber_interests', implode( ', ', $interests ) );
	update_post_meta( $subscriber_id, 'subscriber_consent', current_time( 'mysql' ) );

	caverna_notify_newsletter_subscriber( $subscriber_id, $name, $email, $interests, $redirect );

	wp_safe_redirect( add_query_arg( 'newsletter', 'ok', $redirect ) );
	exit;
}
add_action( 'admin_post_nopriv_caverna_newsletter_subscribe', 'caverna_handle_newsletter_subscribe' );
add_action( 'admin_post_caverna_newsletter_subscribe', 'caverna_handle_newsletter_subscribe' );

/**
 * Notify the site administrator when a subscriber registers.
 *
 * @param int    $subscriber_id Subscriber post ID.
 * @param string $name Subscriber name.
 * @param string $email Subscriber email.
 * @param array  $interests Selected interests.
 * @param string $source Signup source URL.
 * @return void
 */
function caverna_notify_newsletter_subscriber( $subscriber_id, $name, $email, $interests, $source ) {
	$recipient = get_option( 'admin_email' );

	if ( ! is_email( $recipient ) ) {
		return;
	}

	$body = implode(
		"\n",
		array(
			__( 'Nuevo registro de newsletter en Caverna Radio', 'caverna' ),
			'',
			sprintf( __( 'Nombre: %s', 'caverna' ), $name ? $name : __( 'No informado', 'caverna' ) ),
			sprintf( __( 'Email: %s', 'caverna' ), $email ),
			sprintf( __( 'Intereses: %s', 'caverna' ), $interests ? implode( ', ', $interests ) : __( 'No informado', 'caverna' ) ),
			sprintf( __( 'Origen: %s', 'caverna' ), $source ),
			sprintf( __( 'Consentimiento: %s', 'caverna' ), current_time( 'mysql' ) ),
			'',
			sprintf( __( 'Ver registro: %s', 'caverna' ), get_edit_post_link( $subscriber_id, 'raw' ) ),
		)
	);

	wp_mail(
		$recipient,
		__( 'Nuevo suscriptor de Caverna Radio', 'caverna' ),
		$body,
		array( 'Reply-To: ' . ( $name ? $name : 'Caverna Radio' ) . ' <' . $email . '>' )
	);
}

/**
 * Customize newsletter subscriber admin columns.
 *
 * @param array $columns Admin columns.
 * @return array
 */
function caverna_subscriber_columns( $columns ) {
	return array(
		'cb'                => $columns['cb'],
		'title'             => esc_html__( 'Correo', 'caverna' ),
		'subscriber_name'   => esc_html__( 'Nombre', 'caverna' ),
		'interests'         => esc_html__( 'Intereses', 'caverna' ),
		'subscriber_source' => esc_html__( 'Origen', 'caverna' ),
		'date'              => esc_html__( 'Fecha', 'caverna' ),
	);
}
add_filter( 'manage_caverna_subscriber_posts_columns', 'caverna_subscriber_columns' );

/**
 * Render newsletter subscriber custom columns.
 *
 * @param string $column  Column key.
 * @param int    $post_id Post ID.
 * @return void
 */
function caverna_subscriber_column_content( $column, $post_id ) {
	if ( 'subscriber_source' === $column ) {
		$source = get_post_meta( $post_id, 'subscriber_source', true );
		echo $source ? esc_url( $source ) : '&mdash;';
	}

	if ( 'subscriber_name' === $column ) {
		echo esc_html( get_post_meta( $post_id, 'subscriber_name', true ) );
	}

	if ( 'interests' === $column ) {
		echo esc_html( get_post_meta( $post_id, 'subscriber_interests', true ) );
	}
}
add_action( 'manage_caverna_subscriber_posts_custom_column', 'caverna_subscriber_column_content', 10, 2 );

/**
 * Add subscriber detail box in the admin.
 *
 * @return void
 */
function caverna_subscriber_add_meta_boxes() {
	if ( ! function_exists( 'add_meta_box' ) ) {
		return;
	}

	add_meta_box(
		'caverna_subscriber_details',
		__( 'Datos del suscriptor', 'caverna' ),
		'caverna_subscriber_render_details_box',
		'caverna_subscriber',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes_caverna_subscriber', 'caverna_subscriber_add_meta_boxes' );

/**
 * Render subscriber details.
 *
 * @param WP_Post $post Subscriber post.
 * @return void
 */
function caverna_subscriber_render_details_box( $post ) {
	$fields = array(
		__( 'Nombre', 'caverna' )        => get_post_meta( $post->ID, 'subscriber_name', true ),
		__( 'Email', 'caverna' )         => get_post_meta( $post->ID, 'subscriber_email', true ),
		__( 'Intereses', 'caverna' )     => get_post_meta( $post->ID, 'subscriber_interests', true ),
		__( 'Origen', 'caverna' )        => get_post_meta( $post->ID, 'subscriber_source', true ),
		__( 'Consentimiento', 'caverna' ) => get_post_meta( $post->ID, 'subscriber_consent', true ),
	);
	?>
	<table class="widefat striped">
		<tbody>
			<?php foreach ( $fields as $label => $value ) : ?>
				<tr>
					<th scope="row" style="width: 180px;"><?php echo esc_html( $label ); ?></th>
					<td>
						<?php if ( is_email( $value ) ) : ?>
							<a href="mailto:<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $value ); ?></a>
						<?php elseif ( 0 === strpos( (string) $value, 'http' ) ) : ?>
							<a href="<?php echo esc_url( $value ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $value ); ?></a>
						<?php else : ?>
							<?php echo esc_html( $value ? $value : __( 'No informado', 'caverna' ) ); ?>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php
}

/**
 * Render newsletter signup form.
 *
 * @return void
 */
function caverna_newsletter_form( $variant = '' ) {
	$status  = isset( $_GET['newsletter'] ) ? sanitize_key( wp_unslash( $_GET['newsletter'] ) ) : '';
	$classes = 'newsletter-signup';
	$interests = array(
		'cultura'  => __( 'Cultura', 'caverna' ),
		'cannabis' => __( 'Cannabis', 'caverna' ),
		'musica'   => __( 'Musica', 'caverna' ),
		'politica' => __( 'Politica', 'caverna' ),
		'eventos'  => __( 'Eventos', 'caverna' ),
	);

	if ( 'inline' === $variant ) {
		$classes .= ' newsletter-signup--inline';
	} else {
		$classes .= ' content-layout content-layout--narrow';
	}
	?>
	<section class="<?php echo esc_attr( $classes ); ?>">
		<div class="newsletter-signup__content">
			<p class="advertising-kicker"><?php esc_html_e( 'Newsletter', 'caverna' ); ?></p>
			<h2><?php esc_html_e( 'Recibi novedades de Caverna Radio', 'caverna' ); ?></h2>
			<p><?php esc_html_e( 'Dejanos tu correo para recibir notas, podcasts, novedades y acciones especiales.', 'caverna' ); ?></p>
		</div>
		<form class="newsletter-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
			<input type="hidden" name="action" value="caverna_newsletter_subscribe">
			<?php wp_nonce_field( 'caverna_newsletter_subscribe', 'caverna_newsletter_nonce' ); ?>
			<label for="newsletter_name"><?php esc_html_e( 'Nombre', 'caverna' ); ?></label>
			<input id="newsletter_name" type="text" name="newsletter_name" placeholder="<?php esc_attr_e( 'Tu nombre', 'caverna' ); ?>" autocomplete="name">
			<label for="newsletter_email"><?php esc_html_e( 'Correo electronico', 'caverna' ); ?></label>
			<input id="newsletter_email" type="email" name="newsletter_email" placeholder="<?php esc_attr_e( 'tu@email.com', 'caverna' ); ?>" autocomplete="email" required>
			<fieldset class="newsletter-interests">
				<legend><?php esc_html_e( 'Intereses', 'caverna' ); ?></legend>
				<?php foreach ( $interests as $label ) : ?>
					<label>
						<input type="checkbox" name="newsletter_interests[]" value="<?php echo esc_attr( $label ); ?>">
						<span><?php echo esc_html( $label ); ?></span>
					</label>
				<?php endforeach; ?>
			</fieldset>
			<label class="newsletter-consent">
				<input type="checkbox" name="newsletter_consent" value="1" required>
				<span><?php esc_html_e( 'Acepto recibir novedades de Caverna Radio y entiendo que puedo solicitar la baja cuando quiera.', 'caverna' ); ?></span>
			</label>
			<label class="newsletter-hp" for="newsletter_website"><?php esc_html_e( 'Sitio web', 'caverna' ); ?></label>
			<input class="newsletter-hp" id="newsletter_website" type="text" name="newsletter_website" tabindex="-1" autocomplete="off">
			<button type="submit"><?php esc_html_e( 'Registrarme', 'caverna' ); ?></button>
			<?php if ( 'ok' === $status ) : ?>
				<p class="newsletter-message"><?php esc_html_e( 'Listo, ya quedaste registrado.', 'caverna' ); ?></p>
			<?php elseif ( 'exists' === $status ) : ?>
				<p class="newsletter-message"><?php esc_html_e( 'Ese correo ya estaba registrado.', 'caverna' ); ?></p>
			<?php elseif ( $status ) : ?>
				<p class="newsletter-message newsletter-message--error"><?php esc_html_e( 'No pudimos registrar ese correo. Revisalo e intenta de nuevo.', 'caverna' ); ?></p>
			<?php endif; ?>
		</form>
	</section>
	<?php
}

/**
 * Export newsletter subscribers as CSV for administrators.
 *
 * @return void
 */
function caverna_export_newsletter_subscribers() {
	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_die( esc_html__( 'No tenes permisos para exportar suscriptores.', 'caverna' ) );
	}

	check_admin_referer( 'caverna_export_newsletter' );

	$subscribers = get_posts(
		array(
			'post_type'      => 'caverna_subscriber',
			'post_status'    => 'private',
			'posts_per_page' => -1,
			'orderby'        => 'date',
			'order'          => 'DESC',
		)
	);

	header( 'Content-Type: text/csv; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename=caverna-newsletter.csv' );

	$output = fopen( 'php://output', 'w' );
	fputcsv( $output, array( 'nombre', 'email', 'intereses', 'origen', 'consentimiento', 'fecha' ) );

	foreach ( $subscribers as $subscriber ) {
		fputcsv(
			$output,
			array(
				get_post_meta( $subscriber->ID, 'subscriber_name', true ),
				get_post_meta( $subscriber->ID, 'subscriber_email', true ),
				get_post_meta( $subscriber->ID, 'subscriber_interests', true ),
				get_post_meta( $subscriber->ID, 'subscriber_source', true ),
				get_post_meta( $subscriber->ID, 'subscriber_consent', true ),
				get_the_date( 'c', $subscriber ),
			)
		);
	}

	fclose( $output );
	exit;
}
add_action( 'admin_post_caverna_export_newsletter', 'caverna_export_newsletter_subscribers' );

/**
 * Add export action to subscriber admin.
 *
 * @return void
 */
function caverna_newsletter_admin_export_link() {
	$screen = get_current_screen();

	if ( ! $screen || 'edit-caverna_subscriber' !== $screen->id ) {
		return;
	}

	$url = wp_nonce_url( admin_url( 'admin-post.php?action=caverna_export_newsletter' ), 'caverna_export_newsletter' );
	echo '<div class="notice notice-info"><p><a class="button button-primary" href="' . esc_url( $url ) . '">' . esc_html__( 'Exportar correos CSV', 'caverna' ) . '</a></p></div>';
}
add_action( 'admin_notices', 'caverna_newsletter_admin_export_link' );

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
	$horizontal_webp = get_template_directory_uri() . '/assets/ads/publicite-aqui-horizontal.webp';
	$vertical_webp   = get_template_directory_uri() . '/assets/ads/publicite-aqui-vertical.webp';
	$class       = $is_vertical ? 'caverna-house-ad--vertical' : 'caverna-house-ad--horizontal';
	$ad_url      = caverna_advertising_url();
	$image       = sprintf(
		'<picture><source srcset="%1$s" type="image/webp"><img src="%2$s" alt="%3$s" loading="eager" decoding="async" fetchpriority="high"></picture>',
		esc_url( $horizontal_webp ),
		esc_url( $is_vertical ? $vertical : $horizontal ),
		esc_attr__( 'Publicite aqui en Caverna Radio', 'caverna' )
	);

	if ( $is_vertical ) {
		$image = sprintf(
			'<picture><source srcset="%1$s" media="(min-width: 64em)" type="image/webp"><source srcset="%2$s" media="(min-width: 64em)">%3$s</picture>',
			esc_url( $vertical_webp ),
			esc_url( $vertical ),
			sprintf(
				'<source srcset="%1$s" type="image/webp"><img src="%2$s" alt="%3$s" loading="eager" decoding="async" fetchpriority="high">',
				esc_url( $horizontal_webp ),
				esc_url( $horizontal ),
				esc_attr__( 'Publicite aqui en Caverna Radio', 'caverna' )
			)
		);
	}

	return sprintf(
		'<a class="caverna-house-ad %1$s" href="%2$s">%3$s</a>',
		esc_attr( $class ),
		esc_url( $ad_url ),
		$image
	);
}

/**
 * Estimate reading time for a post.
 *
 * @param int|null $post_id Post ID.
 * @return int
 */
function caverna_reading_time_minutes( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$content = get_post_field( 'post_content', $post_id );
	$words   = str_word_count( wp_strip_all_tags( strip_shortcodes( $content ) ) );

	return max( 1, (int) ceil( $words / 220 ) );
}

/**
 * Render estimated reading time.
 *
 * @return void
 */
function caverna_reading_time_markup() {
	printf(
		'<span class="reading-time">%s</span>',
		esc_html(
			sprintf(
				/* translators: %d: reading time in minutes. */
				_n( '%d min de lectura', '%d min de lectura', caverna_reading_time_minutes(), 'caverna' ),
				caverna_reading_time_minutes()
			)
		)
	);
}

/**
 * Render compact post metadata for cards.
 *
 * @return void
 */
function caverna_card_meta() {
	if ( 'post' !== get_post_type() ) {
		return;
	}
	?>
	<div class="card-meta">
		<?php
		$categories = get_the_category();
		if ( $categories ) :
			?>
			<a class="card-meta__category" href="<?php echo esc_url( get_category_link( $categories[0] ) ); ?>"><?php echo esc_html( $categories[0]->name ); ?></a>
		<?php endif; ?>
		<?php caverna_reading_time_markup(); ?>
	</div>
	<?php
}

/**
 * Render branded fallback when a post has no thumbnail.
 *
 * @param string $class_name Extra class name.
 * @return void
 */
function caverna_post_visual_fallback( $class_name = '' ) {
	?>
	<a class="post-visual-fallback <?php echo esc_attr( $class_name ); ?>" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
		<span><?php esc_html_e( 'Caverna Radio', 'caverna' ); ?></span>
	</a>
	<?php
}

/**
 * Get the advertising landing page URL, falling back to email.
 *
 * @return string
 */
function caverna_advertising_url() {
	$page = get_page_by_path( 'publicite-con-nosotros' );

	if ( $page instanceof WP_Post && 'publish' === $page->post_status ) {
		return get_permalink( $page );
	}

	return 'mailto:' . sanitize_email( get_option( 'admin_email' ) ) . '?subject=' . rawurlencode( __( 'Quiero publicitar en Caverna Radio', 'caverna' ) );
}

/**
 * Get a published page URL by slug.
 *
 * @param string $slug Page slug.
 * @return string
 */
function caverna_page_url( $slug ) {
	$page = get_page_by_path( $slug );

	if ( $page instanceof WP_Post && 'publish' === $page->post_status ) {
		return get_permalink( $page );
	}

	return home_url( '/' . trim( $slug, '/' ) . '/' );
}

/**
 * Get the configured advertising contact name.
 *
 * @return string
 */
function caverna_advertising_contact_name() {
	return get_theme_mod( 'caverna_ad_contact_name', 'Surco' );
}

/**
 * Get the configured advertising WhatsApp number.
 *
 * @return string
 */
function caverna_advertising_whatsapp_number() {
	return preg_replace( '/\D+/', '', get_theme_mod( 'caverna_ad_whatsapp', '5492901471028' ) );
}

/**
 * Get the configured advertising WhatsApp message.
 *
 * @return string
 */
function caverna_advertising_whatsapp_message() {
	return get_theme_mod( 'caverna_ad_whatsapp_message', 'Vengo de cavernaradio.net y quiero saber mas sobre como publicitar.' );
}

/**
 * Build WhatsApp URL for advertising inquiries.
 *
 * @return string
 */
function caverna_advertising_whatsapp_url() {
	$number  = caverna_advertising_whatsapp_number();
	$message = caverna_advertising_whatsapp_message();

	if ( ! $number ) {
		return caverna_advertising_url();
	}

	return 'https://wa.me/' . rawurlencode( $number ) . '?text=' . rawurlencode( $message );
}

/**
 * Get configured social media links.
 *
 * @return array
 */
function caverna_social_links() {
	$networks = array(
		'instagram' => __( 'Instagram', 'caverna' ),
		'facebook'  => __( 'Facebook', 'caverna' ),
		'youtube'   => __( 'YouTube', 'caverna' ),
		'tiktok'    => __( 'TikTok', 'caverna' ),
	);
	$links    = array();

	foreach ( $networks as $key => $label ) {
		$url = trim( (string) get_theme_mod( 'caverna_social_' . $key, '' ) );

		if ( $url ) {
			$links[ $key ] = array(
				'label' => $label,
				'url'   => esc_url_raw( $url ),
			);
		}
	}

	return $links;
}

/**
 * Render social links.
 *
 * @param string $class_name Wrapper class.
 * @return void
 */
function caverna_social_links_markup( $class_name = 'social-links' ) {
	$links = caverna_social_links();

	if ( ! $links ) {
		return;
	}
	?>
	<nav class="<?php echo esc_attr( $class_name ); ?>" aria-label="<?php esc_attr_e( 'Redes sociales', 'caverna' ); ?>">
		<?php foreach ( $links as $link ) : ?>
			<a href="<?php echo esc_url( $link['url'] ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $link['label'] ); ?></a>
		<?php endforeach; ?>
	</nav>
	<?php
}

/**
 * Get editable advertising package text.
 *
 * @return array
 */
function caverna_advertising_packages() {
	$default = array(
		'Web destacada|Banners en portada, notas o secciones para mantener tu marca visible mientras la audiencia navega.',
		'Radio online|Menciones, placas y presencia integrada en la transmision digital de Caverna Radio.',
		'Web + radio online|Un paquete combinado para estar presente en el sitio y reforzar el mensaje en la radio online.',
		'Campanas locales|Acciones para comercios, eventos, marcas locales y emprendimientos que necesitan llegada concreta.',
	);
	$raw     = get_theme_mod( 'caverna_ad_packages', implode( "\n", $default ) );
	$lines   = array_filter( array_map( 'trim', explode( "\n", $raw ) ) );
	$items   = array();

	foreach ( $lines as $line ) {
		$parts   = array_map( 'trim', explode( '|', $line, 2 ) );
		$items[] = array(
			'title' => $parts[0],
			'text'  => isset( $parts[1] ) ? $parts[1] : '',
		);
	}

	return $items;
}

/**
 * Print lightweight SEO and social metadata.
 *
 * @return void
 */
function caverna_seo_meta() {
	$description = get_bloginfo( 'description' );
	$title       = wp_get_document_title();
	$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '/';
	$host        = isset( $_SERVER['HTTP_HOST'] ) ? wp_unslash( $_SERVER['HTTP_HOST'] ) : wp_parse_url( home_url(), PHP_URL_HOST );
	$url         = set_url_scheme( 'http://' . $host . $request_uri );
	$image       = get_template_directory_uri() . '/assets/caverna-og.png';
	$image_width = 1200;
	$image_height = 630;
	$type        = 'website';
	$canonical   = $url;
	$schemas     = array();

	if ( is_singular() ) {
		$post = get_queried_object();
		if ( $post instanceof WP_Post ) {
			$description = has_excerpt( $post ) ? get_the_excerpt( $post ) : wp_trim_words( wp_strip_all_tags( $post->post_content ), 28 );
			$url         = get_permalink( $post );
			$canonical   = $url;
			$type        = 'post' === get_post_type( $post ) ? 'article' : 'website';
			if ( has_post_thumbnail( $post ) ) {
				$thumbnail_id = get_post_thumbnail_id( $post );
				$image_data   = wp_get_attachment_image_src( $thumbnail_id, 'caverna-wide' );
				if ( $image_data ) {
					$image        = $image_data[0];
					$image_width  = (int) $image_data[1];
					$image_height = (int) $image_data[2];
				}
			}

			if ( 'post' === get_post_type( $post ) ) {
				$schemas[] = array(
					'@context'         => 'https://schema.org',
					'@type'            => 'Article',
					'headline'         => get_the_title( $post ),
					'description'      => wp_trim_words( wp_strip_all_tags( $description ), 32 ),
					'url'              => $url,
					'image'            => $image,
					'datePublished'    => get_the_date( DATE_W3C, $post ),
					'dateModified'     => get_the_modified_date( DATE_W3C, $post ),
					'author'           => array(
						'@type' => 'Person',
						'name'  => get_the_author_meta( 'display_name', (int) $post->post_author ),
					),
					'publisher'        => array(
						'@type' => 'NewsMediaOrganization',
						'name'  => get_bloginfo( 'name' ),
						'url'   => home_url( '/' ),
						'logo'  => array(
							'@type' => 'ImageObject',
							'url'   => caverna_optimized_logo_url( '320' ),
						),
					),
					'mainEntityOfPage' => array(
						'@type' => 'WebPage',
						'@id'   => $url,
					),
				);
			}
		}
	} elseif ( is_archive() ) {
		$description = wp_strip_all_tags( get_the_archive_description() );
		if ( ! $description ) {
			$description = sprintf( __( 'Notas, cultura y contenidos independientes de %s.', 'caverna' ), get_bloginfo( 'name' ) );
		}
		if ( is_category() || is_tag() || is_tax() ) {
			$term_link = get_term_link( get_queried_object() );
			if ( ! is_wp_error( $term_link ) ) {
				$canonical = $term_link;
			}
		}
	} elseif ( is_search() ) {
		$description = sprintf( __( 'Resultados de busqueda en %s.', 'caverna' ), get_bloginfo( 'name' ) );
		$canonical   = get_search_link();
	}

	$description = $description ? $description : 'Caverna Radio: comunicacion alternativa desde Ushuaia. Noticias, cultura, cannabis, podcasts y contenidos independientes.';
	$social_links = caverna_social_links();
	$organization = array(
		'@context' => 'https://schema.org',
		'@type'    => 'NewsMediaOrganization',
		'name'     => get_bloginfo( 'name' ),
		'url'      => home_url( '/' ),
		'logo'     => array(
			'@type' => 'ImageObject',
			'url'   => caverna_optimized_logo_url( '320' ),
		),
	);

	if ( $social_links ) {
		$organization['sameAs'] = wp_list_pluck( $social_links, 'url' );
	}

	$schemas[] = $organization;
	$schemas[] = array(
		'@context'        => 'https://schema.org',
		'@type'           => 'WebSite',
		'name'            => get_bloginfo( 'name' ),
		'url'             => home_url( '/' ),
		'potentialAction' => array(
			'@type'       => 'SearchAction',
			'target'      => home_url( '/?s={search_term_string}' ),
			'query-input' => 'required name=search_term_string',
		),
	);

	if ( ! is_front_page() ) {
		$schemas[] = caverna_breadcrumb_schema();
	}
	?>
	<meta name="description" content="<?php echo esc_attr( wp_trim_words( wp_strip_all_tags( $description ), 32 ) ); ?>">
	<link rel="canonical" href="<?php echo esc_url( $canonical ); ?>">
	<meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( wp_trim_words( wp_strip_all_tags( $description ), 32 ) ); ?>">
	<meta property="og:type" content="<?php echo esc_attr( $type ); ?>">
	<meta property="og:url" content="<?php echo esc_url( $url ); ?>">
	<meta property="og:image" content="<?php echo esc_url( $image ); ?>">
	<meta property="og:image:width" content="<?php echo esc_attr( (string) $image_width ); ?>">
	<meta property="og:image:height" content="<?php echo esc_attr( (string) $image_height ); ?>">
	<meta property="og:image:alt" content="<?php echo esc_attr( $title ); ?>">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?php echo esc_attr( $title ); ?>">
	<meta name="twitter:description" content="<?php echo esc_attr( wp_trim_words( wp_strip_all_tags( $description ), 32 ) ); ?>">
	<meta name="twitter:image" content="<?php echo esc_url( $image ); ?>">
	<?php if ( is_search() ) : ?>
		<meta name="robots" content="noindex,follow">
	<?php endif; ?>
	<script type="application/ld+json"><?php echo wp_json_encode( $schemas, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>
	<?php
}
add_action( 'wp_head', 'caverna_seo_meta', 4 );

/**
 * Build a compact BreadcrumbList schema.
 *
 * @return array
 */
function caverna_breadcrumb_schema() {
	$items = array(
		array(
			'@type'    => 'ListItem',
			'position' => 1,
			'name'     => __( 'Inicio', 'caverna' ),
			'item'     => home_url( '/' ),
		),
	);

	if ( is_singular() ) {
		$post = get_queried_object();
		if ( $post instanceof WP_Post && 'post' === get_post_type( $post ) ) {
			$categories = get_the_category( $post->ID );
			if ( $categories ) {
				$items[] = array(
					'@type'    => 'ListItem',
					'position' => count( $items ) + 1,
					'name'     => $categories[0]->name,
					'item'     => get_category_link( $categories[0] ),
				);
			}
		}

		$items[] = array(
			'@type'    => 'ListItem',
			'position' => count( $items ) + 1,
			'name'     => get_the_title(),
			'item'     => get_permalink(),
		);
	} elseif ( is_archive() ) {
		$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '/';
		$host        = isset( $_SERVER['HTTP_HOST'] ) ? wp_unslash( $_SERVER['HTTP_HOST'] ) : wp_parse_url( home_url(), PHP_URL_HOST );
		$archive_url = set_url_scheme( 'http://' . $host . $request_uri );
		if ( is_category() || is_tag() || is_tax() ) {
			$term_link = get_term_link( get_queried_object() );
			if ( ! is_wp_error( $term_link ) ) {
				$archive_url = $term_link;
			}
		}
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => 2,
			'name'     => wp_strip_all_tags( get_the_archive_title() ),
			'item'     => $archive_url,
		);
	} elseif ( is_search() ) {
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => 2,
			'name'     => sprintf( __( 'Busqueda: %s', 'caverna' ), get_search_query() ),
			'item'     => get_search_link(),
		);
	}

	return array(
		'@context'        => 'https://schema.org',
		'@type'           => 'BreadcrumbList',
		'itemListElement' => $items,
	);
}

/**
 * Keep the primary menu concise when default/sample pages are present.
 *
 * @param array  $items Menu items.
 * @param object $args  Menu args.
 * @return array
 */
function caverna_clean_primary_menu_items( $items, $args ) {
	if ( empty( $args->theme_location ) || 'menu-1' !== $args->theme_location ) {
		return $items;
	}

	return array_values(
		array_filter(
			$items,
			function ( $item ) {
				$path = trim( (string) wp_parse_url( $item->url, PHP_URL_PATH ), '/' );
				if ( false !== strpos( $path, 'pagina-ejemplo' ) || false !== strpos( $path, 'sample-page' ) ) {
					return false;
				}

				if ( false !== stripos( $item->title, 'Publicite con nosotros' ) ) {
					$item->title = __( 'Publicite', 'caverna' );
				}

				return true;
			}
		)
	);
}
add_filter( 'wp_nav_menu_objects', 'caverna_clean_primary_menu_items', 10, 2 );

/**
 * Render a compact primary menu when no WordPress menu is assigned.
 *
 * @return void
 */
function caverna_primary_menu_fallback() {
	?>
	<ul id="primary-menu" class="menu">
		<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Inicio', 'caverna' ); ?></a></li>
		<li><a href="<?php echo esc_url( caverna_page_url( 'sobre-nosotros' ) ); ?>"><?php esc_html_e( 'Sobre nosotros', 'caverna' ); ?></a></li>
		<li><a href="<?php echo esc_url( caverna_advertising_url() ); ?>"><?php esc_html_e( 'Publicite', 'caverna' ); ?></a></li>
		<li><a href="<?php echo esc_url( caverna_page_url( 'contacto' ) ); ?>"><?php esc_html_e( 'Contacto', 'caverna' ); ?></a></li>
	</ul>
	<?php
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

