<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Register and enqueue static files and dependencies
 */




wp_enqueue_style( 'pinacop-fonts', pinacop_fonts_url(), array(), null );

/**
 * Register all dependencies scripts and css
 */

// Bootstrap
wp_register_script(
	'bootstrap',
	get_parent_theme_file_uri('/assets/dependencies/bootstrap/js/bootstrap.min.js'),
	array('jquery'),
	'3.3.7',
	true
);
wp_register_style(
	'bootstrap',
	get_parent_theme_file_uri('/assets/dependencies/bootstrap/css/bootstrap.min.css'),
	array(),
	'3.3.0',
	'all'
);

// Loaders.css
wp_register_style(
	'loaders',
	get_parent_theme_file_uri( '/assets/dependencies/loaders.css/loaders.min.css' ),
	array(),
	'0.1.2',
	'all'
);

// Font Awesome
wp_register_style(
	'font-awesome',
	get_parent_theme_file_uri('/assets/dependencies/font-awesome/css/font-awesome.min.css'),
	array(),
	'4.7.0',
	'all'
);

// Font Awesome
wp_register_style(
	'et-icons',
	get_parent_theme_file_uri('/assets/dependencies/etlinefont-bower/style.css'),
	array(),
	'4.7.0',
	'all'
);

// DT Icons
wp_register_style(
	'dt-icons',
	get_parent_theme_file_uri('/assets/dependencies/dt-icons/styles.css'),
	array(),
	'4.7.0',
	'all'
);

// Animate.css
wp_register_style(
	'animate',
	get_parent_theme_file_uri('/assets/dependencies/animate.css/animate.min.css'),
	array(),
	'3.5.1',
	'all'
);

// WOW.js
wp_register_script(
	'wow',
	get_parent_theme_file_uri( '/assets/dependencies/wow/wow.min.js'),
	array('jquery'),
	'1.1.2',
	true
);

// Pie Chart
wp_register_script(
	'piechart',
	get_parent_theme_file_uri( '/assets/js/jquery.easypiechart.min.js'),
	array('jquery'),
	'1.1.2',
	true
);

// Countdown
wp_register_script(
	'countdown',
	get_parent_theme_file_uri( '/assets/js/jquery.countdown.js'),
	array('jquery'),
	'1.1.2',
	true
);

// SVG Loader
wp_register_script(
	'svgloder',
	get_parent_theme_file_uri( '/assets/js/svgLoader.js'),
	array('jquery'),
	'1.1.2',
	true
);

// SVG Loader
wp_register_script(
	'tweenlite',
	get_parent_theme_file_uri( '/assets/js/TweenLite.min.js'),
	array('jquery'),
	'1.1.2',
	true
);

// SVG Loader
wp_register_script(
	'tweenmax',
	get_parent_theme_file_uri( '/assets/js/TweenMax.min.js'),
	array('jquery'),
	'1.1.2',
	true
);

// SVG Loader
wp_register_script(
	'easing',
	get_parent_theme_file_uri( '/assets/js/jquery.easing.js'),
	array('jquery'),
	'1.1.2',
	true
);

// Swiper.js
{
	wp_register_script(
		'swiper',
		get_parent_theme_file_uri( '/assets/dependencies/Swiper/js/swiper.min.js' ),
		array('jquery'),
		'3.4.1',
		true
	);
	wp_register_style(
		'swiper',
		get_parent_theme_file_uri( '/assets/dependencies/Swiper/css/swiper.min.css' ),
		array(),
		'3.4.1',
		'all'
	);
}



// Magnefic Popup
{
	wp_register_script(
		'magnefic',
		get_parent_theme_file_uri( '/assets/dependencies/magnific-popup/js/jquery.magnific-popup.min.js' ),
		array('jquery'),
		'3.4.1',
		true
	);
	wp_register_style(
		'magnefic',
		get_parent_theme_file_uri( '/assets/dependencies/magnific-popup/css/magnific-popup.css' ),
		array(),
		'3.4.1',
		'all'
	);
}

// Countup
wp_register_script(
	'countup',
	get_parent_theme_file_uri('/assets/dependencies/countUp.js/countUp.min.js'),
	array('jquery'),
	'1.1.1',
	true
);

// jQuery Appear
wp_register_script(
	'jquery-appear',
	get_parent_theme_file_uri( '/assets/dependencies/jquery.appear.bas2k/jquery.appear.js' ),
	array('jquery'),
	'1.0.0',
	true
);

// Vivas
wp_register_script(
	'vivus',
	get_parent_theme_file_uri( '/assets/dependencies/vivus/vivus.min.js' ),
	array('jquery'),
	'1.0.0',
	true
);

// Typed
wp_register_script(
	'typed',
	get_parent_theme_file_uri( '/assets/dependencies/typed.js/typed.min.js' ),
	array('jquery'),
	'1.0.0',
	true
);


// Isotop
wp_register_script(
	'isotop',
	get_parent_theme_file_uri( '/assets/dependencies/isotope/isotope.pkgd.min.js' ),
	array('jquery'),
	'1.0.0',
	true
);

// Clasic
wp_register_script(
	'clasic',
	get_parent_theme_file_uri( '/assets/js/classie.js' ),
	array('jquery'),
	'1.0.0',
	true
);

// Hover 3d
wp_register_script(
	'hover3d',
	get_parent_theme_file_uri( '/assets/js/jquery.hover3d.min.js' ),
	array('jquery'),
	'1.0.0',
	true
);

// Parallax Scroll
wp_register_script(
	'jparallax',
	get_parent_theme_file_uri( '/assets/js/jquery.parallax.js' ),
	array('jquery'),
	'1.0.0',
	true
);

