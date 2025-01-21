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


if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

function ld_el_content_animation($pf){

	$section_title = __( 'Animate contents', 'freeagent' );
	
	if ( $pf->get_name() === 'section'){
		$section_title = __( 'Animate columns', 'freeagent' );
	}

	$pf->add_control(
		'jws_custom_animation',
		[
			'label' => $section_title,
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'On', 'freeagent' ),
			'label_off' => __( 'Off', 'freeagent' ),
			'return_value' => 'yes',
			'default' => '',
			'separator' => 'before',
			'render_type' => 'none',
		]
	);

	if ( $pf->get_name() === 'container'){
		$pf->add_control(
			'jws_ca_targets',
			[
				'label' => __( 'Animation Targets', 'freeagent' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'contents',
				'options' => [
					'contents'  => __( 'All contents', 'freeagent' ),
					'container'  => __( 'Only direct inner containers', 'freeagent' ),
				],
				'condition' => [
					'jws_custom_animation' => 'yes',
				],
				'render_type' => 'none',
			]
		);
		$pf->add_control(
			'jws_ca_include_inner_content',
			[
				'label' => __( 'Include inner containers content?', 'freeagent' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'freeagent' ),
				'label_off' => __( 'Off', 'freeagent' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'jws_custom_animation' => 'yes',
					'jws_ca_targets' => 'contents'
				],
				'render_type' => 'none',
			]
		);
	}

	$pf->add_control(
		'jws_ca_control_apply',
		[
			'label' => __( 'Play animations', 'freeagent' ),
			'type' => \Elementor\Controls_Manager::BUTTON,
			'button_type' => 'success',
			'text' => __( 'Play', 'freeagent' ),
			'condition' => [
				'jws_custom_animation' => 'yes',
			],
			'event' => 'jws_ca_apply',
			'render_type' => 'none',
		]
	);

	$pf->add_control(
		'jws_ca_settings_popover',
		[
			'label' => __( 'Settings', 'freeagent' ),
			'type' => Controls_Manager::POPOVER_TOGGLE,
			'label_off' => __( 'Default', 'freeagent' ),
			'label_on' => __( 'Custom', 'freeagent' ),
			'return_value' => 'yes',
			'default' => 'yes',
			'condition' => [
				'jws_custom_animation' => 'yes'
			],
			'render_type' => 'none',
		]
	);

	// Animation Settings
	$pf->start_popover();
		$pf->add_control(
			'jws_ca_preset',
			[
				'label' => __( 'Animation Presets', 'freeagent' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => [
					'custom'  => __( 'Custom', 'freeagent' ),
					'Fade In'  => __( 'Fade In', 'freeagent' ),
					'Fade In Down'  => __( 'Fade In Down', 'freeagent' ),
					'Fade In Up'  => __( 'Fade In Up', 'freeagent' ),
					'Fade In Left'  => __( 'Fade In Left', 'freeagent' ),
					'Fade In Right'  => __( 'Fade In Right', 'freeagent' ),
					'Flip In Y'  => __( 'Flip In Y', 'freeagent' ),
					'Flip In X'  => __( 'Flip In X', 'freeagent' ),
					'Scale Up'  => __( 'Scale Up', 'freeagent' ),
					'Scale Down'  => __( 'Scale Down', 'freeagent' ),
				],
				'condition' => [
					'jws_ca_settings_popover' => 'yes'
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_settings_ease',
			[
				'label' => __( 'Easing', 'freeagent' ),
				'type' => Controls_Manager::SELECT,
				'default' => [ 'power4.out' ],
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
					'jws_ca_settings_popover' => 'yes'
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_settings_direction',
			[
				'label' => __( 'Direction', 'freeagent' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'forward',
				'options' => [
					'forward' => __( 'Forward', 'freeagent' ),
					'backward' => __( 'Backward', 'freeagent' ),
					'random' => __( 'Random', 'freeagent' ),
				],
				'condition' => [
					'jws_ca_settings_popover' => 'yes'
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_settings_duration',
			[
				'label' => __( 'Duration', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'default' => [
					'size' => 1.6,
				],
				'condition' => [
					'jws_ca_settings_popover' => 'yes'
				],
				'render_type' => 'none',
			]
		);
	
		$pf->add_control(
			'jws_ca_settings_stagger',
			[
				'label' => __( 'Stagger', 'freeagent' ),
				'description' => __( 'Delay between animated elements.', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'default' => [
					'size' => .16,
				],
				'condition' => [
					'jws_ca_settings_popover' => 'yes'
				],
				'render_type' => 'none',
			]
		);
	
		$pf->add_control(
			'jws_ca_settings_start_delay',
			[
				'label' => __( 'Start Delay', 'freeagent' ),
				'description' => __( 'Start delay of the animation.', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -0,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'default' => [
					'size' => 0,
				],
				'condition' => [
					'jws_ca_settings_popover' => 'yes'
				],
				'render_type' => 'none',
			]
		);
	$pf->end_popover();

	// From Options
	$pf->add_control(
		'jws_ca_from_popover',
		[
			'label' => __( 'Animate from', 'freeagent' ),
			'type' => Controls_Manager::POPOVER_TOGGLE,
			'label_off' => __( 'Default', 'freeagent' ),
			'label_on' => __( 'Custom', 'freeagent' ),
			'return_value' => 'yes',
			'default' => 'yes',
			'condition' => [
				'jws_custom_animation' => 'yes',
				'jws_ca_preset' => 'custom',
			],
			'render_type' => 'none',
		]
	);

	$pf->start_popover();
		$pf->add_control(
			'jws_ca_from_x',
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
					'jws_ca_from_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_from_y',
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
					'jws_ca_from_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_from_z',
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
					'jws_ca_from_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_from_scaleX',
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
					'jws_ca_from_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_from_scaleY',
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
					'jws_ca_from_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'separator' => 'after',
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_from_rotationX',
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
					'jws_ca_from_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_from_rotationY',
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
					'jws_ca_from_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_from_rotationZ',
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
				'separator' => 'after',
				'condition' => [
					'jws_ca_from_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);


		$pf->add_control(
			'jws_ca_from_opacity',
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
					'jws_ca_from_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_from_transformOriginX',
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
					'jws_ca_from_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_from_transformOriginY',
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
					'jws_ca_from_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_from_transformOriginZ',
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
				'separator' => 'after',
				'condition' => [
					'jws_ca_from_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);
	$pf->end_popover();

	// From Options
	$pf->add_control(
		'jws_ca_to_popover',
		[
			'label' => __( 'Animate to', 'freeagent' ),
			'type' => Controls_Manager::POPOVER_TOGGLE,
			'label_off' => __( 'Default', 'freeagent' ),
			'label_on' => __( 'Custom', 'freeagent' ),
			'return_value' => 'yes',
			'default' => 'yes',
			'condition' => [
				'jws_custom_animation' => 'yes',
				'jws_ca_preset' => 'custom',
			],
			'render_type' => 'none',
		]
	);

	$pf->start_popover();
		$pf->add_control(
			'jws_ca_to_x',
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
					'jws_ca_to_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_to_y',
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
					'jws_ca_to_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_to_z',
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
					'jws_ca_to_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_to_scaleX',
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
					'jws_ca_to_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_to_scaleY',
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
					'jws_ca_to_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'separator' => 'after',
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_to_rotationX',
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
					'jws_ca_to_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_to_rotationY',
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
					'jws_ca_to_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_to_rotationZ',
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
				'separator' => 'after',
				'condition' => [
					'jws_ca_from_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);


		$pf->add_control(
			'jws_ca_to_opacity',
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
					'jws_ca_to_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_to_transformOriginX',
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
					'jws_ca_to_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_to_transformOriginY',
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
					'jws_ca_to_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);

		$pf->add_control(
			'jws_ca_to_transformOriginZ',
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
				'separator' => 'after',
				'condition' => [
					'jws_ca_to_popover' => 'yes',
					'jws_ca_preset' => 'custom',
				],
				'render_type' => 'none',
			]
		);
	$pf->end_popover();

}

function ld_el_advanced_text( $prefix, $condition = '' ){

    $prefix->add_control(
        'advanced_text_enable',
        [
            'label' => esc_html__( 'Enable the advanced text?', 'freeagent' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'On', 'freeagent' ),
            'label_off' => esc_html__( 'Off', 'freeagent' ),
            'return_value' => 'yes',
            'default' => '',
        ]
    );
    
    $repeater_advanced_text = new Repeater();
    
    $repeater_advanced_text->add_control(
        'text', [
            'label' => esc_html__( 'Title', 'freeagent' ),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__( 'Title' , 'freeagent' ),
            'label_block' => true,
        ]
    );
    
    $repeater_advanced_text->add_responsive_control(
        'item_margin',
        [
            'label' => esc_html__( 'Item Margin', 'freeagent' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $repeater_advanced_text->add_control(
        'image',
        [
            'label' => esc_html__( 'Choose Image', 'freeagent' ),
            'type' => Controls_Manager::MEDIA,
        ]
    );

    $repeater_advanced_text->add_responsive_control(
        'img_width',
        [
            'label' => esc_html__( 'Width', 'freeagent' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'vw' ],
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 1000,
                ],
                'vw' => [
                    'min' => 1,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}} img' => 'width: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'image[url]!' => '' 
            ]
        ]
    );

    $repeater_advanced_text->add_control(
        'image_align',
        [
            'label' => esc_html__( 'Image placement', 'freeagent' ),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => esc_html__( 'Left', 'freeagent' ),
                    'icon' => 'eicon-h-align-left',
                ],
                'right' => [
                    'title' => esc_html__( 'Right', 'freeagent' ),
                    'icon' => 'eicon-h-align-right',
                ],
            ],
            'default' => 'left',
            'toggle' => false,
            'condition' => [
                'image[url]!' => '' 
            ]
        ]
    );

    $repeater_advanced_text->add_control(
        'image_v_align',
        [
            'label' => esc_html__( 'Vertical align', 'freeagent' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'baseline' => 'Baseline',
                'sub' => 'Subscript',
                'sup' => 'Superscript',
                'top' => 'Top',
                'text-top' => 'Text top',
                'middle' => 'Middle',
                'bottom' => 'Bottom',
                'text-bottom' => 'Text bottom',
            ],
            'default' => 'bottom',
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}} figure' => 'vertical-align: {{VALUE}};',
            ],
            'condition' => [
                'image[url]!' => '' 
            ]
        ]
    );


    $repeater_advanced_text->add_responsive_control(
        'border',
        [
            'label' => esc_html__( 'Border', 'freeagent' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}} img' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};border-style: solid;',
            ],
            'condition' => [
                'image[url]!' => '' 
            ]
        ]
    );

    $repeater_advanced_text->add_responsive_control(
        'border_radius',
        [
            'label' => esc_html__( 'Border Radius', 'freeagent' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}} img, {{WRAPPER}} {{CURRENT_ITEM}} figure' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'image[url]!' => '' 
            ]
        ]
    );

    $repeater_advanced_text->add_control(
        'border_color',
        [
            'label' => esc_html__( 'Border Color', 'freeagent' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}} img' => 'border-color: {{VALUE}}',
            ],
            'condition' => [
                'image[url]!' => '' 
            ]
        ]
    );

    $repeater_advanced_text->add_responsive_control(
        'margin',
        [
            'label' => esc_html__( 'Margin', 'freeagent' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}} figure' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'image[url]!' => '' 
            ]
        ]
    );


    $repeater_advanced_text->add_responsive_control(
        'item_z_index',
        [
            'label' => esc_html__( 'Z-Index', 'freeagent' ),
            'type' => Controls_Manager::NUMBER,
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}}' => 'position: relative; z-index: {{VALUE}};',
            ],
            'condition' => [
                'image[url]!' => '' 
            ]
        ]
    );
    
    $prefix->add_control(
        'advanced_text_content',
        [
            'label' => esc_html__( 'Items', 'freeagent' ),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater_advanced_text->get_controls(),
            'default' => [
                [
                    'text' => esc_html__( 'Title #1', 'freeagent' ),
                ],
                [
                    'text' => esc_html__( 'Title #2', 'freeagent' ),
                ],
            ],
            'title_field' => '{{{ text }}}',
            'condition' => [
                'advanced_text_enable' => 'yes'
            ]
        ]
    );

}