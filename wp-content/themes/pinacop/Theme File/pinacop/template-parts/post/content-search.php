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

$meta_data = cs_get_option( 'pinacop_blog_meta' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('search-items'); ?>>


	<header class="entry-header">
		<?php if ( 'post' === get_post_type() && in_array( 'date', (array) $meta_data ) == true ) : ?>
			<div class="entry-meta">
                <ul class="post-meta">
                    <li>By: <?php echo get_the_author_posts_link(); ?></li>
                    <li><?php echo pinacop_time_link(); ?></li>
                    <li><?php echo edit_post_link(); ?></li>
                </ul>
			</div><!-- .entry-meta -->
		<?php endif; ?>

		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

	</header><!-- .entry-header -->

	<div class="entry-excerpt">
		<?php

			echo '<div class="content">';
			pinacop_the_excerpt( 350 );
			echo '</div>';

		if ( 'post' === get_post_type() ) {

			echo '<div class="entry-tcs">';

			if ( get_the_category_list() && pinacop_categorized_blog() && in_array( 'category', (array) $meta_data ) == true ) {
				echo '<span class="cat-lists">';
				echo '<i class="fa fa-tag"></i>';
				echo '<span class="screen-reader-text">' . esc_html__( 'Categories', 'pinacop' ) . '</span>';
				echo get_the_category_list( ', ' );
				echo '</span>';
			}

			if ( comments_open() && in_array( 'comment', (array) $meta_data ) == true ) {
				echo '<span class="comment-count">';
				echo '<i class="fa fa-comments"></i>';
				comments_popup_link();
				echo '</span>';
			}

			if (function_exists( 'the_views' ) && in_array( 'views', (array) $meta_data ) == true ) {
				echo '<span class="post-views">';
				echo '<i class="fa fa-eye"></i>';
				echo the_views();
				echo '</span>';
			}

			if ( in_array( 'share', (array) $meta_data ) ) {
				echo '<span class="post-share">';
				echo '<i class="fa fa-share-alt"></i>';
				echo pinacop_share_buttons();
				echo '</span>';
			}

			echo '</div>';
		}

			// Page Break
			wp_link_pages( array(
				'before'		=> '<div class="page-links">' . esc_html__( 'Pages:', 'pinacop' ),
				'after'			=> '</div>',
				'link_before'	=> '<span class="page-number">',
				'link_after'	=> '</span>',
			) );
		?>

	</div><!-- .entry-excerpt -->

</article><!-- #post-## -->
