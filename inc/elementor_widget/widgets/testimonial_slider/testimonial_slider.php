<?php
namespace Elementor;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Testimonial_Slider extends Widget_Base {

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
		return 'jws_testimonial_slider';
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
		return esc_html__( 'Jws Testimonial Slider', 'freeagent' );
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
		return 'eicon-testimonial';
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
			'content_section',
			[
				'label' => esc_html__( 'Testimonial List', 'freeagent' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
            $this->add_control(
				'slider_layouts_style',
				[
					'label'     => esc_html__( 'Layout Style', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'slider',
					'options'   => [
						'slider'   => esc_html__( 'Slider', 'freeagent' ),
						'grid'   => esc_html__( 'Grid', 'freeagent' ),				],
				]
		);
        $this->add_control(
				'slider_layouts',
				[
					'label'     => esc_html__( 'Layout', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'layout1',
					'options'   => [
						'layout1'   => esc_html__( 'layout 1', 'freeagent' ),
						'layout2'   => esc_html__( 'layout 2', 'freeagent' ),
                        'layout3'   => esc_html__( 'layout 3', 'freeagent' ),
                        'layout4'   => esc_html__( 'layout 4', 'freeagent' ),
                        'layout5'   => esc_html__( 'Testimonial Video', 'freeagent' ),
  				      ],
				]
		);
 		$this->add_control(
			'show_indicator',
			[
				'label'        => esc_html__( 'Show Indicator', 'freeagent' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
                'condition' => ['slider_layouts_style'=>'slider'],
			]
		);
      $this->add_control(
        'image_size',
        [
            'label' => __( 'Image Size', 'freeagent' ),
            'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
            'description' => __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'freeagent' ),
            
            ]
    );      
		$repeater = new \Elementor\Repeater();
        $repeater->add_control(
			'logo',
			[
				'label' => esc_html__( 'Choose Logo Company', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
        $repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Avatar', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'list_color',
			[
				'label' => esc_html__( 'Background', 'freeagent' ),
				'type' =>\Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.slider-content' => 'background: {{VALUE}} ',
                    
				],
                'label_block' => true,
			]
		);
        $repeater->add_control(
			'list_url',
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
		$repeater->add_control(
			'list_name', [
				'label' => esc_html__( 'Name', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Name' , 'freeagent' ),
				'label_block' => true,
			]
		);
        $repeater->add_control(
			'list_job', [
				'label' => esc_html__( 'Job', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Job' , 'freeagent' ),
				'label_block' => true,
			]
		);
        $repeater->add_control(
			'list_description', [
				'label' => esc_html__( 'Description', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Default description', 'freeagent' ),
				'placeholder' => esc_html__( 'Type your description here', 'freeagent' ),
			]
		);


		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Menu List', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_name' => esc_html__( 'Name #1', 'freeagent' ),
					],
				],
				'title_field' => '{{{ list_name }}}',
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_grid_options',
			[
				'label'     => esc_html__( 'Grid Options', 'freeagent' ),
				'type'      => Controls_Manager::SECTION,
                 'condition' => ['slider_layouts_style'=>'grid'],
			]
		);
		$this->add_responsive_control(
				'testimonial_columns',
				[
					'label'          => esc_html__( 'Columns', 'freeagent' ),
					'type'           => Controls_Manager::SELECT,
                    
					'default'        => '4',
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
        
        jws_elementor_widget_slider_config($this,['slider_layouts_style' => 'slider']);
        $this->start_controls_section(
			'testimonials_slider_style',
			[
				'label' => esc_html__( 'Content', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
            $this->add_control(
				'box_align',
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
                            '{{WRAPPER}} .slider-content .footer_testimonial ' => 'justify-content: {{VALUE}};',
					],
					'frontend_available' => true,
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
					'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .jws_testimonial_item' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
                   
				],
			]
		);
               $this->add_responsive_control(
			'row_gap',
			[
				'label'     => esc_html__( 'Row Gap', 'freeagent' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .jws_testimonial_item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					
                   
				],
			]
		);
        $this->add_responsive_control(
			'width_slider',
			[
				'label'     => esc_html__( 'Width Slider', 'freeagent' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 300,
						'max' => 1920,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .testimonials_slider .slick-list' => 'max-width:{{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
					'box_bgcolor',
					[
						'label' 	=> esc_html__( 'Box Background Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .slider-content' => 'background: {{VALUE}} !important;',
						],
					]
		);
        $this->add_control(
			'box_hover_bgcolor',
			[
				'label' 	=> esc_html__( 'Background Hover Color', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .slider-content:hover' => 'background: {{VALUE}} !important;',
				],
			]
		);
    $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'testimonials_slider_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws_testimonials_slider_wrap .slider-content',
			]
		);
        $this->add_responsive_control(
					'testimonials_slider_margin',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .slider-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
        
        $this->add_responsive_control(
					'testimonials_slider_padding',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Padding', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .slider-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
        $this->add_responsive_control(
					'testimonials_slider_radius',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Border-radius', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .slider-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
        $this->add_control(
			'testimonials_slider_des',
			[
				'label' => esc_html__( 'Description', 'freeagent' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
					'testimonials_slider_description_color',
					[
						'label' 	=> esc_html__( 'Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider  .testimonials-description' => 'color: {{VALUE}} !important;',
						],
					]
		);
        $this->add_control(
			'testimonials_slider_description_hover_color',
			[
				'label' 	=> esc_html__( 'Hover Color', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .slider-content:hover .testimonials-description' => 'color: {{VALUE}} !important;',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'testimonials_slider_description_typography',
				'label' => esc_html__( 'Typography', 'freeagent'),
				'selector' => '{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials-description',
			]
		);
         $this->add_responsive_control(
					'description_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

					]
		);
        $this->add_control(
			'testimonials_slider_name',
			[
				'label' => esc_html__( 'Name', 'freeagent' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
				'infor_align',
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
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials-info' => 'text-align: {{VALUE}};',
					],
					'frontend_available' => true,
				]
		);
        $this->add_control(
					'testimonials_slider_name_color',
					[
						'label' 	=> esc_html__( 'Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials_title' => 'color: {{VALUE}};',
						],
					]
		);
        $this->add_control(
			'testimonials_slider_name_hover_color',
			[
				'label' 	=> esc_html__( 'Color', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_testimonials_slider_wrap .slider-content:hover .testimonials_title' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'testimonials_slider_name_typography',
				'label' => esc_html__( 'Typography', 'freeagent'),
				'selector' => '{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials_title',
			]
		);
        $this->add_responsive_control(
					'name_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						
					]
		);
        $this->add_control(
			'testimonials_slider_job',
			[
				'label' => esc_html__( 'Job', 'freeagent' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
					'testimonials_slider_job_color',
					[
						'label' 	=> esc_html__( 'Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						
						'selectors' => [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials_job' => 'color: {{VALUE}};',
						],
					]
		);
        $this->add_control(
			'testimonials_slider_job_hover_color',
			[
				'label' 	=> esc_html__( 'Hover Color', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				
				'selectors' => [
					'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .slider-content:hover .testimonials_job' => 'color: {{VALUE}};',
				],
			]
		);
        
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'testimonials_slider_job_typography',
				'label' => esc_html__( 'Typography', 'freeagent'),
				'selector' => '{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials_job',
			]
		);
        $this->add_responsive_control(
					'job_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider .testimonials_job' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

					]
		);
         $this->add_control(
			'testimonials_slider_icon',
			[
				'label' => esc_html__( 'Icon', 'freeagent' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
					'icon_color',
					[
						'label' 	=> esc_html__( 'Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .testimonials_slider .testimonials_icon' => 'color: {{VALUE}};',
						],
					]
		);
        
            $this->add_control(
				'icon_hover_color',
				[
					'label' 	=> esc_html__( 'Hover Color', 'freeagent' ),
					'type' 		=> Controls_Manager::COLOR,
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}} .testimonials_slider .slider-content:hover .testimonials_icon' => 'color: {{VALUE}};',
					],
				]
		);
         $this->add_control(
					'icon_bgcolor',
					[
						'label' 	=> esc_html__( 'Icon Background Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .testimonials_slider .testimonials_icon' => 'background: {{VALUE}} !important;',
						],
					]
		);
        $this->add_control(
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
						'{{WRAPPER}} .testimonials_slider .testimonials_icon' => 'font-size: {{SIZE}}px;',
					],
				]
		);
        $this->add_responsive_control(
					'icon_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .testimonials_slider .testimonials_icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

					
					]
		);
        $this->add_control(
			'testimonials_slider_avatar',
			[
				'label' => esc_html__( 'Avatar', 'freeagent' ),
				'type' => Controls_Manager::HEADING,
			
			]
		);
        $this->add_responsive_control(
					'avatar_size',
					[
						'label' 		=> esc_html__( 'Size avatar', 'freeagent' ),
                        'type' 			=> Controls_Manager::SLIDER,
    					'range' 		=> [
    						'px' 		=> [
    							'min' => 1,
    							'max' => 100,
    							'step' => 1,
    						],
    					],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .slider-content img' => 'max-width:{{SIZE}}px;max-height:{{SIZE}}px;',
						],

					
					]
		);
        $this->add_responsive_control(
					'testimonials_slider_avatar_box_radius',
					[
						'label' 		=> esc_html__( 'Border Radius', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

					]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'testimonials_slider_avatar_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws_testimonials_slider_wrap .testimonials_slider img',
			]
		);
       
        $this->end_controls_section();
        $this->start_controls_section(
			'testimonials_slider_dot_style',
			[
				'label' => esc_html__( 'Dots', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
  $this->add_control(
			'dot_align',
			[
				'label' 		=> esc_html__( ' Align', 'freeagent' ),
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
						'{{WRAPPER}} .jws_testimonials_slider_wrap  .custom_dots' => 'text-align: {{VALUE}};',
				],
				'frontend_available' => true,
			]
		);

        $this->add_control(
			'dot_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                
					'{{WRAPPER}} .custom_dots .slider-dots button:after' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'dot_bg_color',
			[
				'label' => esc_html__( 'Active Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                
					'{{WRAPPER}} .custom_dots .slider-dots .slick-active button:after' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .custom_dots .slider-dots .slick-active button:before' => 'border-color: {{VALUE}}',
				],
			]
		);
        
        
         $this->add_responsive_control(
			'dot_margin',
			[
				'label'      => esc_html__( 'margin', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
				    '{{WRAPPER}} .jws_testimonials_slider_wrap  .custom_dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
                $this->start_controls_section(
			'testimonials_slider_nav_style',
			[
				'label' => esc_html__( 'Navs', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'arrow_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                
					'{{WRAPPER}} .jws_testimonials_slider_wrap .jws-carousel-btn' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'arrow_color_hover',
			[
				'label' => esc_html__( 'Color Hover', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                
					'{{WRAPPER}} .jws_testimonials_slider_wrap .jws-carousel-btn:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'arrow_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                
					'{{WRAPPER}} .jws_testimonials_slider_wrap  .jws-carousel-btn' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'arrow_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color Hover', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                
					'{{WRAPPER}} .jws_testimonials_slider_wrap  .jws-carousel-btn:hover' => 'background: {{VALUE}}',
				],
			]
		);
        $this->add_responsive_control(
			'size_button',
			[
				'label' =>  esc_html__( 'Size box', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 2,
					],
				],

				'selectors' => [
					'{{WRAPPER}} .jws_testimonials_slider_wrap  .jws-carousel-btn' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
        );
        $this->add_responsive_control(
            'arrow_margin',
            [
                'label'         => esc_html__('Margin', 'freeagent'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .jws_testimonials_slider_wrap  .jws-nav-carousel' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
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
		$settings = $this->get_settings();
       
        
            $classes = $settings['slider_layouts'];
            $classes .= isset($settings['thumbnail_slider_position']) ? ' thumbnail_position_'.$settings['thumbnail_slider_position'] : '';
            $show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
    		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
            $show_inbox = ($settings['show_inbox'] == 'yes') ? 'show_container' : '';
            $class_column = 'jws_testimonial_item';
          
                if($settings['slider_layouts_style'] == 'grid') { 
                    $row = 'row'; 
                   $class_column .= ' col-xl-'.$settings['testimonial_columns'].'';
                  $class_column .= (!empty($settings['testimonial_columns_tablet'])) ? ' col-lg-'.$settings['testimonial_columns_tablet'].'' : ' col-lg-'.$settings['testimonial_columns'].'' ;
                  $class_column .= (!empty($settings['testimonial_columns_mobile'])) ? ' col-'.$settings['testimonial_columns_mobile'].'' :  ' col-'.$settings['testimonial_columns'].'';
              }
            
             if($settings['slider_layouts_style'] == 'slider') { 
                $row = ' jws_testimonials_slider swiper '.$show_inbox;
                $class_column .= ' swiper-slide';
               
	       }
                     $image_size = !empty($settings['image_size']['width']) && !empty($settings['image_size']['height']) ?  $settings['image_size']['width'].'x'.$settings['image_size']['height'] : 'full';

		if ( $settings['list'] ) {
		   
             ?>
           
		      	<div class="jws_testimonials_slider_wrap <?php echo esc_attr($classes); ?>">
                  <div class=" testimonials_slider  <?php echo esc_attr($row);?>  <?php echo 'slider_layout_'.$settings['slider_layouts_style'] .''; ?> <?php echo ' slider_layout_'.$settings['slider_layouts'] .''; ?>"  >  
                   <?php if($settings['slider_layouts_style'] == 'slider') echo '<div class="swiper-wrapper">';?>
                		  <?php foreach (  $settings['list'] as $item ) {
                		      $url = $item['list_url']['url'];
                              $target = $item['list_url']['is_external'] ? ' target="_blank"' : '';
                              $nofollow = $item['list_url']['nofollow'] ? ' rel="nofollow"' : ''; 
                             
                              ?>
                				<div class=" <?php echo esc_attr($class_column);?> ">
                                        <?php  include( 'layout/'.$settings['slider_layouts'].'.php' ); ?>   
                                </div>
                		  <?php } ?>
                            <?php if($settings['slider_layouts_style'] == 'slider') echo '</div>';?>
                             <?php if($show_arrows && $settings['slider_layouts_style'] == 'slider') : ?>
                                <button class="elementor-swiper-button elementor-swiper-button-prev">
                                 <?php $this->render_swiper_button( $settings, 'prev' ); ?>
                                </button>
                                <button class="elementor-swiper-button elementor-swiper-button-next">
                                 <?php $this->render_swiper_button( $settings, 'next' ); ?>
                                </button>
                            <?php endif; ?>
                            <?php  if($show_dots && $settings['slider_layouts_style'] == 'slider') echo '<div class="swiper-pagination"></div>';?>
                      </div>
                  </div>


                  

		    <?php }  
		
	}
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