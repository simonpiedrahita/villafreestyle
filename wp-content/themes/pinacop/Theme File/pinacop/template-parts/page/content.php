<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Pinacop
 * @since 1.0
 * @version 1.0
 */
$clasess = array();
$clasess[] = 'pinacop_single_page';

$meta_data = get_post_meta( get_the_ID(), '_pinacop_page_title_options', true );
?>


<article id="post-<?php the_ID(); ?>" <?php post_class( $clasess ); ?>>
	
	<?php if ( ! empty( $meta_data['title_display'] ) ) : ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php edit_post_link(); ?>
	</header><!-- .entry-header -->
	<?php endif; ?>
	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pinacop' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
