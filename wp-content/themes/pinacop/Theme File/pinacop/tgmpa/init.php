<?php
/**
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage GP Pinacop
 * @version    2.6.1 for parent theme GP Pinacop for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */

require get_parent_theme_file_path( '/tgmpa/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'pinacop_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 */
function pinacop_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// Pinacop Essential Plugin
		array(
			'name'				=> esc_attr__( 'Pinacop Essential', 'pinacop' ),
			'slug'				=> 'pinacop-ess',
			'source'			=> get_template_directory() . '/tgmpa/plugins/pinacop-ess.zip',
			'required'			=> true,
			'version'			=> '1.0.0',
		),

		// Revslider
		array(
			'name'				=> esc_attr__( 'Revslider', 'pinacop' ),
			'slug'				=> 'revslider',
			'source'			=> get_template_directory() . '/tgmpa/plugins/revslider.zip',
			'required'			=> true,
			'version'			=> '5.4.5.1',
		),	

		// On Click Demo Impoter
		array(
			'name'				=> esc_attr__( 'Pinacop Demo Import', 'pinacop' ),
			'slug'				=> 'pinacop-demo-import',
			'source'			=> get_template_directory() . '/tgmpa/plugins/pinacop-demo-importer.zip',
			'required'			=> true,
		),

		// Visual Composer
		array(
			'name'			=> esc_attr__( 'Visual Composer', 'pinacop' ),
			'slug'			=> 'js_composer',
			'source'		=> get_template_directory() . '/tgmpa/plugins/js_composer.zip',
			'required'		=> true,			
		),

		// Contact Form 7
		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => true,
		),

		// WP Post Views
		array(
			'name'		=> 'WP-PostViews',
			'slug'		=> 'wp-postviews',
			'required'	=> false,
		),

	);

	/*
	 * Config for TGMPA
	 */
	$config = array(
		'id'			=> 'pinacop',
		'default_path'	=> '',
		'menu'			=> 'pinacop-install-plugins',
		'has_notices'	=> true,
		'dismissable'	=> true,
		'dismiss_msg'	=> '',
		'is_automatic'	=> false,
		'message'		=> '',
	);

	tgmpa( $plugins, $config );
}
