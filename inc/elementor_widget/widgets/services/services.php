<?php
namespace Elementor;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Services extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'jws_services';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Jws Services', 'freeagent' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-favorite';
	}
    /**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
    public function get_script_depends() {
		return [];
	}
    
	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'jws-elements' ];
	}
    
	/**
	 * Register Woo post Grid controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_controls() {

		/* General Tab */
        $this->register_content_general_controls();
        $this->register_content_filter_controls();
		$this->register_content_grid_controls();
        $this->register_content_slider_controls();
        $this->register_content_pagination_controls();
 
	}

    /**
	 * Register Woo posts General Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	*/
	protected function register_content_general_controls() {

    		$this->start_controls_section(
    			'section_general_field',
    			[
    				'label' => esc_html__( 'General', 'freeagent' ),
    				'tab'   => Controls_Manager::TAB_CONTENT,
    			]
    		);
            $this->add_control(
				'services_display',
				[
					'label'     => esc_html__( 'Display', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'gird',
					'options'   => [
						'gird'   => esc_html__( 'Grid', 'freeagent' ),
						'slider'   => esc_html__( 'Slider', 'freeagent' ),
					],
                    
				]
			);
            $this->add_control(
				'services_layouts',
				[
					'label'     => esc_html__( 'Layout', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'layout1',
					'options'   => [
						'layout1'   => esc_html__( 'Layout 1', 'freeagent' ),
						'layout2'   => esc_html__( 'Layout 2', 'freeagent' ),
					], 
				]
			);
            $this->add_control(
				'post_nav_on',
				[
					'label'        => esc_html__( 'Enable Filter', 'freeagent' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'freeagent' ),
					'label_off'    => esc_html__( 'No', 'freeagent' ),
					'return_value' => 'yes',
					'default'      => 'no',
					'description'  => esc_html__( 'Enable filter services.', 'freeagent' ),
				]
    	   );
            $this->add_control(
				'nav_text_first',
				[
					'label'     => esc_html__( 'Nav Text All', 'freeagent' ),
					'type'      => Controls_Manager::TEXT,
                    'condition'	=> [
						'post_nav_on' => 'yes',
				    ],
			 ]
		  );  
        $this->add_control(
				'excerpt_line',
				[
					'label'     => esc_html__( 'Title Line', 'freeagent' ),
					'type'      => \Elementor\Controls_Manager::NUMBER,
 				'selectors' => [
    					'{{WRAPPER}} .jws-services-inner .entry-title' => '-webkit-line-clamp:{{VALUE}};',
    				],	
				]
			);
            $this->add_control(
				'title_length',
				[
					'label'     => esc_html__( 'Title Length', 'freeagent' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => '',
				]
			);
             $this->add_control(
				'title_more',
				[
					'label'     => esc_html__( 'Title More', 'freeagent' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => ' ... ',
				]
			);

            $this->add_control(
				'icon',
				[
					'label' => esc_html__( 'Read More Icon', 'freeagent' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fab fa-wordpress',
                		'library' => 'fa-brands',
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
			]
		  );

          $this->add_control(
			'ajax_page',
			[
				'label' => esc_html__( 'ajax_page', 'freeagent' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => '',
			]
		  );
		$this->end_controls_section();
        $this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Box', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_responsive_control(
				'content_align',
				[
					'label' 		=> esc_html__( 'Align', 'freeagent' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'options' 		=> [
						'left'    		=> [
							'title' 	=> esc_html__( 'Left', 'freeagent' ),
							'icon' 		=> 'eicon-h-align-left',
						],
						'center' 		=> [
							'title' 	=> esc_html__( 'Center', 'freeagent' ),
							'icon' 		=> 'eicon-h-align-center',
						],
						'right' 		=> [
							'title' 	=> esc_html__( 'Right', 'freeagent' ),
							'icon' 		=> 'eicon-h-align-right',
						],
					],
                    'selectors' => [
							'{{WRAPPER}} .jws-services-inner' => 'text-align: {{VALUE}};',
                            '.jws-services-element .jws-services-layout2 .jws-services-inner .jws-service-images .service_icon' => 'margin:auto;',
					],
					'frontend_available' => true,
				]
		);
        $this->add_control(
			'bg_box_color',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-services-element .jws-services-inner' => 'background-color: {{VALUE}};',
				],
			]
		);

  $this->add_control(
			'bg_box_color_hover',
			[
				'label' => esc_html__( 'Background Color Hover', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-services-element .jws-services-inner:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
  $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'bg_box_shadown',
				'label'                 => esc_html__( 'Box Shadow', 'freeagent' ),
				'selector'              => '{{WRAPPER}} .jws-services-element .jws-services-inner',
			]
		);


        $this->add_responsive_control(
					'service_padding',
					[
						'label' 		=> esc_html__( 'Padding', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-services-element .jws-services-item .jws-services-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->add_responsive_control(
					'service_radius',
					[
						'label' 		=> esc_html__( 'Border Radius', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-services-element .jws-services-item .jws-services-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
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
					'{{WRAPPER}} .jws-services-element .jws-services-item' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .jws-services-element .row' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
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
					'{{WRAPPER}} .jws-services-element .jws-services-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
    

        $this->end_controls_section();
        
        $this->start_controls_section(
			'box_image_style',
			[
				'label' => esc_html__( 'Content', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
			'content_padding',
			[
				'label' 		=> esc_html__( 'Content Padding', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-services-element .jws-services-inner .jws-service-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			
			]
		);
		$this->add_control(
			'content_title',
			[
				'label'     => esc_html__( 'Title', 'freeagent' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
            $this->add_control(
    			'title_color',
    			[
    				'label' =>  esc_html__( 'Color', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::COLOR,
    				'selectors' => [
    					'{{WRAPPER}} .jws-services-element .jws-services-inner .entry-title a' => 'color: {{VALUE}}',
    				],
    			]
    	   );
        $this->add_control(
    			'title_color_hover',
    			[
    				'label' =>  esc_html__( 'Color Hover', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::COLOR,
    				'selectors' => [
    					'{{WRAPPER}} .jws-services-element .jws-services-inner .entry-title a:hover' => 'color: {{VALUE}}',
    				],
    			]
    	   );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-services-element .jws-services-inner .entry-title',
			]
		);
        $this->add_responsive_control(
			'spacing_title',
			[
				'label' 		=> esc_html__( 'Margin', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-services-element .jws-services-inner  .entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			
			]
		);
		$this->add_control(
			'content_excerpt',
			[
				'label'     => esc_html__( 'Infor', 'freeagent' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
                    $this->add_control(
    			'excerpt_color',
    			[
    				'label' =>  esc_html__( 'Color', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::COLOR,
    				'selectors' => [
    					'{{WRAPPER}} .jws-services-element .jws-services-inner .services_infor' => 'color: {{VALUE}}',
    				],
    			]
    	   );
        $this->add_control(
    			'excerpt_color_hover',
    			[
    				'label' =>  esc_html__( 'Color Hover', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::COLOR,
    				'selectors' => [
    					'{{WRAPPER}} .jws-services-element .jws-services-inner:hover .services_infor' => 'color: {{VALUE}}',
    				],
    			]
    	   );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-services-element .jws-services-inner .services_infor',
			]
		);
        $this->add_responsive_control(
			'ct_excerpt',
			[
				'label' 		=> esc_html__( 'Margin', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-services-element .jws-services-inner .services_infor' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			
			]
		);
 	  
 	$this->end_controls_section();
           
     $this->start_controls_section(
			'nav_style',
			[
				'label' => esc_html__( 'Nav', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition'	=> [
					'post_nav_on' => 'yes',
				],
			]
		);
    $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nav_border',
				'label' =>  esc_html__( 'Border', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-services-element .post_nav',
			]
		);
      $this->add_responsive_control(
				'nav_align',
				[
					'label' 		=> esc_html__( 'Align', 'freeagent' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'default' 		=> 'left',
					'options' 		=> [
						'left'    		=> [
							'title' 	=> esc_html__( 'Left', 'freeagent' ),
							'icon' 		=> 'eicon-h-align-left',
						],
						'center' 		=> [
							'title' 	=> esc_html__( 'Center', 'freeagent' ),
							'icon' 		=> 'eicon-h-align-center',
						],
						'right' 		=> [
							'title' 	=> esc_html__( 'Right', 'freeagent' ),
							'icon' 		=> 'eicon-h-align-right',
						],
					],
                    'selectors' => [
							'{{WRAPPER}} .jws-services-element .post_nav_container' => 'text-align: {{VALUE}};',
					],
					'frontend_available' => true,
				]
		);
    $this->add_control(
			'nav_bg_color',
			[
				'label' 	=> esc_html__( 'Background Color', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-services-element .post_nav' => 'background-color: {{VALUE}} ;',
				],
			]
		);
        $this->add_responsive_control(
					'nav_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-services-element .post_nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
        $this->add_responsive_control(
					'nav_padding',
					[
						'label' 		=> esc_html__( 'Padding', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-services-element .post_nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
        $this->add_responsive_control(
					'nav_border_radius',
					[
						'label' 		=> esc_html__( 'Border radius', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-services-element .post_nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
  	$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' =>  esc_html__( 'Box Shadow', 'freeagent' ),
				'selector' => '{{WRAPPER}} .post_nav',
			]
		);
    $this->add_control(
			'nav_title',
			[
				'label' => esc_html__( 'Title', 'freeagent' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
					'nav_color',
					[
						'label' 	=> esc_html__( 'Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .post_nav li a' => 'color: {{VALUE}};',
						],
					]
		);

        $this->add_control(
					'nav_color_active',
					[
						'label' 	=> esc_html__( 'Color Active & Hover', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}}  .post_nav li a.filter-active,
                            {{WRAPPER}}  .post_nav li a:hover' => 'color:{{VALUE}}; ',
						],
					]
		);
        $this->add_control(
					'nav_bg',
					[
						'label' 	=> esc_html__( 'Background ', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .post_nav li a' => 'background: {{VALUE}};',
						],
					]
		);
        
         $this->add_control(
					'nav_bg_active',
					[
						'label' 	=> esc_html__( 'Background Active & Hover', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}}  .post_nav_container .post_nav li a.filter-active,
                            {{WRAPPER}} .post_nav_container .post_nav li a:hover' => 'background: {{VALUE}}; ',
						],
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'nav_typography',
				'label' => esc_html__( 'Typography', 'freeagent'),
				'selector' => '{{WRAPPER}} .post_nav li a',
			]
		);
        $this->add_responsive_control(
					'nav_padding_out',
					[
						'label' 		=> esc_html__( 'Padding Out', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-services-element .post_nav li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
        $this->add_responsive_control(
					'nav_padding_in',
					[
						'label' 		=> esc_html__( 'Padding In', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-services-element .post_nav li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
        $this->add_responsive_control(
			'nav_border_radius_in',
			[
				'label' 		=> esc_html__( 'Border Radius In', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-services-element .post_nav li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


        $this->end_controls_section();
         $this->start_controls_section(
			'pagi_style',
			[
				'label' => esc_html__( 'Pagination Load', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>['pagination_type'=>'pagination-number']
			]
		);
                $this->add_responsive_control(
				'pagi_align',
				[
					'label' 		=> esc_html__( 'Align', 'freeagent' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'default' 		=> 'center',
					'options' 		=> [
						'flex-start'    		=> [
							'title' 	=> esc_html__( 'Left', 'freeagent' ),
							'icon' 		=> 'eicon-h-align-left',
						],
						'center' 		=> [
							'title' 	=> esc_html__( 'Center', 'freeagent' ),
							'icon' 		=> 'eicon-h-align-center',
						],
						'flex-end' 		=> [
							'title' 	=> esc_html__( 'Right', 'freeagent' ),
							'icon' 		=> 'eicon-h-align-right',
						],
					],
                    'selectors' => [
							'{{WRAPPER}} .jws-pagination-number .page-numbers' => 'justify-content: {{VALUE}};',
					],
					'frontend_available' => true,
				]
		);
        $this->add_control(
			'pagi_color',
			[
				'label' 	=> esc_html__( 'Color', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-pagination-number ul li > a' => 'color: {{VALUE}} ;',
				],
			]
		);
        $this->add_control(
			'pagi_color_active',
			[
				'label' 	=> esc_html__( 'Color Active', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-pagination-number ul li > a:hover, 
                    {{WRAPPER}}  .jws-pagination-number ul li > .current' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'pagi_bg_color',
			[
				'label' 	=> esc_html__( 'Background Color', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-pagination-number ul li > a,
                    {{WRAPPER}} .jws-pagination-number ul li > span' => 'background-color: {{VALUE}} ;',
				],
			]
		);
        $this->add_control(
			'pagi_bg_color_active',
			[
				'label' 	=> esc_html__( 'Background Color Active', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-pagination-number ul li > a:hover, 
                    {{WRAPPER}}  .jws-pagination-number ul li > .current' => 'background-color: {{VALUE}};border-color:{{VALUE}}',
				],
			]
		);
        $this->add_responsive_control(
			'pagi_margin',
			[
				'label' 		=> esc_html__( 'Margin', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-pagination-number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
					'pagi_size',
					[
						'label' 		=> esc_html__( 'Size', 'freeagent' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-pagination-number ul li > a,
                            {{WRAPPER}} .jws-pagination-number ul li > span' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};line-height:calc({{SIZE}}{{UNIT}} - 4px);',
						],
					]
		);
                $this->add_responsive_control(
					'pagi_border_radius',
					[
						'label' 		=> esc_html__( 'Border radius', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}}  .jws-pagination-number ul li > a,
                            {{WRAPPER}}  .jws-pagination-number ul li > span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
  $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pagi_box_shadow',
				'label' =>  esc_html__( 'Box Shadow', 'freeagent' ),
				'selector' => '{{WRAPPER}}  .jws-pagination-number ul li > a,
                            {{WRAPPER}}  .jws-pagination-number ul li > span',
			]
		);

    $this->end_controls_section();
    $this->start_controls_section(
			'loadmore_style',
			[
				'label' => esc_html__( 'Load More', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>['pagination_type'=>'load_more']
			]
		);
        $this->add_control(
				'loadmore_align',
				[
					'label' 		=> esc_html__( 'Align', 'freeagent' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'options' 		=> [
						'left'    		=> [
							'title' 	=> esc_html__( 'Left', 'freeagent' ),
							'icon' 		=> 'eicon-h-align-left',
						],
						'center' 		=> [
							'title' 	=> esc_html__( 'Center', 'freeagent' ),
							'icon' 		=> 'eicon-h-align-center',
						],
						'right' 		=> [
							'title' 	=> esc_html__( 'Right', 'freeagent' ),
							'icon' 		=> 'eicon-h-align-right',
						],
					],
                    'selectors' => [
							'{{WRAPPER}} .jws_pagination' => 'text-align: {{VALUE}};',
					],
					'frontend_available' => true,
				]
		);
              $this->add_responsive_control(
					'loadmore_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->add_responsive_control(
					'loadmore_padding',
					[
						'label' 		=> esc_html__( 'Padding', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_pagination .jws-load-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->add_control(
			'loadmore_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_pagination .jws-load-more' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'loadmore_bgcolor',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_pagination .jws-load-more' => 'background: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'loadmore_color_hover',
			[
				'label' => esc_html__( 'Color Hover', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_pagination .jws-load-more:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'loadmore_bgcolor_hover',
			[
				'label' => esc_html__( 'Background Color Hover', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_pagination .jws-load-more:hover' => 'background: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'loadmore_border',
				'label' => esc_html__( 'Border', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws_pagination .jws-load-more',
			]
		);
        $this->add_control(
			'loadmore_radius',
			[
				'label' => esc_html__( 'Border Radius', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .jws_pagination .jws-load-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'loadmore_border_color_hover',
			[
				'label' => esc_html__( 'Border Color Hover', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_pagination .jws-load-more:hover' => 'border-color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'loadmore_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws_pagination .jws-load-more',
			]
		);
        $this->end_controls_section();
	}
    	/**
	 * Register Woo posts Filter Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_content_filter_controls() {

		$this->start_controls_section(
			'section_filter_field',
			[
				'label' => esc_html__( 'Query', 'freeagent' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
				'services_per_page',
				[
					'label'     => esc_html__( 'posts Per Page', 'freeagent' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => '8',
					'condition' => [
						'query_type!'  => 'main',
					],
				]
			);
		$this->add_control(
				'query_type',
				[
					'label'   => esc_html__( 'Source', 'freeagent' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'all',
					'options' => [
						'all'    => esc_html__( 'All posts', 'freeagent' ),
						'custom' => esc_html__( 'Custom Query', 'freeagent' ),
						'manual' => esc_html__( 'Manual Selection', 'freeagent' ),
					],
				]
			);

			$this->add_control(
				'category_filter_rule',
				[
					'label'     => esc_html__( 'Category Filter Rule', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'IN',
					'options'   => [
						'IN'     => esc_html__( 'Match Categories', 'freeagent' ),
						'NOT IN' => esc_html__( 'Exclude Categories', 'freeagent' ),
					],
					'condition' => [
						'query_type' => 'custom',
					],
				]
			);
			$this->add_control(
				'category_filter',
				[
					'label'     => esc_html__( 'Select Categories', 'freeagent' ),
					'type'      => Controls_Manager::SELECT2,
					'multiple'  => true,
					'default'   => '',
					'options'   => $this->get_services_categories(),
					'condition' => [
						'query_type' => 'custom',
					],
				]
			);
            
            
			$this->add_control(
				'tag_filter_rule',
				[
					'label'     => esc_html__( 'Tag Filter Rule', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'IN',
					'options'   => [
						'IN'     => esc_html__( 'Match Tags', 'freeagent' ),
						'NOT IN' => esc_html__( 'Exclude Tags', 'freeagent' ),
					],
					'condition' => [
						'query_type' => 'custom',
					],
				]
			);
			$this->add_control(
				'tag_filter',
				[
					'label'     => esc_html__( 'Select Tags', 'freeagent' ),
					'type'      => Controls_Manager::SELECT2,
					'multiple'  => true,
					'default'   => '',
					'options'   => $this->get_services_tags(),
					'condition' => [
						'query_type' => 'custom',
					],
				]
			);
			$this->add_control(
				'offset',
				[
					'label'       => esc_html__( 'Offset', 'freeagent' ),
					'type'        => Controls_Manager::NUMBER,
					'default'     => 0,
					'description' => esc_html__( 'Number of post to displace or pass over.', 'freeagent' ),
					'condition'   => [
						'query_type' => 'custom',
					],
				]
			);

			$this->add_control(
				'query_manual_ids',
				[
					'label'     => esc_html__( 'Select posts', 'freeagent' ),
					'type'      => 'jws-query-posts',
					'post_type' => 'services',
					'multiple'  => true,
					'condition' => [
						'query_type' => 'manual',
					],
				]
			);

			/* Exclude */
			$this->add_control(
				'query_exclude',
				[
					'label'     => esc_html__( 'Exclude', 'freeagent' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'query_type!' => [ 'manual', 'main' ],
					],
				]
			);
			$this->add_control(
				'query_exclude_ids',
				[
					'label'       => esc_html__( 'Select posts', 'freeagent' ),
					'type'        => 'jws-query-posts',
					'post_type'   => 'services',
					'multiple'    => true,
					'description' => esc_html__( 'Select posts to exclude from the query.', 'freeagent' ),
					'condition'   => [
						'query_type!' => [ 'manual', 'main' ],
					],
				]
			);
			$this->add_control(
				'query_exclude_current',
				[
					'label'        => esc_html__( 'Exclude Current post', 'freeagent' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'freeagent' ),
					'label_off'    => esc_html__( 'No', 'freeagent' ),
					'return_value' => 'yes',
					'default'      => '',
					'description'  => esc_html__( 'Enable this option to remove current post from the query.', 'freeagent' ),
					'condition'    => [
						'query_type!' => [ 'manual', 'main' ],
					],
				]
			);

			/* Advanced Filter */
			$this->add_control(
				'query_advanced',
				[
					'label'     => esc_html__( 'Advanced', 'freeagent' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'query_type!' => 'main',
					],
				]
			);
			$this->add_control(
				'filter_by',
				[
					'label'     => esc_html__( 'Filter By', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => '',
					'options'   => [
						''         => esc_html__( 'None', 'freeagent' ),
						'featured' => esc_html__( 'Featured', 'freeagent' ),
						'sale'     => esc_html__( 'Sale', 'freeagent' ),
					],
					'condition' => [
						'query_type!' => 'main',
					],
				]
			);
			$this->add_control(
				'orderby',
				[
					'label'     => esc_html__( 'Order by', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'date',
					'options'   => [
						'date'       => esc_html__( 'Date', 'freeagent' ),
						'title'      => esc_html__( 'Title', 'freeagent' ),
						'price'      => esc_html__( 'Price', 'freeagent' ),
						'popularity' => esc_html__( 'Popularity', 'freeagent' ),
						'rating'     => esc_html__( 'Rating', 'freeagent' ),
						'rand'       => esc_html__( 'Random', 'freeagent' ),
						'menu_order' => esc_html__( 'Menu Order', 'freeagent' ),
					],
					'condition' => [
						'query_type!' => 'main',
					],
				]
			);
			$this->add_control(
				'order',
				[
					'label'     => esc_html__( 'Order', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'desc',
					'options'   => [
						'desc' => esc_html__( 'Descending', 'freeagent' ),
						'asc'  => esc_html__( 'Ascending', 'freeagent' ),
					],
					'condition' => [
						'query_type!' => 'main',
					],
				]
			);

		$this->end_controls_section();
	}
    
   
	/**
	 * Register grid Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_content_grid_controls() {
		$this->start_controls_section(
			'section_grid_options',
			[
				'label'     => esc_html__( 'Grid Options', 'freeagent' ),
				'type'      => Controls_Manager::SECTION,
			]
		);
		$this->add_responsive_control(
				'services_columns',
				[
					'label'          => esc_html__( 'Columns', 'freeagent' ),
					'type'           => Controls_Manager::SELECT,
					'default'        => '12',
					'options'        => [
						'12' => '1',
						'6' => '2',
						'4' => '3',
						'3' => '4',
						'20' => '5',
						'2' => '6',
					],
				]
			);
		$this->end_controls_section();
	}
    
    
    /**
	 * Register Slider Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_content_slider_controls() {
	 jws_elementor_widget_slider_config($this,['services_display' => 'slider']);
	}
        /**
	 * Register Pagination Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_content_pagination_controls() {

		$this->start_controls_section(
			'section_pagination_field',
			[
				'label'     => esc_html__( 'Pagination', 'freeagent' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'pagination_type',
				[
					'label'     => esc_html__( 'Type', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => '',
					'options'   => [
						''              => esc_html__( 'None', 'freeagent' ),
                        'load_more' => esc_html__( 'Load More', 'freeagent' ),
                        'pagination-number' => esc_html__( 'Number', 'freeagent' ),
					],
				]
			);
            $this->add_control(
				'pagination_loadmore_label',
				[
					'label'     => esc_html__( 'Loadmore Label', 'freeagent' ),
					'default'   => esc_html__( 'Load more ', 'freeagent' ),
					'condition' => [
						'pagination_type'      => ['load_more'],
					],
				]
			);

		$this->end_controls_section();
	} 

    /**
	 * Get WooCommerce post Categories.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function get_services_categories() {

		$services_cat = array();

		$cat_args = array(
			'orderby'    => 'name',
			'order'      => 'asc',
			'hide_empty' => false,
		);
      
		$services_categories = get_terms( 'services_cat', $cat_args );
        
        
		if ( ! empty( $services_categories ) ) {

			foreach ( $services_categories as $key => $category ) {

				$services_cat[ $category->slug ] = $category->name;
			}
		}

		return $services_cat;
	}
    /**
	 * Get WooCommerce post Tags.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function get_services_tags() {

		$services_tag = array();

		$tag_args = array(
			'orderby'    => 'name',
			'order'      => 'asc',
			'hide_empty' => false,
		);

		$services_tag = get_terms( 'services_tag', $tag_args );
        
        $services_tag = '';

		if ( ! empty( $services_tag ) ) {

			foreach ( $services_tag as $key => $tag ) {

				$services_tag[ $tag->slug ] = $tag->name;
			}
		}

		return $services_tag;
	}
	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings();
        extract( $settings );
        $encoded_atts = json_encode( $settings );

			global $post;

			$query_args = [
				'post_type'      => 'services',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'paged'          => 1,
				'post__not_in'   => array(),
			];

		    if ( $settings['services_per_page'] > 0 ) {
					$query_args['posts_per_page'] = $settings['services_per_page'];
			}
			
			if ( '' !== $settings['pagination_type'] ) {

									if ( is_front_page() ) {
                        $paged = (get_query_var('page')) ? get_query_var('page') : 1;   
                    } else {
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
                    }


					$query_args['paged'] = $paged;
			}


			if ( 'custom' === $settings['query_type'] ) {

				if ( ! empty( $settings['category_filter'] ) ) {

					$cat_operator = $settings['category_filter_rule'];

					$query_args['tax_query'][] = [
						'taxonomy' => 'services_cat',
						'field'    => 'slug',
						'terms'    => $settings['category_filter'],
						'operator' => $cat_operator,
					];
				}

				if ( ! empty( $settings['tag_filter'] ) ) {

					$tag_operator = $settings['tag_filter_rule'];

					$query_args['tax_query'][] = [
						'taxonomy' => 'services_tag',
						'field'    => 'slug',
						'terms'    => $settings['tag_filter'],
						'operator' => $tag_operator,
					];
				}

				if ( 0 < $settings['offset'] ) {

					/**
					 * Offset break the pagination. Using WordPress's work around
					 *
					 * @see https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
					 */
					$query_args['offset_to_fix'] = $settings['offset'];
				}
			}

			if ( 'manual' === $settings['query_type'] ) {

				$manual_ids = $settings['query_manual_ids'];

				$query_args['post__in'] = $manual_ids;
			}

			if ( 'manual' !== $settings['query_type'] && 'main' !== $settings['query_type'] ) {

				if ( '' !== $settings['query_exclude_ids'] ) {

					$exclude_ids = $settings['query_exclude_ids'];

					$query_args['post__not_in'] = $exclude_ids;
				}

				if ( 'yes' === $settings['query_exclude_current'] ) {

					$query_args['post__not_in'][] = $post->ID;
				}
			}

			$query_args = apply_filters( 'jws_services_query_args', $query_args, $settings );

			$services = new \WP_Query( $query_args );
            
            
            
      $class_row = 'service-content';  
      $class_row .= ' jws-services-'.$settings['services_layouts'].'';
        $class_row .= ' services_ajax_'.$this->get_id().'';
      $class_column = 'jws-services-item';
      
      
    $show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
	$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
    $show_inbox = ($settings['show_inbox'] == 'yes') ? 'show_container' : '';
      
      if($settings['services_display'] == 'slider') {
        
        $class_row .= ' swiper jws_services_'.$settings['services_display'].' '.$show_inbox.' '.$settings['arrows_position'];
        $class_column .= ' swiper-slide';   
        
       }else{
        $class_row .= ' row jws-services-'.$settings['services_display'];
         $class_column .= ' col-xl-'.$settings['services_columns'].'';
          $class_column .= (!empty($settings['services_columns_tablet'])) ? ' col-lg-'.$settings['services_columns_tablet'].'' : ' col-lg-'.$settings['services_columns'].'' ;
          $class_column .= (!empty($settings['services_columns_mobile'])) ? ' col-'.$settings['services_columns_mobile'].'' :  ' col-'.$settings['services_columns'].'';
       }
           if($settings['post_nav_on']=='yes'){
            
            $class_row .= ' jws-isotope ';
             wp_enqueue_script('isotope');
            }     
      ?>
 
		
		<div class="jws-services-element">
        <?php 
                $taxonomy_names = get_object_taxonomies('services');
                
                if((isset($settings['category_filter_rule']) && $settings['category_filter_rule'] != 'IN') && 'custom' === $settings['query_type']) {
                   $cats = get_terms($taxonomy_names, array(
                       'orderby' => 'name',
                       'exclude' => $settings['category_filter'],
                   ));  
                } elseif((isset($settings['category_filter_rule']) && $settings['category_filter_rule'] == 'IN') && 'custom' === $settings['query_type']) {
                   $cats = get_terms($taxonomy_names, array(
                       'orderby' => 'name',
                       'include' => $settings['category_filter'],
                    ));
                }else {
                    $cats = get_terms('services_cat', array(
                       'orderby' => 'name',
                        
                    ));
                }

            ?>
            <?php if($settings['post_nav_on'] == 'yes') : ?>
            <div class="post_nav_container">
                <ul class="post_nav">
                    <li><a href="javascript:void(0);" data-filter="*" class="filter-active"><?php echo ''.(!empty($settings['nav_text_first'])) ? $settings['nav_text_first'] : esc_html__('All', 'freeagent'); ?></a></li>
                    <?php
                        foreach ($cats as $cat) {
                            ?>
                                <li><a href="javascript:void(0);" data-filter="<?php echo "." . esc_attr($cat->slug); ?>"><?php echo esc_html($cat->name); ?></a></li>
                            <?php
                        }
                    ?>
                </ul>
            </div>   
            <?php endif; ?>   
            <div class="<?php echo esc_attr($class_row); ?>" >
                <?php if($settings['services_display'] == 'slider') echo '<div class="swiper-wrapper">';?>
                <?php 
                $image_size = !empty($settings['image_size']['width']) && !empty($settings['image_size']['height']) ?  $settings['image_size']['width'].'x'.$settings['image_size']['height'] : 'full';
               
                if($settings['services_layouts']=='layout2'){
                    global $jws_option;
        		      if ( ! empty( $settings['category_filter'] ) ) {
        		          $term_slugs = $settings['category_filter'];
        		          $term_ids = array();
                            foreach ($term_slugs as $term_slug) {
                                $term = get_term_by('slug', $term_slug, 'services_cat');
                                if ($term) {
                                    $term_ids[] = $term->term_id;
                                }
                            }
                        $services_terms = get_terms(array(
                            'taxonomy' => 'services_cat',
                             'include'=>$term_ids,
                             'hide_empty' => false,
                        ));
                        
        				}else{
        				  $services_terms = get_terms(array(
                            'taxonomy'   => 'services_cat',
                            'hide_empty' => false,
                        ));  
                  
        				}
                   
                        foreach ($services_terms as $term){
                          
                                 $count = $term->count;
                                 
                                echo '<div class="'.$class_column.'">';
                                       include( 'layout/'.$settings['services_layouts'].'.php' );
                               echo '</div>'; 
                           
                       }
                    }else{

                        if ($services->have_posts()) :
                        $i =0;
                            while ( $services->have_posts() ) :
                        			$services->the_post();
                               $class_slug = '';
                                $item_cats = get_the_terms(get_the_ID(), 'services_cat');
                                if ($item_cats){
                                foreach ($item_cats as $item_cat) {
                                    $class_slug .= ' '.' '.$item_cat->slug;
                                }
     							}
                          
                                    $job_author_id = $post->post_author;
                                   
            
                                $post_id = get_the_ID();
                                $freelancer_id = \Jws_Custom_User::get_freelaner_id( $job_author_id );
                                 $freelancer_permalink = get_permalink($freelancer_id);
                                
                                $display_name = get_the_title($freelancer_id);

        
                                    
                                 $services_type = get_post_meta($post_id, 'services_type', true); 
                                $services_price = get_post_meta($post_id, 'services_price', true); 
                                
                                $args = wp_parse_args( $services, array(
                                    'addon_ids'   =>  '',
                                    'price_addons' => '',
                                    'post_id' => get_the_ID()
                                ) );
                                
                                extract( $args );
                                $price_html='';
                                if($services_type == '2') {
                                    
                                    $package_service = get_field('package_service',$post_id); 
                                    foreach($package_service as $key => $package) {
                                      $price_html= jws_format_price((int) $price_addons + (int) $package['package_price']); 
                                        break;
                                    }
                                  }else{
                                    $price_html = jws_format_price($services_price);
                                  }
                                  
                                  
                                    $sale_number = get_post_meta($post_id, 'sale_number', true);
                                    $sale_number = (!empty($sale_number))? $sale_number : 0;
                                
                                    echo '<div class="'.$class_column.$class_slug.'">';
                     
                                           include( 'layout/'.$settings['services_layouts'].'.php' );
            
        
                                    echo '</div>';
                            endwhile;    
                        endif;
                    }
                	wp_reset_postdata();
                   
                ?>
               <?php if($settings['services_display'] == 'slider') echo '</div>';?>  
                    
                  <?php 
                if($show_dots && $settings['services_display'] == 'slider'){
                    echo '<div class=" swiper-pagination '.$settings['dots_position'].'" ></div>';
                  }
                ?>
            </div>
            <?php 
             global $wp_query;
             $number_page = $services->max_num_pages;
             $pagi_number = jws_query_pagination($services);
            if ( $number_page > 1 && $settings['pagination_type'] == 'load_more' ) {
                 wp_enqueue_script( 'isotope');
                  wp_enqueue_script( 'imageload'); 
                 $load_attr = 'data-ajaxify-options=\'{"wrapper":".services_ajax_'.$this->get_id().'","items":"> .jws-services-item","trigger":"click"}\''; 
                  $paged = $services->get('paged') ? $services->get('paged') : 1;
                $url = get_pagenum_link($paged + 1);
                ?>
                <div class="jws_pagination jws_ajax">
                 <?php if(get_next_posts_page_link($number_page)): ?>
                    <a class="jws-load-more" data-ajaxify="true"  href="<?php echo add_query_arg( 'ajaxify', '1', $url); ?>" <?php echo wp_kses_post($load_attr); ?>>
                        <span class="has-loading"><?php echo esc_html($settings['pagination_loadmore_label']); ?> </span>
                       
                </a>
                <?php endif;?>
                </div>
            <?php }elseif($number_page > 1 && $settings['pagination_type'] == 'pagination-number'){
                      echo ''.$pagi_number;   
                  }  
            ?>
            <?php
                if($show_arrows && $settings['services_display'] == 'slider') : ?>	              
                        <button class="elementor-swiper-button elementor-swiper-button-prev">
                            <?php $this->render_swiper_button( $settings, 'prev' ); ?>
                        </button>
                        <button class="elementor-swiper-button elementor-swiper-button-next">
                         <?php $this->render_swiper_button( $settings, 'next' ); ?>
                        </button>
                    
                  <?php endif;?>
        </div>

	<?php }
      private function render_swiper_button( $settings, $type ) {
		$icon_key = 'arrow_icon_' . $type;

		Icons_Manager::render_icon( $settings[ $icon_key ], [ 'aria-hidden' => 'true' ] );
	}  
	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {}
}