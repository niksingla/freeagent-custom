<?php
namespace Elementor;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Video_popup extends Widget_Base {

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
		return 'jws_video_popup';
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
		return esc_html__( 'Jws Video Popup', 'freeagent' );
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
		return 'eicon-video-camera';
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
     * Load style
     */
    public function get_style_depends()
    {
        return [];
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
        return [];
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
			'section_video_popup_setting',
			[
				'label' => esc_html__( 'Setting', 'freeagent' ),
			]
		);
        $this->add_control(
				'skins',
				[
					'label'     => esc_html__( 'Skins', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'overlay',
					'options'   => [
                        'overlay'   => esc_html__( 'Overlay', 'freeagent' ),
						'border_ani'   => esc_html__( 'Border Animation', 'freeagent' ),
                        'border'   => esc_html__( 'Border', 'freeagent' ),
					],
				]
		);
        $this->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'freeagent' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fab fa-wordpress',
                		'library' => 'fa-brands',
					],
				]
		);
        $this->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'freeagent' ),
				'type' =>  Controls_Manager::TEXT,
				'default' => esc_html__( 'Watch out presentation', 'freeagent' ),
			]
          
		);
        $this->add_control(
			'url',
			[
				'label' => esc_html__( 'URl Video', 'freeagent' ),
				'type' =>  Controls_Manager::TEXT,
				'default' => esc_html__( 'https://www.youtube.com/watch?v=JtVd7q25FDA', 'freeagent' ),
			]
          
		);
        $this->add_responsive_control(
				'align',
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
							'{{WRAPPER}} .jws_video_popup' => 'text-align: {{VALUE}};',
					],
					'frontend_available' => true,
				]
		);
		$this->end_controls_section();
        $this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Toggle Style', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->start_controls_tabs( 'tabs_video_style' );

		$this->start_controls_tab(
			'tab_video_normal',
			[
				'label' => esc_html__( 'Normal', 'freeagent' ),
			]
		);
        $this->add_control(
					'icon_color',
					[
						'label' 	=> esc_html__( ' Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .jws_video_popup .jws_video_popup_inner a,
                            {{WRAPPER}} .jws_video_popup .jws_video_popup_inner .text' => 'color: {{VALUE}};',
						],
					]
		);
        
        $this->add_control(
			'icon_type',
			[
				'label' => esc_html__( 'Icon Background Type', 'freeagent' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'classic'    => [
						'title' => esc_html__( 'Classic', 'freeagent' ),
						'icon' => 'eicon-paint-brush',
					],
					'gradient' => [
						'title' => esc_html__( 'Gradient', 'freeagent' ),
						'icon' => 'eicon-barcode',
					],
				],
				'default' => '',
			]
		);
        $this->add_control(
			'icon_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .jws_video_popup .jws_video_popup_inner a .video_icon' => 'background:{{VALUE}};',
                   
				],
				'default' => '',
                'condition' => [
					'icon_type' => 'classic',
				],
			]
		);
        $this->add_control(
			'icon_bggradient_color',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
                'condition' => [
					'icon_type' => 'gradient',
				],
			]
		);
        $this->add_control(
			'icon_bggradient_color2',
			[
				'label' => esc_html__( 'Background Second Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws_video_popup .jws_video_popup_inner a .video_icon' => 'background-image: linear-gradient(to right, {{icon_bggradient_color.VALUE}} 0%, {{VALUE}} 51%, {{icon_bggradient_color.VALUE}} 100%);background-size: 200% auto;',
                    '{{WRAPPER}} .jws_video_popup .jws_video_popup_inner a:hover .video_icon' => 'background-position: right center;',
				],
                'condition' => [
					'icon_type' => 'gradient',
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
						'{{WRAPPER}} .jws_video_popup .jws_video_popup_inner a .video_icon' => 'font-size: {{SIZE}}px;',
					],
				]
		);
        $this->add_control(
				'icon_width_height',
				[
					'label' 		=> esc_html__( 'Icon Width Height', 'freeagent' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' => 40,
							'max' => 200,
							'step' => 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .jws_video_popup .jws_video_popup_inner a .video_icon' => 'height: {{SIZE}}px;line-height: {{SIZE}}px;width: {{SIZE}}px;',
                        '{{WRAPPER}} .jws_video_popup .jws_video_popup_inner a .video_icon:before' => 'height: calc({{SIZE}}px + 30px); width: calc({{SIZE}}px + 30px);',
                        '{{WRAPPER}} .jws_video_popup .jws_video_popup_inner a .video_icon:after' => 'height: calc({{SIZE}}px + 30px); width: calc({{SIZE}}px + 30px);',
					],
                    'condition' => [
						 'skins' => 'overlay',
				    ],
				]
		);
        $this->add_responsive_control(
				'icon_width_height_border_ani',
				[
					'label' 		=> esc_html__( 'Icon Width Height', 'freeagent' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' => 40,
							'max' => 200,
							'step' => 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .jws_video_popup .jws_video_popup_inner a .video_icon' => 'height: {{SIZE}}px;line-height: {{SIZE}}px;width: {{SIZE}}px;',
                        '{{WRAPPER}} .jws_video_popup .jws_video_popup_inner a .video_icon:before' => 'height:{{SIZE}}px; width:{{SIZE}}px;',
                        '{{WRAPPER}} .jws_video_popup .jws_video_popup_inner a .video_icon:after' => 'height: {{SIZE}}px; width:{{SIZE}}px;',
					],
                    'condition' => [
						 'skins' => 'border_ani',
				    ],
				]
		);
        $this->add_responsive_control(
				'icon_width_height_border',
				[
					'label' 		=> esc_html__( 'Icon Width Height', 'freeagent' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' => 40,
							'max' => 200,
							'step' => 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .jws_video_popup .jws_video_popup_inner a .video_icon' => 'height: {{SIZE}}px;line-height: {{SIZE}}px;width: {{SIZE}}px;',
                        '{{WRAPPER}} .jws_video_popup .jws_video_popup_inner a .video_icon:before' => 'height: calc({{SIZE}}px + 20px); width: calc({{SIZE}}px + 20px);',
					],
                    'condition' => [
						 'skins' => 'border',
				    ],
				]
		);

        $this->add_control(
					'icon_bgcolor2',
					[
						'label' 	=> esc_html__( 'Icon Background Overlay Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .jws_video_popup .jws_video_popup_inner a:before ,
                             {{WRAPPER}} .jws_video_popup .jws_video_popup_inner a:after' => 'background: {{VALUE}};',
                   '{{WRAPPER}} .video-border_ani .jws_video_popup_inner a::before,
                   {{WRAPPER}} .video-border_ani .jws_video_popup_inner a::after,{{WRAPPER}} .video-border .jws_video_popup_inner a::before' => 'border: 2px solid {{VALUE}}',
						],
                        'condition' => [
						  'skins' => 'overlay',
				        ],
					]
		);
        $this->add_control(
					'icon_border_ani_color',
					[
						'label' 	=> esc_html__( 'Icon Border Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .jws_video_popup.video-border .jws_video_popup_inner a:before' => 'border-color: {{VALUE}};',
						],
                        'condition' => [
						  'skins' => 'border',
				        ],
					]
		);
        $this->add_control(
					'icon_border_ani_color2',
					[
						'label' 	=> esc_html__( 'Icon Border Color Animation', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .jws_video_popup.video-border .jws_video_popup_inner a:before' => 'border-color: {{VALUE}};',
						],
                        'condition' => [
						  'skins' => 'border',
				        ],
					]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(), [
				'name' => 'icon_border',
				'selector' => '{{WRAPPER}} .jws_video_popup .jws_video_popup_inner a .video_icon',
			]
		);
                $this->add_control(
			'text_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Text', 'freeagent' ),
				'separator' => 'before',
			]
		);
        $this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .jws_video_popup .jws_video_popup_inner .text' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .jws_video_popup .jws_video_popup_inner .text',
			]
		);
            $this->add_responsive_control(
			'text_margin',
			[
				'label' 		=> esc_html__( 'Margin', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws_video_popup .jws_video_popup_inner .text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			
			]
		);
        $this->end_controls_tab();

		$this->start_controls_tab(
			'tab_video_hover',
			[
				'label' => esc_html__( 'Hover', 'freeagent' ),
			]
		);
        
      
       $this->add_control(
					'icon_color_hover',
					[
						'label' 	=> esc_html__( ' Color Hover', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '#ed2121',
						'selectors' => [
							'{{WRAPPER}} .jws_video_popup .jws_video_popup_inner a:hover,
                            {{WRAPPER}} .jws_video_popup .jws_video_popup_inner:hover .text' => 'color: {{VALUE}};',
						],
					]
		);
        
        $this->add_control(
			'icon_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .jws_video_popup .jws_video_popup_inner a:hover span' => 'background:{{VALUE}};',
				],
				'default' => '',
                'condition' => [
					'icon_type' => 'classic',
				],
			]
		);


        $this->end_controls_tab();

		$this->end_controls_tabs();
        
         
    
        
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

        $url = $settings['url'];
       
     
        include( 'content.php' );

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