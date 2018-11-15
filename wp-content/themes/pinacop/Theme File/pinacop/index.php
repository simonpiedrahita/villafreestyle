<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
$style_opt = cs_get_option( 'pinacop_blog_style' );
$layout     = cs_get_option( 'pinacop_sidebar' );

$page_header = cs_get_option( 'pinacop_header' );

$extra_class = '';

if ($layout == 'full-width') {
	if ($style_opt == 'grid') {
		$extra_class = 'grid-full-width';
	} else {
		$extra_class = 'list-full-width';	
	} 
} ?>


<div class="container pinacop_inside_page <?php echo esc_attr($extra_class) ?>">
	
	<div class="pinacop_layout_style gp-content-wrap  <?php echo esc_attr( $classes['position'] ); ?>">
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
							'prev_text' => '<span class="pinacop_prev_nav">Prev</span><span class="screen-reader-text">' . esc_html__( 'Previous page', 'pinacop' ) . '</span>',
							'next_text' => '<span class="sr-only">' . esc_html__( 'Next page', 'pinacop' ) . '</span><span class="pinacop_next_nav">Next</span>',
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'pinacop' ) . ' </span>',
						) );

					} else {
						get_template_part( 'template-parts/post/content', 'none' );
					}
					?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- /.col-md-9 -->
		
		<?php if ( $classes['sidebar'] == true ) : ?>
			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div><!-- /.col-md-3 -->
		<?php endif; ?>
	</div><!-- /.row -->

</div><!-- .wrap -->

<?php

	$meta  = get_post_meta( get_the_ID(), '_pinacop_page_options', true );
	$metaR  = isset( $meta['pinacop_footer_style']) ?  $meta['pinacop_footer_style'] : '';
	$opt = cs_get_option('pinacop_footer_style', 'footer-widgets');
	
	if ( $opt == 'footer-2' || $metaR == 'footer-2') {
		get_footer('2');
	} else {
		get_footer();
	}