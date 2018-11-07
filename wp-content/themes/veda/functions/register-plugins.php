<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Veda for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once VEDA_THEME_DIR . '/functions/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'veda_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function veda_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'     				=> esc_html__('Visual Composer', 'veda'),
			'slug'     				=> 'js_composer',
			'source'   				=> esc_url('https://s3.amazonaws.com/wedesignthemes/plugins/visual-composer/5.5.4/js_composer.zip'),
			'version' 				=> '5.5.4',
			'required' 				=> true,
			'force_activation' 		=> true,
			'force_deactivation' 	=> false,
		),

		array(
			'name'     				=> esc_html__('Ultimate Addons for Visual Composer', 'veda'),
			'slug'     				=> 'Ultimate_VC_Addons',
			'source'   				=> esc_url('https://s3.amazonaws.com/wedesignthemes/plugins/ultimate_vc_addon/3.16.26/Ultimate_VC_Addons.zip
'),
			'version' 				=> '3.16.26',
			'required' 				=> false,
		),

		array(
			'name'     				=> esc_html__('Layer Slider', 'veda'),
			'slug'     				=> 'LayerSlider',
			'source'   				=> esc_url('https://s3.amazonaws.com/wedesignthemes/plugins/layer-slider/6.7.6/LayerSlider.zip'),
			'version' 				=> '6.7.6',
		),

		array(
			'name'     				=> esc_html__('Revolution Slider', 'veda'),
			'slug'     				=> 'revslider',
			'source'   				=> esc_url('https://s3.amazonaws.com/wedesignthemes/plugins/revolution-slider/5.4.8/revslider.zip'),
			'version' 				=> '5.4.8',
		),

		array(
			'name'     				=> esc_html__('Responsive Google Maps', 'veda'),
			'slug'     				=> 'responsive-maps-plugin',
			'source'   				=> esc_url('https://s3.amazonaws.com/wedesignthemes/plugins/responsive-maps/4.5/responsive-maps-plugin.zip'),
			'version' 				=> '4.5',
		),

		array(
			'name'     				=> esc_html__('DesignThemes Core Features Plugin', 'veda'),
			'slug'     				=> 'designthemes-core-features',
			'source'   				=> esc_url('https://s3.amazonaws.com/wedesignthemes/veda/designthemes-core-features.zip'),
			'required' 				=> true,
			'version' 				=> '2.1',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
		),
		
		array(
			'name'     				=> esc_html__('Veda Demo Importer', 'veda'),
			'slug'     				=> 'veda-demo-importer',
			'source'   				=> esc_url('https://s3.amazonaws.com/wedesignthemes/veda/veda-demo-importer.zip'),
			'required' 				=> false,
			'version' 				=> '2.2',
		),

		array(
			'name'     				=> esc_html__('DesignThemes Attorney Add-on', 'veda'),
			'slug'     				=> 'designthemes-attorney-addon',
			'source'   				=> esc_url('https://s3.amazonaws.com/wedesignthemes/veda/designthemes-attorney-addon.zip'),
			'required' 				=> false,
			'version' 				=> '1.3',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
		),

		array(
			'name'     				=> esc_html__('DesignThemes Doctor Add-on', 'veda'),
			'slug'     				=> 'designthemes-doctor-addon',
			'source'   				=> esc_url('https://s3.amazonaws.com/wedesignthemes/veda/designthemes-doctor-addon.zip'),
			'required' 				=> false,
			'version' 				=> '1.2',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
		),

		array(
			'name'     				=> esc_html__('DesignThemes Event ( Night club ) Add-on', 'veda'),
			'slug'     				=> 'designthemes-event-addon',
			'source'   				=> esc_url('https://s3.amazonaws.com/wedesignthemes/veda/designthemes-event-addon.zip'),
			'required' 				=> false,
			'version' 				=> '1.3',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
		),

		array(
			'name'     				=> esc_html__('DesignThemes Model Add-on', 'veda'),
			'slug'     				=> 'designthemes-model-addon',
			'source'   				=> esc_url('https://s3.amazonaws.com/wedesignthemes/veda/designthemes-model-addon.zip'),
			'required' 				=> false,
			'version' 				=> '1.1',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
		),

		array(
			'name'     				=> esc_html__('DesignThemes Program( Fitness ) Add-on', 'veda'),
			'slug'     				=> 'designthemes-program-addon',
			'source'   				=> esc_url('https://s3.amazonaws.com/wedesignthemes/veda/designthemes-program-addon.zip'),
			'required' 				=> false,
			'version' 				=> '1.2',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
		),

		array(
			'name'     				=> esc_html__('DesignThemes Restaurant Add-on', 'veda'),
			'slug'     				=> 'designthemes-restaurant-addon',
			'source'   				=> esc_url('https://s3.amazonaws.com/wedesignthemes/veda/designthemes-restaurant-addon.zip'),
			'required' 				=> false,
			'version' 				=> '1.1',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
		),

		array(
			'name'     				=> esc_html__('DesignThemes Rooms( Hotel ) Add-on', 'veda'),
			'slug'     				=> 'designthemes-rooms-addon',
			'source'   				=> esc_url('https://s3.amazonaws.com/wedesignthemes/veda/designthemes-rooms-addon.zip'),
			'required' 				=> false,
			'version' 				=> '1.2',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
		),

		array(
			'name'     				=> esc_html__('DesignThemes University Add-on', 'veda'),
			'slug'     				=> 'designthemes-university-addon',
			'source'   				=> esc_url('https://s3.amazonaws.com/wedesignthemes/veda/designthemes-university-addon.zip'),
			'required' 				=> false,
			'version' 				=> '1.1',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
		),

		array(
			'name'     				=> esc_html__('DesignThemes Yoga Add-on', 'veda'),
			'slug'     				=> 'designthemes-yoga-addon',
			'source'   				=> esc_url('https://s3.amazonaws.com/wedesignthemes/veda/designthemes-yoga-addon.zip'),
			'required' 				=> false,
			'version' 				=> '1.0',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
		),

		array(
			'name' 					=> esc_html__('Contact Form 7', 'veda'),
			'slug' 					=> 'contact-form-7',
			'required' 				=> false,
		),

		array(
			'name' 					=> esc_html__('WooCommerce - excelling eCommerce', 'veda'),
			'slug' 					=> 'woocommerce',
			'required' 				=> false,
		),

		array(
			'name' 					=> esc_html__('The Events Calendar', 'veda'),
			'slug' 					=> 'the-events-calendar',
			'required'			 	=> false,
		),				

		array(
			'name'					=> esc_html__('Envato Market', 'veda'),
			'slug'					=> 'envato-market',
			'source'				=> esc_url('https://github.com/envato/wp-envato-market/archive/master.zip')
		)	
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'veda',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}?>