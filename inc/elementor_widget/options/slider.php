<?php

/**
 * @author lolkittens
 * @copyright 2023
 */



?><?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

defined( 'ABSPATH' ) || die();

function jws_elementor_widget_slider_config($element,$condition = '') {
        $swiper_class = 'swiper';  
    	$element->start_controls_section(
			'section_slider_options',
			array(
				'label' => esc_html__( 'Slider Options', 'freeagent' ),
                'condition' =>  $condition,
			)
		);
        $element->add_control(
				'align_vertical',
				[
					'label' 		=> esc_html__( 'Vertical Align', 'freeagent' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'options' 		=> [
						'flex-start'    		=> [
							'title' 	=> esc_html__( 'Top', 'freeagent' ),
							'icon' 		=> 'eicon-v-align-top',
						],
						'baseline' 		=> [
							'title' 	=> esc_html__( 'Baseline', 'freeagent' ),
							'icon' 		=> ' eicon-v-align-middle',
						],
						'flex-end' 		=> [
							'title' 	=> esc_html__( 'Bottom', 'freeagent' ),
							'icon' 		=> ' eicon-v-align-bottom',
						],
					],
                    'selectors' => [
							'{{WRAPPER}} .swiper-wrapper'  => 'align-items: {{VALUE}};',
					],
					'frontend_available' => true,
				]
		);
		$element->add_responsive_control(
				'slides_to_show',
				array(
					'label'              => esc_html__( 'Slides to Show', 'freeagent' ),
					'type'               => Controls_Manager::NUMBER,
					'min'                => 1,
					'max'                => 10,
					'step'               => 1,
					'default'            => 1,
					'frontend_available' => true,
					'render_type'        => 'template',
					'selectors'          => array(
						'{{WRAPPER}} .elementor-main-swiper:not(.' . $swiper_class . '-initialized) .swiper-slide' => 'max-width: calc(100% / var(--alpus-nested-carousel-slides-to-show, 1));',
						'{{WRAPPER}}' => '--alpus-nested-carousel-slides-to-show: {{VALUE}}',
					),
				)
			);

			$element->add_responsive_control(
				'slides_to_scroll',
				array(
					'label'       => esc_html__( 'Slides to Scroll', 'freeagent' ),
					'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'freeagent' ),
					'type'        => Controls_Manager::NUMBER,
					'min'         => 1,
					'max'         => 10,
					'step'        => 1,
					'condition' => array(
						'slides_to_show!' => 1,
					),
					'frontend_available' => true,
				)
			);
			
			$element->add_responsive_control(
				'slide_spacing',
				array(
					'label' => esc_html__( 'Space Between', 'freeagent' ) . ' (px)',
					'type'  => Controls_Manager::SLIDER,
					'range' => array(
						'px' => array(
							'max' => 100,
						),
					),
					'frontend_available' => true,
					'render_type'        => 'none',
					'condition'          => array(
						'transition!' => array( 'fade', 'cube', 'flip', 'cards', 'creative', 'creative2', 'creative3', 'creative4' ),
					),
				)
			);

			$element->add_control(
				'navigation',
				array(
					'label'   => esc_html__( 'Navigation', 'freeagent' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'both',
					'options' => array(
						'both'   => esc_html__( 'Arrows and Dots', 'freeagent' ),
						'arrows' => esc_html__( 'Arrows', 'freeagent' ),
						'dots'   => esc_html__( 'Dots', 'freeagent' ),
						'none'   => esc_html__( 'None', 'freeagent' ),
					),
					'frontend_available' => true,
				)
			);
			$element->add_control(
				'show_inbox',
				array(
					'label'              => esc_html__( 'Show Container', 'freeagent' ),
					'type'               => Controls_Manager::SWITCHER,
					'frontend_available' => true,
				)
			);

			$element->add_control(
				'autoplay',
				array(
					'label'              => esc_html__( 'Autoplay', 'freeagent' ),
					'type'               => Controls_Manager::SWITCHER,
					'frontend_available' => true,
				)
			);

			$element->add_control(
				'pause_on_hover',
				array(
					'label'              => esc_html__( 'Pause on Hover', 'freeagent' ),
					'type'               => Controls_Manager::SWITCHER,
					'render_type'        => 'none',
					'frontend_available' => true,
					'condition'          => array(
						'autoplay!' => '',
					),
				)
			);

			$element->add_control(
				'pause_on_interaction',
				array(
					'label'              => esc_html__( 'Pause on Interaction', 'freeagent' ),
					'type'               => Controls_Manager::SWITCHER,
					'render_type'        => 'none',
					'frontend_available' => true,
					'condition'          => array(
						'autoplay!' => '',
					),
				)
			);

			$element->add_control(
				'autoplay_speed',
				array(
					'label'     => esc_html__( 'Autoplay Speed', 'freeagent' ) . ' (ms)',
					'type'      => Controls_Manager::NUMBER,
					'default'   => 5000,
					'condition' => array(
						'autoplay' => 'yes',
					),
					'selectors' => array(
						'{{WRAPPER}} .swiper-slide' => 'transition-duration: calc({{VALUE}}ms*1.2)',
					),
					'render_type'        => 'none',
					'frontend_available' => true,
					'separator'          => 'after',
				)
			);

			$element->add_control(
				'infinite',
				array(
					'label'              => esc_html__( 'Infinite Loop', 'freeagent' ),
					'type'               => Controls_Manager::SWITCHER,
					'frontend_available' => true,
				)
			);

			$element->add_control(
				'center_mode',
				array(
					'label'              => esc_html__( 'Center Mode', 'freeagent' ),
					'type'               => Controls_Manager::SWITCHER,
					'frontend_available' => true,
					'condition' => array(
						'transition' => array( 'slide', 'coverflow', 'coverflow2' ),
					),
				)
			);
			$element->add_control(
				'disable_drag',
				array(
					'label'              => esc_html__( 'Disable Mouse Drag', 'freeagent' ),
					'type'               => Controls_Manager::SWITCHER,
					'frontend_available' => true,
				)
			);			

		
				$element->add_control(
					'transition',
					array(
						'label'   => esc_html__( 'Transition', 'freeagent' ),
						'type'    => Controls_Manager::SELECT,
						'default' => 'slide',
						'options' => array(
							'slide'     => esc_html__( 'Slide', 'freeagent' ),
							'fade'      => esc_html__( 'Fade (Slides To Show = 1)', 'freeagent' ),
							'cube'      => esc_html__( 'Cube (Slides To Show = 1)', 'freeagent' ),
							'coverflow' => esc_html__( 'Coverflow (Slides To Show > 2)', 'freeagent' ),
							'coverflow2' => esc_html__( 'Coverflow 2 (Slides To Show > 2)', 'freeagent' ),
							'flip'      => esc_html__( 'Flip (Slides To Show = 1)', 'freeagent' ),
							'cards'     => esc_html__( 'Cards (Slides To Show = 1)', 'freeagent' ),
							'creative'  => esc_html__( 'Creative (Slides To Show = 1)', 'freeagent' ),
							'creative2' => esc_html__( 'Creative 2 (Slides To Show = 1)', 'freeagent' ),
							'creative3' => esc_html__( 'Creative 3 (Slides To Show = 1)', 'freeagent' ),
							'creative4' => esc_html__( 'Creative 4 (Slides To Show = 1)', 'freeagent' ),
						),
						'frontend_available' => true,
						'label_block'        => true,
					)
				);
		
			$element->add_control(
				'transition_notice',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => esc_html__( '\'Slides To Show\' option should be 1.', 'freeagent' ),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
					'condition'       => array(
						'transition!'  => array( 'slide', 'coverflow', 'coverflow2' ),
					)
				)
			);
			$element->add_control(
				'transition_speed',
				array(
					'label'              => esc_html__( 'Transition Speed', 'freeagent' ) . ' (ms)',
					'type'               => Controls_Manager::NUMBER,
					'default'            => 500,
					'render_type'        => 'none',
					'frontend_available' => true,
				)
			);

		$element->end_controls_section();
        
        $element->start_controls_section(
			'section_style_slider',
			array(
				'label'     => esc_html__( 'Slider Container', 'freeagent' ),
				'tab'       => Controls_Manager::TAB_STYLE,
                'condition' =>  $condition,                
			)
		);
        
        $element->add_responsive_control(
			'slider_padding',
			[
				'label' 		=> esc_html__( 'Spacing', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .swiper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

				'separator' => 'before',
			]
		);                
        
        $element->end_controls_section(); 
        
        $element->start_controls_section(
			'section_style_arrow',
			array(
				'label'     => esc_html__( 'Arrows', 'freeagent' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'navigation' => array( 'arrows', 'both' ),
				),
			)
		);

			$element->add_control(
				'arrow_icon_prev',
				array(
					'label'            => esc_html__( 'Prev Icon', 'freeagent' ),
					'type'             => Controls_Manager::ICONS,
					'skin'             => 'inline',
					'label_block'      => false,
					'default'          => array(
						'value'   => 'jws-icon-arrow-left-2',
						'library' => 'jws_icon',
					),
				)
			);
			$element->add_control(
				'arrow_icon_next',
				array(
					'label'            => esc_html__( 'Next Icon', 'freeagent' ),
					'type'             => Controls_Manager::ICONS,
					'skin'             => 'inline',
					'label_block'      => false,
					'default'          => array(
						'value'   => 'jws-icon-arrow-right-2',
						'library' => 'jws_icon',
					),
				)
			);			

			$element->add_control(
				'arrows_position',
				array(
					'label'   => esc_html__( 'Position', 'freeagent' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'inside',
					'options' => array(
						'inside'  => esc_html__( 'Inside', 'freeagent' ),
						'outside' => esc_html__( 'Outside', 'freeagent' ),
                        'top' => esc_html__( 'Top', 'freeagent' ),
						'custom'  => esc_html__( 'Custom', 'freeagent' ),
					),
					'condition' => array(
						'transition' => array( 'slide', 'fade' ),
					),
				)
			);
			$element->add_control(
				'arrows_position_2',
				array(
					'label'   => esc_html__( 'Position', 'freeagent' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'inside',
					'options' => array(
						'inside'  => esc_html__( 'Inside', 'freeagent' ),
						'custom'  => esc_html__( 'Custom', 'freeagent' ),
					),
					'prefix_class' => 'elementor-arrows-position-',	
					'condition' => array(
						'transition!' => array( 'slide', 'fade' ),
					),
				)
			);			

			$element->add_responsive_control(
				'custom_arrow_y',
				array(
					'label'      => esc_html__( 'Vertical Position', 'freeagent' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range'      => [
						'px' => [
							'min' => -100,
							'max' => 100,
							'step' => 5,
						],
						'%' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => '%',
						'size' => 50,
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-swiper-button' => 'top: {{SIZE}}{{UNIT}};',
					],
					'conditions' => array(
						'relation' => 'or',
						'terms'    => array(
							array(
								'relation' => 'and',
								'terms'    => array(
									array(
										'name'     => 'arrows_position',
										'operator' => '===',
										'value'    => 'custom',
									),
									array(
										'name'     => 'transition',
										'operator' => 'in',
										'value'    => array( 'slide', 'fade' ),
									),									
								),
							),
							array(
								'relation' => 'and',
								'terms'    => array(
									array(
										'name'     => 'arrows_position_2',
										'operator' => '===',
										'value'    => 'custom',
									),
									array(
										'name'     => 'transition',
										'operator' => '!in',
										'value'    => array( 'slide', 'fade' ),
									),									
								),
							
							)							
						),
					),			
				)
			);
			$element->add_responsive_control(
				'custom_arrow_prev_x',
				array(
					'label'      => esc_html__( 'Prev Icon Horizontal Position', 'freeagent' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range'      => [
						'px' => [
							'min' => -100,
							'max' => 100,
							'step' => 5,
						],
						'%' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 10,
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
					],
					'conditions' => array(
						'relation' => 'or',
						'terms'    => array(
							array(
								'relation' => 'and',
								'terms'    => array(
									array(
										'name'     => 'arrows_position',
										'operator' => '===',
										'value'    => 'custom',
									),
									array(
										'name'     => 'transition',
										'operator' => 'in',
										'value'    => array( 'slide', 'fade' ),
									),									
								),
							),
							array(
								'relation' => 'and',
								'terms'    => array(
									array(
										'name'     => 'arrows_position_2',
										'operator' => '===',
										'value'    => 'custom',
									),
									array(
										'name'     => 'transition',
										'operator' => '!in',
										'value'    => array( 'slide', 'fade' ),
									),									
								),
							
							)							
						),
					),			
				)
			);	
			$element->add_responsive_control(
				'custom_arrow_next_x',
				array(
					'label'      => esc_html__( 'Next Icon Horizontal Position', 'freeagent' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => -100,
							'max' => 100,
							'step' => 5,
						],
						'%' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 10,
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
					],
					'conditions' => array(
						'relation' => 'or',
						'terms'    => array(
							array(
								'relation' => 'and',
								'terms'    => array(
									array(
										'name'     => 'arrows_position',
										'operator' => '===',
										'value'    => 'custom',
									),
									array(
										'name'     => 'transition',
										'operator' => 'in',
										'value'    => array( 'slide', 'fade' ),
									),									
								),
							),
							array(
								'relation' => 'and',
								'terms'    => array(
									array(
										'name'     => 'arrows_position_2',
										'operator' => '===',
										'value'    => 'custom',
									),
									array(
										'name'     => 'transition',
										'operator' => '!in',
										'value'    => array( 'slide', 'fade' ),
									),									
								),
							
							)							
						),
					),				
				)
			);						

			$element->add_control(
				'arrows_size',
				array(
					'label'      => esc_html__( 'Size', 'freeagent' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 20,
							'max' => 60,
						],
					],
					'separator' => 'before',
					'selectors' => [
						'{{WRAPPER}} .elementor-swiper-button' => 'font-size: {{SIZE}}{{UNIT}}',
					],
				)
			);
			$element->add_control(
				'arrows_width',
				array(
					'label'      => esc_html__( 'Width', 'freeagent' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 20,
							'max' => 60,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-swiper-button' => 'width: {{SIZE}}{{UNIT}};align-items: center;justify-content: center;',
					],
				)
			);
			$element->add_control(
				'arrows_height',
				array(
					'label'      => esc_html__( 'Height', 'freeagent' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 20,
							'max' => 60,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-swiper-button' => 'height: {{SIZE}}{{UNIT}};align-items: center;justify-content: center;',
					],
				)
			);			

			$element->add_control(
				'arrows_border_width',
				array(
					'label'      => esc_html__( 'Border Width', 'freeagent' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
					'range' => [
						'px' => [
							'max' => 20,
						],
						'em' => [
							'max' => 2,
						],
					],
					'separator' => 'before',
					'selectors' => [
						'{{WRAPPER}} .elementor-swiper-button' => 'border-width: {{SIZE}}{{UNIT}};border-style: solid;',
					],
				)
			);
	
			$element->add_control(
				'arrows_border_radius',
				array(
					'label' => esc_html__( 'Border Radius', 'freeagent' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-swiper-button' => 'border-radius: {{SIZE}}{{UNIT}};',
					],
				)
			);

			$element->start_controls_tabs( 'arrows_tabs' );
				$element->start_controls_tab( 
					'normal', 
					array( 
						'label' => esc_html__( 'Normal', 'freeagent' ) 
					) 
				);
					$element->add_control(
						'arrows_color',
						array(
							'label' => esc_html__( 'Color', 'freeagent' ),
							'type'  => Controls_Manager::COLOR,
							'selectors' => array(
								'{{WRAPPER}} .elementor-swiper-button'     => 'color: {{VALUE}}',
								'{{WRAPPER}} .elementor-swiper-button svg' => 'fill: {{VALUE}}',
							),
						)
					);

					$element->add_control(
						'arrows_bg_color',
						array(
							'label' => esc_html__( 'Background Color', 'freeagent' ),
							'type'  => Controls_Manager::COLOR,
							'selectors' => array(
								'{{WRAPPER}} .elementor-swiper-button' => 'background-color: {{VALUE}}',
							),
						)
					);	

					$element->add_control(
						'arrows_bd_color',
						array(
							'label' => esc_html__( 'Border Color', 'freeagent' ),
							'type'  => Controls_Manager::COLOR,
							'selectors' => array(
								'{{WRAPPER}} .elementor-swiper-button' => 'border-color: {{VALUE}}',
							),
							'condition' => array(
								'arrows_border_width!' => '',
							),							
						)
					);
				$element->end_controls_tab();

				$element->start_controls_tab( 
					'hover', 
					array( 
						'label' => esc_html__( 'Hover', 'freeagent' ) 
					) 
				);
					$element->add_control(
						'arrows_hover_color',
						array(
							'label' => esc_html__( 'Hover Color', 'freeagent' ),
							'type'  => Controls_Manager::COLOR,
							'selectors' => array(
								'{{WRAPPER}} .elementor-swiper-button:hover'     => 'color: {{VALUE}}',
								'{{WRAPPER}} .elementor-swiper-button:hover svg' => 'fill: {{VALUE}}',
							),
						)
					);
					$element->add_control(
						'arrows_hover_bg_color',
						array(
							'label' => esc_html__( 'Hover Background Color', 'freeagent' ),
							'type'  => Controls_Manager::COLOR,
							'selectors' => array(
								'{{WRAPPER}} .elementor-swiper-button:hover' => 'background-color: {{VALUE}}',
							),
						)
					);	

					$element->add_control(
						'arrows_hover_bd_color',
						array(
							'label' => esc_html__( 'Hover Border Color', 'freeagent' ),
							'type'  => Controls_Manager::COLOR,
							'selectors' => array(
								'{{WRAPPER}} .elementor-swiper-button:hover' => 'border-color: {{VALUE}}',
							),
							'condition' => array(
								'arrows_border_width!' => '',
							),	
						)
					);		
					$element->add_control(
						'arrows_hover_transition',
						array(
							'label'     => esc_html__( 'Transition Speed', 'freeagent' ) . ' (s)',
							'type'      => Controls_Manager::NUMBER,
							'default'   => 0.3,
							'selectors' => array(
								'{{WRAPPER}} .elementor-swiper-button' => 'transition: {{VALUE}}s',
							),
						)
					);								
				$element->end_controls_tab();
				
				$element->start_controls_tab( 
					'disabled', 
					array( 
						'label' => esc_html__( 'Disabled', 'freeagent' ) 
					) 
				);
					$element->add_control(
						'arrows_disabled_color',
						array(
							'label' => esc_html__( 'Disabled Color', 'freeagent' ),
							'type'  => Controls_Manager::COLOR,
							'selectors' => array(
								'{{WRAPPER}} .elementor-swiper-button.swiper-button-disabled'     => 'color: {{VALUE}}',
								'{{WRAPPER}} .elementor-swiper-button.swiper-button-disabled svg' => 'fill: {{VALUE}}',
							),
						)
					);
					$element->add_control(
						'arrows_disabled_bg_color',
						array(
							'label' => esc_html__( 'Disabled Background Color', 'freeagent' ),
							'type'  => Controls_Manager::COLOR,
							'selectors' => array(
								'{{WRAPPER}} .elementor-swiper-button.swiper-button-disabled' => 'background-color: {{VALUE}}',
							),
						)
					);	

					$element->add_control(
						'arrows_disabled_bd_color',
						array(
							'label' => esc_html__( 'Disabled Border Color', 'freeagent' ),
							'type'  => Controls_Manager::COLOR,
							'selectors' => array(
								'{{WRAPPER}} .elementor-swiper-button.swiper-button-disabled' => 'border-color: {{VALUE}}',
							),
							'condition' => array(
								'arrows_border_width!' => '',
							),								
						)
					);					
				$element->end_controls_tab();
			$element->end_controls_tabs();
		$element->end_controls_section();


		$element->start_controls_section(
			'section_style_dots',
			array(
				'label'     => esc_html__( 'Pagination', 'freeagent' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'navigation' => array( 'dots', 'both' ),
				),
			)
		);

			$element->add_control(
				'pagination',
				array(
					'label'   => esc_html__( 'Pagination', 'freeagent' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'bullets',
					'options' => array(
						'bullets'     => esc_html__( 'Dots', 'freeagent' ),
						'dynamic'     => esc_html__( 'Dynamic Bullets', 'freeagent' ),
						'fraction'    => esc_html__( 'Fraction', 'freeagent' ),
						'progressbar' => esc_html__( 'Progress', 'freeagent' ),
					),
					'prefix_class'       => 'elementor-pagination-type-',
					'render_type'        => 'template',
					'frontend_available' => true,
				)
			);

			$element->add_control(
				'dots_width',
				array(
					'type'      => Controls_Manager::SWITCHER,
					'label'     => __( 'Width Auto', 'freeagent' ),
					'selectors' => array(
						'{{WRAPPER}} .swiper-pagination-fraction,{{WRAPPER}} .swiper-pagination-custom,{{WRAPPER}} .' . $swiper_class . '-horizontal > .swiper-pagination-bullets' => "width:auto;",
					),
					'condition' => array(
						'pagination!' => array( 'dynamic', 'progressbar' ),
					),					
				)
			);

			$element->add_control(
				'dots_position',
				array(
					'label'   => esc_html__( 'Position', 'freeagent' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'inside',
					'options' => array(
						'outside' => esc_html__( 'Outside', 'freeagent' ),
						'inside'  => esc_html__( 'Inside', 'freeagent' ),
						'custom'  => esc_html__( 'Custom', 'freeagent' ),
					),
					'prefix_class' => 'elementor-pagination-position-',
					'condition'    => array(
						'pagination!' => 'progressbar',
					),
				)
			);
			$element->add_control(
				'custom_dots_y',
				array(
					'label'      => esc_html__( 'Vertical Position', 'freeagent' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => -100,
							'max' => 100,
							'step' => 5,
						],
						'%' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .swiper-pagination-fraction,{{WRAPPER}} .swiper-pagination-custom,{{WRAPPER}} .' . $swiper_class . '-horizontal > .swiper-pagination-bullets' => 'bottom: {{SIZE}}{{UNIT}};',

					],
					'condition' => array(
						'dots_position' => 'custom',
					),			
				)
			);
			$element->add_control(
				'custom_dots_x',
				array(
					'label'      => esc_html__( 'Horizontal Position', 'freeagent' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => -100,
							'max' => 100,
							'step' => 5,
						],
						'%' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 10,
					],
					'selectors' => [
						'{{WRAPPER}} .swiper-pagination-fraction,{{WRAPPER}} .swiper-pagination-custom,{{WRAPPER}} .' . $swiper_class . '-horizontal > .swiper-pagination-bullets' => 'left: {{SIZE}}{{UNIT}};',
					],
					'condition' => array(
						'dots_position' => 'custom',
					),			
				)
			);	

			$element->add_control(
				'dots_size',
				array(
					'label'      => esc_html__( 'Size', 'freeagent' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px', 'em', 'rem', 'custom' ),
					'range' => array(
						'px' => array(
							'min' => 5,
							'max' => 15,
						),
					),
					'selectors' => array(
						'{{WRAPPER}} .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .' . $swiper_class . '-horizontal .swiper-pagination-progressbar' => 'height: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .swiper-pagination-fraction' => 'font-size: {{SIZE}}{{UNIT}}',
					),
				)
			);

			$element->add_responsive_control(
				'dots_spacing',
				array(
					'label'      => esc_html__( 'Dots Spacing', 'freeagent' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px', 'custom' ),
					'range'      => array(
						'px' => array(
							'max' => 100,
						),
					),
					'selectors' => array(
						'{{WRAPPER}}' => '--swiper-pagination-bullet-horizontal-gap: {{SIZE}}{{UNIT}};',
					),
					'condition' => array(
						'pagination' => array( 'bullets', 'dynamic' ),
					),
				)
			);

			$element->start_controls_tabs( 'dots_tabs' );
				$element->start_controls_tab( 
					'dots_normal', 
					array( 
						'label' => esc_html__( 'Normal', 'freeagent' ) 
					) 
				);
					
					$element->add_control(
						'dots_bg_color',
						array(
							'label'     => esc_html__( 'Background Color', 'freeagent' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => array(
								// The opacity property will override the default inactive dot color which is opacity 0.2.
								'{{WRAPPER}} .swiper-pagination-bullet:not(.swiper-pagination-bullet-active)' => 'background-color: {{VALUE}}; opacity: 1;',
								'{{WRAPPER}} .swiper-pagination-progressbar' => 'background-color: {{VALUE}};',
							),
							'condition' => array(
								'pagination!' => 'fraction',
							),							
						)
					);	
					$element->add_control(
						'dots_fraction_color',
						array(
							'label'     => esc_html__( 'Color', 'freeagent' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => array(
								'{{WRAPPER}} .swiper-pagination-fraction .swiper-pagination-total' => 'color: {{VALUE}}',
							),
							'condition' => array(
								'pagination' => 'fraction',
							),
						)
					);						

				$element->end_controls_tab();

				$element->start_controls_tab( 
					'dots_hover', 
					array( 
						'label' => esc_html__( 'Hover', 'freeagent' ),
						'condition' => array(
							'pagination' => array( 'bullets', 'dynamic' ),
						),
					) 
				);
				
					$element->add_control(
						'dots_hover_bg_color',
						array(
							'label' => esc_html__( 'Hover Background Color', 'freeagent' ),
							'type'  => Controls_Manager::COLOR,
							'selectors' => array(
								'{{WRAPPER}} .swiper-pagination-bullet:hover' => 'background-color: {{VALUE}}',
							),
						)
					);	
					$element->add_control(
						'dots_hover_transition',
						array(
							'label'     => esc_html__( 'Transition Speed', 'freeagent' ) . ' (s)',
							'type'      => Controls_Manager::NUMBER,
							'default'   => 0.3,
							'selectors' => array(
								'{{WRAPPER}} .swiper-pagination-bullet' => 'transition: {{VALUE}}s',
							),
						)
					);						
				
				$element->end_controls_tab();
			
				$element->start_controls_tab( 
					'dots_active', 
					array( 
						'label' => esc_html__( 'Active', 'freeagent' ) 
					) 
				);
					
					$element->add_control(
						'dots_active_bg_color',
						array(
							'label'     => esc_html__( 'Active Background Color', 'freeagent' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => array(
								'{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
								'{{WRAPPER}} .swiper-pagination-progressbar .swiper-pagination-progressbar-fill' => '--swiper-pagination-color: {{VALUE}};',
							),
							'condition' => array(
								'pagination!' => 'fraction',
							),
						)
					);	
					$element->add_control(
						'dots_active_fraction_color',
						array(
							'label'     => esc_html__( 'Active Color', 'freeagent' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => array(
								'{{WRAPPER}} .swiper-pagination-fraction .swiper-pagination-current' => 'color: {{VALUE}}',
							),
							'condition' => array(
								'pagination' => 'fraction',
							),
						)
					);						
					
				$element->end_controls_tab();
			$element->end_controls_tabs();

		$element->end_controls_section();

}