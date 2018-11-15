var screen_medium = 800,
headerResponsiveBreakpoint = 1100;

if (!window.requestAnimationFrame) {

	window.requestAnimationFrame = (function () {

		return window.webkitRequestAnimationFrame ||
		window.mozRequestAnimationFrame ||
		window.oRequestAnimationFrame ||
		window.msRequestAnimationFrame ||
		function (/* function FrameRequestCallback */ callback, /* DOMElement Element */ element) {

			window.setTimeout(callback, 1000 / 60);

		};

	})();
}


(function($){
	"use strict";
	$.fn.equalHeightsDestroy = function(){
		$(this)
			.css({
				'height': 'auto',
				'min-height': '0px'
			});
		
		return this;
	};
	// http://www.cssnewbie.com/equalheights-jquery-plugin/
	$.fn.equalHeights = function(options) {
		var settings = $.extend( {
			container: null
		}, options);
		
		var currentTallest = 0;
		var outerTallest = 0;
		var $this = $(this);
		
		$this
			.css({
				'height': 'auto',
				'min-height': '0px'
			})
			.each(function() {
				var $el = $(this);
		
				if ($el.height() > currentTallest) {
					currentTallest = $el.height();
					outerTallest = $el.outerHeight();
				}
			})
			.css({
				'height': outerTallest,
				'min-height': outerTallest
			});
			
			if (settings.container!=null) {
				$this.parents(settings.container).css({
					'height': outerTallest,
					'min-height': outerTallest
				});
			}
			
		return this;
	};
	
	$.fn.splitRows = function(options) {
		var settings = $.extend( {
			container: '.row',
			class: 'row-i-'
		}, options);

		if (this.length === 0) {
			return this;
		}

		var $container = $(this[0]).parent(settings.container);
		var container_width = $container.innerWidth();

		var els_width_summ = 0;
		var row_i = 0;
		var row = [];
		
		this.each(function(){
			var $el = $(this);
			var el_width = $el.width();
			els_width_summ += el_width;

			if (els_width_summ > container_width) {
				els_width_summ = el_width;
				row_i += 1;
				row = [];
			}

			var old_row_i = $el.attr('data-row');
			if (old_row_i) {
				$el.removeClass(settings.class + old_row_i);
			}
			
			$el.attr('data-row', row_i).addClass(settings.class + row_i);
			
			if (row_i==0) {
				$el.attr('data-row', row_i).addClass('row-first');
			}
			
			row.push($el);
		});
		
		for(var i in row) {
			row[i].addClass('row-last');
		}

		return this;
	};

	$.fn.verticalCenterAlign = function() {
		return this.each(function(){
			var $this = $(this);
			var $parent = $this.parent();

			$this.css("position","absolute");
			$this.css("top", ( $parent.height() - $this.height() ) / 2  + "px");

			return this;

		});
	};

	$.equalHeightsAdvanced = function(options) {
		var settings = $.extend({
			container: '.row-goods',
			cell: '.cell',
			class: 'row-i-',
			class_first_el: 'row-el-first',
			class_last_el: 'row-el-last',
			class_row_first: 'row-first',
			class_row_last: 'row-last',
			equalHeight: true
		}, options);

		var $split_rows_items = $(settings.container +' '+ settings.cell);
		$split_rows_items.splitRows(settings);

		var $prev_el;
		var old_class;
		var row_num = 0;
		var el_i=0;
		var els_in_row = 0;
		var el_class_buf;

		$split_rows_items.each(function() {
			var $el = $(this);
			$el
				.removeClass(settings.class_first_el)
				.removeClass(settings.class_middle_el)
				.removeClass(settings.class_last_el)
				.removeClass(settings.class_row_first)
				.removeClass(settings.class_row_last);

			var old_row_i = $el.attr('data-row');
			var el_class = settings.class + old_row_i;
			
			el_i++;
			if (old_class !== el_class) {
				row_num++;
				els_in_row = el_i;
				el_i = 0;
				
				if (settings.equalHeight) {
					$(settings.container +' .'+ el_class).equalHeights();
				}
				old_class = el_class;
				
				$el.addClass(settings.class_first_el);
				
				if ($prev_el) {
					$prev_el.addClass(settings.class_last_el);
				}
			}

			if (row_num===1) {
				$el.addClass(settings.class_row_first);
			}
			
			$prev_el = $el;
			el_class_buf = el_class;
		});
		
		$(settings.container +' .'+ el_class_buf).addClass(settings.class_row_last);

		if (els_in_row && (els_in_row-1)===el_i) {
			$prev_el.addClass(settings.class_last_el);
		}

		return this;
	};


})(jQuery);



