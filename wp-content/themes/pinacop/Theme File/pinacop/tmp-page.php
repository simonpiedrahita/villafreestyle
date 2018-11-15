<?php 

/*
	Template Name: For Page Builder
 */
get_header();


while ( have_posts() ) : the_post();

	the_content();

endwhile; // End of the loop.
	
$meta  = get_post_meta( get_the_ID(), '_pinacop_page_options', true );
$metaR  = isset( $meta['pinacop_footer_style']) ?  $meta['pinacop_footer_style'] : '';
$opt = cs_get_option('pinacop_footer_style', 'footer-widgets');

if ( $opt == 'footer-2' || $metaR == 'footer-2') {
	get_footer('2');
} else {
	get_footer();
}