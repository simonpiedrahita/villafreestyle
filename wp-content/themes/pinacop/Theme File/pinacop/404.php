<?php
/**
 * The template for displaying 404 pages (Not Found).
 * @package pinacop
 * by GP Theme
 */

$default      = get_template_directory_uri() . '/assets/img/404.jpg';
$overlay_img         = cs_get_option( 'pinacop_404_img', $default );

$error_text = '404';
$error_subtext = 'Oops! That page can not be found.';


$error_title 	= cs_get_option( 'error_title', $error_text );
$error_subtitle = cs_get_option( 'error_subtitle',$error_subtext );
$error_content 	= cs_get_option( 'error_content' );


?>



<?php get_header(); ?>

<section class="page-404">
<div class="page404-overlay" data-bg-image="<?php echo esc_url( $overlay_img ); ?>"></div>
<div class="container">
   <div class="content_404" >
      <h2 class="section-heading"><?php echo esc_html($error_title); ?></h2>
      <h3><?php echo esc_html($error_subtitle); ?></h3>
      <p class="section-subheading"><?php echo esc_html($error_content); ?></p>
      <a href="<?php echo esc_url(get_site_url()); ?>" class="gp-btn"><?php if (isset($redux_ThemeTek['tek-404-back'])) { echo esc_attr($redux_ThemeTek['tek-404-back']); } else { echo "Back to Homepage"; } ?></a>
   </div>
   </div>
</section>

<?php 

$foSt = cs_get_option('pinacop_footer_style');
if (! empty($foSt) && $foSt == 'footer-2') {
	get_footer('2');
} else {
	get_footer();
}

