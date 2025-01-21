<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * jws Countdown Widget
 *
 * jws Widget to display countdown.
 *
 * @since 1.0
 */

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Typography;
use ELementor\Group_Control_Background;
use ELementor\Group_Control_Border;

class Jws_Countdown_Elementor_Widget extends Widget_Base {

	public function get_name() {
		return 'jws_widget_countdown';
	}

	public function get_title() {
		return esc_html__( 'Jws Countdown', 'freeagent' );
	}

	public function get_icon() {
		return 'eicon-countdown';
	}

	public function get_categories() {
		return array( 'jws-elements' );
	}

	public function get_keywords() {
		return array( 'countdown', 'counter', 'timer' );
	}
    public function get_style_depends() {
		return array( 'timeTo' );
	}

	public function get_script_depends() {
		return array( 'jquery-time-to' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_countdown',
			array(
				'label' => esc_html__( 'Countdown', 'freeagent' ),
			)
		);
        $this->add_control(
				'layout',
				[
					'label'     => esc_html__( 'Display', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'default',
					'options'   => [
						'default'   => esc_html__( 'Default', 'freeagent' ),
					],
                    
				]
			);
		$this->add_control(
			'date',
			array(
				'label'       => esc_html__( 'Target Date', 'freeagent' ),
				'type'        => Controls_Manager::DATE_TIME,
				'default'     => '',
				'description' => esc_html__(
					'Set the certain date the countdown element will count down to.',
					'freeagent'
				),
                'condition'	=> [
						'layout' => 'default',
				],
			)
		);
	
		$this->add_control(
			'align',
			array(
				'label'       => esc_html__( 'Alignment', 'freeagent' ),
				'type'        => Controls_Manager::CHOOSE,
				'default'     => 'flex-start',
				'options'     => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'freeagent' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'freeagent' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Right', 'freeagent' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors'   => array(
					'.elementor-element-{{ID}} .countdown-container' => 'justify-content: {{VALUE}}',
				),
				'description' => esc_html__(
					'Determine where the countdown is located, left, center or right.​',
					'freeagent'
				),
			)
		);

		$this->end_controls_section();
        $this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Box Style', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'align_number',
			array(
				'label'       => esc_html__( 'Alignment Number', 'freeagent' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'left' => array(
						'title' => esc_html__( 'Left', 'freeagent' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'freeagent' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'   => array(
						'title' => esc_html__( 'Right', 'freeagent' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors'   => array(
					'.elementor-element-{{ID}} .countdown-container .timeTo' => 'text-align: {{VALUE}}',
				),

			)
		);
		$this->add_responsive_control(
			'time_width',
			[
				'label'     => esc_html__( 'Box Width', 'freeagent' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' =>500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-countdown-animation > figure' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
        $this->add_responsive_control(
			'number_width',
			[
				'label' => esc_html__( 'Digits size', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],

				'selectors' => [
					'{{WRAPPER}} .timeTo ul' => 'width: {{SIZE}}%;',
				],
			]
		);
        $this->add_responsive_control(
			'box_margin',
			[
				'label' 		=> esc_html__( 'Margin', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-countdown-animation > figure:not(:last-child)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
				],
			]
		);
        $this->end_controls_section();
         $this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content Style', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		  $this->add_control(
				'dots_style',
				[
					'label'     => esc_html__( 'Dots', 'freeagent' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'dos_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .timeTo span.dot',
			]
        );
        $this->add_control(
			'dots_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
				'selectors' => [
					'{{WRAPPER}} .timeTo span.dot' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'dots_opacity',
			[
				'label'     => esc_html__( 'Opacity', 'freeagent' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .timeTo span.dot' => 'opacity: {{SIZE}};',
				],
			]
		);
        $this->add_responsive_control(
			'dots_margin',
			[
				'label' 		=> esc_html__( 'Margin', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .timeTo span.dot' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		  $this->add_control(
				'digits_style',
				[
					'label'     => esc_html__( 'Digits', 'freeagent' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'digits_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .timeTo ul li',
			]
        );
        $this->add_control(
			'digits_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
				'selectors' => [
					'{{WRAPPER}} .timeTo.timeTo-white div' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'digits_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
				'selectors' => [
					'{{WRAPPER}} .timeTo.timeTo-white div' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'digit_width',
			[
				'label'     => esc_html__( 'Width', 'freeagent' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-countdown-animation div' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
		$this->add_responsive_control(
			'digit_height',
			[
				'label'     => esc_html__( 'Height', 'freeagent' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-countdown-animation div' => 'height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
        $this->add_responsive_control(
			'digit_detail_margin',
			[
				'label' 		=> esc_html__( 'Margin Number', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-countdown-animation figure >div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
 
        $this->add_responsive_control(
			'digit_padding',
			[
				'label' 		=> esc_html__( 'Padding', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-countdown-animation figure' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
				'label_style',
				[
					'label'     => esc_html__( 'Label', 'freeagent' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'label' => esc_html__( 'Typography', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-countdown-animation figcaption',
			]
        );
        $this->add_control(
			'label_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-countdown-animation figcaption' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_responsive_control(
			'label_margin',
			[
				'label' 		=> esc_html__( 'Margin', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-countdown-animation figcaption' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'label_padding',
			[
				'label' 		=> esc_html__( 'Padding', 'freeagent' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-countdown-animation figcaption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

    $this->end_controls_section();
	}

	protected function render() {
		$atts = $this->get_settings_for_display();

		include 'content.php';
	}
}
