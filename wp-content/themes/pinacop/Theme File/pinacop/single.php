<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Pinacop
 * @since 1.0
 * @version 1.0
 */

get_header();

$classes = pinacop_sidebar_position();

$style_opt = cs_get_option( 'pinacop_blog_style' );
$layout     = cs_get_option( 'pinacop_sidebar' );

$extra_class = '';

if ($layout == 'full-width') {	
		$extra_class = 'list-full-width';	
}

?>

<div class="container pinacop_inside_page <?php echo esc_attr($extra_class) ?>">
	<div class="pinacop_layout_style <?php echo esc_attr( $classes['position'] ); ?>">
		<div class="<?php echo esc_attr( $classes['column'] ); ?>">
			<div id="primary" class="content-area">				

					<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/post/content-single', get_post_format() );

							the_post_navigation( array(
								'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous Post', 'pinacop' ) . '</span><span class="nav-title"><span class="pinacop_prev_nav"><i class="fa fa-angle-left"></i></span>%title</span>',
								'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next Post', 'pinacop' ) . '</span><span class="nav-title">%title<span class="pinacop_next_nav"><i class="fa fa-angle-right"></i></span></span>',
							) );

							get_template_part( 'template-parts/author-box' );


							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;



						endwhile; // End of the loop.
					?>
			
			</div><!-- #primary -->
		</div><!-- /.col-md-9 -->

		<?php if ( $classes['sidebar'] == true ) : ?>
			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div><!-- /.col-md-3 -->
		<?php endif; ?>
	</div><!-- /.row -->
</div><!-- .container -->

<?php 

	$meta  = get_post_meta( get_the_ID(), '_pinacop_page_options', true );
	$metaR  = isset( $meta['pinacop_footer_style']) ?  $meta['pinacop_footer_style'] : '';
	$opt = cs_get_option('pinacop_footer_style', 'footer-widgets');
	
	if ( $opt == 'footer-2' || $metaR == 'footer-2') {
		get_footer('2');
	} else {
		get_footer();
	}