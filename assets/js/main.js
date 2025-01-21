var jwsThemeModule;
(function($) {
    "use strict";
    jwsThemeModule = (function() {
        return {
            jws_script: jws_script,
            init: function() {
        
                this.form_request();
                this.login_form();
                this.header_sticky();
                this.search_product();
                this.post_gallery();
                this.post_related();
                this.menu_mobile();
                this.scrollTop();
                this.menu_list();
                this.mobile_default();
                this.jws_theme_countdown();
                this.menu_offset();
                this.video_popup();
                this.jws_theme_newsletter();
                this.init_jws_notices();
                this.contact_form_loading();
                this.post_audio_play();
                this.global_modal();
                
               
            },
  
            
            form_request: function() {
                $('select').select2(); 
            $('select').select2({ minimumResultsForSearch:6 });
               $(document).on('click' , '.report, .job-widget .send' , function(e) {  
                    if($('body').hasClass('user-not-logged-in')) {
                        $(this).removeAttr('data-modal-jws');
                           $('.jws-form-login-popup').addClass('open');
                           
                           return false;
                        }
                });

            },
             global_modal() {
                
                      $(document).on('click','[data-modal-jws]' , function(e) {
                        
                           e.preventDefault();
                           
                           if($('body').hasClass('user-not-logged-in')) {
         
                               if($(this).hasClass('btn_message') || $(this).hasClass('send-proposal') || $(this).hasClass('btn_report') || $(this).hasClass('btn_contact') ) {
                                
                                $('.jws-form-login-popup').addClass('open');
                                
                                return false;
                                
                               }
                           }
                           
                           
                           var $buttton = $(this).data('modal-jws');

                            $.magnificPopup.open({
                                items: {
                                    src: $buttton,
                                    type: 'inline'
                                },
                                removalDelay: 0,
                                tClose: 'close',    
                                callbacks: {
                                    beforeOpen: function() {
                                        this.st.mainClass = 'user-popup animation-popup';
                                    },
                                    open: function() {
                                        
                
                                    }
                                },
                            });
                      
                   
                  });
                  $(document).on('click','.form-submit-cancel' , function(e) {
                    
                    $.magnificPopup.close();
                    
                  });
                      $('a.compare_package').on('click', function(event) {
                        if (this.hash !== "") {
                            event.preventDefault();
                
                            const targetId = this.hash;
                            const targetElement = $(targetId);
                
                            $('html, body').animate({
                                scrollTop: targetElement.offset().top
                            }, 800, 'swing', function(){
                                window.location.hash = targetId;
                            });
                        }
                    });
                  $('.show_more').click(function(e) {
                         e.preventDefault();
                      $(this).parents('.program_languages').addClass('show_all');
                        
                  });
                                      //According  
                    $('.ac-item .ac-top').click(function() {
                        
                       
                         $(this).closest('.ac-item').find('.ac-content').slideToggle();
                         $(this).closest('.ac-item').toggleClass('active');
                    });
                  $('.btn_share').click(function(e) {
                        e.preventDefault();
                      $(this).closest('.share').find('.addthis_inline_share_toolbox').toggleClass('active');
                  }); 
                               /*----------View More--------*/
                $(".show_more_excerpt").click(function() {
                    $(this).toggleClass('active')
                    $(this).siblings('.short_description').toggle();
                    $(this).siblings('.short_description_more').toggle();
                    
                    // Change the text of the button based on its current state
                    var buttonText = $(this).text() === jws_script.show_more ? jws_script.show_more   : jws_script.show_less;
                    $(this).find('.text').text(buttonText);
                  });
             },
            
            
             show_notification: function($content,$role) {   
        
        
                    function createCustomToast() {
                        var toastContent = document.createElement("div");
                        toastContent.innerHTML  = '<div class="mess-inner fs-small">'+$content+'</div>';
                          return toastContent;
                    }
                    
                    if($content) {
             
                      var bg = '#438f3e';
                      
                      if($role == 'error') {
                         bg = '#bf9537';
                      }
                      
                           Toastify({
                            node: createCustomToast(),
                            duration: 4000,
                            close:true,
                            gravity:'bottom',
                            position:'center',
                            stopOnFocus:true,
                            style: {
                                background:bg,
                            },
                          }).showToast();     
                    }
            
                    
           },
            global_slider($this) { 
        
                    const e = $this.getElementSettings(),
                        t = +e.slides_to_show || 1,
                        s = 1 === t,
                        i = elementorFrontend.config.responsive.activeBreakpoints,
                        n = {
                            mobile: 1,
                            tablet: s ? 1 : 2
                        },
                        a = {
                            autoplay: getAutoplayConfig(),
                            grabCursor: !0,
                            initialSlide: $this.getInitialSlide(),
                            slidesPerView: t,
                            slidesPerGroup: 1,
                            loop: "yes" === e.infinite,
                            centeredSlides: "yes" === e.center_mode,
                            speed: e.transition_speed,
                            effect: e.transition,
                            observeParents: !0,
                            observer: !0,
                            handleElementorBreakpoints: !0,
                            breakpoints: {}
                        };
                    let o = t;
                    Object.keys(i).reverse().forEach((t => {
                        const s = n[t] ? n[t] : o;
                        a.breakpoints[i[t].value] = {
                            slidesPerView: +e["slides_to_show_" + t] || s,
                            slidesPerGroup: +e["slides_to_scroll_" + t] || 1
                        }, e.slide_spacing && (a.breakpoints[i[t].value].spaceBetween = getSpaceBetween(t)), o = +e["slides_to_show_" + t] || s
                    })), e.slide_spacing && (a.spaceBetween = getSpaceBetween());
                    const r = "arrows" === e.navigation || "both" === e.navigation,
                        l = "dots" === e.navigation || "both" === e.navigation;
                    return r && (a.navigation = {
                        prevEl: $this.$element.find(".elementor-swiper-button-prev")[0],
                        nextEl: $this.$element.find(".elementor-swiper-button-next")[0]
                    }), e.disable_drag && (a.allowTouchMove = !1), l && e.pagination && (a.pagination = {
                        el: ".swiper-pagination",
                        type: e.pagination,
                        clickable: !0
                    }, "dynamic" == e.pagination && (a.pagination.dynamicBullets = !0, delete a.pagination.type)), !0 === a.loop && (a.loopedSlides = $this.getSlidesCount()), s ? "fade" === a.effect && (a.fadeEffect = {
                        crossFade: !0
                    }) : a.slidesPerGroup = +e.slides_to_scroll || 1, "coverflow" == a.effect ? a.coverflowEffect = {
                        rotate: 50,
                        stretch: 0,
                        depth: 100,
                        modifier: 1,
                        slideShadows: !0
                    } : "creative" == a.effect ? a.creativeEffect = {
                        prev: {
                            shadow: !0,
                            translate: [0, 0, -400]
                        },
                        next: {
                            translate: ["100%", 0, 0]
                        }
                    } : "creative2" == a.effect ? (a.effect = "creative", a.creativeEffect = {
                        perspective: !0,
                        limitProgress: 2,
                        shadowPerProgress: !0,
                        prev: {
                            shadow: !0,
                            translate: ["-10%", 0, -200],
                            rotate: [0, 0, -2]
                        },
                        next: {
                            shadow: !1,
                            translate: ["120%", 0, 0]
                        }
                    }) : "creative3" == a.effect ? (a.effect = "creative", a.creativeEffect = {
                        prev: {
                            shadow: !0,
                            translate: ["-125%", 0, -800],
                            rotate: [0, 0, -90]
                        },
                        next: {
                            shadow: !0,
                            translate: ["125%", 0, -800],
                            rotate: [0, 0, 90]
                        }
                    }) : "creative4" == a.effect ? (a.effect = "creative", a.creativeEffect = {
                        prev: {
                            shadow: !0,
                            origin: "left center",
                            translate: ["-5%", 0, -200],
                            rotate: [0, 100, 0]
                        },
                        next: {
                            origin: "right center",
                            translate: ["5%", 0, -200],
                            rotate: [0, -100, 0]
                        }
                    }) : "cube" == a.effect ? a.cubeEffect = {
                        shadow: !0,
                        slideShadows: !0,
                        shadowOffset: 20,
                        shadowScale: .94
                    } : "coverflow2" == a.effect && (a.effect = "coverflow", a.coverflowEffect = {
                        rotate: 0,
                        stretch:70,
                        depth: 0,
                        modifier: 2,
                        slideShadows: !0,
                        scale: 0.9
                    }), a
                
                function getAutoplayConfig() {
                    const e = $this.getElementSettings();
                    return "yes" === e.autoplay && {
                        stopOnLastSlide: !0,
                        delay: e.autoplay_speed,
                        disableOnInteraction: "yes" === e.pause_on_interaction
                    }
                }
                
                function getSpaceBetween() {
                    let e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : null;
                    return elementorFrontend.utils.controls.getResponsiveControlValue($this.getElementSettings(), "slide_spacing", "size", e) || 0
                }
        
            },


            fixHeight: function(elem){
                var maxHeight = 0;
                elem.css('height','auto');
                elem.each(function(){
                   if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
                });
               elem.height(maxHeight);
            },


            contact_form_loading: function() {
                $(document).on('click', '.wpcf7-submit', function() {
                    if (!$(this).parents('.wpcf7-form').find('.loader').length) {
                        $(this).parents('.wpcf7-form').append('<div class="loader"><svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>');
                    }
                });
            },
            /* Carousel*/



            init_jws_notices: function() {
                $(document).on('click', '.show_filter_shop', function() {
                    $('#jws-shop-topbar').slideToggle();
                    $(this).toggleClass('active');
                    $('.jws-filter-modal').fadeIn().addClass('open');
                    $('.sidebar-sideout').addClass('opened').toggleClass('open');
                });
                $(document).on('click', '.modal-close , .modal-overlay', function() {
                    $('.jws-filter-modal').fadeOut().removeClass('open');
                    $('.show_filter_shop').removeClass('active');
                });
                $('body').on('click', '.jws-icon-cross', function(e) {
                    e.preventDefault();
                    var _this = $(this).parents('[role="alert"]');
                    _this.remove();

                });

            },
            jws_theme_newsletter: function() {
                var _send_mail = $('.jws-newsletter-popup');
                if (_send_mail.length === 0 || typeof Cookies === undefined) return;
                var _ckie_popup = Cookies.get('ckie_popup');
                if (_ckie_popup !== 'true') {
                    setTimeout(function() {
                        jws_content_newsletter();
                    }, 6000);
                }

                $('.sub-new-nothank').on('click', function() {
                    Cookies.set('ckie_popup', true, { expires: 1, path: '/' });
                    setTimeout(function() {
                        $.magnificPopup.close();
                    }, 300);
                });


                function jws_content_newsletter() {
                    $.magnificPopup.open({
                        items: {
                            src: '.jws-newsletter-popup'
                        },
                        type: 'inline',
                        mainClass: 'mfp-fade',
                        removalDelay: 160,
                        disableOn: false,
                        preloader: false,
                        fixedContentPos: true,
                        overflowY: 'scroll',
                        callbacks: {
                            beforeOpen: function() {
                                this.st.mainClass = 'quick-view-main';
                            },
                            open: function() {
                                $(window).resize()
                            },
                        },
                    });
                }
            },


            jws_theme_countdown: function() {
                var $tb_countdown_js = $('.jws-sale-time');
                if ($tb_countdown_js.length > 0) {
                    $tb_countdown_js.each(function() {
                        var $this = $(this);
                        var $countdown_time = $this.data('countdown');
                        var $current_time = new Date().getTime();
                        var $dateEnd = new Date($countdown_time * 1000);

                        if ($countdown_time > $current_time) {
                            return;
                        }
                        // Update the count down every 1 second
                        setInterval(function() {
                            // Get today's date and time
                            var $current_time = new Date().getTime();
                            // Find the distance between now and the count down date
                            var distance = $dateEnd - $current_time;
                            // Time calculations for days, hours, minutes and seconds
                            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                            if (days < 1) {
                                $this.html('<div class="jws-box-countdown"><span class="wrapper"><span>0</span> <p>' + $this.data('d') + '</p></span></div><span>:</span>' + '<div class="jws-box-countdown"><span class="wrapper"><span>0</span> <p>' + $this.data('h') + '</p></span></div><span>:</span>' + '<div class="jws-box-countdown"><span class="wrapper"><span>0</span> <p>' + $this.data('m') + '</p></span></div><span>:</span>' + '<div class="jws-box-countdown"><span class="wrapper"><span>0</span> <p>' + $this.data('s') + '</p></span></div>');
                                return false;
                            }
                            $this.html('<div class="jws-box-countdown"><span class="wrapper"><span>' + days + '</span> <p>' + $this.data('d') + '</p></span></div><span>:</span>' + '<div class="jws-box-countdown"><span class="wrapper"><span>' + hours + '</span> <p>' + $this.data('h') + '</p></span></div><span>:</span>' + '<div class="jws-box-countdown"><span class="wrapper"><span>' + minutes + '</span> <p>' + $this.data('m') + '</p></span></div><span>:</span>' + '<div class="jws-box-countdown"><span class="wrapper"><span>' + seconds + '</span> <p>' + $this.data('s') + '</p></span></div>');

                        }, 1000);
                    });
                }
            },
            menu_list: function() {
                $(document).on("click", 'body[data-elementor-device-mode="mobile"] .jws-menu-list.toggle-mobile .menu-list-title', function() {
                    $(this).next('ul').slideToggle();
                });
            },


             search_product: function() {

                if (typeof($.fn.devbridgeAutocomplete) == 'undefined') return;
                var escapeRegExChars = function(value) {
                    return value.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
                };
                $('form.jws-ajax-search').each(function() {
                    var $this = $(this),
                        number = parseInt($this.data('count')),
                        thumbnail = parseInt($this.data('thumbnail')),
                        postCat = $this.find('[name="product_cat"]'),
                        $results = $this.parent().find('.jws-search-results'),
                        postType = $this.data('post_type'),
                        url = jws_script.ajax_url + '?action=jws_ajax_search',
                        price = parseInt($this.data('price'));
                    url += '&post_type=' + postType;
                    $results.on('click', '.view-all-results', function() {
                        $this.submit();
                    });
                    $(document).on("click", '.jws-reset-search', function() {
  
                        $this.find('[type="text"]').val('').change();
                    });
                    $this.find('[type="text"]').devbridgeAutocomplete({
                        serviceUrl: url,
                        appendTo: $results,
                        onSelect: function(suggestion) {
                            if (suggestion.permalink.length > 0)
                                window.location.href = suggestion.permalink;
                        },
                        onSearchStart: function(query) {
                            if (!$this.find('.form-loader .loader').length) {
                                $this.find('.form-loader').append('<div class="loader"><svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>');
                            }
                            $this.addClass('search-loading');
                        },
                        beforeRender: function(container) {
                            if (container[0].childElementCount > 2)
                                $(container).append('<div class="view-all-results"><span>View all results</span></div>');
                        },
                        onSearchComplete: function(query, suggestions) {
                            $this.removeClass('search-loading');
                        },
                        formatResult: function(suggestion, currentValue) {
                            if (currentValue == '&') currentValue = "&#038;";
                            var pattern = '(' + escapeRegExChars(currentValue) + ')',
                                returnValue = '';
                            if (thumbnail && suggestion.thumbnail) {
                                returnValue += ' <div class="suggestion-thumb">' + suggestion.thumbnail + '</div>';
                            }
                            returnValue += '<div class="suggestion_content"><h4 class="suggestion-title result-title">' + suggestion.value + '</h4>';
                            if (suggestion.no_found) returnValue = '<div class="suggestion-title no-found-msg">' + suggestion.value + '</div>';
                            if (price && suggestion.price) {
                                returnValue += ' <div class="suggestion-price price">' + suggestion.price + '</div></div>';
                            }
                            return returnValue;
                        }
                    });
                    if (postCat.length) {
                        var searchForm = $this.find('[type="text"]').devbridgeAutocomplete(),
                            serviceUrl = jws_script.ajax_url + '?action=jws_ajax_search';
                        if (number > 0) serviceUrl += '&number=' + number;
                        serviceUrl += '&post_type=' + postType;
                        postCat.on('cat_selected', function() {
                            if (postCat.val() != '') {
                                searchForm.setOptions({
                                    serviceUrl: serviceUrl + '&product_cat=' + postCat.val()
                                });
                            } else {
                                searchForm.setOptions({
                                    serviceUrl: serviceUrl
                                });
                            }
                            searchForm.hide();
                            searchForm.onValueChange();
                        });
                    }
                 
                    $('.jws-search-results').click(function(e) {
                        e.stopPropagation();
                    });
                });
                $('.input-dropdown').eq(0).each(function() {
                    var dd = $(this);
                    var btn = dd.find('> a');
                    var input = dd.find('> input');
                    var list = dd.find('> .list-wrapper');
                    var form_skin = dd.parents('.jws-search-form');


                    list.on('click', 'a', function(e) {
                        e.preventDefault();

                        var value = $(this).data('val');
                        var label = $(this).text();
                        list.find('.active').removeClass('active');
                        $(this).addClass('active');
                        btn.text(label);
                        input.val(value).trigger('cat_selected');


                    });


                });
            },



            header_sticky: function() {
                if ($('.cafe-row-sticky')[0]) {

                    $('.cafe-row-sticky').each(function() {
                        var $this = $(this);
                        var $sidebar = $('.jws_sticky_move');
                        var $parent = $(this).parent();
                        var current_width = 0;

                        $(window).resize(function() {
                            if (current_width != $(window).width()) {
                                current_width = $(window).outerWidth();
                                $parent.height('');
                                if (current_width > 1024.98 && $this.hasClass('desktop-sticky')) {
                                    $parent.height($this.outerHeight());
                                } else if (current_width < 1024.98 && current_width > 768.98 && $this.hasClass('tablet-sticky')) {
                                    $parent.height($this.outerHeight());
                                } else if (current_width < 768.98 && $this.hasClass('mobile-sticky')) {
                                    $parent.height($this.outerHeight());
                                } else {
                                    $this.removeClass('is-sticky');
                                    $this.find('.elementor-widget-clever-site-logo').removeClass('header-is-sticky');
                                }
                                $parent.addClass('installed')

                            }
                        }).resize();
                        var HeaderTop = $parent.offset().top - $('body').offset().top;
                        var old_top_position = 0;


                        $(window).on('scroll', function() {
                            if ($parent.hasClass('installed')) {
                                var top = $(window).scrollTop();
                                if ($this.hasClass('cafe-scroll-up-sticky')) {
                                    top = top - $parent.outerHeight();
                                    if (old_top_position > top && top > $parent.outerHeight() * 3) {
                                        $this.not('.active-sticky').addClass('active-sticky');
                                        $this.removeClass('no-active-sticky');
                                        $sidebar.removeClass('no-active-sticky');
                                    } else {
                                        $this.removeClass('active-sticky');
                                        if ($this.hasClass('is-sticky')) {
                                            $this.addClass('no-active-sticky');
                                            $sidebar.addClass('no-active-sticky');
                                        }
                                    }
                                    old_top_position = top;
                                }
                                if (current_width > 1024.98 && $this.hasClass('desktop-sticky')) {
                                    if (HeaderTop < top) {
                                        $this.not('.is-sticky').addClass('is-sticky');
                                        $this.find('.elementor-widget-clever-site-logo:not(.header-is-sticky)').addClass('header-is-sticky');
                                        $('.cafe-wrap-menu .toggle .arrow.on-scroll').parents('.cafe-wrap-menu').removeClass('toggle-active');
                                        $('.cafe-wrap-menu .toggle .arrow.on-scroll').parents('.cafe-wrap-menu').find('.wrap-menu-inner').slideUp();
                                    } else {
                                        $this.removeClass('is-sticky');
                                        $this.removeClass('no-active-sticky');
                                        $sidebar.removeClass('no-active-sticky');
                                        $this.find('.elementor-widget-clever-site-logo').removeClass('header-is-sticky');
                                        $('.cafe-wrap-menu .toggle .arrow.on-scroll').parents('.cafe-wrap-menu').addClass('toggle-active');
                                        $('.cafe-wrap-menu .toggle .arrow.on-scroll').parents('.cafe-wrap-menu').find('.wrap-menu-inner').slideDown();
                                    }
                                } else if (current_width < 1024.98 && current_width > 768.98 && $this.hasClass('tablet-sticky')) {
                                    if (HeaderTop < top) {
                                        $this.not('.is-sticky').addClass('is-sticky');
                                        $this.find('.elementor-widget-clever-site-logo').addClass('header-is-sticky');
                                        $('.cafe-wrap-menu .toggle .arrow.on-scroll').parents('.cafe-wrap-menu').removeClass('toggle-active');
                                        $('.cafe-wrap-menu .toggle .arrow.on-scroll').parents('.cafe-wrap-menu').find('.wrap-menu-inner').slideUp();
                                    } else {
                                        $this.removeClass('is-sticky');
                                        $this.removeClass('no-active-sticky');
                                        $sidebar.removeClass('no-active-sticky');
                                        $this.find('.elementor-widget-clever-site-logo').removeClass('header-is-sticky');
                                        $('.cafe-wrap-menu .toggle .arrow.on-scroll').parents('.cafe-wrap-menu').addClass('toggle-active');
                                        $('.cafe-wrap-menu .toggle .arrow.on-scroll').parents('.cafe-wrap-menu').find('.wrap-menu-inner').slideDown();
                                    }
                                } else if (current_width < 768.98 && $this.hasClass('mobile-sticky')) {
                                    if (HeaderTop < top) {
                                        $this.not('.is-sticky').addClass('is-sticky');
                                        $this.find('.elementor-widget-clever-site-logo:not(.header-is-sticky)').addClass('header-is-sticky');
                                        $('.cafe-wrap-menu .toggle .arrow.on-scroll').parents('.cafe-wrap-menu').removeClass('toggle-active');
                                        $('.cafe-wrap-menu .toggle .arrow.on-scroll').parents('.cafe-wrap-menu').find('.wrap-menu-inner').slideUp();
                                    } else {
                                        $this.removeClass('is-sticky');
                                        $this.removeClass('no-active-sticky');
                                        $sidebar.removeClass('no-active-sticky');
                                        $this.find('.elementor-widget-clever-site-logo.header-is-sticky').removeClass('header-is-sticky');
                                        $('.cafe-wrap-menu .toggle .arrow.on-scroll').parents('.cafe-wrap-menu').addClass('toggle-active');
                                        $('.cafe-wrap-menu .toggle .arrow.on-scroll').parents('.cafe-wrap-menu').find('.wrap-menu-inner').slideDown();
                                    }
                                }
                            }
                        });
                    });

                }
            },


            /**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * post audio
			 *--------o-----------------------------------------------------------------------------------------------------------------------------------
			 */
			post_audio_play: function() {
				var players = $('audio.blog-audio-player');

				if (players.length) {
					players.mediaelementplayer({
						audioWidth: '100%'
					});
				}
			},
            /* ## Theme popup */
            mobile_default: function() {
                $('body').on('click', '.jws-tiger-mobile,.overlay', function() {
                    $(this).parents('.elemetor-menu-mobile').toggleClass('active');
                });
            },
            /* ## Theme popup */
            handlePopup: function(data) {
                $(data).each(function() {
                    // Activate popup
                    $(this).addClass('visible');
                    $(this).find('.btn-loading-disabled').addClass('btn-loading');
                });
            },
            scrollTop: function() {
                //Check to see if the window is top if not then display button
                $(window).scroll(function() {
                    if ($(this).scrollTop() > 100) {
                        $('.backToTop').addClass('totop-show');
                    } else {
                        $('.backToTop').removeClass('totop-show');
                    }
                });
                //Click event to scroll to top
                $('.backToTop').on("click", function() {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 1000);
                    return false;
                });
            },
            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * video popup
             *-------------------------------------------------------------------------------------------------------------------------------------------
             */
            video_popup: function() {
                $('.video_format').eq(0).each(function() {
                    $('.video_format').magnificPopup({
                        delegate: 'a',
                        type: 'image',
                        removalDelay: 500, //delay removal by X to allow out-animation
                        callbacks: {
                            beforeOpen: function() {
                                this.st.mainClass = 'mfp-zoom-in';
                            },
                            elementParse: function(item) {
                                item.type = 'iframe',
                                    item.iframe = {
                                        patterns: {
                                            youtube: {
                                                index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
                                                id: 'v=', // String that splits URL in a two parts, second part should be %id%
                                                // Or null - full URL will be returned
                                                // Or a function that should return %id%, for example:
                                                // id: function(url) { return 'parsed id'; } 
                                                src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe. 
                                            },
                                            vimeo: {
                                                index: 'vimeo.com/',
                                                id: '/',
                                                src: '//player.vimeo.com/video/%id%?autoplay=1'
                                            }
                                        }
                                    };
                            }
                        },
                    });
                });
            },
            post_related: function() {
                if($('.post_related_slider').length){
                    var swiperOptions = $('.post_related_slider').data('swiper');
    
                var swiper = new Swiper('.post_related_slider', swiperOptions);
                }
 
            },
            /**
             *-------------------------------------------------------------------------------------------------------------------------------------------
             * post fomart
             *--------o-----------------------------------------------------------------------------------------------------------------------------------
             */
            post_gallery: function() {
	           if($('.post_content .post-image-slider').length){
	                //setTimeout(function() {
           
                    $('.post-image-slider').each(function () {
                        var $slider = $(this);
                        var $pagi = $slider.find('.swiper-pagination');
                       
                            
                        var swiper = new Swiper( $slider, {
                             slidesPerView:1,
                            spaceBetween: 0,
                            nested: true,
                            pagination: {
                                el: $pagi,
                                clickable: true, // Enable clickable pagination bullets
                              },
                             
                        }); 
                                                
                          
        	           }); 
                        // Update Swiper on window resize
                   
                    // }, 700); 
	           }

            },
            menu_offset: function() {
                var setOffset = function(li, $menu) {

                    var $dropdown = li;
                    var dropdownWidth = $dropdown.outerWidth();
                    var dropdownOffset = $menu.offset();
                    var toRight;
                    var viewportWidth;
                    var dropdownOffsetRight;
                    viewportWidth = $(document).width();
                    if (!dropdownWidth || !dropdownOffset) {
                        return;
                    }

                    if ($dropdown.hasClass('mega_menu_full_width')) {
                        dropdownOffsetRight = viewportWidth - dropdownOffset.left - dropdownWidth;
                        var extraSpace = 0;
                        var dropdownOffsetLeft;


                        dropdownOffsetLeft = dropdownOffsetRight;

                        $dropdown.css({
                            left: -dropdownOffset.left - extraSpace
                        });


                    }
                };
                $('.elementor_jws_menu_layout_menu_horizontal li.menu-item-design-mega_menu_full_width').each(function() {
                    var $menu = $(this);
                    $menu.find(' > .sub-menu-dropdown').each(function() {
                        setOffset($(this), $menu);
                    });
                });
            },
            menu_mobile: function() {
                var dropDownCat = $(".elementor_jws_menu_layout_menu_vertical .menu-item-has-children"),
                    elementIcon = '<button class="btn-sub-menu jws-icon-caretright"></button>';
            dropDownCat.find('> a').append(elementIcon);
            
             //insertAfter(dropDownCat.find('> a'));
                if (dropDownCat.hasClass("active")) {
                    dropDownCat.addClass("active");
                }
                $(document).on("click", ".btn-sub-menu", function(e) {
                    e.preventDefault();


                    $(this).closest("li.menu-item-has-children").siblings().removeClass('active');
                    $(this).closest("li.menu-item-has-children").siblings().find("> ul,.sub-menu-dropdown").slideUp(320);

                    $(this).closest("li.menu-item-has-children").find("> ul").slideToggle(320);
                    $(this).closest("li.menu-item-has-children").find(".sub-menu-dropdown").slideToggle(320);


                   
                     

                   
                        $(this).closest("li.menu-item-has-children").toggleClass('active');
                    
                });
            },
            login_form: function() {
			    $('.jws-open-login:not(.logged)').on('click', function(e) { 
			         event.preventDefault();
			         $('.jws-form-login-popup').addClass('open');
                    $('.jws-offcanvas').removeClass('jws-offcanvas-show');
                    $('.jws-offcanvas-trigger').removeClass('active');
			    });
                $('.jws-close , .jws-form-overlay').on('click', function(e) {
                    $('.jws-form-login-popup').removeClass('open');
                });
                $('.jws_toolbar_search').on('click', function(e) {
                    e.preventDefault();
                    $('.form_content_popup').addClass('open');
                });

                $('.jws-login-form').each(function() {
                    var $this = $(this);
                    
                    if (!$('.form-contaier').hasClass('url')) {
                            var swiper = new Swiper('.form-contaier', {
                            // Optional parameters
                            direction: 'horizontal',
                            
                            loop: false,
                            slidesPerView: 1,
                            spaceBetween: 0,

                        });        
                    }

                    $(this).find('form[name=loginpopopform]').on('submit', function(event) {
                        event.preventDefault();
                        var valid = true,
                            email_valid = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;
                        $(this).find('.error').remove();
                        $(this).find('input.required').each(function() {
                            // Check empty value
                            if (!$(this).val()) {
                                $(this).addClass('invalid');
                                if ($(this).attr('name') == 'log') {

                                    $(this).after('<span class="error">Please enter your email</span>');
                                }

                                // pass
                                if ($(this).attr('name') == 'pwd') {

                                    $(this).after('<span class="error">Please enter your Password</span>');
                                }
                                valid = false;
                            }
                            // Uncheck
                            if ($(this).is(':checkbox') && !$(this).is(':checked')) {
                                $(this).addClass('invalid');
                                valid = false;
                            }
                            // Check email format
                            if ('email' === $(this).attr('type')) {
                                if (!email_valid.test($(this).val())) {
                                    $(this).addClass('invalid');
                                    valid = false;
                                }
                            }
                        });
                        $(this).find('input.required').on('focus', function() {
                            $(this).removeClass('invalid');
                        });
                        if (!valid) {
                            return valid;
                        }
                        var form = $(this),
                            $elem = $this.find('.jws-login-container'),
                            wp_submit = $elem.find('input[type=submit]').val();
                        if (!$elem.find('.loader').length) {
                            $elem.append('<div class="loader"><svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>');
                        }
                        $elem.addClass('loading');
                        $elem.find('.jws-login .popup-message').slideUp();
                        $elem.find('.message').slideDown().remove();
                   
                        var data = {
                            action: 'jws_login_ajax',
                            data: form.serialize() + '&wp-submit=' + wp_submit,
                        };
                        $.post(jwsThemeModule.jws_script.ajax_url, data, function(response) {
                            if (response.data.code == '1') {
                                if (response.data.redirect) {
                                    if (window.location.href == response.data.redirect) {
                                        location.reload();
                                    } else {
                                        window.location.href = response.data.redirect;
                                    }
                                } else {
                                    location.reload();
                                }

                                $elem.find('.jws-login .popup-message').removeClass('woocommerce-info').addClass('woocommerce-message');
                            } else {
                                $elem.find('.jws-login .popup-message').addClass('woocommerce-info');
                            }
                            $elem.find('.jws-login .popup-message').html(response.data.message).slideDown();
                            $elem.removeClass('loading');
                            
              
                        });
                        return false;
                    });
                    
               
                    

                    $(this).find('form[name=registerformpopup]').on('submit', function(e) {
                        e.preventDefault();
                        var valid = true,
                            email_valid = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;
                        $(this).find('.error').remove();
                        $(this).find('input.required').each(function() {
                            // Check empty value
                            if (!$(this).val()) {
                                $(this).addClass('invalid');

                                // email
                                if ($(this).attr('name') == 'user_email') {

                                    $(this).after('<span class="error">Please enter your Email</span>');
                                }
                                valid = false;
                            }
                            // Uncheck
                            if ($(this).is(':checkbox') && !$(this).is(':checked')) {
                                $(this).addClass('invalid');
                                valid = false;
                            }
                            // Check email format
                            if ('email' === $(this).attr('type')) {
                                if (!email_valid.test($(this).val())) {
                                    $(this).addClass('invalid');
                                    valid = false;
                                }
                            }
                        });
                        $(this).find('input.required').on('focus', function() {
                            $(this).removeClass('invalid');
                        });
                        if (!valid) {
                            return valid;
                        }
                        var $form = $(this),
                            data = {
                                action: 'jws_register_ajax',
                                data: $form.serialize() + '&wp-submit=' + $form.find('input[type=submit]').val(),
                                register_security: $form.find('#register_security').val(),
                            },
                            $elem = $('#jws-login-form .jws-login-container');
                        if (!$elem.find('.loader').length) {
                            $elem.append('<div class="loader"><svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>');
                        }
                        $elem.addClass('loading');
                        $elem.find('.jws-register .popup-message').slideUp();
                        $elem.find('.message').slideDown().remove();
              
                        $.ajax({
                            type: 'POST',
                            url: jwsThemeModule.jws_script.ajax_url,
                            data: data,
                            success: function(response) {
                                $elem.removeClass('loading');
                                console.log(response);
                                if (response.data.code == '1') {
                                    if (response.data.redirect) {
                                        if (window.location.href == response.data.redirect) {
                                            location.reload();
                                        } else {
                                            window.location.href = response.data.redirect;
                                        }
                                    } else {
                                        location.reload();
                                    }

                                    $elem.find('.jws-register .popup-message').removeClass('woocommerce-info').addClass('woocommerce-message');
                                } else {
                                    $elem.find('.jws-register .popup-message').addClass('woocommerce-info');

                                }
                                $elem.find('.jws-register .popup-message').html(response.data.message).slideDown();
                    
                            },
                        });
                    });
                    /* Check Strong Passwoed */
                    $(this).find('.jws-register input[name="password"]').keyup(function() {
                        checkpassword($(this).val());
                        $('.slick-list').css('height', 'auto');
                    });

                    function checkpassword(password) {
                        var strength = 0,
                            meter = $('.meter'),
                            meter_text = $('.text-meter'),
                            password_hint = $('.jws-password-hint');
                        if (password.match(/[a-z]+/)) {
                            strength += 1;
                        }
                        if (password.match(/[A-Z]+/) && password.length >= 8) {
                            strength += 1;
                        }
                        if (password.match(/[0-9]+/) && password.length >= 12) {
                            strength += 1;
                        }
                        if (password.match(/[$@#&!]+/) && password.length >= 14) {
                            strength += 1;
                        }
                        if (password.length > 0) {
                            meter.show();
                            password_hint.show();
                        } else {
                            meter.hide();
                            password_hint.hide();
                        }
                        switch (strength) {
                            case 0:
                                meter_text.html("");
                                meter.attr("meter", "0");
                                break;
                            case 1:
                                meter_text.html(jwsThemeModule.jws_script.metera);
                                meter.attr("meter", "1");
                                break;
                            case 2:
                                meter_text.html(jwsThemeModule.jws_script.meterb);
                                meter.attr("meter", "2");
                                break;
                            case 3:
                                meter_text.html(jwsThemeModule.jws_script.meterc);
                                meter.attr("meter", "3");
                                password_hint.hide();
                                break;
                            case 4:
                                meter_text.html(jwsThemeModule.jws_script.meterd);
                                meter.attr("meter", "4");
                                password_hint.hide();
                                break;
                        }
                    }
                    if (!$('.form-contaier').hasClass("url")) {
                        
                
                        $(this).find('.change-form.login').on('click', function(e) {
                            e.preventDefault();
                            swiper.slideTo(0); // Go to the first slide
                            $this.addClass('in-login').removeClass('in-register');
                            
                        });
                        $(this).find('.change-form.register').on('click', function(e) {
                            e.preventDefault();
                            swiper.slideTo(1); // Go to the second slide
                            $this.removeClass('in-login').addClass('in-register');
                        });
                  
                    }

                    $this.on('click','.toggle-password2' , function(){
                     
                        $(this).toggleClass("jws-icon-eye");
                        
                        var password = $(this).closest('.form_group').find('#s-password');
                        var password_repeat = $(this).closest('.form_group').find('#re-password');
                
                        if (password.attr('type') == 'password') {
                            password.attr('type', 'text');
                        } else {
                            password.attr('type', 'password');
                        }
                        if (password_repeat.attr('type') == 'password') {
                            password_repeat.attr('type', 'text');
                        } else {
                            password_repeat.attr('type', 'password');
                        }
                        
                    });
                    
                });
                
                
                
                
            },
            menu_nav: function() {
                var mainMenu = $('.elementor_jws_menu_layout_menu_horizontal').find('.nav'),
                    lis = mainMenu.find(' > li.menu-item-design-mega_menu');
                mainMenu.on('hover', ' > li.menu-item-design-mega_menu', function() {
                    setOffset($(this));
                });
                var setOffset = function(li) {
                    var dropdown = li.find(' > .sub-menu-dropdown');
                    dropdown.attr('style', '');
                    var dropdownWidth = dropdown.outerWidth(),
                        dropdownOffset = dropdown.offset(),
                        screenWidth = $(window).width(),
                        viewportWidth = screenWidth,
                        extraSpace = 10;
                    if (!dropdownWidth || !dropdownOffset) return;
                    if (dropdownOffset.left + dropdownWidth >= viewportWidth && li.hasClass('menu-item-design-mega_menu')) {
                        // If right point is not in the viewport
                        var toRight = dropdownOffset.left + dropdownWidth - viewportWidth;
                        dropdown.css({
                            left: -toRight - extraSpace
                        });
                    }
                };
                lis.each(function() {
                    setOffset($(this));
                    $(this).addClass('with-offsets');
                });
                //mega menu  
                var mega_item = mainMenu.find(' > li.menu-item-design-mega_menu_full_width');
                if (mega_item.length > 0) {
                    $('.jws_header').addClass('has-mega-full');
                }
                if ($('.elementor_jws_menu_layout_menu_horizontal').hasClass('elementor-jws-menu-change-background-yes')) {
                    mega_item.mouseenter(function() {
                        $('.jws_header.has-mega-full').addClass('mega-has-hover');
                    });
                    mega_item.mouseleave(function() {
                        $('.jws_header.has-mega-full').removeClass('mega-has-hover');
                    });
                }
            },

        };
    }());
    $(document).ready(function(){
        /* remove the 'title' attribute of all <img /> tags */
        $("img").removeAttr("title");
    });
    $(document).ready(function() {
        jwsThemeModule.init();
    });
    $.fn.isInViewport = function() {
        let elementTop = $(this).offset().top;
        let elementBottom = elementTop + $(this).outerHeight();
        let viewportTop = $(window).scrollTop();
        let viewportBottom = viewportTop + $(window).height();

        return elementBottom > viewportTop && elementTop < viewportBottom;
    };

    $(window).on("resize", function(e) {
        jwsThemeModule.menu_offset();
    });

    $(document).ready(function() {
        setTimeout(function() {
            $('.load-template').each(function() {
                $(this).parent().html(JSON.parse($(this).html()));
            });
        }, "700");
    });


    $.fn.gallery_popup = function(option) {
        if (typeof($.fn.magnificPopup) == 'undefined') return;
        option.find('a.jws-popup-global').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            },
            removalDelay: 500, //delay removal by X to allow out-animation
            mainClass: 'gallery-global mfp-zoom-in mfp-img-mobile',
            callbacks: {
                open: function() {
                    //overwrite default prev + next function. Add timeout for css3 crossfade animation
                    $.magnificPopup.instance.next = function() {
                        var self = this;
                        self.wrap.removeClass('mfp-image-loaded');
                        setTimeout(function() {
                            $.magnificPopup.proto.next.call(self);assets
                        }, 120);
                    };
                    $.magnificPopup.instance.prev = function() {
                        var self = this;
                        self.wrap.removeClass('mfp-image-loaded');
                        setTimeout(function() {
                            $.magnificPopup.proto.prev.call(self);
                        }, 120);
                    };
                },
                imageLoadComplete: function() {
                    var self = this;
                    setTimeout(function() {
                        self.wrap.addClass('mfp-image-loaded');
                    }, 16);
                },
            },
        });
    };
    
    
    $.fn.maker_html = function(latlng, map, id , className) {
        function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }
        function CustomMarker(latlng, map, id , className) {
            this.latlng_ = latlng;
            this.className = className;
            this.id = id;
        
            this.setMap(map);
         
          }
        
          if ((typeof google === "undefined" ? "undefined" : _typeof(google)) !== _typeof(undefined) && _typeof(google.maps) !== _typeof(undefined)) {
            CustomMarker.prototype = new google.maps.OverlayView();
        
            CustomMarker.prototype.draw = function () {
              var me = this; // Check if the div has been created.
        
              var div = this.div_,
                  divChild,
                  divChild2;
              if (!div) {
                  // Create a overlay text DIV
                div = this.div_ = document.createElement('DIV');
                div.className = this.className;
                div.setAttribute("data-id", this.id);
                divChild = document.createElement("div");
                div.appendChild(divChild);
                divChild2 = document.createElement("div");
                div.appendChild(divChild2);
                google.maps.event.addDomListener(div, "click", function (event) {
                  google.maps.event.trigger(me, "click");
                }); // Then add the overlay to the DOM
        
                var panes = this.getPanes();
                panes.overlayImage.appendChild(div);
              } // Position the overlay
        
        
              var point = this.getProjection().fromLatLngToDivPixel(this.latlng_);
        
              if (point) {
                div.style.left = point.x + 'px';
                div.style.top = point.y + 'px';
              }
            };
        
            CustomMarker.prototype.remove = function () {
              // Check if the overlay was on the map and needs to be removed.
              if (this.div_) {
                this.div_.parentNode.removeChild(this.div_);
                this.div_ = null;
              }
            };
        
            CustomMarker.prototype.getPosition = function () {
              return this.latlng_;
            };
          }
    };




})(jQuery);

