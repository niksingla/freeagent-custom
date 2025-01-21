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
class Jws_Slider extends Widget_Base {

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
		return 'jws_slider';
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
		return esc_html__( 'Jws slider', 'freeagent' );
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
		return 'eicon-posts-carousel';
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
 
    public function get_tabs_list() { 
        
        global $jws_option;
        
        
        if(isset($jws_option['slider_category']) && !empty($jws_option['slider_category'])) {
          
    
      
            $tabsok = array();
            foreach (  $jws_option['slider_category'] as $index => $item_tabs ) { 
              $tabsok[ preg_replace('/[^a-zA-Z]+/', '', $item_tabs) ] = $item_tabs;     
           
            };  
            return $tabsok;
        }
        
    
    }
    /**
     * Load style
     */
    public function get_style_depends()
    {
        return [''];
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
        return [''];
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
			'slider_layout',
			[
				'label' => esc_html__( 'Layout', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'layout1',
				'options' => [
					'layout1'  => esc_html__( 'Layout 1', 'freeagent' ),
                    'layout2'  => esc_html__( 'Layout Demo', 'freeagent' ),
				],
			]
		);

        $this->end_controls_section(); 
 
	    $this->start_controls_section(
			'setting_section_list',
			[
				'label' => esc_html__( 'slider List', 'freeagent' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);   
        $repeater = new \Elementor\Repeater();
        
        
        $repeater->add_control(
				'select_template',
				[
					'label'     => esc_html__( 'Select Template', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'multiple'  => true,
					'default'   => '',
					'options'   => $this->get_saved_data(),
				]
		);

        
        $this->add_control(
			'list',
			[
				'label' => esc_html__( 'Slider List', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'setting_navigation',
			[
				'label' => esc_html__( 'Setting Navigation', 'freeagent' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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

        	$this->start_controls_section(
			'section_slider_options',
			[
				'label'     => esc_html__( 'Slider Options', 'freeagent' ),
				'type'      => Controls_Manager::SECTION,
			]
		);


		$this->add_responsive_control(
			'slides_to_show',
			[
				'label'          => esc_html__( 'posts to Show', 'freeagent' ),
				'type'           => Controls_Manager::NUMBER,
			]
		);

		$this->add_responsive_control(
			'slides_to_scroll',
			[
				'label'          => esc_html__( 'posts to Scroll', 'freeagent' ),
				'type'           => Controls_Manager::NUMBER,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'        => esc_html__( 'Autoplay', 'freeagent' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);
		$this->add_control(
			'autoplay_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed', 'freeagent' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'selectors' => [
					'{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
				],
				'condition' => [
					'autoplay'             => 'yes',
				],
			]
		);
		$this->add_control(
			'pause_on_hover',
			[
				'label'        => esc_html__( 'Pause on Hover', 'freeagent' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'autoplay'             => 'yes',
				],
			]
		);

		$this->add_control(
			'infinite',
			[
				'label'        => esc_html__( 'Infinite Loop', 'freeagent' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
        
        $this->add_control(
			'center',
			[
				'label'        => esc_html__( 'Cener Mode', 'freeagent' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);
        
       
        $this->add_control(
			'variablewidth',
			[
				'label'        => esc_html__( 'variable Width', 'freeagent' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			]
		);
        $this->add_control(
			'fade',
			[
				'label'        => esc_html__( 'Fade', 'freeagent' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);
		$this->add_control(
			'transition_speed',
			[
				'label'     => esc_html__( 'Transition Speed (ms)', 'freeagent' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 500,
			]
		);
		$this->end_controls_section();
        
        $this->start_controls_section(
			'slides_style',
			[
				'label' => esc_html__( 'Slides', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_control(
			'slider_content_position',
			[
				'label' => esc_html__( 'Position', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => esc_html__( 'top', 'freeagent' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'freeagent' ),
						'icon' => 'eicon-h-align-center',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'freeagent' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'center',
				'toggle' => true,
			]
		);
 
        
         $this->add_responsive_control(
			'slider_height',
			[
				'label' => esc_html__( 'Slider Height', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' , 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 500,
				],
				'selectors' => [
					'{{WRAPPER}} .jws_slider_element .jws_slider' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
         $this->add_responsive_control(
			'slider_content_padding',
			[
				'label' 		=> esc_html__( 'Slider Content Padding', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .slider-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

				'separator' => 'before',
			]
		);
        $this->add_responsive_control(
			'slider_content_margin',
			[
				'label' 		=> esc_html__( 'Slider Content Margin', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .slider-content-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

				'separator' => 'before',
			]
		);
        
        
        $this->end_controls_section();
        

        $this->start_controls_section(
            'navigation_style_settings', [
            'label' => esc_html__('Navigation', 'freeagent'),
            'tab' => Controls_Manager::TAB_STYLE,
  
        ]);
        $this->add_responsive_control(
			'align_navigation',
			[
				'label' => esc_html__( 'Alignment', 'freeagent' ),
				'type' => Controls_Manager::CHOOSE,
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
				'selectors' => [
					'{{WRAPPER}} .slider-dots-box .slider-dots' => 'text-align: {{VALUE}};',
				],
			]
		);
        $this->add_control(
            'heading_style_settings', [
            'label' => esc_html__('Arrows', 'freeagent'),
            'type'      => Controls_Manager::HEADING,
        ]);
  		$this->add_control(
			'arrow_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                
					'{{WRAPPER}} .jws-carousel-btn' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'arrow_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                
					'{{WRAPPER}} .jws-carousel-btn' => 'background: {{VALUE}}',
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
					'{{WRAPPER}} .jws-carousel-btn' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}}  .jws-nav-carousel' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );
         $this->add_control(
            'dot_style_settings', [
            'label' => esc_html__('Dots', 'freeagent'),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);

		$this->add_control(
			'dot__bg_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                
					'{{WRAPPER}} .slider-dots-box .slider-dots li button' => 'border-color: {{VALUE}}',
                    
				],
			]
		);
		$this->add_control(
			'dot_bgactive_color',
			[
				'label' => esc_html__( ' Active Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                
					'{{WRAPPER}} .slider-dots-box .slider-dots li.slick-active button:after' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .slider-dots-box .slider-dots li.slick-active button'=>'border-color:{{VALUE}}'
                    
				],
			]
		);
                $this->add_responsive_control(
            'dots_margin',
            [
                'label'         => esc_html__('Margin', 'freeagent'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .slider-dots-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );

        $this->end_controls_section();
        
        
        $this->start_controls_section(
			'mix_content_style',
			[
				'label' => esc_html__( 'Mix Content', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->start_controls_tabs(
        	'min_content_tabs'
        );
        
        $this->start_controls_tab(
        	'style_image1_tab',
        	[
        		'label' => esc_html__( 'Image 1', 'freeagent' ),
        	]
        );
         $this->add_responsive_control(
			'mix-image-width',
			[
				'label' => esc_html__( 'Width', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' , 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1920,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slider-mix-1 img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
             
        $this->add_responsive_control(
			'mix-image-position-left',
			[
				'label' => esc_html__( 'Left', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' , 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1920,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slider-mix-1' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'mix-image-position-right',
			[
				'label' => esc_html__( 'Right', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' , 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1920,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slider-mix-1' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'mix-image-position-top',
			[
				'label' => esc_html__( 'Top', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' , 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1920,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slider-mix-1' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'mix-image-position-bottom',
			[
				'label' => esc_html__( 'Bottom', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' , 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1920,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slider-mix-1' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_tab();
        
        $this->start_controls_tab(
        	'style_image2_tab',
        	[
        		'label' => esc_html__( 'Image 2', 'freeagent' ),
        	]
        );
         $this->add_responsive_control(
			'mix-image2-width',
			[
				'label' => esc_html__( 'Width', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' , 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1920,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slider-mix-2 img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        
        $this->add_responsive_control(
			'mix-image2-position-left',
			[
				'label' => esc_html__( 'Left', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' , 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1920,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slider-mix-2' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'mix-image2-position-right',
			[
				'label' => esc_html__( 'Right', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' , 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1920,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slider-mix-2' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'mix-image2-position-top',
			[
				'label' => esc_html__( 'Top', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' , 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1920,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slider-mix-2' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'mix-image2-position-bottom',
			[
				'label' => esc_html__( 'Bottom', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' , 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1920,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slider-mix-2' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_tab();
        
           $this->start_controls_tab(
        	'style_slider_dots_tab',
        	[
        		'label' => esc_html__( 'Dots Slider', 'freeagent' ),
        	]
        );
         $this->add_responsive_control(
			'slider-dots-position',
			[
				'label' => esc_html__( 'Position', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' , 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1920,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slider-dots-box' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
     

        $this->end_controls_section();
        

	}
    
    public function get_saved_data(  ) {
        
      
      
        global $post;
        $posts = get_posts( array( 'post_type' => 'hf_template','numberposts' => -1 ) );
        if( $posts ){
           foreach( $posts as $post ) :   
           
           $options[$post->ID] = $post->post_title;
           
        endforeach; 
        wp_reset_postdata(); 
        }else {
           $options['no_template'] = esc_html__( 'It seems that, you have not saved any template yet.', 'freeagent' ); 
        }
  
		return $options;
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

          $class_column = ' jws_slider_item';
    
          $class_row = 'jws_slider slider '.$settings['slider_layout']; 
          $class_row .= ' slider_content_position-'.$settings['slider_content_position'];  

        $class_row .= ' jws-slider carousel';
        $class_column .= ' slider-item swiper-slide'; 
        $dots = ($settings['enable_dots'] == 'yes') ? 'true' : 'false';
        $arrows = ($settings['enable_nav'] == 'yes') ? 'true' : 'false';
        $autoplay = ($settings['autoplay'] == 'yes') ? 'true' : 'false';
        $pause_on_hover = ($settings['pause_on_hover'] == 'yes') ? 'true' : 'false';
        $infinite = ($settings['infinite'] == 'yes') ? 'true' : 'false';
        $variableWidth = ($settings['variablewidth'] == 'yes') ? 'true' : 'false';
        $center = ($settings['center'] == 'yes') ? 'true' : 'false';
        $fade = ($settings['fade'] == 'yes') ? 'true' : 'false';

        $settings['slides_to_show'] = isset($settings['slides_to_show']) && !empty($settings['slides_to_show']) ? $settings['slides_to_show'] : '1';
        $settings['slides_to_show_tablet'] = isset($settings['slides_to_show_tablet']) && !empty($settings['slides_to_show_tablet']) ? $settings['slides_to_show_tablet'] : $settings['slides_to_show'];
        $settings['slides_to_show_mobile'] = isset($settings['slides_to_show_mobile']) && !empty($settings['slides_to_show_mobile']) ? $settings['slides_to_show_mobile'] : $settings['slides_to_show'];
        $settings['slides_to_scroll'] = isset($settings['slides_to_scroll']) && !empty($settings['slides_to_scroll']) ? $settings['slides_to_scroll'] : '1';
        $settings['slides_to_scroll_tablet'] = isset($settings['slides_to_scroll_tablet']) && !empty($settings['slides_to_scroll_tablet']) ? $settings['slides_to_scroll_tablet'] : $settings['slides_to_scroll'];
        $settings['slides_to_scroll_mobile'] = isset($settings['slides_to_scroll_mobile']) && !empty($settings['slides_to_scroll_mobile']) ? $settings['slides_to_scroll_mobile'] : $settings['slides_to_scroll']; 
        
        
        $autoplay_speed = ($settings['autoplay_speed']) ? $settings['autoplay_speed'] : '0';
        $data_slick = 'data-slick=\'{"slidesToShow":'.$settings['slides_to_show'].' ,"slidesToScroll": '.$settings['slides_to_scroll'].',"fade":'.$fade.', "autoplay": '.$autoplay.',"arrows": '.$arrows.', "dots":'.$dots.', "autoplaySpeed": '.$autoplay_speed.',"variableWidth":'.$variableWidth.',"pauseOnHover":'.$pause_on_hover.',"centerMode":'.$center.', "infinite":'.$infinite.',
        "speed": '.$settings['transition_speed'].', "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": '.$settings['slides_to_show_tablet'].',"slidesToScroll": '.$settings['slides_to_scroll_tablet'].'}},
        {"breakpoint": 768,"settings":{"slidesToShow": '.$settings['slides_to_show_mobile'].',"slidesToScroll": '.$settings['slides_to_scroll_mobile'].'}}]}\''; 

         ?>
         <div class="jws_slider_element">

            <div class=" jws-carousel <?php echo esc_attr($class_row); ?>" <?php echo ''.$data_slick; ?> data-slider="jws-custom-<?php echo esc_attr($this->get_id()); ?>">

                    <?php foreach (  $settings['list'] as $index => $item ) { ?>
                        <div class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?><?php echo esc_attr($class_column); ?>">
                            <?php if(!empty($item['select_template']))  echo Plugin::$instance->frontend->get_builder_content($item['select_template'], true);    ?>
                        </div>
                     <?php } ?>

            </div>
            <?php if($settings['enable_nav'] == 'yes') : ?>
           <div class="jws-nav-carousel">
               <div class="jws-carousel-btn jws-button-prev  prev-item"><span class="jws-icon-arrow-left-2"></div>
               <div class="jws-carousel-btn jws-button-next next-item"><span class="jws-icon-arrow-right-2"></span></div>
           </div>
        <?php endif; if($settings['enable_dots'] == 'yes') : ?>
        <div class="slider-dots-box"></div>
        <?php endif; ?>
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