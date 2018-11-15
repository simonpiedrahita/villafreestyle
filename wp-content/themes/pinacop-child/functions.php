 <?php
/**
 * Function to work child theme css
 */
function pinacop_child_theme_enqueue_styles() {
    wp_enqueue_style( 'pinacop-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'pinacop-child', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'pinacop_child_theme_enqueue_styles' );
