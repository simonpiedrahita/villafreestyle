<?php
/* ---------------------------------------------------------------------------
 * Hook of Top
 * --------------------------------------------------------------------------- */
if (!function_exists('veda_hook_top')) {
function veda_hook_top() {
	if( veda_option( 'pageoptions','enable-top-hook' ) ) :
		echo '<!-- veda_hook_top -->';
			$hook = veda_option('pageoptions','top-hook');
			$hook = do_shortcode( stripslashes($hook) );
			if (!empty($hook))
				echo ( $hook );
		echo '<!-- veda_hook_top -->';
	endif;	
}
}
add_action( 'veda_hook_top', 'veda_hook_top' );


/* ---------------------------------------------------------------------------
 * Hook of Content before
 * --------------------------------------------------------------------------- */
if (!function_exists('veda_hook_content_before')) {
function veda_hook_content_before() {
	if( veda_option( 'pageoptions','enable-content-before-hook' ) ) :
		echo '<!-- veda_hook_content_before -->';
			$hook = veda_option('pageoptions','content-before-hook');
			$hook = do_shortcode( stripslashes($hook) );
			if (!empty($hook))
				echo ( $hook );
		echo '<!-- veda_hook_content_before -->';
	endif;
}
}
add_action( 'veda_hook_content_before', 'veda_hook_content_before' );


/* ---------------------------------------------------------------------------
 * Hook of Content after
 * --------------------------------------------------------------------------- */
if (!function_exists('veda_hook_content_after')) {
function veda_hook_content_after() {
	if( veda_option( 'pageoptions','enable-content-after-hook' ) ) :
		echo '<!-- veda_hook_content_after -->';
			$hook = veda_option('pageoptions','content-after-hook');
			$hook = do_shortcode( stripslashes($hook) );
			if (!empty($hook))
				echo ( $hook );
		echo '<!-- veda_hook_content_after -->';
	endif;
}
}
add_action( 'veda_hook_content_after', 'veda_hook_content_after' );


/* ---------------------------------------------------------------------------
 * Hook of Bottom
 * --------------------------------------------------------------------------- */
if (!function_exists('veda_hook_bottom')) {
function veda_hook_bottom() {
	if( veda_option( 'pageoptions','enable-bottom-hook' ) ) :
		echo '<!-- veda_hook_bottom -->';
			$hook = veda_option('pageoptions','bottom-hook');
			$hook = do_shortcode( stripslashes($hook) );
			if (!empty($hook))
				echo ( $hook );
		echo '<!-- veda_hook_bottom -->';
	endif;
}
}
add_action( 'veda_hook_bottom', 'veda_hook_bottom' );?>