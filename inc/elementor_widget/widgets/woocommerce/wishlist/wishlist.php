<?php
namespace Elementor;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Background;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Wishlist extends Widget_Base {

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
		return 'jws_wishlist';
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
		return esc_html__( 'Jws Wishlist', 'freeagent' );
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
		return 'eicon-heart-o';
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
	 * Retrieve the list of scripts the image carousel widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'jws-mini-wishlist'];
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
			'section_menu_icon_content',
			[
				'label' => esc_html__( 'Menu Icon', 'freeagent' ),
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
			'wishlist_text',
			[
				'label' => esc_html__( 'wishlist Text', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'My wishlist', 'freeagent' ),
			]
		);
		$this->add_responsive_control(
			'alignment',
			[
				'label' => esc_html__( 'Alignment', 'freeagent' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'freeagent' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'freeagent' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'freeagent' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws_wishlist .jws-wishlist-nav' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_toggle_style',
			[
				'label' => esc_html__( 'Menu Icon', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
      
		$this->start_controls_tabs( 'toggle_button_colors' );

		$this->start_controls_tab( 'toggle_button_normal_colors', [ 'label' => esc_html__( 'Normal', 'freeagent' ) ] );

		$this->add_control(
			'toggle_button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_wishlist > .jws-wishlist-nav a .wishlist_text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'toggle_button_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_wishlist a .wishlist_icon' => 'color: {{VALUE}}',
				],
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab( 'toggle_button_hover_colors', [ 'label' => esc_html__( 'Hover', 'freeagent' ) ] );
        
		$this->add_control(
			'toggle_button_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_wishlist a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'toggle_button_hover_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_wishlist > a:hover .wishlist_icon' => 'color: {{VALUE}}',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->add_control(
			'heading_icon_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Icon', 'freeagent' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'toggle_icon_size',
			[
				'label' => esc_html__( 'Size', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .jws_wishlist a span.wishlist_icon' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'heading_count_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Count', 'freeagent' ),
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
			'count_size',
			[
				'label' => esc_html__( 'Count Width,Height', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 50,
					],
				],
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .jws_wishlist .jws_wishlist_count' => 'min-width: {{SIZE}}px;min-height: {{SIZE}}px;',
				],
			]
		);
        $this->add_control(
			'count_x',
			[
				'label' => esc_html__( 'X position', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .jws_wishlist .jws_wishlist_count' => 'left: {{SIZE}}px;',
				],
			]
		);
        $this->add_control(
			'count_y',
			[
				'label' => esc_html__( 'Y position', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .jws_wishlist .jws_wishlist_count' => 'top: {{SIZE}}px;',
				],
			]
		);
	 

        $this->add_control(
			'heading_text_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Text', 'freeagent' ),
				'separator' => 'before',
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wishlist_text_typography',
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .jws_wishlist a > span:not(.wishlist_icon)',
			]
		);

		$this->end_controls_section();


	}

	protected function render() {
	    $settings = $this->get_settings();        
		if (class_exists('Woocommerce')) { include( 'content.php' ); }
	}

	protected function content_template() {}
}
