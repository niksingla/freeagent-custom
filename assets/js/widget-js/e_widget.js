(function($) {
    "use strict";
 

    $(window).on('elementor/frontend/init', function() {
 
        //new
        
        class Marquee extends elementorModules.frontend.handlers.Base {
            
        onInit(...e) {
            
            super.onInit(...e), this.handleDestroy() , this.initMarquee();
        
          
        }
        
        getDefaultSettings() {
            return {
                selectors: {
                    MarqueeElement: ".jws-marquee",
                }
            }
        }
        getDefaultElements() {
            const e = this.getSettings("selectors");
            return {
                $marqueeElement: this.$element.find(e.MarqueeElement),
            }
        }
        
        initMarquee() {
            this.elements.$marqueeElement.jwsMarquee();
        }
        
        
        onDestroy() {
            this.handleDestroy(), super.onDestroy()
        }
        
        handleDestroy() {
           
        }
        
        }
        
        elementorFrontend.elementsHandler.attachHandler("marquee_advanced", Marquee); 
         /* ---------------- Team Slider ---------------- */

        class Jws_team extends elementorModules.frontend.handlers.SwiperBase {
                onInit(...e) {
                    super.onInit(...e), this.handleDestroy() , this.jws_init()
                  
                }
                getDefaultSettings() {
                    return {
                        selectors: {
                            slider: ".jws_team_slider",
                            slide: ".swiper-slide",
                        }
                    }
                }
                getDefaultElements() {
                    const e = this.getSettings("selectors"),
                    t = {
                        $swiperContainer: this.$element.find(e.slider)
                    };
              
                    return t.$slides = t.$swiperContainer.find(e.slide), t
                    
                }
            
                onDestroy() {
                    
                    this.handleDestroy(), super.onDestroy()
                    
                }
                
                handleDestroy() {
                    
                    
                }
                
                jws_init() {
                           
                    const element_setting = this.getElementSettings();
               
                    this.initSlider();
                    
                }
                
               async initSlider() {
                    
                    const config =  jwsThemeModule.global_slider(this);
                    const slider = this.elements.$swiperContainer;
                    if (!slider.length) return;
                    if (1 >= this.getSlidesCount()) return;
                    const t = elementorFrontend.utils.swiper;
                    this.swiper = await new t(slider, config);
             
                }
                
            
        }
              
        elementorFrontend.elementsHandler.attachHandler("jws_team", Jws_team);
         /* ---------------- Jws_Gallery Slider ---------------- */

        class Jws_Gallery extends elementorModules.frontend.handlers.SwiperBase {
                onInit(...e) {
                    super.onInit(...e), this.handleDestroy() , this.jws_init()
                  
                }
                getDefaultSettings() {
                    return {
                        selectors: {
                            slider: ".jws_gallery_slider",
                            slide: ".swiper-slide",
                        }
                    }
                }
                getDefaultElements() {
                    const e = this.getSettings("selectors"),
                    t = {
                        $swiperContainer: this.$element.find(e.slider)
                    };
              
                    return t.$slides = t.$swiperContainer.find(e.slide), t
                    
                }
            
                onDestroy() {
                    
                    this.handleDestroy(), super.onDestroy()
                    
                }
                
                handleDestroy() {
                    
                    
                }
                
                jws_init() {
                           
                    const element_setting = this.getElementSettings();
               
                    this.initSlider();
                    
                }
                
               async initSlider() {
                    
                    const config =  jwsThemeModule.global_slider(this);
                    const slider = this.elements.$swiperContainer;
                    if (!slider.length) return;
                    if (1 >= this.getSlidesCount()) return;
                    const t = elementorFrontend.utils.swiper;
                    this.swiper = await new t(slider, config);
                      $('.jws_gallery').lightGallery({
                        thumbnail: true,
                        selector: '.jws_gallery_item .jws-popup-global'
                    });
                }
                
            
        }
              
        elementorFrontend.elementsHandler.attachHandler("jws_gallery", Jws_Gallery);
        
          /* ---------------- Jws_Image_Carousel Slider ---------------- */

        class JwsCategoryList extends elementorModules.frontend.handlers.SwiperBase {
                onInit(...e) {
                    super.onInit(...e), this.handleDestroy() , this.jws_init()
                  
                }
                getDefaultSettings() {
                    return {
                        selectors: {
                            slider: ".jws_product_category_list",
                            slide: ".swiper-slide",
                        }
                    }
                }
                getDefaultElements() {
                    const e = this.getSettings("selectors"),
                    t = {
                        $swiperContainer: this.$element.find(e.slider)
                    };
              
                    return t.$slides = t.$swiperContainer.find(e.slide), t
                    
                }
            
                onDestroy() {
                    
                    this.handleDestroy(), super.onDestroy()
                    
                }
                
                handleDestroy() {
                    
                    
                }
                
                jws_init() {
                           
                    const element_setting = this.getElementSettings();
               
                    this.initSlider();
                    
                }
                
               async initSlider() {
                    
                    const config =  jwsThemeModule.global_slider(this);
                    const slider = this.elements.$swiperContainer;
                    if (!slider.length) return;
                    if (1 >= this.getSlidesCount()) return;
                    const t = elementorFrontend.utils.swiper;
                    this.swiper = await new t(slider, config);
                }
                
            
        }
              
        elementorFrontend.elementsHandler.attachHandler("jws-category-list", JwsCategoryList);
                 
         /* ---------------- Jws_Image_Carousel Slider ---------------- */
        class Jws_Image_Carousel extends elementorModules.frontend.handlers.SwiperBase {
                onInit(...e) {
                    super.onInit(...e), this.handleDestroy() , this.jws_init()
                  
                }
                getDefaultSettings() {
                    return {
                        selectors: {
                            slider: ".jws-image_carousel",
                            slide: ".swiper-slide",
                        }
                    }
                }
                getDefaultElements() {
                    const e = this.getSettings("selectors"),
                    t = {
                        $swiperContainer: this.$element.find(e.slider)
                    };
              
                    return t.$slides = t.$swiperContainer.find(e.slide), t
                    
                }
            
                onDestroy() {
                    
                    this.handleDestroy(), super.onDestroy()
                    
                }
                
                handleDestroy() {
                    
                    
                }
                
                jws_init() {
                           
                    const element_setting = this.getElementSettings();
               
                    this.initSlider();
                    
                }
                
               async initSlider() {
                    
                    const config =  jwsThemeModule.global_slider(this);
                    const slider = this.elements.$swiperContainer;
                    if (!slider.length) return;
                    if (1 >= this.getSlidesCount()) return;
                    const t = elementorFrontend.utils.swiper;
                    this.swiper = await new t(slider, config);
                }
                
            
        }
              
        elementorFrontend.elementsHandler.attachHandler("jws_image_carousel", Jws_Image_Carousel);
                     
        
        /* ---------------- Testimonial Slider ---------------- */

        class Testimonial_Slider extends elementorModules.frontend.handlers.SwiperBase {
                onInit(...e) {
                    super.onInit(...e), this.handleDestroy() , this.jws_init()
                  
                }
                getDefaultSettings() {
                    return {
                        selectors: {
                            slider: ".jws_testimonials_slider",
                            slide: ".swiper-slide",
                        }
                    }
                }
                getDefaultElements() {
                    const e = this.getSettings("selectors"),
                    t = {
                        $swiperContainer: this.$element.find(e.slider)
                    };
              
                    return t.$slides = t.$swiperContainer.find(e.slide), t
                    
                }
            
                onDestroy() {
                    
                    this.handleDestroy(), super.onDestroy()
                    
                }
                
                handleDestroy() {
                    
                    
                }
                
                jws_init() {
                           
                    const element_setting = this.getElementSettings();
               
                    this.initSlider();
                    
                }
                
               async initSlider() {
                    
                    const config =  jwsThemeModule.global_slider(this);
                    const slider = this.elements.$swiperContainer;
                    if (!slider.length) return;
                    if (1 >= this.getSlidesCount()) return;
                    const t = elementorFrontend.utils.swiper;
                    this.swiper = await new t(slider, config);
                    if($('.testimonial_vid').length){
                   	$('.testimonial_vid').magnificPopup({
                        type: 'iframe'
                      });
                    }
                }
                
            
        }
              
        elementorFrontend.elementsHandler.attachHandler("jws_testimonial_slider", Testimonial_Slider);
        
        
        /* ---------------- Product tabs Slider ---------------- */

        class JwsProductAdvanced extends elementorModules.frontend.handlers.SwiperBase {
                onInit(...e) {
                    super.onInit(...e), this.handleDestroy() , this.jws_init()
                  
                }
                getDefaultSettings() {
                    return {
                        selectors: {
                            slider: ".jws_product_tab_slider",
                            slide: ".swiper-slide",
                            wrap:".products-wrap",
                        }
                    }
                }
                getDefaultElements() {
                    const e = this.getSettings("selectors"),
                    t = {
                        $swiperContainer: this.$element.find(e.slider),
                         wrap: this.findElement(e.wrap),
                    };
              
                    return t.$slides = t.$swiperContainer.find(e.slide), t
                    
                }
            
                onDestroy() {
                    
                    this.handleDestroy(), super.onDestroy()
                    
                }
                
                handleDestroy() {
                    
                    
                }
                
                jws_init() {
                           
                    const element_setting = this.getElementSettings();
               
                    this.initSlider();
                     this.initMetro();
                      this.initLoadMore();
                    
                }
                
               async initSlider() {
                    
                    const config =  jwsThemeModule.global_slider(this);
                    const slider = this.elements.$swiperContainer;
                    if (!slider.length) return;
                    if (1 >= this.getSlidesCount()) return;
                    const t = elementorFrontend.utils.swiper;
                    this.swiper = await new t(slider, config);
                }
                
              async initMetro() {
                const {
                      wrap
                    } = this.getDefaultElements();
                    if (wrap.hasClass('metro')) {
                    wrap.find('.products-tab').isotope({
                        itemSelector: ".product-item",
                        layoutMode: 'masonry',
                        transitionDuration: "0.3s",
                        masonry: {
                            // use outer width of grid-sizer for columnWidth
                            columnWidth: '.grid-sizer',
                        }
                    });
                }
              }  
            async initLoadMore(){
                 const {
                      wrap
                    } = this.getDefaultElements();
                wrap.find('.jws-ajax-load a.ajax-load').on('click', function(e) {
                    e.preventDefault();
                    var $this = $(this),
                        intervalID;
                    var key = $this.data('value');
                    if ($this.hasClass('active')) {
                        return;
                    }
                    clearInterval(intervalID);
                    wrap.addClass('jws-animated-products');
                    $this.parents('.jws-ajax-load').find('a').removeClass('active');
                    $this.addClass('active');
                    if ($this.hasClass('opened')) {
                        wrap.find('.products-tab').html(wrap.find('.products-tab').data(key));
                        var iter = 0;
                        intervalID = setInterval(function() {
                            wrap.find('.product-item').eq(iter).addClass('jws-animated');
                            iter++;
                        }, 100);
                        return;
                    }
                    $this.addClass('opened');
                    wrap.addClass('loading');
                    if (!wrap.find('.loader').length) {
                        wrap.append('<div class="loader"><svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>');
                    }
                    var data = wrap.data('args');
                    data.action = 'jws_ajax_product_filter';
                    if ($this.data('type') == 'product_cat') {
                        data.filter_categories = $this.data('value');
                    }
                    if ($this.data('type') == 'asset_type') {
                        data.asset_type = $this.data('value');
                    }
                    $.ajax({
                        url: wrap.data('url'),
                        data: data,
                        type: 'POST',
                        dataType: 'json',
                    }).success(function(response) {
                        wrap.removeClass('loading');
                        let content = response.items;
                        wrap.find('.products-tab').html(content);
                        wrap.find('.products-tab').data(key, content);
    
                        var iter = 0;
                        intervalID = setInterval(function() {
                            wrap.find('.product-item').eq(iter).addClass('jws-animated');
                            iter++;
                        }, 100);
                    }).error(function(ex) {
                        console.log(ex);
                    });
                });
                wrap.find('.jws-products-load-more').off('click').on('click', function(e) {
                    e.preventDefault();
                    var $this = $(this),
                        data = wrap.data('args'),
                        paged = wrap.data('paged');
                    paged++;
                    loadProducts2(data, paged, wrap, $this)
                });
    
                var loadProducts2 = function(data, paged, wrap, btn) {
                    var intervalID,
                        total = wrap.find('.product-item').length,
                        iter = total;
                    clearInterval(intervalID);
                    data.action = 'jws_ajax_product_filter';
                    data.paged = paged;
                    btn.addClass('loading');
                    wrap.find('.product-item').addClass('jws-animated');
                    wrap.addClass('jws-animated-products');
    
                    btn.append('<div class="loader"><svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>');
                    $.ajax({
                        url: wrap.data('url'),
                        data: data,
                        method: 'POST',
                        dataType: 'json',
                        success: function(response) {
    
                            if (response.items) {
                                wrap.find('.products-tab').append(response.items);
                                intervalID = setInterval(function() {
                                    wrap.find('.product-item').eq(iter).addClass('jws-animated');
                                    iter++;
                                }, 100);
                                wrap.data('paged', paged);
                            }
    
                            if (response.status == 'no-more-posts') {
                                btn.hide();
                            }
    
    
                        },
                        error: function(data) {
                            console.log('ajax error');
                            console.log(data);
                        },
                        complete: function() {
                            btn.removeClass('loading');
                            $('.loader').remove();
    
                        },
                    });
                };  
            }
        }
              
        elementorFrontend.elementsHandler.attachHandler("jws-product-advanced", JwsProductAdvanced);
               
         /* ---------------- Nested Slider ---------------- */
         
            class Nested_Slider extends elementorModules.frontend.handlers.SwiperBase {
                getDefaultSettings() {
                    return {
                        selectors: {
                            slider: ".elementor-slides-wrapper",
                            slide: ".swiper-slide",
                            slideInnerContents: ".swiper-slide-contents",
                            activeSlide: ".swiper-slide-active",
                            activeDuplicate: ".swiper-slide-duplicate-active",
                            slideDuplicate: ".swiper-slide-duplicate",
                            customAnimationElement: "[data-custom-animations]",
                        },
                        classes: {
                            animated: "animated",
                            kenBurnsActive: "elementor-ken-burns--active",
                            slideBackground: "swiper-slide-bg"
                        },
                        attributes: {
                            dataSliderOptions: "slider_options",
                            dataAnimation: "animation"
                        }
                    }
                }
                getDefaultElements() {
                    const e = this.getSettings("selectors"),
                        t = {
                            $swiperContainer: this.$element.find(e.slider)
                        };
                    return t.$slides = t.$swiperContainer.find(e.slide), t
                }
                getSwiperOptions() {
                    const e = this.getElementSettings(),
                        t = +e.slides_to_show || 1,
                        s = 1 === t,
                        i = elementorFrontend.config.responsive.activeBreakpoints,
                        n = {
                            mobile: 1,
                            tablet: s ? 1 : 2
                        },
                        a = {
                            autoplay: this.getAutoplayConfig(),
                            grabCursor: !0,
                            initialSlide: this.getInitialSlide(),
                            slidesPerView: t,
                            slidesPerGroup: 1,
                            loop: "yes" === e.infinite,
                            centeredSlides: "yes" === e.center_mode,
                            speed: e.transition_speed,
                            effect: e.transition,
                            observeParents: !0,
                            observer: !0,
                            handleElementorBreakpoints: !0,
                            on: {
                                slideChange: () => {
                                    this.handleKenBurns()
                                }
                            },
                            breakpoints: {}
                        };
                    let o = t;
                    Object.keys(i).reverse().forEach((t => {
                        const s = n[t] ? n[t] : o;
                        a.breakpoints[i[t].value] = {
                            slidesPerView: +e["slides_to_show_" + t] || s,
                            slidesPerGroup: +e["slides_to_scroll_" + t] || 1
                        }, e.slide_spacing && (a.breakpoints[i[t].value].spaceBetween = this.getSpaceBetween(t)), o = +e["slides_to_show_" + t] || s
                    })), e.slide_spacing && (a.spaceBetween = this.getSpaceBetween());
                    const r = "arrows" === e.navigation || "both" === e.navigation,
                        l = "dots" === e.navigation || "both" === e.navigation;
                    return r && (a.navigation = {
                        prevEl: ".elementor-swiper-button-prev",
                        nextEl: ".elementor-swiper-button-next"
                    }), e.disable_drag && (a.allowTouchMove = !1), l && e.pagination && (a.pagination = {
                        el: ".swiper-pagination",
                        type: e.pagination,
                        clickable: !0
                    }, "dynamic" == e.pagination && (a.pagination.dynamicBullets = !0, delete a.pagination.type)), !0 === a.loop && (a.loopedSlides = this.getSlidesCount()), s ? "fade" === a.effect && (a.fadeEffect = {
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
                        stretch: 0,
                        depth: 100,
                        modifier: 3,
                        slideShadows: !0
                    }), a
                }
                getAutoplayConfig() {
                    const e = this.getElementSettings();
                    return "yes" === e.autoplay && {
                        stopOnLastSlide: !0,
                        delay: e.autoplay_speed,
                        disableOnInteraction: "yes" === e.pause_on_interaction
                    }
                }
                initSingleSlideAnimations() {
                    const e = this.getSettings(),
                        t = this.elements.$swiperContainer.data(e.attributes.dataAnimation);
                    this.elements.$swiperContainer.find("." + e.classes.slideBackground).addClass(e.classes.kenBurnsActive), t && this.elements.$swiperContainer.find(e.selectors.slideInnerContents).addClass(e.classes.animated + " " + t)
                }
                async initSlider() {
                    
                    const e = this.elements.$swiperContainer;
                   
                    if (!e.length) return;
                    if (1 >= this.getSlidesCount()) return;
                    const t = elementorFrontend.utils.swiper;
                    var s = this.getSwiperOptions();
                    
                    this.swiper = await new t(e, s), e.data("swiper", this.swiper), this.handleKenBurns();
                    const i = this.getElementSettings();
                    "creative2" == i.transition && this.elements.$swiperContainer.css("overflow", "visible"), i.pause_on_hover && this.togglePauseOnHover(!0);
                    const n = this.getSettings(),
                        a = e.data(n.attributes.dataAnimation);
                    this.swiper.on("slideChangeTransitionStart", (function() {
                        e.find(n.selectors.slideInnerContents).removeClass(n.classes.animated + " " + a).hide()
          
                        var pluginInstance = e.find(n.selectors.activeSlide).find('[data-custom-animations]').data('plugin_jwsCustomAnimations');
                        if (pluginInstance) {
                          pluginInstance.destroy();
                        }
                         
                    })), this.swiper.on("slideChangeTransitionEnd", (function() {
                        
                        e.find(n.selectors.slideInnerContents).show().addClass(n.classes.animated + " " + a)
                  
                        e.find(n.selectors.activeSlide).find('[data-custom-animations]').jwsCustomAnimations();
                
                    }))
                }
                onInit() {
                    
                    elementorFrontend.isEditMode() && this.findElement(".e-con").each((function() {
                        jQuery(this).wrap('<div class="swiper-slide"></div>')
                    })), elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments), 2 > this.getSlidesCount() ? this.initSingleSlideAnimations() : this.initSlider()
                 this.elements.$swiperContainer.find('select').select2('destroy');
                   
                }
                getChangeableProperties() {
                    return {
                        pause_on_hover: "pauseOnHover",
                        pause_on_interaction: "disableOnInteraction",
                        autoplay_speed: "delay",
                        transition_speed: "speed"
                    }
                }
                updateSwiperOption(e) {
                    if (0 === e.indexOf("width")) return void this.swiper.update();
                    const t = this.getElementSettings(),
                        s = t[e];
                    let i = this.getChangeableProperties()[e],
                        n = s;
                    switch (e) {
                        case "autoplay_speed":
                            i = "autoplay", n = {
                                stopOnLastSlide: !0,
                                delay: s,
                                disableOnInteraction: "yes" === t.pause_on_interaction
                            };
                            break;
                        case "pause_on_hover":
                            this.togglePauseOnHover("yes" === s);
                            break;
                        case "pause_on_interaction":
                            n = "yes" === s
                    }
                    "pause_on_hover" !== e && (this.swiper.params[i] = n), this.swiper.update()
                }
                onElementChange(e) {
                 
                    if (0 === e.indexOf("slide_spacing")) return void this.updateSpaceBetween(e);
                    if (1 >= this.getSlidesCount()) return;
                    const t = this.getChangeableProperties();
                    Object.prototype.hasOwnProperty.call(t, e) && (this.updateSwiperOption(e), this.swiper.autoplay.start())
                }
                getSpaceBetween() {
                    let e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : null;
                    return elementorFrontend.utils.controls.getResponsiveControlValue(this.getElementSettings(), "slide_spacing", "size", e) || 0
                }
                updateSpaceBetween(e) {
                    const t = e.match("slide_spacing_(.*)"),
                        s = t ? t[1] : "desktop",
                        i = this.getSpaceBetween(s);
                    "desktop" !== s && (this.swiper.params.breakpoints[elementorFrontend.config.responsive.activeBreakpoints[s].value].spaceBetween = i), this.swiper.params.spaceBetween = i, this.swiper.update()
                }
                onEditSettingsChange(e) {
                    console.log(this.getEditSettings("activeItemIndex"));
                    1 >= this.getSlidesCount() || "activeItemIndex" === e && (this.swiper.slideToLoop(this.getEditSettings("activeItemIndex") - 1), this.swiper.autoplay.stop())
                }

            }
            elementorFrontend.elementsHandler.attachHandler("jws-nested-slider",Nested_Slider)
        
        
        /* Button */
        
        class Button extends elementorModules.frontend.handlers.Base {
                onInit(...e) {
                    super.onInit(...e), this.handleDestroy(), this.initLocalScroll(), this.initSplitText()
                }
                getDefaultSettings() {
                    return {
                        selectors: {
                            localScrollElement: "[data-localscroll]",
                            splitTextElement: "[data-split-text]"
                        }
                    }
                }
                getDefaultElements() {
                    const e = this.getSettings("selectors");
                    return {
                        $localScrollElement: this.$element.find(e.localScrollElement),
                        $splitTextElement: this.$element.find(e.splitTextElement)
                    }
                }
                initLocalScroll() {
                   // this.elements.$localScrollElement.jwsLocalScroll()
                }
                initSplitText() {
                    this.elements.$splitTextElement.jwsSplitText()
                }
                onDestroy() {
                    this.handleDestroy(), super.onDestroy()
                }
                handleDestroy() {
                    this.handleSplitTextDestroy()
                }
                handleSplitTextDestroy() {
                    if (!this.elements.$splitTextElement.length) return;
                    const e = this.elements.$splitTextElement.data("plugin_jwsSplitText");
                    e && e.destroy()
                }
        }
              
        elementorFrontend.elementsHandler.attachHandler("jws_button_advanced", Button);    
        
        
        /* Tabs */


            class Tabs extends elementorModules.frontend.handlers.Base {
                
            onInit(...e) {
                super.onInit(...e); const settings = this.getSettings();
                if (elementorFrontend.isEditMode()) {
                  this.interlaceContainers();
                }
                this.run_tab();
              
            }
            getDefaultSettings() {
                return {
                    selectors: {
                        tabContentContainers: '.tab-content  > .e-con',
                        contentItems: '.tab-item',
                        nav: '.tab-nav',
                        button: '.tab-nav li a',
                        content: '.tab-content'
                    }
                }
            }
            getDefaultElements() {
                const selectors = this.getSettings("selectors");
                return {
                    $contentContainers: this.findElement(selectors.tabContentContainers),
                    $tabItems: this.findElement(selectors.contentItems),
                    button: this.findElement(selectors.button),
                    content: this.findElement(selectors.content),
                    nav: this.findElement(selectors.nav),
                }
            }
            
            onEditSettingsChange(propertyName, value) {
                 console.log(propertyName);
               console.log(this.getEditSettings("activeItemIndex"));
            }
            
            interlaceContainers() {
                const {
                  $contentContainers,
                  $tabItems
                } = this.getDefaultElements();
                $contentContainers.each((index, element) => {
                  $tabItems[index].appendChild(element);
                });
            }
               
            run_tab() {
                
                    const {
                      button,
                      content,
                      nav
                    } = this.getDefaultElements();
            
            		button.click(function(e) {
            		  
            			e.preventDefault();
                         
            			var tab_id = $(this).attr('data-tab'),
                        $tabItem = $(this).closest('.jws_nav_item');
                        nav.find('li').removeClass('current');
                        nav.find('li').find(".jws_content").slideUp('fast');
                        
                        $tabItem.find(".jws_content").slideToggle('fast');
            			$(this).parent().addClass('current');
                        
                        
                        content.find('>.tab-item').removeClass('current');
            			content.find("#" + tab_id).addClass('current');
                        
                        var pluginInstance = content.find("#" + tab_id).find('[data-custom-animations]').data('plugin_jwsCustomAnimations');
                        if (pluginInstance) {
                          pluginInstance.destroy();
                        }
                        content.find("#" + tab_id).find('[data-custom-animations]').jwsCustomAnimations();
            
            		});
            	   
                
                
            }
            
            
            onDestroy() {
                this.handleDestroy(), super.onDestroy()
            }
            handleDestroy() {
              
            }
            
            }
            
            elementorFrontend.elementsHandler.attachHandler("jws_tab", Tabs);  

        
        /* Svg Draw Advanced */

        class Svg_Draw extends elementorModules.frontend.handlers.Base {
            
            onInit(...e) {
               super.onInit(...e), this.initDrawShape()
            }
            getDefaultSettings() {
                return {
                    selectors: {
                        drawShapeElement: "[data-jws-draw-shape]"
                    }
                }
            }
            getDefaultElements() {
                const e = this.getSettings("selectors");
                return {
                    $drawShapeElement: this.$element.find(e.drawShapeElement)
                }
            }
            initDrawShape() {
                this.elements.$drawShapeElement.jwsDrawShape()
            }
        
        }
        
        elementorFrontend.elementsHandler.attachHandler("jws_svg_draw", Svg_Draw); 
        
        
/* ---------------- Jws_Gallery_List Slider ---------------- */

        class Jws_Gallery_List extends elementorModules.frontend.handlers.SwiperBase {
                onInit(...e) {
                    super.onInit(...e), this.handleDestroy() , this.jws_init()
                  
                }
                getDefaultSettings() {
                    return {
                        selectors: {
                            slider: ".jws-gallery-list-slider",
                            slide: ".swiper-slide",
                        }
                    }
                }
                getDefaultElements() {
                    const e = this.getSettings("selectors"),
                    t = {
                        $swiperContainer: this.$element.find(e.slider)
                    };
              
                    return t.$slides = t.$swiperContainer.find(e.slide), t
                    
                }
            
                onDestroy() {
                    
                    this.handleDestroy(), super.onDestroy()
                    
                }
                
                handleDestroy() {
                    
                    
                }
                
                jws_init() {
                           
                    const element_setting = this.getElementSettings();
               
                    this.initSlider();
                    
                }
                
               async initSlider() {
                    
                    const config =  jwsThemeModule.global_slider(this);
                    const slider = this.elements.$swiperContainer;
                    if (!slider.length) return;
                    if (1 >= this.getSlidesCount()) return;
                    const t = elementorFrontend.utils.swiper;
                    this.swiper = await new t(slider, config);
                    
                    
                    
                }
                
            
        }
              
        elementorFrontend.elementsHandler.attachHandler("jws_gallery_list", Jws_Gallery_List);
 /* ---------------- employers Filter ---------------- */

        class Employers extends elementorModules.frontend.handlers.SwiperBase {
                onInit(...e) {
                    super.onInit(...e), this.handleDestroy() , this.jws_init()
                  
                }
                getDefaultSettings() {
                    return {
                        selectors: {
                            slider: ".jws_employers_slider",
                            slide: ".swiper-slide",
                        }
                    }
                }
                getDefaultElements() {
                    const e = this.getSettings("selectors"),
                    t = {
                        $swiperContainer: this.$element.find(e.slider)
                    };
              
                    return t.$slides = t.$swiperContainer.find(e.slide), t
                    
                }
            
                onDestroy() {
                    
                    this.handleDestroy(), super.onDestroy()
                    
                }
                
                handleDestroy() {
                    
                    
                }
                
                jws_init() {
                           
                    const element_setting = this.getElementSettings();
                    this.initLoadMore('employers');
                    this.initSlider();
                    
                }
                initLoadMore(postType) {  
                    loadmore_btn(this.$element, postType);
                }
               async initSlider() {
                    
                    const config =  jwsThemeModule.global_slider(this);
                    const slider = this.elements.$swiperContainer;
                    if (!slider.length) return;
                    if (1 >= this.getSlidesCount()) return;
                    const t = elementorFrontend.utils.swiper;
                    this.swiper = await new t(slider, config);
                    // Calculate and set the maximum height
                    var maxHeight = 0;
                    slider.find('.jws_employer_item').each(function(){
                        var slideHeight = $(this).height();
                        maxHeight = Math.max(maxHeight, slideHeight);
                    });
                    // Set the maximum height to all items
                    slider.find('.jws_employer_item').height(maxHeight);
                }
                
            
        }
              
        elementorFrontend.elementsHandler.attachHandler("jws_employers", Employers);        
 /* ---------------- Freelancers Filter ---------------- */

        class Freelancers extends elementorModules.frontend.handlers.SwiperBase {
                onInit(...e) {
                    super.onInit(...e), this.handleDestroy() , this.jws_init()
                  
                }
                getDefaultSettings() {
                    return {
                        selectors: {
                            slider: ".jws_freelancers_slider",
                            slide: ".swiper-slide",
                        }
                    }
                }
                getDefaultElements() {
                    const e = this.getSettings("selectors"),
                    t = {
                        $swiperContainer: this.$element.find(e.slider)
                    };
              
                    return t.$slides = t.$swiperContainer.find(e.slide), t
                    
                }
            
                onDestroy() {
                    
                    this.handleDestroy(), super.onDestroy()
                    
                }
                
                handleDestroy() {
                    
                    
                }
                
                jws_init() {
                           
                    const element_setting = this.getElementSettings();
                    this.initLoadMore('freelancers');
                    this.initSlider();
                    
                }
                initLoadMore(postType) {  
                    loadmore_btn(this.$element, postType);
                }
               async initSlider() {
                    
                    const config =  jwsThemeModule.global_slider(this);
                    const slider = this.elements.$swiperContainer;
                    if (!slider.length) return;
                    if (1 >= this.getSlidesCount()) return;
                    const t = elementorFrontend.utils.swiper;
                    this.swiper = await new t(slider, config);
                    // Calculate and set the maximum height
                    var maxHeight = 0;
                    slider.find('.jws-freelancers-item').each(function(){
                        var slideHeight = $(this).height();
                        maxHeight = Math.max(maxHeight, slideHeight);
                    });
                    // Set the maximum height to all items
                    slider.find('.jws-freelancers-item').height(maxHeight);
                }
                
            
        }
              
        elementorFrontend.elementsHandler.attachHandler("jws_freelancers", Freelancers);
        
       /* ---------------- Jws_Blog Filter ---------------- */
        class Jws_Blog extends elementorModules.frontend.handlers.SwiperBase {
            onInit(...e) {
                super.onInit(...e);
                this.handleDestroy();
                this.jws_init();
            }
        
            getDefaultSettings() {
                return {
                    selectors: {
                        slider: ".jws_blog_slider",
                        slide: ".swiper-slide",
                        jobContent: '.blog_content',
                        jobNav: '.post_nav',
                        jobItem: '.jws_blog_item',
                        $galleryslider:'.post-image-slider',
                    }
                };
            }
        
            getDefaultElements() {
                const e = this.getSettings("selectors");
                const t = {
                    $swiperContainer: this.$element.find(e.slider),
                    $container: this.findElement(e.jobContent),
                    $filter: this.findElement(e.jobNav),
                    $item:  this.findElement(e.jobItem),
                     $galleryslider:  this.findElement(e.galleryslider),
                };
        
                return t.$slides = t.$swiperContainer.find(e.slide), t;
            }
        
            onDestroy() {
                this.handleDestroy();
                super.onDestroy();
            }
        
            handleDestroy() {
                // Cleanup logic if needed
            }
        
            jws_init() {
                const elementSetting = this.getElementSettings();
                this.initSlider();
                this.initIsotope();
               this.initLoadMore('post');
                
            }
           initLoadMore(postType) {  
                // Call the loadmore_btn function with the current $scope and the custom post type
                loadmore_btn(this.$element, postType);
        
                // Additional logic for your specific post type if needed
                // ...
            }
            async initSlider() {
                    const config =  jwsThemeModule.global_slider(this);
                    const slider = this.elements.$swiperContainer,
                    galleryslider = this.elements.$galleryslider;
                    if (!slider.length) return;
                    if (1 >= this.getSlidesCount()) return;
                    const t = elementorFrontend.utils.swiper;
                    this.swiper = await new t(slider, config);
                    
                    galleryslider.each(function (index, element) {
                        var $slider = $(element);
                        
                
                        const swiperConfig = {
                            slidesPerView: 1,
                            spaceBetween: 0,
                            nested: true,
                            pagination: {
                                el: '.swiper-pagination',
                                clickable: true,
                            },
                        };
                
                        var gallerySwiper = new t($slider, swiperConfig);
                    });
                // Calculate and set the maximum height
                var maxHeight = 0;
                slider.find('.jws_blog_item').each(function(){
                    var slideHeight = $(this).height();
                    maxHeight = Math.max(maxHeight, slideHeight);
                });
            
                // Set the maximum height to all items
                slider.find('.jws_blog_item').height(maxHeight);
            }
        
            async initIsotope() {
                // Access the properties directly from this.$container and this.$filter
                
                const {
                      $container,
                      $filter,
                      $item
                    } = this.getDefaultElements();
                    
                    if ($container.hasClass('has-masonry')) {
                        $container.isotope({
                            itemSelector: ".jws_blog_item ",
                            layoutMode: 'masonry',
                            transitionDuration: "0.7s",
                        });
                    } 
                
                if ($filter.length) {
                    $filter.find("a").on("click touchstart", (e) => {
                        const $t = jQuery(e.currentTarget);
                        const selector = $t.data("filter");
            
                        if ($t.hasClass("filter-active"))
                            return false;
            
                        $filter.find("a").removeClass("filter-active");
                        $t.addClass("filter-active");
                        $container.isotope({ filter: selector });
            
                        e.stopPropagation();
                        e.preventDefault();
                    });
            
                    $container.on('layoutComplete', (event, laidOutItems) => {
                        const $items = $container.find('.jws_blog_item');
                        let time = 0;
            
                        $items.each(function() {
                            const item = jQuery(this);
                            setTimeout(() => {
                                item.addClass('fadeIn');
                            }, time);
                            time += 200;
                        });
                    });
                }
            }
            
        }
        
        elementorFrontend.elementsHandler.attachHandler("jws_blog", Jws_Blog);            
        
        /* ---------------- Jobs Filter ---------------- */
        class Jobs extends elementorModules.frontend.handlers.SwiperBase {
            onInit(...e) {
                super.onInit(...e);
                this.handleDestroy();
                this.jws_init();
            }
        
            getDefaultSettings() {
                return {
                    selectors: {
                        slider: ".jws_job_slider",
                        slide: ".swiper-slide",
                        jobContent: '.job_content',
                        jobNav: '.job_nav',
                        jobItem: '.jws_job_item',
                    }
                };
            }
        
            getDefaultElements() {
                const e = this.getSettings("selectors");
                const t = {
                    $swiperContainer: this.$element.find(e.slider),
                    $container: this.findElement(e.jobContent),
                    $filter: this.findElement(e.jobNav),
                    $item:  this.findElement(e.jobItem),
                };
        
                return t.$slides = t.$swiperContainer.find(e.slide), t;
            }
        
            onDestroy() {
                this.handleDestroy();
                super.onDestroy();
            }
        
            handleDestroy() {
                // Cleanup logic if needed
            }
        
            jws_init() {
                const elementSetting = this.getElementSettings();
                this.initSlider();
                this.initIsotope();
                this.initLoadMore('jobs');
            }
            initLoadMore(postType) {  
                loadmore_btn(this.$element, postType);
            }
            async initSlider() {
                    const config =  jwsThemeModule.global_slider(this);
                    const slider = this.elements.$swiperContainer;
                    if (!slider.length) return;
                    if (1 >= this.getSlidesCount()) return;
                    const t = elementorFrontend.utils.swiper;
                    this.swiper = await new t(slider, config);
                
                // Calculate and set the maximum height
                var maxHeight = 0;
                slider.find('.jws_job_item').each(function(){
                    var slideHeight = $(this).height();
                    maxHeight = Math.max(maxHeight, slideHeight);
                });
            
                // Set the maximum height to all items
                slider.find('.jws_job_item').height(maxHeight);
            }
        
            async initIsotope() {
                // Access the properties directly from this.$container and this.$filter
                
                const {
                      $container,
                      $filter,
                      $item
                    } = this.getDefaultElements();
                    
              
                    
                    if ($container.hasClass('masonry')) {
                        $container.isotope({
                            itemSelector: ".jws_blog_item ",
                            layoutMode: 'masonry',
                            transitionDuration: "0.7s",
                        });
                    } 
                
                if ($filter.length) {
                    $filter.find("a").on("click touchstart", (e) => {
                        const $t = jQuery(e.currentTarget);
                        const selector = $t.data("filter");
            
                        if ($t.hasClass("filter-active"))
                            return false;
            
                        $filter.find("a").removeClass("filter-active");
                        $t.addClass("filter-active");
                        $container.isotope({ filter: selector });
            
                        e.stopPropagation();
                        e.preventDefault();
                    });
            
                    $container.on('layoutComplete', (event, laidOutItems) => {
                        const $items = $container.find('.jws_job_item');
                        let time = 0;
            
                        $items.each(function() {
                            const item = jQuery(this);
                            setTimeout(() => {
                                item.addClass('fadeIn');
                            }, time);
                            time += 200;
                        });
                    });
                }
            }
        }
        
        elementorFrontend.elementsHandler.attachHandler("jws_jobs", Jobs);
        
        
        /* ---------------- Services Filter ---------------- */
        class Services extends elementorModules.frontend.handlers.SwiperBase {
            onInit(...e) {
                super.onInit(...e);
                this.handleDestroy();
                this.jws_init();
            }
        
            getDefaultSettings() {
                return {
                    selectors: {
                        slider: ".jws_services_slider",
                        slide: ".swiper-slide",
                        jobContent: '.service-content',
                        jobNav: '.post_nav',
                        jobItem: '.jws-services-item',
                        galleryslider: ".post-image-slider",
                    }
                };
            }
        
            getDefaultElements() {
                const e = this.getSettings("selectors");
                const t = {
                    $swiperContainer: this.$element.find(e.slider),
                    $container: this.$element.find(e.jobContent),
                    $filter: this.$element.find(e.jobNav),
                    $item: this.$element.find(e.jobItem),
                    $galleryslider: this.$element.find(e.galleryslider),
                };
        
                return t.$slides = t.$swiperContainer.find(e.slide), t;
                
            }
        
            onDestroy() {
                this.handleDestroy();
                super.onDestroy();
            }
        
            handleDestroy() {
                // Cleanup logic if needed
            }
        
            jws_init() {
                const elementSetting = this.getElementSettings();
                this.initSlider();
                this.initIsotope();
                this.initLoadMore('services');
            }
         initLoadMore(postType) {  
                loadmore_btn(this.$element, postType);
            }
            async initSlider() {
                    const config =  jwsThemeModule.global_slider(this);
                    const slider = this.elements.$swiperContainer,
                            galleryslider = this.elements.$galleryslider;
                    if (!slider.length) return;
                    if (1 >= this.getSlidesCount()) return;
                    const t = elementorFrontend.utils.swiper;
                    this.swiper = await new t(slider, config);
                    
                    
                    galleryslider.each(function (index, element) {
                        var $slider = $(element);
                        
                
                        const swiperConfig = {
                            slidesPerView: 1,
                            spaceBetween: 0,
                            nested: true,
                            pagination: {
                                el: '.swiper-pagination',
                                clickable: true,
                            },
                        };
                
                        var gallerySwiper = new t($slider, swiperConfig);
                    });


                    
                // Calculate and set the maximum height
                var maxHeight = 0;
                slider.find('.jws-services-item').each(function(){
                    var slideHeight = $(this).height();
                    maxHeight = Math.max(maxHeight, slideHeight);
                });
            
                // Set the maximum height to all items
                slider.find('.jws-services-item').height(maxHeight);
   
            }
        
            async initIsotope() {
                // Access the properties directly from this.$container and this.$filter
                const  $container = this.elements.$container,
                    $filter = this.elements.$filter,
                    $item = this.elements.$item;
                    
                   if ($container.hasClass('jws-isotope')) {
                    $container.isotope({
                        itemSelector: ".jws-services-item",
                        layoutMode: 'masonry',
                        transitionDuration: "0.7s",
                    }); 
                    } 
                
                if ($filter.length) {
                    $filter.find("a").on("click touchstart", (e) => {
                        const $t = jQuery(e.currentTarget);
                        const selector = $t.data("filter");
            
                        if ($t.hasClass("filter-active"))
                            return false;
            
                        $filter.find("a").removeClass("filter-active");
                        $t.addClass("filter-active");
                        $container.isotope({ filter: selector });
            
                        e.stopPropagation();
                        e.preventDefault();
                    });
            
                    $container.on('layoutComplete', (event, laidOutItems) => {
                        const $items = $container.find('.jws-services-item');
                        let time = 0;
            
                        $items.each(function() {
                            const item = jQuery(this);
                            setTimeout(() => {
                                item.addClass('fadeIn');
                            }, time);
                            time += 200;
                        });
                    });
                }
            }
        }
        
        elementorFrontend.elementsHandler.attachHandler("jws_services", Services);        
        
/* ---------------- Jws_Banner Slider ---------------- */

        class Jws_Banner extends elementorModules.frontend.handlers.SwiperBase {
                onInit(...e) {
                    super.onInit(...e), this.handleDestroy() , this.jws_init()
                  
                }
                getDefaultSettings() {
                    return {
                        selectors: {
                            slider: ".jws_list_box_slider",
                            slide: ".swiper-slide",
                        }
                    }
                }
                getDefaultElements() {
                    const e = this.getSettings("selectors"),
                    t = {
                        $swiperContainer: this.$element.find(e.slider)
                    };
              
                    return t.$slides = t.$swiperContainer.find(e.slide), t
                    
                }
            
                onDestroy() {
                    
                    this.handleDestroy(), super.onDestroy()
                    
                }
                
                handleDestroy() {
                    
                    
                }
                
                jws_init() {
                           
                    const element_setting = this.getElementSettings();
               
                    this.initSlider();
                    
                }
                
               async initSlider() {
                    
                    const config =  jwsThemeModule.global_slider(this);
                    const slider = this.elements.$swiperContainer;
                    if (!slider.length) return;
                    if (1 >= this.getSlidesCount()) return;
                    const t = elementorFrontend.utils.swiper;
                    this.swiper = await new t(slider, config);
                    
                    
                     // Calculate and set the maximum height
                    var maxHeight = 0;
                    slider.find('.jws-banner-item').each(function(){
                        var slideHeight = $(this).height();
                        maxHeight = Math.max(maxHeight, slideHeight);
                    });
                
                    // Set the maximum height to all items
                    slider.find('.jws-banner-item').height(maxHeight);
                    
                }
                
            
        }
              
        elementorFrontend.elementsHandler.attachHandler("jws_banner", Jws_Banner);
                
    
    });
        
 var loadmore_btn = function ($scope, postType) {
    var $element = $scope.find('[data-ajaxify=true]');
    var options = $element.data('ajaxify-options');

    if ($element.length < 1) return false;

    var wap = options.wrapper;

    $(document.body).on('click', '.jws-load-more', function (e) {
        e.preventDefault();
        var $this = $(this);
        $(this).append('<div class="loader"><svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>');
        $(this).addClass('loading');
        var url = $this.attr('href');

        if ('?' == url.slice(-1)) {
            url = url.slice(0, -1);
        }

        url = url.replace(/%2C/g, ',');

        $.get(url, function (res) {
            var $newItemsWrapper = $(res).find(options.wrapper);
            var $newItems = $newItemsWrapper.find(options.items);
            $newItems.imagesLoaded(function () {

                $(wap).append($newItems);
                if (!$(wap).hasClass('jws_blog_slider')) {
                    $(wap).isotope('appended', $newItems);
                } // Calling function for the new items

                $this.find('.loader').remove();
                $('.loading').remove();
            });

            $this.parents('.jws_pagination').html($(res).find(wap).next('.jws_pagination').html());

        }, 'html');
    });
};
    
})(jQuery);    