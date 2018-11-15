<?php
/**
 * Corpo: Customizer
 *
 * @package WordPress
 * @subpackage Pinacop
 * @since 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pinacop_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'pinacop_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'pinacop_customize_partial_blogdescription',
	) );


	/**
	 * Header options.
	 */
	$wp_customize->add_section( 'pinacop_header_options', array(
		'title'    => esc_html__( 'Header Settings', 'pinacop' ),
		'priority' => 45, // After colors
	) );

	/**
	 * Mailchimp.
	 */
	$wp_customize->add_panel( 'pinacop_mailchimp_setting', array(
		'title'    => esc_html__( 'Mailchimp Settings', 'pinacop' ),
		'priority' => 45, // After colors
	) );


	// Search Icon Settings
	$wp_customize->add_setting( 'header_menu_search', array(
		'default'			=> true,
		'transport'         => 'refresh',
		'sanitize_callback'	=> 'pinacop_sanitize_checkbox'
	) );

	/**
	 * Footer Panel
	 */
	$column_classes = array(
		'col-md-1' => '1/12',
		'col-md-2' => '2/12',
		'col-md-3' => '3/12',
		'col-md-4' => '4/12',
		'col-md-5' => '5/12',
		'col-md-6' => '6/12',
		'col-md-7' => '7/12',
		'col-md-8' => '8/12',
		'col-md-9' => '9/12',
		'col-md-10' => '10/12',
		'col-md-11' => '11/12',
		'col-md-12' => '12/12'
	);
	$wp_customize->add_panel( 'pinacop_footer_settings', array(
		'title' => esc_html__( 'Footer Settings', 'pinacop' ),
		'description' => esc_html__( 'Manage your footer widget position sizes and Copyright information.', 'pinacop' ), // Include html tags such as <p>.
		'priority' => 160, // Mixed with top-level-section hierarchy.
	) );

	// Widget Settings
	for ($i=1; $i < 5; $i++) { 
		$wp_customize->add_section( 'pinacop_widget_area_' . $i , array(
			'title' => 'Widget Area - '. $i,
			'panel' => 'pinacop_footer_settings',
		) );
		$wp_customize->add_setting( 'pinacop_widget_area_' . $i . '_display', array(
			'default'			=> true,
			'transport'         => 'refresh',
			'sanitize_callback' => 'pinacop_sanitize_checkbox',
		) );
		$wp_customize->add_control( 'pinacop_widget_area_' . $i . '_display', array(
			'label'       => esc_html__( 'Display on site', 'pinacop' ),
			'section'     => 'pinacop_widget_area_'. $i,
			'type'        => 'checkbox',
		) );
		$wp_customize->add_setting( 'pinacop_widget_area_' . $i . '_column', array(
			'default'           => 'col-md-4',
			'transport'         => 'refresh',
			'sanitize_callback' => 'pinacop_sanitize_widget_columns',
		) );
		$wp_customize->add_control( 'pinacop_widget_area_' . $i . '_column' , array(
			'label'       => esc_html__( 'Header Style', 'pinacop' ),
			'section'     => 'pinacop_widget_area_'. $i,
			'type'        => 'select',
			'choices'     => $column_classes
		) );
	}

	// Copyright Text
	$wp_customize->add_section( 'pinacop_footer_copy_area' , array(
		'title' => esc_html__( "Copyright Text", 'pinacop' ),
		'panel' => 'pinacop_footer_settings',
	) );

	$wp_customize->add_setting( 'pinacop_footer_copy_text', array(
		'transport'			=> 'postMessage',
		'sanitize_callback' => 'pinacop_sanitize_footer_copyright',
	) );

	$wp_customize->add_control( 'pinacop_footer_copy_text', array(
		'label'       => esc_html__( 'Text', 'pinacop' ),
		'section'     => 'pinacop_footer_copy_area',
		'type'        => 'textarea',
	) );

	/**
	 * Mailchimp API
	 */
	$wp_customize->add_section( 'pinacop_mchimp_api_settings', array(
		'title' => esc_html__( 'MailChimp API', 'pinacop' ),
		'panel' => 'pinacop_mailchimp_setting',
	) );

	$wp_customize->add_setting( 'pinacop_mailchimp_api_key', array(
		'transport'			=> 'postMessage',
		'sanitize_callback'	=> 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'pinacop_mailchimp_api_key', array(
		'type'		=> 'text',
		'label'		=> esc_html__( 'API Key', 'pinacop' ),
		'description'	=> esc_html__( 'Enter the mailchimp api key to use newsletter form. You can get the api here: https://goo.gl/CLVr2h', 'pinacop' ),
		'section'	=> 'pinacop_mchimp_api_settings',
	) );

	$wp_customize->add_setting( 'pinacop_mailchimp_api_list', array(
		'transport'			=> 'postMessage',
		'sanitize_callback'	=> 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'pinacop_mailchimp_api_list', array(
		'type'		=> 'text',
		'label'		=> esc_html__( 'List ID', 'pinacop' ),
		'description'	=> esc_html__( 'Enter the mailchimp list id. You can found list here: https://goo.gl/DjFj7p', 'pinacop' ),
		'section'	=> 'pinacop_mchimp_api_settings',
	) );

	
}
add_action( 'customize_register', 'pinacop_customize_register' );



/**
 * Sanitize the widget columns.
 */
function pinacop_sanitize_widget_columns( $input ) {
	$valid = array(
		'col-md-1',
		'col-md-2',
		'col-md-3',
		'col-md-4',
		'col-md-5',
		'col-md-6',
		'col-md-7',
		'col-md-8',
		'col-md-9',
		'col-md-10',
		'col-md-11',
		'col-md-12'
	);

	if ( in_array( $input, $valid ) ) {
		return $input;
	}

	return 'col-md-3';
}

/**
 * Sanitize the checkbox
 */
function pinacop_sanitize_checkbox( $input ) {
	if ( $input == true ) {
		return true;
	}

	return false;
}

/**
 * Sanitize the footer copyright text.
 */
function pinacop_sanitize_footer_copyright( $input ) {
	$output = '';
	if ( ! empty( $input ) ) {
		$output = $input;
	} else {
		$output = sprintf(
				esc_html__( '&copy; %1$s %2$s - Designed by %3$s', 'pinacop' ),
				date( 'Y' ),
				get_bloginfo( 'name' ),
				'<a href="' . esc_url( 'https://www.gpthemes.co/' ) . '">' . esc_html__( 'GP Themes', 'pinacop' ) . '</a>'
			);
	}

	return $output;
}


/**
 * Render the site title for the selective refresh partial.
 *
 * @since Pinacop 1.0
 * @see gp_pinacop_customize_register()
 *
 * @return void
 */
function pinacop_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Pinacop 1.0
 * @see pinacop_customize_register()
 *
 * @return void
 */
function pinacop_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function pinacop_customize_preview_js() {
	wp_enqueue_script( 'pinacop-customize-preview', get_parent_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'jquery', 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'pinacop_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function pinacop_panels_js() {
	wp_enqueue_script( 'pinacop-customize-controls', get_parent_theme_file_uri( '/assets/js/customize-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'pinacop_panels_js' );