<?php
/**
 * Displays footer widgets if assigned
 *
 * @package WordPress
 * @subpackage Pinacop
 * @since 1.0
 * @version 1.0
 */

?>

<?php
if ( is_active_sidebar( 'sidebar-2' ) ||
	 is_active_sidebar( 'sidebar-3' ) ||
	 is_active_sidebar( 'sidebar-4' ) ||
	 is_active_sidebar( 'sidebar-5' ) ) :
?>
<div class="footer-wrapper">
	<div class="container">

		<aside class="widget-area row">
			<?php
				$area_1_display = get_theme_mod( 'pinacop_widget_area_1_display',  true );
				$area_1_column = get_theme_mod( 'pinacop_widget_area_1_column', 'col-md-3' );
				if ( is_active_sidebar( 'sidebar-2' )  && $area_1_display == true ) {
			?>
				<div class="widget-column footer-widget-1 <?php echo esc_attr( $area_1_column ); ?>">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div>
			<?php }
				$area_2_display = get_theme_mod( 'pinacop_widget_area_2_display', true );
				$area_2_column = get_theme_mod( 'pinacop_widget_area_2_column', 'col-md-3' );
				if ( is_active_sidebar( 'sidebar-3' ) && $area_2_display == true ) {
			?>
				<div class="widget-column footer-widget-2 <?php echo esc_attr( $area_2_column ); ?>">
					<?php dynamic_sidebar( 'sidebar-3' ); ?>
				</div>
			<?php }
				$area_3_display = get_theme_mod( 'pinacop_widget_area_3_display', true );
				$area_3_column = get_theme_mod( 'pinacop_widget_area_3_column', 'col-md-3' );
				if ( is_active_sidebar( 'sidebar-4' ) && $area_3_display == true ) {
			?>
				<div class="widget-column footer-widget-3 <?php echo esc_attr( $area_3_column ); ?>">
					<?php dynamic_sidebar( 'sidebar-4' ); ?>
				</div>
			<?php }
				$area_4_display = get_theme_mod( 'pinacop_widget_area_4_display', true );
				$area_4_column = get_theme_mod( 'pinacop_widget_area_4_column', 'col-md-3' );
				if ( is_active_sidebar( 'sidebar-5' ) && $area_4_display == true ) { ?>
				<div class="widget-column footer-widget-4 <?php echo esc_attr( $area_4_column ); ?>">
					<?php dynamic_sidebar( 'sidebar-5' ); ?>
				</div>
			<?php } ?>
		</aside><!-- .widget-area -->
		
	</div><!-- .container -->	
</div><!-- /.footer-wrapper -->

<?php endif; ?>
