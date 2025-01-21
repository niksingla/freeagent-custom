<?php
namespace Elementor;
use Elementor\Core\Schemes\Color;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Jws_Price_Table extends Widget_Base {

	public function get_name() {
		return 'jws-price-table';
	}

	public function get_title() {
		return esc_html__( 'JWS Price Table', 'freeagent' );
	}

	public function get_icon() {
		return 'eicon-price-table';
	}

	public function get_keywords() {
		return [ 'pricing', 'table', 'product', 'image', 'plan', 'button' ];
	}
    public function get_categories() {
		return [ 'jws-elements' ];
	}

	protected function register_controls() {
	   $this->start_controls_section(
			'setting',
			[
				'label' => esc_html__( 'Setting', 'freeagent' ),
			]
		);
        $this->add_control(
			'layout',
			[
				'label' => esc_html__( 'Layout', 'freeagent' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'layout1' => 'Layout 1',
					'layout2' => 'Layout 2',
                    'layout3' => 'Layout 3',

				],
				'default' => 'layout1',
			]
		);
        $this->end_controls_section();
		$this->start_controls_section(
			'section_header',
			[
				'label' => esc_html__( 'Header', 'freeagent' ),
			]
		);
        $this->add_control(
			'top_heading',
			[
				'label' => esc_html__( 'Top Title', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter your top title', 'freeagent' ),
                'condition'   => [
                    'layout!' => 'Layout 3',
                ]
			]
		);
		$this->add_control(
			'heading',
			[
				'label' => esc_html__( 'Title', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter your title', 'freeagent' ),
			]
		);

		$this->add_control(
			'sub_heading',
			[
				'label' => esc_html__( 'Description', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter your description', 'freeagent' ),
			]
		);

        $this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'freeagent' ),
				'type' => Controls_Manager::MEDIA,
			]
		);
        $this->add_control(
			'image_position',
			[
				'label' => esc_html__( 'Image Position', 'freeagent' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'above_title' => 'Above Title',
					'bellow_title' => 'Bellow title',

				],
				'default' => 'above_title',
			]
		);
		$this->add_control(
			'heading_tag',
			[
				'label' => esc_html__( 'Heading Tag', 'freeagent' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				],
				'default' => 'h3',
			]
		);
        $this->add_control(
    			'actived',
    			[
    				'label' => esc_html__( 'Actived', 'freeagent' ),
    				'type' => Controls_Manager::SWITCHER,
    				'default' => 'off',
    				'label_off' => esc_html__( 'Off', 'freeagent' ),
    				'label_on' => esc_html__( 'On', 'freeagent' ),
    			]
    		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_pricing',
			[
				'label' => esc_html__( 'Pricing', 'freeagent' ),
			]
		);
        $this->add_control(
			'currency_symbol',
			[
				'label' => esc_html__( 'Currency Symbol', 'freeagent' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'None', 'freeagent' ),
					'dollar' => '&#36; ' . _x( 'Dollar', 'Currency Symbol', 'freeagent' ),
					'euro' => '&#128; ' . _x( 'Euro', 'Currency Symbol', 'freeagent' ),
					'baht' => '&#3647; ' . _x( 'Baht', 'Currency Symbol', 'freeagent' ),
					'franc' => '&#8355; ' . _x( 'Franc', 'Currency Symbol', 'freeagent' ),
					'guilder' => '&fnof; ' . _x( 'Guilder', 'Currency Symbol', 'freeagent' ),
					'krona' => 'kr ' . _x( 'Krona', 'Currency Symbol', 'freeagent' ),
					'lira' => '&#8356; ' . _x( 'Lira', 'Currency Symbol', 'freeagent' ),
					'peseta' => '&#8359 ' . _x( 'Peseta', 'Currency Symbol', 'freeagent' ),
					'peso' => '&#8369; ' . _x( 'Peso', 'Currency Symbol', 'freeagent' ),
					'pound' => '&#163; ' . _x( 'Pound Sterling', 'Currency Symbol', 'freeagent' ),
					'real' => 'R$ ' . _x( 'Real', 'Currency Symbol', 'freeagent' ),
					'ruble' => '&#8381; ' . _x( 'Ruble', 'Currency Symbol', 'freeagent' ),
					'rupee' => '&#8360; ' . _x( 'Rupee', 'Currency Symbol', 'freeagent' ),
					'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency Symbol', 'freeagent' ),
					'shekel' => '&#8362; ' . _x( 'Shekel', 'Currency Symbol', 'freeagent' ),
					'yen' => '&#165; ' . _x( 'Yen/Yuan', 'Currency Symbol', 'freeagent' ),
					'won' => '&#8361; ' . _x( 'Won', 'Currency Symbol', 'freeagent' ),
					'custom' => esc_html__( 'Custom', 'freeagent' ),
				],
				'default' => 'dollar',
			]
		);

		$this->add_control(
			'currency_symbol_custom',
			[
				'label' => esc_html__( 'Custom Symbol', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'currency_symbol' => 'custom',
				],
			]
		);

		$this->add_control(
			'price',
			[
				'label' => esc_html__( 'Price', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'default' => '39.99',
				'dynamic' => [
					'active' => true,
				],
			]
		);
        $this->add_control(
			'currency_format',
			[
				'label' => esc_html__( 'Currency Format', 'freeagent' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => '1,234.56 (Default)',
					',' => '1.234,56',
				],
			]
		);
		$this->add_control(
			'period',
			[
				'label' => esc_html__( 'Period', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Monthly', 'freeagent' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_features',
			[
				'label' => esc_html__( 'Features', 'freeagent' ),
			]
		);
        $this->add_control(
			'title_features',
			[
				'label' => esc_html__( 'Title Features', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Offer includes:', 'freeagent' ),
                'condition' => [
						'layout' => 'layout2',
				    ],
			]
		);
		$repeater = new Repeater();

		$repeater->add_control(
			'item_text',
			[
				'label' => esc_html__( 'Text', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'List Item', 'freeagent' ),
			]
		);

		$default_icon = [
			'value' => 'far fa-check-circle',
			'library' => 'fa-regular',
		];

		$repeater->add_control(
			'selected_item_icon',
			[
				'label' => esc_html__( 'Icon', 'freeagent' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'item_icon',
				'default' => $default_icon,
			]
		);

		$repeater->add_control(
			'item_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .jws-price-table__feature-inner i' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .jws-price-table__feature-inner svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$repeater->add_control(
			'item_color',
			[
				'label' => esc_html__( 'Text Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .jws-price-table__feature-inner' => 'color: {{VALUE}}',
			
				],
			]
		);
		$this->add_control(
			'features_list',
			[
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'item_text' => esc_html__( 'List Item #1', 'freeagent' ),
						'selected_item_icon' => $default_icon,
					],
					[
						'item_text' => esc_html__( 'List Item #2', 'freeagent' ),
						'selected_item_icon' => $default_icon,
					],
					[
						'item_text' => esc_html__( 'List Item #3', 'freeagent' ),
						'selected_item_icon' => $default_icon,
					],
				],
				'title_field' => '{{{ item_text }}}',
			]
		);

		$this->end_controls_section();
            $this->start_controls_section(
    			'section_addons',
    			[
    				'label' => esc_html__( 'Addons', 'freeagent' ),
                    'condition' => [
    						'layout' => 'layout2',
    				    ],
    			]
    		);
            $this->add_control(
    			'title_addons',
    			[
    				'label' => esc_html__( 'Title Addons', 'freeagent' ),
    				'type' => Controls_Manager::TEXT,
    				'default' => esc_html__( 'Add-ons:', 'freeagent' ),
                    'condition' => [
    						'layout' => 'layout2',
    				    ],
    			]
    		);
    		$repeater_addons = new Repeater();
    
    		$repeater_addons->add_control(
    			'addons_item_text',
    			[
    				'label' => esc_html__( 'Text', 'freeagent' ),
    				'type' => Controls_Manager::TEXT,
    				'default' => esc_html__( 'List Item', 'freeagent' ),
    			]
    		);
    
    		$default_icon_addons = [
    			'value' => 'far fa-check-circle',
    			'library' => 'fa-regular',
    		];
    
    		$repeater_addons->add_control(
    			'addons_selected_item_icon',
    			[
    				'label' => esc_html__( 'Icon', 'freeagent' ),
    				'type' => Controls_Manager::ICONS,
    				'fa4compatibility' => 'item_icon',
    				'default' => $default_icon_addons,
                
    			]
    		);    
    
    		$repeater_addons->add_control(
    			'addons_item_icon_color',
    			[
    				'label' => esc_html__( 'Icon Color', 'freeagent' ),
    				'type' => Controls_Manager::COLOR,
    				'selectors' => [
    					'{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
    					'{{WRAPPER}} {{CURRENT_ITEM}} svg' => 'fill: {{VALUE}}',
    				],
    			]
    		);
    
    		$this->add_control(
    			'addons_list',
    			[
    				'type' => Controls_Manager::REPEATER,
    				'fields' => $repeater_addons->get_controls(),
    				'default' => [
    					[
    						'addons_item_text' => esc_html__( 'List Item #1', 'freeagent' ),
    						'addons_selected_item_icon' => $default_icon_addons,
    					],
    					[
    						'addons_item_text' => esc_html__( 'List Item #2', 'freeagent' ),
    						'addons_selected_item_icon' => $default_icon_addons,
    					],
    					[
    						'addons_item_text' => esc_html__( 'List Item #3', 'freeagent' ),
    						'selected_item_icon' => $default_icon_addons,
    					],
    				],
    				'title_field' => '{{{ addons_item_text }}}',
                    'condition' => [
    						'layout' => 'layout2',
    				    ],
    			]
    		);
    
    		$this->end_controls_section();
        $this->start_controls_section(
			'section_details',
			[
				'label' => esc_html__( 'View Details', 'freeagent' ),
                'condition' => [
						'layout' => 'layout2',
				    ],
			]
		);
        $this->add_control(
			'title_details',
			[
				'label' => esc_html__( 'Title details', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'View details', 'freeagent' ),
                'condition' => [
						'layout' => 'layout2',
				    ],
			]
		);
		$repeater_details = new Repeater();

		$repeater_details->add_control(
			'details_item_title',
			[
				'label' => esc_html__( 'Title', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'List Item', 'freeagent' ),
			]
		);
        $repeater_details->add_control(
			'details_item_content',
			[
				'label' => esc_html__( 'Content', 'freeagent' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'List Item', 'freeagent' ),
			]
		);
 

		$this->add_control(
			'details_list',
			[
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater_details->get_controls(),
				'default' => [
					[
						'details_item_title' => esc_html__( 'List Item #1', 'freeagent' ),
                        'details_item_content' => esc_html__( 'List Item #1', 'freeagent' ),
					],
					[
						'details_item_text' => esc_html__( 'List Item #2', 'freeagent' ),
						'details_item_content' => esc_html__( 'List Item #21', 'freeagent' ),
					],
					
				],
				'title_field' => '{{{ details_item_title }}}',
                'condition' => [
						'layout' => 'layout2',
				    ],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_footer',
			[
				'label' => esc_html__( 'Footer', 'freeagent' ),
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Click Here', 'freeagent' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'freeagent' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'freeagent' ),
				'default' => [
					'url' => '#',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'footer_detail',
			[
				'label' => esc_html__( 'View Detail', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'This is text element', 'freeagent' ),
			]
		);
        
        $this->add_control(
			'link_detail',
			[
				'label' => esc_html__( 'Link', 'freeagent' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'freeagent' ),
				'default' => [
					'url' => '#',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
        
		$this->end_controls_section();
        $this->start_controls_section(
			'section_ribbon',
			[
				'label' => esc_html__( 'Ribbon', 'freeagent' ),
			]
		);

		$this->add_control(
			'show_ribbon',
			[
				'label' => esc_html__( 'Show', 'freeagent' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ribbon_title',
			[
				'label' => esc_html__( 'Title', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Popular', 'freeagent' ),
				'condition' => [
					'show_ribbon' => 'yes',
				],
			]
		);

		$this->add_control(
			'ribbon_horizontal_position',
			[
				'label' => esc_html__( 'Position', 'freeagent' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
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
				'condition' => [
					'show_ribbon' => 'yes',
				],
			]
		);

		$this->end_controls_section();
        
        $this->start_controls_section(
			'section_box_style',
			[
				'label' => esc_html__( 'Table', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);
        
                $this->add_responsive_control(
				'content_align',
				[
					'label' 		=> esc_html__( 'Align', 'freeagent' ),
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
                    'selectors' => [
							'{{WRAPPER}} .jws-price-table' => 'text-align: {{VALUE}};',
                          
					],
					'frontend_available' => true,
				]
		);
        $this->add_responsive_control(
			'table_padding',
			[
				'label' => esc_html__( 'Padding', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_responsive_control(
			'table_radius',
			[
				'label' => esc_html__( 'Border Radius', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_group_control(
			Group_Control_Border::get_type(), [
				'name' => 'table_border',
				'selector' => '{{WRAPPER}} .jws-price-table',
			]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'table_shadow',
				'selector' => '{{WRAPPER}} .jws-price-table',
			]
		);
        $this->add_control(
			'table_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .jws-price-table' => 'background-color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_section();
        
		$this->start_controls_section(
			'section_header_style',
			[
				'label' => esc_html__( 'Header', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);
    $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'header_border',
				'label' => esc_html__( 'Border', 'freeagent' ),
				'selector' => '{{WRAPPER}} .jws-price-table__header',
			]
		);
		$this->add_control(
			'header_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__header' => 'background-color: {{VALUE}}',
				],
			]
		);
        
		$this->add_responsive_control(
			'header_padding',
			[
				'label' => esc_html__( 'Padding', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'top_heading_heading_style',
			[
				'label' => esc_html__( 'Top Title', 'freeagent' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'top_heading_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__top_heading' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'top_before_circle_heading_color',
			[
				'label' => esc_html__( 'Before Circle Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__top_heading::before' => 'background: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'top_after_circle_heading_color',
			[
				'label' => esc_html__( 'After Circle Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__top_heading::after' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'top_heading_typography',
				'selector' => '{{WRAPPER}} .jws-price-table__top_heading',
			]
		);
        
		$this->add_control(
			'heading_heading_style',
			[
				'label' => esc_html__( 'Title', 'freeagent' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__heading' => 'color: {{VALUE}}',
				],
			]
		);
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'selector' => '{{WRAPPER}} .jws-price-table__heading',
			]
		);
        $this->add_responsive_control(
			'heading_margin',
			[
				'label' => esc_html__( 'Margin', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'heading_sub_heading_style',
			[
				'label' => esc_html__( 'Sub Title', 'freeagent' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'sub_heading_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__subheading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_heading_typography',
				'selector' => '{{WRAPPER}} .jws-price-table__subheading',
			]
		);
        $this->add_responsive_control(
			'sub_heading_margin',
			[
				'label' => esc_html__( 'Margin', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__subheading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_pricing_element_style',
			[
				'label' => esc_html__( 'Pricing', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);
                $this->add_responsive_control(
				'pricing_align',
				[
					'label' 		=> esc_html__( 'Align', 'freeagent' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'options' 		=> [
						'flex-start'    		=> [
							'title' 	=> esc_html__( 'Left', 'freeagent' ),
							'icon' 		=> 'eicon-h-align-left',
						],
						'center' 		=> [
							'title' 	=> esc_html__( 'Center', 'freeagent' ),
							'icon' 		=> 'eicon-h-align-center',
						],
						'flex-end' 		=> [
							'title' 	=> esc_html__( 'Right', 'freeagent' ),
							'icon' 		=> 'eicon-h-align-right',
						],
					],
                    'selectors' => [
							'{{WRAPPER}} .jws-price-table .jws-price-table__price' => 'justify-content: {{VALUE}};',
                          
					],
					'frontend_available' => true,
				]
		);
		$this->add_control(
			'pricing_element_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__price' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'pricing_element_padding',
			[
				'label' => esc_html__( 'Padding', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'price_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table .jws-price-table__integer-part' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);
        
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'selector' => '{{WRAPPER}} .jws-price-table__price',
				'scheme' => Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'heading_currency_style',
			[
				'label' => esc_html__( 'Currency Symbol', 'freeagent' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'currency_symbol!' => '',
				],
			]
		);

		$this->add_control(
			'currency_size',
			[
				'label' => esc_html__( 'Size', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__currency' => 'font-size: calc({{SIZE}}em/100)',
				],
				'condition' => [
					'currency_symbol!' => '',
				],
			]
		);

		$this->add_control(
			'currency_position',
			[
				'label' => esc_html__( 'Position', 'freeagent' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'before',
				'options' => [
					'before' => [
						'title' => esc_html__( 'Before', 'freeagent' ),
						'icon' => 'eicon-h-align-left',
					],
					'after' => [
						'title' => esc_html__( 'After', 'freeagent' ),
						'icon' => 'eicon-h-align-right',
					],
				],
			]
		);

		$this->add_control(
			'currency_vertical_position',
			[
				'label' => esc_html__( 'Vertical Position', 'freeagent' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => esc_html__( 'Top', 'freeagent' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => esc_html__( 'Middle', 'freeagent' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'freeagent' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'selectors_dictionary' => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__currency' => 'align-self: {{VALUE}}',
				],
				'condition' => [
					'currency_symbol!' => '',
				],
			]
		);
        $this->add_control(
			'currency_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table .jws-price-table__currency' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'fractional_part_style',
			[
				'label' => esc_html__( 'Fractional Part', 'freeagent' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'fractional-part_size',
			[
				'label' => esc_html__( 'Size', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__fractional-part' => 'font-size: calc({{SIZE}}em/100)',
				],
			]
		);

		$this->add_control(
			'fractional_part_vertical_position',
			[
				'label' => esc_html__( 'Vertical Position', 'freeagent' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => esc_html__( 'Top', 'freeagent' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => esc_html__( 'Middle', 'freeagent' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'freeagent' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'selectors_dictionary' => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__after-price' => 'justify-content: {{VALUE}}',
				],
			]
		);
        
		$this->add_control(
			'heading_period_style',
			[
				'label' => esc_html__( 'Period', 'freeagent' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'period!' => '',
				],
			]
		);

		$this->add_control(
			'period_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table .jws-price-table__price .jws-price-table__period' => 'color: {{VALUE}}',
				],
				'condition' => [
					'period!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'period_typography',
				'selector' => '{{WRAPPER}} .jws-price-table .jws-price-table__price .jws-price-table__period',
				'condition' => [
					'period!' => '',
				],
			]
		);
        	$this->add_control(
			'period_position',
			[
				'label' => esc_html__( 'Position', 'freeagent' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => false,
				'options' => [
					'below' => esc_html__( 'Below', 'freeagent' ),
					'beside' => esc_html__( 'Beside', 'freeagent' ),
				],
				'default' => 'below',
				'condition' => [
					'period!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_features_list_style',
			[
				'label' => esc_html__( 'Features', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_control(
			'features_list_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__features-list' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'features_list_padding',
			[
				'label' => esc_html__( 'Padding', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__features-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(), [
				'name' => 'item_border',
				'selector' => '{{WRAPPER}} .jws-price-table .jws-price-table__features-list',
			]
		);
		$this->add_control(
			'features_list_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__features-list' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'features_list_typography',
				'selector' => '{{WRAPPER}} .jws-price-table__features-list li',
			]
		);

		$this->add_control(
			'features_list_alignment',
			[
				'label' => esc_html__( 'Alignment', 'freeagent' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
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
					'{{WRAPPER}} .jws-price-table__features-list, {{WRAPPER}} .jws-price-table__features-list' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'list_icon_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__features-list li svg path' => 'fill: {{VALUE}}',
                    	'{{WRAPPER}} .jws-price-table__features-list li i' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					' {{WRAPPER}} .jws-price-table__features-list li i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ' {{WRAPPER}} .jws-price-table__features-list li svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_width',
			[
				'label' => esc_html__( 'Width', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'%' => [
						'min' => 25,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__feature-inner' => 'margin-left: calc((100% - {{SIZE}}%)/2); margin-right: calc((100% - {{SIZE}}%)/2)',
				],
			]
		);
	
		$this->add_responsive_control(
			'row_gap',
			[
				'label'     => esc_html__( 'Spacing', 'freeagent' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 35,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__features-list li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'divider_gap',
			[
				'label' => esc_html__( 'Gap', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
					],
				],
				'condition' => [
					'list_divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table .jws-price-table__features-list li' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_footer_style',
			[
				'label' => esc_html__( 'Footer', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'freeagent' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
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
					'justify' => [
						'title' => esc_html__( 'Justified', 'freeagent' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'default' => '',
			]
		);
		$this->add_control(
			'footer_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__footer,jws-price-table__quote' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'footer_padding',
			[
				'label' => esc_html__( 'Padding', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_footer_button',
			[
				'label' => esc_html__( 'Button', 'freeagent' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'button_text!' => '',
				],
			]
		);


		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'freeagent' ),
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__button' => 'color: {{VALUE}};',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .jws-price-table__button',
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__button' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .jws-price-table__button',
				'condition' => [
					'button_text!' => '',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'button_text_padding',
			[
				'label' => esc_html__( 'Text Padding', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);
		$this->add_responsive_control(
			'button_text_margin',
			[
				'label' => esc_html__( 'Margin', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'freeagent' ),
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__button:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__button:hover' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__button:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_hover_animation',
			[
				'label' => esc_html__( 'Animation', 'freeagent' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'heading_detail',
			[
				'label' => esc_html__( 'View Detail', 'freeagent' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'footer_detail!' => '',
				],
			]
		);

		$this->add_control(
			'detail_color',
			[
				'label' => esc_html__( 'Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table .jws-price-table__footer .jws-price-footer_detail' => 'color: {{VALUE}}',
				],
				'condition' => [
					'footer_detail!' => '',
				],
			]
		);
        $this->add_control(
			'detail_color_hover',
			[
				'label' => esc_html__( 'Color Hover', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table .jws-price-table__footer .jws-price-footer_detail:hover' => 'color: {{VALUE}}',
				],
				'condition' => [
					'footer_detail!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'detail_typography',
				'selector' => '{{WRAPPER}} .jws-price-table .jws-price-table__footer .jws-price-footer_detail',
				'condition' => [
					'footer_detail!' => '',
				],
			]
		);

		$this->add_control(
			'detail__margin',
			[
				'label' => esc_html__( 'Margin', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table .jws-price-table__footer .jws-price-footer_detail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition' => [
					'footer_detail!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_ribbon_style',
			[
				'label' => esc_html__( 'Ribbon', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition' => [
					'show_ribbon' => 'yes',
				],
			]
		);

		$this->add_control(
			'ribbon_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__ribbon-inner' => 'background-color: {{VALUE}}',
				],
			]
		);

		$ribbon_distance_transform = is_rtl() ? 'translateY(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)' : 'translateY(-50%) translateX(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)';

		$this->add_responsive_control(
			'ribbon_distance',
			[
				'label' => esc_html__( 'Distance', 'freeagent' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__ribbon-inner' => 'transform:rotate({{SIZE}}deg)',
				],
			]
		);

		$this->add_control(
			'ribbon_text_color',
			[
				'label' => esc_html__( 'Text Color', 'freeagent' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__ribbon-inner' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ribbon_typography',
				'selector' => '{{WRAPPER}} .jws-price-table__ribbon-inner',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .jws-price-table__ribbon-inner',
			]
		);
		$this->add_responsive_control(
			'ribbon_element_padding',
			[
				'label' => esc_html__( 'Padding', 'freeagent' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .jws-price-table__ribbon-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}
    	private function render_currency_symbol( $symbol, $location ) {
		$currency_position = $this->get_settings( 'currency_position' );
		$location_setting = ! empty( $currency_position ) ? $currency_position : 'before';
		if ( ! empty( $symbol ) && $location === $location_setting ) {
			echo '<span class="jws-price-table__currency jws-currency--' . $location . '">' . $symbol . '</span>';
		}
	}

	private function get_currency_symbol( $symbol_name ) {
		$symbols = [
			'dollar' => '&#36;',
			'euro' => '&#128;',
			'franc' => '&#8355;',
			'pound' => '&#163;',
			'ruble' => '&#8381;',
			'shekel' => '&#8362;',
			'baht' => '&#3647;',
			'yen' => '&#165;',
			'won' => '&#8361;',
			'guilder' => '&fnof;',
			'peso' => '&#8369;',
			'peseta' => '&#8359',
			'lira' => '&#8356;',
			'rupee' => '&#8360;',
			'indian_rupee' => '&#8377;',
			'real' => 'R$',
			'krona' => 'kr',
		];

		return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        $symbol = '';

		if ( ! empty( $settings['currency_symbol'] ) ) {
			if ( 'custom' !== $settings['currency_symbol'] ) {
				$symbol = $this->get_currency_symbol( $settings['currency_symbol'] );
			} else {
				$symbol = $settings['currency_symbol_custom'];
			}
		}
        $currency_format = empty( $settings['currency_format'] ) ? '.' : $settings['currency_format'];
		$price = explode( $currency_format, $settings['price'] );
		$intpart = $price[0];
		$fraction = '';
		if ( 2 === count( $price ) ) {
			$fraction = $price[1];
		}

		$this->add_render_attribute( 'button_text', 'class', [
			'jws-price-table__button btn-button btn-primary',
		] );


		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'button_text', 'href', $settings['link']['url'] );

			if ( ! empty( $settings['link']['is_external'] ) ) {
				$this->add_render_attribute( 'button_text', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'button_text', 'rel', 'nofollow' );
			}
		}
        
        if ( ! empty( $settings['link_detail']['url'] ) ) {
			$this->add_render_attribute( 'footer_detail', 'href', $settings['link_detail']['url'] );

			if ( ! empty( $settings['link_detail']['is_external'] ) ) {
				$this->add_render_attribute( 'footer_detail', 'target', '_blank' );
			}

			if ( $settings['link_detail']['nofollow'] ) {
				$this->add_render_attribute( 'footer_detail', 'rel', 'nofollow' );
			}
		}
            
		if ( ! empty( $settings['button_hover_animation'] ) ) {
			$this->add_render_attribute( 'button_text', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
		}
        $this->add_render_attribute( 'ribbon_title', 'class', 'jws-price-table__ribbon-inner' );
        $this->add_render_attribute( 'top_heading', 'class', 'jws-price-table__top_heading' );
		$this->add_render_attribute( 'heading', 'class', 'jws-price-table__heading' );
		$this->add_render_attribute( 'sub_heading', 'class', 'jws-price-table__subheading' );
		$this->add_render_attribute( 'period', 'class', [ 'jws-price-table__period', 'elementor-typo-excluded' ] );
		$this->add_render_attribute( 'footer_detail', 'class', 'jws-price-footer_detail' );
        
        $this->add_inline_editing_attributes( 'ribbon_title' );
        $this->add_inline_editing_attributes( 'top_heading', 'none' );
		$this->add_inline_editing_attributes( 'heading', 'none' );
		$this->add_inline_editing_attributes( 'sub_heading', 'none' );
		$this->add_inline_editing_attributes( 'period', 'none' );
		$this->add_inline_editing_attributes( 'footer_detail' );
		$this->add_inline_editing_attributes( 'button_text' );

		$period_element = '<span ' . $this->get_render_attribute_string( 'period' ) . '><span>' . $settings['period'] . '</span></span>';
		$heading_tag = $settings['heading_tag'];
        $period_position = $settings['period_position'];
		$migration_allowed = Icons_Manager::is_migration_allowed();
        $actived = $settings['actived']? 'actived': '';
		?>

		<div class="jws-price-table <?php echo esc_attr($actived);?> <?php echo esc_attr($settings['layout']);?>">
              <?php
    		if ( 'yes' === $settings['show_ribbon'] && ! empty( $settings['ribbon_title'] ) ) :
    			$this->add_render_attribute( 'ribbon-wrapper', 'class', 'jws-price-table__ribbon' );
    
    			if ( ! empty( $settings['ribbon_horizontal_position'] ) ) :
    				$this->add_render_attribute( 'ribbon-wrapper', 'class', 'jws-ribbon-' . $settings['ribbon_horizontal_position'] );
    			endif;
    
    			?>
    			<div <?php echo wp_kses_post($this->get_render_attribute_string( 'ribbon-wrapper' )); ?>>
    				<div <?php echo wp_kses_post($this->get_render_attribute_string( 'ribbon_title' )); ?>><?php echo esc_html($settings['ribbon_title']); ?></div>
    			</div>
    			<?php
    		endif;?>
			<?php if ( $settings['heading'] || $settings['sub_heading'] ) : ?>
				<div class="jws-price-table__header">
                  <div class="top_image">
                    <?php if($settings['image_position'] == 'above_title') : ?>
                        <?php if($settings['image']&&!empty($settings['image']['url'])):?>
                            <div class="jws-price-table__image">
                                    <img src="<?php echo esc_url($settings['image']['url']) ?>" alt="#">
                            </div>
                        <?php endif; ?>
                    <?php endif;?>
                        <?php if ( ! empty( $settings['top_heading'] ) && $settings['layout']!='layout3') : ?>
    						<span <?php echo  wp_kses_post($this->get_render_attribute_string( 'top_heading' )); ?>><?php echo esc_html($settings['top_heading']); ?></span>
    					<?php endif; ?>
                    
                
					<?php if ( ! empty( $settings['heading'] ) ) : ?>
						<<?php echo wp_kses_post($heading_tag . ' ' . $this->get_render_attribute_string( 'heading' )); ?>><?php echo esc_html($settings['heading']) . '</' . $heading_tag; ?>>
					<?php endif; ?>
                    </div>
                    
                    <div class="jws-price-table__price">
                        <?php $this->render_currency_symbol( $symbol, 'before' ); ?>
        				<?php if ( ! empty( $intpart ) || 0 <= $intpart ) : ?>
        					<span class="jws-price-table__integer-part"><?php echo wp_kses_post($intpart); ?></span>
        				<?php endif; ?>
        
        				<?php if ( '' !== $fraction || ( ! empty( $settings['period'] ) && 'beside' === $period_position ) ) : ?>
        					<div class="jws-price-table__after-price">
        						<span class="jws-price-table__fractional-part"><?php echo wp_kses_post($fraction); ?></span>
        
        						<?php if ( ! empty( $settings['period'] ) && 'beside' === $period_position ) : ?>
        							<?php echo wp_kses_post($period_element); ?>
        						<?php endif; ?>
        					</div>
        				<?php endif; ?>
        
        				<?php $this->render_currency_symbol( $symbol, 'after' ); ?>
        
        				<?php if ( ! empty( $settings['period'] ) && 'below' === $period_position ) : ?>
        					<?php echo wp_kses_post($period_element); ?>
        				<?php endif; ?>
        			</div>
					<?php if ( ! empty( $settings['sub_heading'] ) ) : ?>
						<span <?php echo wp_kses_post($this->get_render_attribute_string( 'sub_heading' )); ?>><?php echo esc_html($settings['sub_heading']); ?></span>
					<?php endif; ?>
                    <?php if($settings['image_position'] == 'bellow_title') : ?>
                        <?php if($settings['image']&&!empty($settings['image']['url'])):?>
                            <div class="jws-price-table__image">
                                    <img src="<?php echo esc_url($settings['image']['url']) ?>" alt="#">
                            </div>
                        <?php endif; ?>
                    <?php endif;?>
                    <?php if ( $settings['layout']== 'layout2' && ( ! empty( $settings['button_text'] )) ) : ?>
        				
        					<?php if ( ! empty( $settings['button_text'] ) ) : ?>
        						<a <?php echo wp_kses_post($this->get_render_attribute_string( 'button_text' )); ?>><?php echo esc_html($settings['button_text']); ?></a>
        					<?php endif; ?>
        				
        			<?php endif; ?>
				</div>
			<?php endif; ?>
	
			<?php if ( ! empty( $settings['features_list'] ) ) : ?>
                    
				<ul class="jws-price-table__features-list">
                    <?php if ( $settings['layout']== 'layout2' && ( ! empty( $settings['title_features'] )) ) : ?>
        				<h6 class="features-title">
        					
        						<?php echo wp_kses_post($settings['title_features']); ?>
        					
        				</h6>
        			<?php endif; ?>
					<?php
					foreach ( $settings['features_list'] as $index => $item ) :
						$repeater_setting_key = $this->get_repeater_setting_key( 'item_text', 'features_list', $index );
						$this->add_inline_editing_attributes( $repeater_setting_key );

						$migrated = isset( $item['__fa4_migrated']['selected_item_icon'] );
						// add old default
						if ( ! isset( $item['item_icon'] ) && ! $migration_allowed ) {
							$item['item_icon'] = 'fa fa-check-circle';
						}
						$is_new = ! isset( $item['item_icon'] ) && $migration_allowed;
						?>
						<li class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
							<div class="jws-price-table__feature-inner">
								<?php if ( ! empty( $item['item_icon'] ) || ! empty( $item['selected_item_icon'] ) ) :
									if ( $is_new || $migrated ) :
										Icons_Manager::render_icon( $item['selected_item_icon'], [ 'aria-hidden' => 'true' ] );
									else : ?>
										<i class="<?php echo esc_attr( $item['item_icon'] ); ?>" aria-hidden="true"></i>
										<?php
									endif;
								endif; ?>
								<?php if ( ! empty( $item['item_text'] ) ) : ?>
									<span <?php echo wp_kses_post($this->get_render_attribute_string( $repeater_setting_key )); ?>>
										<?php echo esc_html($item['item_text']); ?>
									</span>
									<?php
								else :
									echo '&nbsp;';
								endif;
								?>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
            <?php if ( ! empty( $settings['addons_list'] ) ) : ?>
                    
                    <ul class="jws-price-table__addons-list">
                        <?php if ( $settings['layout']== 'layout2' && ( ! empty( $settings['title_addons'] )) ) : ?>
                            <h6 class="addons-title">
                                
                                    <?php echo esc_html($settings['title_addons']); ?>
                                
                            </h6>
                        <?php endif; ?>
                        <?php
                        foreach ( $settings['addons_list'] as $index => $item ) :
                            $repeater_setting_key_addons = $this->get_repeater_setting_key( 'addons_item_text', 'addons_list', $index );
                            $this->add_inline_editing_attributes( $repeater_setting_key_addons );
    
                            $migrated = isset( $item['__fa4_migrated']['addons_selected_item_icon'] );
                            // add old default
                            if ( ! isset( $item['item_icon'] ) && ! $migration_allowed ) {
                                $item['item_icon'] = 'fa fa-check-circle';
                            }
                            $is_new = ! isset( $item['item_icon'] ) && $migration_allowed;
                            ?>
                            <li class="jws-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                                <div class="jws-price-table__addon-inner">
                                    <?php if ( ! empty( $item['item_icon'] ) || ! empty( $item['addons_selected_item_icon'] ) ) :
                                        if ( $is_new || $migrated ) :
                                            Icons_Manager::render_icon( $item['addons_selected_item_icon'], [ 'aria-hidden' => 'true' ] );
                                        else : ?>
                                            <i class="<?php echo esc_attr( $item['item_icon'] ); ?>" aria-hidden="true"></i>
                                            <?php
                                        endif;
                                    endif; ?>
                                    <?php if ( ! empty( $item['addons_item_text'] ) ) : ?>
                                        <span <?php echo wp_kses_post($this->get_render_attribute_string( $repeater_setting_key_addons )); ?>>
                                            <?php echo wp_kses_post($item['addons_item_text']); ?>
                                        </span>
                                        <?php
                                    else :
                                        echo '&nbsp;';
                                    endif;
                                    ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
			<?php if ($settings['layout']== 'layout1' || $settings['layout']== 'layout3' && ( ! empty( $settings['button_text'] ) || ! empty( $settings['footer_detail'] )) ) : ?>
				<div class="jws-price-table__footer">
					<?php if ( ! empty( $settings['button_text'] ) ) : ?>
						<a <?php echo wp_kses_post($this->get_render_attribute_string( 'button_text' )); ?>><?php echo esc_html($settings['button_text']); ?></a>
					<?php endif; ?>

					<?php if ( ! empty( $settings['footer_detail'] ) ) : ?>
						<a <?php echo wp_kses_post($this->get_render_attribute_string( 'footer_detail' )); ?>><?php echo wp_kses_post($settings['footer_detail']); ?><span class="jws-icon-arrow-ios-forward-outline"></span></a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
            <?php if ( $settings['layout']== 'layout2' ) : ?>
                <?php if ( ! empty( $settings['details_list'] ) ) : ?>
                    <div class="jws-price-table__details">
                    <?php if ( ! empty( $settings['title_details'] ) ) : ?>
                            <h6 class="details-title">
                                
                                    <?php echo wp_kses_post($settings['title_details']); ?>
                                
                            </h6>
                            <span class="btn-tongle-detail"><i aria-hidden="true" class="eva eva-arrow-down"></i></span>
                        <?php endif; ?>
                  
                    </div>
                <?php endif; ?>
			<?php endif; ?>
            <?php if ( $settings['layout']== 'layout2' ) : ?>
                <?php if ( ! empty( $settings['details_list'] ) ) : ?>
        
                    <div class="jws-price-table__details-list">
                        <?php
                        foreach ( $settings['details_list'] as $index => $item ) :
                            $repeater_setting_key_details = $this->get_repeater_setting_key( 'details_item_title', 'details_list', $index );
                            $this->add_inline_editing_attributes( $repeater_setting_key_details );
    
                            ?>
                            <div class="jws-repeater-details-item jws-repeater-details-item-<?php echo esc_attr($item['_id']); ?>">
                                <div class="jws-price-table__detail-inner">
                                    <?php if ( ! empty( $item['details_item_title'] ) ) : ?>
                                        <h6 <?php echo wp_kses_post($this->get_render_attribute_string( $repeater_setting_key_details )); ?>>
                                            <?php echo esc_html($item['details_item_title']); ?>
                                        </h6>
                                        <?php
                                    endif;
                                    ?>
                                    <?php if ( ! empty( $item['details_item_content'] ) ) : ?>
                                        <div class="jws-price-table__detail-item-content">
                                            <?php echo wp_kses_post($item['details_item_content']); ?>
                                        </div>
                                        <?php
                                    endif;
                                    ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
			<?php endif; ?>
		</div>

		<?php
	}

	protected function content_template() {}
}
