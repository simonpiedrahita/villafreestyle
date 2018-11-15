<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Pinacop
 * @since 1.0
 * @version 1.0
 */

$clasess   = array();
$clasess[] = 'pinacop_single_post';

$meta_data    = cs_get_option( 'pinacop_single_display_meta' );
$featured_img = cs_get_option( 'pinacop_single_thumbnail' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $clasess ); ?>>

        <div class="post-thumbnail">
			<?php the_post_thumbnail( 'pinacop-featured-image' ); ?>
        </div><!-- .post-thumbnail -->	

    <header class="entry-header">
		<?php if ( 'post' === get_post_type() && in_array( 'date', (array) $meta_data ) == true ) : ?>
            <div class="entry-meta">
                <ul class="post-meta">
                    <li>By: <?php echo get_the_author_posts_link(); ?></li>
                    <li><?php echo pinacop_time_link(); ?></li>
                    <li><?php echo get_the_category_list( ', ' ); ?></li>
                    <li><?php echo edit_post_link(); ?></li>
                </ul>

            </div><!-- .entry-meta -->
		<?php endif; ?>

        <h3 class="entry-title"><?php the_title(); ?></h3>

    </header><!-- .entry-header -->

    <div class="entry-content">
		<?php	

		the_content();

		?>

		<div class="clearfix"></div>

		<?php

		// Page Break
		wp_link_pages( array(
			'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'pinacop' ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) );

		if ( 'post' === get_post_type() ) {
			echo '<div class="entry-tcs clearfix">';

			if ( get_the_tag_list() && pinacop_categorized_blog() && in_array( 'category', (array) $meta_data ) == true ) {
				echo '<span class="cat-lists">';
				echo '<i class="fa fa-tags" aria-hidden="true"></i>:';
				echo '<span class="screen-reader-text">' . esc_html__( '', 'pinacop' ) . '</span>';
				echo get_the_tag_list( '', '' );
				echo '</span>';
			}

			if ( in_array( 'share', (array) $meta_data ) && function_exists('pinacop_share_buttons') ) {
				echo '<span class="post-share">';

				echo pinacop_share_buttons();
				echo '</span>';
			}

			echo '</div>';
		}
		?>
    </div><!-- .entry-content -->


</article><!-- #post-## -->
