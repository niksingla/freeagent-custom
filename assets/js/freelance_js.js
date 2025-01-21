var jwsThemeWooModule_Free;
(function($) {
    "use strict";
    jwsThemeWooModule_Free = (function() {
        return {
            init: function() {
                this.tab_content();
                this.thumbnailGallery();
                this.priceSlider();
                this.filterFreelance();
                this.jobs_map_list();
                this.search_place_address();
               
            },
            
             
            search_place_address(){ 
                
                if(!$('#search_place_address').length) {return false}
                
                var search_place_address = (document.getElementById("search_place_address"));
                var input_location = $('#search_place_address').next('input');
                search_place_address
                 var options = {
                  types: ['(regions)']
                 };
                var autocomplete = new google.maps.places.Autocomplete(search_place_address,options);
                google.maps.event.addListener(autocomplete, "place_changed", function() {
					
						var place = autocomplete.getPlace();
					
                         if (place.address_components) {
                        
                            for (var i = 0; i < place.address_components.length; i++) {
                                
                              var component = place.address_components[i];
    
                              if (component.types.includes('locality')) {
                                
                                input_location.val(component.long_name);
                             
                              }
                            }
                          }
					
					});
                    
           
            },
            
            tab_content(){
            $('.feature-more').click(function() {
                  // Toggle the visibility of the content
                  $(this).toggleClass('active');

                  $('.package-feature ul').slideToggle();
                });
            //Tab Freelancer
                $('#filter-list a').click(function (e) {
                    e.preventDefault();
        
                    // Remove "active" class from all filter links
                    $('#filter-list a').removeClass('filter-active');
                    $('.tab_content > div').removeClass('active');
                    // Add "active" class to the clicked filter link
                    $(this).addClass('filter-active');
        
                    // Get the data-filter value
                    var filterValue = $(this).data('filter');
        
                    // Show content based on the data-filter value
                    $('.content-section div').removeClass('active');

                    // Show the content section with the matching filterValue
                    $(filterValue).addClass('active');
                });  
            },
            
            
            thumbnailGallery(){
            	   if($('.jws-jobs-archive').hasClass('has-masonry')) {
					$('.jws-jobs-archive .jobs_content').isotope({
						itemSelector: ".jws_job_item",
						layoutMode: 'masonry',
						transitionDuration: "0.5s",
					});
                    }
              if($('.post_thumbnail_gallery.gallery_swiper').length){
                
         
                    var mainSwiper = new Swiper('.post_thumbnail_gallery .swiper-container', {
                        slidesPerView: 1,
                        navigation: {
                            nextEl: '.elementor-swiper-button-next',
                            prevEl: '.elementor-swiper-button-prev',
                        },
                    });
                
                    // Initialize Swiper with Thumbnails
                    var thumbsSwiper = new Swiper('.post_thumbnail_gallery .swiper-container-thumbs', {
                        spaceBetween: 16,
                        slidesPerView: 2,
                        freeMode: true,
                        watchSlidesVisibility: true,
                        watchSlidesProgress: true,
                        breakpoints: {
                            768: {
                                slidesPerView: 4,
                            },
                        },
                    });
                
                    // Connect the two Swipers
                                        
                    mainSwiper.controller.control = thumbsSwiper;
                    thumbsSwiper.controller.control = mainSwiper;
                    $('.swiper-container-thumbs .swiper-slide').on('click', function () {
                            // Get the index of the clicked thumbnail
                            var thumbIndex = $(this).index();
                        
                            // Slide the main swiper to the corresponding index
                            mainSwiper.slideTo(thumbIndex);
                        });
              }   
            },
            
            
            priceSlider: function() {

        		if ( $( ".services-range-slider" ).length )
        		{
        			var $servicesRange = $(".services-range-slider"),
        			$servicesInputFrom = $(".services-input-from"),
        			$servicesInputTo = $(".services-input-to"),
        			instance,
        			min = 0,
        			max = 900000000,
        			from = 0,
        			to = 0;
        			$servicesRange.ionRangeSlider({
        				skin: "round",
        				type: "double",
        				min: min,
        				max: max,
        				from: 0,
        				to: 900000000,
        				onStart: updateInputs,
        				onChange: updateInputs,
                        onFinish: function (data) {
                            // Trigger the AJAX event when the slide is finished changing
                            var form = $servicesRange.closest('form').get(0),
                                $form = $(form),
                                url = $form.attr('action') + '?' + $form.serialize();
                
                            $(document.body).trigger('freeagent_addvanced_filter_ajax', [url, $servicesRange]);
                        }
        			});
        			instance = $servicesRange.data("ionRangeSlider");
        			function updateInputs (data) {
        				from = data.from;
        				to = data.to;
        				
        				$servicesInputFrom.prop("value", from);
        				$servicesInputTo.prop("value", to);	
        			}
        			$servicesInputFrom.on("input", function () {
        				var val = $(this).prop("value");
        				
        				if (val < min) {
        					val = min;
        				} else if (val > to) {
        					val = to;
        				}
        				
        				instance.update({
        					from: val
        				});
        			});
        			$servicesInputTo.on("input", function () {
        				var val = $(this).prop("value");
        				
        				if (val < from) {
        					val = from;
        				} else if (val > max) {
        					val = max;
        				}
        				
        				instance.update({
        					to: val
        				});
        			});
        		}
            },
            
            
            filterFreelance(){
                //Remove search
                    
                    $(".location_filed").select2({
                        placeholder: jws_script.location_place
                    });
                $(document).on('click', '.modal-content .widget-title', function() {
                   $(this).toggleClass('close').next().slideToggle();
                   
                });
            
            //Remove active filter
                $(document.body).on('click', '.filter_active', function(e) {
                    e.preventDefault();
           
                    // Get the name and value of the clicked filter
                    var name = $(this).data('name');
                    var value = $(this).data('value');
                
                    // Remove the current-cat class from the corresponding taxonomy filter
                    $('.widget_custom_category_list_widget a[data-name="' + name + '"][data-value="' + value + '"]').removeClass('current-cat');
                
                    // Remove only the clicked filter from the URL
                    var url = window.location.href;
                    url = removeURLParameterValue(url, name, value);
                
                    // Update the URL without refreshing the page
                    window.history.pushState({ path: url }, '', url);
                
                    // Trigger your custom AJAX function or any other actions needed
                    $(document.body).trigger('freeagent_addvanced_filter_ajax', [url, $(this)]);
                });
                
                
                
                function removeURLParameterValue(url, parameter, value) {
                    var urlparts = url.split('?');
                    if (urlparts.length >= 2) {
                        var prefix = encodeURIComponent(parameter) + '=';
                        var pars = urlparts[1].split(/[&;]/g);
                
                        for (var i = pars.length; i-- > 0;) {
                            if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                                var values = pars[i].substring(prefix.length).split(',');
                
                                // Convert values to strings for comparison
                                var stringValues = values.map(String);
                                var stringValue = String(value);
                
                                // Remove only the clicked filter from the values array
                                var index = stringValues.indexOf(stringValue);
                
                                if (index !== -1) {
                                    values.splice(index, 1);
                                }
                
                                // If the values become empty, remove the entire parameter
                                if (values.length > 0) {
                                    pars[i] = prefix + values.join(',');
                                } else {
                                    pars.splice(i, 1);
                                }
                
                                break; // Stop after removing the first occurrence
                            }
                        }
                
                        url = urlparts[0] + '?' + pars.join('&');
                    }
                    return url;
                }
            var autoload = true;
                $(window).on('resize scroll', function() {
                    if ($('.auto_load_more').length && $('.auto_load_more').isInViewport() && autoload) {
                        autoload = false;
                        $('.auto_load_more').trigger("click");
                    }
                });
                
               
              $(document.body).on('click', '.jws-load-more', function(e) {
                        e.preventDefault();
                        var $this = $(this);
                        $(this).append('<div class="loader"><svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>');
                        $(this).addClass('loading');
                          $('.spinner').addClass('loading');
                        
                        var options = $this.data('ajaxify-options');
                        var wap = options.wrapper;
                        var url = $this.attr('href');
                        console.log(options);
                        if ('?' == url.slice(-1)) {
                            url = url.slice(0, -1);
                        }
            
                        url = url.replace(/%2C/g, ',');
            
            
                        $.get(url, function(res) {
                         
                            var $newItemsWrapper = $(res).find(options.wrapper);
                            var $newItems = $newItemsWrapper.find(options.items);

                            $newItems.imagesLoaded(function() {
                                        $(wap).append($newItems);
                                if (!$(wap).hasClass('jws_blog_slider')) {
                                    $(wap).isotope('appended', $newItems);
                                } // Calling function for the new items
                                 autoload = true;
                                $this.find('.loader').remove();
                                $('.loading').remove();
                                
                            });
            
                            $this.parents('.jws_pagination').html($(res).find(wap).next('.jws_pagination').html());
            
                        }, 'html');
                
                });

                $(document).on('click', '.widget_custom_category_list_widget a', function(e) {
                    console.log('click');
                    e.preventDefault();
                    
                    if ($(this).hasClass('current-cat')) {
                        $(this).removeClass('current-cat');
                        console.log('check1');
                    } else {
                        $(this).addClass('current-cat');
                         console.log('check2');
                    }
                        
                       var slug = $( this ).data('name');  
                        var checked = []
                        $("[data-name='"+slug+"'].current-cat").each(function ()
                        {
                            checked.push($(this).data('value'));
                        });
                        $(this).parents('.checkbox').find('.file_checkbox_value').val(checked); 
                        var $form = $(this).parents('.checkbox').find('form'),
            			url = $form.attr('action') + '?' + $form.serialize();
        
                   // var url = $(this).attr('href');
                    $(document.body).trigger('freeagent_addvanced_filter_ajax', [url, $(this)]);

                });
                
                
                $(document).on('change', '.widget_custom_category_list_widget .type.select select', function(e) {
                    e.preventDefault();
                
                        
                       var slug = $( this ).val();  
                      
                        $(this).parents('.select').find('.file_checkbox_value').val(slug); 
                        var $form = $(this).parents('.select').find('form'),
            			url = $form.attr('action') + '?' + $form.serialize();
        
                   // var url = $(this).attr('href');
                    $(document.body).trigger('freeagent_addvanced_filter_ajax', [url, $(this)]);

                });
                
                 $(document).on('click', '.widget_jws_job_type_widget a', function(e) {
                    e.preventDefault();
                
                            console.log('click');
                        if ($(this).hasClass('current')) {
                            $(this).removeClass('current');
                        } else {
                            $(this).addClass('current');
                        }
                        
                        var slug = 'job_type'; 
                        var checked = []
                        $("[data-name='"+slug+"'].current").each(function ()
                        {
                            checked.push($(this).data('value'));
                        });

                       $(this).parents('.widget_jws_job_type_widget').find('.file_checkbox_value').val(checked); 
                        var $form = $(this).parents('.widget_jws_job_type_widget').find('form'),
            			url = $form.attr('action') + '?' + $form.serialize();

                
                    $(document.body).trigger('freeagent_addvanced_filter_ajax', [url, $(this)]);
                });

                
                
                
                //CLEAR FILTER
                $(document.body).on('click', '.clear_filter', function(e){
                    e.preventDefault();
                    $('.active-categories').empty();
               
                      var url = $(this).attr('href');
                     
                     $(document.body).trigger('freeagent_addvanced_filter_ajax', [url, $(this)]);
                      
                });

                function updateActiveCategories() {
                    // Collect checked categories
                    var checked = [];
                    $('.widget_custom_category_list_widget a.current-cat').each(function() {
                        checked.push($(this).data('value'));
                    });
                
                    // Update the value of .file_checkbox_value
                    $('.widget_custom_category_list_widget .file_checkbox_value').val(checked.join(','));
                    
                }

            
                
                $(document.body).on('change', ' .form_posts_per_page select, .cpt-ordering .orderby', function(e) {
                   console.log( $(this).parents('form').serialize());
                   console.log($(this).parents('form').attr('action'));
                    var url = $(this).parents('form').attr('action') + '?' + $(this).parents('form').serialize();
                    $(document.body).trigger('freeagent_addvanced_filter_ajax', [url, $(this)]);
                   

                });

                
                $(document.body).on('freeagent_addvanced_filter_ajax', function(e, url, element) {
                     var options = $(document.body).find('.freelance_content').data('ajaxify-filter');
                    
                    var archive = options.archive,
                        wap = options.wrapper,
                        items = options.items;
                     $(wap).append('<div class="loader"><svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>').addClass('loading');

                    $('html,body').animate({
                        scrollTop: $(".content-area").offset().top - 120
                    }, 600);


                    $('.jws-filter-modal').removeClass('open').hide();

                    $('.is-sticky').addClass('no-active-sticky').removeClass('active-sticky');

                    $(wap).addClass('jws-animated-products');
                    
                    $('.site-main').addClass('loading');
                   

                    var intervalID;

                    if ('?' == url.slice(-1)) {
                        url = url.slice(0, -1);
                    }

                    url = url.replace(/%2C/g, ',');

                    window.history.pushState(null, "", url);
                    $(window).bind("popstate", function() {
                        window.location = location.href
                    });
                    
                   
                    clearInterval(intervalID);
                    
                    $.get(url, function(res) {
                        $('html,body').animate({
                            scrollTop:  $(wap).offset().top - 190
                        }, 600);
                        $('.site-main').removeClass('loading');
                        $(wap).replaceWith($(res).find(wap));
                        $('.title-wrapper').html($(res).find('.title-wrapper').html());
                        $('.jws-breadcrumbs').html($(res).find('.jws-breadcrumbs').html());
                        $('.siderbar-inner').html($(res).find('.siderbar-inner').html());
                        $('.result-count').html($(res).find('.result-count').html());
                        $('.acf-ordering').html($(res).find('.acf-ordering').html());
                        $('.active-categories').html($(res).find('.active-categories').html());
                        $('.pagination').html($(res).find('.pagination').html());
                        $('.jws-title-bar-wrap').html($(res).find('.jws-title-bar-wrap').html());
                         $('.form_posts_per_page').html($(res).find('.form_posts_per_page').html());
                        
                        
                        if($('#jobs-map-view').length) {
                            
                            $('#jobs-map-view').replaceWith($(res).find('#jobs-map-view'));
                            jwsThemeWooModule_Free.jobs_map_list();
                            
                        }
                        jwsThemeWooModule_Free.search_place_address();
                        jwsThemeWooModule_Free.priceSlider();
                        $('select').select2();
                        var iter = 0;
                        intervalID = setInterval(function() {
                            $(wap).find(items).eq(iter).addClass('jws-animated');
                            iter++;
                        }, 100);

                        $(document.body).trigger('freeagent_ajax_filter_request_success', [res, url]);

                    }, 'html');


                }); 
                window.onpageshow = function(event) {
                    if (event.persisted && $('body').hasClass(archive)) {
                        window.location.reload();
                    }
                }; 
                
            },
            
            
            
           jobs_map_list() { 
            
                var map_view = $("#jobs-map-view");
                if(map_view.length < 1) {
                    return;
                }
    			var locations = map_view.data('location');
                var icons = map_view.data('icon');
    			var geocoder;
    			var map;
    			var bounds = new google.maps.LatLngBounds();
                var iw = new google.maps.InfoWindow();
                var InforObj = [];
                var className = 'map_pin_jws';
            
    			function initialize() {
    			    if(locations.length <= 0) return false; 
    				map = new google.maps.Map(document.getElementById("jobs-map-view"), {
    				    zoom: 8,
    					center: new google.maps.LatLng(locations[0]['latitude'], locations[0]['longitude']),
    					mapTypeId: google.maps.MapTypeId.ROADMAP
    				});
                
    				geocoder = new google.maps.Geocoder();
    				for(var i = 0; i < locations.length; i++) {
                        geocodeAddress(locations, i);	
    				}
                  
    			}
    			initialize();
    
                
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
                    var iconImage = document.createElement("img");
                     iconImage.src = icons; // Replace with the actual path to your icon image
                     div.appendChild(iconImage);
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
             
                
    			function geocodeAddress(locations, i) {
    		
    			    var id = locations[i]['id']; 
    				var title = locations[i]['title'];
    				var address = locations[i]['address'];
    				var url = locations[i]['url'];
    				var images = locations[i]['images'];
    				var icon_url = icons;
                   var delay = 0; 
                   var nextAddress = 0;
                    console.log(i+'---'+address);
                    
    				geocoder.geocode({
    					'address': address
    				}, function(results, status) {
    				    console.log(status);
    					if(status == google.maps.GeocoderStatus.OK) {
                            
                            var marker = new CustomMarker(results[0].geometry.location, map, id , className);
    					  
                          
                           google.maps.event.addListener(marker, 'click', function() {
                         
                                $('.jws_job_item').removeClass('selected');
                                $('.map_pin_jws').removeClass('active');
                                $("#"+marker.id).addClass('selected');
                                $('.map_pin_jws[data-id="'+marker.id+'"]').addClass('active');
                                $('html,body').animate({
                                        scrollTop: $("#"+marker.id).offset().top - $(window).height()/2
                                }, 1000);
            					
            				});
                     
                        bounds.extend(marker.getPosition());
    					map.fitBounds(bounds);     
    	
    					} else if(status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
    					    
    					    nextAddress--;
                             delay++;
                           
    					} else {
    						alert("geocode of " + address + " failed:" + status);
    					}
    				});
                      
    			}
                
                function closeOtherInfo() {
                    if (InforObj.length > 0) {
                        /* detach the info-window from the marker ... undocumented in the API docs */
                        InforObj[0].set("marker", null);
                        /* and close it */
                        InforObj[0].close();
                        /* blank the array */
                        InforObj.length = 0;
                    }
                }
                $(document).on('click','body',function(e){
                    if ($(e.target).is(".map_pin_jws,.map_pin_jws *") === false) {
                        $('.jws_job_item').removeClass('selected');
                        $('.map_pin_jws').removeClass('active');
                    }
                });
                
                $('.jws_job_item').hover(
                  function(){ $('.map_pin_jws[data-id="'+$(this).attr("id")+'"]').addClass('active'); },
                  function(){ $('.map_pin_jws[data-id="'+$(this).attr("id")+'"]').removeClass('active');  }
                )
           
            }, 
            
            
       }     
    }())
    })(jQuery);

 jQuery(document).ready(function() {
    jwsThemeWooModule_Free.init();
});
