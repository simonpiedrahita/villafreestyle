<?php
/**
 * Template for displaying page header
 */

$page_header 		= cs_get_option( 'pinacop_header' );
$page_header_img	= cs_get_option( 'pinacop_header_image' );
$page_header_title	= cs_get_option( 'pinacop_header_default_title' );
$page_header_crumb	= cs_get_option( 'pinacop_breadcrumbs' );

$banner_disp	= false;
$banner_image	= '';
$banner_title	= get_the_title();
$banner_crumb	= false;
$banner_des_enable	= false;
$banner_des  = false;

if ( $page_header == true ) {
	$banner_disp	= true;
}

if ( is_404() ) {
	$banner_disp	= false;
}

if ( ! empty( $page_header_img ) ) {
	$banner_image	= wp_get_attachment_url( $page_header_img );
}

if ( $page_header_crumb == true ) {
	$banner_crumb	= true;
}

if ( ! empty( $page_header_title ) ) {
	$banner_title	= $page_header_title;
}

if ( is_singular() ) {
	
	global $post;

	$post_opt = get_post_meta( $post->ID, '_pinacop_page_options', true );
	

	if ( is_array( $post_opt ) ) {
		

		if ( ! empty( $post_opt['custom_title'] ) ) {
			$banner_title	= $post_opt['custom_title'];

		} elseif (get_post_type(get_the_ID()) == 'post') {
			$banner_title = esc_html__('Blog', 'pinacop');

		} elseif ( is_page() ) {
			$banner_title	= get_the_title( $post->ID );
		} else {
			$post_type = get_post_type_object(get_post_type());
			$banner_title	= $post_type->labels->singular_name;

		}

		if ( $post_opt['page_header'] == false ) {
			$banner_disp	= false;
		}

		if ( isset($post_opt['banner_des_enable']) ) {
			$banner_des_enable	= $post_opt['banner_des_enable'];
		}

		if ( !empty($post_opt['banner_des']) ) {
			$banner_des	= $post_opt['banner_des'];
		}

		if ( ! empty( $post_opt['header_image'] ) ){
			$banner_image = wp_get_attachment_url( $post_opt['header_image'] );
		}

		if ( $post_opt['breadcrumbs'] == false ) {
			$banner_crumb	= false;
		}		

	} else {
		$banner_title	= get_the_title( $post->ID );
	}

} elseif ( is_archive() ) {
	$banner_title	= get_the_archive_title();

} elseif ( is_search() ) {
	if ( have_posts() ) {
		$banner_title = sprintf( esc_html__( 'Search Results for: %s', 'pinacop' ), '<span>' . get_search_query() . '</span>' );
	} else {
		$banner_title = sprintf( esc_html__( 'Search Results for: %s', 'pinacop' ), '<span>' . get_search_query() . '</span>' );
	}

} else {
	$banner_title = esc_html__('Latest Post', 'pinacop');
}

if ( $banner_disp == false )
	return;

?>

<section class="pinacop_page_header" data-parallax="image" data-bg-image="<?php echo esc_url( $banner_image ); ?>">
	<div class="container">
		<div class="banner-title">
			<h1><?php echo wp_kses_post( $banner_title ); ?></h1>
			<?php
			if($banner_des_enable == true) { 
				echo '<h3>';
				echo wp_kses_post( $banner_des );
				echo '</h3>';

			}
			if ( $banner_crumb == true ) {
				pinacop_breadcrumbs();
			}		

			?>
						
		</div>
		<!-- /.banner-title -->
	</div>
	<!-- /.container -->
</section><!-- /.pinacop_page_header -->

