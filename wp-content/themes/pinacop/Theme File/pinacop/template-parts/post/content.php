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

$clasess       = array(
	'blog-post'
);
$style_opt     = cs_get_option( 'pinacop_blog_style' );
$thumbnail_opt = cs_get_option( 'pinacop_blog_thumbnail' );
$readmore_opt  = cs_get_option( 'pinacop_blog_readmore' );
$meta_data     = cs_get_option( 'pinacop_blog_meta' );
$layout        = cs_get_option( 'pinacop_sidebar' );

if ( $style_opt !== 'grid' ) {
	$clasess[] = 'pinacop_blog_post_list';
}

if ( $thumbnail_opt == false ) {
	$clasess[] = 'pinacop_thumbnail_disabled';
}

if ( $style_opt == 'grid' ) {

    if ( $layout == 'full-width' ) {
        echo '<div class="blog-items item">';
    } else {
    	echo '<div class="blog-items">';
    }

}

?>
<div class="grid-sizer"></div>
    
    <article id="post-<?php the_ID(); ?>" <?php post_class( $clasess ); ?>>

        <a href="<?php esc_url( the_permalink() ); ?>">

           <?php if ( has_post_thumbnail() ) {

            if ( $style_opt == 'grid' ) {
                    the_post_thumbnail( 'pinacop-blog-thumb' );
                } else {
                    the_post_thumbnail( 'pinacop-blog-thumb-two' );
                }              

            }

             ?>
           
        </a>

        <div class="blog-post-content">
            <ul class="post-meta">
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <i class="icon-profile-male"></i>
                        By: <?php the_author(); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php the_permalink(); ?>" class="item date">
                        <i class="icon-clock"></i>
                        <span><?php echo get_the_date(); ?></span>                        
                    </a>
                </li>
            </ul><!-- /.meta -->

            <h3 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>

            <div class="post-content">
                <p>
					<?php
					$content = get_the_excerpt();

					echo substr( $content, 0, 125 );
					?>
                </p>

                <a href="<?php the_permalink(); ?>" class="read-more-btn"><?php echo esc_html__('Read More', 'pinacop'); ?></a>
            </div>

            <footer class="post-footer clearfix">
                <div class="categories">
                    <span><i class="fa fa-folder-o"></i></span>
					<?php the_category(','); ?>
                </div>
                <ul class="post-status">				

                    <li>
                        <a href="<?php the_permalink(); ?>#respond" class="item">
                            <i class="fa fa-comments"></i>
							<?php $comments = wp_count_comments( get_the_ID() ); ?>
                            <span><?php echo sprintf( esc_html__( '%1$s', 'pinacop' ), $comments->approved ); ?></span>
                        </a>
                    </li>
                </ul>
            </footer>

			<?php

			// Page Break
			wp_link_pages( array(
				'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'pinacop' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );
			?>
        </div><!-- /.item_top_area -->

    </article><!-- #post-## -->

<?php
if ( $style_opt == 'grid' ) {
	echo '</div>';
}





