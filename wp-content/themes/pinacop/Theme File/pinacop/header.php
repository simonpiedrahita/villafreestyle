<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Pinacop
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>  class="no-js">

<head>

	<!-- Meta Data -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>



	<?php do_action( 'pinacop_after_body' ); ?>

    <?php
    $opt = cs_get_option('pinacop_back_to_top', false);

    if ( $opt == true ) :
    ?>

	<a href="#site" data-type="section-switch" class="return-to-top"><i class="fa fa-chevron-up"></i></a>
    <?php endif; ?>
	<div id="site">

		<!--==========================-->
		<!--=        Header          =-->
		<!--==========================-->
		<header id="header">
			
			<?php
				$opt = cs_get_option('topbar_menu', false);

				if (is_singular()) {
					$meta = get_post_meta( get_the_ID(), '_pinacop_page_options', true );
					

					if ( isset($meta['topbar_menu'])) {
						$opt = $meta['topbar_menu'];
					}
				}

				if ( $opt == true ) :

			?>

			<div class="top-menu header-wrap">
				<?php if ( cs_get_option( 'header-boxed' ) ) : echo '<div class="container">'; endif; ?>
					<div class="row">
						<div class="col-sm-6">
							<div class="info">
								<?php $contact_email = cs_get_option( 'top_contact_email' ); ?>
								<?php $contact_number = cs_get_option( 'top_contact_number' ); ?>								
                                <span><i class="fa fa-envelope"></i></span>
								<p><?php echo esc_html( $contact_email ); ?></p>

                                <span><i class="fa fa-phone"></i></span>
								<p><?php echo esc_html( $contact_number ); ?></p>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="top-link text-right">				

								<?php

									$profail = cs_get_option( 'pinacop_social_links' );

									if ( ! empty( $profail ) ) :
										echo '<ul class="gp-social-link">';
										foreach ($profail as $item ) :
								?>
									<li><a href="<?php echo esc_url( $item['url'] ); ?>"><i class="<?php echo esc_html( $item['icon'] ); ?>"></i></a></li>
								<?php
									endforeach;
									echo '</ul>';
									endif;
								?>
							</div>
						</div>
					</div>
				<?php if ( cs_get_option( 'header-boxed' ) ) : echo '</div>'; endif; ?>
			</div>
			<?php endif; ?>
			<div class="header-wrap <?php echo ( cs_get_option( 'header-transparent' ) ? ' header_transparent' : '' ); ?>">
				

				<?php 
					get_template_part( 'template-parts/header/main' );				
				?>
			</div><!-- /.header-bg -->
		</header>
        <div class="menu-fixer"></div>
		<!-- /#header -->

		<!--==========================-->
		<!--=        Header          =-->
		<!--==========================-->
		<?php

		get_template_part( 'template-parts/header/side_menu' );

		?>

		<?php
		if ( ( is_front_page() && is_page() ) == false ) {
			get_template_part( 'template-parts/page-header' );
		}
		?>