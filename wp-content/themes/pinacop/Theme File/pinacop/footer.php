<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Pinacop
 * @since 1.0
 * @version 1.0
 */


	if ( ! ( is_404() || ( is_page() && is_front_page() ) == true ) ) {
		get_template_part( 'template-parts/footer/shortcodes' );
	}
	?>		

	<footer id="footer" class="site-footer">
		<?php
		get_template_part( 'template-parts/footer/widgets-area' );
		get_template_part( 'template-parts/footer/site-info' );
		?>
	</footer><!-- #footer -->
	</div><!-- #page -->
	<?php wp_footer(); ?>

	</body>
</html>
