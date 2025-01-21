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
class Freelancers extends Widget_Base {

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
		return 'jws_freelancers';
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
		return esc_html__( 'Jws freelancers', 'freeagent' );
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
				'freelancers_display',
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
				'freelancers_layouts',
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
				'excerpt_length',
				[
					'label'     => esc_html__( 'Excerpt Length', 'freeagent' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => '',
				]
			);
             $this->add_control(
				'excerpt_more',
				[
					'label'     => esc_html__( 'Excerpt More', 'freeagent' ),
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
							'{{WRAPPER}} .jws-freelancers-wap' => 'text-align: {{VALUE}};',
                            '.jws-freelancers-element .jws-freelancers-layout2 .jws-freelancers-wap .jws-freelancers-images .freelancers_icon' => 'margin:auto;',
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
					'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
  $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'bg_box_shadown',
				'label'                 => esc_html__( 'Box Shadow', 'freeagent' ),
				'selector'              => '{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap',
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
                [
                    'name'      => 'box_border',
                    'selector'  => '{{WRAPPER}} .jws-freelancers-wap',
                ]
            );
        $this->add_responsive_control(
					'freelancers_padding',
					[
						'label' 		=> esc_html__( 'Padding', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-item .jws-freelancers-wap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

					
					]
		);
        $this->add_responsive_control(
					'freelancers_radius',
					[
						'label' 		=> esc_html__( 'Border Radius', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-item .jws-freelancers-wap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-item' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .jws-freelancers-element .row' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
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
					'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
    					'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap .entry-title a' => 'color: {{VALUE}}',
    				],
    			]
    	   );
        $this->add_control(
    			'title_color_hover',
    			[
    				'label' =>  esc_html__( 'Color Hover', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::COLOR,
    				'selectors' => [
    					'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap .entry-title a:hover' => 'color: {{VALUE}}',
    				],
    			]
    	   );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap .entry-title',
			]
		);
        $this->add_responsive_control(
			'spacing_title',
			[
				'label' 		=> esc_html__( 'Margin', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap  .entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			
			]
		);
		$this->add_control(
			'content_excerpt',
			[
				'label'     => esc_html__( 'Short Description', 'freeagent' ),
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
    					'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap .excerpt' => 'color: {{VALUE}}',
    				],
    			]
    	   );
        $this->add_control(
    			'excerpt_color_hover',
    			[
    				'label' =>  esc_html__( 'Color Hover', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::COLOR,
    				'selectors' => [
    					'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap:hover .excerpt' => 'color: {{VALUE}}',
    				],
    			]
    	   );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap .excerpt',
			]
		);
        $this->add_responsive_control(
			'ct_excerpt',
			[
				'label' 		=> esc_html__( 'Margin', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap .excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			
			]
		);
		$this->add_control(
			'content_cat',
			[
				'label'     => esc_html__( 'category', 'freeagent' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);  
        $this->add_control(
    			'cat_color',
    			[
    				'label' =>  esc_html__( 'Color', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::COLOR,
    				'selectors' => [
    					'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap .post_cat a' => 'color: {{VALUE}}',
    				],
    			]
    	   );
        $this->add_control(
    			'cat_color_hover',
    			[
    				'label' =>  esc_html__( 'Color Hover', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::COLOR,
    				'selectors' => [
    					'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap:hover .post_cat a' => 'color: {{VALUE}}',
    				],
    			]
    	   );
        $this->add_control(
    			'cat_bg_color',
    			[
    				'label' =>  esc_html__( 'Background', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::COLOR,
    				'selectors' => [
    					'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap .post_cat a' => 'background: {{VALUE}}',
    				],
    			]
    	   );
        $this->add_control(
    			'cat_bg_color_hover',
    			[
    				'label' =>  esc_html__( 'Background Hover', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::COLOR,
    				'selectors' => [
    					'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap .post_cat a:hover' => 'background: {{VALUE}}',
    				],
    			]
    	   );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap .post_cat a',
			]
		);
        $this->add_responsive_control(
			'padding_cat',
			[
				'label' 		=> esc_html__( 'Padding', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap .post_cat a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			
			]
		);
        $this->add_responsive_control(
			'ct_cat',
			[
				'label' 		=> esc_html__( 'Margin', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			
			]
		);
 	  $this->add_control(
			'content_readMore',
			[
				'label'     => esc_html__( 'View Profile', 'freeagent' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
    			'readmore_color',
    			[
    				'label' =>  esc_html__( 'Color', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::COLOR,
    				'selectors' => [
    					'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap .btn_view' => 'color: {{VALUE}}',
    				],
    			]
    	   );
        $this->add_control(
    			'readmore_color_hover',
    			[
    				'label' =>  esc_html__( 'Color Hover', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::COLOR,
    				'selectors' => [
    					'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap:hover .btn_view' => 'color: {{VALUE}}',
    				],
    			]
    	   );
        $this->add_control(
    			'bg_readmore_color',
    			[
    				'label' =>  esc_html__( 'Color', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::COLOR,
    				'selectors' => [
    					'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap .btn_view' => 'background: {{VALUE}}',
    				],
    			]
    	   );
        $this->add_control(
    			'bg_readmore_color_hover',
    			[
    				'label' =>  esc_html__( 'Color Hover', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::COLOR,
    				'selectors' => [
    					'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap:hover .btn_view' => 'background: {{VALUE}}',
    				],
    			]
    	   );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'readmore_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap .btn_view',
			]
		);
        $this->add_responsive_control(
			'spacing_btn',
			[
				'label' 		=> esc_html__( 'Margin', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-freelancers-element .jws-freelancers-wap .btn_view' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'freelancers_per_page',
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
					'options'   => $this->get_freelancers_categories(),
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
					'options'   => $this->get_freelancers_tags(),
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
					'post_type' => 'freelancers',
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
					'post_type'   => 'freelancers',
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
				'freelancers_columns',
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
	   jws_elementor_widget_slider_config($this,['freelancers_display' => 'slider']);
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
	protected function get_freelancers_categories() {

		$freelancers_cat = array();

		$cat_args = array(
			'orderby'    => 'name',
			'order'      => 'asc',
			'hide_empty' => false,
		);
      
		$freelancers_categories = get_terms( 'freelancers_cat', $cat_args );
        
        
		if ( ! empty( $freelancers_categories ) ) {

			foreach ( $freelancers_categories as $key => $category ) {

				$freelancers_cat[ $category->slug ] = $category->name;
			}
		}

		return $freelancers_cat;
	}
    /**
	 * Get WooCommerce post Tags.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function get_freelancers_tags() {

		$freelancers_tag = array();

		$tag_args = array(
			'orderby'    => 'name',
			'order'      => 'asc',
			'hide_empty' => false,
		);

		$freelancers_tag = get_terms( 'freelancers_tag', $tag_args );
        
        $freelancers_tag = '';

		if ( ! empty( $freelancers_tag ) ) {

			foreach ( $freelancers_tag as $key => $tag ) {

				$freelancers_tag[ $tag->slug ] = $tag->name;
			}
		}

		return $freelancers_tag;
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
				'post_type'      => 'freelancers',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'paged'          => 1,
				'post__not_in'   => array(),
			];

		    if ( $settings['freelancers_per_page'] > 0 ) {
					$query_args['posts_per_page'] = $settings['freelancers_per_page'];
			}
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : '1';


			if ( 'custom' === $settings['query_type'] ) {

				if ( ! empty( $settings['category_filter'] ) ) {

					$cat_operator = $settings['category_filter_rule'];

					$query_args['tax_query'][] = [
						'taxonomy' => 'freelancers_cat',
						'field'    => 'slug',
						'terms'    => $settings['category_filter'],
						'operator' => $cat_operator,
					];
				}

				if ( ! empty( $settings['tag_filter'] ) ) {

					$tag_operator = $settings['tag_filter_rule'];

					$query_args['tax_query'][] = [
						'taxonomy' => 'freelancers_tag',
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

			$query_args = apply_filters( 'jws_freelancers_query_args', $query_args, $settings );

			$freelancers = new \WP_Query( $query_args );
            
            
            
      $class_row = 'freelancers-content';  
      $class_row .= ' jws-freelancers-'.$settings['freelancers_layouts'].'';
      $class_row .= ' freelancers_ajax_'.$this->get_id().'';
      $class_column = 'jws-freelancers-item';
      $show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
    	$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
        $show_inbox = ($settings['show_inbox'] == 'yes') ? 'show_container' : '';
     
      
      if($settings['freelancers_display'] == 'slider') {
        
            $class_row .= ' swiper jws_freelancers_'.$settings['freelancers_display'].' '.$show_inbox;
            $class_column .= ' swiper-slide';
               
        }else{
          $class_row .= ' row jws-freelancers-'.$settings['freelancers_display']; 
          $class_column .= ' col-xl-'.$settings['freelancers_columns'].'';
          $class_column .= (!empty($settings['freelancers_columns_tablet'])) ? ' col-lg-'.$settings['freelancers_columns_tablet'].'' : ' col-lg-'.$settings['freelancers_columns'].'' ;
          $class_column .= (!empty($settings['freelancers_columns_mobile'])) ? ' col-'.$settings['freelancers_columns_mobile'].'' :  ' col-'.$settings['freelancers_columns'].'';  
        }
      ?>
 
		
		<div class="jws-freelancers-element">
            <div class="<?php echo esc_attr($class_row);?>" >
            <?php if($settings['freelancers_display'] == 'slider') echo '<div class="swiper-wrapper">';?>
                <?php 
                $image_size = !empty($settings['image_size']['width']) && !empty($settings['image_size']['height']) ?  $settings['image_size']['width'].'x'.$settings['image_size']['height'] : 'full';
               
                        if ($freelancers->have_posts()) :
                        $i =0;
                            while ( $freelancers->have_posts() ) :
                        			$freelancers->the_post();
                                    $fr_feedback = get_post_meta(get_the_id(), 'feedback_fr', true);
                                    $total_feedback = 0;
                                    if (is_array($fr_feedback) && !empty($fr_feedback)) {
                                        $total_feedback = count($fr_feedback);
                                    }
                                    $job_author_id = $post->post_author;
                                    $freelancer_id = \Jws_Custom_User::get_freelaner_id( $job_author_id );
                                    $verified = get_post_meta($freelancer_id,'verified', true);
                                     $verified_lable='';
                                     if($verified==true){
                                        $verified_lable= '<span class="verified"><i class="jws-icon-check-circle-fill"></i></span>';
                                     }
                                    echo '<div class="'.$class_column.'">';
                     
                                           include( 'layout/'.$settings['freelancers_layouts'].'.php' );
            
        
                                    echo '</div>';
                            endwhile;    
                        endif;
                    
                	wp_reset_postdata();
                   
                ?>
                <?php if($settings['freelancers_display'] == 'slider') echo '</div>';?>  
                <?php 
                    if($show_arrows && $settings['freelancers_display'] == 'slider') : ?>
  						              
                        <button class="elementor-swiper-button elementor-swiper-button-prev">
                            <?php $this->render_swiper_button( $settings, 'prev' ); ?>
                        </button>
                        <button class="elementor-swiper-button elementor-swiper-button-next">
                         <?php $this->render_swiper_button( $settings, 'next' ); ?>
                        </button>
                    
                  <?php endif;
                if($show_dots && $settings['freelancers_display'] == 'slider'){
                    echo '<div class=" swiper-pagination '.$settings['dots_position'].'" ></div>';
                  }
                ?>  
            </div>
            <?php 
             global $wp_query;
             $number_page = $freelancers->max_num_pages;
             $pagi_number = jws_query_pagination($freelancers);
            if ( $number_page > 1 && $settings['pagination_type'] == 'load_more' ) {
                 wp_enqueue_script( 'isotope');
                  wp_enqueue_script( 'imageload'); 
                 $load_attr = 'data-ajaxify-options=\'{"wrapper":".freelancers_ajax_'.$this->get_id().'","items":"> .jws-freelancers-item","trigger":"click"}\''; 
                  $paged = $freelancers->get('paged') ? $freelancers->get('paged') : 1;
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