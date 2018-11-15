<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package WordPress
 * @subpackage Pinacop
 * @since 1.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function pinacop_body_classes( $classes ) {
	// Add class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Add class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add class if we're viewing the Customizer for easier styling of theme options.
	if ( is_customize_preview() ) {
		$classes[] = 'pinacop-customizer';
	}

	// Add class on front page.
	if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
		$classes[] = 'pinacop-front-page';
	}
	
	// if (!is_front_page() && cs_get_option( 'pinacop_header' ) == false) {
	// 	 $classes[] = 'menu-block';  
	// }

	if ( ! is_front_page() && cs_get_option( 'pinacop_header' ) == false) {
		$classes[] = 'menu-block';  
	} 

	// if ( is_home() ) {
	// 	$classes[] = 'menu-block';
	// } 

	if ( cs_get_option( 'header-transparent' ) == true) {
		$classes[] = 'sticky_header';
	}

	if ( !is_home() && cs_get_option( 'pinacop_header' ) == false) {
		$classes[] = 'sticky_header_block';
	}         

	return $classes;
}
add_filter( 'body_class', 'pinacop_body_classes' );


/**
 * Detect visual composer
 */
function pinacop_is_vc_content() {
	global $post;
	$matches        = array();
	$preg_match_ret = preg_match( '/\[.*vc_row.*\]/s', $post->post_content, $matches );
	if ( $preg_match_ret !== 0 && $preg_match_ret !== false ) {
		return true;
	}

	return false;
}

/**
 * Get excerpt with limit
 */
function pinacop_the_excerpt( $charlength ) {
	$excerpt = get_the_excerpt();
	$charlength ++;

	if ( mb_strlen( $excerpt ) > $charlength ) {

		$subex   = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut   = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );

		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo wp_kses_post($subex);
		}
		echo '...';
	} else {
		echo wp_kses_post($excerpt);
	}
}

/**
 * Get the sidebar position
 */
function pinacop_sidebar_position() {

	$sidebar_opt = cs_get_option( 'pinacop_sidebar' );

	$class = array(
		'column'	=> 'col-md-8',
		'position'	=> 'right',
		'sidebar'	=> true,
	);

	if ( $sidebar_opt == 'full-width' ) {

		$class['column'] = 'col-md-12';
		$class['sidebar'] = false;

	} elseif ( $sidebar_opt == 'left' ) {
		$class['column'] = 'col-md-8 pull-right';
		$class['position'] = 'left';
		$class['sidebar'] = true;

	} else {
		$class['column'] = 'col-md-8';
		$class['position'] = 'right';
		$class['sidebar'] = true;
	}

	return $class;

}

/**
 * Get the user contact methods
 */
function pinacop_get_user_profiles() {

	$contact_methods = array();

	if ( get_the_author_meta( 'url' ) ) {
		$contact_methods['website']['link'] = get_the_author_meta( 'url' );
		$contact_methods['website']['icon'] = 'fa fa-globe';
		$contact_methods['website']['title'] = esc_html__( 'Website', 'pinacop' );
	}
	
	if ( get_the_author_meta( 'facebook' ) ) {
		$contact_methods['facebook']['link'] = get_the_author_meta( 'facebook' );
		$contact_methods['facebook']['icon'] = 'fa fa-facebook';
		$contact_methods['facebook']['title'] = esc_html__( 'Facebook Profile', 'pinacop' );
	}

	if ( get_the_author_meta( 'twitter' ) ) {
		$contact_methods['twitter']['link'] = 'https://twitter.com/' . get_the_author_meta( 'twitter' );
		$contact_methods['twitter']['icon'] = 'fa fa-twitter';
		$contact_methods['twitter']['title'] = esc_html__( 'Twitter Profile', 'pinacop' );
	}

	if ( get_the_author_meta( 'google-plus' ) ) {
		$contact_methods['google-plus']['link'] = get_the_author_meta( 'google-plus' );
		$contact_methods['google-plus']['icon'] = 'fa fa-google-plus';
		$contact_methods['google-plus']['title'] = esc_html__( 'Google Profile', 'pinacop' );
	}

	if ( get_the_author_meta( 'linkedin' ) ) {
		$contact_methods['linkedin']['link'] = get_the_author_meta( 'linkedin' );
		$contact_methods['linkedin']['icon'] = 'fa fa-linkedin';
		$contact_methods['linkedin']['title'] = esc_html__( 'Linkedin Profile', 'pinacop' );
	}

	return $contact_methods;
}


/**
 * Preloader
 */
function pinacop_preloader_markup() {
	$preloader_opt = cs_get_option( 'pinacop_preloader' );

	if ( !empty( $preloader_opt ) ) :
		$style_name = substr( $preloader_opt, 0, -2 );
		$style_div = substr( $preloader_opt, -1 );
?>
	<div id="preloader">
		<div id="loader">
			<div class="loader-inner <?php echo esc_attr( $style_name ); ?>">
				<?php for ( $div=0; $div < $style_div; $div++ ) : ?>
					<div></div>
				<?php endfor; ?>
			</div>
		</div><!-- /#loader -->
	</div><!-- /#preloader -->
<?php
	endif;
}
add_action( 'pinacop_after_body', 'pinacop_preloader_markup', 1 );


