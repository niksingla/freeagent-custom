<?php

namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;

if (class_exists('WooCommerce')):
    final class JwsProductAdvanced extends Widget_Base
    {
        /**
         * @return string
         */
        function get_name()
        {
            return 'jws-product-advanced';
        }

        /**
         * @return string
         */
        function get_title()
        {
            return esc_html__('Jws Product Advanced', 'freeagent');
        }

        /**
         * @return string
         */
        function get_icon()
        {
            return 'eicon-products';
        }
        /**
         * @return array
         */
        public function get_categories()
        {
            return ['jws-elements'];
        }
        public function get_script_depends() {
		return [ 'owl-carousel','jws-woocommerce' , 'magnificPopup' , 'swiper'];
	   }
       public function get_style_depends() {
		return [ 'owl-carousel', 'magnificPopup'];
	   }
        /**
         * Register controls
         */
        protected function register_controls()
        {
            $this->start_controls_section(
                'section_setting', [
                'label' => esc_html__('Setting', 'freeagent')
            ]);

            $this->add_control('layout', [
                'label' => esc_html__('Layout', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid', 'freeagent'),
                    'metro' => esc_html__('Metro', 'freeagent'),
                    'carousel' => esc_html__('Carousel', 'freeagent'),
                ],
            ]);
            
            $this->add_control('display', [
                'label' => esc_html__('Display', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SELECT,
                'default' => 'layout1',
                'options' => [
                    'layout1' => esc_html__('Layout 1', 'freeagent'),
                ],
            ]);

            $this->add_control('tabs_filter', [
                'label' => esc_html__('Filter', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('None', 'freeagent'),
                    'cate' => esc_html__('Category', 'freeagent'),
                    'asset' => esc_html__('Asset type', 'freeagent'),
                ],

            ]);
            
            $this->add_control('tabs_filter_display', [
                'label' => esc_html__('Filter Display', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    'horizontal' => esc_html__('Horizontal', 'freeagent'),
                    'vertical' => esc_html__('Vertical', 'freeagent'),
                ],
                'condition' => [
                    'tabs_filter!' => ['none'],
                ],
            ]);
            $this->add_control('show_text_starting', [
                'label' => esc_html__('Show Text Before Price', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'freeagent'),
                'label_off' => esc_html__('Hide', 'freeagent'),
                'return_value' => 'true',
            ]);
            $this->end_controls_section();
            
            $this->start_controls_section(
                'section_readmore', [
                'label' => esc_html__('Read More', 'freeagent'),
                'condition' => [
                    'tabs_filter_display' => ['vertical'],
                ],
            ]);
            
             $this->add_control(
    				'readmore',
    				[
    					'label'     => esc_html__( 'Read More', 'freeagent' ),
    					'type'      => Controls_Manager::TEXT,
    					'default'   => 'Create your Jewelry',
    				]
    		);
        
            $this->add_control(
    			'readmore_url',
    			[
    				'label' => esc_html__( 'Link', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::URL,
    				'placeholder' => esc_html__( 'https://your-link.com', 'freeagent' ),
    				'show_external' => true,
    				'default' => [
    					'url' => '#',
    				],
    			]
    		);
            $this->end_controls_section();

            $this->start_controls_section(
                'section_options', [
                'label' => esc_html__('Options', 'freeagent')
            ]);
            //Cate
            $this->add_control('filter_categories', [
                'label' => esc_html__('Categories', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => true,
                'options' => $this->get_categories_for_jws('product_cat', 2),
                'condition' => [
                    'tabs_filter' => ['none', 'cate'],
                ],
            ]);
            $this->add_control('default_category', [
                'label' => esc_html__('Default categories', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => $this->get_categories_for_jws('product_cat'),
                'condition' => [
                    'tabs_filter' => 'cate',
                ],
            ]);

            $this->add_control('asset_type', [
                'label' => esc_html__('Asset type', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SELECT,
                'default' => 'all',
                'options' => $this->get_woo_asset_type_for_jws(),
                'condition' => [
                    'tabs_filter' => ['none', 'cate'],
                ],
            ]);

            // Asset
            $this->add_control('filter_assets', [
                'label' => esc_html__('Asset type', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => true,
                'options' => $this->get_woo_asset_type_for_jws(2),
                'condition' => [
                    'tabs_filter' => 'asset',
                ],
            ]);
            $this->add_control('default_asset', [
                'label' => esc_html__('Default asset', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => $this->get_woo_asset_type_for_jws(),
                'condition' => [
                    'tabs_filter' => 'asset',
                ],
            ]);
            $this->add_control('filter_categories_for_asset', [
                'label' => esc_html__('Categories', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => true,
                'options' => $this->get_categories_for_jws('product_cat', 2),
                'condition' => [
                    'tabs_filter' => 'asset',
                ],
            ]);

            // Filter default
            $this->add_control('ex_product_ids', [
                'label' => esc_html__('Exclude product IDs', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_list_posts('product'),
            ]);
            $this->add_control('inc_product_ids', [
                'label' => esc_html__('Include product IDs', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_list_posts('product'),
            ]);
            $this->add_control('orderby', [
                'label' => esc_html__('Order by', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => $this->get_woo_order_by_for_jws(),
            ]);
            $this->add_control('order', [
                'label' => esc_html__('Order', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => $this->get_woo_order_for_jws(),
            ]);

            $this->add_control('posts_per_page', [
                'label' => esc_html__('Products per pages', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
            ]);
            // Grid
            $this->add_responsive_control('columns', [
                'label' => esc_html__('Columns for row', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '1' => esc_html__('12', 'freeagent'),
                    '2' => esc_html__('6', 'freeagent'),
                    '3' => esc_html__('4', 'freeagent'),
                    '4' => esc_html__('3', 'freeagent'),
                    '6' => esc_html__('2', 'freeagent'),
                    '12' => esc_html__('1', 'freeagent'),
                    '20' => esc_html__('5', 'freeagent'),
                    '2' => esc_html__('6', 'freeagent'),
                ],

            ]);

            $this->add_control('pagination_tab', [
                'label' => esc_html__('Pagination', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('None', 'freeagent'),
                    'numeric' => esc_html__('Numeric', 'freeagent'),
                    'ajaxload' => esc_html__('Ajax Load More', 'freeagent'),
                ],
                'condition' => [
                    'layout!' => 'carousel',
                    'tabs_filter' => 'none',
                ],
            ]);

            $this->end_controls_section();
            jws_elementor_widget_slider_config($this,['layout' => 'carousel']);
                         $this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Box', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_responsive_control(
			'column_gap',
			[
				'label'     => esc_html__( 'Columns Gap', 'freeagent' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .product-item' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .row' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
				],
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label'     => esc_html__( 'Rows Gap', 'freeagent' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .product-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control('bg_image_color', [
                'label' => esc_html__('Background For Image', 'freeagent'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-item .product-image' => 'background: {{VALUE}};'
                ]
        ]);
        $this->add_responsive_control(
			'content_align',
			[
				'label' => esc_html__( 'Align', 'freeagent' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'freeagent' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'freeagent' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'freeagent' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .product .product-item-inner' => 'text-align: {{VALUE}}',
				],
			]
		);
        $this->end_controls_section();
        
           $this->start_controls_section(
                'content_item_style', [
                'label' => esc_html__('Content item style', 'freeagent'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]);
            
            $this->add_control('item_title_style', [
                'label' => esc_html__('Product name', 'freeagent'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]);
    
            $this->add_responsive_control(
				'product_name_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'freeagent' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .product-item.product .woocommerce-loop-product__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],

					'separator' => 'before',
				]
		  );

        $this->end_controls_section();
        
        $this->start_controls_section(
                'normal_style_settings', [
                'label' => esc_html__('Heading style', 'freeagent'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]);

            $this->add_control('title_color', [
                'label' => esc_html__('Color', 'freeagent'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .freeagentduct-title' => 'color: {{VALUE}};'
                ]
            ]);
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .freeagentduct-title',
                    'scheme' => Typography::TYPOGRAPHY_1,
                ]
            );
            $this->add_control('title_background', [
                'label' => esc_html__('Background', 'freeagent'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .freeagentduct-title' => 'background: {{VALUE}};'
                ]
            ]);
            
            $this->add_responsive_control(
				'title_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'freeagent' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .freeagentduct-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],

					'separator' => 'before',
				]
		  );

            $this->end_controls_section();
            
             $this->start_controls_section(
                'banner_style_settings', [
                'label' => esc_html__('Banner style', 'freeagent'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'design' => 'design_2',
                ],
            ]);

            $this->add_control('title1_color', [
                'label' => esc_html__('Title 1 Color', 'freeagent'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-banner .banner-text h6' => 'color: {{VALUE}};'
                ]
            ]);
            
            $this->add_control('title2_color', [
                'label' => esc_html__('Title 2 Color', 'freeagent'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-banner .banner-text h3' => 'color: {{VALUE}};'
                ]
            ]);
            
            $this->add_control('title3_color', [
                'label' => esc_html__('Title 3 Color', 'freeagent'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-banner .banner-text p' => 'color: {{VALUE}};'
                ]
            ]);



            $this->end_controls_section();
            
            
             $this->start_controls_section(
                'pagination_style_settings', [
                'label' => esc_html__('Pagination style', 'freeagent'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]);

            
            $this->add_responsive_control(
    			'pagination_margin',
    			[
    				'label' => esc_html__( 'Margin', 'freeagent' ),
    				'type' => Controls_Manager::DIMENSIONS,
    				'size_units' => [ 'px', 'em', '%' ],
    				'selectors' => [
    					'{{WRAPPER}} .jws-products-load-more , {{WRAPPER}} .jws-products-load-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
    				],
    			]
    		);


            $this->end_controls_section();
            
            
            $this->start_controls_section(
                'filter_style_settings', [
                'label' => esc_html__('Filter style', 'freeagent'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]);
            $this->add_responsive_control(
                'filter_align',
                [
                    'label' => esc_html__('Align', 'freeagent'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__('Left', 'freeagent'),
                            'icon' => 'fa fa-align-left',
                        ], 'center' => [
                            'title' => esc_html__('Center', 'freeagent'),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__('Right', 'freeagent'),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .jws-head-filter' => 'text-align: {{VALUE}};'
                    ]
                ]
            );
            $this->add_responsive_control(
    			'filter_padding',
    			[
    				'label' => esc_html__( 'Padding', 'freeagent' ),
    				'type' => Controls_Manager::DIMENSIONS,
    				'size_units' => [ 'px', 'em', '%' ],
    				'selectors' => [
    					'{{WRAPPER}} .jws-head-filter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
    				],
    			]
    		);
            $this->add_responsive_control(
    			'filter_margin',
    			[
    				'label' => esc_html__( 'Margin', 'freeagent' ),
    				'type' => Controls_Manager::DIMENSIONS,
    				'size_units' => [ 'px', 'em', '%' ],
    				'selectors' => [
    					'{{WRAPPER}} .jws-head-filter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
    				],
    			]
    		);
            $this->add_responsive_control(
    			'filter_item_margin',
    			[
    				'label' => esc_html__( 'Item Margin', 'freeagent' ),
    				'type' => Controls_Manager::DIMENSIONS,
    				'size_units' => [ 'px', 'em', '%' ],
    				'selectors' => [
    					'{{WRAPPER}} .jws-head-filter .jws-ajax-load li:not(:last-child)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
    				],
    			]
    		);
            $this->add_control('filter_color', [
                'label' => esc_html__('Color', 'freeagent'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jws-head-filter a' => 'color: {{VALUE}};'
                ]
            ]);
            $this->add_control('filter_active_color', [
                'label' => esc_html__('Active Color', 'freeagent'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jws-head-filter a.active, {{WRAPPER}} .jws-head-filter a:hover' => 'color: {{VALUE}};'
                ]
            ]);
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'filter_typography',
                    'selector' => '{{WRAPPER}} .jws-head-filter a',
                    'scheme' => Typography::TYPOGRAPHY_1,
                ]
            );

            $this->end_controls_section();
            
        }

        /**
         * Retrieve the list of scripts the image carousel widget depended on.
         *
         * Used to set scripts dependencies required to run the widget.
         *
         * @since 1.3.0
         * @access public
         *
         * @return array Widget scripts dependencies.
         */

        protected function get_categories_for_jws($taxonomy, $select = 1)
        {
            $data = array();
    
            $query = new \WP_Term_Query(array(
                'hide_empty' => true,
                'taxonomy'   => $taxonomy,
            ));
            if ($select == 1) {
                $data['all'] = 'All';
            }
    
            if (! empty($query->terms)) {
                foreach ($query->terms as $cat) {
                    $data[ $cat->slug ] = $cat->name;
                }
            }
    
            return $data;
        }
        protected function get_woo_asset_type_for_jws($select = 1)
        {
        if ($select == 1) {
            $asset_type = array(
                'all'          => esc_html__('All', 'freeagent'),
                'latest'       => esc_html__('New Arrivals', 'freeagent'),
                'featured'     => esc_html__('Featured', 'freeagent'),
                'onsale'       => esc_html__('On sale', 'freeagent'),
                'deal'         => esc_html__('Deal', 'freeagent'),
                'best-selling' => esc_html__('Best Seller', 'freeagent'),
                'toprate'      => esc_html__('Top Rate', 'freeagent'),
            );
        } else {
            $asset_type = array(
                'latest'       => esc_html__('New Arrivals', 'freeagent'),
                'featured'     => esc_html__('Featured', 'freeagent'),
                'onsale'       => esc_html__('On sale', 'freeagent'),
                'deal'         => esc_html__('Deal', 'freeagent'),
                'best-selling' => esc_html__('Best Seller', 'freeagent'),
                'toprate'      => esc_html__('Top Rate', 'freeagent'),
            );
        }

        return $asset_type;
        }
        protected function get_list_posts($post_type = 'post')
        {
            $args = array(
                'post_type'        => $post_type,
                'suppress_filters' => true,
                'posts_per_page'   => 300,
                'no_found_rows'    => true,
            );
    
            $the_query = new \WP_Query($args);
            $results   = [];
    
            if (is_array($the_query->posts) && count($the_query->posts)) {
                foreach ($the_query->posts as $post) {
                    $results[ $post->ID ] = sanitize_text_field($post->post_title);
                }
            }
    
            return $results;
        }
            /**
     * Get oder by
     *
     * @return array oder_by
     */
    protected function get_woo_order_by_for_jws()
    {
        $order_by = array(
            'date'       => esc_html__('Date', 'freeagent'),
            'menu_order' => esc_html__('Menu order', 'freeagent'),
            'title'      => esc_html__('Title', 'freeagent'),
            'rand'       => esc_html__('Random', 'freeagent'),
        );

        return $order_by;
    }

    /**
     * Get oder
     *
     * @return array order
     */
    protected function get_woo_order_for_jws()
    {
        $order = array(
            'desc' => esc_html__('DESC', 'freeagent'),
            'asc'  => esc_html__('ASC', 'freeagent'),
        );

        return $order;
    }
        /**
         * Render
         */
        protected function render()
        {
            // default settings
            $settings = array_merge([
                'title' => '',
                'tabs_filter' => 'cate',
                'filter_categories' => '',
                'default_category' => '',
                'asset_type' => 'all',
                'filter_assets' => '',
                'default_asset' => '',
                'product_ids' => '',
                'orderby' => 'date',
                'order' => 'desc',
                'posts_per_page' => 6,
                'columns' => '',
                'pagination_tab' => '',
                'slides_to_show' => 4,
                'speed' => 5000,
                'scroll' => 1,
                'autoplay' => 'true',
                'show_pag' => 'true',
                'show_nav' => 'true',
                'nav_position' => 'middle-nav',
               

            ], $this->get_settings_for_display());

            $this->add_inline_editing_attributes('title');

            $this->add_render_attribute('title', 'class', 'freeagentduct-title');

            include 'content.php';
        }
        private function render_swiper_button( $settings, $type ) {
    		$icon_key = 'arrow_icon_' . $type;
    
    		Icons_Manager::render_icon( $settings[ $icon_key ], [ 'aria-hidden' => 'true' ] );
    	} 
    }
endif;