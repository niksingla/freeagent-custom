<?php
/**
 * Jws Login Button.
 *
 * @package JWS
 */

namespace Elementor;

// Elementor Classes.
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Button Login.
 */
class Login_Button extends Widget_Base {

	/**
	 * Retrieve Off - Canvas Widget name.
	 *
	 * @since 1.11.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'login_button';
	}

	/**
	 * Retrieve Offcanvas Widget title.
	 *
	 * @since 1.11.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Jws Button Login';
	}

	/**
	 * Retrieve OffCanvas Widget icon.
	 *
	 * @since 1.11.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-button';
	}

	/**
	 * Retrieve Widget Keywords.
	 *
	 * @since 1.11.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_keywords() {
		return ['Login, button'];
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
	 * Register canvas controls.
	 *
	 * @since 1.11.0
	 * @access protected
	 */
 	protected function register_controls() {
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Button', 'freeagent' ),
			]
		);
		$this->add_control(
			'text_login',
			[
				'label' => esc_html__( 'Text Login', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Login', 'freeagent' ),
				'placeholder' => esc_html__( 'Login', 'freeagent' ),
			]
		);


        			
		$this->add_control(
			'text_register',
			[
				'label' => esc_html__( 'Text Sign Up', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Sign Up', 'freeagent' ),
				'placeholder' => esc_html__( 'Sign Up', 'freeagent' ),
   	            'separator' => 'before',
			]
		);


		$this->add_control(
			'text_logged',
			[
				'label' => esc_html__( 'Text After Login', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Logout', 'freeagent' ),
				'placeholder' => esc_html__( 'Logout', 'freeagent' ),
   	            'separator' => 'before',
			]
		);
        $this->add_control(
    			'enable_icon',
    			[
    				'label' => esc_html__( 'Enable Icon', 'freeagent' ),
                    'description' => esc_html__( 'Show Icon instead of Text after logged', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::SWITCHER,
    				'label_on' => esc_html__( 'On', 'freeagent' ),
    				'label_off' => esc_html__( 'Off', 'freeagent' ),
    				'return_value' => 'yes',
    			]
    		);
            $this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-user-circle',
					'library' => 'fa-regular',
				],
                'condition'=>['enable_icon'=>'yes']
            ]
            );
            $this->add_responsive_control(
    			'size_icon',
    			[
    				'label' =>  esc_html__( 'Size', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::SLIDER,
    				'size_units' => [ 'px'],
    				'range' => [
    					'px' => [
    						'min' => 0,
    						'max' => 100,
    						'step' => 1,
    					],
    				],
    				'selectors' => [
    					'{{WRAPPER}} .jws_button_login a.elementor-button-link.login svg' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .jws_button_login a.elementor-button-link.login i' => 'font-size:{{SIZE}}{{UNIT}};',              
    				],
                    'condition'=>['enable_icon'=>'yes']
    			]
    	);
     $this->add_control(
			'icon_color',
			[
				'label' =>  esc_html__( 'Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
                '{{WRAPPER}} .jws_button_login a.elementor-button-link.login svg path' => 'fill: {{VALUE}}',
                '{{WRAPPER}} .jws_button_login a.elementor-button-link.login i' => 'color: {{VALUE}}',              
				
				],
                'condition'=>['enable_icon'=>'yes']
			]
	   );
        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Login', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} a.elementor-button-link.login',
			]
		);
        $this->start_controls_tabs( 'tabs_button_login_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'freeagent' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.login' => 'color: {{VALUE}};',
				],
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
			'button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.login' => 'background:{{VALUE}};',
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
					'{{WRAPPER}} a.elementor-button-link.login' => 'background-image: linear-gradient(to right, {{button_bggradient_color.VALUE}} 0%, {{VALUE}} 51%, {{button_bggradient_color.VALUE}} 100%);background-size: 200% auto;',
                    '{{WRAPPER}} a.elementor-button-link.login:hover' => 'background-position: right center;',
				],
                'condition' => [
					'button_type' => 'gradient',
				],
			]
		);
        
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} a.elementor-button-link.login',
			
			]
		);
		$this->add_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.login' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
 	  $this->add_responsive_control(
			'text_padding',
			[
				'label' => esc_html__( 'Padding', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.login' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);
        $this->add_responsive_control(
			'text_margin',
			[
				'label' => esc_html__( 'Margin', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.login' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);
        $this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'freeagent' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => esc_html__( 'Text Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					' {{WRAPPER}} a.elementor-button-link.login:hover' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'button_bg_hover_color_hover',
			[
				'label' => esc_html__( 'Background Hover Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
                'selectors' => [
					' {{WRAPPER}} a.elementor-button-link.login:hover' => 'background:{{VALUE}};',
				],

			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.login:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
    	$this->end_controls_tabs();
        
         $this->end_controls_section();
        $this->start_controls_section(
			'section_style_register',
			[
				'label' => esc_html__( 'Sign Up', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_register',
				'scheme' => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} a.elementor-button-link.register',
			]
		);
        $this->start_controls_tabs( 'tabs_button_register_style' );

		$this->start_controls_tab(
			'tabregister_button_normal',
			[
				'label' => esc_html__( 'Normal', 'freeagent' ),
			]
		);

		$this->add_control(
			'buttonregister_text_color',
			[
				'label' => esc_html__( 'Text Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.register' => 'color: {{VALUE}};',
				],
			]
		);
         $this->add_control(
			'buttonregister_type',
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
			'buttonregister_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.register' => 'background:{{VALUE}};',
				],
				'default' => '',
                'condition' => [
					'buttonregister_type' => 'classic',
				],
			]
		);
        $this->add_control(
			'buttonregister_bggradient_color',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
                'condition' => [
					'buttonregister_type' => 'gradient',
				],
			]
		);
        $this->add_control(
			'buttonregister_bggradient_color2',
			[
				'label' => esc_html__( 'Background Second Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.register' => 'background-image: linear-gradient(to right, {{button_bggradient_color.VALUE}} 0%, {{VALUE}} 51%, {{button_bggradient_color.VALUE}} 100%);background-size: 200% auto;',
                    '{{WRAPPER}} a.elementor-button-link.register:hover' => 'background-position: right center;',
				],
                'condition' => [
					'buttonregister_type' => 'gradient',
				],
			]
		);
        
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_register',
				'selector' => '{{WRAPPER}} a.elementor-button-link.register',
			
			]
		);
		$this->add_control(
			'borderregister_radius',
			[
				'label' => esc_html__( 'Border Radius', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.register' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
 	  $this->add_responsive_control(
			'textregister_padding',
			[
				'label' => esc_html__( 'Padding', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.register' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);
        $this->add_responsive_control(
			'textregister_margin',
			[
				'label' => esc_html__( 'Margin', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.register' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);
        $this->end_controls_tab();

		$this->start_controls_tab(
			'tab_buttonregister_hover',
			[
				'label' => esc_html__( 'Hover', 'freeagent' ),
			]
		);

		$this->add_control(
			'hoverregister_color',
			[
				'label' => esc_html__( 'Text Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.register:hover' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'buttonregister_bg_hover_color_hover',
			[
				'label' => esc_html__( 'Background Hover Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.register:hover' => 'background:{{VALUE}};',
				],

			]
		);

		$this->add_control(
			'buttonregister_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.register:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
        $this->end_controls_tabs();
        
         $this->end_controls_section();
                 $this->start_controls_section(
			'section_style_logged',
			[
				'label' => esc_html__( 'Logout', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_logged',
				'scheme' => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} a.elementor-button-link.logged',
			]
		);
        $this->start_controls_tabs( 'tabs_button_logged_style' );

		$this->start_controls_tab(
			'tablogged_button_normal',
			[
				'label' => esc_html__( 'Normal', 'freeagent' ),
			]
		);

		$this->add_control(
			'buttonlogged_text_color',
			[
				'label' => esc_html__( 'Text Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.logged' => 'color: {{VALUE}};',
				],
			]
		);
         $this->add_control(
			'buttonlogged_type',
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
			'buttonlogged_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.logged' => 'background:{{VALUE}};',
				],
				'default' => '',
                'condition' => [
					'buttonlogged_type' => 'classic',
				],
			]
		);
        $this->add_control(
			'buttonlogged_bggradient_color',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
                'condition' => [
					'buttonlogged_type' => 'gradient',
				],
			]
		);
        $this->add_control(
			'buttonlogged_bggradient_color2',
			[
				'label' => esc_html__( 'Background Second Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.logged' => 'background-image: linear-gradient(to right, {{button_bggradient_color.VALUE}} 0%, {{VALUE}} 51%, {{button_bggradient_color.VALUE}} 100%);background-size: 200% auto;',
                    '{{WRAPPER}} a.elementor-button-link.logged:hover' => 'background-position: right center;',
				],
                'condition' => [
					'buttonlogged_type' => 'gradient',
				],
			]
		);
        
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_logged',
				'selector' => '{{WRAPPER}} a.elementor-button-link.logged',
			
			]
		);
		$this->add_control(
			'borderlogged_radius',
			[
				'label' => esc_html__( 'Border Radius', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.logged' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
 	  $this->add_responsive_control(
			'textlogged_padding',
			[
				'label' => esc_html__( 'Padding', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.logged' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);
        $this->add_responsive_control(
			'textlogged_margin',
			[
				'label' => esc_html__( 'Margin', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.logged' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);
        $this->end_controls_tab();

		$this->start_controls_tab(
			'tab_buttonlogged_hover',
			[
				'label' => esc_html__( 'Hover', 'freeagent' ),
			]
		);

		$this->add_control(
			'hoverlogged_color',
			[
				'label' => esc_html__( 'Text Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.logged:hover' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'buttonlogged_bg_hover_color_hover',
			[
				'label' => esc_html__( 'Background Hover Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.logged:hover' => 'background:{{VALUE}};',
				],

			]
		);

		$this->add_control(
			'buttonlogged_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-link.logged:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
	    $this->end_controls_tabs();
        
         $this->end_controls_section();
    }
    	/**
	 * Render button widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
    * @since 1.5.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
        global $jws_option;
          if ( is_user_logged_in() || isset($_GET['p']) ) { 
            $this->add_render_attribute( 'wrapper', 'class', ['elementor-button-wrapper','logged', 'jws_button_login'] );
            $this->add_render_attribute( 'button_logout', 'href', ''.wp_logout_url( get_permalink() ).'' );
            	$this->add_render_attribute( 'button_logout', 'class', ['', 'logged']);

          }else{
            $this->add_render_attribute( 'wrapper', 'class',[ 'elementor-button-wrapper', 'jws_button_login'] );
          }
          
        if ( !empty( $jws_option['login_form_page'] ) && !empty($jws_option['register_form_page']) ) {
            $url_register = get_page_link($jws_option['register_form_page']);
            $url_login = get_page_link($jws_option['login_form_page']); 
        }else{
           $url_register = esc_url(jws_get_register_url());
            $url_login = esc_url( jws_get_login_page_url() );
        }
        
		if ( ! empty($url_login ) ) {
			$this->add_render_attribute( 'button_login', 'href',$url_login );
			$this->add_render_attribute( 'button_login', 'class', ['elementor-button-link elementor-button', 'login']);
		}
        
		if ( ! empty($url_register ) ) {
			$this->add_render_attribute( 'button_sign', 'href', $url_register );
			$this->add_render_attribute( 'button_sign', 'class', ['elementor-button-link elementor-button', 'register']);

		}
	  
      $this->add_render_attribute( 'text', 'class', 'elementor-button-text');
        ?>
       		<div <?php echo ''.$this->get_render_attribute_string( 'wrapper' ); ?>>
            <?php  if ( is_user_logged_in() || isset($_GET['p']) ) { 
				global $jws_option;
                // $link_dashboard = $jws_option['select-page-dashboard'];
				$user_info  = get_userdata( get_current_user_id() );
				$user_roles = $user_info->roles;
				$link_dashboard = (in_array('customer', $user_roles)) ? $jws_option['client_form_page'] : $jws_option['professional_form_page'];
                ?>
            <?php
                if($settings['enable_icon']=='yes'){
                 ?>
                 <a href="<?php echo get_permalink($link_dashboard);?>" class="elementor-button-link elementor-button login">
                	<?php 
                        if ($settings['icon']['library']=='svg') {
                            // If the output contains '<svg', it's an SVG icon
                            \Elementor\Icons_Manager::get_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
                        } else {
                            // If it doesn't contain '<svg', assume it's not an SVG and use it in an <i> element
                            echo '<i aria-hidden="true" class="' . esc_attr($settings['icon']['value']) . '"></i>';
                        }
                        ?>
                 </a>
                 <?php   
                }else{
					
            ?>

            	 <a href="<?php echo wp_logout_url( home_url() ); ?>" class="elementor-button-link elementor-button login">
    				<span <?php echo ''.$this->get_render_attribute_string( 'text' ); ?>  ><?php echo esc_html($settings['text_logged']);?></span>
    			</a>              
    			<a href="<?php echo get_permalink($link_dashboard); ?>" class="elementor-button-link elementor-button register">
    				<span <?php echo ''.$this->get_render_attribute_string( 'text' ); ?>  ><?php echo esc_html__('Dashboard','freeagent'); ?></span>
    			</a>
    		
            <?php }
             }else{?>
                   	  <a <?php echo ''.$this->get_render_attribute_string( 'button_login' ); ?>>
            				<span <?php echo ''.$this->get_render_attribute_string( 'text' ); ?>  ><?php echo esc_html($settings['text_login']); ?></span>
            			</a>
            			<a <?php echo ''.$this->get_render_attribute_string( 'button_sign' ); ?>>
            				<span <?php echo ''.$this->get_render_attribute_string( 'text' ); ?>  ><?php echo esc_html($settings['text_register']); ?></span>
            			</a>
            <?php }?>
		</div> 
    <?php 
    }
    	/**
	 * Render button widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() {
	   			?>
		<#
		var iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' );
		#>
		<div class="elementor-button-link elementor-button login">
			{{{ iconHTML.value }}}
		</div>
		<?php
	}
  }