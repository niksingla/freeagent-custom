(function($) {
    "use strict";

    var jws_dropdown_text = function($scope, $) {
        $scope.find('.jws_dropdown_text').eq(0).each(function() {

        });
    };



    /*Toggle*/
        var jws_tongle_switch = function($scope, $) {
            $scope.find('.jws_tongle_switch').eq(0).each(function() {
                var $this = $(this);
                
                $this.find('.tongle-check').click(function() {
                    if($this.find('.tongle-check').is(":checked")) {
                        $this.find('.jws_tongle_secondary').addClass('active');
                        $this.find('.jws_tongle_primary').addClass('hidden');
                        $this.find('.toggle-btn').addClass('active');
                    } else if($this.find('.tongle-check').is(":not(:checked)")){
                        $this.find('.jws_tongle_secondary').removeClass('active');
                        $this.find('.jws_tongle_primary').removeClass('hidden');
                        $this.find('.toggle-btn').removeClass('active');
                    }
                })
                
            });
    
        };
    /**
     *-------------------------------------------------------------------------------------------------------------------------------------------
     * video popup
     *-------------------------------------------------------------------------------------------------------------------------------------------
     */
    var demo_filter = function($scope, $) {
        $scope.find('.jws_demo_element').eq(0).each(function() {
            //Check to see if the window is top if not then display button
            $scope.find('.jws_demo_element .jws_demo_item').each(function() {
                var btn = $(this).find('.jws_image_content_inner');
                $(this).find('.jws_image a').scroll(function() {
                    if ($(this).scrollTop() > 100) {
                        btn.fadeOut("slow");
                    } else {
                        btn.fadeIn("slow");
                    }
                });
                //Click event to scroll to top
                $(this).find('.jws_column_content').on("mouseleave", function() {
                    $(this).find('.jws_image a').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                });
            });
        });
    };
    /**
     *-------------------------------------------------------------------------------------------------------------------------------------------
     * video popup
     *-------------------------------------------------------------------------------------------------------------------------------------------
     */
    var video_popup = function($scope, $) {
        $scope.find('.jws_video_popup').eq(0).each(function() {
            $(this).find('.jws_video_popup_inner').magnificPopup({
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
    };


    /**
     *-------------------------------------------------------------------------------------------------------------------------------------------
     * Pricing Table
     *-------------------------------------------------------------------------------------------------------------------------------------------
     */
    var show_detail_price_info = function($scope, $) {
        $scope.find('.jws-price-table').eq(0).each(function() {
            var $this = $(this);

            $this.find('.jws-price-table__details').click(function() {
                if ($this.hasClass('tongle-active')) {

                    $this.removeClass('tongle-active');
                    $this.attr("style", "");
                } else {
                    $('.jws-price-table').removeClass('tongle-active');
                    $('.jws-price-table').attr("style", "");
                    $this.addClass('tongle-active');
                    var detail_height = $this.find('.jws-price-table__details-list').outerHeight();
                    $this.css('padding-bottom', detail_height);

                }
            })
        });

    };


        /**
         *-------------------------------------------------------------------------------------------------------------------------------------------
         * Search
         *-------------------------------------------------------------------------------------------------------------------------------------------
         */
    var search = function($scope, $) {
        if ('undefined' == typeof $scope) return;
        $scope.find('.jws_search').eq(0).each(function() {
            var s = $(this);
            var openClass = 'open',
                button = s.find('> button');


            s.find(button).on('click', function(e) {
                e.preventDefault();
                if (!s.hasClass(openClass)) {
                    s.addClass(openClass);
                    $('html').css('overflow', 'hidden');
                    setTimeout(function() {
                        s.find('input.search-field').focus();
                    }, 100);

                    return false;;
                } else {
                    s.removeClass(openClass);
                }
                if (!$(e.target).closest('.search-form').length) {
                    if (s.hasClass(openClass)) {
                        $('html').css('overflow-y', 'scroll');
                        s.removeClass(openClass);
                    }
                }
            });

            $('.close-form').on('click', function(e) {
                s.removeClass(openClass);
                $('html').css('overflow-y', 'scroll');

            });


            $('#form_content_popup form').each(function() {

                var form = $(this);
                var s = form.find('.s'),
                openClass = 'open',
                button = s.find('> button');
                
            s.find(button).on('click', function(e) {
                e.preventDefault();
                if (!s.hasClass(openClass)) {
                    s.addClass(openClass);
                    $('html').css('overflow', 'hidden');
                    setTimeout(function() {
                        s.find('input.search-field').focus();
                    }, 100);

                    return false;;
                } else {
                    s.removeClass(openClass);
                }
                if (!$(e.target).closest('.search-form').length) {
                    if (s.hasClass(openClass)) {
                        $('html').css('overflow-y', 'scroll');
                        s.removeClass(openClass);
                    }
                }
            });

            $('.close-form').on('click', function(e) {
                s.removeClass(openClass);
                $('html').css('overflow-y', 'scroll');

            });
            $('.overlay').on('click', function(e) {
                s.removeClass(openClass);
                $('html').css('overflow-y', 'scroll');

            });
                $(document).on("change", '.select_post_type', function() {
                    form.find('[name="post_type"]').val($(this).val());
                    if (s.val() != '') {
                        form.trigger('submit');
                    }
                });

                form.on('submit', function(e) {
                    e.preventDefault();

                    var formData = new FormData(this);
                    if (!form.find('.search-submit .loader').length) {
                        form.find('.search-submit').append('<div class="loader"><svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>');
                    }
                    form.addClass('search-loading');
                    $.ajax({
                        url: jws_script.ajax_url,
                        data: formData,
                        method: 'POST',
                        contentType: false,
                        processData: false,
                        success: function(response) {

                            form.removeClass('search-loading');
                            $('.jws-search-results').html(response.data);


                        },
                        error: function() {
                            console.log('error');
                        },
                        complete: function() {},
                    });
                });

            });

        });
    };
    /**
     *-------------------------------------------------------------------------------------------------------------------------------------------
     * Google Map
     *-------------------------------------------------------------------------------------------------------------------------------------------
     */
    var WidgetjwsGoogleMapHandler = function($scope) {
        if ('undefined' == typeof $scope) return;
        var selector = $scope.find('.jws-google-map').eq(0),
            locations = selector.data('locations'),
            map_style = (selector.data('custom-style') != '') ? selector.data('custom-style') : '',
            predefined_style = (selector.data('predefined-style') != '') ? selector.data('predefined-style') : '',
            info_window_size = (selector.data('max-width') != '') ? selector.data('max-width') : '',
            animate = selector.data('animate'),
            auto_center = selector.data('auto-center'),
            maker_offset = selector.data('offset'),
            map_options = selector.data('map_options'),
            i = '',
            bounds = new google.maps.LatLngBounds(),
            marker_cluster = [],
            className = 'map_pin_jws';
        var animation;
        if ('drop' == animate) {
            animation = google.maps.Animation.DROP;
        } else if ('bounce' == animate) {
            animation = google.maps.Animation.BOUNCE;
        }

        function _typeof(obj) {
            var _typeof;
            if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") {
                _typeof = function _typeof(obj) {
                    return typeof obj;
                };
            } else {
                _typeof = function _typeof(obj) {
                    return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
                };
            }
            return _typeof(obj);
        }

        function CustomMarker(latlng, map, className) {
            this.latlng_ = latlng;
            this.className = className; // Once the LatLng and text are set, add the overlay to the map.  This will
            // trigger a call to panes_changed which should in turn call draw.
            this.setMap(map);
        }
        if ((typeof google === "undefined" ? "undefined" : _typeof(google)) !== _typeof(undefined) && _typeof(google.maps) !== _typeof(undefined)) {
            CustomMarker.prototype = new google.maps.OverlayView();
            CustomMarker.prototype.draw = function() {
                var me = this; // Check if the div has been created.
                var div = this.div_,
                    divChild,
                    divChild2;
                if (!div) {
                    // Create a overlay text DIV
                    div = this.div_ = document.createElement('DIV');
                    div.className = this.className;
                    divChild = document.createElement("div");
                    div.appendChild(divChild);
                    divChild2 = document.createElement("div");
                    div.appendChild(divChild2);
                    google.maps.event.addDomListener(div, "click", function() {
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
            CustomMarker.prototype.remove = function() {
                // Check if the overlay was on the map and needs to be removed.
                if (this.div_) {
                    this.div_.parentNode.removeChild(this.div_);
                    this.div_ = null;
                }
            };
            CustomMarker.prototype.getPosition = function() {
                return this.latlng_;
            };
        }
        var skins = {
            "silver": "[{\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#f5f5f5\"}]},{\"elementType\":\"labels.icon\",\"stylers\":[{\"visibility\":\"off\"}]},{\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#616161\"}]},{\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#f5f5f5\"}]},{\"featureType\":\"administrative.land_parcel\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#bdbdbd\"}]},{\"featureType\":\"poi\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#eeeeee\"}]},{\"featureType\":\"poi\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#757575\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#e5e5e5\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#9e9e9e\"}]},{\"featureType\":\"road\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#ffffff\"}]},{\"featureType\":\"road.arterial\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#757575\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#dadada\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#616161\"}]},{\"featureType\":\"road.local\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#9e9e9e\"}]},{\"featureType\":\"transit.line\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#e5e5e5\"}]},{\"featureType\":\"transit.station\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#eeeeee\"}]},{\"featureType\":\"water\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#c9c9c9\"}]},{\"featureType\":\"water\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#9e9e9e\"}]}]",
            "retro": "[{\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#ebe3cd\"}]},{\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#523735\"}]},{\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#f5f1e6\"}]},{\"featureType\":\"administrative\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#c9b2a6\"}]},{\"featureType\":\"administrative.land_parcel\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#dcd2be\"}]},{\"featureType\":\"administrative.land_parcel\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#ae9e90\"}]},{\"featureType\":\"landscape.natural\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#dfd2ae\"}]},{\"featureType\":\"poi\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#dfd2ae\"}]},{\"featureType\":\"poi\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#93817c\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#a5b076\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#447530\"}]},{\"featureType\":\"road\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#f5f1e6\"}]},{\"featureType\":\"road.arterial\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#fdfcf8\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#f8c967\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#e9bc62\"}]},{\"featureType\":\"road.highway.controlled_access\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#e98d58\"}]},{\"featureType\":\"road.highway.controlled_access\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#db8555\"}]},{\"featureType\":\"road.local\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#806b63\"}]},{\"featureType\":\"transit.line\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#dfd2ae\"}]},{\"featureType\":\"transit.line\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#8f7d77\"}]},{\"featureType\":\"transit.line\",\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#ebe3cd\"}]},{\"featureType\":\"transit.station\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#dfd2ae\"}]},{\"featureType\":\"water\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#b9d3c2\"}]},{\"featureType\":\"water\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#92998d\"}]}]",
            "dark": "[{\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#212121\"}]},{\"elementType\":\"labels.icon\",\"stylers\":[{\"visibility\":\"off\"}]},{\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#757575\"}]},{\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#212121\"}]},{\"featureType\":\"administrative\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#757575\"}]},{\"featureType\":\"administrative.country\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#9e9e9e\"}]},{\"featureType\":\"administrative.land_parcel\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"administrative.locality\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#bdbdbd\"}]},{\"featureType\":\"poi\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#757575\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#181818\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#616161\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#1b1b1b\"}]},{\"featureType\":\"road\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#2c2c2c\"}]},{\"featureType\":\"road\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#8a8a8a\"}]},{\"featureType\":\"road.arterial\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#373737\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#3c3c3c\"}]},{\"featureType\":\"road.highway.controlled_access\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#4e4e4e\"}]},{\"featureType\":\"road.local\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#616161\"}]},{\"featureType\":\"transit\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#757575\"}]},{\"featureType\":\"water\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#000000\"}]},{\"featureType\":\"water\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#3d3d3d\"}]}]",
            "night": "[{\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#242f3e\"}]},{\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#746855\"}]},{\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#242f3e\"}]},{\"featureType\":\"administrative.locality\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#d59563\"}]},{\"featureType\":\"poi\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#d59563\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#263c3f\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#6b9a76\"}]},{\"featureType\":\"road\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#38414e\"}]},{\"featureType\":\"road\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#212a37\"}]},{\"featureType\":\"road\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#9ca5b3\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#746855\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#1f2835\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#f3d19c\"}]},{\"featureType\":\"transit\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#2f3948\"}]},{\"featureType\":\"transit.station\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#d59563\"}]},{\"featureType\":\"water\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#17263c\"}]},{\"featureType\":\"water\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#515c6d\"}]},{\"featureType\":\"water\",\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#17263c\"}]}]",
            "aubergine": "[{\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#1d2c4d\"}]},{\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#8ec3b9\"}]},{\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#1a3646\"}]},{\"featureType\":\"administrative.country\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#4b6878\"}]},{\"featureType\":\"administrative.land_parcel\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#64779e\"}]},{\"featureType\":\"administrative.province\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#4b6878\"}]},{\"featureType\":\"landscape.man_made\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#334e87\"}]},{\"featureType\":\"landscape.natural\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#023e58\"}]},{\"featureType\":\"poi\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#283d6a\"}]},{\"featureType\":\"poi\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#6f9ba5\"}]},{\"featureType\":\"poi\",\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#1d2c4d\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#023e58\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#3C7680\"}]},{\"featureType\":\"road\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#304a7d\"}]},{\"featureType\":\"road\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#98a5be\"}]},{\"featureType\":\"road\",\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#1d2c4d\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#2c6675\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#255763\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#b0d5ce\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#023e58\"}]},{\"featureType\":\"transit\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#98a5be\"}]},{\"featureType\":\"transit\",\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#1d2c4d\"}]},{\"featureType\":\"transit.line\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#283d6a\"}]},{\"featureType\":\"transit.station\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#3a4762\"}]},{\"featureType\":\"water\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#0e1626\"}]},{\"featureType\":\"water\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#4e6d70\"}]}]",
            "magnesium": "[{\"featureType\":\"all\",\"stylers\":[{\"saturation\":0},{\"hue\":\"#e7ecf0\"}]},{\"featureType\":\"road\",\"stylers\":[{\"saturation\":-70}]},{\"featureType\":\"transit\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"poi\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"water\",\"stylers\":[{\"visibility\":\"simplified\"},{\"saturation\":-60}]}]",
            "classic_blue": "[{\"featureType\":\"all\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"on\"}]},{\"featureType\":\"administrative.country\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"on\"}]},{\"featureType\":\"administrative.country\",\"elementType\":\"labels.text\",\"stylers\":[{\"visibility\":\"on\"}]},{\"featureType\":\"administrative.province\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"on\"}]},{\"featureType\":\"administrative.province\",\"elementType\":\"labels.text\",\"stylers\":[{\"visibility\":\"on\"}]},{\"featureType\":\"administrative.locality\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"on\"}]},{\"featureType\":\"administrative.neighborhood\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"administrative.land_parcel\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"landscape\",\"elementType\":\"all\",\"stylers\":[{\"hue\":\"#FFBB00\"},{\"saturation\":43.400000000000006},{\"lightness\":37.599999999999994},{\"gamma\":1}]},{\"featureType\":\"landscape\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"saturation\":\"-40\"},{\"lightness\":\"36\"}]},{\"featureType\":\"landscape.man_made\",\"elementType\":\"geometry\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"landscape.natural\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"saturation\":\"-77\"},{\"lightness\":\"28\"}]},{\"featureType\":\"landscape.natural\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"poi\",\"elementType\":\"all\",\"stylers\":[{\"hue\":\"#00FF6A\"},{\"saturation\":-1.0989010989011234},{\"lightness\":11.200000000000017},{\"gamma\":1}]},{\"featureType\":\"poi\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"poi.attraction\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"saturation\":\"-24\"},{\"lightness\":\"61\"}]},{\"featureType\":\"road\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"on\"}]},{\"featureType\":\"road\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"visibility\":\"on\"}]},{\"featureType\":\"road\",\"elementType\":\"labels.icon\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"all\",\"stylers\":[{\"hue\":\"#FFC200\"},{\"saturation\":-61.8},{\"lightness\":45.599999999999994},{\"gamma\":1}]},{\"featureType\":\"road.highway\",\"elementType\":\"labels.icon\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"road.highway.controlled_access\",\"elementType\":\"labels.icon\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"road.arterial\",\"elementType\":\"all\",\"stylers\":[{\"hue\":\"#FF0300\"},{\"saturation\":-100},{\"lightness\":51.19999999999999},{\"gamma\":1}]},{\"featureType\":\"road.local\",\"elementType\":\"all\",\"stylers\":[{\"hue\":\"#ff0300\"},{\"saturation\":-100},{\"lightness\":52},{\"gamma\":1}]},{\"featureType\":\"road.local\",\"elementType\":\"labels.icon\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"transit\",\"elementType\":\"geometry\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"transit\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"transit\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"transit\",\"elementType\":\"labels.icon\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"transit.line\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"transit.station\",\"elementType\":\"labels.icon\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"water\",\"elementType\":\"all\",\"stylers\":[{\"hue\":\"#0078FF\"},{\"saturation\":-13.200000000000003},{\"lightness\":2.4000000000000057},{\"gamma\":1}]},{\"featureType\":\"water\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]}]",
            "aqua": "[{\"featureType\":\"administrative\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#444444\"}]},{\"featureType\":\"landscape\",\"elementType\":\"all\",\"stylers\":[{\"color\":\"#f2f2f2\"}]},{\"featureType\":\"poi\",\"elementType\":\"all\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"road\",\"elementType\":\"all\",\"stylers\":[{\"saturation\":-100},{\"lightness\":45}]},{\"featureType\":\"road.highway\",\"elementType\":\"all\",\"stylers\":[{\"visibility\":\"simplified\"}]},{\"featureType\":\"road.arterial\",\"elementType\":\"labels.icon\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"transit\",\"elementType\":\"all\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"water\",\"elementType\":\"all\",\"stylers\":[{\"color\":\"#46bcec\"},{\"visibility\":\"on\"}]}]",
            "earth": "[{\"featureType\":\"landscape.man_made\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#f7f1df\"}]},{\"featureType\":\"landscape.natural\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#d0e3b4\"}]},{\"featureType\":\"landscape.natural.terrain\",\"elementType\":\"geometry\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"poi\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"poi.business\",\"elementType\":\"all\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"poi.medical\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#fbd3da\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#bde6ab\"}]},{\"featureType\":\"road\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"road\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#ffe15f\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#efd151\"}]},{\"featureType\":\"road.arterial\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#ffffff\"}]},{\"featureType\":\"road.local\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"black\"}]},{\"featureType\":\"transit.station.airport\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#cfb2db\"}]},{\"featureType\":\"water\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#a2daf2\"}]}]"
        };
        if ('undefined' != typeof skins[predefined_style]) {
            map_style = JSON.parse(skins[predefined_style]);
        }
        (function initMap() {
            var latlng = new google.maps.LatLng(locations[0][0], locations[0][1]);
            map_options.center = latlng;
            map_options.styles = map_style;
            if (false == map_options.gestureHandling) {
                map_options.gestureHandling = 'none';
            }
            var map = new google.maps.Map($scope.find('.jws-google-map')[0], map_options);
            var infowindow = new google.maps.InfoWindow();
            var marker;
            for (i = 0; i < locations.length; i++) {
                var title = locations[i][3];
                var description = locations[i][4];
                var images_info = locations[i][5];
                var icon_size = parseInt(locations[i][8]);
                var icon_type = locations[i][6];
                var icon = '';
                var icon_url = locations[i][7];
                var enable_iw = locations[i][2];
                var click_open = locations[i][9];
                var lat = locations[i][0];
                var lng = locations[i][1];
                var infoWindow_opened = false;
                if ('undefined' === typeof locations[i]) {
                    return;
                }
                if ('' != lat.length && '' != lng.length) {
                    if ('custom' == icon_type) {
                        icon = {
                            url: icon_url,
                        };
                        if (!isNaN(icon_size)) {
                            icon.scaledSize = new google.maps.Size(icon_size, icon_size);
                            icon.origin = new google.maps.Point(0, 0);
                            icon.anchor = new google.maps.Point(icon_size / 2, icon_size);
                        }
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(lat, lng),
                            map: map,
                            title: title,
                            icon: icon,
                            animation: animation
                        });
                    } else if ('html' == icon_type) {
                        marker = new CustomMarker(new google.maps.LatLng(lat, lng), map, className);
                    } else {
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(lat, lng),
                            map: map,
                            title: title,
                            icon: icon,
                            animation: animation
                        });
                    }
                    if ('undefined' !== typeof maker_offset) {
                        map.panBy(0, maker_offset);
                    }
                    if (locations.length > 1) {
                        // Extend the bounds to include each marker's position
                        bounds.extend(marker.position);
                    }
                    marker_cluster[i] = marker;
                    if (enable_iw && 'iw_open' == click_open) {
                        infoWindow_opened = true;
                        var has_image = '';
                        if (images_info != '') {
                            has_image = ' has-image';
                        }
                        var content_string = '<div class="jws-infowindow-content' + has_image + '">';


                        if (images_info != '') {
                            content_string += '<div class="info-left"><img src="' + images_info + '"></div>';
                        }
                        if ('' != description.length) {
                            content_string += ' <div class="info-right"><div class="jws-infowindow-title">' + title + '</div><div class="jws-infowindow-description">' + description + '</div></div>';
                        }

                        content_string += '</div>';
                        if ('' != info_window_size) {
                            var width_val = parseInt(info_window_size);
                            infowindow = new google.maps.InfoWindow({
                                content: content_string,
                                maxWidth: width_val
                            });
                        } else {
                            infowindow = new google.maps.InfoWindow({
                                content: content_string,
                            });
                        }
                        infowindow.open(map, marker);
                    }
                    // Adding close event for info window
                    google.maps.event.addListener(map, 'click', (function(infowindow) {
                        return function() {
                            infowindow.close();
                        };
                    })(infowindow));
                    infowindow.addListener('closeclick', () => {
                        infoWindow_opened = false;
                    });
                    if (enable_iw && '' != locations[i][3]) {
                        google.maps.event.addListener(marker, 'click', (function(marker, i) {
                            var infowindow = new google.maps.InfoWindow();
                            if (images_info != '') {
                                has_image = ' has-image';
                            }
                            if ('' != locations[i][5].length) {
                                var content_string = '<div class="jws-infowindow-content ' + has_image + '"><div class="info-left"><img src="' + locations[i][5] + '"></div>';
                            }

                            content_string += '<div class="info-right"><div class="jws-infowindow-title">' + locations[i][3] + '</div>';
                            if ('' != locations[i][4].length) {
                                content_string += '<div class="jws-infowindow-description">' + locations[i][4] + '</div></div>';
                            }

                            content_string += '</div>';

                            return function() {

                                infowindow.setContent(content_string);
                                if ('' != info_window_size) {
                                    var width_val = parseInt(info_window_size);
                                    var InfoWindowOptions = {
                                        maxWidth: width_val
                                    };
                                    infowindow.setOptions({
                                        options: InfoWindowOptions
                                    });
                                }

                                if (!infoWindow_opened) {
                                    infowindow.open(map, marker);
                                }


                            };

                        })(marker, i));
                    }
                }
            }
            if (locations.length > 1) {
                if ('center' == auto_center) {
                    // Now fit the map to the newly inclusive bounds.
                    map.fitBounds(bounds);
                }
                // Restore the zoom level after the map is done scaling.
                var listener = google.maps.event.addListener(map, "idle", function() {
                    map.setZoom(map_options.zoom);
                    google.maps.event.removeListener(listener);
                });
            }
        })();
    };
    /**
     * Table handler Function.
     *
     */
    var jws_table = function($scope, $) {
        if ('undefined' == typeof $scope) {
            return;
        }
        // Define variables.
        var node_id = $scope.data('id');
        var jws_table = $scope.find('.jws-table');
        var jws_table_id = $scope.find('#jws-table-id-' + node_id);
        var searchable = false;
        var showentries = false;
        var sortable = false;
        if (0 == jws_table_id.length) return;
        //Search entries
        var search_entry = $('.elementor-element-' + node_id + ' #' + jws_table_id[0].id).data('searchable');
        if ('yes' == search_entry) {
            searchable = true;
        }
        //Show entries select
        var show_entry = $('.elementor-element-' + node_id + ' #' + jws_table_id[0].id).data('show-entry');
        if ('yes' == show_entry) {
            showentries = true;
        }
        //Sort entries
        var sort_table = $('.elementor-element-' + node_id + ' #' + jws_table_id[0].id).data('sort-table');
        if ('yes' == sort_table) {
            $('.elementor-element-' + node_id + ' #' + jws_table_id[0].id + ' th').css({
                'cursor': 'pointer'
            });
            sortable = true;
        }
        var search_string = jws_script.search_str;
        var length_string = jws_script.table_length_string;
        if (searchable || showentries || sortable) {
            $('#' + jws_table_id[0].id).DataTable({
                "paging": showentries,
                "searching": searchable,
                "ordering": sortable,
                "info": false,
                "oLanguage": {
                    "sSearch": search_string,
                    "sLengthMenu": length_string,
                },
            });
            var div_entries = $scope.find('.dataTables_length');
            div_entries.addClass('jws-tbl-entry-wrapper jws-table-info');
            var div_search = $scope.find('.dataTables_filter');
            div_search.addClass('jws-tbl-search-wrapper jws-table-info');
            $scope.find('.jws-table-info').wrapAll('<div class="jws-advance-heading"></div>');
        }

        function coloumn_rules() {
            if ($(window).width() > 767) {
                $(jws_table).addClass('jws-column-rules');
                $(jws_table).removeClass('jws-no-column-rules');
            } else {
                $(jws_table).removeClass('jws-column-rules');
                $(jws_table).addClass('jws-no-column-rules');
            }
        }
        // Listen for events.
        window.addEventListener("load", coloumn_rules);
        window.addEventListener("resize", coloumn_rules);
    };
    /**
     * Menu Style.
     *
     */
    var jws_menu_style = function($scope, $) {
        if ('undefined' == typeof $scope) {
            return;
        }
        $scope.find('.jws_main_menu').eq(0).each(function() {
            var $this = $(this);
            $(this).find('.elementor-icon-list-item.active').parents('.nav > li').addClass('current-menu-item');
            if ($this.closest('.elementor-widget-jws_menu_nav').hasClass('elementor-before-menu-skin-animation-line')) {
                var main = $this.find(".jws_main_menu_inner"),
                    curent_item = main.find('> ul > li.current-menu-item , > ul > li.current-menu-ancestor'),
                    curent_item_sub = main.find('ul li.current-menu-item , .elementor-icon-list-item.active');
                if (main.find('> ul > li.current-menu-item').length == 0) {
                    if (curent_item_sub.length > 0) {
                        curent_item = curent_item_sub.parents('.nav > li');
                    } else {
                        curent_item = main.find('> ul > li:first-child');
                    }
                }
            }
            /** Menu toggle **/
            $this.find('.click-show-menu-v').on('click', function() {
                $this.find('.menu-toggle').toggleClass('open');
            });
        });
        //mega menu  
        var mainMenu = $('.elementor_jws_menu_layout_menu_horizontal').find('.nav');
        var mega_item = mainMenu.find(' > li.menu-item-design-mega_menu_full_width');

        if (mega_item.length > 0) {
            $('.jws_header').addClass('has-mega-full');
        }

        mega_item.mouseenter(function() {
            $('.jws_header.has-mega-full').addClass('mega-has-hover');
        });

        mega_item.mouseleave(function() {
            $('.jws_header.has-mega-full').removeClass('mega-has-hover');
        });

    };


    var instagram = function($scope, $) {
        $scope.find('.jws-instagram').eq(0).each(function() {
            var $this = $(this);
            var height_start = $this.find('.jws-instagram-item.col-xl-4').height();
            $this.find('.instagram-wap').css('height', height_start);
            if ($(this).hasClass('metro')) {
                setTimeout(function() {
                    $this.find('.loader').remove();
                    $this.find('.instagram-wap').removeClass('loading').isotope({
                        itemSelector: ".jws-instagram-item",
                        layoutMode: 'masonry',
                        transitionDuration: "0.3s",
                        masonry: {
                            // use outer width of grid-sizer for columnWidth
                            columnWidth: '.grid-sizer',
                        }
                    });
                }, 2000);
            }
        });
    };


    var countdown = function($scope, $) {
        $scope.find('.jws-countdown-animation').eq(0).each(function() {
            var date_time = $(this).data('time-now');
            $(this).timeTo({
                timeTo: new Date(new Date(date_time)),
                displayCaptions: true,
                fontSize: 30,
            });
        })
    }



    /**
     * -----------------------------------------------------------------------------------------------
     * Charts Handler
     * -----------------------------------------------------------------------------------------------
     */

    var jwsChartHandler = function($scope, $) {
        var jwsChart = $scope.find(".jws-chart-container"),
            jwsChartSettings = jwsChart.data("settings"),
            type = jwsChartSettings["type"],
            eventsArray = [
                "mousemove",
                "mouseout",
                "click",
                "touchstart",
                "touchmove"
            ],
            printVal = jwsChartSettings["printVal"],
            event =
            ("pie" == type || "doughnut" == type) && printVal ? false : eventsArray,
            jwsChartData = jwsChart.data("chart"),
            data = {
                labels: jwsChartSettings["xlabels"],
                datasets: []
            };

        function renderChart() {
            var ctx = document
                .getElementById(jwsChartSettings["chartId"])
                .getContext("2d");


            var globalOptions = {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        top: type == "polarArea" ? 6 : 0
                    }
                },
                events: event,
                animation: {
                    duration: 500,
                    easing: jwsChartSettings["easing"],
                    onComplete: function() {
                        if (!event) {
                            this.defaultFontSize = 16;
                            ctx.font =
                                '15px "Helvetica Neue", "Helvetica", "Arial", sans-serif';

                            ctx.textAlign = "center";
                            ctx.textBaseline = "bottom";

                            this.data.datasets.forEach(function(dataset) {
                                for (var i = 0; i < dataset.data.length; i++) {
                                    var model =
                                        dataset._meta[Object.keys(dataset._meta)[0]].data[i]
                                        ._model,
                                        total =
                                        dataset._meta[Object.keys(dataset._meta)[0]].total,
                                        mid_radius =
                                        model.innerRadius +
                                        (model.outerRadius - model.innerRadius) / 2,
                                        start_angle = model.startAngle,
                                        end_angle = model.endAngle,
                                        mid_angle = start_angle + (end_angle - start_angle) / 2;

                                    var x = mid_radius * Math.cos(mid_angle);
                                    var y = mid_radius * Math.sin(mid_angle);

                                    ctx.fillStyle = jwsChartSettings["yTicksCol"];

                                    var percent =
                                        String(Math.round((dataset.data[i] / total) * 100)) + "%";

                                    ctx.fillText(percent, model.x + x, model.y + y + 15);
                                }
                            });
                        }
                    }
                },
                tooltips: {
                    enabled: jwsChartSettings["enTooltips"],
                    mode: jwsChartSettings["modTooltips"],
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var prefixString = "";
                            if (
                                "pie" == type ||
                                "doughnut" == type ||
                                "polarArea" == type
                            ) {
                                prefixString = data.labels[tooltipItem.index] + ": ";
                            }
                            var dataset = data.datasets[tooltipItem.datasetIndex];
                            var total = dataset.data.reduce(function(
                                previousValue,
                                currentValue
                            ) {
                                return parseFloat(previousValue) + parseFloat(currentValue);
                            });
                            var currentValue = dataset.data[tooltipItem.index];
                            var percentage = ((currentValue / total) * 100).toPrecision(3);
                            return (
                                prefixString +
                                (jwsChartSettings["percentage"] ?
                                    percentage + "%" :
                                    currentValue)
                            );
                        }
                    }
                },
                legend: {
                    display: jwsChartSettings["legDis"],
                    position: jwsChartSettings["legPos"],
                    reverse: jwsChartSettings["legRev"],
                    onClick: null,
                    labels: {
                        boxWidth: parseInt(jwsChartSettings["itemWid"]),
                        fontColor: jwsChartSettings["legCol"],
                        fontSize: parseInt(jwsChartSettings["legSize"]),
                        fontFamily: jwsChartSettings["legFamily"],
                        padding: 20,
                    }
                }

            };

            var multiScaleOptions = {
                scales: {
                    xAxes: [{
                        barPercentage: jwsChartSettings["xwidth"],
                        display: type == "radar" ||
                            type == "pie" ||
                            type == "polarArea" ||
                            type == "doughnut" ?
                            false : true,
                        gridLines: {
                            display: jwsChartSettings["xGrid"],
                            color: jwsChartSettings["xGridCol"],
                            lineWidth: jwsChartSettings["xGridWidth"],
                            drawBorder: true
                        },
                        scaleLabel: {
                            display: jwsChartSettings["xlabeldis"],
                            labelString: jwsChartSettings["xlabel"],
                            fontColor: jwsChartSettings["xlabelcol"],
                            fontSize: jwsChartSettings["xlabelsize"]
                        },
                        ticks: {
                            fontSize: jwsChartSettings["xTicksSize"],
                            fontColor: jwsChartSettings["xTicksCol"],
                            stepSize: jwsChartSettings["stepSize"],
                            maxRotation: jwsChartSettings["xTicksRot"],
                            minRotation: jwsChartSettings["xTicksRot"],
                            beginAtZero: jwsChartSettings["xTicksBeg"],
                            callback: function(tick) {
                                return tick.toLocaleString();
                            }
                        }
                    }],
                    yAxes: [{
                        display: type == "radar" ||
                            type == "pie" ||
                            type == "polarArea" ||
                            type == "doughnut" ?
                            false : true,
                        type: jwsChartSettings["yAxis"],
                        gridLines: {
                            display: jwsChartSettings["yGrid"],
                            color: jwsChartSettings["yGridCol"],
                            lineWidth: jwsChartSettings["yGridWidth"],
                        },
                        scaleLabel: {
                            display: jwsChartSettings["ylabeldis"],
                            labelString: jwsChartSettings["ylabel"],
                            fontColor: jwsChartSettings["ylabelcol"],
                            fontSize: jwsChartSettings["ylabelsize"]
                        },
                        ticks: {
                            suggestedMin: jwsChartSettings["suggestedMin"],
                            suggestedMax: jwsChartSettings["suggestedMax"],
                            fontSize: jwsChartSettings["yTicksSize"],
                            fontColor: jwsChartSettings["yTicksCol"],
                            beginAtZero: jwsChartSettings["yTicksBeg"],
                            stepSize: jwsChartSettings["stepSize"],
                            callback: function(tick) {
                                return tick.toLocaleString();
                            }
                        }
                    }]
                }
            };

            var singleScaleOptions = {
                scale: {
                    ticks: {
                        beginAtZero: jwsChartSettings["yTicksBeg"],
                        stepSize: jwsChartSettings["stepSize"],
                        suggestedMax: jwsChartSettings["suggestedMax"]
                    }
                }
            };

            var myChart = new Chart(ctx, {
                type: type,
                data: data,
                options: Object.assign(globalOptions, ("radar" !== type && "polarArea" !== type) ? multiScaleOptions : singleScaleOptions)
            });


            jwsChartData.forEach(function(element) {
                if (type !== "pie" && type !== "doughnut") {
                    var gradient = ctx.createLinearGradient(0, 0, 0, 600),
                        secondColor = element.backgroundColor[1] ?
                        element.backgroundColor[1] :
                        element.backgroundColor[0];
                    gradient.addColorStop(0, element.backgroundColor[0]);
                    gradient.addColorStop(1, secondColor);
                    element.backgroundColor = gradient;
                    element.hoverBackgroundColor = gradient;
                }
                data.datasets.push(element);
                myChart.update();
            });

            $("#" + jwsChartSettings["chartId"]).on("click", function(evt) {
                var activePoint = myChart.getElementAtEvent(evt);
                if (activePoint[0]) {
                    var URL =
                        myChart.data.datasets[activePoint[0]._datasetIndex].links[
                            activePoint[0]._index
                        ];
                    if (URL != null && URL != "") {
                        window.open(URL, jwsChartSettings["target"]);
                    }
                }
            });
        }
        var $checkModal = $(jwsChart).closest(".jws-modal-box-modal");

        if ($checkModal.length) {
            renderChart();
        }
        var waypoint = new Waypoint({
            element: $("#" + jwsChartSettings["chartId"]),
            offset: Waypoint.viewportHeight() - 250,
            triggerOnce: true,
            handler: function() {
                renderChart();
                this.destroy();
            }
        });
    };





    $(window).on('elementor/frontend/init', function() {


        elementorFrontend.hooks.addAction('refresh_page_css', function(css) {
            var $obj = $('style#jws_elementor_custom_css');
            if (!$obj.length) {
                $obj = $('<style id="jws_elementor_custom_css"></style>').appendTo('head');
            }
            css = css.replace('/<script.*?\/script>/s', '');
            $obj.html(css).appendTo('head');
        });

        var widgets = {
            'jws_video_popup.default': video_popup,
            'jws_map.default': WidgetjwsGoogleMapHandler,
            'jws_search.default': search,
            'jws_table.default': jws_table,
            'jws_menu_nav.default': jws_menu_style,
            'jws_demo.default': [demo_filter],
            'jws_instagram.default': instagram,
            'jws_widget_countdown.default': countdown,
            'jws_dropdown_text.default': jws_dropdown_text,
            'jws-avenchart.default': [jwsChartHandler],
            'jws-price-table.default': show_detail_price_info,
            
            'jws_tongle_switch.default': jws_tongle_switch,
            

        };

        $.each(widgets, function(widget, callback) {
            if ('object' === typeof callback) {
                $.each(callback, function(index, cb) {
                    elementorFrontend.hooks.addAction('frontend/element_ready/' + widget, cb);
                });
            } else {
                elementorFrontend.hooks.addAction('frontend/element_ready/' + widget, callback);
            }
        });


    });



})(jQuery);