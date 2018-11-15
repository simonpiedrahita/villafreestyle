<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage DT_Corpo
 * @since 1.0
 * @version 1.0
 */

get_header();

$classes = pinacop_sidebar_position();

?>

<div class="container pinacop_inside_page">
	<div class="row pinacop_layout_style <?php echo esc_attr( $classes['position'] ); ?>">
		<div class="<?php echo esc_attr( $classes['column'] ); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

				<?php
				if ( have_posts() ) :
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/post/content', 'search' );

					endwhile; // End of the loop.

					the_posts_pagination( array(
							'prev_text' => '<span class="pinacop_prev_nav"><i class="fa fa-long-arrow-left"></i></span><span class="screen-reader-text">' . esc_html__( 'Previous page', 'pinacop' ) . '</span>',
							'next_text' => '<span class="sr-only">' . esc_html__( 'Next page', 'pinacop' ) . '</span><span class="pinacop_next_nav"><i class="fa fa-long-arrow-right"></i></span>',
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'pinacop' ) . ' </span>',
						) );

				else : ?>
                    <h2>Nothing Found</h2>
					<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'pinacop' ); ?></p>

					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="gp-btn"><?php echo esc_html__( 'Back To Homepage', 'pinacop' ); ?><i class="fa fa-reply"></i></a>
					<?php
						get_search_form();

				endif;
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

<?php 

$foSt = cs_get_option('pinacop_footer_style');
if (! empty($foSt) && $foSt == 'footer-2') {
	get_footer('2');
} else {
	get_footer();
}