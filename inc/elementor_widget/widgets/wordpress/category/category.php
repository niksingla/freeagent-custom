<?php

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Category extends Widget_Base {

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
		return 'jws_category';
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
		return esc_html__( 'Jws Category', 'freeagent' );
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
		return 'eicon-product-categories';
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
			'section_category_setting',
			[
				'label' => esc_html__( 'Setting', 'freeagent' ),
			]
		);
        $this->add_control(
				'skins',
				[
					'label'     => esc_html__( 'Skins', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'default',
					'options'   => [
                        'default'   => esc_html__( 'Default', 'freeagent' ),
						'with_icon'   => esc_html__( 'With Icon', 'freeagent' ),
                        'with_border'   => esc_html__( 'With Border', 'freeagent' ),
                        'with_bg'   => esc_html__( 'With Background', 'freeagent' ),
					],
				]
		);
        $this->add_control(
			'show_count',
			[
				'label' => esc_html__( 'Show Count', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'freeagent' ),
				'label_off' => esc_html__( 'Hide', 'freeagent' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'show_hierarchical',
			[
				'label' => esc_html__( 'Show Hierarchical', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'freeagent' ),
				'label_off' => esc_html__( 'Hide', 'freeagent' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'show_dropdown',
			[
			    'label' => esc_html__( 'Show Dropdown', 'freeagent' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'freeagent' ),
				'label_off' => esc_html__( 'Hide', 'freeagent' ),
				'return_value' => 'yes',
			]
		);
        
		$this->end_controls_section();
        $this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Toggle Style', 'freeagent' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'freeagent'),
		
				'selector' => '{{WRAPPER}} .jws_categories .cate_title',
			]
		);
		$this->add_responsive_control(
			'item_self_align',
			[
				'label' => esc_html__( 'Alignment', 'freeagent' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'freeagent' ),
						'icon' => 'eicon-justify-start-h',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'freeagent' ),
						'icon' => 'eicon-justify-center-h',
					],
				    'space-between' => [
						'title' => esc_html__( 'Space Between', 'freeagent' ),
						'icon' => 'eicon-justify-space-between-h',
					],
	               'space-around' => [
						'title' => esc_html__( 'Space Around', 'freeagent' ),
						'icon' => 'eicon-justify-space-around-h',
					],
                    
					'flex-end' => [
						'title' => esc_html__( 'Right', 'freeagent' ),
						'icon' => 'eicon-justify-end-h',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws_categories .jws_list_categories li.cat-item' => 'justify-content: {{VALUE}};',
				],
			]
		);
        $this->add_control(
				'spacing',
				[
					'label' 		=> esc_html__( 'Spacing', 'freeagent' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' => 1,
							'max' => 100,
							'step' => 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .jws_categories .jws_list_categories li' => 'margin-bottom: {{SIZE}}px;',
					],
				]
		);
         $this->add_control(
					'text_color',
					[
						'label' 	=> esc_html__( 'Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .jws_categories .jws_list_categories li a,
                            {{WRAPPER}} .jws_categories .jws_list_categories li span' => 'color: {{VALUE}};',
						],
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => esc_html__( 'Typography', 'freeagent'),
		
				'selector' => '{{WRAPPER}} .jws_categories .jws_list_categories li, 
                {{WRAPPER}} .jws_categories .jws_list_categories li span',
			]
		);
        $this->add_control(
					'link_color',
					[
						'label' 	=> esc_html__( 'Link Color', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .jws_categories .jws_list_categories li a,
                            {{WRAPPER}} .jws_categories .jws_list_categories li span' => 'color: {{VALUE}};',
						],
					]
		);
        $this->add_control(
					'link_color_hover',
					[
						'label' 	=> esc_html__( 'Link Color Hover', 'freeagent' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .jws_categories .jws_list_categories li a:hover , 
                            {{WRAPPER}} .jws_categories .jws_list_categories li.current-cat a,
                            {{WRAPPER}} .jws_categories .jws_list_categories li:hover span,
                            {{WRAPPER}} .jws_categories .jws_list_categories li.current-cat span' => 'color: {{VALUE}};',
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

            $c = $settings['show_count'] == 'yes' ? '1' : '0';
            $h = $settings['show_hierarchical'] == 'yes' ? '1' : '0';
            $d = $settings['show_dropdown'] == 'yes' ? '1' : '0';
    

    
            $cat_args = array('orderby' => 'name', 'show_count' => $c, 'hide_empty' => false,'hierarchical' => $h, 'walker' => new Custom_Walker_Category);
            ?>
            <div class="jws_categories<?php echo ' skin_'.esc_attr($settings['skins']); ?>">
            <h4 class="cate_title"><?php  echo esc_html__('Categories','freeagent'); ?></h4>
            <?php
            
                if ( $d ) {
                    $cat_args['show_option_none'] = esc_html__('Select Category','freeagent');
                    wp_dropdown_categories(apply_filters('widget_categories_dropdown_args', $cat_args));
                    ?>
                    <script type='text/javascript'>
                    /* <![CDATA[ */
                        var dropdown = document.getElementById("cat");
                        function onCatChange() {
                            if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
                                location.href = "<?php echo home_url('/'); ?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
                            }
                        }
                        dropdown.onchange = onCatChange;
                    /* ]]> */
                    </script>
                  <?php } else {
                    ?>
                            <ul class="jws_list_categories">
                    <?php
                            $cat_args['title_li'] = '';
                            $subject = wp_list_categories(apply_filters('widget_categories_args', $cat_args));
                            $list = str_replace('<a href=','<span>&#124;</span><a href=',$subject);
                            echo wp_kses_post($list);
                    ?>
                            </ul>
                    <?php
                } ?>
            </div>
            <?php


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