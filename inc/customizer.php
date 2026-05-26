<?php
/**
 * caverna Theme Customizer
 *
 * @package caverna
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function caverna_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_section(
		'caverna_ads',
		array(
			'title'    => __( 'Publicidad', 'caverna' ),
			'priority' => 130,
		)
	);

	$wp_customize->add_setting(
		'caverna_ad_contact_name',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => 'Surco',
		)
	);
	$wp_customize->add_control(
		'caverna_ad_contact_name',
		array(
			'label'       => __( 'Nombre de contacto comercial', 'caverna' ),
			'section'     => 'caverna_ads',
			'type'        => 'text',
			'description' => __( 'Ejemplo: Surco.', 'caverna' ),
		)
	);

	$wp_customize->add_setting(
		'caverna_ad_whatsapp',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => '5492901471028',
		)
	);
	$wp_customize->add_control(
		'caverna_ad_whatsapp',
		array(
			'label'       => __( 'WhatsApp publicidad', 'caverna' ),
			'section'     => 'caverna_ads',
			'type'        => 'text',
			'description' => __( 'Usar formato internacional sin +. Ejemplo: 5492901471028.', 'caverna' ),
		)
	);

	$wp_customize->add_setting(
		'caverna_ad_whatsapp_message',
		array(
			'sanitize_callback' => 'sanitize_textarea_field',
			'default'           => 'Vengo de cavernaradio.net y quiero saber mas sobre como publicitar.',
		)
	);
	$wp_customize->add_control(
		'caverna_ad_whatsapp_message',
		array(
			'label'       => __( 'Mensaje inicial de WhatsApp', 'caverna' ),
			'section'     => 'caverna_ads',
			'type'        => 'textarea',
			'description' => __( 'Este mensaje se carga automaticamente cuando alguien consulta por publicidad.', 'caverna' ),
		)
	);

	$wp_customize->add_setting(
		'caverna_ad_packages',
		array(
			'sanitize_callback' => 'sanitize_textarea_field',
			'default'           => "Web destacada|Banners en portada, notas o secciones para mantener tu marca visible mientras la audiencia navega.\nRadio online|Menciones, placas y presencia integrada en la transmision digital de Caverna Radio.\nWeb + radio online|Un paquete combinado para estar presente en el sitio y reforzar el mensaje en la radio online.\nCampanas locales|Acciones para comercios, eventos, marcas locales y emprendimientos que necesitan llegada concreta.",
		)
	);
	$wp_customize->add_control(
		'caverna_ad_packages',
		array(
			'label'       => __( 'Paquetes comerciales', 'caverna' ),
			'section'     => 'caverna_ads',
			'type'        => 'textarea',
			'description' => __( 'Un paquete por linea. Formato: Titulo|Descripcion.', 'caverna' ),
		)
	);

	$wp_customize->add_setting(
		'caverna_header_ad_code',
		array(
			'sanitize_callback' => 'caverna_sanitize_ad_code',
			'default'           => '',
		)
	);
	$wp_customize->add_control(
		'caverna_header_ad_code',
		array(
			'label'       => __( 'Banner Header (HTML/Ad code)', 'caverna' ),
			'section'     => 'caverna_ads',
			'type'        => 'textarea',
			'description' => __( 'Recomendado 728x90. Se muestra debajo del menu.', 'caverna' ),
		)
	);

	$wp_customize->add_setting(
		'caverna_header_ad_own',
		array(
			'sanitize_callback' => 'caverna_sanitize_ad_code',
			'default'           => '',
		)
	);
	$wp_customize->add_control(
		'caverna_header_ad_own',
		array(
			'label'       => __( 'Banner Header (Publicidad propia)', 'caverna' ),
			'section'     => 'caverna_ads',
			'type'        => 'textarea',
			'description' => __( 'HTML propio. Se alterna con AdSense si ambos existen.', 'caverna' ),
		)
	);

	$wp_customize->add_setting(
		'caverna_home_leaderboard_ad',
		array(
			'sanitize_callback' => 'caverna_sanitize_ad_code',
			'default'           => '',
		)
	);
	$wp_customize->add_control(
		'caverna_home_leaderboard_ad',
		array(
			'label'       => __( 'Home - Banner antes de Ultimas', 'caverna' ),
			'section'     => 'caverna_ads',
			'type'        => 'textarea',
			'description' => __( 'Recomendado 728x90.', 'caverna' ),
		)
	);

	$wp_customize->add_setting(
		'caverna_home_leaderboard_ad_own',
		array(
			'sanitize_callback' => 'caverna_sanitize_ad_code',
			'default'           => '',
		)
	);
	$wp_customize->add_control(
		'caverna_home_leaderboard_ad_own',
		array(
			'label'       => __( 'Home - Banner antes de Ultimas (Publicidad propia)', 'caverna' ),
			'section'     => 'caverna_ads',
			'type'        => 'textarea',
			'description' => __( 'HTML propio. Se alterna con AdSense si ambos existen.', 'caverna' ),
		)
	);

	$wp_customize->add_setting(
		'caverna_home_inline_ad',
		array(
			'sanitize_callback' => 'caverna_sanitize_ad_code',
			'default'           => '',
		)
	);
	$wp_customize->add_control(
		'caverna_home_inline_ad',
		array(
			'label'       => __( 'Home - Banner dentro de Ultimas', 'caverna' ),
			'section'     => 'caverna_ads',
			'type'        => 'textarea',
			'description' => __( 'Recomendado 728x90 o 970x90.', 'caverna' ),
		)
	);

	$wp_customize->add_setting(
		'caverna_home_inline_ad_own',
		array(
			'sanitize_callback' => 'caverna_sanitize_ad_code',
			'default'           => '',
		)
	);
	$wp_customize->add_control(
		'caverna_home_inline_ad_own',
		array(
			'label'       => __( 'Home - Banner dentro de Ultimas (Publicidad propia)', 'caverna' ),
			'section'     => 'caverna_ads',
			'type'        => 'textarea',
			'description' => __( 'HTML propio. Se alterna con AdSense si ambos existen.', 'caverna' ),
		)
	);

	$wp_customize->add_setting(
		'caverna_sidebar_ad',
		array(
			'sanitize_callback' => 'caverna_sanitize_ad_code',
			'default'           => '',
		)
	);
	$wp_customize->add_control(
		'caverna_sidebar_ad',
		array(
			'label'       => __( 'Sidebar - Rectangulo', 'caverna' ),
			'section'     => 'caverna_ads',
			'type'        => 'textarea',
			'description' => __( 'Recomendado 300x250 o 300x600.', 'caverna' ),
		)
	);

	$wp_customize->add_setting(
		'caverna_sidebar_ad_own',
		array(
			'sanitize_callback' => 'caverna_sanitize_ad_code',
			'default'           => '',
		)
	);
	$wp_customize->add_control(
		'caverna_sidebar_ad_own',
		array(
			'label'       => __( 'Sidebar - Rectangulo (Publicidad propia)', 'caverna' ),
			'section'     => 'caverna_ads',
			'type'        => 'textarea',
			'description' => __( 'HTML propio. Se alterna con AdSense si ambos existen.', 'caverna' ),
		)
	);

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'caverna_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'caverna_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'caverna_customize_register' );

/**
 * Sanitize ad code allowing full HTML for trusted users.
 *
 * @param string $input Ad code.
 * @return string
 */
function caverna_sanitize_ad_code( $input ) {
	if ( current_user_can( 'unfiltered_html' ) ) {
		return $input;
	}

	return wp_kses_post( $input );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function caverna_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function caverna_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function caverna_customize_preview_js() {
	wp_enqueue_script( 'caverna-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'caverna_customize_preview_js' );
