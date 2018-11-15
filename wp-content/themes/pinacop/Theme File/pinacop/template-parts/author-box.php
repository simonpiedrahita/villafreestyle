<?php
/**
 * Template for displaying the author bio box
 */

$display = cs_get_option( 'pinacop_single_author_bio' );
$description = get_the_author_meta( 'description' );
$contact_methods = pinacop_get_user_profiles();

if ( $display == false  || empty( $description ) )

	return;
?>
<div class="pinacop_post_author_box clearfix">
	
	<div class="profile_image">
		<?php echo get_avatar( get_the_author_meta( 'email' ), '100' ); ?>
	</div><!-- /.profile_image -->

	<div class="profile_content">
		<h4 class="profile_name"><?php echo get_the_author(); ?></h4>

		<?php
			if ( ! empty( $description ) ) {
				echo '<div class="profile_bio">';
				echo wp_kses_post( $description );
				echo '</div>';
			}

			if ( $contact_methods == true ) {
				echo '<ul class="gp-social-link">';
				foreach ( $contact_methods as $item ) {
					echo '<li><a href="' . esc_url( $item['link'] ) . '" title="' . esc_attr( $item['title'] ) . '"><i class="' . esc_attr( $item['icon'] ) . '"></i></a></li>';
				}
				echo '</ul>';
			}
		?>
	</div><!-- /.profile_content -->
</div><!-- /.pinacop_post_author_box -->