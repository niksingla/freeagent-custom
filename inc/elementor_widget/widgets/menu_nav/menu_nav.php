<?php
namespace Elementor;
use Elementor\Controls_Manager;
use Elementor\Core\Responsive\Responsive;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Nav_Menu extends Widget_Base {

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
		return 'jws_menu_nav';
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
		return esc_html__( 'Jws Nav Menu', 'freeagent' );
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
		return 'eicon-nav-menu';
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
        $this->register_content_nav_menu_controls();
        $this->register_style_nav_controls();
        $this->register_style_sub_menu_controls();
        $this->register_style_sub_mega_controls();
	}
    /**
	 * Register Nav Menu General Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	*/
	protected function register_content_nav_menu_controls() {

		$this->start_controls_section(
			'section_layout',
			[
				'label' => esc_html__( 'Layout', 'freeagent' ),
			]
		);
         $this->add_control(
			'layout',
			[
				'label' => esc_html__( 'Layout', 'freeagent' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'menu_horizontal' => esc_html__( 'Horizontal Menu', 'freeagent' ),
                    'menu_vertical' => esc_html__( 'Vertical Menu', 'freeagent' ),
				],
				'default' => 'menu_horizontal',
                'prefix_class' => 'elementor_jws_menu_layout_',
			]
		);
        $this->add_control(
    			'enable_click_show_menu',
    			[
    				'label' => esc_html__( 'Enable Button Click Show Menu', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::SWITCHER,
    				'label_on' => esc_html__( 'On', 'freeagent' ),
    				'label_off' => esc_html__( 'Off', 'freeagent' ),
    				'return_value' => 'yes',
                    'condition' => [
						  'layout' => 'menu_vertical',
				    ],
    			]
    	);
        $this->add_control(
    			'enable_oppen',
    			[
    				'label' => esc_html__( 'Enable Open', 'freeagent' ),
    				'type' => \Elementor\Controls_Manager::SWITCHER,
    				'label_on' => esc_html__( 'On', 'freeagent' ),
    				'label_off' => esc_html__( 'Off', 'freeagent' ),
    				'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
						  'layout' => 'menu_vertical',
				    ],
    			]
    	);    
		$menus = $this->get_available_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu',
				[
					'label' => esc_html__( 'Menu', 'freeagent' ),
					'type' => Controls_Manager::SELECT,
					'options' => $menus,
					'default' => array_keys( $menus )[0],
					'save_default' => true,
					'separator' => 'after',
					'description' => sprintf( esc_html__( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'freeagent' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		} else {
			$this->add_control(
				'menu',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => '<strong>' . esc_html__( 'There are no menus in your site.', 'freeagent' ) . '</strong><br>' . sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'freeagent' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator' => 'after',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}
        $this->add_responsive_control(
			'align_items',
			[
				'label' => esc_html__( 'Nav Menu Align', 'freeagent' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'freeagent' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'freeagent' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'freeagent' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}.elementor_jws_menu_layout_menu_horizontal > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul' => 'justify-content: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'skins',
			[
				'label' => esc_html__( 'Skins', 'freeagent' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'skin1' => esc_html__( 'skin 1', 'freeagent' ),
                    'skin2' => esc_html__( 'skin 2', 'freeagent' ),
				],
				'default' => 'skin1',
                'prefix_class' => 'elementor-jws-menu-skin-',
			]
		);
          $this->add_control(
			'before_menu_item',
			[
				'label' => esc_html__( 'Hover Menu', 'freeagent' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'None', 'freeagent' ),
                    'animation-line' => esc_html__( 'Line Animation', 'freeagent' ),
                    'line' => esc_html__( 'Line', 'freeagent' ),
				],
				'default' => 'none',
                'prefix_class' => 'elementor-before-menu-skin-',
			]
		);
		$this->end_controls_section();
	}
    /**
	 * Style Tab
	*/
	/**
	 * Register Nav Menu Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_style_nav_controls() {
	    $this->start_controls_section(
			'section_style_toggle',
			[
				'label' => esc_html__( 'Button Toggle Menu Vertical', 'freeagent' ),
				'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
						  'enable_click_show_menu' => 'yes',
				],
			]
		);   
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'menu_toggle_typography',
				'label' => esc_html__( 'Typography', 'freeagent'),
				'selector' => '{{WRAPPER}} .toggle-menu-title a',
			]
		);
        $this->add_control(
					'menu_toggle_color',
					[
						'label' 	=> esc_html__( 'Text Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .toggle-menu-title a' => 'color: {{VALUE}};',
						],
					]
		);
        $this->add_control(
					'menu_toggle_bgcolor',
					[
						'label' 	=> esc_html__( 'Background Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .toggle-menu-title' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .jws_main_menu_inner.menu-toggle' => 'border-color: {{VALUE}};',
						],
					]
		);
        
         $this->add_control(
			'menu_toggle_bdcolor',
			[
				'label' 	=> esc_html__( 'Dropdown Border Color', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .jws_main_menu_inner.menu-toggle' => 'border-color: {{VALUE}};',
				],
			]
		);
        $this->add_responsive_control(
			'menu_toggle_button_padding',
			[
				'type' 			=> Controls_Manager::DIMENSIONS,
				'label' 		=> esc_html__( 'Button Padding', 'freeagent' ),
				'size_units' 	=> [ 'px', '%' , 'vw' ],
				'selectors' 	=> [
					'{{WRAPPER}} .toggle-menu-title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'menu_toggle_padding',
			[
				'type' 			=> Controls_Manager::DIMENSIONS,
				'label' 		=> esc_html__( 'Dropdown Padding', 'freeagent' ),
				'size_units' 	=> [ 'px', '%' , 'vw' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws_main_menu_inner.menu-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_section();
        
		$this->start_controls_section(
			'section_style_nav',
			[
				'label' => esc_html__( 'Nav Menu', 'freeagent' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        
        $this->start_controls_tabs( 'nav_tabs_style' );

		$this->start_controls_tab(
				'nav_normal',
				[
					'label'     => esc_html__( 'Normal', 'freeagent' ),
				]
		);
        $this->add_control(
					'nav_color_active',
					[
						'label' 	=> esc_html__( 'Text Color Active', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner> ul > li.current-menu-item > a, 
                            {{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li.current-menu-item > .btn-sub-menu' => 'color: {{VALUE}};',
						],
					]
		  );

                $this->add_control(
					'nav_color',
					[
						'label' 	=> esc_html__( 'Text Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner> ul > li > a, {{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li .btn-sub-menu' => 'color: {{VALUE}};',
						],
					]
		  );
                $this->add_control(
					'icon_color',
					[
						'label' 	=> esc_html__( 'Icon Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .jws_main_menu > .jws_main_menu_inner > ul > li > a > i' => 'color: {{VALUE}};',
						],
					]
		);
         $this->add_control(
					'nav_bgcolor',
					[
						'label' 	=> esc_html__( 'Text Back ground Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li a' => 'background: {{VALUE}};',
						],
					]
		);

         $this->add_control(
			'line_color',
			[
				'label' 	=> esc_html__( 'Line Color', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > .nav > li > a > span:before' => 'background: {{VALUE}};',
				],
			]
		);
        $this->add_responsive_control(
			'line_spacing',
			[
				'label' 	=> esc_html__( 'Line Animate Spacing', 'freeagent' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array(
					'px',
					'em',
					'%',
				),
				'selectors' => [
					'{{WRAPPER}}.elementor_jws_menu_layout_menu_horizontal.elementor-before-menu-skin-line > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > .nav > li > a > span:before' => 'bottom:  {{SIZE}}{{UNIT}};',
                    
				],
                'condition' => ['before_menu_item' => 'line'],
			]
		);
  $this->add_responsive_control(
			'line_height',
			[
				'label' 	=> esc_html__( 'Line Animate Height', 'freeagent' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array(
					'px',
					'em',
					'%',
				),
				'selectors' => [
					'{{WRAPPER}}.elementor_jws_menu_layout_menu_horizontal.elementor-before-menu-skin-line > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > .nav > li > a > span:before' => 'height:  {{SIZE}}{{UNIT}};',
                    
				],
                'condition' => ['before_menu_item' => 'line'],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'nav_typography',
				'label' => esc_html__( 'Typography', 'freeagent'),
				'selector' => '{{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul.nav > li > a',
			]
		);
        $this->end_controls_tab();

		$this->start_controls_tab(
				'nav_hover',
				[
					'label'     => esc_html__( 'Hover', 'freeagent' ),
				]
		);
         $this->add_control(
					'nav_color_hover',
					[
						'label' 	=> esc_html__( 'Text Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li > a:hover , 
                            {{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li.current-menu-ancestor > a ,
                            {{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li.current-menu-item > a , 
                            {{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li.current-menu-parent > a,
                            {{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li.active > a,
                            {{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li.current-menu-item > .btn-sub-menu,
                            {{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li.active > .btn-sub-menu' => 'color: {{VALUE}};',
						],
					]
		);
         $this->add_control(
					'nav_bgcolor_hover',
					[
						'label' 	=> esc_html__( 'Text Back ground Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li > a:hover ,
                            {{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li.current-menu-ancestor > a ,
                            {{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li.current-menu-item > a , 
                            {{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li.current-menu-parent > a,
                            {{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li.active > a' => 'background: {{VALUE}};',
						],
					]
		);
        $this->add_control(
					'nav_bordercolor_hover',
					[
						'label' 	=> esc_html__( 'Border Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li > a:hover ,
                             {{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li.current-menu-ancestor > a ,
                             {{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li.current-menu-item > a , 
                             {{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li.current-menu-parent > a,
                             {{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li.active > a' => 'border-color: {{VALUE}};',
						],
					]
		);
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
				'nav_sticky',
				[
					'label'     => esc_html__( 'Sticky', 'freeagent' ),
				]
		);
         $this->add_control(
					'nav_color_sticky',
					[
						'label' 	=> esc_html__( 'Text Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'body[data-elementor-device-mode="desktop"] .elementor-element.is-sticky  .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li > a ,
                            .mega-has-hover {{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li > a' => 'color: {{VALUE}} !important;',
						],
					]
		);
        $this->add_control(
					'nav_color_sticky_hover',
					[
						'label' 	=> esc_html__( 'Text Color Hover', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'body[data-elementor-device-mode="desktop"] .elementor-element.is-sticky  .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li > a:hover ,
                             body[data-elementor-device-mode="desktop"] .elementor-element.is-sticky  .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li > a:hover ,
                             body[data-elementor-device-mode="desktop"] .elementor-element.is-sticky  .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li.current-menu-item > a ,
                             body[data-elementor-device-mode="desktop"] .elementor-element.is-sticky  .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li.current-menu-ancestor > a ,
                             body[data-elementor-device-mode="desktop"] .elementor-element.is-sticky  .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li.current-menu-parent > a ,
                             .mega-has-hover {{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li > a:hover' => 'color: {{VALUE}} !important;',
						],
					]
		);
        $this->add_control(
					'nav_bordercolor_sticky',
					[
						'label' 	=> esc_html__( 'Border Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'body[data-elementor-device-mode="desktop"] .elementor-element.is-sticky  .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul.nav > li > a:hover , body[data-elementor-device-mode="desktop"] .elementor-element.is-sticky  .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li.current-menu-item > a , .mega-has-hover  {{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li > a:hover' => 'border-color: {{VALUE}} !important;',
						],
					]
		);
        $this->add_control(
					'bg_after_item_color_sticky',
					[
						'label' 	=> esc_html__( 'After Item Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'.is-sticky .elementor_jws_menu_layout_menu_horizontal.elementor-before-menu-skin-line .jws_main_menu .jws_main_menu_inner .nav > li > a:before , .mega-has-hover .elementor_jws_menu_layout_menu_horizontal.elementor-before-menu-skin-line .jws_main_menu .jws_main_menu_inner .nav > li > a:before' => 'background: {{VALUE}} !important;',
                            '.is-sticky .elementor_jws_menu_layout_menu_horizontal.elementor-before-menu-skin-square .jws_main_menu .jws_main_menu_inner > span#magic_line , .mega-has-hover .elementor_jws_menu_layout_menu_horizontal.elementor-before-menu-skin-square .jws_main_menu .jws_main_menu_inner > span#magic_line' => 'background: {{VALUE}} !important;',
						],
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'nav_typography_sticky',
				'label' => esc_html__( 'Typography', 'freeagent'),
				'selector' => 'body[data-elementor-device-mode="desktop"] .elementor-element.is-sticky  .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul.nav > li > a',
			]
		);
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->add_responsive_control(
				'nav_padding',
				[
					'type' 			=> Controls_Manager::DIMENSIONS,
					'label' 		=> esc_html__( 'Padding', 'freeagent' ),
					'size_units' 	=> [ 'px', '%' , 'vw' ],
					'selectors' 	=> [
						'{{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner> ul > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
		);
        $this->add_responsive_control(
				'nav_paddingin',
				[
					'type' 			=> Controls_Manager::DIMENSIONS,
					'label' 		=> esc_html__( 'Padding In', 'freeagent' ),
					'size_units' 	=> [ 'px', '%' , 'vw' ],
					'selectors' 	=> [
						'{{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner> ul > li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
		);
        $this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 		=> 'nav_menu_borderin',
					'label' 	=> esc_html__( 'Border', 'freeagent' ),
					'selector' 	=> '{{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li > a',
				]
		);
        $this->add_responsive_control(
					'nav_margin',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' , 'vw' ],
						'selectors' 	=> [
							'{{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner> ul > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);

         $this->add_responsive_control(
			'align_items_item',
			[
				'label' => esc_html__( 'Nav Menu Item Align', 'freeagent' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'freeagent' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'freeagent' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'freeagent' ),
						'icon' => 'eicon-h-align-right',
					],
				],
                 'condition' => [
						  'layout' => 'menu_vertical',
				 ],
                 'selectors' 	=> [
							'{{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner> ul > li' => 'text-align: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 		=> 'nav_menu_border',
					'label' 	=> esc_html__( 'Border', 'freeagent' ),
					'selector' 	=> '{{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li',
				]
		);
        $this->add_responsive_control(
			'menunav_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 2,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner> ul > li > a > i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
          $this->add_responsive_control(
					'menunav_icon_margin',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' , 'vw' ],
						'selectors' 	=> [
							'{{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner> ul > li > a > i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
		$this->end_controls_section();
	}

    
    /**
	 * Register Sub Mega Menu Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_style_sub_menu_controls() {
		$this->start_controls_section(
			'section_style_sub',
			[
				'label' => esc_html__( 'Sub Menu', 'freeagent' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
				'sub_skins',
				[
					'label'     => esc_html__( 'Skins', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'skin1',
					'options'   => [
                        'none'   => esc_html__( 'Default', 'freeagent' ),
						'skin1'   => esc_html__( 'Hover Show Line Before', 'freeagent' ),
						'skin2' => esc_html__( 'Hover Show Line 2', 'freeagent' ),
					],
				]
		);
        $this->add_responsive_control(
			'sub_width',
			[
				'label' => esc_html__( 'Width', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws_main_menu .menu-item-design-standard .sub-menu' => 'min-width: {{SIZE}}{{UNIT}}',
				],
			]
		);
        $this->add_control(
					'sub_bg',
					[
						'label' 	=> esc_html__( 'Background Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .jws_main_menu .menu-item-design-standard .sub-menu' => 'background-color: {{VALUE}};',
						],
					]
		);
        $this->add_responsive_control(
					'sub_radius',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Border Radius', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_main_menu .menu-item-design-standard .sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
        $this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 		=> 'sub_border',
					'label' 	=> esc_html__( 'Border', 'freeagent' ),
					'selector' 	=> '{{WRAPPER}} .jws_main_menu .menu-item-design-standard .sub-menu,
                    {{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > ul > li .sub-menu',
				]
		);
        $this->add_responsive_control(
					'sub_pading',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Padding', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_main_menu .menu-item-design-standard .sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
        $this->add_responsive_control(
					'sub_margin',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Margin', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_main_menu .nav > .menu-item-design-standard > .sub-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
         $this->add_responsive_control(
					'btn_margin_sub',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Margin button mobile', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' , 'vw' ],
						'selectors' 	=> [
							'{{WRAPPER}}.elementor_jws_menu_layout_menu_vertical .jws_main_menu ul li .sub-menu .btn-sub-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
                         'condition' => [
						  'layout' => 'menu_vertical',
				        ],
					]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'sub_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws_main_menu .menu-item-design-standard .sub-menu',
			]
		);
        
        $this->add_responsive_control(
		'sub_item_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Item Font And Color', 'freeagent' ),
				'separator' => 'before',
			]
		);
        $this->add_responsive_control(
			'menu_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 2,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws_main_menu .menu-item-design-standard .sub-menu li a i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
					'menu_icon_color',
					[
						'label' 	=> esc_html__( 'Icon Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .jws_main_menu .menu-item-design-standard .sub-menu li a i' => 'color: {{VALUE}};',
						],
					]
		);
        $this->add_control(
					'sub_item_color',
					[
						'label' 	=> esc_html__( 'Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .jws_main_menu .menu-item-design-standard .sub-menu li a' => 'color: {{VALUE}};',
						],
					]
		);
        $this->add_control(
					'sub_item_bgcolor',
					[
						'label' 	=> esc_html__( 'Background Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .jws_main_menu .menu-item-design-standard .sub-menu li' => 'background: {{VALUE}};',
						],
					]
		);
        $this->add_control(
					'sub_item_color_hover',
					[
						'label' 	=> esc_html__( 'Color Hover & Active', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .elementor-widget-container .jws_main_menu .menu-item-design-standard .sub-menu li a:hover , 
                            {{WRAPPER}} .elementor-widget-container .jws_main_menu .menu-item-design-standard .sub-menu li.current-menu-item > a,
                            {{WRAPPER}} .elementor-widget-container .jws_main_menu .menu-item-design-standard .sub-menu li.current-menu-ancestor>a,
                            {{WRAPPER}} .elementor-widget-container .jws_main_menu .menu-item-design-standard .sub-menu li.active > a,
                            {{WRAPPER}} .elementor-widget-container .jws_main_menu .menu-item-design-standard .sub-menu li.active > .btn-sub-menu,
                            {{WRAPPER}} .elementor-widget-container .jws_main_menu .menu-item-design-standard .sub-menu li a:hover i
                            ' => 'color: {{VALUE}};'
						],
					]
		);
        $this->add_control(
					'sub_item_bgcolor_hover',
					[
						'label' 	=> esc_html__( 'Background Color Hover', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .jws_main_menu .menu-item-design-standard .sub-menu li:hover > a,
                             {{WRAPPER}} .jws_main_menu .menu-item-design-standard .sub-menu li.current-menu-item > a ,
                              {{WRAPPER}} .jws_main_menu .menu-item-design-standard .sub-menu li.active > a' => 'background: {{VALUE}} !important;',
						],
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_item_typography',
				'label' => esc_html__( 'Typography', 'freeagent'),
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .jws_main_menu .menu-item-design-standard .sub-menu li a',
			]
		);
        $this->add_responsive_control(
					'sub_item_pading',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Padding', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_main_menu .menu-item-design-standard .sub-menu li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
        $this->add_responsive_control(
		'sub_item_border',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Item Border', 'freeagent' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'sub_item_border_style',
			[
				'label' => esc_html__( 'Style', 'freeagent' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'None', 'freeagent' ),
					'solid' => esc_html__( 'Solid', 'freeagent' ),
					'double' => esc_html__( 'Double', 'freeagent' ),
					'dotted' => esc_html__( 'Dotted', 'freeagent' ),
					'dashed' => esc_html__( 'Dashed', 'freeagent' ),
					'groove' => esc_html__( 'Groove', 'freeagent' ),
				],
				'selectors' => [
					'{{WRAPPER}} .jws_main_menu .menu-item-design-standard .sub-menu li a' => 'border-bottom-style: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'sub_item_border_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_main_menu .menu-item-design-standard .sub-menu li a' => 'border-color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'sub_item_border_color_hover',
			[
				'label' => esc_html__( 'Color Hover', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_main_menu .menu-item-design-standard .sub-menu li a:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'sub_item_border_width',
			[
				'label' => esc_html__( 'Weight', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws_main_menu .menu-item-design-standard .sub-menu li a' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->end_controls_section();
	}
    /**
	 * Register Sub Mega Menu Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_style_sub_mega_controls() {
		$this->start_controls_section(
			'section_style_sub_mega',
			[
				'label' => esc_html__( 'Sub Mega Menu', 'freeagent' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'enble_hover_changebackground',
			[
				'label' => esc_html__( 'Endble Hover Change Background Header', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'freeagent' ),
				'label_off' => esc_html__( 'Hide', 'freeagent' ),
				'return_value' => 'yes',
				'prefix_class' => 'elementor-jws-menu-change-background-',
			]
		);
        $this->add_control(
					'sub_mega_bg',
					[
						'label' 	=> esc_html__( 'Background Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner> ul > li .sub-menu-dropdown' => 'background-color: {{VALUE}};',
						],
					]
		);
        
         $this->add_responsive_control(
					'sub_mega_padding',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Padding', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner> ul > li .sub-menu-dropdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'sub_mega_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'freeagent' ),
				'selector' => '{{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner> ul > li .sub-menu-dropdown',
			]
		);
        $this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 		=> 'sub_mega_border',
					'label' 	=> esc_html__( 'Sub Mega Border', 'freeagent' ),
					'selector' 	=> '{{WRAPPER}} .jws_main_menu_inner> ul > li .sub-menu-dropdown',
				]
		);
        $this->add_responsive_control(
					'sub_mega_radius',
					[
						'type' 			=> Controls_Manager::DIMENSIONS,
						'label' 		=> esc_html__( 'Border Radius', 'freeagent' ),
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner> ul > li .sub-menu-dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
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
        $attr = array(
                'menu_id' => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
                'menu' => $settings['menu'],
                'container' => '',
                'container_class' => 'jws_menu_list',
                'menu_class' => 'nav',
                'echo' => true,
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth' => 0,
         );
    
         ?>
             <div class="jws_main_menu<?php echo ' sub_skin_'.$settings['sub_skins']; ?>">   
                    <?php if($settings['enable_click_show_menu'] == 'yes') { ?>
                        <h3 class="toggle-menu-title">
                            <a class="click-show-menu-v" href="javascript:void(0);"><i class="jws-icon-icon_menu"></i><?php echo esc_html__('SHOP DEPARTMENTS','freeagent'); ?></a>
                        </h3>
                        
                   <?php } ?> 
                    <div class="jws_main_menu_inner<?php if($settings['enable_click_show_menu'] == 'yes') echo ' menu-toggle'; if($settings['enable_oppen'] == 'yes') echo ' open';?>">
                                <?php wp_nav_menu($attr); ?>
                    </div> 
             </div>  
         <?php

	}
    private function get_available_menus() {
		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
	}
    protected function get_nav_menu_index() {
		return $this->nav_menu_index++;
	}
    protected $nav_menu_index = 1;
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
