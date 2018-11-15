var GPTHEME = GPTHEME || {};

(function ($) {

    // USE STRICT
    "use strict";

    var gp_pinacop = window.gp_pinacop || {};
    
    window.gp_pinacop = gp_pinacop;
    
    gp_pinacop.window = $(window),
    gp_pinacop.document = $(document),
    gp_pinacop.windowHeight = gp_pinacop.window.height(),
    gp_pinacop.windowWidth = gp_pinacop.window.width(),

    GPTHEME.initialize = {

        init: function () {
            GPTHEME.initialize.defaults();
            GPTHEME.initialize.swiper();     
            GPTHEME.initialize.background();          
            GPTHEME.initialize.skills();
            GPTHEME.initialize.countup();
            GPTHEME.initialize.sectionSwitch();
            GPTHEME.initialize.mobileMenu();
            GPTHEME.initialize.map();
            GPTHEME.initialize.contactFrom();
            GPTHEME.initialize.videoBg();
            GPTHEME.initialize.canvasBg();
            GPTHEME.initialize.animateBg();
            GPTHEME.initialize.initVivus();
            GPTHEME.initialize.pieChart();
            GPTHEME.initialize.countDown();

        },
    /*==============================*/
    /*=           General          =*/
    /*==============================*/
    defaults: function () {
       

        /* Wow init */
        new WOW().init();

        $('.video-btn').magnificPopup({
            type: 'iframe'
        });

        if($('#wpadminbar').length > 0) {
            $('html').addClass('gp-admin-bar-enabled');
        }

        if($('#wpadminbar').length > 0) {
            $('#wpadminbar').addClass('gp-admin-bar');
        }

        // Site Preloader
        $(window).load(function () {
            $(".loader").fadeOut();
            $("#preloader").delay(350).fadeOut("slow");
        });


        $('.typed-title').typed({
            stringsElement: $('.typing-title'),            
            startDelay: 0,
            typeSpeed: 0,
            backDelay: 1500,
            backSpeed: 0,
            loop: true,
        });      

        $(".service-item").hover3d({
            selector: ".service-thumb"
        });

        /* Loader Init */
        $(".loading").delay(1e3).addClass("loaded");

      
        /* Banner Static */
        if (typeof $.fn.ripples == 'function') {
            try {
                $('#banner-ripple').ripples({
                    resolution: 500,
                    perturbance: 0.04
                });
            } catch (e) {
                $('.error').show().text(e);
            }
        }

        /* Search Open */
        var button = $('.header-search-switcher');
        var form = $('.form-search-section');

        if (form.find('#gp-search-loader').length > 0) {
            var searchLoader = new SVGLoader( document.getElementById('gp-search-loader'), { speedIn : 400 } );
        }
        button.unbind('click').on('click touchend', function() {
            form.toggleClass('shift-form');
            if(form.hasClass('shift-form')) {
                searchLoader.show();
            } else {
                setTimeout(function() {
                    searchLoader.hide();
                },200);
            }
            return false;
        });

        $('.hide_faq .pinacop_faq_content').slideUp(0);
        $('.pinacop_faq_item').each(function(){
            var $this = $(this);
            $this.find('.pinacop_faq_control').click(function(){

                if( $this.hasClass('open_faq') ){
                    $this.removeClass('open_faq');
                    $this.find('.pinacop_faq_content').slideUp(300);
                }else{
                    $this.removeClass('hide_faq');
                    $this.addClass('open_faq');
                    $this.find('.pinacop_faq_content').slideDown(300);
                }
            });
        });


        /* Accordian */
        var $panelgroup = $('.panel-group');
        $panelgroup.find('.panel-default:has(".in")').addClass('panel-active');
        $panelgroup.on('shown.bs.collapse', function(e) {
            $(e.target).closest('.panel-default').addClass(' panel-active');
        }).on('hidden.bs.collapse', function(e) {
            $(e.target).closest('.panel-default').removeClass(' panel-active');
        });


        $('.gp-row-bg-wrap.gp-row-bg-image.gp_mousemove_parallax').each(function() {
            var $self = $(this),
            mobileEnabled = ($self.data('mobile_enable') && $self.data('mobile_enable') == '1') ? true : false;

            if(!mobileEnabled && Modernizr.touch && gp_pinacop.windowWidth < 800) {
                return;
            }

            $('.gp-interactive-parallax-item', $self).parallax({mouseport: $self.parents('.vc-row-wrapper')});
        });    
    },

    /*====================================*/
    /*=           Swiper Slider          =*/
    /*====================================*/

    swiper: function () {
        $('[data-carousel="swiper"]').each(function () {

            var $this = $(this);
            var $container = $this.find('[data-swiper="container"]');
            var $asControl = $this.find('[data-swiper="ascontrol"]');

            var conf = function (element) {
                var obj = {
                    slidesPerView: element.data('items'),
                    centeredSlides: element.data('center'),
                    loop: element.data('loop'),
                    initialSlide: element.data('initial'),
                    effect: element.data('effect'),
                    spaceBetween: element.data('space'),
                    autoplay: element.data('autoplay'),
                    direction: element.data('direction'),
                    centeredSlides: element.data('centered'),
                    paginationType: element.data('pagination-type'),
                    paginationClickable: true,
                    breakpoints: element.data('breakpoints'),
                    slideToClickedSlide: element.data('click-to-slide'),
                    loopedSlides: element.data('looped'),
                    fade: {
                        crossFade: element.data('crossfade')
                    },
                    speed: 700
                };
                return obj;
            }

            var $primaryConf = conf($container);
            $primaryConf.prevButton = $this.find('[data-swiper="prev"]');
            $primaryConf.nextButton = $this.find('[data-swiper="next"]');
            $primaryConf.pagination = $this.find('[data-swiper="pagination"]');

            var $ctrlConf = conf($asControl);

            function animateSwiper(selector, slider) {
                var makeAnimated = function animated() {
                    selector.find('.swiper-slide-active [data-animate]').each(function () {
                        var anim = $(this).data('animate');
                        var delay = $(this).data('delay');
                        var duration = $(this).data('duration');

                        $(this).addClass(anim + ' animated')
                        .css({
                            webkitAnimationDelay: delay,
                            animationDelay: delay,
                            webkitAnimationDuration: duration,
                            animationDuration: duration
                        })
                        .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                            $(this).removeClass(anim + ' animated');
                        });
                    });
                };
                makeAnimated();
                slider.on('SlideChangeStart', function () {
                    selector.find('[data-animate]').each(function () {
                        var anim = $(this).data('animate');
                        $(this).removeClass(anim + ' animated');
                    });
                });
                slider.on('SlideChangeEnd', makeAnimated);
            };

            if ($container.length) {
                var $swiper = new Swiper($container, $primaryConf);
                animateSwiper($this, $swiper);

                if ($asControl.length) {
                    var $control = new Swiper($asControl, $ctrlConf);
                    $swiper.params.control = $control;
                    $control.params.control = $swiper;
                }

            } else {
                console.log('Swiper container is not defined!');
            }
            ;

        });
    },

    /*=======================================*/
    /*=           Background Image          =*/
    /*=======================================*/

    background: function () {
        $('[data-bg-image]').each(function () {

            var img = $(this).data('bg-image');

            $(this).css({
                backgroundImage: 'url(' + img + ')',
            });
        });
    },

    /*==========================================*/
    /*=           Parallax Background          =*/
    /*==========================================*/

    backgroundParallax: function () {
        $('[data-parallax="image"]').each(function () {

            var actualHeight = $(this).position().top;
            var speed = $(this).data('parallax-speed');
            var reSize = actualHeight - $(window).scrollTop();
            var makeParallax = -(reSize / 2);
            var posValue = makeParallax + "px";

            $(this).css({
                backgroundPosition: '50% ' + posValue,
            });
        });
    },

    /*=============================*/
    /*=           Skills          =*/
    /*=============================*/

    skills: function () {

        $('.skill-bar li').each(function () {

            $(this).appear(function () {
                $(this).css({opacity: 1, left: "0px"});
                var b = $(this).find(".progress-bar").attr("data-width");
                $(this).find(".progress-bar").css({
                    width: b + "%"
                });
            });

        });
    },

    /*==============================*/
    /*=           Counter          =*/
    /*==============================*/

    initVivus: function() {
        $('.animated-icon').each(function(index, el) {
          var startAt = $(el).parents('[data-animation]').length
          ? 'manual'
          : 'inViewport';
          if ($(el).parents('#fullpage').length) {
            startAt = 'autostart';
        }
        var delay = $(el).parents('[data-animation]').length &&
        $window.width() > 767
        ? $(el).parents('[data-animation]').data('delay')
        : 0;
        new Vivus(el, {
            file: $(el).data('icon'),
            start: startAt,
            onReady: function(obj) {
              if ($(el).hasClass('gradient-icon')) {
                var colors = $(el).data('gradients')
                ? $(el).data('gradients').replace(' ', '').split(',')
                : ['#cf93ff', '#00c3da'];
                var xmlns = 'http://www.w3.org/2000/svg';
                var grad = document.createElementNS(xmlns, 'linearGradient');
                var uid = 'grad-' + MAIN.guid(6);
                grad.setAttributeNS(null, 'id', uid);
                grad.setAttributeNS(null, 'gradientUnits', 'userSpaceOnUse');

                var stop1 = document.createElementNS(xmlns, 'stop');
                stop1.setAttributeNS(null, 'offset', 0);
                stop1.setAttributeNS(null, 'stop-color', colors[0]);

                var stop2 = document.createElementNS(xmlns, 'stop');
                stop2.setAttributeNS(null, 'offset', 100);
                stop2.setAttributeNS(null, 'stop-color', colors[1]);

                grad.append(stop1, stop2);

                $(obj.el).prepend(grad);
                obj.el.setAttributeNS(null, 'stroke', 'url(#' + uid + ')');
                $(obj.map).each(function(index, item) {
                  item.el.setAttributeNS(null, 'stroke', 'url(#' + uid + ')');
              });
            }

            if ($(el).data('custom-color')) {
                var customColor = $(el).data('custom-color');
                obj.el.setAttributeNS(null, 'stroke', customColor);
                $(obj.map).each(function(index, item) {
                  item.el.setAttributeNS(null, 'stroke', customColor);
              });
            }

            if ($(el).parents('[data-animation]')) {
                $(el).parents('[data-animation]').appear(function() {
                  setTimeout(function() {
                    obj.play();
                }, delay);
              });
            }
        },
    });
    });
    },

    /*==============================*/
    /*=           Counter          =*/
    /*==============================*/ 

    countup: function () {
        var options = {
            useEasing: true,
            useGrouping: true,
            separator: ',',
            decimal: '.',
            prefix: '',
            suffix: ''
        };

        var counteEl = $('[data-counter]');

        if (counteEl) {
            counteEl.each(function () {
                var val = $(this).data('counter');

                var countup = new CountUp(this, 0, val, 0, 2.5, options);
                $(this).appear(function () {
                    countup.start();
                }, {accX: 0, accY: 0})
            });
        }
    },

    /*================================*/
    /*=           Portfolio          =*/
    /*================================*/

    portfolio: function () {

        if ($('.isotope-container').length) {

            $('.isotope-container').each(function () {

                var $container = $(this).find('.pinacop-portfolio-content');
                var $filter = $(this).find('.pinacop-portfolio-filter');

                /* Init isotope */
                if ($container.hasClass('pinacop_masonry')) {
                    $container.isotope({
                        itemSelector: '.portfolio-item',
                        layoutMode: 'masonry',
                        masonry: {
                            columnWidth: '.grid-sizer',
                            percentPosition: true
                            
                        }
                    });
                } else {
                    $container.isotope({
                        itemSelector: '.portfolio-item',
                        layoutMode: 'fitRows'
                    });
                }

                // layout Isotope after each image loads
                $container.imagesLoaded().progress(function() {
                    $container.isotope('layout');
                });

                /* Filter */
                $filter.on('click', '.but', function () {

                    $filter.find('.but').removeClass('activbut');
                    $(this).addClass('activbut');

                    var filterValue = $(this).attr('data-filter');
                    $container.isotope({filter: filterValue});
                    return false;

                });
            });
        }

        if ($('.popup-gallery').length) {
            $('.popup-gallery').magnificPopup({
                delegate: '.view-item',
                type: 'image',
                removalDelay: 100,
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-fade',
                closeBtnInside: false,
                gallery: {
                    enabled: true,
                },

            });
        }
    },

    /*================================*/
    /*=           Blog Grid          =*/
    /*================================*/

    blog: function () {

        if ($('.content-area').length) {

            $('.content-area').each(function () {

                var $container = $(this).find('.pinacop_list_archive');              

                /* Init isotope */
                if ($container.hasClass('blog-grid')) {
                    $container.isotope({
                        itemSelector: '.blog-items',
                        layoutMode: 'masonry',
                        masonry: {
                            columnWidth: '.grid-sizer',
                            percentPosition: true,
                            gutter: 20
                        }
                    });
                }               
            });
        }
    },

    /*=======================================*/
    /*=           Section Switcher          =*/
    /*=======================================*/

    sectionSwitch: function () {
        $('[data-type="section-switch"], .menu-item a, .side-menu li a').on('click', function () {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                if (target.length > 0) {

                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    },

    /*==================================*/
    /*=           Mobile Menu          =*/
    /*==================================*/

    mobileMenu: function () {
        $("#mobile_side_menu a").on('click', function(){

            $("#mobile_side_menu ul ul").slideUp();
            if(!$(this).next().is(":visible"))
            {
                $(this).next().slideDown();
            }
        })


        $( '.toggle-inner' ).on( 'click', function (e) {
            e.preventDefault();
            var mask = '<div class="mask-overlay">';

            $( 'body' ).toggleClass( 'menu-open' );
            $(mask).hide().appendTo( 'body' ).fadeIn( 'fast' );
            $( '.mask-overlay, .close-menu' ).on( 'click', function() {
                $( 'body' ).removeClass( 'menu-open' );
                $( '.mask-overlay' ).remove();
            });
        });
    },

    /*=========================================*/
    /*=           Animated Background         =*/
    /*=========================================*/  

    animateBg: function() {
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
    },

    /*======================================*/
    /*=           Canvas Background         =*/
    /*======================================*/

    canvasBg: function() {

        var init = function() {

            $('.gp-row-bg-canvas').each(function(){
                var $self = $(this);

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


                            points = [];
                            for(var x = 0; x < width; x = x + width/20) {
                                for(var y = 0; y < height; y = y + height/20) {
                                    var px = x + Math.random()*width/20;
                                    var py = y + Math.random()*height/20;
                                    var p = {x: px, originX: px, y: py, originY: py };
                                    points.push(p);
                                }
                            }


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


                            for(var i in points) {
                                var c = new Circle(points[i], 2+Math.random()*2, 'rgba(255,255,255,0.3)');
                                points[i].circle = c;
                            }
                        }


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
                            renderer.setClearColor( 0x000000, 0 );   
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

    },

    /*======================================*/
    /*=           Video Background         =*/
    /*======================================*/

    videoBg: function() {
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
         $(document).ready(function() {
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
    },

    /*=================================*/
    /*=           Google Map          =*/
    /*=================================*/

    map: function () {

        $('.gmap3-area').each(function () {
            var $this = $(this),
            key = $this.data('key'),
            lat = $this.data('lat'),
            lng = $this.data('lng'),
            mrkr = $this.data('mrkr');

            $this.gmap3({
                center: [lat, lng],
                zoom: 16,
                scrollwheel: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: [
                {
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#444444"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#f2f2f2"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 45
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#46bcec"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                }
            ]
            })
            .marker(function (map) {
                return {
                    position: map.getCenter(),
                    icon: mrkr
                };
            })

        });
    },

    /*===================================*/
    /*=           Contact Form          =*/
    /*===================================*/
    pieChart: function () {
        $(".pie_chart .chart").each(function (index, value){
            $(this).appear(function() {
                $(this).easyPieChart({
                  easing: "easeInQuad",
                  barColor: "#000",
                  trackColor: "#e5e5e5",
                  animate: 2000,
                  size: "160",
                  lineCap: 'square',
                  lineWidth: "2",
                  scaleColor: false,
                  onStep: function(from, to, percent) {
                    $(this.el).find(".percent").text(Math.round(percent));
                }
            });
            });
            var chart = window.chart = $("pie_chart .chart").data("easyPieChart");
        });
    },

    /*===================================*/
    /*=           Video Modal          =*/
    /*===================================*/  

    countDown: function () {
        $('.countdown').each(function (index, value){
           var count_year = $(this).attr( "data-count-year" );
           var count_month = $(this).attr( "data-count-month" );
           var count_day = $(this).attr( "data-count-day" );
           var count_date = count_year + '/' + count_month + '/' + count_day;
           $(this).countdown(count_date, function(event) {
            $(this).html(
              event.strftime('<span class="CountdownContent">%D<span class="CountdownLabel">Days</span></span><span class="CountdownSeparator"></span><span class="CountdownContent">%H <span class="CountdownLabel">Hours</span></span><span class="CountdownSeparator"></span><span class="CountdownContent">%M <span class="CountdownLabel">Minutes</span></span><span class="CountdownSeparator"></span><span class="CountdownContent">%S <span class="CountdownLabel">Seconds</span></span>')
              );
        });
       });
    },

    /*===================================*/
    /*=           Contact Form          =*/
    /*===================================*/
    contactFrom: function () {

        $('[data-deventform]').each(function () {
            var $this = $(this);
            $('.form-result', $this).css('display', 'none');

            $this.submit(function () {

                $('button[type="submit"]', $this).addClass('clicked');

                        // Create a object and assign all fields name and value.
                        var values = {};

                        $('[name]', $this).each(function () {
                            var $this = $(this),
                            $name = $this.attr('name'),
                            $value = $this.val();
                            values[$name] = $value;
                        });

                        // Make Request
                        $.ajax({
                            url: $this.attr('action'),
                            type: 'POST',
                            data: values,
                            success: function success(data) {

                                if (data.error == true) {
                                    $('.form-result', $this).addClass('alert-warning').removeClass('alert-success alert-danger').css('display', 'block');
                                } else {
                                    $('.form-result', $this).addClass('alert-success').removeClass('alert-warning alert-danger').css('display', 'block');
                                }
                                $('.form-result > .content', $this).html(data.message);
                                $('button[type="submit"]', $this).removeClass('clicked');
                            },
                            error: function error() {
                                $('.form-result', $this).addClass('alert-danger').removeClass('alert-warning alert-success').css('display', 'block');
                                $('.form-result > .content', $this).html('Sorry, an error occurred.');
                                $('button[type="submit"]', $this).removeClass('clicked');
                            }
                        });
                        return false;
                    });

        });
    },
};

GPTHEME.documentOnReady = {
    init: function () {
        GPTHEME.initialize.init();  
        GPTHEME.initialize.portfolio();  
        GPTHEME.initialize.blog();             
    },
};

GPTHEME.documentOnLoad = {
    init: function () {
        $(".loading-block").fadeOut("slow");
    },
};

GPTHEME.documentOnResize = {
    init: function () {
             
               
    },
};

GPTHEME.documentOnScroll = {
    init: function () {

       GPTHEME.initialize.backgroundParallax();           

       /* Sticky Menu */
       if ($(this).scrollTop() > 250) {
        $('#header').addClass("navbar-small")
    } else {
        $('#header').removeClass("navbar-small")
    }


    if ($(window).scrollTop() > 300) {
        $('.return-to-top').addClass('back-top');
    } else {
        $('.return-to-top').removeClass('back-top');
    }
},
};

$(document).ready(GPTHEME.documentOnReady.init);
$(window).on('load', GPTHEME.documentOnLoad.init);
$(document).on('scroll', GPTHEME.documentOnScroll.init);
$(document).on('resize', GPTHEME.documentOnResize.init);




})(jQuery);

