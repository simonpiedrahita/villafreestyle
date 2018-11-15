<aside id="side_menu" class="text-center">

	<div class="close-menu">
		<i class="icon dti-remove"></i>
	</div>

	<div class="mobile-logo">
		<?php
		$default      = get_template_directory_uri() . '/assets/img/logo.png';

		$logo         = cs_get_option( 'pinacop_mobile_logo', $default );		


		if(! empty ($logo)) {
			echo '<a href="'. esc_url( home_url( '/' ) ) .'"><img src="'. esc_url( $logo ) .'" alt="logo" class="logo-light"></a>';
		} else {
			echo get_bloginfo('name');
		}		

		?>
	</div>

	<nav id="mobile_side_menu">
		<?php

		if ( has_nav_menu( 'side_menu' ) ) {
			wp_nav_menu( array(
				'menu'           => 'Side Menu',
				'theme_location' => 'side_menu',
				'container'      => false,
				'menu_class'     => 'side-menu',
			)
		);
		} else {
			echo '<p>' . esc_html__('Please Add Menu', 'pinacop') . '</p>';
		}

		?>

	</nav>

</aside>
<!-- /#sidenenu -->