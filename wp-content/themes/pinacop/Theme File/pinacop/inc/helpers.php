<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if(!class_exists('GpMetaBoxSettings')) {
	/**
	 * Metaboxes and options values
	 *
	 *
	 * @class 		GpMetaBoxSettings
	 * @version		1.0
	 * @category	Class
	 * @author 		GP Theme
	 */
	class GpMetaBoxSettings {
		/**
		 * Returns metabox option.
		 *
		 * @param $name
		 *
		 * @return string|bool
		 */
		public static function get($name) {
			global $post;

			if (isset($post) && !empty($post->ID) && !is_archive() && !is_search() && !is_404()) {
				return get_post_meta($post->ID, $name, true);
			}

			return false;
		}
		/**
		 * Checks if metabox value is defined then checks if param value is defined from theme options.
		 *
		 * @param $name
		 * @param $default
		 *
		 * @return string|bool
		 */
		public static function compared($name, $default = '') {
			global $gp_pinacop;

			$value = self::get($name);
			if($value || $value != '') {
				return $value;
			} elseif(!$value && isset($gp_pinacop[$name]) && !empty($gp_pinacop[$name])) {
				return $gp_pinacop[$name];
			} else {
				return $default;
			}
		}
	}
}
if(!class_exists('Gp_Theme_Helpers')) {
	/**
	 * Theme core helpers class
	 *
	 *
	 * @class 		Gp_Theme_Helpers
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 */
	class Gp_Theme_Helpers {

		/**
		 * Returns values for background position option.
		 *
		 * @return array
		 */
		public static function gp_get_bgposition() {
			return array(
				'' => esc_html__('Default', 'pinacop'),
				'left top' => esc_html__('left top', 'pinacop'),
				'left center' => esc_html__('left center','pinacop'),
				'left bottom' => esc_html__('left bottom','pinacop'),
				'right top' => esc_html__('right top','pinacop'),
				'right center' => esc_html__('right center','pinacop'),
				'right bottom' => esc_html__('right bottom','pinacop'),
				'center top' => esc_html__('center top','pinacop'),
				'center center' => esc_html__('center center','pinacop'),
				'center bottom' => esc_html__('center bottom','pinacop')
			);
		}


		/**
		 * Converts color to rgb(a).
		 *
		 * @param $hex
		 * @param float $opacity
		 *
		 * @return string
		 */
		public static function gp_hex2rgb($hex,$opacity=1) {
			$hex = str_replace("#", "", $hex);
			if(strlen($hex) == 3) {
				$r = hexdec(substr($hex,0,1).substr($hex,0,1));
				$g = hexdec(substr($hex,1,1).substr($hex,1,1));
				$b = hexdec(substr($hex,2,1).substr($hex,2,1));
			} else {
				$r = hexdec(substr($hex,0,2));
				$g = hexdec(substr($hex,2,2));
				$b = hexdec(substr($hex,4,2));
			}
			$rgba = 'rgba('.$r.','.$g.','.$b.','.$opacity.')';

			return $rgba;
		}

		public static function gp_vc_columns_to_string ($str = 1) {
			$arr = array(1 => 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve');

			if( isset($arr[$str]) )	{
				return $arr[$str];
			} else {
				return 'six';
			}
		}
		/**
		 * Returns margin VC param options array
		 *
		 * @return array
		 */
		public static function vc_margin_get_params() {
			return array(
				'margin-top' => '',
				'margin-bottom' => '',
				'margin-left' => '',
				'margin-right' => '',
			);
		}
		/**
		 * Returns border VC param options array
		 *
		 * @return array
		 */
		public static function vc_border_get_params() {
			return array(
				'border_style' => '',
				'border_width' => '',
				'border_top_width' => '',
				'border_bottom_width' => '',
				'border_left_width' => '',
				'border_right_width' => '',
				'border_radius' => '',
				'border_color' => '',
			);
		}
		/**
		 * Returns box-shadow VC param options array
		 *
		 * @return array
		 */
		public static function vc_box_shadow_get_params() {
			return array(
				'box_shadow_enable' => 'disable',
				'shadow_horizontal' => '0',
				'shadow_vertical' => '15',
				'shadow_blur' => '50',
				'shadow_spread' => '0',
				'box_shadow_color' => 'rgba(0,0,0,.35)',
			);
		}
		/**
		 * Returns gradient VC param options array
		 *
		 * @return array
		 */
		public static function vc_gradient_get_params() {
			return array(
				'gradient_style' => '',
				'gradient_custom_direction' => '',
				'gradient_value' => '',
				'gradient_css' => '',
			);
		}
		/**
		 * Returns responsive VC param options array
		 *
		 * @return array
		 */
		public static function vc_responsive_get_params() {
			return array(
				'margin_top_desktop' => '',
				'margin_bottom_desktop' => '',
				'margin_left_desktop' => '',
				'margin_right_desktop' => '',
				'padding_top_desktop' => '',
				'padding_bottom_desktop' => '',
				'padding_left_desktop' => '',
				'padding_right_desktop' => '',
				'border_top_desktop' => '',
				'border_bottom_desktop' => '',
				'border_left_desktop' => '',
				'border_right_desktop' => '',
				'margin_top_tablet' => '',
				'margin_bottom_tablet' => '',
				'margin_left_tablet' => '',
				'margin_right_tablet' => '',
				'padding_top_tablet' => '',
				'padding_bottom_tablet' => '',
				'padding_left_tablet' => '',
				'padding_right_tablet' => '',
				'border_top_tablet' => '',
				'border_bottom_tablet' => '',
				'border_left_tablet' => '',
				'border_right_tablet' => '',
				'margin_top_mobile' => '',
				'margin_bottom_mobile' => '',
				'margin_left_mobile' => '',
				'margin_right_mobile' => '',
				'padding_top_mobile' => '',
				'padding_bottom_mobile' => '',
				'padding_left_mobile' => '',
				'padding_right_mobile' => '',
				'border_top_mobile' => '',
				'border_bottom_mobile' => '',
				'border_left_mobile' => '',
				'border_right_mobile' => '',
			);
		}
		/**
		 * Returns responsive typography VC param options array
		 *
		 * @return array
		 */
		public static function vc_responsive_text_get_params() {
			return array(
				'font_size_desktop' => '',
				'line_height_desktop' => '',
				'letter_spacing_desktop' => '',
				'font_size_tablet' => '',
				'line_height_tablet' => '',
				'letter_spacing_tablet' => '',
				'font_size_mobile' => '',
				'line_height_mobile' => '',
				'letter_spacing_mobile' => '',
			);
		}
		/**
		 * Parses custom VC params values
		 *
		 * @param mixed $value
		 * @param string $method
		 *
		 * @return string
		 */
		public static function vc_param_parse_value($value, $method = '') {
			if($method != '' && method_exists('Gp_Theme_Helpers', $method)) {
				$params = self::$method();

				$values = vc_parse_multi_attribute($value, $params);
			}
			
			return $values;
		}
		
		/**
		 * Returns url of NO IMAGE pre-defined image
		 *
		 * @param string $size
		 *
		 * @return string
		 */
		public static function default_noimage_url($size = "") {
			switch ($size) {
				case "rect_small_140":
				return get_template_directory_uri() . '/assets/images/no_image_resized_675-450-140x140.jpg';
				break;
				case "rect_med_300":
				return get_template_directory_uri() . '/assets/images/no_image_resized_675-450-300x300.jpg';
				break;
				default:
				return get_template_directory_uri() . '/assets/images/no_image_resized_675-450.jpg';
				break;
			}
		}

	}
}


/**
 * Render custom styles.
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'pinacop_custom_css' ) ) {
	function pinacop_custom_css( $css = array() ) {
	
		
		// Typography
		$body_font    = cs_get_option( 'body-font',
			array(
				'family'=> 'Work Sans',
				'variant' => 'regular'
			)
		);
		$heading_font = cs_get_option( 'heading-font',
			array(
				'family'=> 'Montserrat',
				'variant' => '700'
			)
		);

		$css[] = 'body {';
			// Body font family
			$css[] = 'font-family: "' . $body_font['family'] . '";';
			if ( '100italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 100;
					font-style: italic;
				';
			} elseif ( '300italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 300;
					font-style: italic;
				';
			} elseif ( '400italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 400;
					font-style: italic;
				';
			} elseif ( '700italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 700;
					font-style: italic;
				';
			} elseif ( '800italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 700;
					font-style: italic;
				';

			} elseif ( '900italic' == $body_font['variant'] ) {
				$css[] = '
					font-weight: 900;
					font-style: italic;
				';
			} elseif ( 'regular' == $body_font['variant'] ) {
				$css[] = 'font-weight: 400;';
			} elseif ( 'italic' == $body_font['variant'] ) {
				$css[] = 'font-style: italic;';
			} else {
				$css[] = 'font-weight:' . $body_font['variant'] . ';';
			}

			// Body font size
			if ( cs_get_option( 'body-font-size' ) ) {
				$css[] = 'font-size:' . cs_get_option( 'body-font-size' ) . 'px;';
			}

			// Body color
			if ( cs_get_option( 'body-color' ) ) {
				$css[] = 'color:' . cs_get_option( 'body-color' );
			}
		$css[] = '}';

		$css[] = 'h1, h2, h3, h4, h5, h6 {';
			$css[] = 'font-family: "' . $heading_font['family'] . '";';
			if ( '100italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 100;
					font-style: italic;
				';
			} elseif ( '300italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 300;
					font-style: italic;
				';
			} elseif ( '400italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 400;
					font-style: italic;
				';
			} elseif ( '500italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 500;
					font-style: italic;
				';
			} elseif ( '600italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 600;
					font-style: italic;
				';
			} elseif ( '700italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 700;
					font-style: italic;
				';
			} elseif ( '900italic' == $heading_font['variant'] ) {
				$css[] = '
					font-weight: 900;
					font-style: italic;
				';
			} elseif ( 'regular' == $heading_font['variant'] ) {
				$css[] = 'font-weight: 400;';
			} elseif ( 'italic' == $heading_font['variant'] ) {
				$css[] = 'font-style: italic;';
			} else {
				$css[] = 'font-weight:' . $heading_font['variant'];
			}
		$css[] = '}';
		
		if ( cs_get_option( 'heading-color' ) ) {
			$css[] = 'h1, h2, h3, h4, h5, h6 {';
				$css[] = 'color:' . cs_get_option( 'heading-color' );
			$css[] = '}';
		}

		if ( cs_get_option( 'h1-font-size' ) ) {
			$css[] = 'h1 { font-size:' . cs_get_option( 'h1-font-size' ) . 'px; }';
		}
		if ( cs_get_option( 'h2-font-size' ) ) {
			$css[] = 'h2 { font-size:' . cs_get_option( 'h2-font-size' ) . 'px; }';
		}
		if ( cs_get_option( 'h3-font-size' ) ) {
			$css[] = 'h3 { font-size:' . cs_get_option( 'h3-font-size' ) . 'px; }';
		}
		if ( cs_get_option( 'h4-font-size' ) ) {
			$css[] = 'h4 { font-size:' . cs_get_option( 'h4-font-size' ) . 'px; }';
		}
		if ( cs_get_option( 'h5-font-size' ) ) {
			$css[] = 'h5 { font-size:' . cs_get_option( 'h5-font-size' ) . 'px; }';
		}
		if ( cs_get_option( 'h6-font-size' ) ) {
			$css[] = 'h6 { font-size:' . cs_get_option( 'h6-font-size' ) . 'px; }';
		}

		// Primary color
		$primary_color = cs_get_option( 'primary-color' );
		if ( $primary_color ) {
			$css[] = '
				q,
				.cp, .chp:hover,
				.inside-thumb a:hover,
				.gp-btn.gp-btn-transperant:hover,
				.share a, .top-menu .info p i,
				.gp-socicon-Search:hover, .gp-socicon-Search:focus,
				#header.navbar-small .menu__list .menu-item a:hover,
				.box-icon-one .box-icon,
				.headind-wrap .head-typed-title span.typed-title,
				.static-banner-content h2 span,
				.profile-info .profile-title,.profile-list li a:hover,
				.feature-item-one .icon-container i, .feature-item-two .content h4,
				.icon-box.top :hover .icon-container i,
				.feature-item-six .icon-container i,
				.icon-box.icon-left-side .icon-container,				
				.icon-box.icon-left-side .icon-container.bg_squere, 
				.icon-box.icon-right-side .icon-container.bg_squere,
				.icon-box.top.box-border-botom .icon-container i,
				.panel-group .panel-active a,
				.panel-group .panel-title > a:hover,
				.panel-group .panel-title > a:focus,
				.gp-pricing .pricing-item:hover .pricing-price,
				.pricing-action .gp-btn, 
				.blog-post-light .blog-post-content .entry-title a:hover,
				.blog-post-content .entry-title a:hover, .post-meta li a:hover,
				.post-footer .categories a:hover,
				.post-footer .post-status li a:hover,
				.read-more-btn:hover, .read-more-btn:focus,
				.page-template-blog-page .blog-post .entry-title a:hover,
				.page-template-blog-page .blog-post .post-footer .post-status li a:hover,
				.pinacop_blog_post_list .post-meta li a i, .blog-grid .post-meta li a i,
				.gp-content-wrap:not(.pinacop_single_post) .blog-post.sticky > .blog-post-content .entry-title a,
				.pinacop_blog_post_list .read-more-btn, .blog-grid .read-more-btn,
				.pinacop_blog_post_list .post-footer .categories a:hover, .blog-grid .post-footer .categories a:hover,
				.pinacop_blog_post_list .post-footer .post-status li a:hover, .blog-grid .post-footer .post-status li a:hover,
				.pinacop_breadcrumbs span a:hover, .entry-meta a:hover,
				.entry-content p a, .entry-content ul li a:hover
				.entry-content blockquote p a:hover, code,
				.entry-tcs .cat-lists,
				.pinacop-quote-holder-inner .pinacop-title a:hover,
				.pinacop-quote-holder-inner .pinacop-quote-author a:hover,
				.entry-tcs span i, .entry-tcs span a:hover, .share-trigger,
				.profile_content .gp-social-link li a:hover,
				.entry-header .entry-title a:hover, 
				.comment-body .comment-meta a:hover,
				.testi-content h4, .testimonial-four .client-details h4,
				.piechart-icon i,			
				.counter-box-one .icon-wrap i, .counter .counter-box-two .icon-wrap i,
				.box_icon_two h3, .event-details .time, .footer-wrapper .widget ul li a:hover,
				.copyright-bar .site-info p a, .page-heading .page-link a:hover,
				.my-details h4,	.resent-post:hover .content h4,
				.resent-post:hover .date,
				.recent_posts_widget .resent-post .comments i,
				.widget_categories ul li a:hover,
				.widget_recent_comments #recentcomments li a:hover,
				.widget_meta ul li a:hover, .widget_pages ul li a:hover,
				.widget_rss .rss-date, .widget_rss .rsswidget:hover,				
				.site-footer .resent-post .content h4:hover,
				.site-footer .recent_posts_widget .resent-post .date,
				.widget_nav_menu ul li a:hover, .widget_recent_entries .resent-post .post-content h5 a:hover,
				.widget_recent_entries .resent-post .post-content .post-meta li a,
				.widget_recent_entries ul li a:hover,
				.widget_archive ul li:hover a, .widget_archive ul li:hover p,
				.icon-box.top h4, .post-meta li a i, .post-footer .categories i,
				.post-footer .post-status li a i, .read-more-btn:hover {
					color: ' . esc_attr( $primary_color ) . ';
				}
			
				.section-title .delimeter:after,
				.gp-btn:before,.gp-btn-bg:after,				
				.gp-btn.gp-btn-active,.app-down-btn:hover,
				.menu--shylock a:before,.top-menu .info span,
				.top-link .gp-social-link li,
				.static-banner-content .btn-active,
				.feature-item-two .icon-container:before,
				.icon-box.top  h4:after,
				.icon-box.top .icon-container.bg_circle_co,
				.icon-box.top:hover .icon-container.bg_squere,
				.feature-item-four .icon-container,
				.feature-item-five:hover,
				.feature-item-six h4:after,
				.icon-box.icon-left-side .icon-container.bg_circle_co, 
				.icon-box.icon-right-side .icon-container.bg_circle_co,			
				.icon-box.icon-left-side .icon-container.bg_squere_co, 
				.icon-box.icon-right-side .icon-container.bg_squere_co,
				.icon-box.icon-left-side:hover .icon-container.bg_circle, 
				.icon-box.icon-right-side:hover .icon-container.bg_circle,
				.icon-box.icon-left-side:hover .icon-container.bg_squere,
				.icon-box.icon-right-side:hover .icon-container.bg_squere,
				.prosses-box, .pinacop-modal-video .video-btn,
				.pinacop-modal-video .video-btn:before,
				.pinacop-tab .pin-tab-nav li a:hover, 
				.pinacop-tab .pin-tab-nav li.active a,
				.pinacop-tab-two .pin-tab-nav li:hover, 
				.pinacop-tab-two .pin-tab-nav li.active,
				.gp-pricing .pricing-price::before,
				.pricing-action .gp-btn:hover:before, 
				.pricing-action .gp-btn:focus:before,
				.gp-pricing .pricing-item.pricing-box-two.active.dark-mode,
				.gp-pricing .pricing-item.pricing-box-two.active.dark-mode:before,
				.gp-pricing .pricing-item.pricing-box-two.active.dark-mode:after,
				.pricing-box-one.active .pricing-header, .feature-img-wrap .date-box,
				.single-post .entry-tcs .cat-lists a:hover,
				.pinacop_single_post .entry-content form.post-password-form input[type=submit]:hover,
				.share-trigger .share-items .gp-share-btn:hover, 
				.comment-form p .submit:hover,
				.comment-body .reply .comment-reply-link:hover,
				.testimonial .tm-control .tm-prev:hover, .testimonial .tm-control .tm-next:hover,
				.testimonials_carousel_pagination .swiper-pagination-bullet.swiper-pagination-bullet-active,
				.testimonials_carousel_pagination .swiper-pagination-bullet:hover,
				#register-form p .gp-btn,
				.pinacop-portfolio .pinacop-portfolio-content .portfolio-item .layer .overlay-item.default .content-layer .icon-item:hover,
				.pinacop-portfolio .pinacop-portfolio-content .portfolio-item .layer .overlay-item.default .content-layer .icon-link:hover,
					.pinacop-portfolio .pinacop-portfolio-filter.light .filter-item .but:hover, .pinacop-portfolio .pinacop-portfolio-filter.light .filter-item .but.activbut,
				.pinacop-portfolio .pinacop-portfolio-filter .filter-item .but.activbut, .pinacop-portfolio .pinacop-portfolio-filter .filter-item .but:hover,				
				.portfolio-share-meta h4:after, .portfolio-share a:hover,
				.port-nav-prev a:hover, .port-nav-next a:hover
				.skill-bar .progress-bar, .counter .counter-box-two .value:after,
				.service-item .service-thumb .service-header .service-title span:after,
				.box_icon_two .icon_box:before, .feature-item-seven:hover, .service-title h3:after,				
				.pinacop_team_members-one .team-member .team-profail li:hover,
				.pinacop_team_members-two  .team-member .member-details .member-bio,
				.pinacop_team_members-two  .team-member .member-details .member-bio:before,
				.vc_tta-container .vc_tta.vc_tta-style-classic .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active,
				.address-info li .info-icon, #ajax-form-two .gp-btn:hover,
				#ajax-form .gp-btn:hover, .transparent_row #ajax-form .gp-btn,
				#call-back .gp-btn, #footer .gp-social-link li:hover, .widget_calendar tbody td#today,
				.footer-wrapper .widget_calendar tbody td#today, 
				#footer-two .footer-social-link .gp-social-link li a:hover,
				.share .social-share li a:hover, .instagram-feed h4:after,
				.form-search-section .form-search span.gp-background-main,
				.tagcloud a, .widget_pinacop_ess_newsletter_widget .newsletter-wrapper .gp-btn,
				.site-footer .pinacop_address_widget .address li .icon, #author,
				.widget .widget-title:after, .content_404 .gp-btn, .skill-bar .progress-bar
				 {
					background: ' . esc_attr( $primary_color ) . ';
				}				
			
				.gp-btn.gp-btn-outline:hover, .gp-btn.gp-btn-outline:focus,
				.menu-item .child-menu,
				a.button:hover,
				.top-menu .info span:after,
				.menu__list .menu-item-has-children .sub-menu,
				.static-banner-content .btn-active,
				.profile-info,
				.p-video a:hover, .hire-btn,
				.feature-item-two .icon-container,.hire-btn, 
				.icon-box.top .icon-container.bg_squere,
				.icon-box.top .icon-container.bg_squere_co,				
				.icon-box.icon-left-side:hover .icon-container.bg_circle:before, 
				.icon-box.icon-right-side:hover .icon-container.bg_circle:before,
				.icon-box.icon-left-side .icon-container.bg_squere, 
				.icon-box.icon-right-side .icon-container.bg_squere,
				.video-btn:hover:after,.video-btn:focus:after,
				.video-btn:active:after,.video-btn:focus:active:after,
				.pinacop-modal-video .video-btn:hover:after,
				.pinacop-modal-video .video-btn:focus:after,
				.pinacop-modal-video .video-btn:active:after,
				.pinacop-modal-video .video-btn:focus:active:after,
				.pinacop-tab .pin-tab-nav, .pricing-action .gp-btn,
				.entry-content blockquote, .single-post .entry-tcs .cat-lists a:hover,
				.testimonial .tm-control .tm-prev:hover, .testimonial .tm-control .tm-next:hover,
				.port-nav-prev a:hover, .port-nav-next a:hover,				
				.counter-box-one .icon-wrap, .box_icon_two .icon_box,
				#call-back input:hover, #call-back input:focus, #call-back select:hover, #call-back select:focus,
				#call-back .gp-btn,
				.widget_pinacop_ess_newsletter_widget .newsletter-wrapper form:hover {
					border-color: ' . esc_attr( $primary_color ) . ';
				}

				.icon-box.top.box-border-botom {
					border-bottom-color: ' . esc_attr( $primary_color ) . ';
				}

				.pinacop-modal-video .video-btn:hover:after, .pinacop-modal-video .video-btn:focus:after,
				.pinacop-modal-video .video-btn:active:after, .pinacop-modal-video .video-btn:focus:active:after {
					border-color: transparent transparent transparent #FFF !important;
				}
				.video-btn:hover:after, .video-btn:focus:after, .video-btn:active:after, .video-btn:focus:active:after {
					border-color: transparent transparent transparent ' . esc_attr( $primary_color ) . ';
				}

				.skill-bar .progress-bar:after {
					border-bottom-color: ' . esc_attr( $primary_color ) . ';
				}
			
				input[type="submit"]:hover,				
				a.button:hover,
				.jas-ajax-load a:hover,
				.bgp, .bghp:hover,
				.signup-newsletter-form input.submit-btn:hover,
				.widget .tagcloud a:hover,
				.widget_price_filter .ui-slider-range,
				.widget_price_filter .ui-state-default,
				.jas-mini-cart .checkout,
				.jas-ajax-load a:hover,
				.metaslider .flexslider .flex-prev, 
				.metaslider .flexslider .flex-next,
				.single_add_to_cart_button,
				.jas_wcpb_add_to_cart.single_add_to_cart_button,
				.jas-service[class*="icon-"] .icon:before {
					background-color: ' . esc_attr( $primary_color ) . ';
				}
			';
		}

		// Secondary color
		$secondary_color = cs_get_option( 'secondary-color' );
		if ( $secondary_color ) {
			$css[] = '
				a,
				h1, h2, h3, h4, h5, h6,
				input[type="submit"],
				button,
				a.button,
				.jas-ajax-load a,
				.cd,
				.wp-caption-text,
				#jas-header .jas-social a,
				#jas-backtop:hover span i,
				.page-numbers li,
				.page-numbers li a,
				.jas-portfolio-single .portfolio-meta span,
				.sidebar .widget ul li:before,
				.widget ul.product_list_widget li a span.product-title,				
				.filter-trigger:hover,
				.filter-trigger:focus,
				.jas-mini-cart .mini_cart_item a:nth-child(2),
				.btn-atc .yith-wcwl-add-to-wishlist .ajax-loading,
				.product-category h3,
				.quantity input.input-text[type="number"],
				.cart .yith-wcwl-add-to-wishlist a,
				.wc-tabs li.active a,
				.wc-tabs li a:hover,
				.shop_table th,
				.order-total,
				.order-total td,
				.woocommerce-MyAccount-navigation ul li a,
				.jas-filter a.selected,
				.jas-filter a:hover,
				.jas-row .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a:focus, 
				.jas-row .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a:hover,
				.jas-row .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active > a,
				.metaslider .flexslider .caption-wrap h2,
				.metaslider .flexslider .caption-wrap h3,
				.metaslider .flexslider .caption-wrap h4,
				.jas-menu ul li:hover > a,
				#jas-mobile-menu ul li a,
				.holder {
					color: ' . esc_attr( $secondary_color ) . ';
				}
				input:not([type="submit"]):not([type="checkbox"]):focus,
				textarea:focus,
				.error-404.not-found a,
				.more-link,
				.widget .tagcloud a,
				.widget .woocommerce-product-search,
				.widget .search-form,
				.woocommerce .widget_layered_nav ul.yith-wcan-label li a:hover,
				.woocommerce-page .widget_layered_nav ul.yith-wcan-label li a:hover,
				.woocommerce .widget_layered_nav ul.yith-wcan-label li.chosen a,
				.woocommerce-page .widget_layered_nav ul.yith-wcan-label li.chosen a,
				.jas-ajax-load a,
				form .quantity,
				.quantity input.input-text[type="number"]:focus,
				.cart .yith-wcwl-add-to-wishlist,
				.wc-tabs li.active a,
				.p-video a,
				.jas-filter a.selected,
				.jas-row .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a:focus, 
				.jas-row .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a:hover,
				.jas-row .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active > a {
					border-color: ' . esc_attr( $secondary_color ) . ';
				}
				mark,
				.signup-newsletter-form input.submit-btn,
				.error-404.not-found a:hover,
				.more-link:hover,
				.widget h4.widget-title:after,
				.widget .woocommerce-product-search input[type="submit"],
				.widget .search-form .search-submit,
				.woocommerce .widget_layered_nav ul.yith-wcan-label li a:hover,
				.woocommerce-page .widget_layered_nav ul.yith-wcan-label li a:hover,
				.woocommerce .widget_layered_nav ul.yith-wcan-label li.chosen a,
				.woocommerce-page .widget_layered_nav ul.yith-wcan-label li.chosen a,
				.jas-mini-cart .button,
				.btn-quickview:hover,
				.tab-heading:after,
				.product-extra-title h2:before,
				.product-extra-title h2:after,
				.section-title:before,
				.section-title:after {
					background-color: ' . esc_attr( $secondary_color ) . ';
				}
			';
		}
		// Header Top color
		$header_top_color = cs_get_option( 'header-top-color' );
		if ( $header_top_color ) {
			$css[] = '
				.jas-socials a,
				.header-text,
				.header__top .jas-action a {
					color: ' . esc_attr( $header_top_color ) . ';
				}
			';
		}
		// Header color
		if ( cs_get_option( 'header-background' ) ) {
			$css[] = '#header { background-color: ' . esc_attr( cs_get_option( 'header-background' ) ) . '}';
		}

		// Header top
		if ( cs_get_option( 'header-top-background' ) ) {
			$css[] = '.header__top { background-color: ' . esc_attr( cs_get_option( 'header-top-background' ) ) . '}';
		}

		// Menu color
		if ( cs_get_option( 'main-menu-color' ) ) {
			$css[] = '
				.menu-item a,				
				#jas-mobile-menu ul > li:hover > a, 
				#jas-mobile-menu ul > li.current-menu-item > a, 
				#jas-mobile-menu ul > li.current-menu-parent > a, 
				#jas-mobile-menu ul > li.current-menu-ancestor > a,
				#jas-mobile-menu ul > li:hover > .holder, 
				#jas-mobile-menu ul > li.current-menu-item > .holder,
				#jas-mobile-menu ul > li.current-menu-parent  > .holder,
				#jas-mobile-menu ul > li.current-menu-ancestor > .holder {
					color: ' . esc_attr( cs_get_option( 'main-menu-color' ) ) . ';
				}
			';
		}
		if ( cs_get_option( 'main-menu-hover-color' ) ) {
			$css[] = '
				.menu-item a:hover,
				#menu-header-menu a::before,
				#menu-header-menu .current-menu-item a,
				#menu-header-menu .current-menu-item a:hover,
				#menu-header-menu .current-menu-item a:focus,
				#menu-header-menu a:hover,
				#menu-header-menu a:focus,
				.side-menu li a:hover {
					color: ' . esc_attr( cs_get_option( 'main-menu-hover-color' ) ) . ' !important;
				}
			';
		}

		if ( cs_get_option( 'main-menu-hover-color' ) ) {
			$css[] = '				
				#menu-header-menu a:before{
					background: ' . esc_attr( cs_get_option( 'main-menu-hover-color' ) ) . ' !important;
				}
			';
		}
		if ( cs_get_option( 'sub-menu-color' ) ) {
			$css[] = '
				#menu-header-menu li .sub-menu li a {
					color: ' . esc_attr( cs_get_option( 'sub-menu-color' ) ) . ';
				}
			';
		}
		if ( cs_get_option( 'sub-menu-hover-color' ) ) {
			$css[] = '
				#menu-header-menu li .sub-menu li a:hover {
					color: ' . esc_attr( cs_get_option( 'sub-menu-hover-color' ) ) . ';
				}
			';
		}
		if ( cs_get_option( 'sub-menu-background-color' ) ) {
			$css[] = '
				.jas-menu ul, .jas-account-menu ul {
					background: ' . esc_attr( cs_get_option( 'sub-menu-background-color' ) ) . ';
				}
			';
		}

		// Footer color
		if ( cs_get_option( 'footer-background' ) ) {
			$css[] = '
				#jas-footer {
					background: ' . esc_attr( cs_get_option( 'footer-background' ) ) . ';
				}
			';
		}
		if ( cs_get_option( 'footer-color' ) ) {
			$css[] = '
				#jas-footer {
					color: ' . esc_attr( cs_get_option( 'footer-color' ) ) . ';
				}
			';
		}

		if ( cs_get_option( 'footer-link-color' ) ) {
			$css[] = '
				.footer__top a, .footer__bot a {
					color: ' . esc_attr( cs_get_option( 'footer-link-color' ) ) . ';
				}
			';
		}

		if ( cs_get_option( 'footer-link-hover-color' ) ) {
			$css[] = '
				.footer__top a:hover, .footer__bot a:hover {
					color: ' . esc_attr( cs_get_option( 'footer-link-hover-color' ) ) . ';
				}
			';
		}

		// Custom css
		if ( cs_get_option( 'custom-css' ) ) {
			$css[] = cs_get_option( 'custom-css' );
		}

		return preg_replace( '/\n|\t/i', '', implode( '', $css ) );
	}
}
