<div class="footer-wrapper">
	<div class="container">
		<div class="footer-logo">
			<?php
			$default      = get_template_directory_uri() . '/assets/img/logo.png';
			$logo         = cs_get_option( 'pinacop_footer_logo', $default );

			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo esc_url( $logo ); ?>" alt="logo" >
			</a>

		</div><!-- /.footer-logo -->
		<div class="footer-social-link">

			<?php

			$profail = cs_get_option( 'pinacop_social_links' );

			if ( ! empty( $profail ) ) :
				echo '<ul class="gp-social-link">';
				foreach ($profail as $item ) :
					?>
					<li>
						<a href="<?php echo esc_url( $item['url'] ); ?>">
							<i class="<?php echo esc_html( $item['icon'] ); ?>"></i>
						</a>
					</li>
					<?php
				endforeach;
				echo '</ul>';
			endif;
			?>
		</div>

		<div class="copyright-bar">

			<div class="site-info">
				<p>
					<?php
					$copy_text = get_theme_mod( 'pinacop_footer_copy_text' );

					if ( ! empty( $copy_text ) ) {

						echo wp_kses_post( $copy_text );

					} else {

						echo sprintf(
							esc_html__( '&copy; %1$s %2$s - Designed by %3$s', 'pinacop' ),
							date( 'Y' ),
							get_bloginfo( 'name' ),
							'<a href="' . esc_url( 'https://www.gpthemes.co/' ) . '">' . esc_attr( 'GP Theme' ) . '</a>'
						);
					}
					?>
				</p>
			</div><!-- .site-info -->

		</div><!-- /.copyright-bar -->
	</div><!-- /.container -->

</div><!-- /.footer-wrapper -->