// Parallax
wp_register_script(
	'parallax_scroll',
	get_parent_theme_file_uri( '/assets/dependencies/jquery.parallax-scroll/jquery.parallax-scroll.js' ),
	array('jquery'),
	'1.0.0',
	true
);

// Ripple Effect
wp_register_script(
	'ripple_effect',
	get_parent_theme_file_uri( '/assets/dependencies/jquery.ripples/jquery.ripples-min.js' ),
	array('jquery'),
	'1.0.0',
	true
);

wp_register_script(
	'particleground',
	get_parent_theme_file_uri( '/assets/js/jquery.particleground.js' ),
	array('jquery'),
	'1.0.0',
	true
);
wp_register_script(
	'particleground-old',
	get_parent_theme_file_uri( '/assets/js/jquery.particleground.old.min.js' ),
	array('jquery'),
	'1.0.0',
	true
);


wp_register_script(
	'canvas-1',
	get_parent_theme_file_uri( '/assets/js/gp_canvas_bg_style_1.js' ),
	array('jquery'),
	'1.0.0',
	true
);

wp_register_script(
	'canvas-3',
	get_parent_theme_file_uri( '/assets/js/gp_canvas_bg_style_3.js' ),
	array('jquery'),
	'1.0.0',
	true
);

wp_register_script(
	'imageload',
	get_parent_theme_file_uri( '/assets/js/imagesloaded.pkgd.min.js' ),
	array('jquery'),
	'1.0.0',
	true
);


// App Css
wp_register_style(
	'app',
	get_parent_theme_file_uri( '/assets/css/app.css' ),
	array(),
	'1.0.1',
	'all'
);


{
	$query_args = array(
		'key' => cs_get_option( 'pinacop_map_api_key', '' ),
		'region' => cs_get_option( 'pinacop_map_api_region', 'US' ),
	);

	$map_url = add_query_arg( $query_args, 'https://maps.googleapis.com/maps/api/js' );

	// Google Map API
	wp_register_script(
		'gmap-api',
		esc_url( $map_url ),
		array(),
		null,
		true
	);
	
	// GMAP3
	wp_register_script(
		'gmap3',
		get_parent_theme_file_uri( '/assets/dependencies/gmap3/gmap3.min.js' ),
		array('gmap-api'),
		'7.2',
		true
	);

	// Modernizr
	wp_register_script(
		'modernizr',
		get_parent_theme_file_uri( '/assets/js/modernizr-custom.js' ),
		array('jquery'),
		'7.2',
		true
	);

	wp_register_script(
		'parallax',
		get_parent_theme_file_uri( '/assets/js/parallax.js' ),
		array('jquery'),
		'7.2',
		true
	);
}


// Preloader CSS
$preloader_opt = cs_get_option( 'pinacop_preloader' );
$preloader_color_opt = cs_get_option( 'pinacop_preloader_color' );
wp_enqueue_style( 'loaders' );

if ( ! empty( $preloader_opt ) ) {

	$color = ( !empty( $preloader_color_opt ) ) ? $preloader_color_opt : 'rgba(0,0,0,0.97)' ;

	$preloader_css = '
	#preloader {
		position: fixed;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
		background-color: ' . esc_attr( $color ) . ';
		z-index: 999999;
	}
	#loader {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
	}';
wp_add_inline_style( 'loaders', $preloader_css );
}


$header_opt = cs_get_option( 'header-transparent' );
$header_color_opt = cs_get_option( 'header-color' );

if ( ! empty( $header_opt ) ) {

	$color = ( !empty( $header_color_opt ) ) ? $header_color_opt : 'rgba(0,0,0,0)' ;

	$header_css = '

	.sticky_header .header-wrap.header_transparent {
		background: '.esc_attr( $color ).';
	}';
	wp_add_inline_style( 'app', $header_css );
}

/**
 * Enqueue Style and Scripts
 */
wp_enqueue_style( 'pinacop-fonts' );
wp_enqueue_style( 'bootstrap' );
wp_enqueue_style( 'font-awesome' );
wp_enqueue_style( 'dt-icons' );
wp_enqueue_style( 'et-icons' );
wp_enqueue_style( 'animate' );
wp_enqueue_style( 'swiper' );
wp_enqueue_style( 'magnefic' );
wp_enqueue_style( 'app' );

// Inline stylesheet
wp_add_inline_style( 'app', pinacop_custom_css() );


// Theme stylesheet.
wp_enqueue_style( 'pinacop-style', get_stylesheet_uri() );

// Load the html5 shiv.
wp_enqueue_script( 'html5', get_parent_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

// Enqueue registered scripts
wp_enqueue_script( 'bootstrap' );
wp_enqueue_script( 'swiper' );
wp_enqueue_script( 'wow' );
wp_enqueue_script( 'countup' );
wp_enqueue_script( 'jquery-appear' );
wp_enqueue_script( 'typed' );
wp_enqueue_script( 'isotope' );
wp_enqueue_script( 'imageload' );
wp_enqueue_script( 'magnefic' );
wp_enqueue_script( 'clasic' );
wp_enqueue_script( 'hover3d' );
wp_enqueue_script( 'gmap3' );
wp_enqueue_script( 'ripple_effect' );
wp_enqueue_script( 'svgloder' );
wp_enqueue_script( 'tweenlite' );
wp_enqueue_script( 'tweenmax' );
wp_enqueue_script( 'modernizr' );
wp_enqueue_script( 'parallax' );
wp_enqueue_script( 'vivus' );


wp_enqueue_script( 'pinacop', get_parent_theme_file_uri( '/assets/js/app.js' ), array( 'jquery' ), '1.0', true );


if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}
