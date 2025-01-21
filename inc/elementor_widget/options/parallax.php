<?php

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

defined( 'ABSPATH' ) || die();

function ld_el_parallax($pf){

	$pf->add_control(
		'jws_parallax',
		[
			'label' => __( 'Parallax', 'freeagent' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'On', 'freeagent' ),
			'label_off' => __( 'Off', 'freeagent' ),
			'return_value' => 'yes',
			'default' => '',
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_settings_popover',
		[
			'label' => __( 'Settings', 'freeagent' ),
			'type' => Controls_Manager::POPOVER_TOGGLE,
			'label_off' => __( 'Default', 'freeagent' ),
			'label_on' => __( 'Custom', 'freeagent' ),
			'return_value' => 'yes',
			'default' => 'yes',
			'condition' => [
				'jws_parallax' => 'yes'
			],
			'render_type' => 'none',
		]
	);

	// Parallax Settings
	$pf->start_popover();
		$pf->add_control(
			'jws_parallax_settings_ease',
			[
				'label' => __( 'Easing', 'freeagent' ),
				'type' => Controls_Manager::SELECT,
				'default' => [ 'linear' ],
				'options' => [
					'linear' => 'linear',
					'power1.in' => 'power1.in',
					'power2.in' => 'power2.in',
					'power3.in' => 'power3.in',
					'power4.in' => 'power4.in',
					'sine.in' => 'sine.in',
					'expo.in' => 'expo.in',
					'circ.in' => 'circ.in',
					'back.in' => 'back.in',
					'bounce.in' => 'bounce.in',
					'elastic.in(1,0.2)' => 'elastic.in(1,0.2)',
					'power1.out' => 'power1.out',
					'power2.out' => 'power2.out',
					'power3.out' => 'power3.out',
					'power4.out' => 'power4.out',
					'sine.out' => 'sine.out',
					'expo.out' => 'expo.out',
					'circ.out' => 'circ.out',
					'back.out' => 'back.out',
					'bounce.out' => 'bounce.out',
					'elastic.out(1,0.2)' => 'elastic.out(1,0.2)',
					'power1.inOut' => 'power1.inOut',
					'power2.inOut' => 'power2.inOut',
					'power3.inOut' => 'power3.inOut',
					'power4.inOut' => 'power4.inOut',
					'sine.inOut' => 'sine.inOut',
					'expo.inOut' => 'expo.inOut',
					'circ.inOut' => 'circ.inOut',
					'back.inOut' => 'back.inOut',
					'bounce.inOut' => 'bounce.inOut',
					'elastic.inOut(1,0.2)' => 'elastic.inOut(1,0.2)',
				],
				'condition' => [
					'jws_parallax_settings_popover' => 'yes',
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_parallax_settings_trigger',
			[
				'label' => __( 'Trigger', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'top bottom',
				'options' => [
					'top bottom'  => __( 'On Enter', 'freeagent' ),
					'top top' => __( 'On Leave', 'freeagent' ),
					'center center' => __( 'On Center', 'freeagent' ),
					'custom' => __( 'Custom', 'freeagent' ),
				],
				'condition' => [
					'jws_parallax_settings_popover' => 'yes',
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_parallax_trigger_desc',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => sprintf( __( '<div style="font-style: normal;">For custom start and end values you can use keywords like <b>top, bottom, left, right and center</b>. You can also use numbers. E.g. <b>50&#x25; 50&#x25;</b>. Or you can use relative values e.g. <b>top bottom-=25&#x25;</b>.</div>', 'freeagent' ) ),
				'separator' => 'before',
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				'condition' => array(
					'jws_parallax_settings_trigger' => 'custom',
					'jws_parallax_settings_popover' => 'yes',
				),
			]
		);

		$pf->add_control(
			'jws_parallax_settings_trigger_start',
			[
				'label' => __( 'Trigger Start', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Default: top bottom', 'freeagent' ),
				'default' => 'top bottom',
				'description' => __( 'Define when parallax starts. Default is <b>top bottom</b> which means starts when <b>top</b> of the element hits the <b>bottom</b> of the viewport.', 'freeagent' ),
				'condition' => array(
					'jws_parallax_settings_trigger' => 'custom',
					'jws_parallax_settings_popover' => 'yes',
				),
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_parallax_settings_trigger_end',
			[
				'label' => __( 'Trigger End', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Default: bottom top', 'freeagent' ),
				'default' => 'bottom top',
				'description' => __( 'Define when parallax ends. Default is <b>bottom top</b> which means ends when <b>bottom</b> of the element hits the <b>top</b> of the viewport.', 'freeagent' ),
				'condition' => array(
					'jws_parallax_settings_trigger' => 'custom',
					'jws_parallax_settings_popover' => 'yes',
				),
				'separator' => 'after',
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_parallax_settings_duration',
			[
				'label' => __( 'Increase / Decrease Duration', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
							'min' => -500,
							'max' => 500,
							'step' => 1,
						],
						'%' => [
							'min' => -500,
							'max' => 500,
							'step' => 0.1,
						],
				],
				'default' => [
					'size' => 0,
				],
				'condition' => [
					'jws_parallax_settings_popover' => 'yes',
					'jws_parallax_settings_trigger!' => 'custom',
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_parallax_settings_perspective',
			[
				'label' => __( 'Perspective', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
							'min' => 0,
							'max' => 2000,
							'step' => 1,
						],
				],
				'default' => [
					'size' => '',
				],
				'condition' => [
					'jws_parallax_settings_popover' => 'yes',
				],
				'render_type' => 'none',
			]
		);
	$pf->end_popover();

	// Parallax From Options
	$pf->add_control(
		'jws_parallax_from_options',
		[
			'label' => __( 'Parallax from', 'freeagent' ),
			'type' => Controls_Manager::POPOVER_TOGGLE,
			'label_off' => __( 'Default', 'freeagent' ),
			'label_on' => __( 'Custom', 'freeagent' ),
			'return_value' => 'yes',
			'default' => 'yes',
			'condition' => [
				'jws_parallax' => 'yes'
			],
			'render_type' => 'none',
		]
	);
	$pf->start_popover();
	$pf->add_control(
		'jws_parallax_from_x',
		[
			'label' => __( 'Translate X', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'vw', 'vh' ],
			'range' => [
				'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 0.1,
					],
					'vw' => [
						'min' => -100,
						'max' => 100,
						'step' => 0.1,
					],
					'vh' => [
						'min' => -100,
						'max' => 100,
						'step' => 0.1,
					],
			],
			'default' => [
				'size' => 0,
			],
			'condition' => [
				'jws_parallax_from_options' => 'yes'
			],
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_from_y',
		[
			'label' => __( 'Translate Y', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'vw', 'vh' ],
			'range' => [
				'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 0.1,
					],
					'vw' => [
						'min' => -100,
						'max' => 100,
						'step' => 0.1,
					],
					'vh' => [
						'min' => -100,
						'max' => 100,
						'step' => 0.1,
					],
			],
			'default' => [
				'size' => 0,
			],
			'condition' => [
				'jws_parallax_from_options' => 'yes'
			],
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_from_z',
		[
			'label' => __( 'Translate Z', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 1
				]
			],
			'default' => [
				'size' => 0,
			],
			'separator' => 'after',
			'condition' => [
				'jws_parallax_from_options' => 'yes'
			],
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_from_scaleX',
		[
			'label' => __( 'Scale X', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 5,
					'step' => 0.1,
				],
			],
			'default' => [
				'size' => 1,
			],
			'condition' => [
				'jws_parallax_from_options' => 'yes'
			],
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_from_scaleY',
		[
			'label' => __( 'Scale Y', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 5,
					'step' => 0.1,
				],
			],
			'default' => [
				'size' => 1,
			],
			'condition' => [
				'jws_parallax_from_options' => 'yes'
			],
			'separator' => 'after',
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_from_rotationX',
		[
			'label' => __( 'Rotate X', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => -360,
					'max' => 360,
					'step' => 1,
				],
			],
			'default' => [
				'size' => 0,
			],
			'condition' => [
				'jws_parallax_from_options' => 'yes'
			],
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_from_rotationY',
		[
			'label' => __( 'Rotate Y', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => -360,
					'max' => 360,
					'step' => 1,
				],
			],
			'default' => [
				'size' => 0,
			],
			'condition' => [
				'jws_parallax_from_options' => 'yes'
			],
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_from_rotationZ',
		[
			'label' => __( 'Rotate Z', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => -360,
					'max' => 360,
					'step' => 1,
				],
			],
			'default' => [
				'size' => 0,
			],
			'condition' => [
				'jws_parallax_from_options' => 'yes'
			],
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_from_opacity',
		[
			'label' => __( 'Opacity', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 1,
					'step' => 0.1,
				],
			],
			'default' => [
				'size' => 1,
			],
			'condition' => [
				'jws_parallax_from_options' => 'yes'
			],
			'separator' => 'before',
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_from_transformOriginX',
		[
			'label' => __( 'Transform origin X', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'range' => [
				'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 0.1,
					],
			],
			'default' => [
				'size' => 50,
				'unit' => '%',
			],
			'separator' => 'before',
			'condition' => [
				'jws_parallax_from_options' => 'yes'
			],
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_from_transformOriginY',
		[
			'label' => __( 'Transform origin Y', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'range' => [
				'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 0.1,
					],
			],
			'default' => [
				'size' => 50,
				'unit' => '%',
			],
			'condition' => [
				'jws_parallax_from_options' => 'yes'
			],
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_from_transformOriginZ',
		[
			'label' => __( 'Transform origin Z', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 1,
					],
			],
			'default' => [
				'size' => 0,
			],
			'condition' => [
				'jws_parallax_from_options' => 'yes'
			],
			'render_type' => 'none',
		]
	);

	$pf->end_popover(); // parallax from

	// Parallax To Options
	$pf->add_control(
		'jws_parallax_to_options',
		[
			'label' => __( 'Parallax to', 'freeagent' ),
			'type' => Controls_Manager::POPOVER_TOGGLE,
			'label_off' => __( 'Default', 'freeagent' ),
			'label_on' => __( 'Custom', 'freeagent' ),
			'return_value' => 'yes',
			'default' => 'yes',
			'condition' => [
				'jws_parallax' => 'yes'
			],
			'render_type' => 'none',
		]
	);
	$pf->start_popover();
	$pf->add_control(
		'jws_parallax_to_x',
		[
			'label' => __( 'Translate X', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'vw', 'vh' ],
			'range' => [
				'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 0.1,
					],
					'vw' => [
						'min' => -100,
						'max' => 100,
						'step' => 0.1,
					],
					'vh' => [
						'min' => -100,
						'max' => 100,
						'step' => 0.1,
					],
			],
			'default' => [
				'size' => 0,
			],
			'condition' => [
				'jws_parallax_to_options' => 'yes'
			],
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_to_y',
		[
			'label' => __( 'Translate Y', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'vw', 'vh' ],
			'range' => [
				'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 0.1,
					],
					'vw' => [
						'min' => -100,
						'max' => 100,
						'step' => 0.1,
					],
					'vh' => [
						'min' => -100,
						'max' => 100,
						'step' => 0.1,
					],
			],
			'default' => [
				'size' => 0,
			],
			'condition' => [
				'jws_parallax_to_options' => 'yes'
			],
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_to_z',
		[
			'label' => __( 'Translate Z', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 1,
				],
			],
			'default' => [
				'size' => 0,
			],
			'separator' => 'after',
			'condition' => [
				'jws_parallax_to_options' => 'yes'
			],
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_to_scaleX',
		[
			'label' => __( 'Scale X', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 5,
					'step' => 0.1,
				],
			],
			'default' => [
				'size' => 1,
			],
			'condition' => [
				'jws_parallax_to_options' => 'yes'
			],
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_to_scaleY',
		[
			'label' => __( 'Scale Y', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 5,
					'step' => 0.1,
				],
			],
			'default' => [
				'size' => 1,
			],
			'condition' => [
				'jws_parallax_to_options' => 'yes'
			],
			'separator' => 'after',
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_to_rotationX',
		[
			'label' => __( 'Rotate X', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => -360,
					'max' => 360,
					'step' => 1,
				],
			],
			'default' => [
				'size' => 0,
			],
			'condition' => [
				'jws_parallax_to_options' => 'yes'
			],
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_to_rotationY',
		[
			'label' => __( 'Rotate Y', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => -360,
					'max' => 360,
					'step' => 1,
				],
			],
			'default' => [
				'size' => 0,
			],
			'condition' => [
				'jws_parallax_to_options' => 'yes'
			],
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_to_rotationZ',
		[
			'label' => __( 'Rotate Z', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => -360,
					'max' => 360,
					'step' => 1,
				],
			],
			'default' => [
				'size' => 0,
			],
			'condition' => [
				'jws_parallax_to_options' => 'yes'
			],
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_to_opacity',
		[
			'label' => __( 'Opacity', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 1,
					'step' => 0.1,
				],
			],
			'default' => [
				'size' => 1,
			],
			'condition' => [
				'jws_parallax_to_options' => 'yes'
			],
			'separator' => 'before',
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_to_transformOriginX',
		[
			'label' => __( 'Transform origin X', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'range' => [
				'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 0.1,
					],
			],
			'default' => [
				'size' => 50,
				'unit' => '%',
			],
			'separator' => 'before',
			'condition' => [
				'jws_parallax_to_options' => 'yes'
			],
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_to_transformOriginY',
		[
			'label' => __( 'Transform origin Y', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'range' => [
				'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 0.1,
					],
			],
			'default' => [
				'size' => 50,
				'unit' => '%',
			],
			'condition' => [
				'jws_parallax_to_options' => 'yes'
			],
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_parallax_to_transformOriginZ',
		[
			'label' => __( 'Transform origin Z', 'freeagent' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 1,
					],
			],
			'default' => [
				'size' => 0,
			],
			'condition' => [
				'jws_parallax_to_options' => 'yes'
			],
			'render_type' => 'none',
		]
	);
	
	$pf->end_popover(); // parallax to
}