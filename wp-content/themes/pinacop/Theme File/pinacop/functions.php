<?php

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pinacop_setup() {
	/*
	 * Make theme available for translation.
	 * If you're building a theme based on Pinacop, use a find and replace
	 * to change 'Pinacop' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'pinacop', get_template_directory() . '/languages' );

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

	add_image_size( 'pinacop-featured-image', 920, 500, true );
	add_image_size( 'pinacop-blog-thumb', 480, 280, true );
	add_image_size( 'pinacop-blog-thumb-two', 920, 500, true );	
	add_image_size( 'pinacop-image-box', 350, 250, true );
	add_image_size( 'pinacop-icon-image', 75, 55, true );


	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'main_menu'			=> esc_html__( 'Primary Menu', 'pinacop' ),
		'side_menu'			=> esc_html__( 'Mobile Menu', 'pinacop' ),
	) );

	
	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 150,
		'height'      => 50,
		'flex-width'  => true,
	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );


	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	if ( ! isset( $content_width ) ) $content_width = 900;

}


add_action( 'after_setup_theme', 'pinacop_setup' );


define( 'GP_PINACOP_PATH', get_template_directory() );
define( 'GP_PINACOP_URL',  get_template_directory_uri() );




/**
* SVG Support.
*/
function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


function pinacop_menu_body_classes($classes) {
	if (!is_home() && !is_front_page()) {
		$classes[] = 'menu-block';  
	} 

	return $classes;
}

//add_filter('body_class', 'pinacop_menu_body_classes');


// Filter to replace default css class names for vc_row shortcode and vc_column

function custom_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {
	if ( $tag == 'vc_row' || $tag == 'vc_row_inner' ) {
    $class_string = str_replace( 'vc_row-fluid', 'vc-row-wrapper', $class_string ); // This will replace "vc_row-fluid" with "my_row-fluid"
}

  return $class_string; // Important: you should always return modified or original $class_string
}

add_filter( 'vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2 );

if (!function_exists('pinacop_shop_columns_changee')) {
	function pinacop_shop_columns_changee() {
		if ( ! is_active_sidebar( 'sidebar-10' ) ) {
			return 3;
		} else {
			return 4;
		}
	}
}

add_filter('loop_shop_colums', 'pinacop_shop_columns_changee');


function pinacop_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Roboto, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$montserrat = _x( 'on', 'Montserrat font: on or off', 'pinacop' );
	$raleway = _x( 'on', 'Raleway font: on or off', 'pinacop' );
	$worksance = _x( 'on', 'Work+Sans font: on or off', 'pinacop' );
	$playfairdisplay = _x( 'on', 'Work+Sans font: on or off', 'pinacop' );

	$font_families = array();
	if ( 'off' !== $montserrat ) {


		$font_families[] = 'Montserrat:100,300,400,500,600,700,800';


	}
	if ( 'off' !== $raleway ) {


		$font_families[] = 'Raleway:100,300,400,500,600,700,800';


	}
	if ( 'off' !== $worksance ) {


		$font_families[] = 'Work+Sans:300,400,500,600,700,800,900';


	}
	if ( 'off' !== $playfairdisplay ) {


		$font_families[] = 'Playfair+Display:400,700,900';


	}

	$body_font    = cs_get_option( 'body-font' );
	if (! empty($body_font['family'])) {
		$font_families[] = $body_font['family'];
	}
	$heading_font = cs_get_option( 'heading-font' );

	if (! empty($heading_font['family'])) {
		$font_families[] = $heading_font['family'];
	}

	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);

	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles.
 */
function pinacop_scripts() {
	require_once get_parent_theme_file_path( "/inc/script.php" );
}
add_action( 'wp_enqueue_scripts', 'pinacop_scripts' );


/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function pinacop_admin_style() {
	wp_register_style( 'dt-icons', get_template_directory_uri() . '/assets/dependencies/dt-icons/styles.css', false, '1.0.0' );
	wp_register_style( 'et-icons', get_template_directory_uri() . '/assets/dependencies/etlinefont-bower/style.css', false, '1.0.0' );
	wp_register_style( 'vc', get_template_directory_uri() . '/assets/css/admin-panel.css', false, '1.0.0' );
	wp_register_style( 'vc_icon', get_template_directory_uri() . '/assets/css/flaticon.css', false, '1.0.0' );
	wp_register_style( 'gp-icons', get_template_directory_uri() . '/assets/css/hody-icons.css', false, '1.0.0' );
	wp_enqueue_style( 'dt-icons' );
	wp_enqueue_style( 'et-icons' );
	wp_enqueue_style( 'vc' );
	wp_enqueue_style( 'vc_icon' );
	wp_enqueue_style( 'gp-icons' );
}
add_action( 'admin_enqueue_scripts', 'pinacop_admin_style' );


/*
* This theme styles the visual editor to resemble the theme style,
* specifically font, colors, icons, and column width.
*/

add_editor_style( array( 'assets/css/editor-style.css' ) );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function pinacop_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'pinacop' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'pinacop' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'pinacop' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'pinacop' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'pinacop' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'pinacop' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'pinacop' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'pinacop' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'pinacop' ),
		'id'            => 'sidebar-5',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'pinacop' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'pinacop_widgets_init' );


defined( 'CS_OPTION' )     or  define( 'CS_OPTION',     '_cs_options' );

/**
 *
 * Get option
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_get_option' ) ) {
	function cs_get_option( $option_name = '', $default = '' ) {

		$options = apply_filters( 'cs_get_option', get_option( CS_OPTION ), $option_name, $default );

		if( ! empty( $option_name ) && ! empty( $options[$option_name] ) ) {
			return $options[$option_name];
		} else {
			return ( ! empty( $default ) ) ? $default : null;
		}

		

	}


}



/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Load breadcrumbs
 */
require get_parent_theme_file_path( '/inc/dimox_breadcrumbs.php' );

#helpers
require get_parent_theme_file_path().'/inc/helpers.php';

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * Customizer TGMPA.
 */
require get_parent_theme_file_path( '/tgmpa/init.php' );