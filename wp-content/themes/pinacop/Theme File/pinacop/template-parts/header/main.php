<div class="header-inner">
	<?php if ( cs_get_option( 'header-boxed' ) ) : echo '<div class="container">'; endif; ?>
		<div class="header clearfix">
			<div class="header-left site-logo">
				<?php
				$default      = get_template_directory_uri() . '/assets/img/logo_fixed.png';
				$defaultCont  = get_template_directory_uri() . '/assets/img/logo_fixed.png';
				$logo         = cs_get_option( 'pinacop_main_logo', $default );
				$logoContrast = cs_get_option( 'pinacop_sticky_logo', $defaultCont );
				

				if(! empty ($logo)) {
					echo '<a href="'. esc_url( home_url( '/' ) ) .'"><img src="'. esc_url( $logo ) .'" alt="logo" class="logo-light"></a>';
				} else {
					echo get_bloginfo('name');
				}

				if(! empty($logoContrast)) {
					echo '<a href="'.esc_url( home_url( '/' ) ).'"><img src="'.esc_url( $logoContrast ) .'" alt="logo" class="logo-dark"></a>';
				} else {
					echo get_bloginfo('name');
				}

				?>				
				
			</div>
			<?php
				
				$cs_option = cs_get_option('menu_align');

				$classes = (! empty($cs_option)) ? $cs_option : 'text-right';

			?>
			<div class="header-center">
				<nav class="menu menu--shylock <?php echo esc_attr($classes); ?>" id="active-menu">

					<?php
					if ( has_nav_menu( 'main_menu' ) ) {
						wp_nav_menu( array(
							'menu'           => 'Primary Menu',
							'theme_location' => 'main_menu',
							'container'      => false,
							'menu_class'     => 'menu__list header-center',
							'menu_id'        => 'menu-header-menu'
						)
					);
					}  else {
								echo '<ul id="menu-header-menu"><li class="add-menu"><a target="_blank" href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Add Menu', 'pinacop' ) . '</a></li></ul>';
							}

					?>

				</nav>
			</div><!-- /.Header-center -->
			<div class="share-menu header-right">

				<?php
				$opt = cs_get_option( 'topbar_menu', false );

				
					?>

		
					<div class="search-btn">
							<a href="#0" class="header-search-switcher gp-socicon-Search"><i class="fa fa-search"></i></a>
						</div>
							

					
					<div class="menu-toggle toggle-inner toggle-menu">
						<div></div>
						<div></div>
						<div></div>
					</div><!-- /.menu-toggle -->
				</div><!-- /.shere-menu -->
			</div>
			<?php if ( cs_get_option( 'header-boxed' ) ) : echo '</div>'; endif; ?>
		</div><!-- /.header-inner -->	

		<div class="form-search-section">
			<div id="gp-search-loader" class="pageload-overlay"
			data-opening="M 0,0 c 0,0 63.5,-16.5 80,0 16.5,16.5 0,60 0,60 L 0,60 Z">
			<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 80 60"
			preserveAspectRatio="none">
			<path d="M 0,0 c 0,0 -16.5,43.5 0,60 16.5,16.5 80,0 80,0 L 0,60 Z"/>
		</svg>
	</div>
	<div class="row">
		<?php get_template_part( 'searchform' ); ?>
	</div>
</div>