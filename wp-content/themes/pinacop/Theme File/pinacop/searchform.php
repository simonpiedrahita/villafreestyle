<?php
/**
 * Template for displaying search forms in Grand
 *
 * @package WordPress
 * @subpackage Pinacop
 * @since 1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }
$id_s = uniqid('s_'); ?>

<form role="search" method="get" id="<?php echo uniqid('searchform_'); ?>" class="form-search" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="text" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" id="<?php echo esc_attr($id_s); ?>" class="search-query" placeholder="<?php esc_html_e('Search on site...', 'pinacop'); ?>">
    <span class="gp-background-main" style="display: none;"></span>
    <input type="submit" value="<?php esc_html_e('Search', 'pinacop'); ?>" class="gp-search-btn">
    <i class="gp-socicon-Search fa fa-search"></i>

    <span class="header-search-switcher icon dti-remove close-search"></span>
</form>