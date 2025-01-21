<?php

namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;

/**
 * jwsProductAdvanced
 *
 * @author jwsSoft <hello.jwssoft@gmail.com>
 * @package jws
 */
if (class_exists('WooCommerce')):
    final class JwsCategoryList extends Widget_Base
    {
        /**
         * @return string
         */
        function get_name()
        {
            return 'jws-category-list';
        }

        /**
         * @return string
         */
        function get_title()
        {
            return esc_html__('jws Category List Product', 'freeagent');
        }

        /**
         * @return string
         */
        function get_icon()
        {
            return 'cs-font jws-icon-cart-3  eicon-editor-list-ul';
        }
        /**
         * @return array
         */
        public function get_categories()
        {
            return ['jws-elements'];
        }
        /**
         * Register controls
         */
        protected function register_controls()
        {
            
           
            $this->start_controls_section(
                'section_options', [
                'label' => esc_html__('Options', 'freeagent')
            ]);
            $this->add_control(
				'layouts',
				[
					'label'     => esc_html__( 'Layout', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'layout1',
					'options'   => [
						'layout1'   => esc_html__( 'Layout1 With (Category Images 2)', 'freeagent' ),
						'layout2'   => esc_html__( 'Layout2', 'freeagent' ),
                        'layout3'   => esc_html__( 'Layout3', 'freeagent' ),
                        'layout4'   => esc_html__( 'Layout List', 'freeagent' ),
					],
                    
				]
			);
            $this->add_control(
    			'image_size',
    			[
    				'label' => esc_html__( 'Image Size', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
    				'default' => [
    					'width' => '',
    					'height' => '',
    				],
                    'condition'	=> [
						'layouts!' => 'layout1',
				    ],
    			]
    		  );
              $this->add_control(
    			'image_size2',
    			[
    				'label' => esc_html__( 'Image Size 2', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
    				'default' => [
    					'width' => '',
    					'height' => '',
    				],
                    'condition'	=> [
						'layouts' => 'layout3',
				    ],
    			]
    		  );
            // Grid
            $this->add_responsive_control('display', [
                'label' => esc_html__('Display', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid', 'freeagent'),
                    'slider' => esc_html__('Slider', 'freeagent'),
                ],

            ]);
            //Cate
            $this->add_control('filter_categories', [
                'label' => esc_html__('Categories', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => true,
                'options' => $this->get_categories_for_jws('product_cat', 2),
              
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
            
            // Grid
            $this->add_responsive_control('columns', [
                'label' => esc_html__('Columns for row', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SELECT,
                'default' => '20',
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
            $this->end_controls_section();
            
            $this->start_controls_section(
                'normal_style_settings', [
                'label' => esc_html__('Style', 'freeagent'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]);
            $this->add_responsive_control(
    			'alignment',
    			[
    				'label' => esc_html__( 'Alignment', 'freeagent' ),
    				'type' => Controls_Manager::CHOOSE,
    				'label_block' => false,
    				'options' => [
    					'left' => [
    						'title' => esc_html__( 'Left', 'freeagent' ),
    						'icon' => 'fa fa-align-left',
    					],
    					'center' => [
    						'title' => esc_html__( 'Center', 'freeagent' ),
    						'icon' => 'fa fa-align-center',
    					],
    					'right' => [
    						'title' => esc_html__( 'Right', 'freeagent' ),
    						'icon' => 'fa fa-align-right',
    					],
    				],
    				'selectors' => [
    					'{{WRAPPER}} .category-tab-item a' => 'text-align: {{VALUE}}',
    				],
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
    					'{{WRAPPER}} .category-tab-item' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
    					'{{WRAPPER}} .category-content.row' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
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
    					'{{WRAPPER}} .category-tab-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
    				],
    			]
    		);
            $this->add_responsive_control(
					'box_padding',
					[
						'label' 		=> esc_html__( 'Padding', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .category-tab-item a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		  );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label'     => esc_html__( 'Font Name Category', 'freeagent' ),
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .category-tab-item a h4',
                ]
            );   
            $this->add_control(
    			'cat_color',
    			[
    				'label'     => esc_html__( 'Categories Color', 'freeagent' ),
    				'type'      => Controls_Manager::COLOR,
    				'selectors' => [
    					'{{WRAPPER}} .category-tab-item a'=> 'color: {{VALUE}};',
    				],
    			]
    		); 
            $this->add_control(
    			'cat_color_hover',
    			[
    				'label'     => esc_html__( 'Categories Color Hover', 'freeagent' ),
    				'type'      => Controls_Manager::COLOR,
    				'selectors' => [
    					'{{WRAPPER}} .category-tab-item a:hover'=> 'color: {{VALUE}};',
    				],
    			]
    		);
       $this->end_controls_section();
       $this->start_controls_section(
			'setting_navigation',
			[
				'label' => esc_html__( 'Setting Navigation', 'freeagent' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                 'condition' => ['display'=>'slider']
			]
		);
        $this->add_control(
    				'enable_nav',
    				[
    					'label'        => esc_html__( 'Enable Nav', 'freeagent' ),
    					'type'         => Controls_Manager::SWITCHER,
    					'label_on'     => esc_html__( 'Yes', 'freeagent' ),
    					'label_off'    => esc_html__( 'No', 'freeagent' ),
    					'return_value' => 'yes',
    					'default'      => 'yes',
    					'description'  => esc_html__( 'Enable nav arrow.', 'freeagent' ),
    				]
    	);
        $this->add_control(
    				'enable_dots',
    				[
    					'label'        => esc_html__( 'Enable Dots', 'freeagent' ),
    					'type'         => Controls_Manager::SWITCHER,
    					'label_on'     => esc_html__( 'Yes', 'freeagent' ),
    					'label_off'    => esc_html__( 'No', 'freeagent' ),
    					'return_value' => 'yes',
    					'default'      => 'yes',
    					'description'  => esc_html__( 'Enable dot.', 'freeagent' ),
    				]
    	);

        $this->add_control(
			'dots_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_slider_element .jws_slider .flickity-page-dots li.is-selected' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .jws_slider_element .jws_slider .flickity-page-dots li:before' => 'background: {{VALUE}}',
				],
			]
		);
        $this->end_controls_section();       
       jws_elementor_widget_slider_config($this,['display' => 'slider']);
 
        }

        /**
         * Load style
         */
        public function get_style_depends()
        {
            return ['jws-style'];
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
        public function get_script_depends()
        {
            return ['jws-script'];
        }
        protected function get_categories_for_jws($taxonomy, $select = 1)
        {
            $data = array();
    
            $query = new \WP_Term_Query(array(
                'hide_empty' => false,
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
                'default_category' => '',
                'asset_type' => 'all',
                'filter_assets' => '',
                'default_asset' => '',
                'product_ids' => '',
                'orderby' => 'date',
                'order' => 'desc',
                'posts_per_page' => 6,
                'columns' => '',
                'pagination' => '',
                'slides_to_show' => 4,
                'speed' => 5000,
                'scroll' => 1,
                'autoplay' => 'true',
                'show_pag' => 'true',
                'show_nav' => 'true',
                'nav_position' => 'middle-nav',
               

            ], $this->get_settings_for_display());

            $this->add_inline_editing_attributes('title');

            $this->add_render_attribute('title', 'class', 'jws-title');

            include 'content.php';
       
        }
              private function render_swiper_button( $settings, $type ) {
        		$icon_key = 'arrow_icon_' . $type;
        
        		Icons_Manager::render_icon( $settings[ $icon_key ], [ 'aria-hidden' => 'true' ] );
        	} 
    }
endif;