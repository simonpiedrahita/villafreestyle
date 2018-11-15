<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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

if ($page_header != true) : ?>
	<div class="page-title">
		<div class="container">
			<h1><?php echo get_the_title(); ?></h1>
			<?php pinacop_breadcrumbs(); ?>
		</div><!-- /.container -->
	</div>
<?php endif; ?>

	<div class="container pinacop_inside_page">		

		<div class="pinacop_layout_style <?php echo esc_attr( $classes['position'] ); ?>">
			<div class="<?php echo esc_attr( $classes['column'] ); ?>">
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">

						<?php
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/page/content', 'page' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

							endwhile; // End of the loop.
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
		
	</div><!-- .container -->

<?php endif; 



	$meta  = get_post_meta( get_the_ID(), '_pinacop_page_options', true );
	$metaR  = isset( $meta['pinacop_footer_style']) ?  $meta['pinacop_footer_style'] : '';
	$opt = cs_get_option('pinacop_footer_style', 'footer-widgets');
	
	if ( $opt == 'footer-2' || $metaR == 'footer-2') {
		get_footer('2');
	} else {
		get_footer();
	}