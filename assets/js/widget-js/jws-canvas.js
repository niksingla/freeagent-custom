(function($) {
"use strict";
    var OffCanvas = {

        /**
         * Invoke Show Off-Canvas 
         */
        _show: function(canvas_id) {

            var $canvas_element = $('#offcanvas-' + canvas_id),
            $button = $('[data-offcanvas="'+canvas_id+'"]');
            $('.jws-offcanvas').removeClass('jws-offcanvas-show');
            $canvas_element.addClass('jws-offcanvas-show');
            $('.jws-offcanvas-trigger').removeClass('active');
            $button.addClass('active');

        },

        /**
         * Invoke Close Off-Canvas
         */
        _close: function(canvas_id) {
            var $canvas_element = $('#offcanvas-' + canvas_id),
            $button = $('[data-offcanvas="'+canvas_id+'"]');
            $button.removeClass('active');
            $canvas_element.removeClass('jws-offcanvas-show');
        },
    };

    /**
     * Trigger open Off Canvas On Click Button/Icon
     */
    $(document).off('click.opentrigger').on('click.opentrigger  resize', '.jws-offcanvas-trigger.action', function() {
        var canvas_id = $(this).closest('.elementor-element').data('id');
        var selector = $('.uaoffcanvas-' + canvas_id);
        var trigger_on = selector.data('trigger-on');

        if ('button' == trigger_on && !$(this).hasClass('jws-open-login')) {
            OffCanvas._show(canvas_id);
        }
    });

    /*
     * jws_offcanvas_init trigger
     */
    $(document).on('jws_offcanvas_init', function(e, node_id) {
        /*
         * Close on ESC 
         */
        $(document).on('keyup', function(e) {
            if (e.keyCode == 27) {
                $('.jws-offcanvas-parent-wrapper').each(function() {
                    var $this = $(this);
                    var canvas_id = $this.closest('.jws-offcanvas-parent-wrapper').data('id');
                    var close_on_esc = $this.data('close-on-esc');

                    if ('yes' == close_on_esc) {
                        OffCanvas._close(canvas_id);
                    }
                });
            }

        });

        /**
         * Close on Icon
         */
        $('.jws-offcanvas-close').click(function() {
            var canvas_id = $(this).closest('.jws-offcanvas-parent-wrapper').data('id');
            OffCanvas._close(canvas_id);

        });

        /**
         * Close On Overlay Click
         */
        $('.jws-offcanvas-overlay').off('click.overlaytrigger').on('click.overlaytrigger', function() {

            $('.jws-offcanvas-parent-wrapper').each(function() {
                var $this = $(this);
                var canvas_id = $this.closest('.jws-offcanvas-parent-wrapper').data('id');
                var close_on_overlay = $this.data('close-on-overlay');

                if ('yes' == close_on_overlay) {
                    OffCanvas._close(canvas_id);
                }
            });
        });

        /**
         * If Preview-Mode is ON
         */
        if ($('#offcanvas-' + node_id).hasClass('jws-show-preview')) {
            setTimeout(function() {
                OffCanvas._show(node_id);
            }, 400);
        } else {
            setTimeout(function() {
                OffCanvas._close(node_id);
            }, 400);
        }

    });

    /* On Load page event */
    $(document).ready(function() {

        $('.jws-offcanvas-parent-wrapper').each(function() {

            var $this = $(this);
            var tmp_id = $this.attr('id');
            var canvas_id = tmp_id.replace('-overlay', '');
            var trigger_on = $this.data('trigger-on');
            var custom = $this.data('custom');
            var custom_id = $this.data('custom-id');
            var custom_selectors;
            var i;
            // Custom Class click event
            if ('custom' == trigger_on) {
                if ('undefined' != typeof custom && '' != custom) {
                    custom_selectors = custom.split(',');
                    if (custom_selectors.length > 0) {
                        for (i = 0; i < custom_selectors.length; i++) {
                            if ('undefined' != typeof custom_selectors[i] && '' != custom_selectors[i]) {
                                $('.' + custom_selectors[i]).css("cursor", "pointer");
                                $('body').on('click', '.' + custom_selectors[i], function() {
                                    OffCanvas._show(canvas_id);
                                });
                            }
                        }
                    }
                }
            }

            // Custom ID click event
            if ('custom_id' == trigger_on) {
                if ('undefined' != typeof custom_id && '' != custom_id) {
                    custom_selectors = custom_id.split(',');
                    if (custom_selectors.length > 0) {
                        for (i = 0; i < custom_selectors.length; i++) {
                            if ('undefined' != typeof custom_selectors[i] && '' != custom_selectors[i]) {
                                $('#' + custom_selectors[i]).css("cursor", "pointer");
                                $(document).on('click', '#' + custom_selectors[i], function() {
                                    OffCanvas._show(canvas_id);
                                });
                            }
                        }
                    }
                }
            }
        });

    });

    /**
     * Off-Canvas handler Function.
     *
     */
    var WidgetOffCanvasHandler = function($scope, $) {

        if ('undefined' == typeof $scope)
            return;

        $(document).trigger('jws_offcanvas_init', [$scope.data('id')]);
    };

    $(window).on('elementor/frontend/init', function() {

        elementorFrontend.hooks.addAction('frontend/element_ready/Offcanvas.default', WidgetOffCanvasHandler);

    });
   $(document).ready(function() {

        var current_url = window.location.href;
        if (current_url.indexOf('&action=elementor') <= 0) {
            $('.jws-offcanvas-parent-wrapper').each(function() {
                
                $(this).appendTo(document.body);
            });
        }
    });
})(jQuery);