(function($) {
	"use strict";
	var gp_pinacop = window.gp_pinacop || {};
	
	window.gp_pinacop = gp_pinacop;
	
	gp_pinacop.window = $(window),
	gp_pinacop.document = $(document),
	gp_pinacop.windowHeight = gp_pinacop.window.height(),
	gp_pinacop.windowWidth = gp_pinacop.window.width(),
	gp_pinacop.scrollbarWidth = 0,
	gp_pinacop.windowScrollTop = 0;
	gp_pinacop.sameOrigin = true;
	
	gp_pinacop.initObjectsSizing = function() {
		try {
			gp_pinacop.sameOrigin = window.parent.location.host == window.location.host;
		} catch (e) {
			gp_pinacop.sameOrigin = false;
		}
		
		var recalcWindowOffset = function() {
			gp_pinacop.windowScrollTop = gp_pinacop.window.scrollTop();
		};

		gp_pinacop.document.ready(function() {
			var div = document.createElement('div');

			div.style.overflowY = 'scroll';
			div.style.width =  '50px';
			div.style.height = '50px';

			div.style.visibility = 'hidden';

			document.body.appendChild(div);
			gp_pinacop.scrollbarWidth = div.offsetWidth - div.clientWidth;
			document.body.removeChild(div);

		});

		var recalcWindowInitHeight = function() {
			gp_pinacop.windowHeight = gp_pinacop.window.height();
			gp_pinacop.windowWidth = gp_pinacop.window.width() + gp_pinacop.scrollbarWidth;

			recalcWindowOffset();
		};

		recalcWindowInitHeight();

		recalcWindowOffset();
		
		gp_pinacop.window
		.on("resize load", recalcWindowInitHeight)
		.on("scroll", recalcWindowOffset);
		
		gp_pinacop.window.on("load", function() {
			$('body').trigger('reinit-waypoint');
		});
	};
	
	gp_pinacop.initParallaxBackground = function (){
		var gpParallax = function() {
			$('.gp_stun_header_vertical_parallax, .gp-row-parallax, .gp-column-parallax, .gp-fade-on-scroll, .gp-row-bg-image.gp_vertical_parallax, .gp-row-bg-image.gp_horizontal_parallax, .gp-multi-parallax-layer, .stuning-header-inner .page-title-inner').each(function() {
				
				var $self = $(this), offsetCoords, topOffset, selfHeight;

				var recalcInitValues = function() {
					offsetCoords = $self.offset();
					if($self.hasClass('gp_vertical_parallax')) {
						offsetCoords = $self.parent().offset();
					}
					selfHeight = $self.height();
					if($self.hasClass('gp_vertical_parallax')) {
						selfHeight = $self.parent().height();
					}
					topOffset = offsetCoords.top;
				};

				recalcInitValues();

				gp_pinacop.window.on("load resize", recalcInitValues);

				var speed = parseFloat($self.data('parallax_sense')) / 100;
				var maxMinValue = parseFloat($self.data('parallax_limit'));
				var statPos = '0';
				var mobileEnable = ($self.data('mobile_enable') && $self.data('mobile_enable') == '1') ? true : false;

				gp_pinacop.window.on("load scroll", function() {
					if(!mobileEnable && Modernizr.touch && gp_pinacop.windowWidth < 800) {
						return;
					}
					if (( (gp_pinacop.windowScrollTop + gp_pinacop.windowHeight) > topOffset ) && ( (topOffset + selfHeight) > gp_pinacop.windowScrollTop )) {
						recalcInitValues();

						var diff = (topOffset - gp_pinacop.windowScrollTop) / 3,
						diffPos = -(diff * speed),
						starPosition = '50% 50%';

						if ($self.data('parallax_offset')) {
							if($self.hasClass('gp_vertical_parallax') || $self.hasClass('gp_horizontal_parallax')) {
								if($self.hasClass('gp_vertical_parallax')) {
									starPosition = '50% calc(50% + '+$self.data('parallax_offset')+'px)';
								} else if($self.hasClass('gp_horizontal_parallax')) {
									starPosition = 'calc(50% + '+$self.data('parallax_offset')+'px) 50%';
								}
								$self.css('backgroundPosition', starPosition);
							}
						}
						
						var coords;
						if($self.hasClass('gp_vertical_parallax')) {
							coords = statPos + ', ' + diffPos + 'px';
						}

						if($self.hasClass('gp_horizontal_parallax')) {
							coords = diffPos + 'px,' + statPos;
						}

						if($self.hasClass('gp-multi-parallax-layer')) {
							var increment = +$self.attr('class').slice(-1);
							var dirMulti = $self.data('direction-multi') ? $self.data('direction-multi') : 'vertical';
							if(dirMulti == 'vertical') {
								coords = statPos + ', ' + diffPos * increment + 'px';
							} else {
								coords = diffPos * increment + 'px,' + ' ' + statPos;
							}
						}

						if($self.hasClass('gp-row-parallax')) {
							var yPos = -(diff * speed);

							if(yPos > maxMinValue) {
								yPos = maxMinValue;
							}
							if(yPos < -maxMinValue) {
								yPos = -maxMinValue;
							}

							window.requestAnimationFrame(function() {
								$self.find('>.row').css({
									'-webkit-transform': 'matrix(1,0,0,1,0,'+yPos+')',
									'-moz-transform': 'matrix(1,0,0,1,0,'+yPos+')',
									'-0-transform': 'matrix(1,0,0,1,0,'+yPos+')',
									'transform': 'matrix(1,0,0,1,0,'+yPos+')'
								});
							});
						}
						if($self.hasClass('gp-column-parallax')) {
						// Move the column
						var yPos = -(diff * speed);

						if(yPos > maxMinValue) {
							yPos = maxMinValue;
						}
						if(yPos < -maxMinValue) {
							yPos = -maxMinValue;
						}

						window.requestAnimationFrame(function() {
							$self.css({
								'-webkit-transform': 'matrix(1,0,0,1,0,'+yPos+')',
								'-moz-transform': 'matrix(1,0,0,1,0,'+yPos+')',
								'-0-transform': 'matrix(1,0,0,1,0,'+yPos+')',
								'transform': 'matrix(1,0,0,1,0,'+yPos+')'
							});
						});
					}
					if($self.hasClass('gp_stun_header_vertical_parallax')) {
						// Move the bg container
						var yPos = Math.floor(gp_pinacop.windowScrollTop * speed / 5);

						if(yPos < 0) {
							yPos = 0;
						}

						window.requestAnimationFrame(function() {
							$self.css({
								'-webkit-transform': 'translate3d(0,'+yPos+'px,0)',
								'-moz-transform': 'translate3d(0,'+yPos+'px,0)',
								'-0-transform': 'translate3d(0,'+yPos+'px,0)',
								'transform': 'translate3d(0,'+yPos+'px,0)'
							});
						});
					}
					if($self.hasClass('gp-fade-on-scroll')) {
						var height = $self.height();

						// Fade the row
						$self.css({
							opacity: (1 + 1/(height/(topOffset - gp_pinacop.windowScrollTop)))
						});
					}
					if(	$self.hasClass('gp_vertical_parallax') || $self.hasClass('gp_horizontal_parallax') ||	$self.hasClass('gp-multi-parallax-layer')) {
						window.requestAnimationFrame(function() {
							$self.css({
								'-webkit-transform': 'translate3d('+coords+',0)',
								'-moz-transform': 'translate3d('+coords+',0)',
								'-0-transform': 'translate3d('+coords+',0)',
								'transform': 'translate3d('+coords+',0)'
							});
						});

					}
				}
			});
			});
};

var gpStunHeaderParallax = function() {
	var $self = $('.stuning-header-inner .page-title-inner'),
	$meta = $('.gp-meta-wrap', $self);

	if($self.hasClass('gp-enable-parallax')) {
		gp_pinacop.window.on('scroll',function(e){

			var scrolledY = gp_pinacop.windowScrollTop,
			height = $self.parent().height(),
			coord = scrolledY*.333;

			window.requestAnimationFrame(function() {
				$self.css({
					'-webkit-transform': 'translate3d(0,'+coord+'px,0)',
					'-moz-transform': 'translate3d(0,'+coord+'px,0)',
					'-o-transform': 'translate3d(0,'+coord+'px,0)',
					'transform': 'translate3d(0,'+coord+'px,0)',
					'opacity': (1 - (scrolledY/height))
				});
				$meta.css({
					'opacity': (1 - (scrolledY/(height/5)))
				});
			});
		});
	}
};

var initMobileBgImage = function() {
	$('.gp-row-bg-image').each(function() {
		var $self = $(this),
		defaultImage = '',
		mobileImage = '',
		resolution = 800;

		if($self.data('default-image')) {
			defaultImage = $self.data('default-image');
		}

		if($self.data('responsive-image')) {
			mobileImage = $self.data('responsive-image');
		}

		if($self.data('responsive-resolution')) {
			resolution = $self.data('responsive-resolution');
		}

		if(defaultImage != '' && mobileImage != '') {
			if(typeof gp_pinacop.windowWidth != 'undefined' && gp_pinacop.windowWidth < resolution && mobileImage) {
				$self.css('background-image','url('+mobileImage+')');
			} else {
				$self.css('background-image','url('+defaultImage+')');
			}
		}
	});
};

gp_pinacop.window.on('load resize', initMobileBgImage);

if (!$('html').is('.lt-ie10, .lt-ie9, .lt-ie8')) {
	gpParallax();
	gp_pinacop.window.load(function(){
		gpParallax();
		if (!Modernizr.touch && gp_pinacop.windowWidth > 800) {
			
			var offset = 0;
			
			
		}
	});
}
};



gp_pinacop.fullHeightRow = function() {
	var gpFullHeightRow = function () {
		$( '.gp-row-full-height:first' ).each( function () {
			var offset,
			fullHeight,
			$self = $(this);

			setTimeout(function() {
				offset = $self.offset().top;
				if($('.gp-frame-line.line-bottom').length > 0) {
					offset += $('.gp-frame-line.line-bottom').height();
				}
				if ( offset < gp_pinacop.windowHeight ) {
					fullHeight = gp_pinacop.windowHeight - offset;
					$self.css( 'min-height', fullHeight + 'px' );
				}
			}, 100);
		});
	};

	gp_pinacop.window.on('load resize', gpFullHeightRow);
};

gp_pinacop.initEqualHeights = function() {
	var eqHeightInit = function() {
		var w = gp_pinacop.windowWidth;
		$('.vc-row-wrapper.equal-height-columns').each(function(){
			var $container = $(this),
			resolution = $container.data('resolution') ? $container.data('resolution') : 800,
			$columns = $container.find('>.row >.columns');

			if($columns.hasClass('twelve') && $columns.find('.vc-row-wrapper.vc_inner').length == 1 && $columns.find('.vc-row-wrapper.vc_inner').siblings().length < 1) {
				$columns = $columns.find('.vc-row-wrapper.vc_inner > .row > .columns');
			}
			if($(this).hasClass('mobile-destroy-equal-heights')) {
				if (w > resolution) {
					$columns.equalHeights();
				} else {
					$columns.equalHeightsDestroy();
				}
			} else {
				$columns.equalHeights();
			}
		});
		$('.gp-equal-height-wrapper').each(function(){
			if($(this).hasClass('gp-mobile-destroy-equal-heights')) {
				if (w>800) {
					$(this).find('>div').equalHeights();
				} else {
					$(this).find('>div').equalHeightsDestroy();
				}
			} else {
				$(this).find('>div').equalHeights();
			}
		});		
	};

	gp_pinacop.document.ready(function() {
		$('.vc-row-wrapper.equal-height-columns.aligh-content-verticaly').each(function(){
			var $container = $(this),
			$columns = $container.find('>.row >.columns');

			if($columns.hasClass('twelve') && $columns.find('.vc-row-wrapper.vc_inner').length == 1 && $columns.find('.vc-row-wrapper.vc_inner').siblings().length < 1) {
				$columns = $columns.find('.vc-row-wrapper.vc_inner > .row > .columns');
			}

			$columns.each(function() {
				$(this).wrapInner('<div class="gp-vertical-aligned"></div>');
			});
		});
	});

	$('body').on('post-load',eqHeightInit);

	$(window).on('load resize', eqHeightInit);
};





gp_pinacop.initVideoBg = function() {
	$('.gp-video-bg video, .gp-video-bg .gp-bg-frame').each(function() {
		var $self = $(this),
		ratio = 1.778,
		pWidth,
		pHeight,
		selfWidth,
		selfHeight;
		var setSizes = function() {
			pWidth = $self.parents('.vc-row-wrapper.wpb_row').length > 0 ? $self.parents('.vc-row-wrapper.wpb_row').width() : $self.parent().width();
			pHeight = $self.parents('.vc-row-wrapper.wpb_row').length > 0 ? $self.parents('.vc-row-wrapper.wpb_row').height() : $self.parent('').height();
			if(pWidth / ratio < pHeight) {
				selfWidth = Math.ceil(pHeight * ratio);
				selfHeight = pHeight;
				$self.css({
					'width': selfWidth,
					'height': selfHeight
				});
			} else {
				selfWidth = pWidth;
				selfHeight = Math.ceil(pWidth / ratio);
				$self.css({
					'width': selfWidth,
					'height': selfHeight
				});
			}
		};
		$self.parents('.gp-video-bg').siblings('.gp-video-controller').unbind('click').on('click', function(e) {
			e.preventDefault();
			var $button = $(this);
			if($button.hasClass('gp-socicon-ic_pause_48px')) {
				$self.get(0).pause();
				$button.removeClass('gp-socicon-ic_pause_48px').addClass('gp-socicon-icon-play');
			} else {
				$self.get(0).play();
				$button.removeClass('gp-socicon-icon-play').addClass('gp-socicon-ic_pause_48px');
			}
		});
		$self.parents('.gp-video-bg').siblings('.gp-sound-controller').unbind('click').on('click', function(e) {
			e.preventDefault();
			var $button = $(this);
			if($button.hasClass('gp-socicon-unmute')) {
				$self.prop('muted',false);
				$button.removeClass('gp-socicon-unmute').addClass('gp-socicon-mute');
			} else {
				$self.prop('muted',true);
				$button.removeClass('gp-socicon-mute').addClass('gp-socicon-unmute');
			}
		});
		setSizes();
		gp_pinacop.window.on('load resize', function() {
			setSizes();
		});
		$('body').on('post-load', setSizes);
		gp_pinacop.window.on('load', function() {
			if($self.is('video') && $self.get(0).paused) {
				$self.get(0).play();
			}
		});
	});
	if($('.gp-youtube-bg').length > 0) {
		var tag = document.createElement('script');

		tag.src = "//www.youtube.com/iframe_api";
		var firstScriptTag = document.getElementsByTagName('script')[0];
		firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

		var players = {};

		window.onYouTubeIframeAPIReady = function() {
			$('.gp-youtube-bg iframe').each(function() {
				var $self = $(this),
				id = $self.attr('id');

				if($self.data('muted') && $self.data('muted') == '1') {
					players[id] = new YT.Player(id, {
						events: {
							"onReady": onPlayerReady
						}
					});
				} else {
					players[id] = new YT.Player(id, {
						events: {
							"onReady": onPlayerReadyLoud
						}
					});
				}
			});
		};
	}
	function onPlayerReady(e) {
		e.target.mute();
		e.target.playVideo();
	}
	function onPlayerReadyLoud(e) {
		e.target.playVideo();
	}
	if($('.gp-vimeo-bg').length > 0) {
		gp_pinacop.document.ready(function() {
			$('.gp-vimeo-bg iframe').each(function() {
				var $self = $(this);

				if (window.addEventListener) {
					window.addEventListener('message', onMessageReceived, false);
				} else {
					window.attachEvent('onmessage', onMessageReceived, false);
				}

				function onMessageReceived(e) {
					var data = JSON.parse(e.data);

					switch (data.event) {
						case 'ready':
						$self[0].contentWindow.postMessage('{"method":"play", "value":1}','*');
						if($self.data('muted') && $self.data('muted') == '1') {
							$self[0].contentWindow.postMessage('{"method":"setVolume", "value":0}','*');
						}
						break;
					}
				}
			});
		});
	}
};

gp_pinacop.initMousemoveParallax = function() {
	gp_pinacop.document.ready(function() {
		$('.gp-row-bg-wrap.gp-row-bg-image.gp_mousemove_parallax').each(function() {
			var $self = $(this),
			mobileEnabled = ($self.data('mobile_enable') && $self.data('mobile_enable') == '1') ? true : false;

			if(!mobileEnabled && Modernizr.touch && gp_pinacop.windowWidth < 800) {
				return;
			}

			$('.gp-interactive-parallax-item', $self).parallax({mouseport: $self.parents('.vc-row-wrapper')});
		});
	});
};

gp_pinacop.initAnimatedBg = function() {
	gp_pinacop.document.ready(function() {
		$('.gp-row-bg-image.gp_animated_bg').each(function() {
			var $self = $(this),
			dir = $self.data('direction'),
			speed = 100 - $self.data('parallax_sense'),
			coords = 0,
			mobileEnabled = ($self.data('mobile_enable') && $self.data('mobile_enable') == '1') ? true : false,
			width = $self.parent().outerWidth(),
			height = $self.parent().outerHeight();

			if(!mobileEnabled && Modernizr.touch && gp_pinacop.windowWidth < 800) {
				return;
			}

			var actualImage = new Image();
			actualImage.src = $self.css('backgroundImage').replace(/"/g,'').replace(/url\(|\)$/ig, '');

			actualImage.onload = function() {
				if(dir == 'left' || dir == 'right') {
					$self.css('width', actualImage.width + width);
				} else if(dir == 'top' || dir == 'bottom') {
					$self.css('height', actualImage.height + height);
				}

				window.requestAnimationFrame(function() {
					setInterval(function() {
						if(dir == 'left' || dir == 'bottom') {
							coords -= 1;
						} else {
							coords += 1;
						}

						if(
							(coords < -actualImage.width && dir == 'left') || 
							(coords < -actualImage.height && dir == 'bottom')
							) {
							coords = 0;
					}

					if( (coords > 0 && dir == 'right') ) {
						coords = -actualImage.width;
					}

					if( (coords > 0 && dir == 'top') ) {
						coords = -actualImage.height;
					}
					if(dir == 'left' || dir == 'right') {
						$self.css({
							'-webkit-transform': 'translate3d('+coords +'px, 0, 0)',
							'-moz-transform': 'translate3d('+coords +'px, 0, 0)',
							'-o-transform': 'translate3d('+coords +'px, 0, 0)',
							'-ms-transform': 'translate3d('+coords +'px, 0, 0)',
							'transform': 'translate3d('+coords +'px, 0, 0)'
						});
					} else {
						$self.css({
							'-webkit-transform': 'translate3d(0, '+ coords + 'px, 0)',
							'-moz-transform': 'translate3d(0, '+ coords + 'px, 0)',
							'-o-transform': 'translate3d(0, '+ coords + 'px, 0)',
							'-ms-transform': 'translate3d(0, '+ coords + 'px, 0)',
							'transform': 'translate3d(0, '+ coords + 'px, 0)'
						});
					}
				}, speed);
				});
			};
		});
	});
};

gp_pinacop.initCanvasBg = function() {
	var init = function() {

		$('.gp-row-bg-canvas').each(function(){
			var $self = $(this);
			//if($self.data('mobile-disable') && $self.data('mobile-disable') == 'on' && gp_pinacop.windowWidth < 1100) {
				if(gp_pinacop.windowWidth < 1100) {
					return false;
				}
				var canvas_id = $self.data('canvas-id');
				var canvas_style = $self.data('canvas-style');
				var canvas_color = $self.data('canvas-color');
				var apply_to = $self.data('canvas-size');

				if(canvas_color == '') {
					canvas_color = '#ffffff';
				}

				if(canvas_style == 'style_1') {
					$self.append('<canvas id="canvas-'+ canvas_id +'" />');
				}

				var width, height, largeHeader, canvas, ctx, points, target, animateHeader = true;
				var wrapper = (apply_to != 'window') ? $('#'+canvas_id).parents('.vc-row-wrapper') : $(window);

				if(canvas_style == 'style_1') {
					(function() {
						initHeader('canvas-'+canvas_id);
						initAnimation();
						addListeners();
						function initHeader(id) {
							width = wrapper.width();
							height = wrapper.height();
							target = {x: width/2, y: height/2};

							largeHeader = document.getElementById(id);
							largeHeader.style.height = height+'px';

							canvas = document.getElementById(id);
							canvas.width = width;
							canvas.height = height;
							ctx = canvas.getContext('2d');

							// create points
							points = [];
							for(var x = 0; x < width; x = x + width/20) {
								for(var y = 0; y < height; y = y + height/20) {
									var px = x + Math.random()*width/20;
									var py = y + Math.random()*height/20;
									var p = {x: px, originX: px, y: py, originY: py };
									points.push(p);
								}
							}

							// for each point find the 5 closest points
							for(var i = 0; i < points.length; i++) {
								var closest = [];
								var p1 = points[i];
								for(var j = 0; j < points.length; j++) {
									var p2 = points[j]
									if(!(p1 == p2)) {
										var placed = false;
										for(var k = 0; k < 5; k++) {
											if(!placed) {
												if(closest[k] == undefined) {
													closest[k] = p2;
													placed = true;
												}
											}
										}

										for(var k = 0; k < 5; k++) {
											if(!placed) {
												if(getDistance(p1, p2) < getDistance(p1, closest[k])) {
													closest[k] = p2;	
													placed = true;
												}
											}
										}
									}
								}
								p1.closest = closest;
							}

							// assign a circle to each point
							for(var i in points) {
								var c = new Circle(points[i], 2+Math.random()*2, 'rgba(255,255,255,0.3)');
								points[i].circle = c;
							}
						}

						// Event handling
						function addListeners() {
							if(!('ontouchstart' in window)) {
								window.addEventListener('mousemove', mouseMove);
							}
							window.addEventListener('resize', resize);
						}

						function mouseMove(e) {
							var posx = 0;
							var posy = 0;
							var offset_left = $('#'+canvas_id).offset().left;
							var offset_top = $('#'+canvas_id).offset().top;
							if (e.pageX || e.pageY) {
								posx = e.pageX;
								posy = e.pageY;
							} else if (e.clientX || e.clientY)    {
								posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
								posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
							}
							target.x = posx - offset_left;
							target.y = posy - offset_top;
						}

						function resize() {
							width = wrapper.width();
							height = wrapper.height();
							largeHeader.style.height = height+'px';
							canvas.width = width;
							canvas.height = height;
						}

						// animation
						function initAnimation() {
							animate();
							for(var i in points) {
								shiftPoint(points[i]);
							}
						}

						function animate() {
							if(animateHeader) {
								ctx.clearRect(0,0,width,height);
								for(var i in points) {
									// detect points in range
									if(Math.abs(getDistance(target, points[i])) < 4000) {
										points[i].active = 0.3;
										points[i].circle.active = 0.6;
									} else if(Math.abs(getDistance(target, points[i])) < 20000) {
										points[i].active = 0.1;
										points[i].circle.active = 0.3;
									} else if(Math.abs(getDistance(target, points[i])) < 40000) {
										points[i].active = 0.02;
										points[i].circle.active = 0.1;
									} else {
										points[i].active = 0;
										points[i].circle.active = 0;
									}

									drawLines(points[i]);
									points[i].circle.draw();
								}
							}
							requestAnimationFrame(animate);
						}

						function shiftPoint(p) {
							TweenLite.to(p, 1+1*Math.random(), {
								x:p.originX-50+Math.random()*100,
								y: p.originY-50+Math.random()*100,
								ease:Circ.easeInOut,
								onComplete: function() {
									shiftPoint(p);
								}
							});
						}

						// Canvas manipulation
						function drawLines(p) {
							if(!p.active) {
								return;
							}
							for(var i in p.closest) {
								ctx.beginPath();
								ctx.moveTo(p.x, p.y);
								ctx.lineTo(p.closest[i].x, p.closest[i].y);
								ctx.strokeStyle = 'rgba(255,255,255,'+ p.active+')';
								ctx.stroke();
							}
						}

						function Circle(pos,rad,color) {
							var _this = this;

							// constructor
							(function() {
								_this.pos = pos || null;
								_this.radius = rad || null;
								_this.color = color || null;
							})();

							this.draw = function() {
								if(!_this.active) {
									return;
								}
								ctx.beginPath();
								ctx.arc(_this.pos.x, _this.pos.y, _this.radius, 0, 2 * Math.PI, false);
								ctx.fillStyle = 'rgba(255,255,255,'+ _this.active+')';
								ctx.fill();
							};
						}

						// Util
						function getDistance(p1, p2) {
							return Math.pow(p1.x - p2.x, 2) + Math.pow(p1.y - p2.y, 2);
						}
					})();
				} else if(canvas_style == 'style_2') {
					$('#'+canvas_id).particleground({
						dotColor: canvas_color,
						lineColor: canvas_color
					});
				} else if(canvas_style == 'style_3') {
					(function() {
						var mouseX = 0, mouseY = 0,

						windowHalfX = window.innerWidth / 2,
						windowHalfY = window.innerHeight / 2,

						SEPARATION = 200,
						AMOUNTX = 1,
						AMOUNTY = 1,

						camera, scene, renderer;

						init();
						animate();

						function init() {
							var container, separation = 1000, amountX = 50, amountY = 50, color = 0xffffff,
							particles, particle;
							container = document.getElementById(canvas_id);
							camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 1, 10000 );
							camera.position.z = 100;
							scene = new THREE.Scene();
							renderer = new THREE.CanvasRenderer({ alpha: true });
							renderer.setPixelRatio( window.devicePixelRatio );
							renderer.setClearColor( 0x000000, 0 );   // canvas background color
							renderer.setSize( wrapper.width(), wrapper.height() );
							container.appendChild( renderer.domElement );

							var PI2 = Math.PI * 2;
							var material = new THREE.SpriteCanvasMaterial( {
								color: color,
								opacity: 0.5,
								program: function ( context ) {
									context.beginPath();
									context.arc( 0, 0, 0.5, 0, PI2, true );
									context.fill();
								}
							} );
							var geometry = new THREE.Geometry();
							/*
							 *   Number of particles
							 */
							 for ( var i = 0; i < 150; i ++ ) {

							 	particle = new THREE.Sprite( material );
							 	particle.position.x = Math.random() * 2 - 1;
							 	particle.position.y = Math.random() * 2 - 1;
							 	particle.position.z = Math.random() * 2 - 1;
							 	particle.position.normalize();
							 	particle.position.multiplyScalar( Math.random() * 10 + 600 );
							 	particle.scale.x = particle.scale.y = 5;
							 	scene.add( particle );
							 	geometry.vertices.push( particle.position );
							 }
							/*
							 *   Lines
							 */
							 var line = new THREE.Line( geometry, new THREE.LineBasicMaterial( { color: color, opacity: 0.2 } ) );
							 scene.add( line );
							 document.addEventListener( 'mousemove', onDocumentMouseMove, false );
							 document.addEventListener( 'touchstart', onDocumentTouchStart, false );
							 window.addEventListener( 'resize', onWindowResize, false );

							}

							function onWindowResize() {
								windowHalfX = wrapper.width() / 2;
								windowHalfY = wrapper.height() / 2;
								camera.aspect = wrapper.width() / wrapper.height();
								camera.updateProjectionMatrix();
								renderer.setSize( wrapper.width(), wrapper.height() );
							}

							function onDocumentMouseMove(event) {
								mouseX = (event.clientX - windowHalfX) * 0.05;
								mouseY = (event.clientY - windowHalfY) * 0.2;
							}

							function onDocumentTouchStart( event ) {

								if ( event.touches.length > 1 ) {

									event.preventDefault();

									mouseX = (event.touches[ 0 ].pageX - windowHalfX) * 0.7;
									mouseY = (event.touches[ 0 ].pageY - windowHalfY) * 0.7;

								}

							}

							function onDocumentTouchMove( event ) {

								if ( event.touches.length == 1 ) {

									event.preventDefault();

									mouseX = event.touches[ 0 ].pageX - windowHalfX;
									mouseY = event.touches[ 0 ].pageY - windowHalfY;

								}

							}

							function animate() {

								requestAnimationFrame( animate );

								render();

							}

							function render() {

								camera.position.x += ( mouseX - camera.position.x ) * 0.1;
								camera.position.y += ( - mouseY + 200 - camera.position.y ) * 0.05;
								camera.lookAt( scene.position );

								renderer.render( scene, camera );

							}
						})();

					} else if(canvas_style == 'style_4') {
						$('#'+canvas_id).particlegroundOld({
							dotColor: canvas_color,
							lineColor: canvas_color
						});
					}
				});
};
gp_pinacop.window.on('load', function() {
	setTimeout(function() {
		init();
	}, 500);
});
$('body').on('post-load', init);
};





gp_pinacop.init = function() {
	gp_pinacop.initObjectsSizing();		
	//gp_pinacop.initVideoBg();	
	gp_pinacop.fullHeightRow();		
	gp_pinacop.initEqualHeights();
	gp_pinacop.initParallaxBackground();
	gp_pinacop.initAnimatedBg();
	//gp_pinacop.initCanvasBg();
	//gp_pinacop.initMousemoveParallax();
	
};

gp_pinacop.init();
})(jQuery);