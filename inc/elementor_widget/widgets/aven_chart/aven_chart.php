<?php

/**
 * Class: jws_Charts
 * Name: Charts
 * Slug: jws-chart
 */

namespace Elementor;


use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if( ! defined( 'ABSPATH' ) ) exit;

class jws_Aven_Charts extends Widget_Base {
    
    public function get_name() {
        return 'jws-avenchart';
    }
    
    public function get_title() {
		return esc_html__('Jws Charts Pro', 'freeagent');
	}
    
    public function get_icon() {
		return 'eicon-dot-circle-o';
	}
    
    public function get_categories() {
		return [ 'jws-elements' ];
	}

    public function get_script_depends() {
        return [
            'chart',
            'elementor-waypoints',
        ];
    }
    
    public function is_reload_preview_required() {
        return true;
    }
    
    public function get_custom_help_url() {
		return 'https://youtu.be/lZZvslQ2UYU';
	}
    
    // Adding the controls fields for the jws Charts
    // This will controls the animation, colors and background, dimensions etc
    protected function register_controls() {
        
        $this->start_controls_section('general_settings',
            [
                'label'         => esc_html__('jws Charts','freeagent'),
            ]
        );

        $this->add_control('type', 
            [
                'label'         => esc_html__('Layout', 'freeagent'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'line'          => esc_html__('Line','freeagent'),
                    'bar'           => esc_html__('Bar','freeagent'),
                    'horizontalBar' => esc_html__('Horizontal Bar','freeagent'),
                    'pie'           => esc_html__('Pie','freeagent'),
                    'radar'         => esc_html__('Radar','freeagent'),
                    'doughnut'      => esc_html__('Doughnut','freeagent'),
                    'polarArea'     => esc_html__('Polar Area','freeagent'),

                    ],
                'default'       => 'bar',
                'label_block'   => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('x_axis',
            [
                'label'         => esc_html__('X-Axis','freeagent'),
            ]
        );

        $this->add_control('x_axis_label_switch',
            [
                'label'         => esc_html__('Show Axis Label', 'freeagent'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => 'Show',
                'label_off'     => 'Hide',
                'return_value'  => 'true',
                'description'   => esc_html__('Show or Hide X-Axis Label','freeagent'),
            ]
        );

        $this->add_control('x_axis_label',
                [
                    'label'     => esc_html__('Label', 'freeagent'),
                    'type'      => Controls_Manager::TEXT,
                    'dynamic'   => [ 'active' => true ],
                    'default'   => 'X-Axis',
                    'label_block'=> true,
                    'condition' => [
                        'x_axis_label_switch'    => 'true',
                    ]
                ]
            );

        $this->add_control('x_axis_labels',
            [
                'label'         => esc_html__('Data Labels', 'freeagent'),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'default'       => 'Jan,Feb,Mar,Apr,May',
                'description'   => esc_html__('Enter labels for X-Axis separated with \' , \' ','freeagent'),
                'label_block'   => true,
            ]
        );
        
        $this->add_control('x_axis_grid',
            [
                'label'         => esc_html__('Show Grid Lines', 'freeagent'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => 'Show',
                'label_off'     => 'Hide',
                'return_value'  => 'true',
                'default'       => 'true',
                'description'   => esc_html__('Show or Hide X-Axis Grid Lines','freeagent'),
            ]
        );

        $this->add_control('x_axis_begin',
            [
                'label'         => esc_html__('Begin at Zero', 'freeagent'),
                'type'          => Controls_Manager::SWITCHER,
                'return_value'  => 'true',
                'description'   => esc_html__('Start X-Axis Labels at zero','freeagent'),
            ]
        );

        $this->add_control('x_axis_label_rotation',
            [
                'label'			=> esc_html__( 'Labels\' Rotation ', 'freeagent' ),
                'type'			=> Controls_Manager::NUMBER,
                'min'           => 0,
                'max'           => 360,
                'default'       => 0
            ]
        );
        
        $this->add_control('x_column_width',
            [
                'label'         => esc_html__('Column Width', 'freeagent'),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 1,
                        'step'  => 0.1
                    ]
                ],
                'condition'     => [
                    'type'  => 'bar'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('y_axis',
            [
                'label'         => esc_html__('Y-Axis','freeagent'),
            ]
        );

        $this->add_control('y_axis_label_switch',
            [
                'label'         => esc_html__('Show Axis Label', 'freeagent'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => 'Show',
                'label_off'     => 'Hide',
                'return_value'  => 'true',
                'description'   => esc_html__('Show or Hide Y-Axis Label','freeagent'),
            ]
        );

        $this->add_control('y_axis_label',
            [
                'label'         => esc_html__('Label', 'freeagent'),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'default'       => 'Y-Axis',
                'label_block'   => true,
                'condition'     => [
                    'y_axis_label_switch'    => 'true',
                ]
            ]
        );

        $data_repeater = new REPEATER();

        $data_repeater->add_control('y_axis_column_title',
            [
                'label'         => esc_html__( 'Title', 'freeagent' ),
               'default'        => esc_html__('Dataset','freeagent'),
               'type'           => Controls_Manager::TEXT,
               'dynamic'       => [ 'active' => true ],
            ]
        );

        $data_repeater->add_control('y_axis_column_data',
            [
                'label'         => esc_html__( 'Data', 'freeagent' ),
                'description'   => esc_html__('Enter Data Numbers for Y-Axis separated with \' , \' ','freeagent'),
                'dynamic'       => [ 'active' => true ],
                'type'          => Controls_Manager::TEXT,

            ]
        );
        
        $data_repeater->add_control('y_axis_urls',
            [
                'label'         => esc_html__('URLs', 'freeagent'),
                'type'          => Controls_Manager::TEXT,
                'description'   => esc_html__('Enter URLs for each Dataset separated with \' , \' ','freeagent'),
                'label_block'   => true,
            ]
        );

        $data_repeater->add_control('y_axis_column_color',
            [
                'label'         => esc_html__( 'First Fill Color', 'freeagent' ),
                'type'          => Controls_Manager::COLOR,
                'default'       => '#6ec1e4',
            ]
        );
        
        $data_repeater->add_control('y_axis_column_second_color',
            [
                'label'         => esc_html__( 'Second Fill Color', 'freeagent' ),
                'type'          => Controls_Manager::COLOR
            ]
        );

        $data_repeater->add_control('y_axis_circle_color',
            [
                'label'         => esc_html__( 'Fill Colors', 'freeagent' ),
                'description'   => esc_html__('Enter Colors separated with \' , \', this will work only for pie and doughnut charts ','freeagent'),
                'default'       => '#ec792e,#cd0012,#0688c8,#3d9c45,#3d4579',
                'type'          => Controls_Manager::TEXT,
            ]
        );

        $data_repeater->add_control('y_axis_column_border_width',
            [
               'label'         => esc_html__( 'Border Width', 'freeagent' ),
               'default'       => 1,
               'type'           => Controls_Manager::NUMBER,
            ]
        );
        
        $data_repeater->add_control('y_axis_column_border_color',
            [
               'label'         => esc_html__( 'Border Color', 'freeagent' ),
               'type'           => Controls_Manager::COLOR,
            ]
        );

        $this->add_control('y_axis_data',
           [
               'label'          => esc_html__( 'Data', 'freeagent' ),
               'type'           => Controls_Manager::REPEATER,
               'default'        => [
                    [
                       'y_axis_column_data'   => '1,5,2,3,7',
                    ],
               ],
               'fields'         => array_values( $data_repeater->get_controls() ),
           ]
        );
        
        $this->add_control('data_type',
            [
                'label'         => esc_html__('Data Type', 'freeagent'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'linear'            => esc_html__('Linear', 'freeagent'),
                    'logarithmic'       => esc_html__('Logarithmic', 'freeagent'),
                ],
                'default'       => 'linear',
                'condition'     => [
                    'type!'             => 'horizontalBar'
                    ]
                ]
            );

        $this->add_control('y_axis_grid',
            [
                'label'         => esc_html__('Show Grid Lines', 'freeagent'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => 'Show',
                'label_off'     => 'Hide',
                'return_value'  => 'true',
                'default'       => 'true',
                'description'   => esc_html__('Show or Hide Y-Axis Grid Lines','freeagent'),
            ]
        );

        $this->add_control('y_axis_begin',
            [
                'label'         => esc_html__('Begin at Zero', 'freeagent'),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'true',
                'return_value'  => 'true',
                'description'   => esc_html__('Start Y-Axis Data at zero','freeagent'),
            ]
        );
        
        $this->add_control('y_axis_urls_target',
            [
                'label'         => esc_html__('Open Links in new tab', 'freeagent'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => 'Show',
                'label_off'     => 'Hide',
                'return_value'  => 'true',
                'default'       => 'true',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('title_content',
            [
                'label'         => esc_html__('Title','freeagent'),
            ]
        );

        $this->add_control('title_switcher',
            [
                'label'         => esc_html__('Title', 'freeagent'),
                'type'          => Controls_Manager::SWITCHER,
                'return_value'  => 'true',
            ]
        );

        $this->add_control('title',
            [
                'label'         => esc_html__('Title', 'freeagent'),
                'type'          => Controls_Manager::TEXT,
                'description'   => esc_html__('Enter a Title for the Chart','freeagent'),
                'label_block'   => true,
                'dynamic'       => [ 'active' => true ],
                'condition'     => [
                    'title_switcher'  => 'true'
                ]
            ]
        );

        $this->add_control('title_tag',
            [
                'label'         => esc_html__('HTML Tag', 'freeagent'),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'h3',
                'options'       => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6' 
                    ],
                'label_block'   =>  true,
                'condition'     => [
                    'title_switcher'  => 'true'
                ]
            ]
        );

        $this->add_control('title_position',
        [
            'label'             => esc_html__('Position', 'freeagent'),
            'type'              => Controls_Manager::SELECT,
            'options'           => [
                'top'       => esc_html__('Top', 'freeagent'),
                'bottom'    => esc_html__('Bottom', 'freeagent'),
            ],
            'default'           => 'top',
            'condition'         => [
                'title_switcher'  => 'true'
                ]
            ]
        );

        $this->add_responsive_control('title_align',
            [
                'label'         => esc_html__( 'Alignment', 'freeagent' ),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'left'    => [
                        'title' => esc_html__( 'Left', 'freeagent' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'freeagent' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'freeagent' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .jws-chart-title' => 'text-align: {{VALUE}}',
                ],
                'default'       => 'center',
                'condition'     => [
                    'title_switcher'  => 'true'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('advanced',
            [
                'label'         => esc_html__('Advanced Settings','freeagent'),
            ]
        );
        
        $this->add_control('y_axis_min',
            [
                'label'         => esc_html__( 'Minimum Value', 'freeagent' ),
                'type'          => Controls_Manager::NUMBER,
                'title'         => esc_html__('Set Y-axis minimum value, this will be overriden if data has a smaller value', 'freeagent'),
                'condition'     => [
                    'type!'   => [ 'pie', 'doughnut', 'radar', 'polarArea' ]
                ]
            ]
        );

        $this->add_control('y_axis_max',
            [
                'label'         => esc_html__( 'Maximum Value', 'freeagent' ),
                'type'          => Controls_Manager::NUMBER,
                'title'         => esc_html__('Set Y-axis maximum value, this will be overriden if data has a larger value', 'freeagent'),
                'min'           => 0,
                'default'       => 1,
                'condition'     => [
                    'type!'   => [ 'pie', 'doughnut' ]
                ]
            ]
        );
        
        $this->add_control('step_size',
            [
                'label'         => esc_html__( 'Step Size', 'freeagent' ),
                'type'          => Controls_Manager::NUMBER,
                'condition'     => [
                    'type!'   => [ 'pie', 'doughnut' ]
                ]
            ]
        );

        $this->add_control('legend_display',
            [
                'label'         => esc_html__('Show Legend', 'freeagent'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => 'Show',
                'label_off'     => 'Hide',
                'return_value'  => 'true',
                'description'   => esc_html__('Show or Hide chart legend','freeagent'),
            ]
        );

        $this->add_control('legend_position',
            [
                'label'         => esc_html__('Legend Position', 'freeagent'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'top'           => esc_html__('Top', 'freeagent'),
                    'right'         => esc_html__('Right', 'freeagent'),
                    'bottom'        => esc_html__('Bottom', 'freeagent'),
                    'left'          => esc_html__('Left', 'freeagent'),
                ],
                'default'       => 'top',
                'condition'     => [
                    'legend_display'  => 'true'
                ]
            ]
        );

        $this->add_control('legend_reverse',
            [
                'label'         => esc_html__('Reverse', 'freeagent'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => esc_html__('Enable or Disable legend data reverse','freeagent'),
                'return_value'  => 'true',
                'condition'     => [
                    'legend_display'  => 'true'
                ]
            ]
        );

        $this->add_control('tool_tips',
            [
                'label'         => esc_html__('Show Values on Hover', 'freeagent'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => 'Show',
                'label_off'     => 'Hide',
                'return_value'  => 'true',
            ]
        );
        
        $this->add_control('tool_tips_percent',
            [
                'label'         => esc_html__('Convert Values to percent', 'freeagent'),
                'type'          => Controls_Manager::SWITCHER,
                'return_value'  => 'true',
                'condition'     => [
                    'tool_tips'  => 'true'
                ]
            ]
        );

        $this->add_control('tool_tips_mode',
            [
                'label'         => esc_html__('Mode', 'freeagent'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'point'         => esc_html__('Point', 'freeagent'),
                    'nearest'       => esc_html__('Nearest', 'freeagent'),
                    'dataset'       => esc_html__('Dataset', 'freeagent'),
                    'x'             => esc_html__('X', 'freeagent'),
                    'y'             => esc_html__('Y', 'freeagent'),
                ],
                'default'       => 'nearest',
                'condition'     => [
                    'tool_tips'  => 'true'
                ]
            ]
        );

        $this->add_control('value_on_chart',
            [
                'label'         => esc_html__('Show Values on Chart', 'freeagent'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => esc_html__("This option works only with Pie and Douhnut Charts", "freeagent"),
                'label_on'      => 'Show',
                'label_off'     => 'Hide',
                'return_value'  => 'true',
                'condition'     => [
                    'type'          => ['pie', 'doughnut'],
                    'tool_tips!'    => 'true'
                ]
            ]
        );
        
        $this->add_control('start_animation',
            [
                'label'         => esc_html__('Animation', 'freeagent'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'linear'            => esc_html__('Linear','freeagent'),
                    'easeInQuad'        => esc_html__('Ease in Quad','freeagent'),
                    'easeOutQuad'       => esc_html__('Ease out Quad','freeagent'),
                    'easeInOutQuad'     => esc_html__('Ease in out Quad','freeagent'),
                    'easeInCubic'       => esc_html__('Ease in Cubic','freeagent'),
                    'easeOutCubic'      => esc_html__('Ease out Cubic','freeagent'),
                    'easeInOutCubic'    => esc_html__('Ease in out Cubic','freeagent'),
                    'easeInQuart'       => esc_html__('Ease in Quart','freeagent'),
                    'easeOutQuart'      => esc_html__('Ease out Quart','freeagent'),
                    'easeInOutQuart'    => esc_html__('Ease in out Quart','freeagent'),
                    'easeInQuint'       => esc_html__('Ease in Quint','freeagent'),
                    'easeOutQuint'      => esc_html__('Ease out Quint','freeagent'),
                    'easeInOutQuint'    => esc_html__('Ease in out Quint','freeagent'),
                    'easeInSine'        => esc_html__('Ease in Sine','freeagent'),
                    'easeOutSine'       => esc_html__('Ease out Sine','freeagent'),
                    'easeInOutSine'     => esc_html__('Ease in out Sine','freeagent'),
                    'easeInExpo'        => esc_html__('Ease in Expo','freeagent'),
                    'easeOutExpo'       => esc_html__('Ease out Expo','freeagent'),
                    'easeInOutExpo'     => esc_html__('Ease in out Cubic','freeagent'),
                    'easeInCirc'        => esc_html__('Ease in Circle','freeagent'),
                    'easeOutCirc'       => esc_html__('Ease out Circle','freeagent'),
                    'easeInOutCirc'     => esc_html__('Ease in out Circle','freeagent'),
                    'easeInElastic'     => esc_html__('Ease in Elastic','freeagent'),
                    'easeOutElastic'    => esc_html__('Ease out Elastic','freeagent'),
                    'easeInOutElastic'  => esc_html__('Ease in out Elastic','freeagent'),
                    'easeInBack'        => esc_html__('Ease in Back','freeagent'),
                    'easeOutBack'       => esc_html__('Ease out Back','freeagent'),
                    'easeInOutBack'     => esc_html__('Ease in Out Back','freeagent'),
                    'easeInBounce'      => esc_html__('Ease in Bounce','freeagent'),
                    'easeOutBounce'     => esc_html__('Ease out Bounce','freeagent'),
                    'easeInOutBounce'   => esc_html__('Ease in out Bounce','freeagent'),
                ],
                'default'       => 'easeInQuad',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section('general_style',
            [
                'label'         => esc_html__('General','freeagent'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control('height',
            [
                'label'         => esc_html__('Height', 'freeagent'),
                'type'          => Controls_Manager::NUMBER,
                'title'         => esc_html__('Set the height of the graph in pixels', 'freeagent'),
                'selectors'     => [
                    '{{WRAPPER}} .jws-chart-canvas-container'   => 'height: {{VALUE}}px'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'          => 'general_background',
                'types'         => [ 'classic', 'gradient' ],
                'selector'      => '{{WRAPPER}} .jws-chart-container',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'general_border',
                'selector'      => '{{WRAPPER}} .jws-chart-container',
                ]
            );

        $this->add_control('general_border_radius',
            [
                'label'         => esc_html__('Border Radius', 'freeagent'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%', 'em'],
                'selectors'     => [
                    '{{WRAPPER}} .jws-chart-container' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'general_box_shadow',
                'selector'      => '{{WRAPPER}} .jws-chart-container',
            ]
        );

        $this->add_responsive_control('general_margin',
            [
                'label'         => esc_html__('Margin', 'freeagent'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .jws-chart-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );

        $this->add_responsive_control('general_padding',
            [
                'label'         => esc_html__('Padding', 'freeagent'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .jws-chart-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('title_style',
            [
                'label'         => esc_html__('Title','freeagent'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'title_switcher'  => 'true'
                ]
            ]
        );

        $this->add_control('title_color',
            [
                'label'         => esc_html__('Color', 'freeagent'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Color::get_type(),
                    'value' => Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .jws-chart-title' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'title_typo',
                'scheme'        => Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .jws-chart-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'          => 'title_background',
                'types'         => [ 'classic', 'gradient' ],
                'selector'      => '{{WRAPPER}} .jws-chart-title-container',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
                [
                    'name'      => 'title_border',
                    'selector'  => '{{WRAPPER}} .jws-chart-title-container',
                ]
            );

        $this->add_control('title_border_radius',
            [
                'label'         => esc_html__('Border Radius', 'freeagent'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%', 'em'],
                'selectors'     => [
                    '{{WRAPPER}} .jws-chart-title-container' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'          => 'title_box_shadow',
                'selector'      => '{{WRAPPER}} .jws-chart-title',
            ]
        );

        $this->add_responsive_control('title_margin',
            [
                'label'         => esc_html__('Margin', 'freeagent'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .jws-chart-title-container .jws-chart-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );

        $this->add_responsive_control('title_padding',
            [
                'label'         => esc_html__('Padding', 'freeagent'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .jws-chart-title-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('x_axis_style',
            [
                'label'         => esc_html__('X-Axis','freeagent'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control('x_axis_label_pop',
            [
                'label'         => esc_html__('Axis Label', 'freeagent'),
                'type'          => Controls_Manager::POPOVER_TOGGLE,
                'condition'     => [
                    'x_axis_label_switch' => 'true'
                ]
            ]
        );

        $this->start_popover();

        $this->add_control('x_axis_label_color',
            [
                'label'         => esc_html__('Color', 'freeagent'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Color::get_type(),
                    'value' => Color::COLOR_2,
                ],
            ]
        );

        $this->add_control('x_axis_label_size',
            [
                'label'			=> esc_html__( 'Size', 'freeagent' ),
                'type'			=> Controls_Manager::NUMBER,
                'min'           => 0,
                'max'           => 50,
                'default'       => 12
            ]
        );

        $this->end_popover();

        $this->add_control('x_axis_labels_pop',
            [
                'label'         => esc_html__('Data Labels', 'freeagent'),
                'type'          => Controls_Manager::POPOVER_TOGGLE,
            ]
        );

        $this->start_popover();

        $this->add_control('x_axis_labels_color',
            [
                'label'         => esc_html__('Color', 'freeagent'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Color::get_type(),
                    'value' => Color::COLOR_2,
                ],
            ]
        );

        $this->add_control('x_axis_labels_size',
            [
                'label'			=> esc_html__( 'Size', 'freeagent' ),
                'type'			=> Controls_Manager::NUMBER,
                'min'           => 0,
                'max'           => 50,
                'default'       => 12
            ]
        );

        $this->end_popover();

        $this->add_control('x_axis_grid_pop',
            [
                'label'         => esc_html__('Grid', 'freeagent'),
                'type'          => Controls_Manager::POPOVER_TOGGLE
            ]
        );

        $this->start_popover();

        $this->add_control('x_axis_grid_color',
            [
                'label'         => esc_html__('Color', 'freeagent'),
                'type'          => Controls_Manager::COLOR,
                'default'       => '#6ec1e4',
            ]
        );
        
        $this->add_control('x_axis_grid_width',
			[
				'label'			=> esc_html__( 'Width', 'freeagent' ),
				'type'			=> Controls_Manager::SLIDER,
                'range'         => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 10,
                        'step'  => 0.1
                    ]
                ],
                'default'       => [
                    'unit'  => 'px',
                    'size'  => 1
                ]
			]
		);

        $this->end_popover();

        $this->end_controls_section();

        $this->start_controls_section('y_axis_style',
            [
                'label'         => esc_html__('Y-Axis','freeagent'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control('y_axis_label_pop',
            [
                'label'         => esc_html__('Axis Label', 'freeagent'),
                'type'          => Controls_Manager::POPOVER_TOGGLE,
                'condition'     => [
                    'y_axis_label_switch' => 'true'
                ]
            ]
        );

        $this->start_popover();

        $this->add_control('y_axis_label_color',
            [
                'label'         => esc_html__('Color', 'freeagent'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Color::get_type(),
                    'value' => Color::COLOR_2,
                    ],
                ]
            );

        $this->add_control('y_axis_label_size',
            [
                'label'			=> esc_html__( 'Size', 'freeagent' ),
                'type'			=> Controls_Manager::NUMBER,
                'min'           => 0,
                'max'           => 50,
                'default'       => 12
            ]
        );

        $this->end_popover();

        $this->add_control('y_axis_data_pop',
            [
                'label'         => esc_html__('Data', 'freeagent'),
                'type'          => Controls_Manager::POPOVER_TOGGLE,
            ]
        );

        $this->start_popover();

        $this->add_control('y_axis_labels_color',
            [
                'label'         => esc_html__('Color', 'freeagent'),
                'type'          => Controls_Manager::COLOR,
            ]
        );

        $this->add_control('y_axis_labels_size',
            [
                'label'			=> esc_html__( 'Size', 'freeagent' ),
                'type'			=> Controls_Manager::NUMBER,
                'min'           => 0,
                'max'           => 50,
                'default'       => 12
            ]
        );

        $this->end_popover();

        $this->add_control('y_axis_grid_pop',
            [
                'label'         => esc_html__('Grid', 'freeagent'),
                'type'          => Controls_Manager::POPOVER_TOGGLE
            ]
        );

        $this->start_popover();

        $this->add_control('y_axis_grid_color',
            [
                'label'         => esc_html__('Color', 'freeagent'),
                'type'          => Controls_Manager::COLOR,
                'default'       => '#54595f',
            ]
        );
        
        $this->add_control('y_axis_grid_width',
			[
				'label'			=> esc_html__( 'Width', 'freeagent' ),
				'type'			=> Controls_Manager::SLIDER,
                'range'         => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 10,
                        'step'  => 0.1
                    ]
                ],
                'default'       => [
                    'unit'  => 'px',
                    'size'  => 1
                ]
			]
		);

        $this->end_popover();

        $this->end_controls_section();
        
        $this->start_controls_section('legend_style',
            [
                'label'         => esc_html__('Legend','freeagent'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'legend_display'   => 'true'
                ]
            ]
        );
        
        $this->add_control('legend_text_color',
            [
                'label'         => esc_html__('Color', 'freeagent'),
                'type'          => Controls_Manager::COLOR,
            ]
        );
        
        $this->add_control('legend_text_size',
			[
				'label'			=> esc_html__( 'Size', 'freeagent' ),
				'type'			=> Controls_Manager::NUMBER,
                'min'           => 0,
                'max'           => 50,
                'default'       => 12
			]
		);
        
        $this->add_control(
            'legend_item_width',
			[
				'label'			=> esc_html__( 'Item Width', 'freeagent' ),
				'type'			=> Controls_Manager::NUMBER,
                'min'           => 1,
                'default'       => 40
			]
		);
        
        $this->end_controls_section();
        
    }
    
    /**
	 * renders the HTML content of the widget
	 * @return void
	 */
    protected function render() {
        global $jws_option;
        $settings = $this->get_settings_for_display();
        
        $id = $this->get_id();
        
        if(!empty($settings['title']) && $settings['title_switcher']){
            $title = '<' . $settings['title_tag'] . ' class="jws-chart-title">'. $settings['title'] .'</'.$settings['title_tag'] . '>';
        }
        $xlabels = explode(',', $settings['x_axis_labels']);

        $columns_array = array();
        
        
        foreach( $settings['y_axis_data'] as $column_data ) {
            
            if( 'pie' != $settings['type'] && 'doughnut' != $settings['type'] ) {
                $background = [ $column_data['y_axis_column_color'], $column_data['y_axis_column_second_color'] ];
            } else {
                $background = explode(',', $column_data['y_axis_circle_color']);
            }
            
            $col_settings = [
                'label'             => $column_data['y_axis_column_title'],
                'data'              => explode( ',', $column_data['y_axis_column_data'] ),
                'links'             => explode( ',', $column_data['y_axis_urls']),
                'backgroundColor'   => $background,
                'borderColor'       => $column_data['y_axis_column_border_color'],
                'borderWidth'       => $column_data['y_axis_column_border_width']
            ];
            
            array_push( $columns_array, $col_settings );
            
        }
        
        $labels_rotation    = !empty( $settings['x_axis_label_rotation'] ) ? $settings['x_axis_label_rotation'] : 0;
        
        $x_label_size       = !empty( $settings['x_axis_labels_size'] ) ? $settings['x_axis_labels_size'] : 12;
        
        $y_label_size       = !empty( $settings['y_axis_labels_size'] ) ? $settings['y_axis_labels_size'] : 12;
        
        $ytype              = 'horizontalBar' != $settings['type'] ? $settings['data_type'] : 'category';
        
        $chart_id = 'jws-chart-canvas-' . $id;
        $legFamily = ( isset($jws_option['opt-typography-body']['font-family']) && !empty($jws_option['opt-typography-body']['font-family']) ) ? $jws_option['opt-typography-body']['font-family'] : "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif";
        $chart_settings = [
            'type'          => $settings['type'],
            'xlabeldis'     => $settings['x_axis_label_switch'],
            'xlabel'        => $settings['x_axis_label'],
            'ylabeldis'     => $settings['y_axis_label_switch'],
            'ylabel'        => $settings['y_axis_label'],
            'xlabels'       => $xlabels,
            'easing'        => $settings['start_animation'],
            'xwidth'        => ! empty( $settings['x_column_width']['size'] ) ? $settings['x_column_width']['size'] : 0.9,
            'enTooltips'    => $settings['tool_tips'],
            'printVal'      => $settings['value_on_chart'],
            'percentage'    => $settings['tool_tips_percent'],
            'modTooltips'   => $settings['tool_tips_mode'],
            'legDis'        => $settings['legend_display'],
            'legPos'        => $settings['legend_position'],
            'legRev'        => $settings['legend_reverse'],
            'legCol'        => ! empty( $settings['legend_text_color'] ) ? ( $settings['legend_text_color'] ) : '#54595f',
            'legSize'       => ( $settings['legend_text_size'] ),
            'legFamily'       => $legFamily,
            'itemWid'       => ( $settings['legend_item_width'] ),
            'xGrid'         => $settings['x_axis_grid'],
            'xGridCol'      => $settings['x_axis_grid_color'],
            'xGridWidth'    => $settings['x_axis_grid_width']['size'],
            'xTicksSize'    => $x_label_size,
            'xlabelcol'     => $settings['x_axis_label_color'],
            'ylabelcol'     => $settings['y_axis_label_color'],
            'xlabelsize'    => $settings['x_axis_label_size'],
            'ylabelsize'    => $settings['y_axis_label_size'],
            'xTicksCol'     => !empty( $settings['x_axis_labels_color'] ) ? $settings['x_axis_labels_color'] : '#54595f',
            'xTicksRot'     => $labels_rotation,
            'xTicksBeg'     => $settings['x_axis_begin'],
            'yAxis'         => $ytype,
            'yGrid'         => $settings['y_axis_grid'],
            'yGridCol'      => $settings['y_axis_grid_color'],
            'yGridWidth'    => $settings['y_axis_grid_width']['size'],
            'yTicksSize'    => $y_label_size,
            'yTicksCol'     => !empty( $settings['y_axis_labels_color'] ) ? $settings['y_axis_labels_color'] : '#54595f',
            'yTicksBeg'     => $settings['y_axis_begin'],
            'chartId'       => $chart_id,
            'suggestedMin'  => $settings['y_axis_min'],
            'suggestedMax'  => $settings['y_axis_max'],
            'stepSize'      => $settings['step_size'],
            'height'        => !empty( $settings['height'] ) ? $settings['height'] : 400,
            'target'        => ( $settings['y_axis_urls_target'] ) ? '_blank' : '_top'
        ];
        
        $this->add_render_attribute('charts', 'id', 'jws-chart-container-' . $id );
        
        $this->add_render_attribute('charts', 'class', 'jws-chart-container' );
        
        $this->add_render_attribute('charts', 'data-chart', wp_json_encode( $columns_array ) );
        
        $this->add_render_attribute('charts', 'data-settings', wp_json_encode( $chart_settings ) );
        
        $this->add_render_attribute('canvas', 'id', 'jws-chart-canvas-' . $id );
        
        $this->add_render_attribute('canvas', 'class', 'jws-chart-canvas');
        
        $this->add_render_attribute('canvas', 'width', 400);
        
        $this->add_render_attribute('canvas', 'height', 400);
        
    ?>

    <div <?php echo wp_kses_post($this->get_render_attribute_string('charts')); ?>>
        <?php if( !empty( $settings['title'] ) && $settings['title_switcher'] && 'top' == $settings['title_position'] ) : ?>
            <div class="jws-chart-title-container"><?php echo wp_kses_post($title); ?></div>
        <?php endif; ?>
        <div class="jws-chart-canvas-container">
            <canvas <?php echo wp_kses_post($this->get_render_attribute_string('canvas')); ?>></canvas>
        </div>
        <?php if( !empty( $settings['title'] ) && $settings['title_switcher'] && 'bottom' == $settings['title_position'] ) : ?>
            <div class="jws-chart-title-container"><?php echo wp_kses_post($title); ?></div>
        <?php endif; ?>
    </div>

    <?php }
    
}