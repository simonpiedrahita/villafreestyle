<?php get_header(); ?>

<div class="main-content portfolio-portfolio-article">

	<div class="internal-content">
		<article <?php post_class(); ?>>
			<div class="row">
				<div class="container">
					<?php while ( have_posts() ) : the_post(); ?>
						<div class="col-md-7">
							<div class="portfolio-thumb"><?php the_post_thumbnail('full'); ?></div>
						</div>
						<div class="col-md-5">
							<div class="portfolio-header">
								<h1 class="portfolio-title"><?php the_title(); ?></h1>
								
							</div>
							<div class="portfolio-content"><?php the_content(); ?></div>

							<ul class="meta-post meta-portfolio">

								<li>
									<span><?php echo esc_html__('Categories :', 'pinacop') ?> </span>
									<?php 
									$terms = get_the_terms($post->ID, 'portfolio-category' );
									if ($terms && ! is_wp_error($terms)) :
										$term_slugs_arr = array();
										foreach ($terms as $term) {
											$term_slugs_arr[] = $term->name;
										}
										$terms_slug_str = join(", ", $term_slugs_arr);
									endif;
									echo esc_attr($terms_slug_str); 
									?>

								</li>
								<li>
									<span><?php echo esc_html__('Tags :', 'pinacop') ?> </span>

									<?php 
									$terms = get_the_terms($post->ID, 'portfolio-tag' );
									if ($terms && ! is_wp_error($terms)) :
										$term_slugs_arr = array();
										foreach ($terms as $term) {
											$term_slugs_arr[] = $term->name;
										}
										$terms_slug_str = join(", ", $term_slugs_arr);
									endif;
									echo esc_attr($terms_slug_str); 
									?>
									

									
								</li> 
								<li><span><?php echo esc_html__('Date published :', 'pinacop') ?> </span><?php echo get_the_date('d M, Y'); ?></li>
							</ul>

							<div class="portfolio-share-meta">
								<h4><?php echo esc_html__("Share on", "pinacop"); ?></h4>
								<span class="portfolio-share">
									<a href='https://www.facebook.com/sharer.php?u=<?php echo esc_url(get_permalink(get_the_ID())); ?>' target='_blank'><span class='fa fa-facebook'></span></a>
									<a href='https://twitter.com/share?url=<?php echo esc_url(get_permalink(get_the_ID())); ?>' target='_blank'><span class='fa fa-twitter'></span></a>
									<a href='https://plusone.google.com/_/+1/confirm?hl=en&url=<?php echo esc_url(get_permalink(get_the_ID())); ?>' target='_blank'><span class='fa fa-google-plus'></span></a>
									<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url(get_permalink(get_the_ID())); ?>" target='_blank'><span class="fa fa-linkedin"></span></a>
								</span>
							</div>
						</div>						
						<div class="clearfix"></div>						 

					<?php endwhile; ?>
				</div>
			</div>
			
			<div class="row">
				<div class="portfolio-navigation-links col-xs-12 col-sm-12 col-md-12 col-lg-12">				
					<div class="port-nav-wrap">


						<div class="port-nav-prev col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<?php
							$prev_post = get_adjacent_post(false, '', true);
							if(!empty($prev_post)) {
								echo '<a class="port-prev tt_button" href="' . esc_url(get_permalink($prev_post->ID)) . '" title="' . esc_html($prev_post->post_title) . '"><i class="fa fa-angle-left"></i> ' . esc_html__("Prev", "pinacop") . '</a>';
							}
							?>
						</div>
						<div class="port-nav-next col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<?php $next_post = get_adjacent_post(false, '', false);
							if(!empty($next_post)) {
								echo '<a class="port-next tt_button" href="' . esc_url(get_permalink($next_post->ID)) . '" title="' . esc_html($next_post->post_title) . '">' . esc_html__("Next", "pinacop") . ' <i class="fa fa-angle-right"></i></a>';
							}
							?>
						</div>
					</div>
				</div>
				
			</div>
		</article>	
		
	</div>
</div>
<?php get_footer(); ?>