(function ($) {
  'use strict';

  const pluginName = 'jwsMarquee';
  let defaults = {
    items: '.marquee-list-items',
    item: '.item',
    speed: 0.5,
    reversed: !1,
    scroll: !1
  };
  class Plugin {
    constructor(element, options) {
    this._defaults = defaults;
    this._name = pluginName;
    this.options = {
        ...defaults,
        ...options
     };
     this.element = element;
     this.$element = $(element);
    
   
    
    this._ui = [];
      
    const all_item = this.element.querySelectorAll(".item");
    
    all_item.forEach((t, e) => {
        
     this._ui[e] = t
      
    });
  
    this.size = {
        width: 0,
        height: 0
    };
    
    this.items = this._ui.map(e=>({
            el: e,
            size: {
                width: 0,
                height: 0
            },
            position: {
                x: 0
            }
     })),
     
     this.init();

    }
   
     init() {
      this.measure(); 
      this.fill(); 
      this.getStartX();
      this.createmarquee();
      this.setIntersectionObserver(),
      this.options.scroll && this.srolltrigger();
    }
    
   async measure() {
   // return fastdom.mutate(() => {
        this.size.width = this.element.offsetWidth;
        this.items.forEach((e,t)=>{
            e.size = {
                width: e.el.offsetWidth,
                height: e.el.offsetHeight
            },
            e.position = {
                x: e.el.offsetLeft
            },
            t === 0 && (this.size.height = e.size.height),
            t > 0 && e.size.height > this.items[t - 1].size.height && (this.size.height = e.size.height)
        })
    // });
    }
     async fill() {
        const e = this.items.at(-1);
      
      if( e.size.width + e.position.x < this.size.width) {
    
      
            if (this.isDestroyed)
                return;
            const t = this.element.querySelector(".marquee-list-items");
         
           
            let l = !1
              , n = 0;
            for (; !l; ) {
                const s = {
                    el: this.items[n].el.cloneNode(!0),
                    size: {
                        ...this.items[n].size
                    },
                    position: {
                        ...this.items[n].position
                    }
                };
           
                t.insertAdjacentElement("beforeend", s.el),
                s.position.x = s.el.offsetLeft,
                this.items.push(s),
                n++,
                s.size.width + s.position.x > this.size.width && (l = !0)
            }
           }
    }
    getStartX() {
        this.startX = this.items[0].position.x - parseInt(getComputedStyle(this.items[0].el).marginInlineEnd, 10)
    }
    
    createmarquee() {
        
        const {
          items,
          item
        }  = this.options;
        const e = this.getItemElements();
        this.timeline = gsap.timeline({
            repeat: -1,
            paused: !0,
            defaults: {
                ease: "none"
            },
            onReverseComplete: ()=>this.timeline.totalTime(this.timeline.rawTime() + this.timeline.duration() * 100)
        });
        const t = this.items.length
          , l = this.items[t - 1]
          , n = []
          , h = []
          , s = this.options.speed * 100
          , m = i=>i;
        let c, o, d, a;
      
        gsap.set(e, {
            xPercent: (i,r)=>{
                const p = this.items[i].size.width;
                return h[i] = m(parseFloat(gsap.getProperty(r, "x", "px")) / p * 100 + gsap.getProperty(r, "xPercent")),
                h[i]
            }
            ,
            x: 0
        }),
        c = l.position.x + h[t - 1] / 100 * l.size.width - this.startX + l.size.width * gsap.getProperty(e[t - 1], "scaleX");

        for (let i = 0; i < t; i++) {
            const r = this.items[i];
            o = h[i] / 100 * r.size.width,
            d = r.position.x + o - this.startX,
            a = d + r.size.width * gsap.getProperty(r.el, "scaleX"),
            this.timeline.to(r.el, {
                xPercent: m((o - a) / r.size.width * 100),
                duration: a / s
            }, 0).fromTo(r.el, {
                xPercent: m((o - a + c) / r.size.width * 100)
            }, {
                xPercent: h[i],
                duration: (o - a + c - o) / s,
                immediateRender: !1
            }, a / s).add("label" + i, d / s),
            n[i] = d / s
        }
        this.timeline.times = n
        this.timeline.progress(1, !0).progress(0, !0),
        this.options.reversed && this.timeline.vars.onReverseComplete()
        
    }
    srolltrigger() {
        const t = this.options.reversed ? -1 : 1
        , l = gsap.utils.clamp(-6, 6);
        this.STTween = gsap.to(this.timeline, {
            duration: 1.5,
            timeScale: t,
            paused: !0
        }),
        this.ST = ScrollTrigger.create({
            start: 0,
            end: "max",
            onUpdate: n=>{
                this.isPaused || (this.timeline.timeScale(l(n.getVelocity() / 200 * t)),
                this.STTween.invalidate().restart())
            }
        })
    }
    
    play() {

        this.setWillChange("transform"),
        this.options.reversed ? this.timeline.reverse() : this.timeline.play(),
        this.isPaused = !1
        
    }
    pause() {
        this.setWillChange(""),
        this.timeline.pause(),
        this.isPaused = !0
    }
    setIntersectionObserver() {
        new IntersectionObserver(([e],t)=>{
            if (this.isDestroyed)
                return t.disconnect();
            e.isIntersecting ? this.play() : this.pause()
        }
        ).observe(this.element)
    }
    setWillChange(e) {
        this.getItemElements().forEach(t=>t.style.willChange = e)
    }
    getItemElements() {
        return this.items.map(e=>e.el)
    }
    
  }
  $.fn[pluginName] = function (options) {
    return this.each(function () {
      const pluginOptions = $(this).data('marquee-options') || options;
      if (!$.data(this, "plugin_" + pluginName)) {
        $.data(this, "plugin_" + pluginName, new Plugin(this, pluginOptions));
      }
    });
  };
})(jQuery);