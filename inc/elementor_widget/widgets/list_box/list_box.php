<?php
namespace Elementor;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Jws_Banner extends Widget_Base {

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
		return 'jws_banner';
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
		return esc_html__( 'Jws box', 'freeagent' );
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
		return 'eicon-banner';
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
	    $this->start_controls_section(
			'setting_section',
			[
				'label' => esc_html__( 'Setting', 'freeagent' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
				'banner_layout',
				[
					'label'     => esc_html__( 'Layout', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'layout1',
					'options'   => [
						'layout1'   => esc_html__( 'layout 1', 'freeagent' ),
                        'layout2'   => esc_html__( 'layout 2', 'freeagent' ),
                        'layout3'   => esc_html__( 'layout 3', 'freeagent' ),
                        'layout4'   => esc_html__( 'layout 4', 'freeagent' ),
                        'layout5'   => esc_html__( 'layout 5', 'freeagent' ),
                        'layout6'   => esc_html__( 'layout 6', 'freeagent' ),
                        'layout7'   => esc_html__( 'layout 7', 'freeagent' ),
					],
                    
				]
		);
        $this->add_control(
				'banner_display',
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

        $this->add_responsive_control(
				'banner_columns',
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
        
     


        $this->end_controls_section();   
	    $this->start_controls_section(
			'setting_section_list',
			[
				'label' => esc_html__( 'List', 'freeagent' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);   
		$this->add_control(
            'show_number',
            [
                'label'         => esc_html__( 'Use list number instead of image', 'freeagent' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'freeagent' ),
                'label_off'     => esc_html__( 'No', 'freeagent' ),
                'default'   => 'no',
                'return_value'  => 'yes',
            ]
        );
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'list_bg_icon_color',
			[
				'label' => esc_html__( 'Icon background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                
					'{{WRAPPER}} {{CURRENT_ITEM}} .jws-banner-image' => 'background-color: {{VALUE}}',
				],
			]
		);

        		$repeater->add_control(
			'list_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                
					'{{WRAPPER}} i,	{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} svg' => 'fill: {{VALUE}}',
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
				'text1',
				[
					'label'     => esc_html__( 'Titile', 'freeagent' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => 'text 1',
				]
		);
        $repeater->add_control(
				'text2',
				[
					'label'     => esc_html__( 'Description', 'freeagent' ),
					'type'       => Controls_Manager::WYSIWYG,
					'default'   => 'Input text description here',
				]
		);
        $repeater->add_control(
				'text3',
				[
					'label'     => esc_html__( 'Text more', 'freeagent' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => 'text 3',
				]
		);
        
        $repeater->add_control(
			'link_url',
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
			'item_margin',
			[
				'label'      => esc_html__( 'Image Margin', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}}  .jws-banner-image img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);
        
        $this->add_control(
			'list',
			[
				'label' => esc_html__( 'Menu List', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text1' => esc_html__( 'Name #1', 'freeagent' ),
					],
				],
				'title_field' => '{{{ text1 }}}',
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
        $this->add_control(
				'banner_align',
				[
					'label' 		=> esc_html__( 'Content Align', 'freeagent' ),
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
                    'default'=>'',
                    'selectors' => [
							'{{WRAPPER}} .jws-banner .jws-banner-inner  , {{WRAPPER}} .jws-banner .jws-banner-content .button' => 'text-align: {{VALUE}};',
					],
					'frontend_available' => true,
				]
		);
              $this->add_control(
				'banner_align_vertical',
				[
					'label' 		=> esc_html__( 'Vertical Align', 'freeagent' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'options' 		=> [
						'flex-start'    		=> [
							'title' 	=> esc_html__( 'Top', 'freeagent' ),
							'icon' 		=> 'eicon-v-align-top',
						],
						'baseline' 		=> [
							'title' 	=> esc_html__( 'Baseline', 'freeagent' ),
							'icon' 		=> ' eicon-v-align-middle',
						],
						'flex-end' 		=> [
							'title' 	=> esc_html__( 'Bottom', 'freeagent' ),
							'icon' 		=> ' eicon-v-align-bottom',
						],
					],
                    'selectors' => [
							'{{WRAPPER}} .jws-banner' => 'align-items: {{VALUE}};',
					],
					'frontend_available' => true,
				]
		);
        $this->add_control(
			'box_bg_color',
			[
				'label' 	=> esc_html__( 'Background Color', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-banner .jws-banner-item .jws-banner-inner' => 'background-color: {{VALUE}} ;',
				],
			]
		);

  $this->add_control(
			'box_bg_color_hover',
			[
				'label' 	=> esc_html__( 'Background Color Hover', 'freeagent' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-banner .jws-banner-item .jws-banner-inner:hover' => 'background-color: {{VALUE}} ;',
				],
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
					'{{WRAPPER}} .jws-banner .jws-banner-item' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .jws-banner.row' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
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
					'{{WRAPPER}} .jws-banner .jws-banner-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);		$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 		=> 'item_border',
					'label' 	=> esc_html__( 'Border', 'freeagent' ),
					'selector' 	=> '{{WRAPPER}} .jws-banner-inner',
                    
				]
			);
   		   $this->add_control(
			'border_color_hover_box',
			[
				'label' => esc_html__( 'Border Color Hover', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                
					'{{WRAPPER}}  .jws-banner .jws-banner-item .jws-banner-inner:hover' => 'border-color: {{VALUE}}',
				],
             
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
            'label' 		=> esc_html__( 'Box Shadow', 'freeagent' ),
				'name' => 'post_box_shadow',
				'selector' => '{{WRAPPER}} .jws-banner .jws-banner-inner',
			]
		);
    $this->add_responsive_control(
			'box_content_padding',
			[
				'label'      => esc_html__( 'Box Padding', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws-banner .jws-banner-inner ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
         $this->add_responsive_control(
			'banner_box_radius',
			[
				'label'      => esc_html__( 'Box Radius', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws-banner .jws-banner-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_responsive_control(
			'banner_content_padding',
			[
				'label'      => esc_html__( 'Content Padding', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws-banner .jws-banner-inner .jws-banner-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
      

        $this->end_controls_section();
         $this->start_controls_section(
			'banner_img_style',
			[
				'label' => esc_html__( 'Image', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_responsive_control(
			'image_max_size',
			[
				'label' 		=> esc_html__( 'Max width', 'freeagent' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-banner-image' => 'max-width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .jws-banner-content' => 'width: calc(100% - {{SIZE}}{{UNIT}})',
				],
			]
		);
         $this->add_responsive_control(
			'image_re_size',
			[
				'label' 		=> esc_html__( 'Image Size', 'freeagent' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .jws-banner-image img,{{WRAPPER}} .jws-banner-image svg' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				],
			]
		);       
		$this->add_control(
			'list_bg_icon',
			[
				'label' => esc_html__( 'Icon background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                
					'{{WRAPPER}}  .jws-banner-image' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'number_color',
			[
				'label' => esc_html__( 'Number Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                
					'{{WRAPPER}}  .jws-banner-image' => 'color: {{VALUE}}',
                    'condition'=>['show_number'=>'yes'],
				],
			]
		);
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'number_typo',
				'label' => esc_html__( 'Typography', 'freeagent'),
                'selector'      => '{{WRAPPER}}  .jws-banner-image',
                 'condition'=>['show_number'=>'yes'],
            ]
        );
       $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'img_box_shadow',
				'label' =>  esc_html__( 'Box Shadow', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-banner-image',
			]
		);
        $this->add_responsive_control(
			'image_border_radius',
			[
				'label'      => esc_html__( ' Border Radius', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws-banner .jws-banner-inner .jws-banner-image,
                    {{WRAPPER}} .jws-banner .jws-banner-inner .jws-banner-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
                $this->add_responsive_control(
			'image_padding',
			[
				'label'      => esc_html__( ' Padding', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws-banner .jws-banner-inner .jws-banner-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
  $this->add_responsive_control(
			'image_margin',
			[
				'label'      => esc_html__( ' Margin', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws-banner .jws-banner-inner .jws-banner-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
           $this->end_controls_section();      
        $this->start_controls_section(
			'banner_text1_style',
			[
				'label' => esc_html__( 'Text 1', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_control(
			'banner_text1_color',
			[
				'label'     => esc_html__( 'Text Color', 'freeagent' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-banner .text-1' => 'color: {{VALUE}};',
				],
			]
		);
  $this->add_control(
			'banner_text1_color_hover',
			[
				'label'     => esc_html__( 'Text Color Hover', 'freeagent' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-banner-inner:hover .text-1' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'banner_text1_typography',
				'label'     => esc_html__( 'Typography', 'freeagent' ),
				'selector'  => '{{WRAPPER}} .jws-banner .text-1',
			]
		);
        
         $this->add_responsive_control(
			'banner_text1_margin',
			[
				'label'      => esc_html__( 'Margin', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws-banner .text-1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_section();
        
        $this->start_controls_section(
			'banner_text2_style',
			[
				'label' => esc_html__( 'Text 2', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
  $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'banner_text2_typography',
				'label'     => esc_html__( 'Typography', 'freeagent' ),
				'selector'  => '{{WRAPPER}} .jws-banner .text-2',
			]
		);
        $this->add_control(
			'banner_text2_color',
			[
				'label'     => esc_html__( 'Text Color', 'freeagent' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-banner .text-2' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'banner_text2_color_hover',
			[
				'label'     => esc_html__( 'Text Color Color Hover', 'freeagent' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-banner .jws-banner-inner:hover .text-2' => 'color: {{VALUE}};',
				],
			]
		);
        
         $this->add_responsive_control(
			'banner_text2_margin',
			[
				'label'      => esc_html__( 'Margin', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws-banner .text-2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
         $this->end_controls_section();
         $this->start_controls_section(
			'banner_number_style',
			[
				'label' => esc_html__( 'Number', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
  $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'banner_number_typography',
				'label'     => esc_html__( 'Typography', 'freeagent' ),
				'selector'  => '{{WRAPPER}} .jws-banner .number',
			]
		);
        $this->add_control(
			'banner_number_color',
			[
				'label'     => esc_html__( 'Text Color', 'freeagent' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-banner .number' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'banner_number_color_hover',
			[
				'label'     => esc_html__( 'Text Color Color Hover', 'freeagent' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-banner .jws-banner-inner:hover .number' => 'color: {{VALUE}};',
				],
			]
		);
        
         $this->add_responsive_control(
			'banner_number_margin',
			[
				'label'      => esc_html__( 'Margin', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws-banner .number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_section();
        
        
          $this->start_controls_section(
			'banner_readmore_style',
			[
				'label' => esc_html__( 'Read More', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_control(
			'banner_readmore_color',
			[
				'label'     => esc_html__( 'Text Color', 'freeagent' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-banner .btn_view' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'banner_readmore_typography',
				'label'     => esc_html__( 'Typography', 'freeagent' ),
				'selector'  => '{{WRAPPER}} .jws-banner .btn_view',
			]
		);
        
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'banner_readmore_border',
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .jws-banner .btn_view',
				'separator' => 'before',
			]
		);
        
        $this->add_responsive_control(
			'banner_readmore_padding',
			[
				'label'      => esc_html__( 'Padding', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws-banner .btn_view' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
         $this->add_responsive_control(
			'banner_readmore_margin',
			[
				'label'      => esc_html__( 'Margin', 'freeagent' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws-banner .btn_view' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_section();
        
       
        jws_elementor_widget_slider_config($this,['banner_display' => 'slider']);
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
       
        $image_size = (!empty($settings['banner_dimension']['width']) || !empty($settings['banner_dimension']['height'])) ? $settings['banner_dimension']['width'].'x'.$settings['banner_dimension']['height'] : 'full';
        
          $class_column = 'jws-banner-item';
          
          $class_row = 'jws-banner banner '.$settings['banner_layout']; 
          $class_row .= ' '.$settings['banner_display'];
          
          
            $show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
    		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
             $show_inbox = ($settings['show_inbox'] == 'yes') ? 'show_container' : '';

          if($settings['banner_display'] == 'slider') {
                $class_row .= ' swiper jws_list_box_slider '.$show_inbox;
                $class_column .= ' slider-item swiper-slide'; 
                
           }else{
            $class_row .=" row";
            $class_column .= ' col-xl-'.$settings['banner_columns'].'';
              $class_column .= (!empty($settings['banner_columns_tablet'])) ? ' col-lg-'.$settings['banner_columns_tablet'].'' : ' col-lg-'.$settings['banner_columns'].'' ;
              $class_column .= (!empty($settings['banner_columns_mobile'])) ? ' col-'.$settings['banner_columns_mobile'].'' :  ' col-'.$settings['banner_columns'].''; 
           }
          

         ?>
         <div class="jws-banner-element">  
            <div class="<?php echo esc_attr($class_row); ?> "  data-banner="jws-custom-<?php echo esc_attr($this->get_id()); ?>">
                 <?php if($show_arrows && $settings['arrows_position']!='inside' && $settings['banner_display'] == 'slider') : ?>
                 
                        <button class="elementor-swiper-button elementor-swiper-button-prev">
                            <?php $this->render_swiper_button( $settings, 'prev' ); ?>
                        </button>
                        <button class="elementor-swiper-button elementor-swiper-button-next">
                            <?php $this->render_swiper_button( $settings, 'next' ); ?>
                        </button>
      
                <?php endif; ?>
               <?php if($settings['banner_display'] == 'slider') echo '<div class="swiper-wrapper">';?>
                <?php $number; $i = 1; $n = 0; foreach (  $settings['list'] as $index => $item ) {
                if($i < 10) {
                    $number = '0'.$i++;
                }else {
                    $number = $i++;
                }
                   $link_key = 'link' . $index;   
                   if($item['link_url']['nofollow']) $this->add_render_attribute( $link_key, 'rel',  'nofollow' );
                   if($item['link_url']['is_external']) $this->add_render_attribute( $link_key, 'target',  '_blank' );  
                   $this->add_render_attribute( $link_key, 'href',  $item['link_url']['url'] ); 

                    ?>
                        <div class="elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?> <?php echo esc_attr($class_column); ?>" id="loc-<?php echo esc_attr( $item['_id'] ); ?>">
                        <?php  include( ''.$settings['banner_layout'].'.php' );  ?>
                   
                    </div>
                <?php $n++; } ?>
                 <?php if($settings['banner_display'] == 'slider') echo '</div>';?>
                 <?php if($show_arrows && $settings['arrows_position']=='inside' && $settings['banner_display'] == 'slider') : ?>
                   <nav class="jws-banner-nav bottom">
                    <button class="elementor-swiper-button elementor-swiper-button-prev">
                     <?php $this->render_swiper_button( $settings, 'prev' ); ?>
                    </button>
                    <button class="elementor-swiper-button elementor-swiper-button-next">
                     <?php $this->render_swiper_button( $settings, 'next' ); ?>
                    </button>
                    </nav>
                <?php endif; ?>
                <?php  if($show_dots && $settings['banner_display'] == 'slider') echo '<div class="swiper-pagination"></div>';?>

            </div>
                         
         </div>   
        <?php

	}
      private function render_swiper_button( $settings, $type ) {
		$icon_key = 'arrow_icon_' . $type;

		Icons_Manager::render_icon( $settings[ $icon_key ], [ 'aria-hidden' => 'true' ] );
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