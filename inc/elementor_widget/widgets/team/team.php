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
class Jws_team extends Widget_Base {

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
		return 'jws_team';
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
		return esc_html__( 'Jws team', 'freeagent' );
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
		return 'eicon-headphones';
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
    
    $this->register_content_general_controls();
    $this->register_content_slider_controls();
  }
   /**
	 * Register Woo posts General Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	*/
	protected function register_content_general_controls() {
	  
    $this->start_controls_section(
    'setting_section',
    [
      'label' => esc_html__( 'Setting', 'freeagent' ),
      'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]
    );
    $this->add_control(
      'team_display',
      [
        'label'     => esc_html__( 'Display', 'freeagent' ),
        'type'      => Controls_Manager::SELECT,
        'default'   => 'grid',
        'options'   => [
          'grid'   => esc_html__( 'Grid', 'freeagent' ),
          'slider'   => esc_html__( 'Slider', 'freeagent' ),
        ],
                  
      ]
    );
    $this->add_control(
      'teams_layout',
      [
        'label' => esc_html__( 'Layout', 'freeagent' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'layout1',
        'options' => [
          'layout1'  => esc_html__( 'Layout 1', 'freeagent' ),

        ],
      ]
    );
    $this->add_responsive_control(
      'columns',
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
  	  $this->start_controls_section(
			'setting_section_list',
			[
				'label' => esc_html__( 'Team List', 'freeagent' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
					'team_url',
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
					'image',
					[
						'label' => esc_html__( 'Choose Avatar', 'freeagent' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
					]
				);
        $repeater->add_group_control(
					Group_Control_Image_Size::get_type(),
					[
						'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
						'default' => 'large',
						'separator' => 'none',
					]
				);
        $repeater->add_control(
					'team_content',
					[
						'label' => esc_html__( 'Content', 'freeagent' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
        $repeater->add_control(
					'team_title',
					[
						'label' => esc_html__( 'Title', 'freeagent' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Default title', 'freeagent' ),
						'placeholder' => esc_html__( 'Type your title here', 'freeagent' ),
					]
				);
        $repeater->add_control(
					'team_job',
					[
						'label' => esc_html__( 'Job', 'freeagent' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Photographer', 'freeagent' ),
						'placeholder' => esc_html__( 'Type your title here', 'freeagent' ),
					]
				);
                $socials = new \Elementor\Repeater();
        $socials->add_control(
					'team_icon',
					[
								'label' => esc_html__( 'Social Icon', 'freeagent' ),
								'type' => \Elementor\Controls_Manager::ICONS,
								'default' => [
									'value' => 'fab fa-wordpress',
					               'library' => 'fa-brands',
								],
							]
					);

        $socials->add_control(
					'team_icon_url',
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
					'list_social',
					[
						'label' => esc_html__( ' List Social', 'freeagent' ),
						'type' => \Elementor\Controls_Manager::REPEATER,
						'fields' => $socials->get_controls(),
                        'max'=>5,
						'title_field' => '{{{ team_icon.value }}}',
					]
				);
        $this->add_control(
					'list',
					[
						'label' => esc_html__( ' List', 'freeagent' ),
						'type' => \Elementor\Controls_Manager::REPEATER,
						'fields' => $repeater->get_controls(),
						'default' => [
							[
								'team_title' => esc_html__( 'Name #1', 'freeagent' ),
							],
						],
						'title_field' => '{{{ team_title }}}',
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
			'blog_padding',
			[
				'label' 		=> esc_html__( 'Padding', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-teams-element .jws_team_inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

				'separator' => 'before',
			]
		);
        $this->add_responsive_control(
					'blog_radius',
					[
						'label' 		=> esc_html__( 'Border Radius', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-teams-element .jws_team_inner ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .jws-teams-element  .jws_team_item' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .jws-teams-element .jws-team-content' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
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
					'{{WRAPPER}} .jws-teams-element  .jws_team_item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Box Shadow', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-teams-element  .jws_team_inner',
			]
		);
        $this->add_control(
			'box_bgcolor',
			[
				'label' => esc_html__( 'background Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-teams-element  .jws_team_inner ' => 'background: {{VALUE}}',
				],
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
							'{{WRAPPER}} .jws-teams-element  .jws_team_inner,
                            {{WRAPPER}} .jws-teams-element  .jws_team_inner .jws_team_content' => 'text-align: {{VALUE}};',
					],
					'frontend_available' => true,
				]
		);
		$this->add_control(
				'content_style',
				[
					'label'     => esc_html__( 'Content', 'freeagent' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
           $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_content',
				'label' => esc_html__( 'Box Shadow', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-teams-element  .jws_team_content',
			]
		);
        $this->add_control(
			'content_bgcolor',
			[
				'label' => esc_html__( 'background Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-teams-element  .jws_team_content ' => 'background: {{VALUE}}',
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
					'{{WRAPPER}} .jws-teams-element .jws_team_content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			
			]
		);
  $this->add_responsive_control(
			'content_margin',
			[
				'label' 		=> esc_html__( 'Margin', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-teams-element .jws_team_content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			
			]
		);
        $this->add_responsive_control(
			'content_border_radius',
			[
				'label' 		=> esc_html__( 'Border Radius', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-teams-element .jws_team_content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'box_image_style',
			[
				'label' => esc_html__( 'Image', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_responsive_control(
            'team_size',
            [
                'label'         => esc_html__('Width Image', 'freeagent'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%', 'em'],
                'selectors'     => [
                    '{{WRAPPER}} .jws-teams-element .jws_team_inner .jws_team_image a img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        $this->add_control(
            'image_border_radius',
            [
                'label'         => esc_html__('Border Radius', 'freeagent'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%', 'em'],
                'selectors'     => [
                    '{{WRAPPER}} .jws-teams-element .jws_team_inner .jws_team_image a img' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
					'image_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-teams-element .jws_team_inner .team_team_image ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);

        $this->end_controls_section();
        $this->start_controls_section(
			'box_title_style',
			[
				'label' => esc_html__( 'Title', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-teams-element .jws_team_inner .team_title a' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'title_color_hover',
			[
				'label' => esc_html__( 'Title Color Hover', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-teams-element .jws_team_inner .team_title  a:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-teams-element .jws_team_inner  .team_title ',
			]
		);
     
        $this->add_responsive_control(
			'title_margin',
			[
				'label' 		=> esc_html__( 'Margin', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-teams-element .jws_team_inner .team_title ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

				'separator' => 'before',
			]
		);
		$this->add_control(
			'job_tab',
			[
				'label'     => esc_html__( 'Position', 'freeagent' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
			'position_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-teams-element .jws_team_inner .team_job' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'position_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-teams-element .jws_team_inner .team_job ',
			]
		);
     
        $this->add_responsive_control(
					'position_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-teams-element .jws_team_inner .team_job ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
		$this->add_control(
			'social_tab',
			[
				'label'     => esc_html__( 'Social', 'freeagent' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
    $this->add_control(
			'show_social',
			[
				'label' => esc_html__( 'Show Social Media', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'freeagent' ),
				'label_off' => esc_html__( 'Hide', 'freeagent' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'social_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
				'selectors' => [
					'{{WRAPPER}} .social_media .team-icon-list li a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .social_media .team-icon-list li a svg' => 'fill: {{VALUE}}',
				],
			]
		);
        $this->add_control(
    			'social_color_hover',
    			[
    				'label' => esc_html__( 'Color Hover', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '',
    				'selectors' => [
    					'{{WRAPPER}} .social_media .team-icon-list li a::hover' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .social_media .team-icon-list li a::hover svg' => 'fill: {{VALUE}}',
    				],
    			]
    		);
        $this->add_control(
    			'social_bg_color',
    			[
    				'label' => esc_html__( 'Background Color', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '',
    				'selectors' => [
    					'{{WRAPPER}} .social_media .team-icon-list' => 'background: {{VALUE}}',
    				],
    			]
    		);
      $this->add_control(
    			'social_bg_color_hover',
    			[
    				'label' => esc_html__( 'Background Color Hover', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '',
    				'selectors' => [
    					'{{WRAPPER}} .social_media .team-icon-list:hover' => 'background: {{VALUE}}',
    				],
    			]
    		);


            $this->add_control(
            'icon_size',
                    [
                        'label'         => esc_html__('Icon size', 'freeagent'),
                        'type'          => Controls_Manager::SLIDER,
                        'size_units'    => ['px', '%', 'em'],
                        'selectors'     => [
                            '{{WRAPPER}} .jws-teams-element .jws_team_inner .social_media a' => 'font-size: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .jws-teams-element .jws_team_inner .social_media svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                        ]
                    ]
                );
     
            $this->add_responsive_control(
					'social_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-teams-element .jws_team_inner .social_media' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
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
	protected function register_content_slider_controls() {
        jws_elementor_widget_slider_config($this,['team_display' => 'slider']);
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


   $show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
    $show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );   
    $show_inbox = ($settings['show_inbox'] == 'yes') ? 'show_container' : ''; 
      
    $class_column = 'jws_team_item';
   
    $class_row = 'jws-team-content';  
    $class_row .= ' jws-team-'.$settings['teams_layout'].'';

    if($settings['team_display'] == 'slider') { 
      $class_row .= ' swiper jws_team_slider '.$show_inbox;
       $class_column .= ' slider-item swiper-slide'; 
    }else {
      $class_row .= ' row';
       $class_column .= ' col-xl-'.$settings['columns'].' ';
       $class_column .= (!empty($settings['columns_tablet'])) ? ' col-lg-'.$settings['columns_tablet'].' ' : ' col-lg-'.$settings['columns'].' ' ;
       $class_column .= (!empty($settings['columns_mobile'])) ? ' col-'.$settings['columns_mobile'].' ' :  ' col-'.$settings['columns'].' ';
    } 
  
    ?>
    <div class="jws-teams-element">
      <div class="<?php echo esc_attr($class_row); ?>">
      <?php 
            $image_size = !empty($settings['image_size']['width']) && !empty($settings['image_size']['height']) ?  $settings['image_size']['width'].'x'.$settings['image_size']['height'] : '';
            if($settings['team_display'] == 'slider') echo '<div class="swiper-wrapper">';
                foreach(  $settings['list'] as $item ) {
                    $url = $item['team_url']['url'];
                      $target = $item['team_url']['is_external'] ? ' target="_blank"' : '';
                      $nofollow = $item['team_url']['nofollow'] ? ' rel="nofollow"' : ''; 
                  

                        echo '<div class="'.$class_column.'">
                                <div class="jws_team_inner">';
                                include( 'layout/'.$settings['teams_layout'].'.php' );
                        echo '</div> </div>';
                }    

          wp_reset_postdata();
            
        ?>
        <?php if($settings['team_display'] == 'slider') echo '</div>';?>
         <?php if($show_arrows && $settings['team_display'] == 'slider') : ?>
            <button class="elementor-swiper-button elementor-swiper-button-prev">
             <?php $this->render_swiper_button( $settings, 'prev' ); ?>
            </button>
            <button class="elementor-swiper-button elementor-swiper-button-next">
             <?php $this->render_swiper_button( $settings, 'next' ); ?>
            </button>
        <?php endif; ?>
        <?php  if($show_dots && $settings['team_display'] == 'slider') echo '<div class="swiper-pagination"></div>';?>
      </div>
    </div>
    <?php
  }
        private function render_swiper_button( $settings, $type ) {
		$icon_key = 'arrow_icon_' . $type;

		Icons_Manager::render_icon( $settings[ $icon_key ], [ 'aria-hidden' => 'true' ] );
	} 
	/**
	 * Rend offcanvas output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.11.0
	 * @access protected
	 */
	protected function content_template() {

	}
}