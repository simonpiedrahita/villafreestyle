<?php
/*
    Template Name: Blog Page
*/

    /* Load Header */
    get_header();
    $classes = array(
       'blog-post'
   );
    $column  = '';

    $sitePosition = 'left';
    $meta         = get_post_meta( get_the_ID(), '_pinacop_page_options', true );

    $mainCol = 'col-md-8';

    if ( ! empty( $meta['pinacop_sidebar'] ) ) {
       $sitePosition = $meta['pinacop_sidebar'];

       if ( $meta['pinacop_sidebar'] == 'full-width' ) {
          $mainCol = 'col-md-12';
      } else {
        $mainCol .= ' pull-' . $meta['pinacop_sidebar'];
    }
}

if ( ! empty( $meta['pinacop_blog_style'] ) && $meta['pinacop_blog_style'] == 'grid' ) {
	$column = 'blog-items';

	if ( ! empty( $meta['pinacop_sidebar'] ) && $meta['pinacop_sidebar'] == 'full-width' ) {
		$column = 'blog-items item';
	}
} else {
	$classes = 'pinacop_blog_post_list';
}

?>
<div class="pinacop_layout_style <?php echo esc_attr( $sitePosition ); ?>">

    <!-- BEGIN MAIN -->

    <div class="main-content-area clearfix">

        <div class="container">  
        <div class="row">

            <div class="<?php echo esc_attr( $mainCol ); ?>">
                <div class="content-area">

                    <div class="pinacop_list_archive blog-grid row">

                        <?php
                        $args = array(
                           'post_type'     => 'post',
                           'post_per_page' => 1
                       );
								// The Query
                        $the_query = new WP_Query( $args );

								// The Loop
                        if ( $the_query->have_posts() ) { ?>

                        <div class="grid-sizer"></div>
                        <?php


                        while ( $the_query->have_posts() ) {
                          $the_query->the_post(); ?>



                        <div class="<?php echo esc_attr( $column ); ?>">
                            <article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

                                <?php if ( has_post_thumbnail() ) : ?>
                                    <a href="<?php the_permalink(); ?>" class="blog-thumb">
                                      <?php
                                      if ( ! empty( $meta['pinacop_blog_style'] ) && $meta['pinacop_blog_style'] == 'grid' ) {
                                         the_post_thumbnail( 'pinacop-blog-thumb' );
                                     } else {
                                         the_post_thumbnail( 'pinacop-blog-thumb-two' );
                                     }
                                     ?>
                                 </a><!-- /.thumb -->
                             <?php endif; ?>

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
                                            <span><?php echo get_the_date( 'j' ); ?></span>
                                            <span><?php echo get_the_date( 'F Y' ); ?></span>
                                        </a>
                                    </li>
                                </ul><!-- /.meta -->

                                <h3 class="entry-title"><a
                                    href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                </h3>

                                <div class="post-content">
                                    <p>
                                     <?php
                                     $content = get_the_content();

                                     echo substr( $content, 0, 130 );
                                     ?>
                                 </p>

                                 <a href="<?php the_permalink(); ?>" class="read-more-btn">Read
                                 More</a>
                             </div>

                             <footer class="post-footer">
                                <div class="categories">
                                    <span><i class="fa fa-folder-o"></i></span>
                                    <?php the_category( ',' ); ?>
                                </div>
                                <ul class="post-status">
                                 <?php if ( function_exists( 'the_views' ) ) : ?>
                                    <li>
                                        <a href="#"><i
                                            class="fa fa-eye"></i><?php the_views(); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <li>
                                    <a href="<?php the_permalink(); ?>#respond"
                                     class="item">
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
                        </div>
                        <?php
                    }

                            /* Restore original Post Data */
                            wp_reset_postdata();
                        } else { ?>
                            <p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'pinacop' ); ?></p>

                            <?php
                        }

                        ?>
                    </div> <!-- ./page-content -->                       

                </div><!-- ./content-area -->           

            </div><!-- ./main-column -->

             <!-- SideBar -->
            <?php if ( ! empty( $meta['pinacop_sidebar'] ) && $meta['pinacop_sidebar'] !== 'full-width' ) : ?>
                <div class="col-md-4">
                 <?php get_sidebar(); ?>
             </div><!-- /.col-md-4 -->
            <?php endif; ?>
            </div>             
        </div><!-- ./container -->
    </div><!-- END Main -->
</div>

<div class="clearfix"></div>


<?php
/* Load Footer */
get_footer();
?>