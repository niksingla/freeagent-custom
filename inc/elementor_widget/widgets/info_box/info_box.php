<?php
namespace Elementor;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Info_Box extends Widget_Base {

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
		return 'jws_info_box';
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
		return esc_html__( 'Jws Info Box', 'freeagent' );
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
		return 'eicon-info-box';
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
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
	    $this->start_controls_section(
			'setting_section',
			[
				'label' => esc_html__( 'Setting', 'freeagent' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
			'info_layout',
			[
				'label' => esc_html__( 'Layout', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'layout1',
				'options' => [
					'layout1'  => esc_html__( 'Layout 1', 'freeagent' ),
                    'layout2'  => esc_html__( 'Layout 2', 'freeagent' ),
                    'layout3'  => esc_html__( 'Layout 3', 'freeagent' ),
                    'layout4'  => esc_html__( 'Layout 4', 'freeagent' ),
                    'layout5'  => esc_html__( 'Layout 5', 'freeagent' ),
                    'layout6'  => esc_html__( 'Layout 6', 'freeagent' ),
				],
			]
		);
        $this->add_control(
			'box_url',
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
			'content_section',
			[
				'label' => esc_html__( 'Content', 'freeagent' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        

        $this->add_control(
			'info_serial',
			[
				'label' => esc_html__( 'Serial', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '1', 'freeagent' ),
				'placeholder' => esc_html__( 'Type your number here', 'freeagent' ),
                'condition' => ['info_layout'=>'layout1'],
			]
		);
        $this->add_control(
			'info_title',
			[
				'label' => esc_html__( 'Title', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'freeagent' ),
				'placeholder' => esc_html__( 'Type your title here', 'freeagent' ),
			]
		);

        $this->add_control(
			'info_content',
			[
				'label' => esc_html__( 'Content', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Default description', 'freeagent' ),
				'placeholder' => esc_html__( 'Type your description here', 'freeagent' ),
			]
		);
        $this->add_control(
			'info_readmore',
			[
				'label' => esc_html__( 'Readmore', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'READ MORE', 'freeagent' ),
			]
		);
        $this->add_control(
				'align',
				[
					'label' 		=> esc_html__( 'Align', 'freeagent' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'default' 		=> '',
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
							'{{WRAPPER}} .jws-info-box .jws-info-box-inner' => 'text-align: {{VALUE}};',
					],
					'frontend_available' => true,
				]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'icon_section',
			[
				'label' => esc_html__( 'Icon', 'freeagent' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
            $this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
                'condition' => ['info_layout!' => 'layout3'],
			]
		);
        $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'large',
				'separator' => 'none',
                'condition' => ['info_layout!' => 'layout3'],
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

		$this->start_controls_tabs( 'tabs_boxbg_style' );
		$this->start_controls_tab(
			'tab_bg',
			[
				'label' => esc_html__( 'Normal', 'freeagent' ),
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'              => 'box_background',
				'types'             => [ 'classic', 'gradient' ],
				'selector'          => '{{WRAPPER}} .jws-info-box .jws-info-box-inner',
                   'fields_options' => [
                        'background' => [
                            'label' => esc_html__('Background','freeagent')
                        ],
                    ],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_boxbg_hover',
			[
				'label' => esc_html__( 'Hover', 'freeagent' ),
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'              => 'box_background_hover',
				'types'             => [ 'classic', 'gradient' ],
				'selector'          => '{{WRAPPER}} .jws-info-box .jws-info-box-inner:hover',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Background ','freeagent')
                    ],
                ],
			]
		);

 	  $this->end_controls_tab();
	$this->end_controls_tabs();
    $this->add_responsive_control(
					'box_padding',
					[
						'label' 		=> esc_html__( 'Padding', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-info-box .jws-info-box-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->add_responsive_control(
					'box_radius',
					[
						'label' 		=> esc_html__( 'Border Radius', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-info-box .jws-info-box-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'placeholder' => '1px',
				'selector' => '{{WRAPPER}} .jws-info-box .jws-info-box-inner',
				'separator' => 'before',
			]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Box Shadow', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-info-box .jws-info-box-inner',
			]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'label' => esc_html__( 'Box Shadow Hover', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-info-box .jws-info-box-inner:hover',
			]
		);
		$this->end_controls_section();
        $this->start_controls_section(
			'box_number_style',
			[
				'label' => esc_html__( 'Number', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
   
			]
		);
        

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-info-box .jws-info-box-inner .info_serial',
			]
		);
		$this->start_controls_tabs( 'tabs_bg_style' );
		$this->start_controls_tab(
			'tab_boxbg',
			[
				'label' => esc_html__( 'Normal', 'freeagent' ),
			]
		);
        $this->add_control(
			'number_color',
			[
				'label' => esc_html__( 'Number Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-info-box .jws-info-box-inner .box-icon,
                    {{WRAPPER}} .jws-info-box .jws-info-box-inner .info_serial' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'              => 'boxinfo_serial_background',
				'types'             => [ 'classic', 'gradient' ],
				'selector'          => '{{WRAPPER}} .jws-info-box .jws-info-box-inner .info_serial',
                   'fields_options' => [
                        'background' => [
                            'label' => esc_html__('Background Light','freeagent')
                        ],
                    ],
			]
		);
        $this->add_responsive_control(
			'number_padding',
			[
				'label' 		=> esc_html__( 'Padding', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-info-box .jws-info-box-inner .info_serial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

				'separator' => 'before',
				]
		);
        $this->add_responsive_control(
			'number_margin',
			[
				'label' 		=> esc_html__( 'Margin', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-info-box .jws-info-box-inner .info_serial' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

				'separator' => 'before',
				]
		);
        $this->add_responsive_control(
			'number_radius',
			[
				'label' 		=> esc_html__( 'Radius', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-info-box .jws-info-box-inner .info_serial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			
				]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_bg_hover',
			[
				'label' => esc_html__( 'Hover', 'freeagent' ),
			]
		);
  $this->add_control(
			'number_color_hover',
			[
				'label' => esc_html__( 'Number Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-info-box .jws-info-box-inner:hover  .box-icon,
                    {{WRAPPER}} .jws-info-box .jws-info-box-inner:hover  .info_serial' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'              => 'box_backgroundinfo_serial_hover',
				'types'             => [ 'classic', 'gradient' ],
				'selector'          => '{{WRAPPER}} .jws-info-box .jws-info-box-inner:hover .info_serial',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Background Light','freeagent')
                    ],
                ],
			]
		);

 	  $this->end_controls_tab();
	$this->end_controls_tabs();

        $this->end_controls_section();
        $this->start_controls_section(
			'box-content_title_style',
			[
				'label' => esc_html__( 'Content', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_control(
			'box-title_style',
			[
				'label' => esc_html__( 'Title', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-info-box .box-title' => 'color: {{VALUE}}',
				],
			]
		);
  $this->add_control(
			'title_color_hover',
			[
				'label' => esc_html__( 'Color Hover', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-info-box .jws-info-box-inner:hover .box-title' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-info-box .box-title',
			]
		);
        $this->add_responsive_control(
				'title_spacing',
				[
					'label' 		=> esc_html__( 'Spacing', 'freeagent' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' => 1,
							'max' => 100,
							'step' => 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .jws-info-box  .box-title' => 'margin-bottom: {{SIZE}}px;',
					],
				]
		);
        $this->add_control(
			'box-content_style',
			[
				'label' => esc_html__( 'Content', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',

			]
		);
        
        $this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Content Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-info-box .box-content' => 'color: {{VALUE}}',
				],
			]
		);
                $this->add_control(
			'content_color_hover',
			[
				'label' => esc_html__( 'Content Color Hover', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-info-box .jws-info-box-inner:hover .box-content' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-info-box .box-content',
			]
		);
        $this->add_responsive_control(
				'content_spacing',
				[
					'label' 		=> esc_html__( 'Spacing', 'freeagent' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' => 1,
							'max' => 100,
							'step' => 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .jws-info-box .jws-info-box-inner .box-content' => 'margin-bottom: {{SIZE}}px;',
					],
				]
		);
        $this->add_responsive_control(
			'content_padding',
			[
				'label' 		=> esc_html__( 'Padding', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-info-box .jws-info-box-inner .box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

				'separator' => 'before',
			]
		);

        $this->end_controls_section();
        
        $this->start_controls_section(
			'box-icon_style',
			[
				'label' => esc_html__( 'Icon', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-info-box .box-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .jws-info-box .box-icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);
    $this->add_control(
			'icon_hover_color',
			[
				'label' => esc_html__( 'Icon Hover Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-info-box jws-info-box-inner:hover .box-icon' => 'color: {{VALUE}}',
                    	'{{WRAPPER}} .jws-info-box .jws-info-box-inner:hover .box-icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'              => 'icon_bgcolor',
				'types'             => [ 'classic', 'gradient' ],
				'selector'          => '{{WRAPPER}} .jws-info-box .box-icon',
			]
		);
         $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'              => 'icon_hdover_bgcolor',
                	'label' 		=> esc_html__( 'Background Hover', 'freeagent' ),
				'types'             => [ 'classic', 'gradient' ],
				'selector'          => '{{WRAPPER}} .jws-info-box .jws-info-box-inner:hover .box-icon',
			]
		);
        $this->add_responsive_control(
				'icon_size',
				[
					'label' 		=> esc_html__( 'Icon Size', 'freeagent' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' => 1,
							'max' => 100,
							'step' => 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .jws-info-box .box-icon' => 'font-size: {{SIZE}}px;',
                        '{{WRAPPER}} .jws-info-box .box-icon svg' => 'width: {{SIZE}}px;',
					],
				]
		);
         $this->add_responsive_control(
				'icon_width',
				[
					'label' 		=> esc_html__( 'width', 'freeagent' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' => 1,
							'max' => 100,
							'step' => 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .jws-info-box .box-icon' => 'min-width:{{SIZE}}px;min-height:{{SIZE}}px;line-height:{{SIZE}}px;',
					],
				]
		);
 
          $this->add_responsive_control(
					'image_icon_border_radius',
					[
						'label' 		=> esc_html__( 'Radius', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-info-box .jws-info-box-inner .box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						
					]
		);
        $this->add_responsive_control(
					'image_icon_padding',
					[
						'label' 		=> esc_html__( 'Padding', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-info-box .jws-info-box-inner .box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

					]
		);
        $this->add_responsive_control(
					'image_icon_marign',
					[
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-info-box .box-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

					
					]
		);
            $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_icon',
				'placeholder' => '1px',
				'selector' => '{{WRAPPER}} .jws-info-box .box-icon',
				'separator' => 'before',
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'box_readmore_style',
			[
				'label' => esc_html__( 'Read More', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_control(
			'readmore_color',
			[
				'label' => esc_html__( 'Readmore Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-info-box .jws-info-box-inner .box-more' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'readmore_color_hover',
			[
				'label' => esc_html__( 'Readmore Color Hover', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-info-box .jws-info-box-inner .box-more:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'readmore_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-info-box .jws-info-box-inner .box-more',
			]
		);
        $this->add_responsive_control(
					'readmore_marign',
					[
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-info-box .jws-info-box-inner .box-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->end_controls_section();
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
	   
		$settings = $this->get_settings_for_display();
        $url = $settings['box_url']['url'];
        $target = $settings['box_url']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['box_url']['nofollow'] ? ' rel="nofollow"' : '';  
         ?>
            <div class="jws-info-box <?php echo esc_attr($settings['info_layout']); ?>">
                <div class="jws-info-box-inner">
                    <?php include( 'layout/'.$settings['info_layout'].'.php' ); ?>
                </div>
            </div>
        <?php

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