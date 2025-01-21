<?php
namespace Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Login_form extends Widget_Base {

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
		return 'jws_login_form';
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
		return esc_html__( 'Jws Login Form', 'freeagent' );
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
		return 'eicon-user-circle-o';
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
    
    public function get_script_depends()
    {
        return ['jws-google-recaptcha-apis'];
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
			'section_login_form_setting',
			[
				'label' => esc_html__( 'Toggle', 'freeagent' ),
			]
		);
        $this->add_control(
				'layout',
				[
					'label'     => esc_html__( 'Layout', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'form',
					'options'   => [
                    'form'   => esc_html__( 'Form', 'freeagent' ),
                        'url'   => esc_html__( 'URL', 'freeagent' ),
						
						'popup'   => esc_html__( 'Popup', 'freeagent' ),
					],
                    
				]
		);
        
        $this->add_control(
				'icon',
				[
					'label'            => esc_html__( 'Select Icon Tigger', 'freeagent' ),
					'type'             => Controls_Manager::ICONS,
                    'condition'    => [
						'layout' => 'popup',
					],
				]
		);

        $this->add_control(
				'display_active',
				[
					'label'     => esc_html__( 'Display Active', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'login',
					'options'   => [
						'login'   => esc_html__( 'Login', 'freeagent' ),
						'signup'   => esc_html__( 'Sign Up', 'freeagent' ),
                        
					],
                    
				]
		);
		$this->add_control(
            'show_login',
            [
                'label'         => esc_html__( 'Show Login', 'freeagent' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'freeagent' ),
                'label_off'     => esc_html__( 'No', 'freeagent' ),
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'show_register',
            [
                'label'         => esc_html__( 'Show Register', 'freeagent' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'freeagent' ),
                'label_off'     => esc_html__( 'No', 'freeagent' ),
                'default'   => 'yes',
            ]
        );


		$this->end_controls_section();
  
		$this->start_controls_section(
			'style',
			[
				'label' => esc_html__( 'Style', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
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
							'{{WRAPPER}} #jws-login-form' => 'text-align: {{VALUE}};',
					],
					'frontend_available' => true,
				]
		);
         $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'freeagent' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}}  .jws-login-container .jws-animation',
			]
		);
        $this->add_responsive_control(
				'form_width',
				[
					'label' 		=> esc_html__( 'Max. Width', 'freeagent' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' 		=> [
						'%' 		=> [
							'min' => 0,
							'max' => 100,
						],
						'px' 		=> [
							'min' => 100,
							'max' => 1000,
						],
					],
					'selectors' 	=> [
						'
						 {{WRAPPER}} .jws-login-container .jws-animation' => 'max-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
        $this->add_control(
					'form_padding',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Padding', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-login-container .jws-animation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
         $this->add_control(
					'form_color_remember',
					[
						'label' 	=> esc_html__( 'Form Remember Me Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
								'{{WRAPPER}} #jws-login-form .jws-animation .login-remember label'  => 'color: {{VALUE}};',
						],
					]
		);
         $this->add_control(
					'form_color_forgetmenot',
					[
						'label' 	=> esc_html__( 'Form Forget Password Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
								'{{WRAPPER}} #jws-login-form .jws-animation .forgetmenot a'  => 'color: {{VALUE}};',
						],
					]
		);
         $this->add_control(
					'form_color_forgetmenot_hover',
					[
						'label' 	=> esc_html__( 'Form Forget Password Color Hover', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
								'{{WRAPPER}} #jws-login-form .jws-animation .forgetmenot a:hover'  => 'color: {{VALUE}};',
						],
					]
		);
        
         $this->add_control(
					'form_color_tab',
					[
						'label' 	=> esc_html__( 'Form Tab Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
								'{{WRAPPER}} #jws-login-form .jws-animation .link-bottom'  => 'color: {{VALUE}};',
						],
					]
		);
        
          $this->add_control(
					'form_color_tab_link',
					[
						'label' 	=> esc_html__( 'Form Tab Link Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
								'{{WRAPPER}} #jws-login-form .jws-animation .link-bottom a'  => 'color: {{VALUE}};',
						],
					]
		);
        
          $this->add_control(
					'form_color_tab_link_hover',
					[
						'label' 	=> esc_html__( 'Form Tab Link Color Hover', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
								'{{WRAPPER}} #jws-login-form .jws-animation .link-bottom a:hover'  => 'color: {{VALUE}};',
						],
					]
		);

        $this->add_control(
					'form_color_login_error',
					[
						'label' 	=> esc_html__( 'Form Color error', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
								'{{WRAPPER}} #jws-login-form .message.message-error'  => 'color: {{VALUE}};',
                                
						],
					]
		);
        $this->add_control(
					'form_color_login_ok',
					[
						'label' 	=> esc_html__( 'Form Color success', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
								'{{WRAPPER}} #jws-login-form .message.message-success'  => 'color: {{VALUE}};',
                                
						],
					]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'heading-style',
			[
				'label' => esc_html__( 'Heading', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'form_title',
					'label' 	=> esc_html__( 'Typography', 'freeagent' ),
					'selector' 	=> '{{WRAPPER}} #jws-login-form .jws-animation .title',
				]
		);
         $this->add_control(
					'form_title_color',
					[
						'label' 	=> esc_html__( 'Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
								'{{WRAPPER}} #jws-login-form .jws-animation .title'  => 'color: {{VALUE}};',
                                
						],
					]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'input-style',
			[
				'label' => esc_html__( 'Input', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_input',
				'label' => esc_html__( 'Background', 'freeagent' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}}  #jws-login-form .jws-animation form .input',
			]
		);

        
        $this->add_control(
					'inputpadding',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Padding', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}}  #jws-login-form .jws-animation form .input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
         $this->add_control(
					'inputmargin',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}}  #jws-login-form .jws-animation form .input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
         $this->add_control(
					'input_color',
					[
						'label' 	=> esc_html__( 'Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
								'{{WRAPPER}} #jws-login-form .jws-animation form .input'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} #jws-login-form .jws-animation form .input::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} #jws-login-form .jws-animation form .input::-moz-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} #jws-login-form .jws-animation form .input:-ms-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} #jws-login-form .jws-animation form .input:-moz-placeholder'  => 'color: {{VALUE}};',
						],
					]
		);
        $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'input_title',
					'label' 	=> esc_html__( 'Typography', 'freeagent' ),
					'selector' 	=> '{{WRAPPER}} #jws-login-form .jws-animation form .input',
				]
		);
        $this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 		=> 'input_border',
					'label' 	=> esc_html__( 'Input Border', 'freeagent' ),
					'selector' 	=> '{{WRAPPER}} #jws-login-form .jws-animation form .input',
				]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'submit-style',
			[
				'label' => esc_html__( 'Submit Input', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->start_controls_tabs(
			'submit_tabs'
		);
        
        
        $this->start_controls_tab(
			'submit_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'freeagent' ),
			]
		);
        $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'submit_typography',
					'label' 	=> esc_html__( 'Typography', 'freeagent' ),
					'selector' 	=> '{{WRAPPER}} #jws-login-form .jws-animation form .button',
				]
		);
        $this->add_control(
			'button_type',
			[
				'label' => esc_html__( 'Button Background Type', 'freeagent' ),
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
			'background_submit',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} #jws-login-form .jws-animation form .button' => 'background:{{VALUE}};',
				],
				'default' => '',
                'condition' => [
					'button_type' => 'classic',
				],
			]
		);
        $this->add_control(
			'button_bggradient_color',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
                'condition' => [
					'button_type' => 'gradient',
				],
			]
		);
        $this->add_control(
			'button_bggradient_color2',
			[
				'label' => esc_html__( 'Background Second Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} #jws-login-form .jws-animation form .button' => 'background-image: linear-gradient(to right, {{button_bggradient_color.VALUE}} 0%, {{VALUE}} 51%, {{button_bggradient_color.VALUE}} 100%);background-size: 200% auto;',
                    '{{WRAPPER}} #jws-login-form .jws-animation form .button:hover' => 'background-position: right center;',
				],
                'condition' => [
					'button_type' => 'gradient',
				],
			]
		);
        $this->add_control(
					'submit_color',
					[
						'label' 	=> esc_html__( 'Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
								'{{WRAPPER}} #jws-login-form .jws-animation form input.button'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} #jws-login-form .jws-animation form input.button::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} #jws-login-form .jws-animation form input.button::-moz-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} #jws-login-form .jws-animation form input.button:-ms-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} #jws-login-form .jws-animation form input.button:-moz-placeholder'  => 'color: {{VALUE}};',
						],
					]
		);

	
        $this->end_controls_tab();
        
       $this->start_controls_tab(
			'submit_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'freeagent' ),
			]
		);

        $this->add_control(
			'background_submit_hover',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}}  #jws-login-form .jws-animation form .button:hover' => 'background:{{VALUE}};',
				],
				'default' => '',
                'condition' => [
					'button_type' => 'classic',
				],
			]
		);
        $this->add_control(
					'submit_color_hover',
					[
						'label' 	=> esc_html__( 'Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
								'{{WRAPPER}} #jws-login-form .jws-animation form input.button:hover'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} #jws-login-form .jws-animation form input.button:hover::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} #jws-login-form .jws-animation form input.button:hover::-moz-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} #jws-login-form .jws-animation form input.button:hover:-ms-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} #jws-login-form .jws-animation form input.button:hover:-moz-placeholder'  => 'color: {{VALUE}};',
						],
					]
		);

	
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        

        
        $this->add_control(
					'submitpadding',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Padding', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}}  #jws-login-form .jws-animation form .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
        $this->add_control(
					'submitmargin',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}}  #jws-login-form .jws-animation form .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
        $this->add_control(
					'submit_radius',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Border Radius', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}}  #jws-login-form .jws-animation form .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
   
        $this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 		=> 'submit_border',
					'label' 	=> esc_html__( 'Input Border', 'freeagent' ),
					'selector' 	=> '{{WRAPPER}} #jws-login-form .jws-animation form .button',
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
        $show_register = $settings['show_register'];
        $show_login = $settings['show_login'];
        $active = $settings['display_active'];
        $layouts = $settings['layout'];   
 
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