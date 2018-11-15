<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Pinacop
 * @since 1.0
 * @version 1.0
 */

get_header();

$classes = pinacop_sidebar_position();
$page_header = cs_get_option( 'pinacop_header' );
$post_opt = get_post_meta( $post->ID, '_pinacop_page_options', true );
if ( is_array( $post_opt ) ) {
	$page_header	= $post_opt['page_header'];	

}
if ( pinacop_is_vc_content() ) : ?>
	
	<div id="visual_composer_page">
		<?php
			while ( have_posts() ) : the_post();

				the_content();

			endwhile; // End of the loop.
		?>
	</div><!-- /#visual_composer_page -->

<?php else :

?>

<div class="container pinacop_inside_page">

	<div class="pinacop_layout_style <?php echo esc_attr( $classes['position'] ); ?>">
		<div class="<?php echo esc_attr( $classes['column'] ); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

				<?php if ( have_posts() ) { ?>

					<div class="pinacop_list_archive <?php echo ( $style_opt == 'grid' ) ? 'blog-grid' : ''; ?>">
						<div class="grid-sizer"></div>
						<?php
						while ( have_posts() ) {
							the_post();
							get_template_part( 'template-parts/post/content', get_post_format() );
						}
						?>
					</div><!-- /.pinacop_list_archive -->

					<?php
					the_posts_pagination( array(
						'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous Post', 'pinacop' ) . '</span><span class="nav-title"><span class="pinacop_prev_nav"><i class="fa fa-angle-left"></i></span>%title</span>',
						'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next Post', 'pinacop' ) . '</span><span class="nav-title">%title<span class="pinacop_next_nav"><i class="fa fa-angle-right"></i></span></span>',
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'pinacop' ) . ' </span>',
					) );

				} else {
					get_template_part( 'template-parts/post/content', 'none' );
				}
				?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- /.col-md-8 -->

		<?php if ( $classes['sidebar'] == true ) : ?>
			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div><!-- /.col-md-4 -->
		<?php endif; ?>
	</div><!-- /.pinacop_layout_style -->

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
	


